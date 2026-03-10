<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/imap/vendor/autoload.php';

use Ddeboer\Imap\Server;

/**
 * ZImap Library
 *
 * @author  Shahzaib
 * @version 2.2
 */
class ZImap
{

    /**
     * CodeIgniter Class
     *
     * @var object
     */
    private $ci;

    /**
     * Check Dependencies
     *
     * @return string|boolean
     */
    public function check_dependencies()
    {
        if (!extension_loaded('iconv')) {
            return 'no_iconv_library';
        } else if (extension_loaded('imap')) {
            if ($this->is_imap_filled()) {
                if (version_compare(PHP_VERSION, '8.4', '>=')) {
                    return true;
                }

                return 'incompatible_php';
            }

            return 'imap_not_filled';
        }

        return 'no_imap_library';
    }

    /**
     * Is IMAP ( Settings ) Filled
     *
     * @return boolean
     */
    public function is_imap_filled()
    {
        if (db_config('imap_host') && db_config('imap_username') && db_config('imap_password') && db_config('imap_port')) {
            return true;
        }

        return false;
    }

    /**
     * Connect with IMAP Server
     *
     * @return void
     */
    public function connection()
    {
        $this->ci = &get_instance();

        $this->ci->load->model('Support_model');
        $this->ci->load->model('User_model');

        $flags = '/' . db_config('imap_protocol');

        if (db_config('imap_encryption')) {
            $flags .= '/' . db_config('imap_encryption');
        }

        if (db_config('imap_validate_cert') == 1) {
            $flags .= '/validate-cert';
        } else {
            $flags .= '/novalidate-cert';
        }

        $server = new Server(db_config('imap_host'), db_config('imap_port'), $flags);

        return $server->authenticate(db_config('imap_username'), db_config('imap_password'));
    }

    /**
     * Create and Log a Ticket
     *
     * @param  array  $input
     * @param  object $message
     * @return boolean
     */
    private function create_and_log_ticket($input, $message)
    {
        $subject = $input['subject'];

        if (empty($subject)) {
            $subject = 'no_subject';
        }

        $email_address = $input['reply_to'];

        // Find the sender in the users list to link
        // the ticket with his/her account:
        $user = $this->ci->User_model->get_by_email($email_address);

        $data = [
            'subject' => $subject,
            'message' => $input['content'],
            'email_address' => $email_address,
            'is_verified' => 1,
            'source' => 2,
            'priority' => do_secure_l(db_config('tickets_default_priority')),
            'department_id' => intval(db_config('tickets_default_department_id')),
            'created_month_year' => date('n-Y'),
            'created_at' => time()
        ];

        if (! empty($user)) {
            // The user is found in the system, link that email ticket with account:
            $data['user_id'] = $user->id;
        } else {
            // The user is a guest, create a guest ticket:
            $data['security_key'] = get_short_random_string();
        }

        $id = $this->ci->Support_model->add_ticket($data);

        if (! empty($id)) {
            $data['id'] = $id;
            $data['message_id'] = $input['message_id'];

            // If the ticket contains some attachments, link with the ticket:
            if (! empty($input['attachments']['success'])) {
                foreach ($input['attachments']['success'] as $attachment) {
                    $attachments_data = [
                        'ticket_id' => $id,
                        'attachment_name' => $attachment['attachment_name'],
                        'attachment' => $attachment['attachment']
                    ];

                    $this->ci->Support_model->save_ticket_attachment($attachments_data);
                }
            }

            log_ticket_activity('ticket_created_email', $id);

            $this->ci->Support_model->log_ticket_email($id, $input['message_id']);

            $message_id = send_email_to_ticket_confirmation($data, $email_address);

            // Relog the message ID for the system auto generated email:
            if (! empty($message_id)) {
                $this->ci->Support_model->log_ticket_email($id, $message_id);
            }

            $department = $this->ci->Support_model->department($data['department_id']);

            if (! empty($department)) {
                inform_department_users($department, $id);
            }

            // Handle File Uploading

            $message->markAsSeen();

            return true;
        }

        return false;
    }

    /**
     * Add and Log a Reply
     *
     * @param  array  $input
     * @param  object $message
     * @return boolean
     */
    private function add_and_log_reply($input, $message)
    {
        $ticket_id = $input['ticket_id'];
        $email_address = $input['reply_to'];

        $ticket = $this->ci->Support_model->ticket_by_id($ticket_id);

        if (! empty($ticket)) {
            // If the ticket is closed, and it's not allowed to reopen the tickets,
            // send a notification to buyer so he can proceed to create a new ticket:
            if ($ticket->status == 0 && db_config('sp_allow_ticket_reopen') == 0) {
                log_ticket_activity('ticket_closed_reply', $ticket_id);

                send_ticket_closed_notification($ticket_id, $email_address);

                $message->markAsSeen();
            } else {
                // Reopen the closed ticket if it's enabled in the settings:
                if ($ticket->status == 0 && db_config('sp_allow_ticket_reopen') == 1) {
                    log_ticket_activity('ticket_reopened_email', $ticket_id);

                    $this->ci->Support_model->reopen_ticket($ticket_id);
                }

                // Find the sender in the users list to link the reply:
                $user = $this->ci->User_model->get_by_email($email_address);

                $data = [
                    'ticket_id' => $ticket_id,
                    'message' => $input['content'],
                    'replied_at' => time()
                ];

                if (! empty($user)) {
                    $data['user_id'] = $user->id;
                }

                $id = $this->ci->Support_model->add_reply($data);

                if (! empty($id)) {
                    // If there is quoted content found for a reply,
                    // store and link it with the reply:
                    if (! empty($input['quoted_content'])) {
                        $data = [
                            'message' => $input['quoted_content'],
                            'ticket_reply_id' => $id
                        ];

                        $this->ci->Support_model->save_ticket_reply_quote($data);
                    }

                    // Link the ticket reply attachments:
                    if (! empty($input['attachments']['success'])) {
                        foreach ($input['attachments']['success'] as $attachment) {
                            $attachments_data = [
                                'ticket_reply_id' => $id,
                                'attachment_name' => $attachment['attachment_name'],
                                'attachment' => $attachment['attachment']
                            ];

                            $this->ci->Support_model->save_ticket_reply_attachment($attachments_data);
                        }
                    }

                    log_ticket_activity('ticket_replied_email', $ticket_id);

                    // If the ticket is assigned to some agent, notify the agent:
                    send_reply_notification($ticket->assigned_to, $ticket->id, $id, 'user');

                    $message->markAsSeen();

                    $data = [
                        'sub_status' => 1,
                        'last_reply_area' => 2,
                        'is_read' => 0
                    ];

                    $this->ci->Support_model->log_ticket_email($ticket_id, $input['message_id']);

                    $this->ci->Support_model->update_ticket($data, $ticket_id);

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Email to Ticket
     *
     * @return void
     */
    public function email_to_ticket()
    {
        $status = $this->check_dependencies();

        if ($status !== true) exit(err_lang($status));

        // The tickets module and the email to ticket must be enabled to use this feature:
        if (db_config('module_tickets') == 1 && db_config('enable_email_to_ticket') == 1) {
            try {
                $connection = $this->connection();
                $mailboxes = $connection->getMailboxes();

                // Find the unread emails in all the mailboxes:
                foreach ($mailboxes as $mailbox) {
                    // Skip container-only mailboxes:
                    // @see https://secure.php.net/manual/en/function.imap-getmailboxes.php
                    if ($mailbox->getAttributes() & \LATT_NOSELECT) {
                        continue;
                    }

                    $unseen = new \Ddeboer\Imap\Search\Flag\Unseen();
                    $messages = $mailbox->getMessages($unseen);

                    if (! empty($messages)) {
                        foreach ($messages as $message) {
                            $headers = $message->getHeaders();

                            // Email ID:
                            $message_id = $headers->get('message_id');

                            // Parent Message ID (if it's a reply):
                            $in_reply_to = $headers->get('in_reply_to');

                            // Messages IDs belonging to that email:
                            $references = $headers->get('references');

                            $subject = clean_subject($message->getSubject());
                            $content = $message->getBodyText();
                            $content_attachments = [];

                            // IGNORE OR SKIP THE BLANK EMAIL:
                            if (empty($content)) continue;

                            $content = remove_quotes($content);
                            $quoted_content = get_quoted($message->getBodyText());
                            $reply_to = $message->getReplyTo();

                            // Sender Email Address:
                            if (! empty($reply_to) && is_array($reply_to)) {
                                $reply_to = @$reply_to[0]->getAddress();
                            } else {
                                $reply_to = $message->getFrom()->getAddress();
                            }

                            // If there are atttachments, upload them on the server:
                            if ($message->hasAttachments()) {
                                $attachments = $message->getAttachments();

                                foreach ($attachments as $attachment) {
                                    $filename = $attachment->getFilename();
                                    $directory = append_slash(IMG_UPLOADS_DIR) . 'attachments/';
                                    $extension = get_file_extension($filename);
                                    $random_filename = get_short_random_string() . ".{$extension}";

                                    if (in_array($extension, ALLOWED_ATTACHMENTS_EMAIL_TO_TICKET)) {
                                        $saved = file_put_contents($directory . $random_filename, $attachment->getDecodedContent());

                                        if ($saved) {
                                            $content_attachments['success'][] = [
                                                'attachment' => $random_filename,
                                                'attachment_name' => $filename
                                            ];
                                        }
                                    }
                                }
                            }

                            if (! empty($in_reply_to)) {
                                // Find in the existing tickets to add a reply to the belonging ticket:
                                $ticket_email = $this->ci->Support_model->ticket_email($references);

                                if (! empty($ticket_email)) {
                                    $ticket = $this->ci->Support_model->ticket_by_id($ticket_email->ticket_id);

                                    if (! empty($ticket)) {
                                        $this->add_and_log_reply(
                                            [
                                                'ticket_id' => $ticket_email->ticket_id,
                                                'message_id' => $message_id,
                                                'content' => $content,
                                                'quoted_content' => $quoted_content,
                                                'attachments' => $content_attachments,
                                                'reply_to' => $reply_to
                                            ],
                                            $message
                                        );
                                    }
                                } else {
                                    // Sometimes the software sends invalid references or "in reply to" so,
                                    // instead of considering it a separate ticket, attempt to find in the
                                    // existing tickets (by subject) to avoid a separate ticket:
                                    $ticket = $this->ci->Support_model->ticket_from_email($message->getSubject(), $reply_to);

                                    if (! empty($ticket)) {
                                        $this->add_and_log_reply(
                                            [
                                                'ticket_id' => $ticket->id,
                                                'message_id' => $message_id,
                                                'content' => $content,
                                                'quoted_content' => $quoted_content,
                                                'attachments' => $content_attachments,
                                                'reply_to' => $reply_to
                                            ],
                                            $message
                                        );
                                    } else {
                                        // No ticket found belonging to the email, create a new ticket:
                                        $this->create_and_log_ticket(
                                            [
                                                'message_id' => $message_id,
                                                'subject' => $subject,
                                                'content' => $content,
                                                'attachments' => $content_attachments,
                                                'reply_to' => $reply_to
                                            ],
                                            $message
                                        );
                                    }
                                }
                            } else {
                                // Instead of creating a ticket, add a reply,
                                // in case the email software is sent, or create
                                // a separate email for a reply:
                                $ticket = $this->ci->Support_model->ticket_from_email($message->getSubject(), $reply_to);

                                if (! empty($ticket)) {
                                    $this->add_and_log_reply(
                                        [
                                            'ticket_id' => $ticket->id,
                                            'message_id' => $message_id,
                                            'content' => $content,
                                            'quoted_content' => $quoted_content,
                                            'attachments' => $content_attachments,
                                            'reply_to' => $reply_to
                                        ],
                                        $message
                                    );
                                } else {
                                    // Create a new ticket:
                                    $this->create_and_log_ticket(
                                        [
                                            'message_id' => $message_id,
                                            'subject' => $subject,
                                            'content' => $content,
                                            'attachments' => $content_attachments,
                                            'reply_to' => $reply_to
                                        ],
                                        $message
                                    );
                                }
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                exit($e->getMessage());
            }
        } else {
            exit(err_lang('temp_disabled'));
        }
    }

    /**
     * Test Connection
     *
     * @return string
     */
    public function test_connection()
    {
        try {
            $connection = $this->connection();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return true;
    }
}

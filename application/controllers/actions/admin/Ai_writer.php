<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * AI Writer Controller
 * 
 * @author Shahzaib
 */
class Ai_writer extends MY_Controller
{
    /**
     * AI Writing Input Handling
     * 
     * @return void
     */
    public function generate()
    {
        if ($this->zuser->has_permission('ai_writer')) {
            if (db_config('openai_status') == 0) {
                r_error('temp_disabled');
            }

            if (!db_config('openai_api_key')) {
                r_error('temp_disabled');
            }

            $language = do_secure(post('language'));
            $url = 'https://api.openai.com/v1/chat/completions';

            $data = json_encode([
                'model' => db_config('openai_model'),
                'temperature' => doubleval(db_config('openai_temperature')),
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "Respond in {$language} Language."
                    ],
                    [
                        'role' => 'user',
                        "content" => post('action') ? do_secure(post('action') . ': ' . post('content')) : do_secure(post('prompt'))
                    ]
                ],
                'max_tokens' => intval(db_config('openai_max_tokens')),
                'frequency_penalty' => doubleval(db_config('openai_frequency_penalty')),
                'presence_penalty' => doubleval(db_config('openai_presence_penalty')),
                'top_p' => doubleval(db_config('openai_top_p'))
            ]);

            $headers = [
                'Content-Type: application/json',
                'Authorization: Bearer ' . db_config('openai_api_key')
            ];

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            switch ($status_code) {
                case 200:
                    $response = json_decode($response, true);

                    if (isset($response['choices']) && !empty($response['choices'])) {
                        $content = $response['choices'][0]['message']['content'];

                        $data = [
                            'status' => 'ai_writer',
                            'message' => $content
                        ];

                        exit(json_encode($data));
                    } else {
                        r_error('no_output_by_openai');
                    }

                case 401:
                    r_error('invalid_api_key');

                case 404:
                    r_error('err_404');

                default:
                    r_error('went_wrong');
            }
        }

        r_error('invalid_req');
    }
}

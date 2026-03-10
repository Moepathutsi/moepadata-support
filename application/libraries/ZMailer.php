<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * ZMailer Library
 *
 * @author Shahzaib
 */
class ZMailer {
  
    /**
     * Send Email Using Mail or SMTP Protocol.
     *
     * @param  string  $receiver
     * @param  string  $subject
     * @param  string  $message
     * @param  array   $options
     * @param  boolean $debug
     * @return mixed
     */
    public function send_email( $receiver, $subject, $message, $options = [], $debug = false )
    {
        $ci =& get_instance();
        $ci->load->library( 'email' );
        
        $config['mailtype'] = 'html';
        
        if ( db_config( 'e_protocol' ) === 'smtp' )
        {
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = db_config( 'e_host' );
            $config['smtp_port'] = db_config( 'e_port' );
            $config['smtp_crypto'] = db_config( 'e_encryption' );
            $config['smtp_user'] = db_config( 'e_username' );
            $config['smtp_pass'] = db_config( 'e_password' );
        }
        
        if ( ! empty( $options['e_sender_name'] ) )
        {
            $sender_name = $options['e_sender_name'] . ' (' . db_config( 'site_name' ) . ')';
        }
        else
        {
            $sender_name = db_config( 'e_sender_name' );
        }
        
        $ci->email->initialize( $config );
        $ci->email->set_newline( "\r\n" );
        $ci->email->from( db_config( 'e_sender' ), $sender_name );
        $ci->email->to( $receiver );
        
        if ( empty( $options['direct_subject'] ) )
        {
            $ci->email->subject( '[' . html_escape( db_config( 'site_name' ) ) . '] - ' . $subject );
        }
        else
        {
            $ci->email->subject( $subject );
        }
        
        $ci->email->message( $message );
        
        if ( ! empty( $options['attach'] ) )
        {
            if ( is_array( $options['attach'] ) )
            {
                foreach ( $options['attach'] as $key => $attach )
                {
                    $ci->email->attach( $attach );
                }
            }
            else
            {
                $ci->email->attach( $options['attach'] );
            }
        }
        
        if ( ! empty( $options['headers'] ) )
        {
            foreach ( $options['headers'] as $key => $value )
            {
                $ci->email->set_header( $key, $value );
            }
        }
        
        if ( ! empty( $options['get_headers'] ) )
        {
            if ( @$ci->email->send( false ) )
            {
                $headers = $ci->email->print_debugger( array( 'headers' ) );
                
                return [
                    'success' => true,
                    'headers' => extract_headers( $headers )
                ];
            }
        }
        else
        {
            if ( @$ci->email->send() )
            {
                return true;
            }
        }
        
        if ( $debug === true )
        {
            return $ci->email->print_debugger();
        }
        
        return false;
    }
}

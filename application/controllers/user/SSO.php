<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * SSO Controller ( User )
 *
 * @author Shahzaib
 */
class SSO extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        
        $this->sub_area = 'account';
        $this->area = 'user';
    }   
    /**
     * Class Constructor
     *
     * @return void
     */
    public function ssoLogin()
    {
        $token = $this->input->get('token');
        $sig   = $this->input->get('sig');

        $secret = "asmoepadatacompanywewannahearfromyou";

        $expected = hash_hmac('sha256', $token, $secret);

        if ($sig !== $expected) {
            show_error("Invalid request", 403);
        }

        $payload = json_decode(base64_decode($token), true);

        if (!$payload) {
            show_error("Invalid token", 403);
        }

        // Optional expiry protection
       /* if(time() - $payload['time'] > 60){
            show_error("Token expired",403);
        }*/

        $email = $payload['email'];

        // Find user
        $user = $this->db
            ->where('email_address', $email)
            ->get('users')
            ->row_array();

        if (!$user) {
            show_error("User not found", 404);
        }

        // Generate login session token
        $login_token = bin2hex(random_bytes(32));

        // Use system login helper
        if(set_login($login_token, $user['id'], true)) {
            redirect('/index.php');
        } else {
            show_error("Login failed",500);
        }
    }
}
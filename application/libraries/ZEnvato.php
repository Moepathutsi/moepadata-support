<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

require_once APPPATH . 'third_party/EnvatoAPI.php';

/**
 * ZEnvato Library
 *
 * @author Shahzaib
 */
class ZEnvato extends EnvatoAPI {
    
    /**
     * Class Constructor
     *     
     * @return void
     */
    public function __construct()
    {
        $this->bearer = db_config( 'envato_api_token' );
    }
}

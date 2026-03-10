<?php

/**
 * EnvatoAPI Class
 *
 * @credit: https://github.com/abdulawal39/verify-envato-purchase-code
 */
class EnvatoAPI {

    // Bearer, no need for OAUTH token, change this to your bearer string
    // https://build.envato.com/api/#token
    protected $bearer;
    
    /**
     * Get Purchase Data
     *
     * @param  string $code
     * @return object|boolean
     */
    public function get_purchase_data( $code )
    {
        if ( empty( $this->bearer ) ) return 'no_token';
        
        $bearer = 'bearer ' . $this->bearer;
        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        $url = 'https://api.envato.com/v3/market/author/sale/';
        $ch = curl_init( $url . '?code=' . $code );

        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );
        
        if ( empty( $_SERVER['HTTP_USER_AGENT'] ) )
        {
            curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        }
        else
        {
            curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );
        }

        $data = curl_exec( $ch );

        if ( $data != '' )
        {
            return json_decode( $data );  
        }

        return false;
    }
    
    /**
     * Verify Purchase
     *
     * @param  string $code
     * @return integer|boolean
     */
    public function verify_purchase( $code )
    {
        if ( empty( $this->bearer ) ) return 'no_token';
        
        $data = $this->get_purchase_data( $code );
        
        if ( $data === false )
        {
            return false;
        }
        
        if ( ! is_object( $data ) || isset( $data->error ) || ! isset( $data->sold_at ) )
        {
            if ( isset( $data->reason ) )
            {
                if ( $data->reason == 'missing-token' )
                {
                    return false;
                }
            }
            
            return -1;
        }
        
        if ( ! isset( $data->supported_until ) )
        {
            return false;
        }
        
        if ( $data->supported_until == '' || $data->supported_until != null )
        {
            return $data;
        }
        
        return 0;
    }
}

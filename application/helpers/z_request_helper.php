<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Request Helper
 *
 * @author Shahzaib
 */

/**
 * Checks if the current request is POST.
 * 
 * @return bool
 */
if (! function_exists('is_post_request')) {
    function is_post_request()
    {
        return isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}

/**
 * Request
 *
 * Use to manage the form request.
 *
 * @param  string $type e.g. post
 * @param  string $key
 * @return string|null
 */
if (! function_exists('request')) {
    function request($type, $key)
    {
        $ci = &get_instance();
        return $ci->input->{$type}($key);
    }
}

/**
 * Post
 *
 * Use to manage the POST request.
 *
 * @param  string $key
 * @return string|null
 */
if (! function_exists('post')) {
    function post($key)
    {
        return request('post', $key);
    }
}

/**
 * Get
 *
 * Use to manage the GET request.
 *
 * @param  string $key
 * @return string|null
 */
if (! function_exists('get')) {
    function get($key)
    {
        return request('get', $key);
    }
}

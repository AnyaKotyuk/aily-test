<?php


/**
 * Get user IP address
 *
 * @return string ip
 */
function get_user_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

/**
 * Captcha validation
 *
 */
function check_captcha()
{
    session_start();
    if($_POST['kapcha'] != $_SESSION['rand_code']) return false;
    return true;
}
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

/**
 * Resize image
 *
 * @param $file
 * @param $w
 * @param $h
 * @param bool $crop
 * @return resource
 */
function resize_image($file, $w, $h, $crop = false, $file_type = 'jpg') {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    if ($file_type == 'jpg' || $file_type == 'jpeg') {
        $src = imagecreatefromjpeg($file);
    }
    if ($file_type == 'png') {
        $src = imagecreatefrompng($file);
    }
    if ($file_type == 'gif') {
        $src = imagecreatefromgif($file);
    }
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    if ($file_type == 'jpg' || $file_type == 'jpeg') {
        imagejpeg($dst, $file);
    }
    if ($file_type == 'png') {
        imagepng($dst, $file);
    }
    if ($file_type == 'gif') {
        imagegif($dst, $file);
    }

    return $file;
}

/**
 * Show img or txt file
 *
 * @param $file
 */
function showFile($file_name)
{
    $file = URL.'/uploads/'.$file_name;
    if ($imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION)) == 'txt') {
        return '<a target="_blank" href="'.$file.'">'.$file.'</a>';
    }
    return '<a href="'.$file.'" data-lightbox="'.$file.'"><img src="'.$file.'"></a>';
}
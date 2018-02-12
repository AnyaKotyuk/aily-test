<?php

if (!defined('PATH')) define('PATH', $_SERVER['DOCUMENT_ROOT']); // define site path
if (!defined('URL')) define('URL', ($_SERVER["HTTPS"] == "on")?'https://':'http://'.$_SERVER['HTTP_HOST']); // define site path
if (!defined('TableName')) define('TableName', 'messages'); // define main table name

require_once 'functions.php';
require_once 'database.php';
require_once 'formHelper.php';
require_once 'book.php';
require_once 'bookRepository.php';
require_once 'bookView.php';
<?php

$book_repo = new BookRepository;
$book = Book::getInstance();

if (!empty($_POST)) {
    $user_remote_data = array(
        'user_ip' => get_user_ip(),
        'user_browser' => $_SERVER['HTTP_USER_AGENT']
    );
    $data = array_merge($user_remote_data, $book->prepareData($_POST));
    $book_repo->saveMessage($data);
}
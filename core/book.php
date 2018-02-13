<?php

/**
 * Class Book make manipulations with book data
 */
class Book {

    private static $instance = null;
    public $error = null;
    public $error_msg = false;
    public $form_data = false;

    private function __construct()
    {

    }
    /**
     * Get instance
     *
     * @return Book|null
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }


    /**
     * Validate user data
     *
     * @param null $data
     */
    public function validation($data = null)
    {
        $error_msg = array();
        if (empty(trim($data['user_name']))) {
            $error_msg[] = 'Name is required';
            $this->error = true;
        }
        if (empty(trim($data['user_email']))) {
            $error_msg[] = 'Email is required';
            $this->error = true;
        } elseif (!filter_var($data['user_email'], FILTER_VALIDATE_EMAIL)) {
            $error_msg[] = 'Incorrect email format';
            $this->error = true;
        }
        if (!empty($data['homepage']) && !filter_var($data['homepage'], FILTER_VALIDATE_URL)) {
            $error_msg[] = 'Incorrect homeurl format';
            $this->error = true;
        }
        if (empty($data['message'])) {
            $error_msg[] = 'Enter your message';
            $this->error = true;
        }
        if (!check_captcha()) {
            $error_msg[] = 'Captcha is incorrect!';
            $this->error = true;
        }
        $this->error_msg = implode('<br>', $error_msg);
    }

    /**
     * Modify data for showing and saving
     *
     * @param null $data
     * @return array
     */
    public function prepareData($data = null)
    {
        $data_new = array();
        foreach ($data as $k => $v) {
            $data_new[$k] = htmlspecialchars(trim($v));
        }
        $this->form_data = $data_new;
        return $data_new;
    }

    /**
     * Get message list
     *
     */
    public function getMessages()
    {
        $db = DB::getInstance();

        $sortby = 'dt';
        if ($_GET['sortby'] == 'user_name' || $_GET['sortby'] == 'user_email' || $_GET['sortby'] == 'dt') {
            $sortby = $_GET['sortby'];
        }
        $sort = 'DESC';
        if ($_GET['sort'] == 'ASC') {
            $sort = 'ASC';
        }
        $page = (!empty($_GET['page']))?$_GET['page']:1;
        $start = (MessagesPerPage*($page-1));
        $q = "SELECT *
                FROM `".TableName."`
                ORDER BY `".$sortby."` ".$sort."
                LIMIT $start,".MessagesPerPage."
                ";
        $res = $db->db_query_select($q);
        if (!$res) return false;
        $arr = array();
        foreach ($res as $k=>$v) {
            $arr[] = $this->prepareData($v);
        }
        return $arr;
    }

    public static function messagesCount()
    {
        $db = DB::getInstance();

        $q = "SELECT count(`id`) AS `count` FROM `".TableName."`";
        $res = $db->db_query_select($q);
        if (!$res) return false;

        return (!empty($res[0]))?$res[0]['count']:0;
    }


}
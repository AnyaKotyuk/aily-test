<?php

/**
 * Class BookRepository for work with messages data: create, get and others
 *
 */
class BookRepository {


    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->createTable();
    }

    /**
     * Save user message
     *
     * @param array $data - user info and message
     */
    public function saveMessage($data = array())
    {
        $book = Book::getInstance();
        $book->validation($data);
        if ($book->error) {
            return false;
        }

        $q = "INSERT INTO `".TableName."`
                (`user_name`, `user_email`, `user_ip`, `user_browser`, `homepage`, `message`, `dt`)
                VALUES(:user_name, :user_email, :user_ip, :user_browser, :homepage, :message, CURRENT_TIMESTAMP)
                ";

        $params = array(
            ':user_name' => $data['user_name'],
            ':user_email' => $data['user_email'],
            ':user_ip' => $data['user_ip'],
            ':user_browser' => $data['user_browser'],
            ':homepage' => $data['homepage'],
            ':message' => $data['message']
        );

        $res = $this->db->prepare_query($q, $params);
        if (!$res) {
            $book->error = true;
            $book->error_msg = "Error has happened! Try again.";
        }
    }

    /**
     * Creates table book if it is not still created
     *
     */
    private function createTable()
    {
        $q = "CREATE TABLE IF NOT EXISTS `".TableName."` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `user_name` varchar(255) NOT NULL,
                `user_email` varchar(50) NOT NULL,
                `user_ip` varchar(50) NOT NULL,
                `user_browser` varchar(100) NOT NULL,
                `homepage` varchar(100),
                `message` text NOT NULL,
                `dt` datetime NOT NULL,
                PRIMARY KEY(`id`)
        )";
        $res = $this->db->query($q);
        return $res;
    }
}
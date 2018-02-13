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

        if (!empty($data['file'])) {
            $book->error_msg = $this->saveFile($data['file']);
            if (!empty($book->error_msg)) {
                $book->error = true;
                return false;
            }
        }

        $q = "INSERT INTO `".TableName."`
                (`user_name`, `user_email`, `user_ip`, `user_browser`, `homepage`, `message`, `file`, `dt`)
                VALUES(:user_name, :user_email, :user_ip, :user_browser, :homepage, :message, :file, CURRENT_TIMESTAMP)
                ";

        $params = array(
            ':user_name' => $data['user_name'],
            ':user_email' => $data['user_email'],
            ':user_ip' => $data['user_ip'],
            ':user_browser' => $data['user_browser'],
            ':homepage' => $data['homepage'],
            ':message' => $data['message'],
            ':file' => (!empty($data['file']))?$data['file']['name']:''
        );

        $res = $this->db->prepare_query($q, $params);
        if (!$res) {
            $book->error = true;
            $book->error_msg = "Error has happened! Try again.";
        }
    }

    /**
     * Save file
     *
     * @param $file
     */
    public function saveFile($file)
    {
        $target_dir = PATH.'/uploads';
        chmod($target_dir, 0777);
        $target_file = $target_dir .'/'. basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            return "Sorry, file already exists.";
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"  && $imageFileType != "txt" ) {
            return "Wrong file format.";
        }

        if ($imageFileType == 'txt') {
            if ($file["size"] > 102400) {
                return "Sorry, your file is too large.";
            } else {
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                } else {
                    return "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $img_size = getimagesize($file["tmp_name"]);
            if ($img_size[0] > 320 || $img_size[1] > 240) {
                resize_image($file["tmp_name"], 320, 240, false, $imageFileType);
            }
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
            } else {
                return "Sorry, there was an error uploading your file.";
            }
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
                `file` varchar(255),
                `dt` datetime NOT NULL,
                PRIMARY KEY(`id`)
        )";
        $res = $this->db->query($q);
        return $res;
    }
}
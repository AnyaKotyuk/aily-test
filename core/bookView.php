<?php

class BookView {

    /*
     * Show book page
     *
     * @return string
     */
    public function show()
    {
        $book = Book::getInstance();
        $form_data = array(
            'data' => ($book->error)?$book->form_data:null,
            'error_msg' => $book->error_msg,
            'error' => $book->error
        );

        $messages = $book->getMessages();
        $page_atts = array(
            'form' => $this->getView('form', $form_data),
            'messages' => $messages,
            'pagination' => $this->pagination()
        );

        $view = $this->getView('page', $page_atts);
        echo $view;
    }

    /**
     * Get view part by file name
     *
     * @param string $template - template name
     * @param array $atts - template variables
     * @return string - template content
     */
    public function getView($template = null, $atts = array())
    {
        extract($atts);
        ob_start();
        include_once PATH.'/templates/'.$template.'.php';
        return ob_get_clean();
    }

    /**
     * Pagination for message list
     *
     * @return string
     */
    public function pagination()
    {
        $count_messages = Book::messagesCount();
        $count_show_pages = MessagesPerPage;
        $count_pages = ceil($count_messages/$count_show_pages);
        $active = (!empty($_GET['page']))?$_GET['page']:1;
        $request = '';
        if (!empty($_GET['sortby'])) {
            $request .= 'sortby='.$_GET['sortby'];
        }
        if (!empty($_GET['sort'])) {
            $request .= 'sort='.$_GET['sort'];
        }
        $url = URL.((!empty($request))?'?'.$request:'');
        $url_page = '?'.$request.((!empty($request))?'&':'').'page=';

        if ($count_pages > 1) {
            ob_start();
            ?>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $count_show_pages; $i++){ ?>
                    <li class="<?php echo ($i == $active)?'active':'';?>"><a href="<?php echo ($i === 1)?$url: $url_page.$i ;?>"><?php echo $i; ;?></a></li>
                <?php } ?>
            </ul>
        <?php }
        return ob_get_clean();

    }
}
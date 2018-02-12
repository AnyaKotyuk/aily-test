<?php

class BookView {

    public function __construct()
    {

    }

    /*
     * Show book page
     *
     */
    public function show()
    {
        $book = Book::getInstance();
        $form_data = array(
            'data' => $book->form_data,
            'error' => $book->error_msg
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
        $count_pages = Book::messagesCount();
        $active = (!empty($_GET['page']))?$_GET['page']:1;
        $count_show_pages = 2;
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
            $left = $active - 1;
            $right = $count_pages - $active;
            if ($left < floor($count_show_pages / 2)) $start = 1;
            else $start = $active - floor($count_show_pages / 2);
            $end = $start + $count_show_pages - 1;
            if ($end > $count_pages) {
                $start -= ($end - $count_pages);
                $end = $count_pages;
                if ($start < 1) $start = 1;
            }
            ob_start();
            ?>

            <ul class="pagination">
                <?php for ($i = 1; $i <= ceil($count_pages/$count_show_pages); $i++){ ?>
                    <li><a href="<?php echo ($i === 1)?$url: $url_page.$i ;?>"><?php echo $i; ;?></a></li>
                <?php } ?>
            </ul>
        <?php }
        return ob_get_clean();

    }
}
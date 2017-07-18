<?php

require_once 'action/abstract.php';

class ActionShowPost extends ActionAbstract
{

    public $title = 'showpost';

    public $viewTemplate = 'view/showpost.phtml';

    public function run()
    {
        $query = "SELECT `id`, `title`, `discription` FROM `posts`";
        
            $link = DbConnect::getInstance()->getLink();
        
        $result = mysqli_query($link, $query);
        
        if(!$result){
            $this->messages['error'][] = 'Wrong query!'.  mysqli_error(). "\n";
            die($link);
        }
        $this->post = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        mysqli_free_result($result);
    }
}
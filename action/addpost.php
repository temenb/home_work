<?php


require_once 'action/abstract.php';

class ActionAddPost extends ActionAbstract
{

    public $title = 'addpost';

    public $viewTemplate = 'view/addpost.phtml';

    public function run()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = (string)isset($_POST['title']) ? trim($_POST['title']) : '';
            
            $discription = (string)isset($_POST['discription']) ?
                trim($_POST['discription']) : '';
            

            $validaton = true;
            if (empty($title)) {
                $this->messages['errors'][] = 'Title shouldn\'t be empty';
                $validaton = false;
            }
            if (empty($discription)) {
                $this->messages['errors'][] = 'Discription shouldn\'t be empty';
                $validaton = false;
            }


            $link = DbConnect::getInstance()->getLink();

            if ($validaton) {

                $stmt = mysqli_prepare(
                    $link,
                    "INSERT INTO posts (id, title, discription) VALUES (NULL,?,?)"
                );
                if ($stmt) {

                    mysqli_stmt_bind_param($stmt, "ss", $title, $discription);

                    /* запускаем запрос */
                    $success = mysqli_stmt_execute($stmt);
                    
                    
                    if ($success) {
                        $this->messages['success'][] = 'Congrads, you add new post!';
                    } else {
                        $this->messages['errors'][] = 'smth went wrong with database';
                        //$this->messages['errors'][] = mysqli_error($dbLink) ;//newer show database errors responce to user
                    }
                    /* закрываем запрос */
                    mysqli_stmt_close($stmt);
                }
            }
        }
    }
}
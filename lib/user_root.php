<?php

class AccessChecker {
    


    public function isAllowed($userId){
        
        $link = DbConnect::getInstance()->getLink();
            if ($stmt = mysqli_prepare($link, "select * from user where id= ?")) {

                /* связываем параметры с метками */
                mysqli_stmt_bind_param($stmt, "s", $userId);

                /* запускаем запрос */
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);
                /* получаем значения */
                $root = mysqli_fetch_array($result, MYSQLI_ASSOC);


                /* закрываем запрос */
                mysqli_stmt_close($stmt);
                
              $_SESSION['userId'] = $root['id'];
                        
                        header('Location: ' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '?r=showpost');
                        exit;
                return isset($root['is_admin']) && ($root['is_admin'] == 'admin');
                
     }
     
  }
  
}
$accessChecker = new AccessChecker();
$accessChecker->isAllowed($_SESSION['userId']);





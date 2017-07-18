<?php

class UserRoot {
    


    public function getRoleName(){
        
        $link = DbConnect::getInstance()->getLink();
            if ($stmt = mysqli_prepare($link, "select * from user where root_name= ?")) {

                /* связываем параметры с метками */
                mysqli_stmt_bind_param($stmt, "s", $root_name);

                /* запускаем запрос */
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);
                /* получаем значения */
                $root = mysqli_fetch_array($result, MYSQLI_ASSOC);


                /* закрываем запрос */
                mysqli_stmt_close($stmt);
                
                if($root){
                    
                }  else {
                    //header('Location: http://localhost/index.php?r=login');
                    $this->messages['errors'][] = 'not root';
                    exit();
                }
     }
     return $this->root_name;
    
  }
}

$user_role = new UserRoot();
print_r($user_role->getRoleName());



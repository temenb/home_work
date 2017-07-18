<?php

class AccessChecker {
    


    public function isAllowed($userId){
        
        $link = DbConnect::getInstance()->getLink();
            if ($stmt = mysqli_prepare($link, "select * from user where id= ?")) {

                /* связываем параметры с метками */
                mysqli_stmt_bind_param($stmt, "s", $root_name);

                /* запускаем запрос */
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);
                /* получаем значения */
                $root = mysqli_fetch_array($result, MYSQLI_ASSOC);


                /* закрываем запрос */
                mysqli_stmt_close($stmt);
                
                
     }
     
  }
}

return isset($root['is_admin']) && ($root['is_admin'] == 'admin');



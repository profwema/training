<?php
        $page = basename($_SERVER['PHP_SELF']);
        if($page!='register.php' &&  $page!='login.php')
        {
          if($page == 'centerCourse.php')
          {  
            if(isset($_SERVER["QUERY_STRING"]));
            {
              $page =$page.'?'.$_SERVER["QUERY_STRING"];
            }
            $_SESSION['comeFrom'] = $page;
          }
          else
          {
            unset($_SESSION['comeFrom']);
          }

        }

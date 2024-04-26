<?php
 session_start();
  if($_SERVER['REQUEST_METHOD']==='POST'){
     if($_POST['Logout']){
         session_destroy();
          header("Location:login.php");
           exit(); 
        } 
           }
            if(!isset($_SESSION['uname'])){
                 header("Location:login.php");
                  exit();
                   }
                    $user=$_SESSION['uname']; 
                    echo "<h1>WELCOME $user</h1><br/>This is a secure area. You're logged in"; 
?> 
                    <html> 
                        <body> 
                            <form action="" method="post"> 
                                <input type="submit" value="LOGOUT" name="Logout" />
                             </form> 
                         </body> 
                    </html>
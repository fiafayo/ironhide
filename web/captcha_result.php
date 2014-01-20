<?php
session_start();
if($_SESSION['img_number'] != $_POST['num']){
    echo'The number you entered doesn\'t match the image.<br>
    <a href="captcha_form.php">Try Again</a><br>';
}else{
    echo'The numbers Match!<br>
    <a href="captcha_form.php">Try Again</a><br>';
}
?> 
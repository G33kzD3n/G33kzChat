<?php
session_start();
require_once 'controllers/form_message.php';
require_once 'controllers/controllers.php';

$_SESSION=array();
if(isset($_COOKIE[session_name()])){

	setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
//redirect to public login
redirect('login.php');
?>

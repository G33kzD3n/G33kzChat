<?php 
//display signup form
function display_signup_form(){
     //$safe_user_name="";
    $output ="<h2 class=\"large\">SignUp Now:</h2>";
    $output.="<div class=\"form-group\">";
    $output.="<form  method=\"post\" action=\"signup.php\">";
    $output.="<div class=\"form-group\">";
    $output.="<label  for=\"user_name\">User Name:</label>";
    $output.="<input type=\"text\" name=\"user_name\"class=\"form-control\"";
    $output.="autofocus required></div><div class=\"form-group\">";
    $output.="<label  for=\"password\">Password:</label>";
    $output.="<input type=\"Password\" name=\"user_password_new\"class=\"form-control\"required>";
    $output.="</div><div class=\"form-group\">";
    $output.="<label  for=\"confirm\">Confirm Password:</label>";
    $output.="<input type=\"password\" name=\"user_password_repeat\" class=\"form-control\" required>";
    $output.="</div><div class=\"form-group\">";
    $output.="<label  for=\"sec_ques\">Security Question:</label>";
    $output.="<input name=\"sec_ques\" type=\"text\" class=\"form-control\" required>";
    $output.="</div><div class=\"form-group\">";
    $output.="<label  for=\"ans\">Answer:</label>";
    $output.="<input name=\"ans\" type=\"text\" class=\"form-control\" required>";
    $output.="</div><div class=\"form-group\"><br>";
    $output.="<input type=\"submit\" name=\"submit\" value=\"Sign Up\"";
    $output.="class=\"btn btn-success\"></div></form></div>";
    $output.="<!-- form-group claosed-->";

    return $output;

}
//dislay sucess message 
function display_sucess($msg)
		{

			$output="<div class=\"form-group has-success has-feedback\">";
    		$output.="<label class=\"control-label small\" for=\"inputSuccess\">";
    		$output.="{$msg}</label>";
             $output.="<div\">";
    		$output.="<span class=\"glyphicon glyphicon-ok form-control-feedback\"></span>";
           
         return $output;
      		}
//display warning message	
function display_warning($msg)
		{

				$output="<div class=\"form-group has-error has-feedback\">";
    			$output.="<label class=\"control-label small\"for=\"inputError\">";
    			$output.="{$msg}</label>";
    			//$output.="<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span></div>";
      			$output.="<div\">";
                return $output;
			
		}

//display array of errors
//given array of errors 
function display_form_errors($errors){
     $output="";
    $output.="<dl style=\"list-style-type:none\">";        
    foreach($errors as $error)
        {
            $output.="<dd>";
            $output.=display_warning($error);
            $output.="</dd>";
        }
    $output.="</dd>";
    return $output;
} 




?>
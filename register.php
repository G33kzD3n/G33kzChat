<?php
session_start();
require 'controllers/controllers.php';
require_once 'controllers/form_message.php';
include 'master_templates/master_header.php';

//preg_match('/^[2-9][0-9]*$/', $_POST['age'])
//$key_value="";//used to store reg_id of user after submitting the form
$output=array();
$error="";
$new_user=//store user info in associative array
			$new_user=array('first_name'=>'',
				'last_name'=>'',
				'phone_no'=>'',
				'city'=>'',
				'age'=>'',
				'email'=>'',
				'gender'=>''
			 );

////// aplication logic when user submitted registration form 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
	if(isset($_POST['submit'])){
			//store user info in associative array
			$new_user=array('first_name'=>htmlspecialchars(ucwords($_POST['first_name'])),
				'last_name'=>htmlspecialchars(ucwords($_POST['last_name'])),
				'phone_no'=>$_POST['phone_no'],
				'city'=>$_POST['city'],
				'age'=>$_POST['age'],
				'email'=>$_POST['email'],
				'gender'=>$_POST['gender']
			 );
				
			// register this user and return status message
			$output=register_form_validation();

			if(!$output){
			//validation passed 
			//save user information
					$status=register_user($new_user);
					if ($status=="success") {

						//store phone no of user in session
						//for updating his register table at signup
						$_SESSION['phone_no']=$new_user['phone_no'];
						//$output=display_sucess("Your form is submitted.");
						//store msg in session and redirect for signup
						$_SESSION['msg']=display_sucess("
								Your form has been submitted.
								Please signup now.");
								//redirect user for signup
								redirect('signup.php');
					}else{//data base error
						$error=display_warning("Some thing went wrong/<br>Phone no/ Email already exists..");
						
						}
			}
			else{
				//validation has failed display errors
				$error=display_warning("<h4>Sorry, your registration failed.
	            	 Please correct following errors:</h4>");
	            //display list of all errors
	            //$error.=display_form_errors($output);	
             	}//closing else 

						
	}//closed post['submit'] if
}//closed server requset if
	

?>
<div class="col-xs-8">
<p><?php echo $error ;
			echo display_form_errors($output);?></p>
<h2 class="large"> Register as new Blog Admin by submitting the form below:</h2>
 	<div class="form-group">
		<form  method="post" action="register.php">
		<div class="form-group ">
		<label  for="first_name">First Name:</label>
		<input type="text" value="<?php  echo htmlspecialchars($new_user['first_name'])?>"  name="first_name"class="form-control" autofocus required>
		</div>
		<div class="form-group">
		<label  for="last_name">Last Name:</label>
		<input type="text"  value="<?php echo htmlspecialchars($new_user['last_name'])?>"name="last_name"class="form-control" required>
		</div>
		<div class="form-group">
		<label  for="phone_no">Phone No:</label>
		<input type="text" value="<?php echo htmlspecialchars($new_user['phone_no'])?>"name="phone_no" class="form-control" required>
		</div>
		<div class="form-group">
		<label  for="city">City:</label>
		<select name="city" class="form-control" required>
			<option value="Srinagar">Srinagar</option>
			<option value="Budgham">Budgham</option>
			<option value="Baramulla">Baramulla</option>
			<option value="Other">Other</option>
		</select>
		</div>
		<div class="form-group">
		<label  for="age">Age:</label>
		<input name="age" value="<?php  echo htmlspecialchars($new_user['age'])?>"type="number" class="form-control" required>
		</div>
		<div class="form-group">
		<label  for="email">Email ID:</label>
		<input type="email" value="<?php echo  htmlspecialchars($new_user['email'])?>" name="email" class="form-control" required>
		</div>
		<label for="gender">Gender:</label>
		<label class="radio-inline"  for="gender">Male:</label>
		<input type="radio" name="gender"  value="male"class="radio-inline" required>
		<label class="radio-inline"  for="gender">Female:</label>
		<input type="radio" name="gender"  value="female" class="radio-inline"  required>
		<div class="form-group"><br>
		<input type="submit" name="submit" value="Register Now" class="btn btn-success">
			
		</div> 
	
		</form>
	
	</div>
	<!-- form-group claosed-->
	
</div>
<!-- col-md-8 closed-->
<div class="row">

<?php include 'master_templates/master_footer.php';?>
</div>
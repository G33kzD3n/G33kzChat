<?php
session_start();
$output="";
$name="";
require_once 'controllers/form_message.php';
require_once 'controllers/controllers.php';
include 'master_templates/master_header.php';

if(logged_in()){
	redirect('user_account.php');
}

$safe_user_name="";
	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		$safe_user_name =mysql_secure(htmlspecialchars($_POST['user_name']));
		
		$password=$_POST['password'];
	
				$query="SELECT user_name, password
              			 FROM login WHERE 
               			user_name ='" .$safe_user_name."' 
               			AND password = '" .$password. "';";
				$result=connect($query);
				if($result){
					//query executed 
					//fetch rows that matc username and password
         			$row=mysqli_num_rows($result);
                    	if ($row == 1){
                    		//sucess username and passowrd matches
                    		//save username in session and redirect to user index page...
                    	 	$_SESSION['username']=$safe_user_name;
                    	 	redirect('user_account.php');
                    	 }//now match found 
                    	 else {
              			 $output=display_warning("Username/Pasword Incorrect ?");
      						}
      			}// query not exexuted display warning
                else {
                	$output=display_warning("Something went wrong?");
                }

				
		}//issset login closed

?>


<div class="col-xs-8">
   <div class="small">
	  <h1 >Login Here</h1><hr>
	 </div> 
		<form  method='post' action="login.php">
			<div class="form-group">
				<label  for="user_name">User Name:</label>
				<input autofocus required class="form-control" type="text" name='user_name' value="<?php echo htmlspecialchars($safe_user_name);?>"
						placeholder="Enter Your Username Here">
			</div>
			<div class="form-group">
				<label  for="password">Pasword:</label>
    			<input  type="password" required name='password'class="form-control" 
    					placeholder="Enter Your Password Here">
    		</div>
			<div class="form-group">
	 			<input class="btn  btn-primary" type="submit" 
	 					name="login" value="Login">
	 			 </input>
	 		</div>
	 		<h4><?php echo $output;?></h4>
		</form>
	</div>
<?php include 'master_templates/master_footer.php';?>
<?php
session_start();
require 'controllers/controllers.php';
require_once 'controllers/form_message.php';
include 'master_templates/master_header.php';
$output=array();
$msg="";	


//store phone no in varaibee
$phone_no=$_SESSION['phone_no'];



//if user has not submitede the signup for 
// we must delete his register table record



//if user directly enters this page 
	//without ist submitting reg form
		//redirect to index
if (!isset($_SESSION['msg'])) {
	
	redirect('index.php');

}
else{
	//display  sucess message of registration form
	//creatte signup form
		?>
		<div class="col-md-8">
			<?php echo display_signup_form();
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				////perform validation
				///if no error nothoing will be returned 
				//on error error array will be returned
				$output=signup_validation();
				if(!$output){
					$user_name =htmlspecialchars(ucwords($_POST['user_name']));
                	$user_password = $_POST['user_password_new'];
                	$sec_ques=ucwords($_POST['sec_ques']);
                	$ans=ucwords($_POST['ans']);

                	//sql query to insert data in login table
					///$query1="select * from register";
					 $query="INSERT INTO login (user_name,password,
					 sec_ques,answer) VALUES
					 ('".$user_name."','".$user_password."',
					 '".$sec_ques."','".$ans."')";
       				//execute query
 					               	
        			 $result=connect($query);
       				 if(!$result)
       					{
                  		echo $msg=display_warning("query not updte executed bye");
                        }
                     //sql query to update user_name in register table
						//	UPDATE `blog`.`register` SET `user_name` = 'nadeem123' 
						//	WHERE `register`.`reg_id` = 103;
					 	 $query="UPDATE register SET user_name = '{$user_name}'
					 	 WHERE phone_no = {$phone_no}";			
        			   	//execute query
        				$result=connect($query);
        				//check query status
       				 	if(!$result)
       						{
                  				echo $msg=display_warning("query not insert executed bye");
                         	}
                        else{
                         		
                        		echo $msg=display_sucess("Your account has been created 
                              	successfully.Please Login!");
                            }
                		
                		
					 
     			}//erors are recieved
            	else{
	            echo $msg=display_warning("<h4>Sorry, your registration failed.
	            	 	Please correct following errors:</h4>");
	            		//display list of all errors
	            		echo display_form_errors($output);	
             		}//closing else 
        }//closing server request if
        else {
         		echo $output=$_SESSION['msg'];
				
         	}

			?>
		</div>
<?php }

	
 		
?>
<div class="row">
<?php include 'master_templates/master_footer.php';?>
</div>




























































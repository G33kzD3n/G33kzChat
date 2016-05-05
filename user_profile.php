<?php
session_start();
require_once 'controllers/controllers.php';
require_once 'controllers/form_message.php';
include 'master_templates/user_header.php';
confirm_logged_in();
	$output=array();

	$error="";
	$visible="disabled";
	$user_name=$_SESSION['username'];

	$query="SELECT * FROM register WHERE user_name ='{$user_name}'";
	        $result=connect($query);
	        if($result){
	            //query executed 
	            //fetch rows that matc username 
	            $row=mysqli_fetch_assoc($result);
	          }
	        else{
	            $error=display_warning("query failed");
	          }
	 if($_SERVER['REQUEST_METHOD']){
	            
	            if(isset($_POST['edit'])){
	                    $visible="";
	               }

	//for updating user info and saving to database
	          if(isset($_POST['save'])){
	               $visible="";
	               //validate information ist
	               $output=register_form_validation();

	                    if(!$output)//no errors found
	                    {
	                        // update user informationucwords($_POST['first_name'])
	                        $query="UPDATE register SET first_name ='".ucwords($_POST['first_name'])."',
	                        last_name ='".ucwords($_POST['last_name'])."', 
	                        phone_no ='".$_POST['phone_no']."',
	                        city ='".ucwords($_POST['city'])."', age ='".$_POST['age']."',
	                        email='".$_POST['email']."'
	                        WHERE user_name ='".$user_name."'";

	                        $result=connect($query);
	                        if($result){
	                        //query executed 
	                            $error=display_sucess("Profile updated successfully.");
	                            $visible="disabled";
	                            


	                         //   redirect("user_profile.php");
	                            }
	                        else{
	                                $error=display_warning("Something went wrong");
	                            }
	                    }
	                    else{
	                        //validation has failed display errors
	                            $error=display_warning("<h4>Sorry, your registration failed.
	                             Please correct following errors:</h4>");
	                                //display list of all errors
	                            //  redirect('user_profile.php');
	                                //$error.=display_form_errors($output); 
	                        }//closing else 

	                    }// isset save
	  }//server request
	?>


<!-- user profile -->
<div class="col-md-8"> 
<h4  class="text-capitalize text-primary">
	<a href="index.php">my posts</a>
</h4> 
</div>
<div class=" form-group col-md-8">
<h5><?php echo $error ;?></h5>
<p><?php echo display_form_errors($output);?></p>
<h4 class="page-header text-capitalize text-primary"> User Profile:

</h4>
    <div class="form-group" >
        <form method="post" action="user_profile.php" >
        <div class="form-group">
        <label  for="first_name">First Name:</label>
        <input type="text"  value=<?php echo htmlspecialchars($row['first_name']);?> 
        name="first_name"class="form-control"<?php echo $visible;?>>
        
        </div>
        <div class="form-group">
        <label  for="last_name">Last Name:</label>
        <input type="text"   value=<?php echo htmlspecialchars($row['last_name']);?>
        name="last_name"class="form-control" <?php echo $visible?>>
        <?php //echo display_warning($output['lname_len']);?>
        <?php //echo display_warning($output['lname_format']);?>
        </div>
        <div class="form-group">
        <label  for="phone_no">Phone No:</label>
        <input type="number"   value=<?php echo htmlspecialchars($row['phone_no']);?>
        name="phone_no" class="form-control" <?php echo $visible?>>
        <?php// echo display_warning($output['phone_no_format']);?>
        </div>
        <div class="form-group">
        <label  for="city">City:</label>
        <input type='text' name="city"   value=<?php echo htmlspecialchars($row['city']);?>
         class="form-control" <?php echo $visible?>>
        </div>
        <div class="form-group">
        <label  for="age">Age:</label>
        <input name="age" type="number"   value=<?php echo htmlspecialchars($row['age']);?> 
        class="form-control" <?php echo $visible?>>
        <?php //echo display_warning("{$output['age_format']}");?>
        </div><div class="form-group">
        <label  for="email">Email ID:</label>
        <input type="email" name="email"   value=<?php echo htmlspecialchars($row['email']);?>
         class="form-control" <?php echo $visible?>>
        </div><div class="form-group">
        <label for="gender">Gender:</label>
        <input type="text" name="gender"   value=<?php echo htmlspecialchars($row['gender']);?>
        class="form-control" disabled>
        </div><div class="form-group"><br>
        <input type="submit" name="edit" value="Edit" class="btn btn-primary">
        <input type="submit" name="save" <?php echo $visible?> value="Save" class="btn btn-success">
        </div>
            
        </form>
    
    </div>
    <!-- form-group claosed-->
</div>
<!-- col-md-8 closed-->


<?php include 'master_templates/master_sidebar.php';
?>
<div class="row">
<?php	include 'master_templates/master_footer.php';
?></div>
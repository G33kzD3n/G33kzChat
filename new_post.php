<?phpsession_start();require_once 'controllers/controllers.php';require_once 'controllers/form_message.php';include 'master_templates/user_header.php';confirm_logged_in();$user_name=$_SESSION['username'];$msg="";//when user  clicked post button //store the new post in posts table //post_id user_name//title content post_cat if($_SERVER['REQUEST_METHOD'] == 'POST'){		       	//create db connection      	      	      		//suceesfull db conection      		$safe_title =mysql_secure(      						htmlentities(ucwords($_POST['title'])));      		$safe_category =mysql_secure(      						htmlentities(ucwords($_POST['category'])));			$safe_content  =mysql_secure(								nl2br(htmlentities($_POST['content'])));      		      		$query="INSERT INTO posts (user_name,title,              content,post_cat)             VALUES ('".$user_name."','".$safe_title."',                   '".$safe_content."','".$safe_category."');";       		//execute query        	$result=connect($query);        	if($result)        		{        		$msg=display_sucess("Your post has been Submitted.");        		//edirect('new_post.php');        		}        		else{        				$msg=display_warning("OOPS! Something went wrong.");        			}        		//check query status								if(!isset($_POST['submit'])){	//$_SESSION['msg']="";}}?><!-- page body --><div class=" form-group col-md-8"><h4><?php echo $msg;?></h4><h2 class="large"> Write A New Blog Post Here:</h2>	 	<div class=" form-group "> 		<form method="post" action="new_post.php">		<div class=" form-group ">		<label  for="title">Title of the post:</label>		<input type="text" name="title"class="form-control"autofocus required>		</div>		<div class=" form-group ">		<label  for="category">Catogory:</label>		<input type="text" name="category"class="form-control" required>		</div>		<div class=" form-group">		<label  for="content">Content:</label>		<textarea name="content" cols="10" rows="5" class="form-control" required>		</textarea></div>		<div class=" form-group"><br>		<input type="submit" name="submit" value="Post" class="btn btn-primary">			</div>		</form>		</div>	<!-- form-group claosed--></div><!-- col-md-8 closed--><?php include 'master_templates/master_sidebar.php';?><div class="row"> <?php include 'master_templates/master_footer.php';?></div>
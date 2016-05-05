<?php
session_start();
require_once 'controllers/controllers.php';
require_once 'controllers/form_message.php';
include 'master_templates/user_header.php';
//if user hasnt looged in redirect to login page
confirm_logged_in();
// code for comments
?>
<div class="col-md-8">
    <h4 class="text-capitalize text-primary">
        <a href="user_profile.php">edit profile</a>
    </h4> 
</div>
<?php   
$user_name=$_SESSION['username'];
$output="";
$row=array(); 
$comments="";
$comment=array();
$user_comment_info[]=array();
if(!isset($_SESSION['post_id'])){
    $_SESSION['post_id']="";
}

//*******************controller for [likes dislikes and comments]*************************        
if(isset($_GET['cat'])){
$row=reg_like_dislike_profile($_SESSION['post_id']);
}

////*******************controller for [older newer post query]*************************
$row=fetch_post_user_profile($_SESSION['post_id'],$_SESSION['username']);
//***************************CONTROLLERS AND MODELS END HERE****************************************
  
///fetch cooments on present post and store in array


$total_likes=total_likes($_SESSION['post_id']);
$total_dislikes=total_dislikes($_SESSION['post_id']);




  ?>                             

                             <!-- Blog Entries Column
-----------------------------OUR VIEW STARTS FROM HERE-------------------------------------
--><?php  // display the post
 if($row){
        ?>
       <div class="col-md-8">
                <h3 class="page-header text-capitalize text-primary ">
                 my posts.               
                </h3>
                <h2>
                <p><?php echo $row['title'];?><p>
                </h2>
                 <p class="lead">
                    by <a href="user_profile.php" class="alert-link">
                    <code><em><?php echo $row['user_name'];?></em></code>
                    </a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on
                    <?php //echo date('D L h:m s A',$row['posted_at']);  ?>
                    </t>Seconds Ago</p><hr></hr>
                    <h6 class="text-justify"><?php echo  $row['content'];?></h6>
                     <a class="btn btn-primary" href="#">Read More 
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        </a> 
                        <hr>
                    <div class="">
                        <h4> 
                            <tt><a  href="user_account.php?cat=liked"
                            data-placement="top"data-toggle="tooltip" title="like">
                           <span class="glyphicon glyphicon-thumbs-up  badge">
                             <em><?php echo $total_likes;?></em></span></a></tt>
                    
                            <tt><a  href="user_account.php?cat=disliked"data-placement="top"
                                data-toggle="tooltip" title="Dislike">
                            <span class="glyphicon glyphicon-thumbs-down badge">
                                 <em><?php echo $total_dislikes;?></em>
                            </span>
                            </a></tt>
                                <div class="form-group">
                             <h4><?php echo $output;?></h4>
                             </div>
                        </h4>
                    </div>
                  
                     <br>
                     <div class="col-xs-8">
                     
<?php
$result =get_latest_comments($_SESSION['post_id']);
if($result){

//print_r($user_comment_info=mysqli_fetch_assoc($result));
//if($user_comment_info){
while($user_comment_info=mysqli_fetch_assoc($result)) {?>
            <blockquote>
            <div class="panel panel-default">
            <div class="panel-heading"><code><em>
            <?php echo  $user_comment_info['who_commented'];?></code></em></div>
            <div class="panel-body"><p class="text-justify small">
            <em><?php echo $user_comment_info['comment'];?></em></p>
            </div><div>
            </blockquote>

<?php }

// } 

}?>
                    
                    <!-- comment elements -->
                  </div>
                    <div class="col-md-8">
                        <form  method="post"action=
                        "user_account.php?pid=<?php echo $_SESSION['post_id'];?>">
                            
                            <div class="form-group">
                            <textarea  name="comment" class="form-control"placeholder="Enter Your Comment."></textarea>
                            </div><div class="form-group">
                            <input value="Send" name="send"type="submit"class="btn btn-success">
                            </div>
                        </form > 

                    </div> 
                    <br>
                    <div class="col-md-8">     
                        <ul class="pager">
                            <li class="previous">
                                <a href="user_account.php?cat=older"> Older</a>
                            </li>
                            <li class="next">
                                <a href="user_account.php?cat=newer"> Newer</a>
                            </li>
                        </ul>
                      </div>
        </div>
<?php
}
else{?>
        <div class="col-md-8">
             <h3 class="page-header page-header text-capitalize text-primary ">
                 <p> <?php echo $output;?></p> </small>
            </h3>

        </div>

<?php }?>
<?php include 'master_templates/master_sidebar.php';?>
<div class="row">
<?php include 'master_templates/master_footer.php';?>    
</div>    








           

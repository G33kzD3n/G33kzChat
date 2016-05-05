<?php
session_start();
 
require_once 'controllers/controllers.php';
require_once 'controllers/form_message.php';
//**********************************************CONTROLLERS ************************************

//for logged in user display his menu
//else public menu.
if(!logged_in()){
    include 'master_templates/master_header.php';
    //disable features [like dislike comment]
    $disablelike=disable_feature();
    $disabledislike=disable_feature();
    $disablecomment="disabled";
    $send_button_color="btn-danger";
}
else{
    //user is authentic enable all features[likes dislike comments]
      include 'master_templates/user_header.php';
      $disablelike="href=\"index.php?cat=liked\"";
     $disabledislike="href=\"index.php?cat=disliked\"";
     $disablecomment="";
     $send_button_color="btn-success";
}
$row=array();
$output="";// used for displaying messages  
$comments="";
 $comment_element="";
 $user_comment_info=array();
 
//*******************controller for [likes dislikes and comments]*************************          
if(isset($_GET['cat'])){
$row=reg_like_dislike_index($_SESSION['post_id']);
}

//fetch all bloggers posts
//*******************controller for [OLDER] OR [NEWER] query or NONE*************************
//second function is submits the comments if aany

$row=fetch_post_public();

/******************CONTROLLERS FOR FETCHING LATEST 4 COMMENTS****************************************/
              




$total_likes=total_likes($_SESSION['post_id']);
$total_dislikes=total_dislikes($_SESSION['post_id']);







//***************************CONTROLLERS AND MODELS END HERE****************************************
      
  ?>                              <!-- Blog Entries Column
-----------------------------OUR VIEW STARTS FROM HERE-------------------------------------
    -->     
<?php  // display the post
     if($row){
            ?>
    <div class="col-md-8">

        <h1 class="page-header page-header text-capitalize text-primary ">
        latest posts from
            <small class="page-header page-header text-capitalize text-primary ">bloggers.</small>
             </h1>
            
        <!-- First Blog Post -->
        <h2>
            <a href="#"><?php echo $row['title'];?></a>
        </h2>
        <p class="lead">
            by <a  href="index.php"><code><em><?php echo $row['user_name'];?></em></code></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on</p>
        <hr>
        <p><?php echo $row['content'];?></p>
        <a class="btn btn-primary" href="index.php">Read More <span class="glyphicon glyphicon-chevron-right"></span></a><hr>
        <div>
            <h4> 
                <tt><a <?php echo $disablelike?> 
                data-placement="top"data-toggle="tooltip" title="like">
                <span class="glyphicon glyphicon-thumbs-up badge">
                 <em><?php echo $total_likes;?></span></em>
                </a></tt>
        
                <tt><a <?php echo $disabledislike?> data-placement="top"
                    data-toggle="tooltip" title="Dislike">
                <span class="glyphicon glyphicon-thumbs-down badge ">
                   <em><?php echo $total_dislikes;?></em>
                </span>
                </a></tt>

                <div class="form-group">
                             <h4><?php echo $output;?></h4>
                 </div>
            </h4>
          </div>
          <p><?php echo $comment_element;?>
            </p><br>
          <div class="col-xs-8">
          <div id="disqus_thread">
            
<script>
/**
* RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
* LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL; // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');

s.src = '//g33kzd3n.disqus.com/embed.js';

s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
var disqus_config = function () {
this.page.url = index.php  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier =
this.page.title= <?php echo $_SESSION['post_id'];?> // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};


</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
          </div>

       <?php
       if(isset($_GET['view'])){

        $comment_status=comments_controller($_SESSION['post_id'],$_SESSION['c_id']);
        //$_SESSION['c_id']=$row['c_id'];
       }
       else{
        $comment_status=get_latest_comments($_SESSION['post_id']);}
        
        if($comment_status){
             
              //print_r($user_comment_info=mysqli_fetch_assoc($result));
              //if($user_comment_info){
         // global $con;
         // $user_comment_info=mysqli_fetch($omment_status);
                    foreach($user_comment_info as $comment) {
        //$_SESSION['c_id']=$user_comment_info['c_id'];
                      ?>
                          <blockquote>
                           <div class="panel panel-default">
                           <div class="panel-heading"><em>
                           <?php echo  $user_comment_info['who_commented'];?></em></div>
                           <div class="panel-body"><p class="text-justify small">
                           <em><?php echo $user_comment_info['comment'];?></em></p>
                           </div><div>
                            </blockquote>
          
          <?php }//$_SESSION['c_id'] = $user_comment_info['c_id'];  ?>
                <ul class="pager">
                  <li class="previous">
  
                    <a class="label label-success"href="index.php?view=previouscomments">
                   <span class="small glyphicon glyphicon-chevron-left"></span>
                  <em> Previous Comments. </em>
                   </a>
                  </li>
                  <li class="next">
                   <a class="" href="index.php?view=newcomments"><em>Newer Comments.<em><span class="small glyphicon glyphicon-chevron-right"></span></a>
                  </li>
              </ul>

             <?php  }
             else{?>

                <div class="col-md-8">
                <h3 class="small text-capitalize text-primary ">
                <p> <?php echo $output;?></p> </small>
                </h3>

                </div>
            <?php }?>
        
        <hr>
        
       </div>
        
        <!-- comment elements -->
      
        <div class="col-md-8">

        <form  method="post"
              action="index.php?pid=<?php echo $_SESSION['post_id'];?>">
              
        <div class="form-group">
            <textarea  name="comment" class="form-control"placeholder="Enter Your Comment.">
            </textarea>
        </div><div class="form-group">
             <input value="Send" name="send"type="submit"class="btn  <?php echo $send_button_color;?>"
             <?php echo $disablecomment;?>>
        </div>
        </form ></div> 
            <br>
        
 <div class="col-md-8">
        <!-- Pager -->
        <ul class="pager">
            <li class="previous">
                <a href="index.php?cat=older">
                <span class="small glyphicon glyphicon-arrow-left"></span> Older</a>
            </li>
            <li class="next">
                <a href="index.php?cat=newer">Newer
                <span  class=" small glyphicon glyphicon-arrow-right"></span></a>
            </li>
        </ul>

    </div>
    </div>
    <?php
}// else handles nothing fetched
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








   

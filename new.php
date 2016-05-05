
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
this.page.url = index.php; // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = home; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};


</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>



















$user_name = strip_tags($_POST['user_name']);
                $user_password = $_POST['user_password_new'];

                // check if user or email address already exists
                 else {
                  // write new user's data into database
                  //  $query = "INSERT INTO login (user_name, user_password,)
                 // VALUES('" . $user_name . "', '" . $user_password. "', '" .. "');";
                  
                  }
                  else{
                     $errors]="Query not executed: " . mysql_error();   
                  }
                    
                    } 
                  return $errors;
 }
            //} else {
              //  $errors[] = "Sorry, no database connection.";
           // }
        //} else {
        //    $errors[] = "An unknown error occurred.";
        //}
   // }
//}  





























<?php
   /*class database{
      
   }
   $dbObject = new database;
///////////////////
*/
steps for my blog application
   1.create database model
      requirements i.e tables.

      tables with schema:
///////////////////
 mysql>describe check_post;
+-----------+-------------------+------+-----+---------+----------------+
| Field     | Type              | Null | Key | Default | Extra          |
+-----------+-------------------+------+-----+---------+----------------+
| id        | int(11)           | NO   | PRI | NULL    | auto_increment |
| user_name | varchar(20)       | YES  | MUL | NULL    |                |
| post_id   | int(11)           | YES  | MUL | NULL    |                |
| status    | enum('1','0','2') | NO   |     | 2       |                |
+-----------+-------------------+------+-----+---------+----------------+

mysql> describe likes;
+--------------+-------------------+------+-----+---------+----------------+
| Field        | Type              | Null | Key | Default | Extra          |
+--------------+-------------------+------+-----+---------+----------------+
| id           | int(255)          | NO   | PRI | NULL    | auto_increment |
| post_id      | int(254)          | NO   | MUL | NULL    |                |
| who_liked    | varchar(20)       | YES  | MUL | NULL    |                |
| who_disliked | varchar(20)       | YES  | MUL | NULL    |                |
| status       | enum('1','0','2') | NO   |     | 2       |                |
+--------------+-------------+------+-----+---------+----------------+

mysql> describe register;
+------------+-------------+------+-----+---------+----------------+
| Field      | Type        | Null | Key | Default | Extra          |
+------------+-------------+------+-----+---------+----------------+
| reg_id     | int(200)    | NO   | PRI | NULL    | auto_increment |
| first_name | varchar(30) | YES  |     | NULL    |                |
| last_name  | varchar(30) | YES  |     | NULL    |                |
| phone_no   | int(11)     | YES  |     | NULL    |                |
| city       | varchar(30) | YES  |     | NULL    |                |
| age        | int(11)     | YES  |     | NULL    |                |
| gender     | varchar(5)  | NO   |     | NULL    |                |
| email      | varchar(30) | NO   |     | NULL    |                |
+------------+-------------+------+-----+---------+----------------+

mysql> describe login;
+-----------+-------------+------+-----+-------------------+-----------------------------+
| Field     | Type        | Null | Key | Default           | Extra                       |
+-----------+-------------+------+-----+-------------------+-----------------------------+
| user_name | varchar(20) | NO   | PRI | NULL              |                             |
| password  | varchar(30) | YES  |     | NULL              |                             |
| level     | tinyint(1)  | YES  |     | NULL              |                             |
| logged_at | timestamp   | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
| status    | tinyint(1)  | YES  |     | NULL              |                             |
| sec_ques  | varchar(60) | YES  |     | NULL              |                             |
| answer    | varchar(30) | YES  |     | NULL              |                             |
+-----------+-------------+------+-----+-------------------+-----------------------------+

mysql> describe posts;
+-----------+-------------+------+-----+-------------------+-----------------------------+
| Field     | Type        | Null | Key | Default           | Extra                       |
+-----------+-------------+------+-----+-------------------+-----------------------------+
| post_id   | int(254)    | NO   | PRI | NULL              | auto_increment              |
| user_name | varchar(20) | YES  | MUL | NULL              |                             |
| title     | varchar(60) | YES  |     | NULL              |                             |
| content   | text        | YES  |     | NULL              |                             |
| post_cat  | varchar(30) | YES  |     | NULL              |                             |
| posted_at | timestamp   | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
+-----------+-------------+------+-----+-------------------+-----------------------------+

mysql> describe comments;
+---------------+-------------+------+-----+-------------------+-----------------------------+
| Field         | Type        | Null | Key | Default           | Extra                       |
+---------------+-------------+------+-----+-------------------+-----------------------------+
| c_id          | int(20)     | NO   | PRI | NULL              | auto_increment              |
| post_id       | int(254)    | YES  | MUL | NULL              |                             |
| who_commented | varchar(20) | YES  | MUL | NULL              |                             |
| comment       | text        | YES  |     | NULL              |                             |
| what_time     | timestamp   | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
+---------------+-------------+------+-----+-------------------+-----------------------------+
  <div class="pull-left">
                                    <a href="index.php?id=liked"
                                          data-placement="top"data-toggle="tooltip" title="Dislike">
                                            <span class="glyphicon glyphicon-thumbs-up"></span>
                                    </a>
                                    <a href="index.php?id=disliked" data-placement="top"
                                        data-toggle="tooltip" title="Dislike">
                                            <span class="glyphicon glyphicon-thumbs-down"></span>
                                    </a>
                                    <a href="index.php?id=more" data-placement="top"
                                        data-toggle="tooltip" title="Click to Comment">
                                         <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                            </div>
                         


                //// for super admin

      menu(id , tag_name, visible)
      tag_name=home, logout, login,register  

       user will be given a REG_NO for futher processing...        

      after submitting the reg form redirected to another page
      enter REG_NO given already.
      will open the signup form for login detials...

      
      he will give: username, password, name_of_blog,
                   security_question and answer,

      after submitting the signup form show 
            sucess message and link to home page.
      login as reg user by username and password






















*/?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<body>
<div class="container-fluid">
     <br><br><h1 >write your new post</h1>

      <form  method='post' action="new.php">
         <div class="form-group">
            <input required class="form-control" type="text" name='title' placeholder="Title"></input>
         </div>
   
         <div class="form-group">
            <textarea required name='content'class="form-control" placeholder="Write your text here"></textarea>
         </div>
            
            <input class="btn  btn-danger" type="submit" name="submit">
            <?php echo$sucess;?> </input>
    
      </form>
</div>
</body>
</html>








<?php
session_start();
require_once 'controllers/controllers.php';
require_once 'controllers/form_message.php';
//**********************************************CONTROLLERS ************************************

//for logged in user display his menu
//else public menu.
if(!isset($_SESSION['username'])){
    include 'master_templates/master_header.php';
    //disable features [like dislike comment]
    $disablelike=disable_feature();
    $disabledislike=disable_feature();
    $disablecomment=disable_feature();
}
else{
    //user is authentic enable all features[likes dislike comments]
      include 'master_templates/user_header.php';
      $disablelike="href=\"index.php?cat=liked&pid=\"";
     $disabledislike="href=\"index.php?cat=disliked&pid=\"";
     $disablecomment="href=\"index.php?cat=comment&pid=\"";
}
$output="";// used for displaying messages  
$comment=array();
 $comment_element="";
//http://localhost/Sites/myblog.com/index.php?cat=older&pid=58
 
//*******************controller for [likes dislikes and comments]*************************          
if(isset($_GET['cat']) and $_GET['cat']=='liked')
{
       //*********model*************************//      
    $result=user_liked_post($_SESSION['post_id'],$_SESSION['username']);
     //*********model*************************//
    echo $_GET['pid']=$_SESSION['post_id'];
    if($result){
        
        $output=display_sucess("post liked");
       //redirect("index.php?cat=&pid=");
    }
    else{
        $output=display_warning("error happend");
    }

}
elseif(isset($_GET['cat']) and $_GET['cat']=='disliked')
{
     //*********model*************************//
    $result=user_disliked_post($_SESSION['post_id'],$_SESSION['username']);
     //*********model*************************//
    echo $_GET['pid']=$_SESSION['post_id'];
    if($result){
        
        $output=display_sucess("post disliked");
       //redirect("index.php?cat=&pid=");
    }
    else{
        $output=display_warning("error happend");
    }

}
elseif( isset($_GET['cat']) and $_GET['cat']=='comment' ) {
           
           //look for comment post 
          if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['send']) ){

            $comment[]=(nl2br($_POST['comment']));
            $output=display_sucess($comment);

          } 
            $comment_element="";
             $comment_element.="<div class=\"col-md-8 pull-left\"><form  method=\"post\"
              action=\"index.php?cat=comment\">";
             $comment_element.="<div class=\"form-group\">";
             $comment_element.="<textarea  name=\"comment\"class=\"form-control\" autofocus placeholder=\"Enter Your Comment.\"></textarea>";
             $comment_element.="</div><div class=\"form-group\">";
             $comment_element.="<input value=\"Send\" name=\"send\"type=\"submit\"class=\"btn btn-primary\">";
             $comment_element.="</div></form ></div>"; 
           
}


//*******************controller for [older newer post query]*************************
if(isset($_GET['cat']) and $_GET['cat']=='older')
{
        // when older is clicked get older post than default post
     //*********model*************************//
        $row=get_older_post($_SESSION['post_id']);
         //*********model*************************//
        if(!$row){
            //means no oolder post 

            $output=display_sucess("No older post left");
        }
        //update the session variable with fetched post
        $_SESSION['post_id']=$row['post_id'];
   }
elseif(isset($_GET['cat']) and $_GET['cat']=='newer')
{
        // when newer is clicked get newer post than present post
        //*********model*************************//
        $row=get_newer_post($_SESSION['post_id']);
        //*********model*************************//
        if(!$row){
            //means no newer post 
            $output=display_sucess("No new post yet.");
            //$visible_older="<a href=\"\">";
        }
       //update the session variable with fetched post
        $_SESSION['post_id']=$row['post_id'];
}
else{    
        //user has not clicked older or newer
        // so display latest post
        //fetch posts from user posts table 
        $row=get_lastet_post();
        //update the session variable with fetched post
        $_SESSION['post_id']=$row['post_id'];
       
    }
    //else closed//

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
            <p> 
            <?php   echo $output;?></p>
        </h1>
        <!-- First Blog Post -->
        <h2>
            <a href="#"><?php echo $row['title'];?></a>
        </h2>
        <p class="lead">
            by <a  href="user_blog/index.php"><?php echo $row['user_name'];?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on</p>
        <hr>
        <p><?php echo $row['content'];?></p>
        <a class="btn btn-primary" href="index.php">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
        <blockquote>
       <p><?php foreach ($comment as $value) {
          echo $value;
       }?></p></blockquote>
        <br><hr>
        <div class="pull-left">
            <h4> 
                <tt><a <?php echo $disablelike?> 
                data-placement="top"data-toggle="tooltip" title="like">
                <span class="glyphicon glyphicon-thumbs-up"></span>
                </a></tt>
        
                <tt><a <?php echo $disabledislike?> data-placement="top"
                    data-toggle="tooltip" title="Dislike">
                <span class="glyphicon glyphicon-thumbs-down"></span>
                </a></tt>
               <tt> <a <?php echo $disablecomment?> data-placement="top"
                    data-toggle="tooltip" title="Click to Comment">
                <span class="glyphicon glyphicon-pencil"></span>
                </a></tt><tt></tt>

            </h4>
            </div>
        <p><?php echo $comment_element;?></p>
       
        <br>
        <!-- comment elements -->
        
        
 <div class="col-md-8">
        <!-- Pager -->
        <ul class="pager">
            <li class="previous">
                <a href="index.php?cat=older"> Older</a>
            </li>
            <li class="next">
                <a href="index.php?cat=newer">Newer &rarr;</a>
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








   

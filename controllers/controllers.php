<?php 

//disbale cooments and like features
function disable_feature(){
  $disable="";
  $disable="href=\"#\"";
  
  return $disable;  

}

//safe method for sql injections
function mysql_secure($string){
//connect to databse
    $conn= db_connect();
    $safe_string=mysqli_real_escape_string($conn,$string);

return $safe_string;
}
//db_conect
function db_connect(){
        $db_host="localhost";
        $db_user="user";
        $db_password="user123";
        $db_name="blog";

         $con = mysqli_connect( $db_host,$db_user,$db_password,$db_name);
         if (!$con){
            die('Could not connect: ' . mysqli_error());
          }
         else{
           // returns con variable with connection info sucess 
            return $con;
         }
}

//database connection and executes given query
///returns status of query
function connect($query){
        $db_host="localhost";
        $db_user="user";
        $db_password="user123";
        $db_name="blog";

         $con = mysqli_connect( $db_host,$db_user,$db_password,$db_name);
         if (!$con){
            die('Could not connect: ' . mysqli_error());
          }
         else{
           // $result = mysql_select_db("myblog", $con);
            $result = mysqli_query($con,$query);
         }
         mysqli_close($con);
         return $result;
      }

// display db errors 
function query_status($result){
      $status="";
      if(!$result){
         $status="Query not executed: " . mysql_error();   
      }
      else{
       
        $status="success";
        return $status;
      }
    
}
 
//register user informatio into database 
function register_user($new_user){

      
        $safe_first_name =mysql_secure($new_user['first_name']);
        $safe_last_name =mysql_secure($new_user['last_name']);
        $safe_city =mysql_secure($new_user['city']);
        $safe_email =mysql_secure($new_user['email']);
      
            $query="insert into register(first_name,last_name,
              phone_no,city,age,gender,email)
             values ('".$safe_first_name."','". $safe_last_name."',
                   '".$new_user['phone_no']."','".  $safe_city."',
                    '".$new_user['age']."','".$new_user['gender']."',
                    '".$safe_email."');";
       //execute query
        //$query1="insert into register(first_name) 
        //values('".$new_user['first_name']."')";
        $result=connect($query);
        //check query status
        if(!$result){echo "query not executed";die;}
        return query_status($result);
}
//redirect to a locaton
function redirect($value){
    
    header("Location:$value");
  } 
 /**
* handles the entire registration process. checks all error possibilities
* and creates a new user in the database if everything is fine
     */
function signup_validation()
    {
     
        $errors=array();

        if ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $errors[]= "Password and password repeat are not the same";
        } if (strlen($_POST['user_password_new']) < 6) {
            $errors[]= "Password has a minimum length of 6 characters";
        } if (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $errors[]= "Username cannot be shorter than 2 or longer than 64 characters";
        } if (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $errors[]= "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } if (strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
                
                $safe_user_name=mysql_secure($_POST['user_name']);
               // $user_name = strip_tags($_POST['user_name']);
                $user_password = $_POST['user_password_new'];
                //verify if username alrady exists
                $query = "SELECT * FROM login
                    WHERE user_name = '" . $safe_user_name . "'";
                     //execute query
                $result=connect($query);
                if($result){
                  $row=mysqli_num_rows($result);
                    if ($row == 1){
                    $errors[] = "Sorry, that username is already taken.";
                                }
                }
                else {
                echo  $status="Query not executed: " . mysql_error();
                die;   
                }

          } 
        return $errors;
}


function logged_in(){

  return isset($_SESSION['username']);
}


function confirm_logged_in(){
        if(!logged_in())
  return redirect('login.php');
}


 //logout finctoin
function logout(){
      session_destroy();
        redirect('../user_blog/index.php');
  } 
//

//register for validation function
function register_form_validation()
    {
                  $errors=array();

   
        if (strlen($_POST['first_name']) > 64 || strlen($_POST['first_name']) < 2) {
            $errors['fname_len']= "First Name cannot be shorter than 2 or longer than 64 characters";
        }

        if (strlen($_POST['last_name']) > 64 || strlen($_POST['last_name']) < 2) {
            $errors['lname_len']= "Last Name cannot be shorter than 2 or longer than 64 characters";
        }
        if (!preg_match('/^[1-9][0-9]*$/', $_POST['phone_no'])) {
            $errors['phone_no_format']= "Phone Number not valid ";
          }
          if (!preg_match('/^[2-9][0-9]*$/', $_POST['age'])) {
            $errors['age_format']= "Age not valid (Between 20-99 years) ";
          }
        if (!preg_match('/^[a-z]{2,20}$/i', $_POST['first_name'])) {
            $errors['fname_format']= "First Name does not fit the name scheme: 
            only a-Z and numbers are allowed,2 to 20 characters
            ";
        }
        if (!preg_match('/^[a-z]{2,20}$/i', $_POST['last_name'])) {
            $errors['lname_format']= "Last Name does not fit the name scheme: only a-Z and
             numbers are allowed, 2 to 20 characters";
        }
        if (strlen($_POST['first_name']) <= 64
            && strlen($_POST['first_name']) >= 2
            && strlen($_POST['last_name']) <= 64
            && strlen($_POST['last_name']) >= 2
            && preg_match('/^[2-9][0-9]*$/', $_POST['age'])
            && preg_match('/^[1-9][0-9]*$/', $_POST['phone_no'])
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['first_name'])
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['last_name'])
        ){
           
          //no errors is found
          // all validations passed
          }
          // return errors if any
          return $errors;
}          

//post controller
//return post array
function fetch_post_public(){           
global $output,$comments,$row;
 //$row=array();
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
          elseif(isset($_GET['pid']) and $_GET['pid']==$_SESSION['post_id'])
          {// user has clicked submitted comment
            if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['send']) )
                {
                    $comments=mysql_secure(nl2br($_POST['comment']));
                   $row=submit_comment($_SESSION['post_id'],$_SESSION['username'],$comments);
                    if($row){
                            $row=get_this_post($_SESSION['post_id']);
                            $_SESSION['post_id']=$row['post_id'];
                           //update get[pid] to stay on this post after commented
                           $output=display_sucess("comment posted.");
                          
                        }
                    else{
                            $output=display_warning("error happend");
                          }
                  
                  }
            }
            else{
                    //to look if [like comment dislike  was made on post]
                    //if that has happened then stay on that post very
                    //else display the latest post
                    if(!isset($_GET['pid'])){
                    //fetch posts from user posts table 
                    $row=get_latest_post();
                    //update the session variable with fetched post
                    $_SESSION['post_id']=$row['post_id'];}
                 
                    
                  }
return $row;               
}


//post controller
//return post array
function fetch_post_user_profile($post_id,$user_name){           
global $output,$comments,$row;
              if(isset($_GET['cat']) and $_GET['cat']=='older')
              {
                  // when older is clicked get older post than default post
                   //*********model*************************//
                  $row=get_user_older_post($post_id,$user_name);
                  if(!$row){
                      //means no older post 
                      $output=display_sucess("No older post left");
                  }
                  //update the session variable with fetched post
                  $_SESSION['post_id']=$row['post_id'];
                  
              }
              elseif(isset($_GET['cat']) and $_GET['cat']=='newer')
              {
                   // when newer is clicked get newer post than present post
                      //*********model*************************//
                  $row=get_user_newer_post($post_id,$user_name);
                  if(!$row){
                      //means no oolder post 
                      $output=display_sucess("No new post yet.");
                  }
                  //update the session variable with fetched post
                  $_SESSION['post_id']=$row['post_id'];

              }
              elseif(isset($_GET['pid']) and $_GET['pid']==$_SESSION['post_id'])
                    {// user has clicked submitted comment
                        if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['send']) )
                          {
                            $comments=mysql_secure(nl2br($_POST['comment']));
                           $row=submit_comment($_SESSION['post_id'],$_SESSION['username'],$comments);
                            if($row){
                                    $row=get_this_post_user($_SESSION['post_id'],$_SESSION['username']);
                                    $_SESSION['post_id']=$row['post_id'];
                                   //update get[pid] to stay on this post after commented
                                   $output=display_sucess("comment posted.");
                                  
                                }
                            else{
                                    $output=display_warning("error happend");
                                  }
                          
                       }
                  }
                  else{
                            //to look if [like comment dislike  was made on post]
                            //if that has happened then stay on that post very
                            //else display the latest post
                            if(!isset($_GET['pid'])){
                            //fetch posts from user posts table 
                           //user has not clicked older or newer
                           // so display latest post
                            //fetch posts from user posts table 
                          $row=get_user_latest_post($user_name);
                          //update the session variable with fetched post
                          $_SESSION['post_id']=$row['post_id'];}
                           
                      }
return $row;               
}



//display older post then present post 
//for public home page
//return post arrray
function get_older_post($post_id){
                    
      $query="SELECT * FROM posts  where 
      post_id <'".$post_id."'ORDER BY post_id DESC";
      $result=connect($query);
      $row=mysqli_fetch_assoc($result);
      return $row;

} 

//display newer post then present post 
//for public home page
//return post arrray
function get_newer_post($post_id){
                        
    $query="SELECT * FROM posts  where
    post_id >'".$post_id."'ORDER BY post_id ASC ";
    $result=connect($query);
    $row=mysqli_fetch_assoc($result);
    return $row;

}


//display latest post  
//for public home page
//return post array
function get_latest_post(){
                        
    $query="SELECT * FROM posts ORDER BY post_id DESC LIMIT 1";
    $result=connect($query);
    $row=mysqli_fetch_assoc($result); 
    return $row;
}

//display latest post  
//for user home page
//return post array
function get_user_latest_post($user_name){
                        
    $query="SELECT * FROM posts where user_name ='{$user_name}'
    ORDER BY post_id DESC ";
    $result=connect($query);
    $row=mysqli_fetch_assoc($result); 
    return $row;
}


//display older post then present post 
//for user home page
//return post arrray
function get_user_older_post($post_id,$user_name){
                        
    $query="SELECT * FROM posts  where user_name ='{$user_name}'
        and post_id <'".$post_id."'ORDER BY post_id DESC";
    $result=connect($query);
    $row=mysqli_fetch_assoc($result);
    return $row;
}

//display newer post then present post 
//for user home page
//return post arrray
function get_user_newer_post($post_id,$user_name){
                        
    $query="SELECT * FROM posts  where user_name ='{$user_name}'
        and post_id >'".$post_id."'ORDER BY post_id ASC";
    $result=connect($query);
    $row=mysqli_fetch_assoc($result);
    return $row;
}
function if_disliked($post_id,$user_name,$dislike){

      
    $query="SELECT  who_disliked,post_id,status FROM  likes where who_disliked='".$user_name."'
        and post_id ='".$post_id."' and status ='".$dislike."' LIMIT 1";
    $result=connect($query);
    $row=mysqli_num_rows($result);
    if($row)
    return $row;
    else return null;

}
function if_liked($post_id,$user_name,$like){

    $query="SELECT who_liked,post_id,status  FROM likes  where who_liked ='".$user_name."'
    and post_id ='".$post_id."' and status = '".$like."'LIMIT 1"; 
    $result=connect($query);
    $row=mysqli_num_rows($result);
    if($row)
    return $row;
    else return null;

}



//like_dislike controller
function reg_like_dislike_index($post_id){
global $output;
   $row=array();
            if(isset($_GET['cat']) and $_GET['cat']=='liked')
                {
                    $like=1;
                    $dislike=0;
                    $result=if_disliked($post_id,$_SESSION['username'],$dislike);
                     if($result)
                      {
                          //already disliked
                          //user wnats to like this post and remove dislike
                           $query="DELETE  FROM likes  where who_disliked ='".$_SESSION['username']."'
                            and post_id ='".$post_id."' and status = '".$dislike."' LIMIT 1";
                           $result=connect($query);
                           //if not
                           if(!$result){
                             $output=display_sucess("not deleted in likes");
                                }
                      }       
                      //like this post
                      //user wnats to like this post and remove dislike
                      $result=if_liked($post_id,$_SESSION['username'],$like);
                    if(!$result)
                      {
                          //if not already liked
                          //like this post and mark liked  
                  
                          $result=user_liked_post($post_id,$_SESSION['username'],$like);
                          if($result){
                                $row=get_this_post($post_id);
                                 $_SESSION['post_id']=$row['post_id'];
                                //update get[pid] to stay on this post after liked
                                $_GET['pid']=$_SESSION['post_id'];
                                $output=display_sucess("Post Liked.");
                        
                            }
                            else{
                                  $output=display_warning("not liked likes");
                            }

                              
                      }   
                      else{
                             
                                 $row=get_this_post($post_id);
                                 $_SESSION['post_id']=$row['post_id'];
                                //update get[pid] to stay on this post after liked
                                $_GET['pid']=$_SESSION['post_id'];
                                $output=display_warning("Already Liked.");
                           }
                                 
                }
                elseif(isset($_GET['cat']) and $_GET['cat']=='disliked')
                {
                         
                          $like=1;
                          $dislike=0;
                          $result=if_liked($post_id,$_SESSION['username'],$like);
                         if($result)
                             {
                                //already disliked
                                //user wnats to like this post and remove dislike
                                 $query="DELETE  FROM likes  where who_liked ='".$_SESSION['username']."'
                                  and post_id ='".$post_id."' and status = '".$like."' LIMIT 1";
                                 $result=connect($query);
                                 //if not
                                 if(!$result){
                                   $output=display_sucess("not deleted in likes");
                                      }
                              } 

                               //dislike this post
                            $result=if_disliked($post_id,$_SESSION['username'],$dislike);
                            if(!$result)
                              {
                                    //if not already disliked
                                    //dislike this post and mark diskliked  
                                    $result=user_disliked_post($post_id,$_SESSION['username'],$dislike);
                                    if($result){
                                          $row=get_this_post($post_id);
                                           $_SESSION['post_id']=$row['post_id'];
                                          //update get[pid] to stay on this post after liked
                                          $_GET['pid']=$_SESSION['post_id'];
                                          $output=display_sucess("Post Disliked.");
                                  
                                      }
                                      else{
                                            $output=display_warning("not disliked likes");
                                      }

                                        
                              } 
                              else{
                                 
                                      $row=get_this_post($post_id);
                                      $_SESSION['post_id']=$row['post_id'];
                                      //update get[pid] to stay on this post after liked
                                      $_GET['pid']=$_SESSION['post_id'];
                                      $output=display_warning("Already Disliked.");
                                  }  
                }
return $row;
}

//like_dislike controller
function reg_like_dislike_profile($post_id){
global $output;
   $row=array();
            if(isset($_GET['cat']) and $_GET['cat']=='liked')
                {
                            $like=1;
                          $dislike=0;
                          $result=if_disliked($post_id,$_SESSION['username'],$dislike);
                           if($result)
                            {
                                //already disliked
                                //user wnats to like this post and remove dislike
                                 $query="DELETE  FROM likes  where who_disliked ='".$_SESSION['username']."'
                                  and post_id ='".$post_id."' and status = '".$dislike."' LIMIT 1";
                                 $result=connect($query);
                                 //if not
                                 if(!$result){
                                   $output=display_sucess("not deleted in likes");
                                      }
                            }  
                             //like this post
                            //user wnats to like this post and remove dislike
                            $result=if_liked($post_id,$_SESSION['username'],$like);
                          if(!$result)
                            {
                                //if not already liked
                                //like this post and mark liked  
                        
                                $result=user_liked_post($post_id,$_SESSION['username'],$like);
                                if($result){
                                      $row=get_this_post_user($post_id,$_SESSION['username']);
                                       $_SESSION['post_id']=$row['post_id'];
                                      //update get[pid] to stay on this post after liked
                                      $_GET['pid']=$_SESSION['post_id'];
                                      $output=display_sucess("Post Liked.");
                              
                                  }
                                  else{
                                        $output=display_warning("not liked likes");
                                  }

                                    
                            }   
                            else{
                                   
                                       $row=get_this_post_user($post_id,$_SESSION['username']);
                                       $_SESSION['post_id']=$row['post_id'];
                                      //update get[pid] to stay on this post after liked
                                      $_GET['pid']=$_SESSION['post_id'];
                                      $output=display_warning("Already Liked.");
                                 }

                   
                }
               elseif(isset($_GET['cat']) and $_GET['cat']=='disliked')
                {
                       $like=1;
                      $dislike=0;
                      $result=if_liked($post_id,$_SESSION['username'],$like);
                     if($result)
                         {
                            //already disliked
                            //user wnats to like this post and remove dislike
                             $query="DELETE  FROM likes  where who_liked ='".$_SESSION['username']."'
                              and post_id ='".$post_id."' and status = '".$like."' LIMIT 1";
                             $result=connect($query);
                             //if not
                             if(!$result){
                               $output=display_sucess("not deleted in likes");
                                  }
                          } 

                           //dislike this post
                        $result=if_disliked($post_id,$_SESSION['username'],$dislike);
                        if(!$result)
                          {
                                //if not already disliked
                                //dislike this post and mark diskliked  
                                $result=user_disliked_post($post_id,$_SESSION['username'],$dislike);
                                if($result){
                                       $row=get_this_post_user($post_id,$_SESSION['username']);
                                       $_SESSION['post_id']=$row['post_id'];
                                      //update get[pid] to stay on this post after liked
                                      $_GET['pid']=$_SESSION['post_id'];
                                      $output=display_sucess("Post Disliked.");
                              
                                  }
                                  else{
                                        $output=display_warning("not disliked likes");
                                  }

                                    
                          } 
                          else{
                             
                                  $row=get_this_post_user($post_id,$_SESSION['username']);
                                  $_SESSION['post_id']=$row['post_id'];
                                  //update get[pid] to stay on this post after liked
                                  $_GET['pid']=$_SESSION['post_id'];
                                  $output=display_warning("Already Disliked.");
                              }  

                }
return $row;
}


function total_likes($post_id){
      $like=1;
    $query="SELECT post_id,status  FROM likes  where 
    post_id ='".$post_id."' and status = '".$like."'"; 
    $result=connect($query);
    $row=mysqli_num_rows($result);
    if($row)
    return $row;
    else return null;


}

function total_dislikes($post_id){
      $dislike=0;
    $query="SELECT post_id, status  FROM likes  where 
    post_id ='".$post_id."' and status = '".$dislike."'"; 
    $result=connect($query);
    $row=mysqli_num_rows($result);
    if($row)
    return $row;
    else return null;


}
//inserts like attribute on a post
//takes 2 arguments POSTID and USERNAME
// returns true or false
function user_liked_post($post_id,$user_name,$status){

        $query="INSERT INTO likes(post_id,who_liked,status) 
       VALUES('".$post_id."','".$user_name."','".$status."')";
         $result=connect($query);
         if($result)
          {
            return $result;
          }
          else {
            $result=null;
          }
  }


//inserts like attribute on a post
//takes 2 arguments POSTID and USERNAME
// returns true or false
function user_disliked_post($post_id,$user_name,$status){

        $query="INSERT INTO likes(post_id,who_disliked,status) 
       VALUES('".$post_id."','".$user_name."','".$status."')";
         $result=connect($query);
         if($result)
          {
            return $result;
          }
          else {
            $result=null;
          }
  } 


//inserts like attribute on a post
//takes 2 arguments POSTID and USERNAME
// returns true or false
 // submit_comment($_SESSION['post_id'],$_SESSION['username'],$comments);
  function submit_comment($post_id,$user_name,$comment){

        $query="INSERT INTO comments(post_id,who_commented,comment ) 
       VALUES('".$post_id."','".$user_name."','".$comment."')";
         $result=connect($query);
         if($result)
          {
            return $result;
          }
          else {
            $result=null;
          }
  } 



//display latest 5 comments
//for public home page
//return post array
function get_latest_comments($post_id){
                        
    $query="SELECT who_commented,comment ,c_id FROM comments 
    WHERE post_id ='".$post_id."' ORDER BY c_id DESC LIMIT 2";
    $result=connect($query);
    if($result)
          {
            //$row=mysqli_fetch_assoc($result);
            //if($row){


            return $result;}
            else {
             echo"no lstest comment"; 
                }
          //}
          //else {
          //  return null;
         // }
    
}
function get_previous_comments($post_id,$c_id){
                        
    $query="SELECT who_commented,comment,c_id FROM comments 
    WHERE post_id ='".$post_id."' and c_id < '".$c_id."' ORDER BY c_id DESC LIMIT 1";
    $result=connect($query);
    if($result)
          {
           //$row=mysqli_fetch_assoc($result);
            //if($row){


            return $result;}
            else {
             echo"no previous comment"; die;
                }
         // }
          //else {
           //   echo" quer not executed"; die;
          //}
    
}
function get_new_comments($post_id,$c_id){
                        
    $query="SELECT who_commented,comment,c_id FROM comments 
    WHERE post_id ='".$post_id."' and c_id > '".$c_id."' ORDER BY c_id ASC LIMIT 1 ";
    $result=connect($query);
    if($result)
          {
            //$row=mysqli_fetch_assoc($result);
            //if($row){
            //$row=mysqli_fetch_assoc($result);
            //if($row){


            return $result;}
            else {
             echo"no new comment"; die;
                }
         // }
         // else {
        //       echo" quer not executed"; die;
         // }
    
}
function comments_controller($post_id,$c_id){
global $output;
  if(isset($_GET['view']) and $_GET['view']=='previouscomments')
      {

            // when previous  is clicked get previous comments than default 
            $row=get_previous_comments($post_id,$c_id);
            if(!$row){
                  //means no older comments 
                  $output=display_sucess("No older comments left");
              }
            
          //$_SESSION['c_id']=$row['c_id']; 
      }
      elseif (isset($_GET['view']) and $_GET['view']=='newcomments')
      {

              $row=get_new_comments($post_id,$c_id);
              if(!$row){
                  //means no older comment
                  $output=display_sucess("No newer comments left");
              }
              
                //$row=mysqli_fetch_assoc($row);
                //$_SESSION['c_id']=$row['c_id'];
               //return $row;
              
      }

return $row;
}
  //get this post
  //given [post_id] returns post array
  function get_this_post_user($post_id,$user_name){
                    
      $query="SELECT * FROM posts  where 
      post_id ='".$post_id."' and user_name ='".$user_name."'LIMIT 1";
      $result=connect($query);
      $row=mysqli_fetch_assoc($result);
      return $row;

} 
  //get this post
  //given [post_id] returns post array
  function get_this_post($post_id){
                    
      $query="SELECT * FROM posts  where 
      post_id ='".$post_id."' LIMIT 1";
      $result=connect($query);
      $row=mysqli_fetch_assoc($result);
      return $row;

}    



?>
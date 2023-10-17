<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Code Convo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <?php
    include 'partials/_dbconnect.php';
    include 'partials/_nav.php';
    ?>

    <?php
     $id=$_GET['threadid'];
     $sql="SELECT * FROM `threadss` WHERE thread_id=$id";
     $result=mysqli_query($conn,$sql);
     while($row=mysqli_fetch_assoc($result)){
         $title=$row['thread_title'];
         $desc=$row['thread_desc'];
     }
    
    ?>

    <?php
    $showalert=false;
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $comment_text=$_POST['cmttext'];
        // To prevent from XSS attack
        
        // if someone comment like <script>alert("lol")</script> then this javascript will
        // execute in our project so to prevent it from these XSS attack we replace these comment
        // like < and > .
        $comment_text=str_replace("<","&lt;",$comment_text);
        $comment_text=str_replace(">","&gt;",$comment_text);
        
        $sql="INSERT INTO `comments` ( `comment_desc`, `thread_id`, `cmt_time`, `comment_by`) VALUES ('$comment_text', '$id', current_timestamp(), '0')";
        $result=mysqli_query($conn,$sql);
        $showalert=true;
    }
    if($showalert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>Your Comment has been posted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>


    <div class="container">
        <div class="jumbotron my-3">
            <h3 class="display-10"><?php echo $title?></h3>
            <p class="lead"><?php echo $desc?></p>
            <hr class="my-4">
        </div>
    </div>
    <div class="container">
        <h3>Add Comment:</h3>
    </div>

    <div class="container my-4">
        <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
            <div class="form-floating">
                <textarea class="form-control" placeholder="Add Commments" id="cmttext" name="cmttext"></textarea>
                <label for="floatingTextarea">Comments</label>
            </div>
            <button type="submit" class="btn btn-success my-3">Comment</button>
        </form>
    </div>
    <!-- Start of Fetching comments from database -->
    <div class="container">
        <h3>Comments</h3>
    </div>
    <div class="container">
        <?php
         $id=$_GET['threadid'];
         $sql="SELECT * FROM `comments` WHERE thread_id=$id";
         $result=mysqli_query($conn,$sql);
         $commentpresence=false;
         while($row=mysqli_fetch_assoc($result)){
             $commentpresence=true;
             $id=$row['comment_id'];
             $content=$row['comment_desc'];
             $comment_time=$row['cmt_time'];
             

      echo'<div class="media my-3">
            <img src="img/userimg.png" width="50px" class="mr-3" alt="...">
             <div class="media-body">
             <h5 class="mt-0">User at '.$comment_time.'</h5>
                <p class="py-0">'.$content.'</p>
            </div>
        </div>';
        
    }
    if(!$commentpresence){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1>No Comments Here</h1>
        </div>
      </div>';
    }
        ?>
    </div>
    <!-- ENd of Fetching comments from database -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
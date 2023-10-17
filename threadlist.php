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
     $id=$_GET['catid'];
     $sql="SELECT * FROM `codeconvotb` WHERE category_id=$id";
     $result=mysqli_query($conn,$sql);
     while($row=mysqli_fetch_assoc($result)){
         $cattitle=$row['category_name'];
         $catdesc=$row['category_desc'];
     }
    
    ?>

    <?php
    $showalert=false;
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $th_title=$_POST['querytitle'];
        $th_desc=$_POST['querydesc'];
        $sql="INSERT INTO `threadss` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '0', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $showalert=true;
    }
    if($showalert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>Your question has been placed successfully.Please Wait till someone from community respond you with answer
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>

    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $cattitle?> forum</h1>
            <p class="lead"><?php echo $catdesc?></p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums.Do not post copyright-material.Do not post “offensive”
                posts, links or images.Do not cross post questions.Do not PM users asking for help.Remain respectful of
                other members at all times.</p>
        </div>
    </div>
    <h3 class="my-4 text-center">Ask Here:</h3>
    <div class="container">
        <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
            <div class="mb-3">
                <label for="text" class="form-label">Question title</label>
                <input type="text" class="form-control" id="querytitle" name="querytitle" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Try to keep your title more concern</div>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Elaborate your question" id="querydesc"
                    name="querydesc"></textarea>
                <label for="floatingTextarea">Comments</label>
            </div>
            <button type="submit" class="btn btn-success my-3">Ask</button>
        </form>
    </div>
    <h3 class="my-4 text-center">Browse Questions</h3>
    <div class="container">
        <?php
         $id=$_GET['catid'];
         $sql="SELECT * FROM `threadss` WHERE thread_cat_id=$id";
         $result=mysqli_query($conn,$sql);
         $questionpresence=true;
         while($row=mysqli_fetch_assoc($result)){
             $questionpresence=false;
             $id=$row['thread_id'];
             $title=$row['thread_title'];
             $desc=$row['thread_desc'];

             if($questionpresence){
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">No Questions Here</h1>
                  <p class="lead">Be the first one to add questions.</p>
                </div>
              </div>';
            }
      echo'<div class="media my-3">
            <img src="img/userimg.png" width="50px" class="mr-3" alt="...">
             <div class="media-body">
                <h5 class="mt-0"><a href="thread.php?threadid='.$id.'">'. $title.'</a></h5>
                <p>'. substr($desc,0,300).' . . . . . . . .</p>
            </div>
        </div>';

        
    }
        ?>
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
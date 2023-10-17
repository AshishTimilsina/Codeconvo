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

    <div class="container">
        <h1>Search Results for <em>"<?php echo substr($_GET['search'],0,50)?>........"</em></h1>
        <div class="result">
            <?php
            $query=$_GET['search'];
            $sql="SELECT * FROM threadss WHERE MATCH(thread_title, thread_desc) AGAINST ('$query')";
            $result=mysqli_query($conn,$sql);
            $noresult=true;
            while($row=mysqli_fetch_assoc($result)){
                $noresult=false;
                $thread_id=$row['thread_id'];
                $thread_title=$row['thread_title'];
                $thread_desc=$row['thread_desc'];
                echo'<h3><a href="/forumProject/thread.php?threadid='.$thread_id.'" class="text-dark">'.$thread_title.'</a> </h3>
                <p>'.substr($thread_desc,0,350).'. . . . . . . </p>';
            }
            if($noresult){
                echo'<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-6">No results containing all your search terms were found.</h1>
                  <p class="lead">Your search : '.substr($_GET['search'],0,50).'....... - did not match any documents.
                  </p>

                  <h4>Suggestions:</h4>
                  <p class="lead"><ul>
                  <li>Make sure that all words are spelled correctly.</li>
                  <li>Try different keywords.</li>
                  <li>Try more general keywords.</li>
                  <li>Try fewer keywords.</li>
                  </ul></p>
                </div>
              </div>';
            }
            ?>

        </div>
    </div>


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
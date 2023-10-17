<!-- Modal -->
<?php
include '_dbconnect.php'; 

if($_SERVER['REQUEST_METHOD']=="POST"){
    $userloginEmail=$_POST['loginemail'];
    $userPass=$_POST['userPass'];

    $sql="SELECT * FROM `user` WHERE userEmail='$userloginEmail'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        while($row=mysqli_fetch_assoc($result)){
            $phash= $row['userPass'];
            echo var_dump(password_verify($_POST['userPass'],$phash));
            echo "inside while loop";
            if(password_verify($userPass,$phash)){
                echo "inside if statement";
                $login=true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$userloginEmail;
                header("location: index.php");      
            }
            else{
                echo " no while loop";
                $showError=true;
            } 
        }
    }
    else{
        echo "no";
        $showError=true;
      }
}

?>
<?php
if($login){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong>   Logged in Succesfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
if($showError){
      echo' <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong>   Invalid Credentials
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

?>
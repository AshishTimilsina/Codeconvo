<?php
include '_dbconnect.php';

$showAlert=false;
$showError=false;
if($_SERVER['REQUEST_METHOD']=="POST"){
    $user_email=$_POST['useremail'];
    $user_pass=$_POST['userpass'];
    $user_confirmPass=$_POST['usercpass'];

    $userexist="SELECT * FROM `user` WHERE userEmail='$user_email'";
    $result=mysqli_query($conn,$userexist);
    $numrowExist=mysqli_num_rows($result);
    if($numrowExist>0){
        $showError="Username Already Exists.Try other username";
    }
    else{
        if($user_pass==$user_confirmPass){
            $hashpassword=password_hash($user_pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `user` (`userEmail`, `userPass`) VALUES ( '$user_email', '$hashpassword')";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showAlert=true;
            }
            
        }
        else{
            $showError="Password Don't Match";
        }
        
    }
}


?>

<?php
    if($showAlert){
    echo'  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong>   Account created Successfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($showError){
      echo'  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong>'. $showError.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }    
    ?>
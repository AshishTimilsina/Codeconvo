<!-- Modal -->
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

<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="signupModalLabel">Signup Here</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="useremail" name="useremail"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userpass" name="userpass">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="usercpass" name="usercpass">
                    </div>
                    <button type="submit" class="btn btn-primary">SignUp</button>
                </form>
            </div>

        </div>
    </div>
</div>
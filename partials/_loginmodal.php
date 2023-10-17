<!-- Modal -->
<?php
include '_dbconnect.php'; 

$showError=false;
$login=false;
if($_SERVER['REQUEST_METHOD']=="post"){
    $userloginEmail=$_POST['loginemail'];
    $userPass=$_POST['userPass'];

    $sql="SELECT * FROM `user` WHERE userEmail='$userloginEmail'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        while($row=mysqli_fetch_assoc($result)){
            if(password_verify($userPass,$row['userPass'])){
                $login=true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$userloginEmail;
                header("location: index.php");      
                echo "yes";

            }
            else{
                echo "no";
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
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModalLabel">Login Here</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/forumProject/partials/_handlelogin.php" method="post">
                    <div class="mb-3">
                        <label for="loginemail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="loginemail" name="loginemail"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="userPass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userPass" name="userPass">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
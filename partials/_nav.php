<?php
include '_dbconnect.php';
echo '<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">CodeConvo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Category
          </a>
          <ul class="dropdown-menu">';

          $sql="SELECT category_name,category_id FROM `codeconvotb` LIMIT 3";
          $result=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_assoc($result)){
        echo'
            <li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
          }
          echo'</ul>
          </li>
        
         <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Contact</a>
        </li>
      </ul>

      <div class="row mx-2">
      <form class="d-flex" role="search" method="get" action="search.php">
        <input class="form-control me-2" name="search" id="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
    </form>
</div>
<button type="button" class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
  Login
</button>
<button type="button" class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#signupModal">
  Signup
</button>
    </div>
  </div>
</nav>';
include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';

?>
<?php
session_start();

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id = $_POST['id']; 
    $error="";
    //Govt Credentials
    $setemail="admin@gmail.com";
    $setid="2005072";
    $setpassword="admin@123";
    if ( ($setemail == $email) && ( $setid == $id)  && ( $setpassword== $password))
    {
            // Set session variables for logged-in user
            $_SESSION['govt_id'] = $setid;
            
            // Redirect to Govt dashboard
            header('location: Govt.php');
            exit();
    }
    else 
    { 
        $error = "Incorrect Credentials";
    }            
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Govt Login Form</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Poppins:wght@200&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css" />

    <style>
      body {
      
        background-color: white;
        
       
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark  px-5 py-2  fixed-top"
    style="background-color:indigo;">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-2">
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php">LAND REGISTERY</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="govtlogin.php">GOVERNMENT LOGIN</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div
      class="container pt-5"
      style="width: 40%; position: absolute; top: 20%; left: 30%; right: 30%"
    >
    
    
      <form
        action=""
        method="post"
        class="p-3 rounded-1 bg-light shadow-lg"
        
      >
      <?php if (isset($error))
    {
      ?> 
      <div class="alert alert-danger alert-dismissible mb-2 "
      
      style="padding-top:8px;
      padding-bottom:8px;
      " role="alert">
        <?php
        echo $error;
        ?>
      <button type="button" class="btn-close pt-1"
      data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php 
    }
    ?>
        <div class="form-group py-1">
          <input
            type="email"
            class="form-control"
            name="email"
            placeholder="Enter your email"
            required
          />
        </div>
        <div class="form-group py-1">
          <input
            type="text"
            class="form-control"
            name="id"
            placeholder="Enter your ID"
            required
          />
        </div>
        <div class="form-group py-1">
          <input
            type="password"
            class="form-control"
            name="password"
            placeholder="Enter Password"
            required
          />
        </div>

        <div class="form-btn mt-2">
          <input
            type="submit"
            value="Login"
            name="login"
            class="btn btn-primary rounded-1"
          />
        </div>
      </form>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z8Mwl8i6Z6E+0CK3ZHp3t4urp4flFk2ivT5hXf"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

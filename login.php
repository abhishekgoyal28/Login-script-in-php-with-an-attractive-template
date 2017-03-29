<?php




   include("config.php");
   session_start();
   


   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $email = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id , isActive FROM participants WHERE email = '$email' and password= '$mypassword'";

      $retval = $db->query($sql);

      $row = $retval->fetch_assoc();

      $active = $row["isActive"];
      
      $count = $retval->num_rows;

     
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1 ) {
         $_SESSION['login_user'] = $email;
         
         header("location: welcome.php");
      }else {if($count == 1) {
        echo "Please confirm your account first.";
         
      }else{
        echo "Your Login Name or Password is invalid";
      }
    }
   }
?>



<head>
  <meta charset="UTF-8">
  <title>Register Form</title>
  <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <div class="content">
  
  <div class="wrapper">
    
  <div class="register--content">
    
    <div class="login--button">
    <span>If you have an   account</span>
      <a class="btn" data-popup-open="register-popup" href="#">Login</a>
    </div>
    
     <h1>Create a new account</h1>
    <div class="social">
      <a href=""><span class="facebook-icon"><i class="fa fa-facebook"></i></span>Register with <strong>Facebook</strong></a>
    </div>
    
    <div class="via-email">
      <span>or via email</span>
    </div>
    
    <div class="name">
  <input name="name" type="text" class="inputText" required/>
  <span class="floating-label">Your name</span>
</div>
    
  <div class="email">
  <input name="email" type="text" class="inputText" required/>
  <span class="floating-label">Your email</span>
</div>

<div class="password">
  <input name="password" type="text" class="inputText" required/>
  <span class="floating-label">Your password</span>
</div>

    <input type="submit" class="register-buttton" value="Sign Up" name="register">
    </div>  
    
    
    
    
  <div class="login--content">
    
    <div class="login--button">
    <span>Create a new  account</span>
      <a class="btn-reg" data-popup-open="register-popup" href="#">Sign up</a>
    </div>
    <h1>Login to your account</h1>
    <div class="social">
      <a href=""><span class="facebook-icon"><i class="fa fa-facebook"></i></span>Login with <strong>Facebook</strong></a>
    </div>
    
    <div class="via-email">
      <span>or via email</span>
    </div>
    
<form action="" method="post">    
    <div class="email">
  <input name="email" type="text" class="inputText" required/>
  <span class="floating-label">Your email</span>
</div>

<div class="password">
  <input name="password" type="text" class="inputText" required/>
  <span class="floating-label">Your password</span>
</div>
    <span>Reset your pasword</span>

    <input type="submit" class="register-buttton" value="Login" name="Login">
      </form>
    </div>
  
  </div>
  
  <div class="registred">
    <h1>Great Job</h1>
    <button class="reset">Reset</button>
  </div>
  
  
</div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
		


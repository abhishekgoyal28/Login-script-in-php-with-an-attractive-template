<?php

   include("config.php");
   session_start();  
   require 'PHPMailerAutoload.php';


$state = 0;

if($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["Login"])) {
      
      $email = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id , isActive FROM participants WHERE email = '$email' and password = '$mypassword'";

      $retval = $db->query($sql);

      $row = $retval->fetch_assoc();

      $active = $row["isActive"];
      
      $count = $retval->num_rows;

     
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1 ) {
         $_SESSION['login_user'] = $email;
         
         header("location: index.html");
      }else {if($count == 1) {
        echo "Please confirm your account first.";
         
      }else{
        echo "Your Login Name or Password is invalid";
      }
    }
   }




if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["register"])){

  $state = 1;
  $name = mysqli_real_escape_string($db,$_POST['name']);
  $phone = mysqli_real_escape_string($db,$_POST['phone']);
  $email = mysqli_real_escape_string($db,$_POST['email']);
  $institute = mysqli_real_escape_string($db,$_POST['institute']);
  $password = mysqli_real_escape_string($db,$_POST['password']);
       
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  } 

  $sql = 'INSERT INTO participants '.'( name, email, phone, institute, password ) '.'VALUES ("' . $name . '","' . $email . '","' . $phone . '","' . $institute . '","' . $password . '")';


  if ($db->query($sql) === TRUE) {
      

   $sql = 'SELECT id  FROM participants WHERE email = "'.$email.'"';
   
   $retval = $db->query($sql);

   if ($retval->num_rows == 1) {
      while($row = $retval->fetch_assoc()) {
          $id = $row["id"];


          $confirm = "";
          for($i=0;$i<10;$i++){
            $confirm .= mt_rand(1,9);
          
            }

          
 
          


          $confirmlink = "localhost";

          
         // $sql = 'UPDATE participants SET isActive ="'.$confirm.'" , password = "'.$pass[0].'" WHERE id = "'.$id.'"';

         // if ($db->query($sql) === TRUE) {

        //  }else{

         //     echo "Email not valid or try again later.";
          //    exit();

          //}


          $mail = new PHPMailer;

          //$mail->SMTPDebug = 3;                               // Enable verbose debug output
          $mail->Host = "smtp.gmail.com";                      // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = 'engg.ankit1103@gmail.com';                 // SMTP username
          $mail->Password = '0d0e0v0i0l';                           // SMTP password
          $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 587;                                    // TCP port to connect to

          $mail->setFrom('engg.ankit1103@gmail.com', 'Reflux');
          $mail->addAddress($email, $name);     // Add a recipient
          

          $mail->Subject = 'Reflux : Confirmation Link';
          $mail->Body    = 'Please follow this link to confirm your account for reflux quiz. '. $confirmlink.' Once confirmed login with email: '.$email;

          if(!$mail->send()) {
              echo "$email";
              echo 'Message could not be sent.';
              echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else {
             echo "Confirmation Mail is send to your account. Confirm your account.";
            exit();
          }


          
        }

  }}else {
    echo "Email Already Registered or Error in Connection. Please try Again.";
    exit();
  }


  if($state == 2){
    echo "Account Registration failed";
    exit();
  }
  $db->close();

  exit();

}


 


?>








<html >
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

	<form action="" method="post">
			
		<div class="name">
		  <input name="name" type="text" class="inputText" required/>
		  <span class="floating-label">Your name</span>
		</div>
				
		<div class="email">
		  <input name="email" type="email" class="inputText" required/>
		  <span class="floating-label">Your email</span>
		</div>

		<div class="password">
		  <input name="password" id="password" type="password" class="inputText" required/>
		  <span class="floating-label">Your password</span>
		</div>
		<div class="password">
		  <input name="confirmpassword" id="confirm_password" type="password" class="inputText" required/>
		  <span class="floating-label">Your password</span>
		</div>

		<div class="institute">
		  <input name="institute" type="text" class="inputText" required/>
		  <span class="floating-label">Your institute</span>
		</div>

		<div class="phone">
		  <input name="phone" type="text" class="inputText" required/>
		  <span class="floating-label">Your phone</span>
		</div>


		<input type="submit" class="register-buttton" value="Sign Up" name="register" onclick="return Validate()">	
	</form>		
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
	    	<input name="email" type="email" class="inputText form" required/>
    		<span class="floating-label">Your email</span>
		</div>

		<div class="password">
 	    	<input name="password" type="password" class="inputText" required/>
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
 <script type="text/javascript">
  var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}
	
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
</body>
</html>

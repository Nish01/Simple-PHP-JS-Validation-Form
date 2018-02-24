<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Save Some Stuff</title>
    
    <!-- Keep CSS at the top to render page first. All JS script refs placed at the before closing </body> tag -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
     <!-- Style Sheet -->
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
 
<body>

<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>

<!--CONTAINER -->
<div id="main-wrapper" class="container-fluid">
 
 <!--TOP H1 -->
  <div id="toph1">
    <section id="s1">
      <h1 class="headingsCen">Test App</h1>
      <hr>
      <br>
    </section>
  </div>
  <!--TOP H1 -->


<!--Input Form -->
<div id="enterInfo">
  <section id="enter">
   
    <div class="col-md-12">
     
      <form action="insert.php" onsubmit="return validateFunction()" method="post">

<?php
session_start();
if (empty($_SESSION['token'])) {
    if (function_exists('mcrypt_create_iv')) {
        $_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    } else {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
}
$token = $_SESSION['token'];?>
       
        <input name="token" type="hidden" class="form-control" value="<?php echo $token?>" >
        
        <div class="form-group">
          <label for="name">Name: </label>
          <input type="text" class="form-control" id="name" placeholder="Enter your Name" name="name">
          <div class="alert alert-danger" role="alert" id="nameError" ></div>

        </div>
        
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
          <div class="alert alert-danger" role="alert" id="mailError"></div>
        </div>

        <div class="form-group">
          <label for="number">Mobile number: </label>
          <input type="number" class="form-control" id="number" placeholder="Enter your mobile number" name="number" oninput="lengthFunc()">
          <div class="alert alert-danger" role="alert" id="numError"></div>
        </div>

        <div class="form-group">
          <label for="province">Province: </label>
          <select class="form-control" id="province" name="Province">
            <option value="" selected disabled>Please select your province</option>
            <option value="Eastern Cape">Eastern Cape</option>
            <option value="Free State">Free State</option>
            <option value="Gauteng">Gauteng</option>
            <option value="KwaZulu-Natal">KwaZulu-Natal</option>
            <option value="Limpopo">Limpopo</option>
            <option value="Mpumalanga">Mpumalanga</option>
            <option value="Northern Cape">Northern Cape</option>
            <option value="North West">North West</option>
            <option value="Western Cape">Western Cape</option>
          </select>
         <!-- <input type="text" class="form-control" id="province" placeholder="Choose your province" name="province">-->
          <div class="alert alert-danger" role="alert" id="provError"></div>
        </div>

          <div class="form-group">
          <label for="city">City: </label>
          <input type="text" class="form-control" id="city" placeholder="Enter your city" name="City">
          <div class="alert alert-danger" role="alert" id="cityError"></div>
        </div>

        <button type="submit" id="btnEnter" class="btn btn-default">Submit</button>
        <br>
        <br>
        <br>
        <br>
      </form>
    </div>

  </section>
 </div>
<!--Input Form -->

</div>
<!--CONTAINER -->
    
 <!--FOOTER -->
<footer id="footer" class="site-footer" role="contentinfo">
  <section class="footer-wrap">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="footer-inner">
              <div class="site-info">
                <p> Designed and Implemented &copy;   
           <script type="text/javascript">
             document.write(new Date().getFullYear());
           </script>
            All Rights Reserved.
           </p>
              </div><!-- .site-info -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </footer>
 <!--FOOTER -->

    <!-- Javascript source  -->
    <script src="myscripts.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </body>
</html>
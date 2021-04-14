<?
   require_once("header.php");
   require_once("config.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fashi | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>


<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="register-form">
                    <h2>Register</h2>
                    <form action="#">
                        <div class="group-input">
                            <label for="username">Email address</label>
                            <input required type="text" id="email" >
                        </div>
                        <div class="group-input">
                            <label for="fname">First name</label>
                            <input required type="text" id="fname">
                        </div>
                        <div class="group-input">
                            <label for="lname">Last name</label>
                            <input required type="text" id="lname">
                        </div>
                        <div class="group-input">
                            <label for="pass">Password</label>
                            <input required type="text" id="pass">
                        </div>
                        <button type="submit" id='AddUser' class="site-btn register-btn">REGISTER</button>
                    </form>
                    <div class="switch-login">
                        <a href="./login.php" class="or-login">Or Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->

<!-- Changing title of webpage on client side-->
<script>
 document.title = "Registar for Daniel-San Footwear";
 </script>

<?
    require_once("footer.php");
?>
<?
   require_once("header.php");
   require_once("config.php");
?>

<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="register-form">
                    <h2>Register</h2>
                    <form action="#">
                         <div class="group-input form-label-group">
                            <input class='form-control' required placeholder='Email' type="text" id="email">
                            <label for="username">Email</label>
                        </div>
                        <div class="group-input form-label-group">
                            <input class='form-control' placeholder='First Name' required type="text" id="fname">
                            <label for="fname">First name</label>
                        </div>
                        <div class="group-input form-label-group">
                            <input class='form-control' placeholder='Last Name' required type="text" id="lname">
                            <label for="lname">Last name</label>
                        </div>
                        <div class="group-input form-label-group">
                            <input class='form-control' placeholder='Password' required type="text" id="pass">
                            <label for="pass">Password</label>
                        </div>
                        <button type="submit" id='AddUser' class="site-btn register-btn">REGISTER</button>
                    </form>
                    <div class="switch-login">
                        <a href="./login.php" class="or-login">Or Login</a>
                    </div>
                </div>
            </div>
            <div class='registarConfirm'></div>
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
<?
     session_start();
     require_once("header.php");

    if(isset($_SESSION['userlogin'])){
        //idk why this isn't working.
        header('location:index.php');
    }
?>

<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form">
                    <h2>Login</h2>
                    <form action="#">
                        <div class="group-input">
                            <label for="username">Username or email address *</label>
                            <input required type="text" id="emaillogin">
                        </div>
                        <div class="group-input">
                            <label for="pass">Password *</label>
                            <input required type="text" id="passlogin">
                        </div>
                        <button type="submit" id='login' class="site-btn login-btn">Sign In</button>
                    </form>
                    <div class="switch-login">
                        <a href="./register.php" class="or-login">Or Create An Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->

<!-- Changing title of webpage on client side-->
<script>
 document.title = "Login to Daniel-San Footwear";
 </script>

<?
        require_once("footer.php");
?>
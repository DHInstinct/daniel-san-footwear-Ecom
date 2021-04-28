<?
     session_start();
     
     if(isset($_SESSION['userlogin'])){
         header('location: index.php');
    }
        require_once("header.php");
?>

<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form">
                <?
                    if(isset($_SESSION['userlogin'])){
                        echo("
                    <h2>Hello, " . $_SESSION['userlogin']. "! Feel free to shop!</h2>
                        
                        ");
                    }else{
                        echo("<h2>Login</h2>
                        <form action='#'>
                            <div class='group-input form-label-group'>
                            <input required type='text' id='emaillogin'type='email' class='form-control' placeholder='Email'>
                            <label for='username'>Email</label>
                            </div>
                            <div class='group-input form-label-group'>
                            <input required type='password' id='passlogin'type='password' class='form-control' placeholder='Password'>
                            <label for='pass'>Password</label>
                            </div>
                            <button type='submit' id='login' class='site-btn login-btn'>Sign In</button>
                        </form>");
                    }
                ?>
                    <div class="switch-login">
                        <a href="./register.php" class="or-login">Or Create An Account</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-lg-12 loginError'>
            
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
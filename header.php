<?

    //Check if cookie exists
    if(isset($_COOKIE['cartID']))
    {
      session_id($_COOKIE['cartID']);
      session_start();
    }
    else
    {
      session_start();
      //Set cookie to expire in one week.
      setcookie('cartID', session_id(), time()+60*60*24*7, "/");
    }

    require_once("config.php");

    $category = new Category();
    $cart = new Cart();

    $cat = $category->GetMainCat();


    

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daniel-San Footwear</title>

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
    <!-- Light box css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css%22%3E">
    <!-- Custom css -->
    <link rel="stylesheet" href="css/custom.css" type="text/css">
    
</head>

<body>
        <!-- <div id="preloder">
            <div class="loader"></div>
        </div> -->
    
    <!-- Header Section Begin -->
     <header class="header-section">
         <div class="container revx-font">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="./index.php">
                                <img src="img/daniel-san-logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                        <button type="button" class="category-btn">All Categories</button>
                            <!-- <ul> 
                                <li>
                                    <a href="#">Men's Footwear</a>
                                </li>
                            </ul> -->
                            <div class="input-group">
                                <input id='search' type="text" placeholder="What do you need?">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                        <div id='outputsearch'></div>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <!-- <li class="heart-icon">
                                <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a>
                            </li> -->
                            <li class="cart-icon">
                                <a href="shopping-cart.php">
                                    <i class="icon_bag_alt"></i>
                                    <span></span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody class='miniCartBody'>
                                                <?
                                                    $mini = $cart->UpdateMiniCart(session_id());
                                                    foreach($mini as $data)
                                                    {
                                                        echo("<tr>
                                                        <td class='si-pic'><img class='img-thumbnail miniImg' src=".Product::GetImage($data['pro_ID']) ."></td>
                                                        <td class='si-text'>
                                                            <div class='product-selected'>
                                                                <p>$" . $data['pro_Price'] . " x " . $data['cart_qty'] . "</p>
                                                                <h6>" . $data['pro_Name'] . "</h6>
                                                            </div>
                                                        </td>
                                                        <td class='si-close'>
                                                            <i class='ti-close'></i>
                                                        </td>
                                                        </tr>
                                                        ");
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5><?echo($cart->CalculateTotal(session_id())); ?></h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="shopping-cart.php" class="primary-btn view-card">VIEW CART</a>
                                        <a href="check-out.php" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price"><!--Total amt--></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container revx-font">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover"><?

                            foreach($cat as $data){
                                echo("<li><a href='shop.php?cat=" . $data['id'] . "'>" . $data['name']. "</a></li>");
                            }
                        ?>
                        
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="./index.php">Home</a></li>
                        <li><a href="./shop.php">Shop</a></li>
                        <li><a href="#">Collection</a>
                            <ul class="dropdown">
                                <li><a href="#">Men's Footwear</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./shopping-cart.php">Shopping Cart</a></li>
                                <li><a href="./check-out.php">Checkout</a></li>
                                <li><a href="./register.php">Register</a></li>
                                <li><a href="./login.php">Login</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->
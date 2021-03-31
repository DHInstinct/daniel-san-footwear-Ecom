<?

    require_once("header.php");
    // echo(session_id());

    $cart = new Cart();


?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop.html">Shop</a>
                    <span>Shopping Cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- js/ajax/updateCart.php -->
                        
                            <?
                                $CartItems = $cart->FillCart(session_id());

                                foreach($CartItems as $data)
                                {
                                    echo("
                                        <tr>
                                        <td class='cart-pic first-row'><img src='" . Product::GetImage($data['pro_ID']) . "' alt=''></td>
                                        <td class='cart-title first-row'>
                                        <h5>" . $data['pro_Name'] . "</h5>
                                        </td>
                                        <td class='p-price first-row'>$". number_format($data['pro_Price'], 2)."</td>
                                            <td class='qua-col first-row'>
                                                <div class='quantity'>
                                                    <div class='pro-qty'>
                                                        <input type='text' class='prodIDdata' data-id='" . $data['pro_ID']. "' value='" . $data['cart_qty'] . "'>
                                                    </div>
                                                </div>
                                            </td>
                                        <td class='total-price first-row'>$" .number_format($data['cart_qty'] * $data['pro_Price'], 2) . "</td>
                                        </tr>
                                        ");
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="cart-buttons">
                            <a href="#" class="primary-btn continue-shop">Continue shopping</a>
                            <button id='updateCart' class="primary-btn up-cart">Update cart</button>
                            <div id='updatedCart' class='added'></div>
        
                        </div>
                        <div class="discount-coupon">
                            <h6>Discount Codes</h6>
                            <form action="#" class="coupon-form">
                                <input type="text" placeholder="Enter your codes">
                                <button type="submit" class="site-btn coupon-btn">Apply</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-4">
                        <div class="proceed-checkout">
                            <ul>
                                <li class="subtotal">Subtotal <span></span></li>
                                <li class="cart-total">Total <span>$<?echo(number_format($cart->CalculateTotal(session_id()), 2));?></span></li>
                            </ul>
                            <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<!-- Changing title of webpage on client side-->
<script>
 document.title = "Shopping Cart";
 </script>

<?
    require_once("footer.php");
?>
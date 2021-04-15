<?
    require_once("header.php");

    $cart = new Cart();
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop.html">Shop</a>
                    <span>Check Out</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <form action="#" class="checkout-form">
            <div class="row">
                <div class="col-lg-5">
                    <div class="checkout-content">
                        <a id='getAddress' class="content-btn">Click Here To View Addresses</a>
                    </div>
                    <h4>Biiling Details</h4>
                    <div class="row">
                        <!-- <div class="col-lg-6">
                            <label for="fir">First Name<span>*</span></label>
                            <input type="text" placeholder='First Name'id="first">
                        </div>
                        <div class="col-lg-6">
                            <label for="last">Last Name<span>*</span></label>
                            <input type="text" placeholder='Last Name'id="last">
                        </div> -->
                        <div class="col-lg-12">
                            <label for="street">Street Address<span>*</span></label>
                            <input type="text" id="street" class="street-first">
                            <input type="text">
                        </div>
                        <div class="col-lg-12">
                            <label required for="zip">Postcode / ZIP (optional)</label>
                            <input type="text" id="zip">
                        </div>
                        <div class="col-lg-6">
                            <label required for="town">Town / City<span>*</span></label>
                            <input type="text" id="town">
                        </div>
                        <div class="col-lg-6">
                            <label required for="town">State<span>*</span></label>
                            <input type="text" id="state">
                        </div>
                        <div class="col-lg-8">
                            <div class="create-item">
                                <button id='confirmAddress'class='btn btn-warning'>Confirm Address</button>
                                <br />
                                <br />
                                <button id='addAddress'class='btn btn-warning'>Add Address? Click me To add it!</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="checkout-content">
                        <input type="text" placeholder="Enter Your Coupon Code">
                    </div>
                    <div class="place-order">
                        <h4>Your Order</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Product <span>Total</span></li>
                                
                                <?
                                    echo($cart->FillOrderSummary(session_id()));
                                ?>
                                <li class="fw-normal">Subtotal <span>$<?echo(number_format($cart->CalculateTotal(session_id()), 2));?></span></li>
                                <li class="fw-normal">Shipping <span>$<?echo('Not done yet');?></span></li>
                                <li class="total-price">Total <span>$<?echo(number_format($cart->CalculateTotal(session_id()), 2));?></span></li>
                            </ul>
                            <div class="payment-check">
                                <!-- <div class="pc-item">
                                    <label for="pc-check">
                                       Something could go right here?
                                        <input type="checkbox" id="pc-check">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="pc-item">
                                    <label for="pc-paypal">
                                    Something could go right here?
                                        <input type="checkbox" id="pc-paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> -->
                            </div>
                            <div class="order-btn">
                                <button type="submit" class="site-btn place-btn">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->

<!-- Changing title of webpage on client side-->
<script>
 document.title = "Checkout";
 </script>

<?
    require_once("footer.php");
?>
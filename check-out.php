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
            <div class="checkout-content col-lg-12">
                        <a id='getAddress' class="content-btn">Click Here To View Addresses</a>
                    </div>
                <div class="col-lg-6">
                    <h4>Biiling and Shipping Details</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="fir">First Name<span>*</span></label>
                            <input type="text" placeholder='First Name'id="first">
                        </div>
                        <div class="col-lg-6">
                            <label for="last">Last Name<span>*</span></label>
                            <input type="text" placeholder='Last Name'id="last">
                        </div>
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
                <div class="col-lg-6">
                    <h4>Card Payment</h4>
                    <div class="row">
                    <div id="credit-card" class="tab-pane fade show active pt-3">
                            <form role="form" onsubmit="event.preventDefault()">
                                <div class="form-group"> <label for="username">
                                        <h6>Card Owner</h6>
                                    </label> <input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="text" required class="form-control"> </div>
                                        </div>
                                    </div>
                                    <div class="card-footer"> <button type="button" class="subscribe btn btn-warning btn-block shadow-sm"> Confirm Payment </button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                    <br />
                    <br />
                    <br />
                    <div class="place-order">
                        <h4 id='orderTitle'>Your Order</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Product <span>Total</span></li>
                                
                                <?
                                    echo($cart->FillOrderSummary(session_id()));
                                ?>
                                <li class="fw-normal">Total Weight of package <span id='weight'><?echo(($cart->CartWeight(session_id())));?></span>lbs</li>
                                <li class="fw-normal">Subtotal <span>$<?echo(number_format($cart->CalculateTotal(session_id()), 2));?></span></li>
                                <li class="fw-normal">UPS Ground Shipping <span id='calculatedTotal'>$</span></li>
                                <li class="total-price">Total <span id='totalprice'>$<?echo(number_format($cart->CalculateTotal(session_id()), 2));?></span></li>
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
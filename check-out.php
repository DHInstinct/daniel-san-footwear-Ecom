<?php
    session_start();

    require_once("header.php");
    if(!isset($_SESSION['userid'])){
        // ob_start();
        //header("location: http:// " .$_SERVER['HTTP_HOST'] . "/index.php");
        // HEADER IS NOT WORKING AHHHHHHHHHHHHHH
        // echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    }

    $cart = new Cart();
    $customer = new Customer();

    
?>

<!-- <br />
<br />
<br />
<br />
<br />
<div class="form-label-group">
  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputEmail">Email address</label>
</div> -->

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
                        <?
                        if(isset($_SESSION['userid'])){


                            $results = $customer->GetCardAddress($_SESSION['userid']);
                            
                            echo("<div class='addstyle'><a id='getAddress' class='content-btn'><h2>Addresses and Cards</h2></a></div>");
                            foreach($results as $result)
                            {
                                echo("<div class='col-lg-4 addstyle'><a data-carid='".  $result['car_ID'] ."' data-addid='".  $result['add_ID'] ."' data-cvv='".  $result['car_Sec'] ."' data-month='".  $result['car_Exp'] ."' data-cnum='".  $result['car_Num'] ."' data-carname='".  $result['car_Name'] ."' data-state='".  $result['add_State'] ."' data-town='".  $result['add_City'] ."' data-zip='".  $result['add_Zip'] ."' data-street='" .  $result['add_Street'] ."' href='#' id='fillCard'>" ."<strong>Street: </strong>" .  $result['add_Street'] ."<br /><strong>Card Num:</strong> ". $result['car_Num'] . "</a>");
                                echo('</div>');
                            }
                        }
                        ?>
                    </div>
                <div class="col-lg-6">
                    <h4>Biiling and Shipping Details</h4>
                    <div class="row">
                        <div class="col-lg-6 form-label-group">
                            <input required type="text" placeholder='First Name'id="first">
                            <label for="fir">First Name<span>*</span></label>
                        </div>
                        <div class="col-lg-6 form-label-group">
                            <input required type="text" placeholder='Last Name'id="last">
                            <label for="last">Last Name<span>*</span></label>
                        </div>
                        <div class="col-lg-12 form-label-group">
                            <input required type="text" id="street" placeholder='Street' class="street-first">
                            <label for="street">Street Address<span>*</span></label>
                            <input type="text">
                        </div>
                        <div class="col-lg-12 form-label-group">
                            <input type="text" placeholder='Zip'id="zip">
                            <label required for="zip">Postcode / ZIP (optional)</label>
                        </div>
                        <div class="col-lg-6 form-label-group">
                            <input type="text" placeholder='Town' id="town">
                            <label required for="town">Town / City<span>*</span></label>
                        </div>
                        <div class="col-lg-6 form-label-group">
                            <input type="text" placeholder='State' id="state">
                            <label required for="town">State<span>*</span></label>
                        </div>
                        <input type="hidden" id="addid">
                        <input type="hidden" id="carid">

                        <div class="col-lg-8">
                            <div class="create-item">
                                <button id='confirmAddress'class='btn btn-warning'>Calculate Shipping</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4>Card Payment</h4>
                        <div class="row">
                            <div id="credit-card">
                                <div class="form-label-group"> 
                                    <input type="text" name="username" id='cardname' placeholder="MasterCard" required> 
                                    <label for="username">Card Name</label> 
                                </div>
                                <div class="form-group form-label-group">
                                    <input type="text" name="cardNumber" id='cardnum' placeholder="xxxx-xxxx-xxxx-xxxx" class="form-control " required>
                                    <label for="cardNumber">Card number</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                    <div class="form-group form-label-group">
                                        <input type="text" placeholder="MM Feb YY" name="" id='mm' class="form-control" required> 
                                        <label>Expiration Date</label>
                                    </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-label-group"> 
                                            <input required type="text" id='cvv' placeholder='xxx'class="form-control"> 
                                            <label>CVV</label>
                                        </div>
                                        </div>
                                    </div>
                                <div class="card-footer"> <button type="submit" id='payment' class=" addAddress subscribe btn btn-warning btn-block shadow-sm"> Add Payment and Address </button>
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
                                <button href=''type="submit" id='checkoutbtn' class="site-btn place-btn">Place Order</button>
                            </div>
                        </div>
                        <div class='placedOrder col-lg-12 text-center'><h1>PLACED ORDER</h1></div>
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
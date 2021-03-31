<?
    require_once("header.php");

    $product = new Product();
    $category = new Category();
    $review = new Review();
    $prod = $product->GetProduct($_GET['id']);

    $cat = $category->GetMainCat();

    // $product->printAllProd();
    // here is where you would process your data display
    // print_r($prod);

    $img = (file_exists("../../products/" . $prod['id'] . "_1.jpg") ? $prod['id'] . "_1" : "noimage");

    $images = $product->GetMultipleImages($_GET['id']);
    // print_r($images);


    $getid = $_GET['id'];
    
?>



<!-- Breadcrumb Section Begin -->
<!-- <div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop.html">Shop</a>
                    <span>Detail</span>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad page-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="filter-widget">
                    <h4 class="fw-title">Categories</h4>
                    <ul class="filter-catagories">
                        <!-- <li><a href="#">Men</a></li>
                        <li><a href="#">Women</a></li>
                        <li><a href="#">Kids</a></li> -->
                        <?
                            $sideBarCat = $category->GetSubCat();    

                            foreach($sideBarCat as $data)
                            {
                                
                                echo("
                                <li><a href='shop.php?subcat=". $data['id'] . "'>
                                    ".$data['name']."
                                </a></li>
                                ");
                            }
                        
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-pic-zoom">
                            <?
                            
                            if($images.count() == 1){

                                echo "<img data-image=" . Product::GetImage($_GET['id']) . " class='product-big-img' src='../../products/" . $img . ".jpg' height='300px' width='300px'>";
                            }
                            else{
                                echo "<img class='product-big-img' src='../../products/" . $img . ".jpg'>";
                                echo "<div class='product-thumbs'><div class='product-thumbs-track ps-slider owl-carousel'>";
                                foreach($images as $image)
                                {
                                    echo("<div class='pt active' data-imgbigurl=" . $image . "><img src=" . $image . " alt=''></div>");
                                }
                            }
                            
                            ?>
                            </div> 
                         </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details">
                            <div class="pd-title">
                                <span>oranges</span>
                                <h3 class=name data-name=<?echo($prod['name']);?>><?echo($prod['name']); ?></h3>
                                <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                            </div>
                            <div class="pd-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span>(5)</span>
                            </div>
                            <div class="pd-desc">
                                <p><?
                                    echo($prod['descript']);
                                ?></p>
                                <h4>$<? echo(number_format($prod['price']));?> 
                            </div>
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                                <button id="addToCart" data-id=<?=$_GET['id'];?> class="primary-btn pd-cart">Add To Cart</button>
                            </div>
                            <ul class="pd-tags">
                                   
                            <!-- success message --> 
                                <div class='added'><h3></h3></div>
                            </ul>
                            <div class="pd-share">
                                <div class="p-code"><!-- SKU:00012--></div>
                                <div class="pd-social">
                                    <!-- <a href="#"><i class="ti-facebook"></i></a>
                                    <a href="#"><i class="ti-twitter-alt"></i></a>
                                    <a href="#"><i class="ti-linkedin"></i></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tab">
                    <div class="tab-item">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-item-content">
                        <div class="tab-content">
                            <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                <div class="product-content">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <h5>Introduction</h5>
                                            <p><?echo($prod['descript'])?> </p>
                                        </div>
                                        <div class="col-lg-5">
                                        <?echo "<img src='../../products/" . $img . ".jpg'>";?>
                                            <??>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                <div class="specification-table">
                                    <table>
                                        <tr>
                                            <td class="p-catagory">Price</td>
                                            <td>
                                                <div class="p-price">$<?echo(number_format($prod['price']))?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-catagory">Add To Cart</td>
                                            <td>
                                                <div class="cart-add">+ add to cart</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-catagory">Availability</td>
                                            <td>
                                                <div class="p-stock"><?echo($prod['quantity'])?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-catagory">Weight</td>
                                            <td>
                                                <div class="p-weight"><?echo($prod['weight'])?></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                <div class="customer-review-option">
                                    <h4>Reviews</h4>
                                    <h5>Average Score: <strong><? 
                                    
                                        $scores = $review->CalculateScore($_GET['id']);
                                        foreach($scores as $score)
                                        {
                                            echo($score['score']);
                                        }
                                        
                                    
                                    ?></strong></h5>
                                    <div class="comment-option">
                                        <div class="co-item">
                                            <?
                                                $reviews = $review->PrintReview($_GET['id']);
                                                foreach($reviews as $r)
                                                {
                                                    echo("<div class='avatar-text'>
                                                    <div class='at-rating'>
                                                    <h5>" . $r['cus_FirstName'] . " " . $r['cus_LastName']. "<span>Score: " .$r['rev_Score'] . "</span></h5>
                                                    <div class='at-reply'>". $r['rev_Detail'] ."</div>
                                                    </div><br />");
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="leave-comment">
                                        <h4>Leave A Comment</h4>
                                        <form action="js/ajax/sendReview.php" class="comment-form" method="POST">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <input type="text" id="name" name="name" placeholder="Name">
                                                    <input type="hidden" id="prodID" name="prodID" value=<?echo($_GET['id'])?>>
                                                </div>
                                                <div class="col-lg-4">
                                                    <input type="text" id="email" name="email" placeholder="Email">
                                                </div>
                                                <div class="col-lg-4">
                                                    <input type="text" id="score" name="score" placeholder="Score">
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea placeholder="Messages" id="message" name="message"></textarea>
                                                    <button type="submit" class="site-btn">Send message</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->

<?
    require_once("footer.php");
?>
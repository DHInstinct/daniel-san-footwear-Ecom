<?

    require_once("header.php");  

    $prod = new Product();


?>

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="img/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Bag,kids</span>
                            <h1>Black friday</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Sale <span>50%</span></h2>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="img/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Bag,kids</span>
                            <h1>Black friday</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Sale <span>50%</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    <!-- Banner Section Begin -->
    <!-- Man Banner Section Begin -->
    <section class="man-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="filter-control">
                        <!-- <ul>
                            <li class="active">Clothings</li>
                            <li>HandBag</li>
                            <li>Shoes</li>
                            <li>Accessories</li>
                        </ul> -->
                        <h3>Featured Products</h3>
                    </div>
                    <div class="product-slider owl-carousel">
                    <?
                    
                        $results = $prod->GetFeat();

                        foreach($results as $data)
                        {
                            echo("<div class='product-item'>
                                    <div class='pi-pic'>
                                        <img src='../../products/" . $data['id'] . "_1.jpg' alt='' height='300px'>
                                        <div class='sale'>Sale</div>
                                        <div class='icon'>
                                            <i class='icon_heart_alt'></i>
                                        </div>
                                        <ul>
                                            <li class='w-icon active'><a href='#'><i class='icon_bag_alt'></i></a></li>
                                            <li class='quick-view'><a href='#' class='quickview' data-img='../../products/" . $data['id'] . "_1.jpg'data-price='" . $data['price']. "' data-name='" .$data['name'] . "' data-toggle='modal' data-target='#exampleModal'>+ Quick View</a></li>
                                            <li class='w-icon'><a href='#'><i class='fa fa-random'></i></a></li>
                                        </ul>
                                    </div>
                                    <div class='pi-text'>
                                        <div class='catagory-name'><a href='shop.php?subcat=". $data['subcatid'] . "'>" . $data['catname'] . "</a></div>
                                        <a href='#'>
                                            <h5><a href='product.php?id=" . $data['id'] . "'</a>" . $data['name'] . "</h5>
                                        </a>
                                        <div class='product-price'>$
                                        " . $data['price'] . "
                                        </div>
                                    </div>
                                </div>");
                        }
                        
                    ?>
                    </div>
                </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="title"></h5>
                            <h5 class="modal-title" id="price"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img id="img" src=''></img>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="product-large set-bg m-large" data-setbg="img/products/man-large.jpg">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Man Banner Section End -->
    
<?
    require_once("footer.php");
?>
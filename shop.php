<?
    require_once("header.php");

    $product = new Product();
    $category = new Category();


?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <div class="filter-widget">
                    <!-- <h4 class="fw-title">Categories</h4>
                    <ul class="filter-catagories">
                        <li><a href="#">Men</a></li>
                        <li><a href="#">Women</a></li>
                        <li><a href="#">Kids</a></li>
                    </ul> -->
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Categories</h4>
                    <div class="fw-brand-check">
                    <div class="fw-tags">

                    <?

                    $sideBarCat = $category->GetSubCat();    

                    foreach($sideBarCat as $data)
                    {
                        
                        echo("<div class='bc-item'>
                        <a class='text-bold' href='shop.php?subcat=". $data['id'] . "'>
                            ".$data['name']."
                        </a>
                        </div>");
                    }
                    ?>
                    </div>
                </div>
                </div>
                <div class="filter-widget">
                  <h4 class="fw-title">Sort by Manufacturer</h4>
                    <div class="fw-tags">
                      <b><a href='shop.php'>Remove Filter</a></b>
                        <?$manus = $product->GetManu();
                            foreach ($manus as $manu)
                            {
                            echo "<a href='#' class='manu'>" . $manu['manu'] . "</a>";
                            }
                        ?>
                    </div>
                    <br />
                    <br />
                  <h4 class="fw-title">Sort by Model</h4>
                 <div class="fw-tags"> 
                    <?$models = $product->GetModel();
                         foreach($models as $model)
                         {
                             echo "<a href='#' class='model'>" . $model['model'] . "</a>";
                         }
                    ?>
                 </div>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="fw-tags">
                            <button class="btn sortedButns sort-price-asc">Sort By Price $-$$$</button>
                            <button class='btn sortedButns sort-price-desc'>Sort By Price $$$-$</button>
                            <button class='btn sortedButns sort-name-az'>Sort By Manu A-Z</button>
                            <button class='btn sortedButns sort-name-za'>Sort By Manu Z-A</button>
                                <!-- <select class="sorting">
                                    <?// coming back to this: $product->GetManu();?>
                                </select>
                                <select class="p-show">
                                    <option value="">Show:</option>
                                </select> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-list">
                    <div class="row">
                    <?
                        if($_GET['cat'] == NULL && (!isset($_GET['subcat'])))
                        {
                            $results = $product->printAllProd();
                            foreach($results as $rows)
                            {
                                echo ("<div class='col-lg-4 col-sm-6 sort'>");
                                echo ("<div class='product-item product'data-name='" . $rows['name'] . "'data-price='" .$rows['price'] . "'>");
                                    echo ("<div class='pi-pic'>");
                                        echo ("<img src='../../products/" . $rows['id'] . "_1.jpg' height='300px' width='300px'>");
                                                   echo ("<div class='sale pp-sale'>Sale</div>");
                                                   echo ("<div class='icon'>");
                                                        echo ("<i class='icon_heart_alt'></i>");
                                                    echo ("</div>");
                                                    echo ("<ul>");
                                                       echo("<li class='w-icon active'><a href='#'><i class='icon_bag_alt'></i></a></li>");
                                                       echo ("<li class='quick-view'><a href='#' class='quickview' data-id='" . $rows['id']. "' data-img='../../products/" . $rows['id'] . "_1.jpg'data-price='" . $rows['price']. "' data-name='" .$rows['name'] . "' data-toggle='modal' data-target='#exampleModal'>+ Quick View</a></li>");
                                                       echo ("<li class='w-icon'><a href='#'><i class='fa fa-random'></i></a></li>");
                                                  echo ("</ul>");
                                                echo("</div>");
                                               echo ("<div class='pi-text'>");
                                               echo ("<div class='d-none catagory-name manufacturer'>" . $rows['manu'] . "</div>");
                                               echo ("<div class='d-none catagory-name modeltype'>" . $rows['model'] . "</div>");
                                                   echo ("<a href='product.php?id=" . $rows['id'] . "'");
                                                   echo ("<h5 >" . $rows['name'] . "</h5>");
                                                  echo  ("</a>");
                                                  echo ("<div class='product-price price' data-price='" .$rows['price'] . "'>$");
                                                  echo ($rows['price']);
                                                   echo ("</div>");
                                                echo ("</div>");
                                            echo("</div>");
                                       echo ("</div>");
                            }

                        }
                        elseif($_GET['cat'] != NULL){
                            $results = $category->PrintBasedOnMainCat($_GET['cat']);
                            foreach($results as $rows)
                            {
                                echo ("<div class='col-lg-4 col-sm-6 sort'>");
                                echo ("<div class='product-item product'data-name='" . $rows['name'] . "'data-price='" .$rows['price'] . "'>");
                                    echo ("<div class='pi-pic'>");
                                        echo ("<img src='../../products/" . $rows['id'] . "_1.jpg' height='300px' width='300px'>");
                                                   echo ("<div class='sale pp-sale'>Sale</div>");
                                                   echo ("<div class='icon'>");
                                                        echo ("<i class='icon_heart_alt'></i>");
                                                    echo ("</div>");
                                                    echo ("<ul>");
                                                       echo("<li class='w-icon active'><a href='#'><i class='icon_bag_alt'></i></a></li>");
                                                       echo ("<li class='quick-view'><a href='#' class='quickview' data-id='" . $rows['id']. "' data-img='../../products/" . $rows['id'] . "_1.jpg'data-price='" . $rows['price']. "' data-name='" .$rows['name'] . "' data-toggle='modal' data-target='#exampleModal'>+ Quick View</a></li>");
                                                       echo ("<li class='w-icon'><a href='#'><i class='fa fa-random'></i></a></li>");
                                                  echo ("</ul>");
                                                echo("</div>");
                                               echo ("<div class='pi-text'>");
                                               echo ("<div class='d-none catagory-name manufacturer'>" . $rows['manu'] . "</div>");
                                               echo ("<div class='d-none catagory-name modeltype'>" . $rows['model'] . "</div>");
                                                   echo ("<a href='product.php?id=" . $rows['id'] . "'");
                                                   echo ("<h5 >" . $rows['name'] . "</h5>");
                                                  echo  ("</a>");
                                                  echo ("<div class='product-price price' data-price='" .$rows['price'] . "'>$");
                                                  echo ($rows['price']);
                                                   echo ("</div>");
                                                echo ("</div>");
                                            echo("</div>");
                                       echo ("</div>");
                            }
                        }
                        else{
                            $results = $category->PrintSubCat($_GET['subcat']);
                            foreach($results as $rows)
                            {
                                echo ("<div class='col-lg-4 col-sm-6 sort'>");
                                echo ("<div class='product-item product'data-name='" . $rows['name'] . "'data-price='" .$rows['price'] . "'>");
                                    echo ("<div class='pi-pic'>");
                                        echo ("<img src='../../products/" . $rows['id'] . "_1.jpg' height='300px' width='300px'>");
                                                   echo ("<div class='sale pp-sale'>Sale</div>");
                                                   echo ("<div class='icon'>");
                                                        echo ("<i class='icon_heart_alt'></i>");
                                                    echo ("</div>");
                                                    echo ("<ul>");
                                                       echo("<li class='w-icon active'><a href='#'><i class='icon_bag_alt'></i></a></li>");
                                                       echo ("<li class='quick-view'><a href='#' class='quickview' data-id='" . $rows['id']. "' data-img='../../products/" . $rows['id'] . "_1.jpg'data-price='" . $rows['price']. "' data-name='" .$rows['name'] . "' data-toggle='modal' data-target='#exampleModal'>+ Quick View</a></li>");
                                                       echo ("<li class='w-icon'><a href='#'><i class='fa fa-random'></i></a></li>");
                                                  echo ("</ul>");
                                                echo("</div>");
                                               echo ("<div class='pi-text'>");
                                               echo ("<div class='d-none catagory-name manufacturer'>" . $rows['manu'] . "</div>");
                                               echo ("<div class='d-none catagory-name modeltype'>" . $rows['model'] . "</div>");
                                                   echo ("<a href='product.php?id=" . $rows['id'] . "'");
                                                   echo ("<h5 >" . $rows['name'] . "</h5>");
                                                  echo  ("</a>");
                                                  echo ("<div class='product-price price' data-price='" .$rows['price'] . "'>$");
                                                  echo ($rows['price']);
                                                   echo ("</div>");
                                                echo ("</div>");
                                            echo("</div>");
                                       echo ("</div>");
                            }
                        }
                    ?>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="title"></h5>
                            <br />
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img id="img" src=''></img>
                          </div>
                          <div class="modal-footer">
                          <p id='success'></p>
                          $<b><h5 class="modal-title" id="price"></h5></b>
                            <button id="addToCart" class='btn btn-warning pd-cart' data-id=<??> >Add To Cart</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                        
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="loading-more">
                    <i class="icon_loading"></i>
                    <a href="#">
                        Loading More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->

<!-- Changing title of webpage on client side-->
<script>
 document.title = "Shop Daniel-San Footwear";
 </script>

<?
    require_once("footer.php");
?>
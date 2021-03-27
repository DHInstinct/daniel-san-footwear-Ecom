<?
    class Category
    {

        private $database;

        public function __construct()
        {
            $this->database = DB::getInstance();
        }

        public function GetMainCat()
        {
            $query = "select cat_ID id, cat_Name name, cat_SubCat subcat FROM category where cat_SubCat is NULL";
            $results = $this->database->get_results($query);

            return $results;
        }

        public function GetSubCat()
        {
            $query = "select cat_ID id, cat_Name name, cat_SubCat subcat FROM category where cat_SubCat is not NULL";
            $results = $this->database->get_results($query);

            return $results;
                
        }

        public function PrintSubCat($value)
        {
            $query = "select pro_Model as model, pro_Manufacturer manu, pro_ID id, pro_Name name, pro_Price price, cat_ID from product where cat_ID=$value";
            $results = $this->database->get_results($query);

            foreach($results as $row)
            {
                Category::PrintQuickViewProd($row);
            }

        }

        public function PrintBasedOnMainCat($cat)
        {
            $query = "select pro_Model as model, pro_Manufacturer manu, category.cat_ID, pro_ID id, pro_Name name, pro_Price price FROM product inner join category on category.cat_ID= product.cat_ID where cat_SubCat=$cat";
            $results = $this->database->get_results($query);

            foreach($results as $row)
            {
                Category::PrintQuickViewProd($row);
            }
        }

        public static function PrintQuickViewProd($rows)
        {
            echo ("<div class='col-lg-4 col-sm-6'>");
                echo ("<div class='product-item product'>");
                    echo ("<div class='pi-pic'>");
                        echo ("<img src='../../products/" . $rows['id'] . "_1.jpg' height='300px' width='300px'>");
                                   echo ("<div class='sale pp-sale'>Sale</div>");
                                   echo ("<div class='icon'>");
                                        echo ("<i class='icon_heart_alt'></i>");
                                    echo ("</div>");
                                    echo ("<ul>");
                                       echo("<li class='w-icon active'><a href='#'><i class='icon_bag_alt'></i></a></li>");
                                       echo ("<li class='quick-view'><a href='product.php?id=" . $rows['id'] . "'>+ Quick View</a></li>");
                                       echo ("<li class='w-icon'><a href='#'><i class='fa fa-random'></i></a></li>");
                                  echo ("</ul>");
                                echo("</div>");
                               echo ("<div class='pi-text'>");
                               echo ("<div class='d-none catagory-name manufacturer'>" . $rows['manu'] . "</div>");
                               echo ("<div class='d-none catagory-name modeltype'>" . $rows['model'] . "</div>");
                                   echo ("<a href='product.php?id=" . $rows['id'] . "'");
                                   echo ("<h5>" . $rows['name'] . "</h5>");
                                  echo  ("</a>");
                                  echo ("<div class='product-price'>");
                                  echo ($rows['price']);
                                  echo ("<span>$35.00</span>");
                                   echo ("</div>");
                                echo ("</div>");
                            echo("</div>");
                       echo ("</div>");
        }
    }
?>
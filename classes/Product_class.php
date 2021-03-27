<?php

class Product
{
    
    //database object
    private $database;

    public function __construct()
    {
        //Get the current instance of the DB
        $this->database = DB::getInstance();
    }

    public static function GetImage($pro_ID)
    {
        $image = '../../products/' . $pro_ID . '_1.jpg';

        //Return the image
        return $image;
    }


    public function GetFeat()
    {
         $query = "select pro_id id, pro_name name, pro_price price, pro_feat, cat_Name catname, category.cat_ID subcatid from product inner join category on category.cat_ID=product.cat_ID where pro_feat ='Y' order by price";
         $results = $this->database->get_results($query);

         foreach($results as $result)
         {
             Product::ProdFeatHTML($result);
         }
    }

    public static function ProdFeatHTML($data)
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
                <li class='quick-view'><a href='product.php?id=" . $data['id'] . "'>+ Quick View</a></li>
                <li class='w-icon'><a href='#'><i class='fa fa-random'></i></a></li>
            </ul>
        </div>
        <div class='pi-text'>
            <div class='catagory-name'><a href='shop.php?subcat=". $data['subcatid'] . "'>" . $data['catname'] . "</a></div>
            <a href='#'>
                <h5>" . $data['name'] . "</h5>
            </a>
            <div class='product-price'>$
            " . $data['price'] . "
            </div>
        </div>
    </div>");
    }


    public function PrintSingleItem($pro_ID)
    {
        $query = "select pro_Name, pro_Descript, pro_Price, pro_Qty, pro_Manufacturer, pro_Model, pro_Weight FROM product where pro_id=$pro_ID";

        $results = $this->database->get_results($query);
    }

    //printing all of the data in products table
    public function printAllProd()
    {
        $query = "select pro_Model as model, pro_Manufacturer manu, pro_ID id, pro_Name name, pro_Price price FROM product";
        $results = $this->database->get_results($query);

        foreach($results as $row)
        {
            Category::PrintQuickViewProd($row);
                
        }
    }

    public function GetProdID()
    {
        $query = "select pro_id FROM product" ;
        $results = $this->database->get_results($query);

        return $results;
    }

    public function GetMultipleImages($id)
    {
        //https://www.w3schools.com/php/func_filesystem_glob.asp
        // Found this with Tyler Truman

        $images = glob("../../products/" . $id . "*.jpg");
        return $images;
    }

    public function GetProduct($id)
    {
        $id = $this->database->filter($id);

            if (!$id)
            {
                $data = array("error"=>"404", "message"=>"Missing ID");
                return $data;
            }

            $query = "select pro_ID id, pro_Price price, pro_Name name, pro_Descript descript, pro_Qty quantity, pro_Weight weight from product where pro_ID='" . $id . "'";

            if ($this->database->num_rows($query) == 0)
            {
                $data = array("error"=>"404", "message"=>"Product does not exist");
                return $data;
            }

            $results = $this->database->get_results($query);
            
            // return the values at array index 0 since this is to return a single product
            return $results[0];
    }



    //Assignment 3 functions
    public function GetManu()
    {
        $query = "select distinct(pro_Manufacturer) manu from product order by pro_Manufacturer";
        $manus = $this->database->get_results($query);
       
        foreach ($manus as $manu)
        {
          echo "<a href='#' class='manu'>" . $manu['manu'] . "</a>";
        }
        
    }

    public function GetModel()
    {
        $query = "select distinct(pro_Model) model from product order by pro_Manufacturer";
        $models = $this->database->get_results($query);

        // echo("<select>"); Everything decides to break if put It in a dropdown...
        // I will format in a dropdown eventually.
        $counter = 0;
        foreach($models as $model)
        {
            echo "<a href='#' class='model'>" . $model['model'] . "</a>";
            
        }
        // echo("</select>");

    }
}

?>
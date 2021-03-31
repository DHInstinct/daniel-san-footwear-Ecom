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

         return $results;
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

        return $results;
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

    public function GetManu()
    {
        $query = "select distinct(pro_Manufacturer) manu from product order by pro_Manufacturer";
        $manus = $this->database->get_results($query);

        return $manus;
    }

    public function GetModel()
    {
        $query = "select distinct(pro_Model) model from product order by pro_Manufacturer";
        $models = $this->database->get_results($query);

        return $models;
    }
}

?>
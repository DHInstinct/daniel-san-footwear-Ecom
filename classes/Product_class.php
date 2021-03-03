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


    public function PrintSingleItem($pro_ID)
    {
        $query = "select pro_Name, pro_Descript, pro_Price, pro_Qty, pro_Manufacturer, pro_Model, pro_Weight FROM product where pro_id=$pro_ID";

        $results = $this->database->get_results($query);

            // echo($results[0]['pro_ID'] . "'>" . $results[0]['pro_Name']);
    }

    //printing all of the data in products table
    public function printAllProd()
    {
        $query = "select pro_ID id, pro_Name name, pro_Price price FROM product";
        $results = $this->database->get_results($query);

        //echo("<a href='product.php?id=" . $row['id'] . "'>" . $row['name'] . "</a>");

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

        // foreach($results as $row)
        // {
        // }

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
}

?>
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

            return $results;
        }

        public function PrintBasedOnMainCat($cat)
        {
            $query = "select pro_Model as model, pro_Manufacturer manu, category.cat_ID, pro_ID id, pro_Name name, pro_Price price FROM product inner join category on category.cat_ID= product.cat_ID where cat_SubCat=$cat";
            $results = $this->database->get_results($query);

            return $results;
        }
       
    }
?>
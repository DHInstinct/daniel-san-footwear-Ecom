<?

class Cart 
{
    private $db;
    
    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function ClearCart($cartID)
    {
        $cart = array('cart_ID' => $cartID);
        $this->db->delete('cart', $cart);
    }

    public function CalculateTotal($cartID)
    {

        $query = "select cart_ID, sum(cart_qty*pro_price) as'Total' FROM cit410s21.cart inner join product on product.pro_ID=cart.pro_ID where cart_ID='$cartID' group by cart_ID;";
        $results = $this->db->get_results($query);
        
        return $results[0]['Total'];
    }

    public function FillCart($cartID)
    {
        $query = "select * FROM cit410s21.cart inner join product on product.pro_ID=cart.pro_ID where cart.cart_ID='$cartID'";
        $results = $this->db->get_results($query);

        return $results;
    }

    public function UpdateMiniCart($cartID)
    {
        $query = "select * FROM cit410s21.cart inner join product on product.pro_ID=cart.pro_ID where cart.cart_ID='$cartID'";
        $results = $this->db->get_results($query);
        
        return $results;
    }

    public function CartDetails($cartID)
    {
        $query = "select cart_ID, product.pro_ID, pro_Name  FROM cit410s21.cart inner join product on product.pro_ID=cart.pro_ID where cart_ID='$cartID';
        ";
        
        $results = $this->db->get_results($query);
        
        return $results;
    }

    public function UpdateCart($cartID, $array)
    {

        foreach($array as $item)
        {
             $info = array(
                 'cart_ID' => session_id(),
                 'pro_ID' => $item->pID,
                 'cart_qty' => $item->qty
             );

             if($item->qty <= 0){
                $this->db->delete('cart', $info);
            }
            else{
                $this->db->insert('cart', $info);
            }
        }
    }
}
?>
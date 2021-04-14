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
        /*
        **Worked With Tyler**

        For some reason I cannot figure out the query. Here's my work. 
        Spent all of friday trying to get this.
        
        $query = "select * FROM cit410s21.cart inner join product on product.pro_ID=cart.pro_ID left join prodopt on cart.pro_ID=prodopt.pro_ID where cart_ID='$cartID'";
        $query = "select * FROM CART c LEFT JOIN CARTOPTS co on co.cart_ID=c.cart_ID and co.pro_ID=c.pro_ID LEFT join prodopt on co.opt_ID=prodopt.opt_ID where c.cart_ID='$cartID' order by c.pro_ID";
        $query = "select * from cart inner join product on product.pro_id = cart.pro_ID where cart_ID = '$cartID'";
        
        $query = "select prodopt.opt_ID, prodopt.opt_Price, cart.pro_ID, cart.cart_qty, product.pro_Price, product.pro_Name, prodopt.opt_Value from cart 
            inner join product on product.pro_id = cart.pro_ID 
            inner join cartopts on cartopts.cart_ID=cart.cart_ID
            left outer join prodopt on prodopt.opt_ID = cartopts.opt_ID 
            where cart.cart_ID = '$cartID'
            group by prodopt.opt_ID ";

        I felt like I was really close on this one, but still not what I was looking for. 
         select * from cart natural join product
             left outer join cartopts on cartopts.cart_ID = cart.cart_ID 
             where cart.cart_ID='$cartID'
             in(select opt_Price from prodopt)
             group by product.pro_ID
        
        */

        
        // originial query
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

    public function GetOptionDetails($cartID)
    {
        $query = "select * FROM CART c LEFT JOIN CARTOPTS co on co.cart_ID=c.cart_ID and co.pro_ID=c.pro_ID where c.cart_ID='$cartID'";
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
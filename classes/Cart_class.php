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
        // var_dump($cart);
        $this->db->delete('cart', $cart);
    }

    public function CalculateTotal($cartID)
    {

        $query = "select cart_ID, sum(cart_qty*pro_price) as'Total' FROM cit410s21.cart inner join product on product.pro_ID=cart.pro_ID where cart_ID='$cartID' group by cart_ID;
        ";
        
        $results = $this->db->get_results($query);
        
        return $results[0]['Total'];
    }

    
    public static function MiniCartHTMl($data)
    {
        // echo($data['pro_ID']);
        echo("<tr>
        <td class='si-pic'><img class='img-thumbnail miniImg' src=".Product::GetImage($data['pro_ID']) ."></td>
        <td class='si-text'>
            <div class='product-selected'>
                <p>$" . $data['pro_Price'] . " x " . $data['cart_qty'] . "</p>
                <h6>" . $data['pro_Name'] . "</h6>
            </div>
        </td>
        <td class='si-close'>
            <i class='ti-close'></i>
        </td>
        </tr>
        ");
    }


    public static function CartHTMl($data)
    {
        // echo($data['pro_ID']);
        echo("
            <tr>
            <td class='cart-pic first-row'><img src='" . Product::GetImage($data['pro_ID']) . "' alt=''></td>
            <td class='cart-title first-row'>
            <h5>" . $data['pro_Name'] . "</h5>
            </td>
            <td class='p-price first-row'>$". number_format($data['pro_Price'], 2)."</td>
                <td class='qua-col first-row'>
                    <div class='quantity'>
                        <div class='pro-qty'>
                            <input type='text' class='prodIDdata' data-id='" . $data['pro_ID']. "' value='" . $data['cart_qty'] . "'>
                        </div>
                    </div>
                </td>
            <td class='total-price first-row'>$" .number_format($data['cart_qty'] * $data['pro_Price'], 2) . "</td>
            </tr>
            ");
    }
        
    public function FillCart($cartID)
    {
        $query = "select * FROM cit410s21.cart inner join product on product.pro_ID=cart.pro_ID where cart.cart_ID='$cartID'";
        //SELECT * FROM cit410s21.cart inner join product on product.pro_ID=cart.pro_ID ;

        $results = $this->db->get_results($query);

        foreach($results as $row)
        {
            Cart::CartHTMl($row);   
        }
        
    }

    public function UpdateMiniCart($cartID)
    {
        $query = "select * FROM cit410s21.cart inner join product on product.pro_ID=cart.pro_ID where cart.cart_ID='$cartID'";
        //SELECT * FROM cit410s21.cart inner join product on product.pro_ID=cart.pro_ID ;

        $results = $this->db->get_results($query);

        foreach($results as $row)
        {
            Cart::MiniCartHTMl($row);
        }
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
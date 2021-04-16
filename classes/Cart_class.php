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

        // $query = "select cart_ID, sum(cart_qty*pro_price) as'Total' FROM cit410s21.cart inner join product on product.pro_ID=cart.pro_ID where cart_ID='$cartID' group by cart_ID;";
        // $results = $this->db->get_results($query);
        
        // return $results[0]['Total'];

        $query = "select cart_qty, pro_price BASEPRICE, (select opt_Price from prodopt po, cartopts co, cart c where c.pro_ID=po.pro_ID and co.opt_ID=po.opt_ID and c.cart_ID=co.cart_ID and c.pro_ID=p.pro_ID and c.cart_ID='$cartID') OPTPRICE FROM cart INNER JOIN product p ON p.pro_ID=cart.pro_ID and cart_ID='$cartID'";
        $results = $this->db->get_results($query);

        $totalPrice = 0;
        foreach ($results as $value)
        {
          $totalPrice += $value['cart_qty'] * ($value['BASEPRICE'] + $value['OPTPRICE']);
        } 

        return $totalPrice;
    }

    public function FillCart($cartID)
    {
        $query = "select c.pro_ID pro_ID, c.cart_qty cart_qty, co.opt_ID opt_ID FROM CART c LEFT JOIN CARTOPTS co on co.cart_ID=c.cart_ID and co.pro_ID=c.pro_ID where c.cart_ID='$cartID'";
        
        $result = $this->db->get_results($query);

        
        foreach($result as $data)
        {
            
            $query = "select * FROM product p LEFT JOIN prodopt po ON p.pro_ID=po.pro_ID WHERE p.pro_ID=" . $data['pro_ID'] . " and po.opt_ID" . (!empty($data['opt_ID']) ? "=" . $data['opt_ID'] : " IS NULL");
            $results = $this->db->get_results($query);

            //echo(Product::GetImage($data['pro_ID']));
            foreach($results as $data2)
            echo("
                <tr>
                <td class='cart-pic first-row'><img src='" . Product::GetImage($data['pro_ID']) . "' alt=''></td>
                <td class='cart-title first-row'>
                <h5>" . $data2['pro_Name'] . "</h5>
                </td>
                <td>" . $data2['opt_Value'] . "</td>
                <td class='p-price first-row'>$". number_format($data2['pro_Price'], 2)."</td>
                    <td class='qua-col first-row'>

                        <div class='quantity'>
                            <div class='pro-qty'>
                                <input type='text' class='prodIDdata' data-id='" . $data['pro_ID']. "' value='" . $data['cart_qty'] . "'>
                            </div>
                        </div>
                    </td>
                <td class='total-price first-row'>$" .number_format($data['cart_qty'] * $data2['pro_Price'], 2) . "</td>
                </tr>
                ");
        }
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


    public function FillOrderSummary($cartID)
    {
        $query = "select c.pro_ID pro_ID, c.cart_qty cart_qty, co.opt_ID opt_ID FROM CART c LEFT JOIN CARTOPTS co on co.cart_ID=c.cart_ID and co.pro_ID=c.pro_ID where c.cart_ID='$cartID'";
        
        $result = $this->db->get_results($query);

        foreach($result as $data)
        {
            $query = "select * FROM product p LEFT JOIN prodopt po ON p.pro_ID=po.pro_ID WHERE p.pro_ID=" . $data['pro_ID'] . " and po.opt_ID" . (!empty($data['opt_ID']) ? "=" . $data['opt_ID'] : " IS NULL");
            $results = $this->db->get_results($query);
            foreach($results as $data2)
            {
                echo("
                    <li>" . $data2['pro_Name'] . $data2['opt_Value']. "<span>$" . $data2['pro_Price'] . "</span></li>
                ");
            }
        }
    }
 // " . $data2['opt_Value'] . "
}
?>
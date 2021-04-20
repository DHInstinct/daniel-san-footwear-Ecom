<?

class Order {

    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function SendOrder($billID, $shipID, $cardID, $cusID, $ordShip, $ordTrack)
    {
        $order = array(
            'add_Bill'=> $billID,
            'add_Ship'=> $shipID,
            'car_ID'=> $cardID,
            'cus_ID'=> $cusID,
            'ord_ship'=> $ordShip,
            'ord_track'=> $ordTrack
        );

        $this->db->insert('cit410s21.order', $order);
        $lastID = $this->db->lastid();
        
        //add lastID to returning order
        $order['lastID'] = $lastID;

        return $order;
    }

    public function SendOrdetails($lastID, $cartID)
    {
        $query="select * from cart c inner join product p on c.pro_ID = p.pro_ID where cart_ID = '$cartID'";
        $results = $this->db->get_results($query);

        foreach($results as $data)
        {
            $orderInsert = array(
                'ord_ID'=> $lastID,
                'pro_ID'=> $data['pro_ID'],
                'ord_Price'=> $data['pro_Price'],
                'ord_Qty'=> $data['cart_qty'],
            );
            $this->db->insert('cit410s21.orddetail', $orderInsert);
        }
        return $results;
    }

    public function SendOrdetailsOPTS($lastID, $cartID)
    {
        $query ="select * from cartopts where cart_ID='$cartID'";
        $results = $this->db->get_results($query);

        foreach($results as $data)
        {
            $orderOPTSInsert = array(
                'ord_ID'=> $lastID,
                'pro_ID'=> $data['pro_ID'],
                'opt_ID'=> $data['opt_ID']
            );
            $this->db->insert('cit410s21.orddetailopts', $orderOPTSInsert);
        }
        return $results;
    }

}



?>
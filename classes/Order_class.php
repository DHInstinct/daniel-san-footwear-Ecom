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

    public function GetTrackingNum($cusID)
    {
        $query = "select * from cit410s21.order where cus_ID='$cusID'order by ord_Date desc";
        $results = $this->db->get_results($query);

        return $results;
    }

    public function GetOrderViaCustomer($cusID)
    {
        $query = "sELECT ord.ord_ID, sum(ord_Price*ord_Qty) + ord.ord_ship as totalPrice, ord_Qty, ord.ord_ship, ord.ord_Date, ord.ord_Track, add_Street, add_City, add_State, add_Zip
        FROM cit410s21.order ord 
        left join orddetailopts odo on ord.ord_ID = odo.ord_ID
        left join orddetail od on ord.ord_ID = od.ord_ID
        left join address a on ord.add_ship = a.add_ID
		where ord.cus_ID =$cusID group by ord.ord_ID, ord.ord_ship order by ord.ord_ID;";

        $results = $this->db->get_results($query);

        return $results;

    }

    public function GetOrderDetails($cusID, $ordID)
    {
        $query="sELECT * FROM cit410s21.order ord 
        inner join orddetail od on ord.ord_ID=od.ord_ID
        inner join product p on p.pro_ID=od.pro_ID
        where ord.cus_ID=$cusID and ord.ord_ID=$ordID
        ";

        $results = $this->db->get_results($query);

        return $results;
    }


}



?>
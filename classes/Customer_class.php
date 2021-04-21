<?

class Customer {

    private $db;

    public function __construct()
    {
        //ctor
        $this->db = DB::getInstance();

    }

    public function AddCustomer($fname, $lname, $email, $password)
    {

        $user = array(
            'cus_FirstName'=> $fname,
            'cus_LastName'=> $lname,
            'cus_EMail'=> $email,
            'cus_Password'=>$password
        );

        $this->db->insert('cit410s21.customer', $user);

        return $user;
    }


    public function CheckCustomer($email, $password)
    {
        $query = "select * from customer where cus_EMail='$email' and cus_Password='$password'";

        $results = $this->db->num_rows($query);

        if($results == 1)
        {
            $customer = $this->db->get_results($query);
            return $customer;
        }
        else
        {
            return $results;
        }
    }

    public function AddAddress($cus_ID, $street, $street2, $city, $state, $zip)
    {
        $address = array(
            'cus_ID'=> $cus_ID,
            'add_Street'=> $street,
            'add_Street2'=> $street2,
            'add_City'=> $city,
            'add_State'=> $state,
            'add_Zip'=>$zip
        );

        $this->db->insert('cit410s21.address', $address);

        return $address;
    }

    public function GetAddress($cus_ID)
    {
        $query = "select * from address where cus_ID='$cus_ID'";

        $data = $this->db->get_results($query);
        return $data;
    }

    public function AddCard($carNum, $carName, $carExp, $carSec, $cus_ID, $add_ID)
    {
        $card = array(
            'cus_ID'=> $cus_ID,
            'car_Name'=> $carNum,
            'car_Num'=> $carName,
            'car_Exp'=> $carExp,
            'car_Sec'=>$carSec, 
            'car_Active'=> 'T',
            'add_ID'=> $add_ID
        );

        $this->db->insert('cit410s21.card', $card);

        return $card;
    }
   

    public function GetCardAddress($cus_ID)
    {
        $query = "select * from address a inner join card c on a.add_ID=c.add_ID where a.cus_ID = '$cus_ID'";
        $results = $this->db->get_results($query);

        return $results;
    }

}

?>
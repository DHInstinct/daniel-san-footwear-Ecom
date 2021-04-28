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
        $query = "select * from address a inner join card c on a.add_ID=c.add_ID where a.cus_ID = '$cus_ID' and c.car_Active='T' and c.car_Active='t'";
        $results = $this->db->get_results($query);

        return $results;
    }



    public function GetAllInfo($cus_ID)
    {
        $query = "select * from customer inner join address on address.cus_ID=customer.cus_ID where address.cus_ID=$cus_ID";

        $results = $this->db->get_results($query);

        return $results;
    }

    public function UpdateAddress($add_ID, $cus_ID, $street, $street2, $city, $state, $zip)
    {
        $update_where = array( 'add_ID' => $add_ID);
        $address = array(
            'cus_ID'=> $cus_ID,
            'add_Street'=> $street,
            'add_Street2'=> $street2,
            'add_City'=> $city,
            'add_State'=> $state,
            'add_Zip'=>$zip
        );

        $this->db->update('address', $address, $update_where, 1);

        return $address;
    }

    public function UpdateCard($add_ID, $car_ID, $cardname, $cardnum, $mm, $cvv, $active, $user)
    {
        $update_where = array( 'car_ID' => $car_ID);

        $card = array(
            'cus_ID'=> $user,
            'car_Name'=> $cardname,
            'car_Num'=> $cardnum,
            'car_Exp'=> $mm,
            'car_Sec'=>$cvv, 
            'car_Active'=> $active,
            'add_ID'=> $add_ID
        );

        $this->db->update('cit410s21.card', $card, $update_where, 1);

        return $card;
    }

    public function GetInactiveCard($cus_ID)
    {
        $query = "select * from address a inner join card c on a.add_ID=c.add_ID where a.cus_ID = '$cus_ID' and c.car_Active='F' and c.car_Active='f'";
        $results = $this->db->get_results($query);

        return $results;
    }
}

?>
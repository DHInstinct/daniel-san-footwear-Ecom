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

    public function AddAddress($cus_ID, $street, $city, $state, $zip)
    {
        $address = array(
            'cus_ID'=> $cus_ID,
            'add_Street'=> $street,
            'add_City'=> $city,
            'add_State'=> $state,
            'add_Zip'=>$zip
        );

        $this->db->insert('cit410s21.address', $address);

        return $address;


    }

}

?>
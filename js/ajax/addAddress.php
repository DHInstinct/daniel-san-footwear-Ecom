<?
    session_start();
    require_once("../../config.php");


    $customer = new Customer();
    $db = new DB();

    
    //add address variables
     $street = htmlspecialchars(trim($_POST['street']));
     $zip = htmlspecialchars(trim($_POST['zip']));
     $town = htmlspecialchars(trim($_POST['town']));
     $state = htmlspecialchars(trim($_POST['state']));
     $user = $_SESSION['userid'];
     
     // card variables 
     $name = htmlspecialchars(trim($_POST['cardname']));
     $num = htmlspecialchars(trim($_POST['cardNum']));
     $exp = htmlspecialchars(trim($_POST['mm'])) .', '. htmlspecialchars(trim($_POST['yy']));
     $cvv = htmlspecialchars(trim($_POST['cvv']));


     $data = $customer->AddAddress($user, $street, $town, $state, $zip);

     //querying the address table to get the address id so we can pass it into the card table
     $query = "select * from address where add_Street='$street' and add_city='$town' and add_State='$state' and add_Zip='$zip' and cus_ID='$user'";

     $selectedAddress = $db->get_results($query);

     //adding card 
     $data2 = $customer->AddCard($name, $num, $exp, $cvv, $user, $selectedAddress[0]['add_ID'] );


     echo(json_encode($data));
?>
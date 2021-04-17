<?
    session_start();
    require_once("../../config.php");


    $customer = new Customer();

    //implement this 
    
    //add address
    //  $street = htmlspecialchars(trim($_POST['street']));
    //  $zip = htmlspecialchars(trim($_POST['zip']));
    //  $town = htmlspecialchars(trim($_POST['town']));
    //  $state = htmlspecialchars(trim($_POST['state']));
    //  $user = $_SESSION['userid'];


     //$data = $customer->AddCard();

     echo(json_encode($data));


?>
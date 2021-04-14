<?
session_start();

require_once("../../config.php");

$database = new DB();
$customer = new Customer();


//these are for later :)
// $name = htmlspecialchars(trim($_POST['name']));
// $email = htmlspecialchars(trim($_POST['email']));

    $fname = htmlspecialchars(trim($_POST['fname']));
    $lname = htmlspecialchars(trim($_POST['lname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = md5($_POST['password']);

    $affectedRows = $customer->AddCustomer($fname, $lname, $email, $password);

    //if data is pulled back that means successful account creation
    if($affectedRows)
    {
        //create session variable as the customers First name
        $_SESSION['userlogin'] = $fname;
    }

    echo json_encode($affectedRows);


?>
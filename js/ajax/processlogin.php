<?
session_start();

require_once("../../config.php");


    $customer = new Customer();

    $email = htmlspecialchars(trim($_POST['email']));
    $password = md5($_POST['password']);
 
    $data = $customer->CheckCustomer($email, $password);

    $response = [];

    if(!$data == 0)
    {
        $response['message'] = "Success";
        $_SESSION['userlogin'] = $data[0]['cus_FirstName'];


    }    
    echo json_encode($data);
    





?>
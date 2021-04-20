<?
session_start();

require_once("../../config.php");


    $customer = new Customer();

    $email = htmlspecialchars(trim($_POST['email']));
    $password = md5($_POST['password']);
 
    $data = $customer->CheckCustomer($email, $password);


    if(!$data == 0)
    {

        $_SESSION['userlogin'] = $data[0]['cus_FirstName'];
        $_SESSION['userid'] = $data[0]['cus_ID'];



        // $_SESSION['add_ID'] = $d
        //not working add in confromation that the user is loged in.
        //header('location: index.php');
    }
    else{
        exit();
    } 
    echo json_encode($data);
    





?>
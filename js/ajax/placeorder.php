<?
session_start();

    require_once("../../config.php");

    $order = new Order();
    $cart = new Cart();

//variable
    $shippingAddID = $_POST['shippingAddID'];
    $billingAddID = $_POST['billingAddID'];
    $cardID = $_POST['cardID'];
    $orderShip = $_POST['orderShip'];
    $cusID = $_SESSION['userid'];
    $orderNum = rand(345354, 789099);

    //sending order
    $data = $order->SendOrder($billingAddID, $shippingAddID, $cardID, $cusID, $orderShip, $orderNum);

    $lastID = $data['lastID'];

    //sending order Details
    $data2 = $order->SendOrdetails($lastID, session_id());

    //sending order detail opts
    $data3 = $order->SendOrdetailsOPTS($lastID, session_id());

    //clearing cart
    $cart->ClearCart(session_id());
    $cart->ClearCartOpts(session_id());

    echo json_encode($data);
    // echo json_encode($data2);
    // echo json_encode($data3);




//



?>
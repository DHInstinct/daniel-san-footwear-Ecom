<?

    require_once("../../config.php");
    
    //grabbing productArray from $_POST and decoding
    
    //encoding json
    // echo json_encode($productArray);
    
    // var_dump($productArray);
    
    $productArray = json_decode($_POST['productArray']);

    if(isset($_POST['productArray']))
    {
        //start session
        session_start();
        //set session id to the cartID cookie just incase
        $session = session_id($_COOKIE['cartID']);
        //create cart
        $cart = new Cart();

        //clear the cart
        $cart->ClearCart(session_id());

        $cart->UpdateCart($session, $productArray);
        
        echo json_encode($productArray);

    }
    

?>
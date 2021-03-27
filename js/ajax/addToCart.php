<?
    // start our session
    session_start();
    session_id($_COOKIE['cartID']);

    require_once("../../config.php");

    // simply take the product ID that we get via POST and add it to the cart table
    $cart = new DB();

    // add the item to the cart
    // this assumes the item was not already there... must check to see if it existed and if so, increment the quantity
     // now, get the total # of items in this person's cart and return via JSON
    $items = $cart->get_row("select sum(cart_qty) NUM from cart where cart_ID='" . session_id() . "' and pro_ID='" . $_POST['product'] . "'");
    if ($items[0] != 0)
    {
        // item existed, update its quantity
        $variables = array("cart_qty"=> ($items[0]+1));
        $where = array("cart_ID"=>session_id(), "pro_ID"=>$_POST['product']);
        $cart->update("cart",$variables, $where);
    }
    else
    {
        // item did not exist in cart
        $values = array("cart_ID"=>session_id(), "pro_ID"=>$_POST['product'], "cart_qty"=> 1);
        $cart->insert("cart",$values);
    }


    // now, get the total # of items in this person's cart and return via JSONselect sum(cart_qty) as NUM, pro_ID as PROD from cart
    //$items = $cart->get_row("select sum(cart_qty) NUM, from cart where cart_ID='" . session_id() . "'");
    $items = $cart->get_row("select sum(cart_qty) as NUM, pro_Name as proName from cart inner join product on cart.pro_ID=product.pro_ID where cart_ID='" . session_id() . "'");

    //$items = $cart->get_row("select sum(cart_qty) NUM from cart where cart_ID='" . session_id() . "' and pro_ID='" . $_POST['product'] . "'");

    // build json for our results
    echo json_encode(array("cartQty"=>$items[0], "message"=>"success", "cart"=>session_id(), "product"=>$_POST['product'], "image"=>Product::GetImage($_POST['product'])));
    //cho json_encode($items);

?>
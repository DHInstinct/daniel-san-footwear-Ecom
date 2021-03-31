<?

    $name = $_POST['name'];
    $price = $_POST['price'];
    $img = $_POST['img'];
    // echo($name);
    require_once('../../config.php');

   echo json_encode(array("name"=> $name, "price"=> $price, "img" =>$img));

?>
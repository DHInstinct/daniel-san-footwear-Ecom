<?
    require_once('../../config.php');

    $name = $_POST['name'];
    $price = $_POST['price'];
    $img = $_POST['img'];
    $id = $_POST['id'];

   echo json_encode(array("name"=> $name, "price"=> $price, "img" =>$img, "id"=>$id));

?>


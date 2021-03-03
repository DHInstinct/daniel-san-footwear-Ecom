<?

// page to product json so i can read it via ajax

    require_once('../../config.php');

    $database = new DB();
    
    $query = "select pro_ID, pro_Name, pro_Descript, pro_Price FROM product";     
    // Preparing Query
    $stmt = $database->prepare($query);
    //Execute
    $stmt->execute();
    //Store result
    $stmt->store_result();
    //bind
    $stmt->bind_result($pro_ID, $pro_Name, $pro_descript, $pro_price);


     while($stmt->fetch())
     {
         $products[] = array("pro_ID"=>$pro_ID, "pro_Name"=>$pro_Name, "pro_descript"=>$pro_descript, "pro_price"=>$pro_price);
     }
    
     echo json_encode($products);



?>
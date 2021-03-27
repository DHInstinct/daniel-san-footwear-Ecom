<?

//implemented with Tyler Truman

require_once("../../config.php");

$database = new DB();
$review = new Review();


    //these are for later :)
    // $name = htmlspecialchars(trim($_POST['name']));
    // $email = htmlspecialchars(trim($_POST['email']));
    
    $message = htmlspecialchars(trim($_POST['message']));
    $score = htmlspecialchars(trim($_POST['score']));
    $prodID = htmlspecialchars(trim($_POST['prodID']));

    $affectedRows = $review->InsertReview($prodID, $score, $message);


    echo json_encode($affectedRows);

    header("location : ../../product.php?id=$prodID");

?>
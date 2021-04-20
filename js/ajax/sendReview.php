<?

//implemented with Tyler Truman

require_once("../../config.php");

$database = new DB();
$review = new Review();


    $message = htmlspecialchars(trim($_POST['message']));
    $score = htmlspecialchars(trim($_POST['score']));
    $prodID = htmlspecialchars(trim($_POST['prodID']));

    $affectedRows = $review->InsertReview($prodID, $score, $message);


    echo json_encode($affectedRows);

    header("location : ../../product.php?id=$prodID");

?>
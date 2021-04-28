<?
session_start();

require_once('../../config.php');

    $customer = new Customer();
    $db = new DB();

    $add_ID = htmlspecialchars(trim($_POST['addID']));
    $street = htmlspecialchars(trim($_POST['street']));
    $street2 = htmlspecialchars(trim($_POST['street2']));
    $zip = htmlspecialchars(trim($_POST['zip']));
    $town = htmlspecialchars(trim($_POST['town']));
    $state = htmlspecialchars(trim($_POST['state']));
    $user = $_SESSION['userid'];

    var_dump($street, $street2, $zip, $town, $state, $user);

    $customer->UpdateAddress($add_ID, $user, $street, $street2, $town, $state, $zip);

    header('location:../../account.php');



?>
<?
session_start();

require_once('../../config.php');

    $customer = new Customer();
    $db = new DB();

    $add_ID = htmlspecialchars(trim($_POST['addid']));
    $car_ID = htmlspecialchars(trim($_POST['cardid']));
    $cardname = htmlspecialchars(trim($_POST['cardname']));
    $cardnum = htmlspecialchars(trim($_POST['cardnum']));
    $mm = htmlspecialchars(trim($_POST['mm']));
    $cvv = htmlspecialchars(trim($_POST['cvv']));
    $state = htmlspecialchars(trim($_POST['state']));
    $active = htmlspecialchars(trim($_POST['active']));
    $user = $_SESSION['userid'];

    $data = $customer->UpdateCard($add_ID, $car_ID, $cardname, $cardnum, $mm, $cvv, $active, $user);

    header('location:../../account.php');



?>
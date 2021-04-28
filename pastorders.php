<?
session_start();

if(!isset($_SESSION['userlogin'])){
    header('location: login.php');
}

require_once("header.php");

$order = new Order();


?><div class='container'>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Order Number</th>
      <th scope="col">Order Date</th>
      <th scope="col">Total Price</th>
      <th scope="col">Tracking Number</th>
    </tr>
  </thead>
  <tbody>
  <?
        
        $data = $order->GetOrderViaCustomer($_SESSION['userid']);
        
        foreach($data as $result)
        {
          echo("
            <tr>
            <th scope='row'><a href='pastorderdetails.php?ord_ID=" . $result['ord_ID'] . "'>" . $result['ord_ID'] . "</a></th>
            <td>" . $result['ord_Date'] . "</td>
            <td>$" . $result['totalPrice'] . "</td>
            <td>" . $result['ord_Track'] . "</td>
            </tr>
            ");
        }
  
  ?>
  </tbody>
  <small>Click order number to view more details</small>

</table>
</div>

<div class='footer'>
<?

require_once("footer.php");


?>
</div>
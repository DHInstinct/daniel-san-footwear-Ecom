<?
session_start();

if(!isset($_SESSION['userlogin']) || !isset($_GET['ord_ID'])){
    header('location: index.php');
}

    require_once('header.php');

    $order = new Order();

?>
<div class='container'>
  <?
        
        $data = $order->GetOrderDetails($_SESSION['userid'], $_GET['ord_ID']);

         if(count($data) == 0)
         {
            echo("
            <br />
            <br />
            <blockquote class='blockquote text-center'>
            <p class='h3 mb-0'>This order is empty.</p>
            <footer class='blockquote-footer'>Daniel-San-Footwear Dev Team <cite title='Source Title'></cite></footer>
            </blockquote>
            
            ");
         }
         else{
             echo("
             <table class='table'>
             <thead>
               <tr>
                 <th scope='col'>Name</th>
                 <th scope='col'>Order Quantity</th>
                 <th scope='col'>Order Price</th>
                 <th scope='col'>Tracking Number</th>
               </tr>
             </thead>
             <tbody>
             ");
              foreach($data as $result)
              {
                  echo("
                  <tr>
                  <th scope='row'>" . $result['pro_Name'] . "</th>
                  <td>" . $result['ord_Qty'] . "</td>
                  <td>$" . $result['ord_Price'] . "</td>
                  <td>" . $result['ord_track'] . "</td>
                  </tr>
                  ");
              }
              echo("
             </thead>
             <tbody>
             </tbody>
             </table>
             ");
            }
  
  ?>
</div>

<div class='footer'>
<?
    require_once('footer.php');
?>
</div>
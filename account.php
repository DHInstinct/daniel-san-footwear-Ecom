<?
session_start();

if(!isset($_SESSION['userlogin'])){
    header('location: login.php');
}

require_once("header.php");

// $order = new Order();
$customer = new Customer();


?>
<div class="container">
    <div class="main-body">
          <br />
          <br />
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>Hi <?echo($_SESSION['userlogin']);?></h4>
                      <p class="text-secondary mb-1">Click to view past orders!</p>
                      <form action="pastorders.php" class="inline">
                        <button class=" btn btn-warning submit-button" >Past Orders</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?
                    $data = $customer->GetAllInfo($_SESSION['userid']);
                    echo($data[0]['cus_FirstName'] . " " . $data[0]['cus_LastName']);
                    // var_dump($data);
                    
                    ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?
                      echo($data[0]['cus_EMail']);
                    ?>

                    </div>
                  </div>
                  <hr>
                  
                  <div class="row">
                    <div class="col-sm-6 text-secondary">
                    <h3 class="mb-0">Avaliable Addresses</h3>

                      <?
                      $counter = 1;
                        foreach($data as $result)
                        {
                          echo("$counter: <a data-addid='".  $result['add_ID'] ."' data-state='".  $result['add_State'] ."' data-town='".  $result['add_City'] ."' data-zip='".  $result['add_Zip'] ."' data-street2='" .  $result['add_Street2'] ."' data-street='" .  $result['add_Street'] ."' href='#' class='fillCard'>" . $result['add_Street'] ."</a><br />");
                          $counter++;
                        }
                      ?>
                    </div>
                    <div class="col-sm-6 text-secondary">
                    <h3 class="mb-0">Avaliable Cards</h3>

                      <?
                       $results = $customer->GetCardAddress($_SESSION['userid']);

                      $counter = 1;
                        foreach($results as $result)
                        {
                          echo("$counter: <a href='#' class='fillCard' data-addid='".  $result['add_ID'] ."' data-cardid='".  $result['car_ID'] ."' data-cvv='".  $result['car_Sec'] ."' data-month='".  $result['car_Exp'] ."' data-cnum='".  $result['car_Num'] ."' data-carname='".  $result['car_Name'] ."'>" . $result['car_Name'] ." ". $result['car_Num'] ."</a><br />");
                          $counter++;
                        }

                        $results = $customer->GetInactiveCard($_SESSION['userid']);
                        echo("
                    <h4 class='mb-0'>Inactive Cards</h4>
                        
                        ");
                        $counter = 1;
                        foreach($results as $result)
                        {
                          echo("$counter: <a href='#' class='fillCard' data-addid='".  $result['add_ID'] ."' data-cardid='".  $result['car_ID'] ."' data-cvv='".  $result['car_Sec'] ."' data-month='".  $result['car_Exp'] ."' data-cnum='".  $result['car_Num'] ."' data-carname='".  $result['car_Name'] ."'>" . $result['car_Name'] ." ". $result['car_Num'] ."</a><br />");
                          $counter++;
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
<br />
<br />
<br />

<div class='container'>
<div class='row'>
<div class='col-lg-6'>
<div class='text-center'>
<h3>Need to update your address? </h3>
<small class="form-text text-muted">Click an address above to autofill form</small>
</div>
<br />
<form action='js/ajax/updateEmail.php' method='post' autocomplete='off'>
  <div class="form-group form-label-group">
    <input  required type="text" class="form-control" name='street' id="street" aria-describedby="emailHelp" placeholder="Update email">
    <label for="exampleInputEmail1">Street Address</label>
    <input type="hidden" class="form-control" name='addID' id="addID" aria-describedby="emailHelp" placeholder="Update email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
  </div>
  <br />
  <div class="form-group form-label-group">
    <input required type="text" class="form-control" name='street2' id="street2" aria-describedby="emailHelp" placeholder="Update email">
    <label for="exampleInputEmail1">Street Address 2</label>
    <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
  </div>
  <br />
  <div class="form-group form-label-group">
    <input required type="text" class="form-control" name='zip' id="zip" aria-describedby="emailHelp" placeholder="Update Zip">
    <label for="exampleInputEmail1">Postal Code/Zip</label>
  </div>
  <br />
  <div class="form-group form-label-group">
    <input required type="text" class="form-control" name='town' id="town" aria-describedby="emailHelp" placeholder="Update Town/City">
    <label for="exampleInputEmail1">Town/City</label>
  </div>
  <br />
  <div class="form-group form-label-group">
    <input type="text" class="form-control" name='state'id="state" aria-describedby="emailHelp" placeholder="Update State">
    <label for="exampleInputEmail1">State</label>
  </div>
  
  <button type="submit" class="btn btn-warning">Submit</button>
</form>
</div>

<div class='col-lg-6'>
<div class='text-center'>
<h3 >Need to update a Card? </h3>
<small class="form-text text-muted">Click a card above to autofill form</small>
</div>
<br />
<form action='js/ajax/updateCard.php' method='post' autocomplete='off'>
  <div class="form-group form-label-group">
    <input required type="text" class="form-control" name='cardname' id="cardname" aria-describedby="emailHelp" placeholder="MasterCard, Visa, etc">
    <label for="exampleInputEmail1">Card Name</label>
    <input type="hidden" class="form-control" name='cardid' id="cardid">
    <input type="hidden" class="form-control" name='addid' id="addid">
    <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
  </div>
  <br />
  <div class="form-group form-label-group">
    <input required type="text" class="form-control" name='cardnum' id="cardnum" aria-describedby="emailHelp" placeholder="Update Card Number">
    <label for="exampleInputEmail1">Card Number</label>
  </div>
  <br />
  <div class="form-group form-label-group">
    <input required type="text" class="form-control" name='mm' id="mm" aria-describedby="emailHelp" placeholder="Update Exp date">
    <label for="exampleInputEmail1">Exp Date</label>
  </div>
  <br />
  <div class="form-group form-label-group">
    <input required type="text" class="form-control" name='cvv' id="cvv" aria-describedby="emailHelp" placeholder="Update CVV">
    <label for="exampleInputEmail1">CVV</label>
  </div>
  <div class="form-group">
      <label>Card Active</label>
      <select name='active' class="form-control">
        <option value='T' >Yes, I want my card to remain active</option>
        <option value='F' >No, I want my card deactived</option>
      </select>
    </div>
  
  <button type="submit" class="btn btn-warning">Submit</button>
</form>
</div>

</div>
</div>



<br />
<br />
<br />
<br />



<!-- <div class='footer'> -->
<?

require_once("footer.php");


?>
<!-- </div> -->
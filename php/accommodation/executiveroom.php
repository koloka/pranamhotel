<?php
  session_start();
  define('TITLE','premier room');
  include('../../html/template/header.html');
  include('../login/connect.php');
?>

<div class="indexbody">
  <div class="w3-row-padding w3-padding-16 center">
    <?php
      $query = "SELECT * FROM rooms WHERE kind='executive'";
      $results = mysqli_query($dbc, $query);
      while($row = mysqli_fetch_array($results)){
    ?>
    <div class="w3-third w3-margin-bottom">
      <img src="<?php print '../../'.$row['imgpath']; ?>" alt="Norway" style="width:100%">
      <div class="w3-container w3-white">
        <form class="" action="../booking/booking.php?roomid=<?php print $row['roomid']; ?> " method="post">
          <h3><?php print $row['roomname']; if($row['isavailable'] == 0) print " Not Available"; ?></h3>
          <h6 class="w3-opacity">From $<?php print $row['price']; ?></h6>
          <p>
            <?php if($row['bed'] == 1 )
                    print 'Single';
                  if($row['bed'] == 2)
                    print 'Double';
            ?> bed
          </p>
          <p><?php print $row['size']; ?>m<sup>2</sup></p>
          <p class="w3-large"><i class="fa fa-bath"></i> <i class="fa fa-phone"></i> <i class="fa fa-wifi"></i></p>
          <button type="submit" class="w3-button w3-block w3-black w3-margin-bottom chooseroom">Choose Room</button>
        </form>
      </div>
    </div><!-- end one block -->
  <?php } ?>



  </div>
</div>
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="dea8cf05-54ce-4d6d-a802-d2c8ead779d4";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
<?php
include('../../html/template/footer.html');
 ?>

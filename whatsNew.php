<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="whatsStyle.css">
    <link
      rel="icon"
      type="image/x-icon"
      href="/assets/img/S1ProjectsLogo.png"
    />
    <title>S1PROJECTS</title>
  </head>
<body>

  <div class="stickyMenu">
    <h1  class="whatsNew">Co nowego?</h1>
  <div class="backHome"  onclick="window.location.href='index.php'">
    <h1 style="font-family: MPLUS; font-size: 200%;">SONE|PROJECTS</h1>
    <img src="assets/img/S1v3.png" alt="s1" style="width: 65px;  position: absolute; opacity: 0.2; padding: 20%;">
    
  </div>
</div>
<?php 
  include 'dbcon.php';
  $sql = "SELECT * FROM `coNowego` ORDER BY `coNowego`.`id` DESC" ;
  $result = $conn -> query($sql); 
  
  if($result->num_rows > 0){
    $updates = $result->fetch_all(MYSQLI_ASSOC);
   

    foreach($updates as $update) {
      $changes = explode(", ",$update['zmiany']);
      $number = str_pad($update['id'], 4,'0', STR_PAD_LEFT)
      ?>
      <div class="update">
        <h1>AKTUALIZACJA #<?php echo $number?></h1>
        <p class="data"><?php echo $update['data']?> <label class="s1">S1</label></p>
        <h2>główne zmiany</h2>
       <ul>
          <?php 
            foreach($changes as $change) {
              ?> <li><?php echo $change?></li> <?php
            }
          ?>
        </ul>
      </div>
      <?php
    }
  }
  $conn->close();
?>  
</body>
</html>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plans.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=task_alt" />
    <link
      rel="icon"
      type="image/x-icon"
      href="/assets/img/S1ProjectsLogo.png"
    />
    <title>plans</title>
</head>
<body>
    <div class="stickyMenu">
        <h1  class="whatsNew">PLANY</h1>
      <div class="backHome"  onclick="window.location.href='index.php'">
        <h1 style="font-family: MPLUS; font-size: 200%;">SONE|PROJECTS</h1>
        <img src="assets/img/S1v3.png" alt="s1" style="width: 65px;  position: absolute; opacity: 0.2; padding: 20%;"> 
      </div>

      <div class="plans">
        <?php 
            include 'dbcon.php';
            $sql = "SELECT * FROM `plany` WHERE ukonczone LIKE false ORDER BY `plany`.`id` DESC";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $plans = $result->fetch_all(MYSQLI_ASSOC);

                foreach($plans as $plan) {
                    ?>
                    <div class="plan">
                        <img src="assets/img/<?php echo $plan['zdjecie'] ?>" alt="planCover"> 
                        <div class="textPart">
                        <h1><?php echo $plan['tytul'] ?></h1>
                         <?php echo $plan['opis'] ?>
                        <p>
                            <?php 
                                $pData = "do ". $plan['przewidywanaData'];
                                if($plan['przewidywanaData'] == null) {$pData = 'TBD';}
                                if($plan['ukonczone'] == true) {
                                    echo "<p>"."Data ukończenia: ". $plan['dataUkonczenia']. "</p>";
                                    echo "<h3><i class='material-symbols-rounded'>task_alt</i>zrobione</h3>"; 
                                } else {
                                    echo "Przewidywana data ukończenia: ". $pData; 
                                }
                            ?>
                        </p>
                        </div>
                    </div>
                    <?php
                }
            }
            $conn->close();
            ?>
     </div>
           <h1>UKOŃCZONE</h1>
    <div class="plansDone">
            <?php
            include 'dbcon.php';
            $sql = "SELECT * FROM `plany` WHERE ukonczone LIKE true ORDER BY `plany`.`id` DESC";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $plans = $result->fetch_all(MYSQLI_ASSOC);

                foreach($plans as $plan) {
                    ?>
                    <div class="plan">
                        <img src="assets/img/<?php echo $plan['zdjecie'] ?>" alt="planCover"> 
                        <div class="textPart">
                        <h1><?php echo $plan['tytul'] ?></h1>
                         <?php echo $plan['opis'] ?>
                        <p>
                            <?php 
                                $pData = $plan['przewidywanaData'];
                                if($plan['przewidywanaData'] == null) {$pData = 'TBD';}
                                if($plan['ukonczone'] == true) {
                                    echo "<p>"."Data ukończenia: ". $plan['dataUkonczenia']. "</p>";
                                    echo "<h3><span class='material-symbols-rounded'>task_alt</span>zrobione</h3>"; 
                                } else {
                                    echo "Przewidywana data ukończenia: ". $pData; 
                                }
                            ?>
                        </p>
                        </div>
                    </div>
                    <?php
                }
            }
            $conn->close();
            ?>
    </div>
</body>
</html>

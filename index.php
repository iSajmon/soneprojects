<!DOCTYPE html>
<html lang="pl">
  <head>
    <?php
      include 'dbcon.php';
      session_start();

      $querryGet = "SELECT * FROM `visitors`";
      $resultGet = $conn->query($querryGet);

      if($resultGet->num_rows > 0) {
        if(!isset($_SESSION['visiting']) || $_SESSION['visiting'] !== true) {
          $_SESSION['visiting'] = true;
          $currentDate = date('Y-m-d');

          $rowGet = $resultGet->fetch_assoc();

          if($currentDate === $rowGet['currentDate']) {
            $querryUpdate = "UPDATE visitors SET visitorsToday = (visitorsToday+1),	visitorsTotal = (visitorsTotal+1)";
            $conn->query($querryUpdate);
          } else {
            $querryReset = "UPDATE visitors SET visitorsToday = 0, currentDate = '$currentDate'";
            $querryUpdate = "UPDATE visitors SET visitorsToday = (visitorsToday+1),	visitorsTotal = (visitorsTotal+1)";
            $conn->query($querryReset);
            $conn->query($querryUpdate);
          }

        } 
      }
      $conn->close();
    ?>
    <meta property="og:title" content="SONE|PROJECTS">
    <meta property="og:image" itemprop="image" content="https://soneprojects.com/assets/img/S1ProjectsLinkLogo.jpg">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://soneprojects.com/">
    <link itemprop="thumbnailUrl" href="https://soneprojects.com/assets/img/S1ProjectsLinkLogo.jpg">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/quickCSS/loader.css">
    <link rel="stylesheet" href="style.css" id="style" media="screen and (min-width: 600px)"/>
    <link rel="stylesheet" href="styleMobile.css" id="styleMobile" media="screen and (max-width: 600px)"/>
    <link rel="stylesheet" href="styleFont.css">
    <link
      rel="icon"
      type="image/x-icon"
      href="/assets/img/S1ProjectsLogo.png"
    />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@100..700&display=swap">
    <script defer src="script.js"></script>
    <title>S1PROJECTS</title>
  </head>
  <body onload="scrollAnimation()" style="margin: 0">
    <div class="load">
      <img src="assets/img/S1v3.png">
      <div class="loader" id="loader"></div>
      <p>LOADING</p>
    </div>
      <?php
        include 'dbcon.php';
        $sql = "SELECT data FROM newUpdate";
        $sql2 = "SELECT * FROM `coNowego` ORDER BY `coNowego`.`id` DESC LIMIT 1;";
        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);

        if($result->num_rows > 0) {
          $row = $result->fetch_all(MYSQLI_ASSOC);
          if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc(); 
            $data = $row[0]['data'];

            $number = str_pad($row2['id'], 4, '0', STR_PAD_LEFT);

            $currentDate = new DateTime();
            $updateDate = new DateTime($data);
            $diff = $currentDate->diff($updateDate)->days;
            if ($diff <= 5 && $currentDate > $updateDate) {
              ?>
                <div class="newUpdateHide" id="newUpdate">
                    <h1>Aktualizacja #<?php echo $number?> dostępna: <a href="whatsNew.php" onclick="closeUpdateMessage()">ZOBACZ</a></h1>
                    <span class="material-symbols-rounded" onclick="closeUpdateMessage()">close</span>
                </div>
                <?php
            } 
          } 
        }
        $conn->close()
      ?>
    <div class="main">
     
      <div class="menu_blur" id="menub">
        <div class="menu" id="menu">
          <img src="assets/img/S1v3.png" alt="logo" />
          <div class="modeSlider"> 
            <div class="sliderCircle" onclick="changeStyle()">
            <span class="material-symbols-rounded dmode">dark_mode</span>
            <span class="material-symbols-rounded lmode">light_mode</span>
            </div>
          </div>
          <p style="font-size: 30px;"><b>PROJECTS</b></p>
          <p class="whatsNew" onclick="window.location.href='whatsNew.php'">co nowego?</p>
        </div>
      </div>
      <div class="showcase">
          <?php 
            include 'dbcon.php';

            $sql = "SELECT * FROM projects WHERE showcase = 'yes'";
            $result = $conn->query(query: $sql);

            if ($result->num_rows > 0) {

                $projects = $result->fetch_all(MYSQLI_ASSOC);

                foreach ($projects as $project) {
                  ?>
                  <div class="projekt" onclick="showPage('<?php echo $project['url']; ?>')">
                  <img src="assets/img/<?php echo $project['photo']; ?>" alt="<?php echo $project['nazwa']; ?>" />
                    <div class="text">
                      <h2> <?php echo $project['nazwa']; ?></h2>
                      <p><?php echo $project['description']; ?></p>
                    </div>
                  </div>
                  <?php
                } 
              } else {
                  echo "Brak wyników";
              }
              $conn->close();
          ?>
      </div>

      <div class="showcaseMobile">
          <?php 
            include 'dbcon.php';

            $sql = "SELECT * FROM projects WHERE showcase = 'yes'";
            $result = $conn->query(query: $sql);

            if ($result->num_rows > 0) {

                $projects = $result->fetch_all(MYSQLI_ASSOC);

                foreach ($projects as $project) {
                  ?>
                  <div class="projekt" onclick="textActive(this)">
                  <img src="assets/img/<?php echo $project['photo']; ?>" alt="<?php echo $project['nazwa']; ?>" />
                    <div class="text" id="text" onclick="showPage('<?php echo $project['url']; ?>')">
                      <h2> <?php echo $project['nazwa']; ?></h2>
                      <p><?php echo $project['description']; ?></p>
                    </div>
                  </div>
                  <?php
                } 
              } else {
                  echo "Brak wyników";
              }
              $conn->close();
          ?>
      </div>
      
      <div class="rest">
        <h1>WSZYSTKIE PROJEKTY</h1>
        <div class="restProjects">
          <?php
              include 'dbcon.php';
              include 'restProjects.php';
            
             
              $conn->close();
          ?>
      </div>
    </div>
    
      <footer>
      <div class="logo">
          <img src="assets/img/S1ProjectsLogoTransparent.png" alt="S1ProjectsLogoTransparent">
      </div>
      <img onclick="window.open('https://github.com/iSajmon')" class="github" src="assets/img/GitHub-Logo.png" alt="github">
      <div class="links">
        <ul>
          <li><a href="about.php">dowiedz się więcej <i style="position:absolute">[w budowie]</i></a></li>
          <li><a href="whatsNew.php">co nowego?</a></li>
          <li><a href="mailto:simon@soneprojects.com">kontakt</a></li>
          <li><a href="plans.php">plany</a></li>
          <li><a href="github.php">biblioteka github <i style="position:absolute">[w budowie]</i></a></li>
          <li><a href="admin/admin.php">admin login</a></li>
        </ul>        
      </div>
      <div style="width:100%">
         <div class="visitorsCounter">
          <span class="material-symbols-rounded">visibility</span>
          <?php
              include 'dbcon.php';
              $querryGet = "SELECT * FROM `visitors`";
              $resultGet = $conn->query($querryGet);
        
              if($resultGet->num_rows > 0) {
                $currentDate = date('Y-m-d');
                $rowGet = $resultGet->fetch_assoc();
                ?><h3>Wizyty dzisiaj: <?php echo $rowGet['visitorsToday']; ?></h3>
                <h3>Wizyty ogólnie: <?php echo $rowGet['visitorsTotal']; ?> </h3> <?php
              }
          $conn->close()
          ?>
        </div>
        <div class="copy">
          <p>copyright &copy; 2024 soneprojects</p>
        </div>
      </div>
     
      </footer>

    <div class="cookiesWarningHide" id="cookiesWarning">
      <div>
        <p>Strona używa pliki cookies(ciasteczka) do prawidłowego działania </p>
      <p style="font-size: 15px; color: gray; font-weight: normal; margin-top: -20px;">Ten komunikat zostanie ukryty na zawsze po kliknięciu przycisku</p>
      </div>
      <button id="cookiesAccept" onclick="cookiesAccept()">ROZUMIEM</button>
    </div>
  </body>
</html>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="icon"
      type="image/x-icon"
      href="/assets/img/S1ProjectsLogo.png"
    />
    <link rel="stylesheet" href="github.css">
    <title>Biblioteka Github</title>
</head>
<body>
<div class="stickyMenu">
        <h1  class="whatsNew">BIBLIOTEKA PROJEKÓW - GITHUB</h1>
      <div class="backHome"  onclick="window.location.href='index.php'">
        <h1 style="font-family: MPLUS; font-size: 200%;">SONE|PROJECTS</h1>
        <img src="assets/img/S1v3.png" alt="s1" style="width: 65px;  position: absolute; opacity: 0.2; padding: 20%;"> 
 </div>
    <main>
    <?php
        include 'dbcon.php';
        $sql = "SELECT * FROM `projects` INNER JOIN githubLinks ON githubLinks.id_projektu = projects.id;";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            foreach($result as $row) {
                ?> 
                <div class="projekt" style="background-color: <?php echo $row['dominantColor'] ?>;" onclick="window.open('<?php echo $row['LINK']; ?>')">
                    <img class="projectLogo" src="assets/img/<?php echo $row['photo']; ?>" alt="<?php echo $row['photo']; ?>">
                    <div class="overlay" style="background-color: <?php echo $row['dominantColor'] ?>; box-shadow: -5px 0px 10px 10px <?php echo $row['dominantColor'] ?>;"></div>
                    <h2><?php echo $row['nazwa']; ?></h2>
                </div>
                <?php
            }
        }
        $conn->close()
    ?>
    </main>
</body>
</html>
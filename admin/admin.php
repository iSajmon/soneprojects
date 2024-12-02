<?php
session_start();  

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Console</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
</head>

<body>
<?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true): ?>
    <div class="logowanie">
        <h1>ADMIN PANEL</h1>
    
        <form action="php/login.php" method="POST">
            <input type="text" name="login" placeholder="Nazwa użytkownika">
            <input type="password" name="password" placeholder="Hasło">
            <button type="submit">ZALOGUJ</button>
        </form>
    </div>
<?php else: ?>
    <h1>ADMIN PANEL</h1>
    <div class="helloMessage">
        <h2>Witaj <?php echo $_SESSION['username']; ?>!</h2>
        <form action="php/logout.php" method="POST">
           <button type="submit" name="logout">Wyloguj się</button>
        </form>
        <img onclick="window.location.href='/index.php'" src="/assets/img/S1ProjectsLogoTransparentMenu.png" alt="S1ProjectsLogo.png" >
    </div>
    <hr>
<main>
    <div class="addProject">
        <h3>DODAJ PROJEKT <button class="addRowMobile" type="button" onclick="show(this,'addProject')">></button></h3>
        <form id="projectForm" action="php/addProject.php" method="post">
            <table>
                <tr>
                    <td><p>nazwa</p></td>
                    <td><input type="text" id="nameInput" name="name" required></td>
                </tr>
                <tr>
                    <td><p>url(projects/..)</p></td>
                    <td><input type="text" id="urlInput" name="url" required></td>
                </tr>
                <tr>
                    <td>zdjęcie</td>
                    <td><input type="text" id="imgInput" name="img" required></td>
                </tr>
                <tr>
                    <td>badge</td>
                    <td><textarea id="badgeInput" name="badge" placeholder="0 - PC ONLY, 1 - BETA, 2 - WORK IN PROGRESS"></textarea></td>
                </tr>
                <tr>
                    <td>opis</td>
                    <td><textarea id="descriptionInput" name="description"></textarea></td>
                </tr>
                <tr>
                    <td>wyróżnione</td>
                    <td><input type="checkbox" id="showcaseInput" name="showcase"></td>
                </tr>
            </table>
            <input type="number" name="id" hidden>
            <div class="buttons">
                <button type="submit" id="submitButton">DODAJ</button>
                <button type="reset" onclick="resetForm()">RESET</button>
                <?php
        if (isset($_SESSION['success_message'])) {
            echo "<p style='color: green;'>" . $_SESSION['success_message'] . "</p>";
            unset($_SESSION['success_message']); 
        }
        
        if (isset($_SESSION['error_message'])) {
            echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
            unset($_SESSION['error_message']); 
        }
        ?>
            </div>
      
        </form>
        <div class="projects">
            <h1>PROJEKTY</h1> <hr>
          <?php
              include '../dbcon.php';
            
              $sql = "SELECT * FROM projects";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {

                  $projects = $result->fetch_all(MYSQLI_ASSOC);
              
                  foreach ($projects as $project) {
                    ?>
                    <div class="project">
                        <div class="text">
                            <h2>
                                <?php echo $project['nazwa'];?>
                            </h2>
                            <p><?php echo $project['description']; ?></p>
                        </div>
                        <div style="display:  flex;">
                        <button data-project='<?php echo json_encode($project, JSON_HEX_TAG); ?>' onclick="editProject(this)">Edytuj</button>

                        <form class="editMode" action="php/modifyProject.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit">Usuń</button>
                        </form>
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
    </div>

    <div class="addUpdate">

        <h3>DODAJ AKTUALIZACJE <button class="addRowMobile" type="button" onclick="show(this,'addUpdate')">></button></h3>
        <?php  $currentDate = new DateTime(); ?> <p><?php echo $currentDate->format('Y-m-d') ?></p>
        <form action="php/addUpdate.php" method="post">
           <label>Aktualizacja projektu: </label><select name="updatedProject">
            <option value=""></option>
            <?php 
                include '../dbcon.php';
                $sql = "SELECT id, LOWER(nazwa) as lowerNazwa FROM projects WHERE UPPER(nazwa) NOT LIKE 'PLACEHOLDER'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    foreach($result as $row) {
                        ?> <option value="<?php echo $row['id']; ?>"> <?php echo $row['lowerNazwa']; ?></option> <?php
                    }
                }
                
             ?>
             </select>
            <ul id="list">
                <li><div class="listItems"><textarea type="text" name="update[]" required></textarea><button class="addRow" type="button" onclick="addUl(this)">+</button></div></li>
            </ul>
            <div class="buttons"><button type="submit">DODAJ</button><button type="reset" onclick="resetList()">RESET</button></div>
     
        <?php
        if (isset($_SESSION['success_message_update'])) {
            echo "<p style='color: green;'>" . $_SESSION['success_message_update'] . "</p>";
            unset($_SESSION['success_message_update']); 
        }
        
        if (isset($_SESSION['error_message_update'])) {
            echo "<p style='color: red;'>" . $_SESSION['error_message_update'] . "</p>";
            unset($_SESSION['error_message_update']); 
        }
        ?>   
        </form>
        <div class="updates">
        <h1>AKTUALIZACJE</h1> <hr>
            <?php 
                include '../dbcon.php';
                $sql = "SELECT * FROM `coNowego` ORDER BY `coNowego`.`id` DESC" ;
                $result = $conn -> query($sql); 
                
                if($result->num_rows > 0){
                    $updates = $result->fetch_all(MYSQLI_ASSOC);
                

                    foreach($updates as $update) {
                    $changes = explode(", ",$update['zmiany']);
                    $number = str_pad($update['id'], 4,'0', STR_PAD_LEFT)
                    ?> <form class="editMode" action="php/delUpdate.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $update['id']; ?>">
                        <div class="update">
                        <h1>AKTUALIZACJA #<?php echo $number?>  <button type="submit" name="delete" class="delete-btn">Usuń</button></h1>
                        <p class="data"><?php echo $update['data']?> <label class="s1">S1</label></p>
                        <h2>główne zmiany</h2>
                    <ul>
                        <?php 
                            foreach($changes as $change) {
                            ?> <li><?php echo $change?></li> <?php
                            }
                        ?>
                        </ul><p>_________________________</p>
                        </div>
                        </form>
                <?php
                }
                }
                $conn->close();
            ?>  
        </div>
    </div>
    <div class="addPlan">
        <h3>DODAJ PLAN <button class="addRowMobile" type="button" onclick="show(this,'addPlan')">></button></h3>
        <form action="php/addPlan.php" method="post">
        <table>
            <tr>
                <td>nazwa</td>
                <td><input type="text" name="title" required></td>
            </tr>
            <tr>
                <td>opis</td>
                <td><textarea name="description" required></textarea></td>
            </tr>
            <tr>
                <td>przewidywana <br>data ukończenia</td>
                <td><input type="date" name="date" style="height: 30px;" required ></td>
            </tr>
            <tr>
                <td>zdjęcie</td>
                <td>
                    <input type="text" name="img" id="img" placeholder="gear.png">
                </td>
            </tr>
        </table>
        <div class="buttons"><button type="submit">DODAJ</button><button type="reset" onclick="resetList()">RESET</button></div>
        <?php 
             if (isset($_SESSION['success_message_plans'])) {
                echo "<p style='color: green;'>" . $_SESSION['success_message_update'] . "</p>";
                unset($_SESSION['success_message_plans']); 
            }
            
            if (isset($_SESSION['error_message_plans'])) {
                echo "<p style='color: red;'>" . $_SESSION['error_message_update'] . "</p>";
                unset($_SESSION['error_message_plans']); 
            }
        ?>
         <ul class="imgGudie">
            <li>Aktualizacje -> <label onclick="imgType('projectUpdate.jpg')">projectUpdate.jpg</label></li>
            <li>Nowy projekt -> <label onclick="imgType('projectPlan.jpg')">projectPlan.jpg</label></li>
            <li>Zmiany techniczne -> <label onclick="imgType('gear.png')">gear.png</label></li>
        </ul>
        </form>
       
        <div class="plans">
            <h1>PLANY</h1> <hr>
        <?php 
            include '../dbcon.php';
            $sql = "SELECT * FROM `plany` WHERE ukonczone LIKE false ORDER BY `plany`.`id` DESC";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $plans = $result->fetch_all(MYSQLI_ASSOC);

                foreach($plans as $plan) {
                    ?>
                    <div class="plan">
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
                        <div style="display:  flex;">
                        <form class="editMode" action="php/modifyPlan.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $plan['id']; ?>">
                            <input type="hidden" name="action" value="complete">
                            <button type="submit">Ukończ</button>
                        </form>
                        <form class="editMode" action="php/modifyPlan.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $plan['id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit">Usuń</button>
                        </form>
                        </div>
                    </div>
                    <?php
                }
            }
            $conn->close();
            ?>
            <h1>UKOŃCZONE</h1> <hr>
            <?php
                include '../dbcon.php';
                $sql = "SELECT * FROM `plany` WHERE ukonczone LIKE true ORDER BY `plany`.`id` DESC";
                $result = $conn->query($sql);

                if($result->num_rows > 0){
                    $plans = $result->fetch_all(MYSQLI_ASSOC);

                    foreach($plans as $plan) {
                        ?>
                        <div class="plan">
                            <h1><?php echo $plan['tytul'] ?></h1>
                            <?php echo $plan['opis'] ?>
                            <p>
                                <?php 
                                    $pData = $plan['przewidywanaData'];
                                    if($plan['przewidywanaData'] == null) {$pData = 'TBD';}
                                    if($plan['ukonczone'] == true) {
                                        echo "<p>"."Data ukończenia: ". $plan['dataUkonczenia']. "</p>";
                                    } else {
                                        echo "Przewidywana data ukończenia: ". $pData; 
                                    }
                                ?>
                            </p>
                        </div>
                        <?php
                    }
                }
                $conn->close();
            ?>
         </div>
    </div>

<?php endif; ?>
</main>
</body>
</html>
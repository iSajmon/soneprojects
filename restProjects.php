<?php
$sql = "SELECT * FROM `projects` WHERE `nazwa` NOT LIKE UPPER('PLACEHOLDER');";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {

                  $projects = $result->fetch_all(MYSQLI_ASSOC);
              
                  foreach ($projects as $project) {
                    $lastUpdate = $project['lastUpdate'];
                    $currentDate = new DateTime();
                    $updateDate = new DateTime($lastUpdate);
                    $diff = $currentDate->diff($updateDate)->days;
                    ?>
                    <div class="projektv2" onclick="showPage('<?php echo $project['url']; ?>')">
                        <img src="assets/img/<?php echo $project['photo']; ?>" alt="<?php echo $project['nazwa']; ?>" />
                        <div class="text">
                                <h2><?php echo $project['nazwa']; ?>
                                <?php if ($diff <= 15 && $currentDate > $updateDate): ?>
                                  <div class="warningBadge"><div class="circle"></div>NEW VERSION</div>
                                <?php endif; ?>
                                <?php if ($project['badge'] !== ''):  
                                    $badges = explode(',', $project['badge']);
                                    $badgesArray = ['PC ONLY', 'BETA', 'WORK IN PROGRESS'];
                                    $colorArray = ['#DF270E','#1D93D8', '#9f7af7'];
                                    foreach ($badges as $badge) {
                                      $badge = (int) $badge;
                                   
                                      $selectedBadge = $badgesArray[$badge];
                                      $selectedColor = $colorArray[$badge];
                                    ?>
                                    <div class="warningBadge" style="border-color:<?php echo $selectedColor ?>;color:<?php echo $selectedColor ?>;">
                                      <div class="circle" style="background-color:<?php echo $selectedColor ?>;"></div><?php echo $selectedBadge ?>
                                    </div>
                                 
                                <?php } endif; ?>
                          
                                    </h2>
                            <p><?php echo $project['description']; ?></p>
                            <label class="lastUpdate">Ostatnia aktualizacja: <?php echo isset($project['lastUpdate']) ? $project['lastUpdate'] : 'brak danych'; ?></label>
                        </div>
                    </div>
                    <?php
                } 
              } else {
                  echo "Brak wyników";
              }
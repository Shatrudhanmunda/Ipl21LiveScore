<?php
//$unique_id=1254059;
include('navbar.php');
if(isset($_GET['u_id'] )&& $_GET['u_id']>0){
  $unique_id=$_GET['u_id'];
}
else{
  header('Location : index.php');
}


$url = "https://cricapi.com/api/fantasySummary?apikey=QkgTaLRa4OhUBot85qcmQBsgubq2&unique_id=$unique_id";
$result = file_get_contents($url);
$result = json_decode($result, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $result['data']['team']['0']['name'] ?>
                vs <?php echo $result['data']['team']['1']['name'] ?></title>

  <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="index.css" />

</head>

<body>
  <!--Whole Container -->
  <div class="rca-container rca-margin">

    <!--Live ScoreBoard -->
    <div class="rca-row">
      <?php
      if (isset($result['error'])) {
        echo "<h2>" . $result['error'] . "</h2>";
      } else {
      ?>
        <!--Widget Inner -->
        <div class="rca-column-6">
          <?php if (isset($result['data']['fielding']['0'])) { ?>
            <!--Match Series-->
            <div class="rca-medium-widget rca-padding rca-live-season rca-top-border">
              <div class="rca-live-label rca-right">
                <?php echo $result['data']['team']['0']['name'] ?>
                vs <?php echo $result['data']['team']['1']['name'] ?>
              </div>
              <div class="rca-clear"></div>
              <div class="rca-padding">
                <h3 class="rca-match-title">
                  <a href="/main.html">


                  </a>
                  <?php
                  $totalO = 0;
                  $totalR = 0;
                  $totalW = 0;
                  foreach ($result['data']['bowling']['0']['scores'] as $list) {
                    $totalO = $totalO + $list['O'];
                    $totalR = $totalR + $list['R'];
                    $totalW = $totalW + $list['W'];

                    $totalO1 = 0;
                    $totalR1 = 0;
                    $totalW1 = 0;
                    foreach ($result['data']['bowling']['1']['scores'] as $list) {
                      $totalO1 = $totalO1 + $list['O'];
                      $totalR1 = $totalR1 + $list['R'];
                      $totalW1 = $totalW1 + $list['W'];
                    }
                  }
                  ?>
                  <h4> <?php echo $result['data']['team']['1']['name'];
                        echo "  <b>" . $totalR . "/" . $totalW . "(" . $totalO . ")</b>" ?></h4>
                  <h4> <?php echo $result['data']['team']['0']['name'];
                        echo "  <b>" . $totalR1 . "/" . $totalW1 . "(" . $totalO1 . ")</b>"  ?></h4>
                </h3>
              </div>
            </div>
            <!--Match Schedule Info-->
            <div class="rca-mini-widget rca-history-info">

              <div class="rca-row">
                <span class="rca-col rca-history-title">Series:</span>
                <span class="rca-col"> Vivo IPL 2021</span>
              </div>
              <div class="rca-row">
                <span class="rca-col rca-history-title">Date (GMT):</span>
                <span class="rca-col"> <?php echo date('d-m-Y', strtotime($result['dateTimeGMT'])) ?> </span>
              </div>
              <div class="rca-row">
                <span class="rca-col rca-history-title">Venue:</span>
                <span class="rca-col"> India</span>
              </div>
              <div class="rca-row">
                <span class="rca-col rca-history-title">Match Type:</span>
                <span class="rca-col"> Twenty20 Cricket Match</span>
              </div>
              <div class="rca-row">
                <span class="rca-col rca-history-title">Toss(win):</span>
                <span class="rca-col">
                  <?php if (isset($result['data']['toss_winner_team'])) {
                    echo $result['data']['toss_winner_team'];
                  } ?>

                </span>
              </div>
              <div class="rca-row">
                <span class="rca-col rca-history-title">Man of The Match:</span>
                <span class="rca-col">
                  <?php if (isset($result['data']['man-of-the-match']['name'])) {
                    echo $result['data']['man-of-the-match']['name'];
                  } ?>

                </span>
              </div>
            </div>

        </div>

        <div class="rca-column-6">
          <!--Match Series-->
          <div class="rca-medium-widget rca-top-border ">
            <ul class="rca-tab-list">
              <li class="rca-tab-link active" data-tab="tab-41" onclick="showTab(this);"> <?php echo $result['data']['team']['1']['name'] ?></li>
              <li class="rca-tab-link" data-tab="tab-42" onclick="showTab(this);"> <?php echo $result['data']['team']['0']['name'] ?></li>
            </ul>
            <div id="tab-41" class="rca-tab-content rca-padding active">
              <div class="rca-batting-score rca-padding">
                <h3>
                  <strong> <?php echo $totalR ?>/<?php echo $totalW ?>(<?php echo $totalO;  ?>)</strong>
                </h3>
                <div class="rca-row">
                  <div class="rca-header rca-table">
                    <div class="rca-col rca-player">
                      Batsmen
                    </div>
                    <div class="rca-col">
                      R
                    </div>
                    <div class="rca-col">
                      4s
                    </div>
                    <div class="rca-col">
                      6s
                    </div>
                    <div class="rca-col">
                      SR
                    </div>
                  </div>
                </div>
                <?php foreach ($result['data']['batting'][0]['scores'] as $list) {

                ?>
                  <div class="rca-row">
                    <div class="rca-table">
                      <div class="rca-col rca-player">
                        <?php echo $list['batsman'];
                        $color = "red";
                        if ($list['dismissal-info'] == 'not out') {
                          $color = "green";
                        }
                        ?>

                        <br>
                        <samp style="color:<?php echo $color ?>; font-size:12px"> <?php echo $list['dismissal-info'] ?></samp>
                      </div>
                      <div class="rca-col">
                        <?php echo $list['R'] . "(" . $list['B'] . ")" ?>
                      </div>
                      <div class="rca-col">
                        <?php echo $list['4s'] ?>
                      </div>
                      <div class="rca-col">
                        <?php echo $list['6s'] ?>
                      </div>
                      <div class="rca-col">
                        <?php echo $list['SR'] ?>
                      </div>
                    </div>
                  </div>
                <?php } ?>

                <div class="rca-clear"></div>
              </div>
              <div class="rca-bowling-score rca-padding">
                <h3>Bowling</h3>
                <div class="rca-row">
                  <div class="rca-header rca-table">
                    <div class="rca-col rca-player">
                      Bowler
                    </div>
                    <div class="rca-col small">
                      O
                    </div>
                    <div class="rca-col small">
                      M
                    </div>
                    <div class="rca-col small">
                      R
                    </div>
                    <div class="rca-col small">
                      W
                    </div>
                    <div class="rca-col small">
                      Econ
                    </div>
                   
                  </div>
                </div>

                <?php foreach ($result['data']['bowling'][0]['scores'] as $list) {

                ?>
                  <div class="rca-row">
                    <div class="rca-table">
                      <div class="rca-col rca-player">
                        <?php echo $list['bowler'] ?>
                      </div>
                      <div class="rca-col small">
                        <?php echo $list['O'] ?>
                      </div>
                      <div class="rca-col small">
                        <?php echo $list['M'] ?>
                      </div>
                      <div class="rca-col small">
                        <?php echo $list['R'] ?>
                      </div>
                      <div class="rca-col small">
                        <?php echo $list['W'] ?>
                      </div>
                      <div class="rca-col small">
                        <?php echo $list['Econ'] ?>
                      </div>
                      
                    </div>
                  </div>

                <?php } ?>

                <div class="rca-clear"></div>
              </div>
            </div>
            <div id="tab-42" class="rca-tab-content rca-padding">
              <div class="rca-batting-score rca-padding">
                <h3>

                  <strong> <?php echo $totalR1 ?>/<?php echo $totalW1 ?>(<?php echo $totalO1;  ?>)</strong>
                </h3>
                <div class="rca-row">
                  <div class="rca-header rca-table">
                    <div class="rca-col rca-player">
                      Batsmen
                    </div>
                    <div class="rca-col">
                      R
                    </div>
                    <div class="rca-col">
                      4s
                    </div>
                    <div class="rca-col">
                      6s
                    </div>
                    <div class="rca-col">
                      SR
                    </div>
                  </div>
                </div>
                <?php foreach ($result['data']['batting'][1]['scores'] as $list) {

                ?>
                  <div class="rca-row">
                    <div class="rca-table">
                      <div class="rca-col rca-player">
                        <?php echo $list['batsman'];
                        $color = "red";
                        if ($list['dismissal-info'] == 'not out') {
                          $color = "green";
                        }
                        ?>

                        <br>
                        <samp style="color:<?php echo $color ?>; font-size:12px"> <?php echo $list['dismissal-info'] ?></samp>
                      </div>
                      <div class="rca-col">
                        <?php echo $list['R'] . "(" . $list['B'] . ")" ?>
                      </div>
                      <div class="rca-col">
                        <?php echo $list['4s'] ?>
                      </div>
                      <div class="rca-col">
                        <?php echo $list['6s'] ?>
                      </div>
                      <div class="rca-col">
                        <?php echo $list['SR'] ?>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <div class="rca-bowling-score rca-padding">
                  <h3>Bowling</h3>
                  <div class="rca-row">
                    <div class="rca-header rca-table">
                      <div class="rca-col rca-player">
                        Bowler
                      </div>
                      <div class="rca-col small">
                        O
                      </div>
                      <div class="rca-col small">
                        M
                      </div>
                      <div class="rca-col small">
                        R
                      </div>
                      <div class="rca-col small">
                        W
                      </div>
                      <div class="rca-col small">
                        Econ
                      </div>

                    </div>
                  </div>

                  <?php foreach ($result['data']['bowling'][1]['scores'] as $list) {

                  ?>
                    <div class="rca-row">
                      <div class="rca-table">
                        <div class="rca-col rca-player">
                          <?php echo $list['bowler'] ?>
                        </div>
                        <div class="rca-col small">
                          <?php echo $list['O'] ?>
                        </div>
                        <div class="rca-col small">
                          <?php echo $list['M'] ?>
                        </div>
                        <div class="rca-col small">
                          <?php echo $list['R'] ?>
                        </div>
                        <div class="rca-col small">
                          <?php echo $list['W'] ?>
                        </div>
                        <div class="rca-col small">
                          <?php echo $list['Econ'] ?>
                        </div>

                      </div>
                    </div>

                  <?php } ?>

                  <div class="rca-clear"></div>
                </div>
              </div>
            <?php } ?>
          <?php }  ?>
            </div>




            <script>
              function showTab(event) {
                var sourceParent = event.parentElement.parentElement;
                var sourceChilds = sourceParent.getElementsByClassName("rca-tab-content");
                var sourceLinkParent = sourceParent.getElementsByClassName("rca-tab-link");
                for (var i = 0; i < sourceChilds.length; i++) {
                  sourceChilds.item(i).classList.remove("active");
                }
                for (var i = 0; i < sourceLinkParent.length; i++) {
                  sourceLinkParent.item(i).classList.remove("active");
                }
                var dataTab = event.getAttribute("data-tab");

                event.classList.add("active");
                document.getElementById(dataTab).className += ' active';
              }
            </script>

</body>

</html>
<?php include('footer.php');
<?php
include('navbar.php');
$arr_unique_id = ['1254059', '1254060','1254064','1254065','1254066','1254067'];
$apikey = "QkgTaLRa4OhUBot85qcmQBsgubq2";

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ScoreBoard</title>

    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="index.css" />

</head>

<body>

    <div class="rca-container rca-margin">

        <!--Live ScoreBoard -->
        <div class="rca-row">
        <div class="rca-column-6">
            <!--Widget Inner -->
            <?php
                        foreach ($arr_unique_id as $unique_id) {
                           // $url = "https://cricapi.com/api/fantasySummary?apikey=$apikey&unique_id=$unique_id";
                            $url="https://cricapi.com/api/cricketScore?apikey=QkgTaLRa4OhUBot85qcmQBsgubq2&unique_id=$unique_id";
                            $result = file_get_contents($url);
                            $result = json_decode($result, true);
                            
                           // print_r($result);
                        
                        ?>
            <div class="rca-mini-widget rca-history-info">
                <div class="rca-row">
                    <div style="padding: 20px; font-size:20px"> <?php echo $result['team-1'] ?> VS <?php echo $result['team-2'] ?>
                    <?php if($result['matchStarted']==1) { ?><br>
                    <a href="detail.php?u_id=<?php echo $unique_id ?>" style="margin-top: 20px; font-size:16px; color:red"><?php echo $result['score']  ?></a> </div>  
                    <?php } ?>
                </div>
            </div>
           <?php } ?>
        </div>
        </div>
    </div>

</body>

</html>
<?php include('footer.php');
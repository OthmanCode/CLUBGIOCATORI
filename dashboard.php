<!DOCTYPE html>
<html>
<head>
    <title>SQUADRE API</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        
        .player-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            
        }
        .player-box {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .player-box img {
            margin-right: 10px;
            width: 100px;
            height: 100px;
        }
        .player-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            background: rgb(34,193,195);
            background: linear-gradient(0deg, rgba(34,193,195,1) 60%, rgba(253,187,45,1) 100%);
        }
        .player-box {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            
        }

        .player-box .carousel-item img {
            margin-right: 10px;
            width: 100px;
            height: 100px;
        }
        .player-card p {
            font-weight: bold;
            color: black;
        }
        .favorite-star {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 20px;
            height: 20px;
           
            background-size: cover;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .player-card:hover .favorite-star {
            opacity: 1;
        }

        
        .body {
            min-width: 620px;
            overflow-x: scroll;
        }


    </style>
</head>
<body>

    <!-- <h2>Cerca Squadra</h2>
    <span class="favorite-star">&#9733;</span>
    <form action="<?php // echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <label for="club">Club:</label>
        <input type="text" id="club" name="club" required><br><br>
        <input type="submit" value="Submit">
    </form> -->
    <div class="container">
  <h2 class="text-center">Cerca Squadra</h2>
  <div class="d-flex justify-content-center align-items-center">
    <span class="favorite-star">&#9733;</span>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="ml-3">
      <div class="form-group">
        <!-- <label for="club">Club:</label> -->
        <input type="text" id="club" name="club" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">CERCA</button>
      <br>
      <br>
      
    </form>
  </div>
</div>

    <div class="container">
        <div class="row">
            <?php
            $curl = curl_init();
            if (isset($_GET['club'])) {
                $ricerca = $_GET['club'];
                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://thesportsdb.p.rapidapi.com/searchplayers.php?t=" . urlencode($ricerca),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "X-RapidAPI-Host: thesportsdb.p.rapidapi.com",
                        "X-RapidAPI-Key: 752aab939dmshb68afae97d0ce9cp16776cjsn4402fdfdca38"
                    ],
                ]);

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $club = json_decode($response, true);
                    if (isset($club['player'])) {
                        $players = $club['player'];
                        foreach ($players as $player) {
                            
                            echo '<div class="col-md-4">';
                            echo '<div class="player-card">';
                            
                            echo '<img src="' . $player['strRender'] . '" alt="' . $player['strRender'] . '" class="img-fluid">';
                            echo '<img src="' . $player['strCutout'] . '" alt="' . $player['strCutout'] . '" class="img-fluid">';
                           
                            echo '<p>Altezza: ' . $player['strHeight'] . '</p>';
                            echo '<p>Peso: ' . $player['strWeight'] . '</p>';
                            echo '<p>Nazionalità: ' . $player['strNationality'] . '</p>';
                           
                            echo '<p>Giocatore: ' . $player['strPlayer'] . '</p>';
                            echo '<p>Ruolo: ' . $player['strPosition'] . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "Nessun giocatore trovato per la squadra specificata.";
                    }
                }
            }
            ?>
        </div>
    </div>
</body>
</html>

</body>
</html>

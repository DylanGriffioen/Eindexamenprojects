<?php
$rollen = array("klant","verkoopleidster");
require_once("./security.php");
?>

<?php

require_once("classes/LoginClass.php");
if (isset($_POST['submit'])) {
    include('connect_db.php');
    LoginClass::update_account_info($_POST);

    echo "<h3 style='text-align: center;' >Uw wijzigingen zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=mijnAccountGegevens");


} else {
    ?>

    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript"
                src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
              type="text/css">
        <link href="mijnAccountGegevens.css" rel="stylesheet" type="text/css">
        <style>
            .header {
                font-size: 24;
                padding: 20px;
            }
        </style>
    </head>
    <body>
    <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><h1>Wijzig gegevens</h1></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li><a href="index.php?content=mijnAccountGegevens">Gegevens Aanpassen</a></li>
                                <li><a href="index.php?content=wijzig_wachtwoord">Wachtwoord Veranderen</a></li>
                                <li><a href="index.php?content=wijzig_betaalmeathode">Wijzig betaalmethode</a></li>
                                <li><a href="index.php?content=klachtIndienen">Klacht indienen</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/VerkoopClass.php");
                    require_once("classes/SessionClass.php");

                    $result = LoginClass::get_account_info();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo " value='\"" . $row['naam'] . "' required></div>
                        <div class=\"form-group\"><label class=\"control-label\" for=\"adres\">Adres<br></label>
                            <input class=\"form-control\" id=\"adres\" placeholder=\"Adres\" type=\"text\" name=\"adres\" value='" . $row['adres'] . "' required></div>
                        <div class=\"form-group\"><label class=\"control-label\" for=\"woonplaats\">Woonplaats</label>
                            <input class=\"form-control\" id=\"woonplaats\" placeholder=\"Woonplaats\" type=\"text\" name=\"woonplaats\" value='" . $row['woonplaats'] . "' required></div>
                        <button type=\"submit\" class=\"btn btn-danger\" name=\"submit\">Verzend</button>
                    </form>";
                        }
                        echo "
                           <br><br><br><br><br><br><br><br>
                            
                            ";


                    } else {
                        echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container"></div>
    </div>
    </body>
    </html>
    <?php
}
?>
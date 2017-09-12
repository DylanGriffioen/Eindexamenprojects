<?php
$rollen = array(
    "klant",
    "admin",
    "verkoopleidster"
);
require_once("./security.php");
?>


    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript"
                src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript"
                src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
              rel="stylesheet" type="text/css">
        <link href="style.css" rel="stylesheet" type="text/css">
        <style>
            .header {
                font-size: 24px;
                padding: 20px;
            }
            .emptyBasket {
                margin-left: 20px;
            }
        </style>
    </head>
    <body>
    <div class="section">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"><h2>Verwijderde producten</h2></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/AanvraagClass.php");
                    require_once("classes/SessionClass.php");
                    $idProduct = $_GET['idProduct'];
                    $aanvragen = AanvraagClass::selecteer_aanvragen_van_product($idProduct);

                        while ($row = $aanvragen->fetch_assoc()) {
                            // print_r($row);
                            echo "

                        
                                
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        idUser:
                                </th>
                                <th>
                                        Reden:
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        " . $row["idUser"] . "
                                </td>
                                <td>
                                        " . $row["reden"] . "
                                </td>
                            </tr>
                            </tbody>
                        </table>
                            ";
                        }

                    ?>
                    <br><br><br><br><br><br>
                </div>
            </div>

        </div>
    </div>
    </body>
    </html>

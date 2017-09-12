<?php
$rollen = array(
    "klant",
    "admin",
    "verkoopleidster"
);
require_once("./security.php");
?>

<?php

if (isset($_POST['haalTerug'])) {
    echo "<h3 style='text-align: center;' >Item is weer beschikbaar gemaakt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=extraOpdrachtVerkoopleidster");
    require_once("./classes/ProductClass.php");
    ProductClass::maak_product_beschikbaar($_POST);

} else {
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
                    require_once("classes/ProductClass.php");
                    require_once("classes/SessionClass.php");

                    $artikelen = ProductClass::get_deleted_products();

                        while ($row = $artikelen->fetch_assoc()) {
                            // print_r($row);
                            echo "

                        
                                
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        Naam:
                                </th>
                                <th>
                                        Aanvragen:
                                </th>
                                <th>
                                        Prijs:
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        " . $row["naam"] . "
                                </td>
                                <td>
                                        " . $row["aanvragen"] . "
                                </td>
                                <td>
                                        " . $row["prijs"] . "
                                </td>
                                <td>
                                        <form role=\"form\" action='index.php?content=extraOpdrachtAanvragen&idProduct=" . $row["idProduct"] . "' method='post'>
                                            <input type='submit' class=\"btn btn-info\" name='zieAanvragen' value='Zie alle aanvragen'>
                                            <input type='hidden' class=\"btn btn-info\" name='idProduct' value='" . $row['idProduct'] . "'/>
                                        </form>
                                </td>
                                <td>
                                        <form role=\"form\" action='' method='post'>
                                            <input type='submit' class=\"btn btn-info\" name='haalTerug' value='Maak item beschikbaar'>
                                            <input type='hidden' class=\"btn btn-info\" name='idProduct' value='" . $row['idProduct'] . "'/>
                                        </form>
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
    <?php

}
?>
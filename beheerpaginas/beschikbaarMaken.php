<?php
$rollen = array("admin");
require_once("./security.php");
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">
    <style>
        .header {
            font-size: 24px;
            padding: 20px;
        }

        th {
            min-width: 300px;
        }
    </style>
</head>
<body>
<div class="section">
    <div class="container">
        <?php


        require_once("classes/VerkoopClass.php");
        if (isset($_POST['updateBlock'])) {
            include('connect_db.php');

            $sql = "UPDATE	`producten` 
                     SET 		`beschikbaar`		=	'" . $_POST['blockSelect'] . "'
                     WHERE	    `idProduct`			=	 " . $_POST['idProduct'] . " ";

            // echo $sql;
            $database->fire_query($sql);
            $result = mysqli_query($connection, $sql);

            echo "<h3 style='text-align: center;' >Uw wijzigingen zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:4;url=index.php?content=beschikbaarmaken");

        } else {
        ?>
        <div class="row">
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><h2>Product Beschikbaar Maken</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li><a href="index.php?content=\beheerpaginas\adminHomepage">Admin Homepage</a></li>
                                <li><a href="index.php?content=\beheerpaginas\productenToevoegen">Producten Toevoegen</a></li>
                                <li><a href="index.php?content=\beheerpaginas\productVanDeDag">Product van de dag</a></li>
                                <li><a href="index.php?content=\beheerpaginas\productenBeheren">Producten beheren</a></li>
                                <li><a href="index.php?content=\beheerpaginas\verwijderProduct">Producten verwijderen</a></li>
                                <li><a href="index.php?content=\beheerpaginas\beschikbaarMaken">Producten beschikbaar maken</a></li>
                                <li><a href="index.php?content=\beheerpaginas\typeWijzigen">Product type veranderen</a></li>
                                <li><a href="index.php?content=\beheerpaginas\rolWijzigen">Gebruikerrol veranderen</a></li>
                                <li><a href="index.php?content=\beheerpaginas\blokkeren">Gebruiker blokkeren</a></li>
                                <li><a href="index.php?content=\beheerpaginas\klachtenBekijken">Klachten bekijken</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/VerkoopClass.php");
                    require_once("classes/SessionClass.php");
                    require_once("classes/ProductClass.php");

                    $result = ProductClass::get_all_products();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            echo "
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        Titel:
                                </th>
                                <th>
                                        AantalBeschikbaar:
                                </th>
                                <th>
                                        Beschikbaar:
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        " . $row['naam'] . "
                                </td>

                                <td>
                                        " . $row['aantalBeschikbaar'] . "
                                </td>
                                <td>
                                        " . $row['beschikbaar'] . "
                                </td>
                                <td>
                                        <form role=\"form\" action='' method='post'>
                                            <select name='blockSelect'>
                                                <option value='1'>Beschikbaar ( 1 )</option>
                                                <option value='0'>Niet beschikbaar ( 0 )</option>
                                                </select>
                                            <input type='hidden' class=\"btn btn-info\" name='idProduct' value='" . $row['idProduct'] . "'/>
                                            <input type='submit' class=\"btn btn-info\" name='updateBlock' value='Update Beschikbaarheid'>
                                            
                                        </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                            ";
                        }
                    } else {
                        echo "Geen resultaten<br><br><br><br><br><br><br>";
                    }
                    ?>

                    <br><br>
                </div>
            </div>
            <?php

            }
            ?>
            </row>
        </div>
    </div>

</body>
</html>
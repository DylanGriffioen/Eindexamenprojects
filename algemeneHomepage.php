<?php
if (isset($_POST['submit'])) {

    echo "<h3 style='text-align: center;' >Item toegevoegd aan winkelmand.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=algemeneHomepage ");
    require_once("./classes/VerkoopClass.php");
    VerkoopClass::insert_winkelmanditem_database($_POST);
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
        <link href="home.css" rel="stylesheet" type="text/css">
        <style>
            .header {
                padding: 20px;
            }

            .header {
                font-size: 24px;
                color: white;
                text-shadow: -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000;
                padding: 20px;
                margin-bottom: -100px;
            }

            .headertext {
                font-size: 24px;
                color: white;
                text-shadow: -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000;
                left: 100px;
            }

            .nav > li > a {
                color: white;
            }

            .text-inverse {

                text-shadow: -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000;
            }

            .nav > li > a:hover,
            .nav > li > a:focus {
                text-decoration: none;
                background-color: transparent;
            }
        </style>
    </head>
    <body>
    <div class="cover">
        <div class="cover-image" style="background-image: url('./images/banner.jpg')"></div>
        <div class="container" style="height: 450px;">
            <div class="row">
                <div class="col-md-12 text-center fronttext" style="margin-top: 150px;">
                    <h1 class="text-inverse">examendatabase Culemborg
                        <br>
                    </h1>
                    <p class="text-inverse">Een project door Dylan Griffioen
                        <br>
                    </p>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <?php
                require_once("classes/LoginClass.php");
                require_once("classes/SessionClass.php");
                date_default_timezone_set('Europe/Amsterdam');
                $current_time = date('H:i');
//                $current_time = "11:00";
                $beginDagProduct = "11:00";
                $endDagProduct = "13:00";
                $nu = DateTime::createFromFormat('H:i', $current_time);
                $begin = DateTime::createFromFormat('H:i', $beginDagProduct);
                $eind = DateTime::createFromFormat('H:i', $endDagProduct);

                echo "<div class=\"col-md-12\"><h2>Product van de Dag</h2></div>";
                $resultDagProduct = ProductClass::get_Product_Van_De_Dag();


                if ($resultDagProduct->num_rows > 0) {
                    while ($row = $resultDagProduct->fetch_assoc()) {
                        if ($nu >= $begin && $nu <= $eind) {
                            if ($row["beschikbaar"]) {
                                echo "
                                <div class=\"section\">
                                    <div class=\"container\">
                                        <div class=\"row\">
                                            <div style='height: 700px; margin-bottom: -20px;' class=\"col-md-3\">
                                                        <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                                                        <h3>" . $row["naam"] . "</h3>
                                                        <p class=\"videos\">" . $row["prijsDagProduct"] . "</p>
                                                        <p class=\"videos\">" . $row["beschrijving"] . "</p>
            
                                                        <a href='index.php?content=productPagina&idProduct=" . $row["idProduct"] . "'>
                                                        <button type=\"button\" class=\"btn btn-primary\">Meer Informatie</button></a>
                                                        
                                                        

                                                        
                                                        <form role=\"form\" action='' method='post'>
                                                            <input type='submit' class=\"btn btn-info\" name='favoriet' value='Voeg toe aan favoriete producten'>
                                                            <input type='hidden' class=\"btn btn-info\" name='idProduct' value='" . $row['idProduct'] . "'/>
                                                        </form>
                                                        
                                                        <br>
                                                    </div>
                                         </div>
                                    </div>
                                </div>
                                                    
                                                    
                                        ";
                            }
                        } else {
                            echo "De dag product actie is van 11 uur 's ochtends tot 1 uur 's middags! Kom later of morgen terug.";
                        }
                    }
                } else {
                    echo "Op dit moment is er geen product van de dag.";

                }
                ?>

                <div class="col-md-12"><h2>4 nieuwste producten</h2>
                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/SessionClass.php");

                    $result1 = ProductClass::get_4_first_products();


                    if ($result1->num_rows > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            if ($row["beschikbaar"]) {
                                echo "
            <div style='height: 700px; margin-bottom: -20px;' class=\"col-md-3\">
                <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                <h3>" . $row["naam"] . "</h3>
                <p class=\"videos\">" . $row["prijs"] . "</p>
                <p class=\"videos\">" . $row["beschrijving"] . "</p>

                <a href='index.php?content=productPagina&idProduct=" . $row["idProduct"] . "'>
                    <button type=\"button\" class=\"btn btn-primary\">Meer Informatie</button></a>

                <br><br><br>
            </div>
            ";
                            }
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>

                    <div class="col-md-12"><h2>4 meest verkochte producten</h2>
                        <?php
                        require_once("classes/LoginClass.php");
                        require_once("classes/SessionClass.php");

                        $result2 = ProductClass::get_4_most_sold_products();


                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                if ($row["beschikbaar"]) {
                                    echo "
            <div style='height: 700px; margin-bottom: -20px;' class=\"col-md-3\">
                <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                <h3>" . $row["naam"] . "</h3>
                <p class=\"videos\">" . $row["prijs"] . "</p>
                <p class=\"videos\">" . $row["beschrijving"] . "</p>

                <a href='index.php?content=productPagina&idProduct=" . $row["idProduct"] . "'>
                    <button type=\"button\" class=\"btn btn-primary\">Meer Informatie</button></a>


                <br><br><br>
            </div>
            ";
                                }
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>

    </body>
    </html>

    <?php
}
    ?>
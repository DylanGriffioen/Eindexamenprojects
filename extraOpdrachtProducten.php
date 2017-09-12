<?php
$rollen = array(
    "klant",
    "admin",
    "verkoopleidster"
);
require_once("./security.php");
?>

<?php

if (isset($_POST['submitAanvraag'])) {
echo "<h3 style='text-align: center;' >Uw aanvraag is verstuurd.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
header("refresh:4;url=index.php?content=extraOpdrachtProducten");
require_once("./classes/AanvraagClass.php");
require_once("./classes/ProductClass.php");
ProductClass::verhoog_aanvragen($_POST);
AanvraagClass::insert_Aanvraag_bericht($_POST);
} else {
    ?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="Videos.css" rel="stylesheet" type="text/css">
    <style>
        header {
            font-size: 24px;
            padding: 20px;
        }

    </style>
</head>
<body>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h2>Aanvraag formulier</h2><br></div>
            <?php
            require_once("classes/LoginClass.php");
            require_once("classes/SessionClass.php");
            $result = ProductClass::get_deleted_products();
            ?>
            <form role="form" action='' method='post'>

                <div class="form-group">
                    <label class="control-label" for="idProduct">Product<br></label>
                    <select class="form-control" name="idProduct">
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                echo"<option value='".$row['idProduct']."'>".$row['naam']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group"><label class="control-label" for="reden">Reden voor aanvraag<br></label><span
                            class="requiredStar">*</span><input
                            class="form-control"
                            id="reden"
                            name="reden"
                            placeholder="Reden"
                            type="emailAdres" required></div>

                <button type="submit" name="submitAanvraag" class="btn btn-primary">Verstuur<br></button>

            </form>
            <div class="col-md-12"><h2>Verlopen producten</h2><br></div>
            <div class="section ">
                <div class="container">
                    <div class="row">
                        <?php
                        require_once("classes/LoginClass.php");
                        require_once("classes/SessionClass.php");
                        $result = ProductClass::get_deleted_products();
                        // <Wijzigingsopdracht>

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if (!$row["beschikbaar"]) {
                                    echo "
                                                    <div style='height: 650px; margin-bottom: -20px;' class=\"col-md-3\">
                                                        <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                                                        <h3>" . $row["naam"] . "</h3>
                                                        <p class=\"videos\">" . $row["beschrijving"] . "</p>
                                                        <p class=\"videos\">Prijs: " . $row["prijs"] . " euro</p>
            

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
    </div>
</div>
</body>
</html>

    <?php

}
?>
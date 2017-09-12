<?php
$rollen = array(
    "verkoopleidster"
);
require_once("./security.php");
?>

<?php

if (isset($_POST['submitAanvraag'])) {
echo "<h3 style='text-align: center;' >Product van de is gezet.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
header("refresh:4;url=index.php?content=wijzigingsOpdrachtSelecteren");
require_once("./classes/ProductClass.php");
ProductClass::remove_andere_producten_van_de_dag($_POST['idProduct']);
ProductClass::set_product_van_de_dag($_POST['idProduct']);
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
            <div class="col-md-12"><h2>Product van de dag</h2><br></div>
            <?php
            require_once("classes/LoginClass.php");
            require_once("classes/SessionClass.php");
            $result = ProductClass::get_available_products();
            ?>
            <form role="form" action='' method='post'>

                <div class="form-group">
                    <label class="control-label" for="idProduct">Product<br></label>
                    <select class="form-control" name="idProduct">
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                echo"<option value='".$row['idProduct']."'>ProductId: ".$row['idProduct'].", Naam: ".$row['naam'].",  Prijs: ".$row['prijs']." <euro></euro></option>";
                            }
                        ?>
                    </select>
                </div>

                <button type="submit" name="submitAanvraag" class="btn btn-primary">Verstuur<br></button>

            </form>
            <?php

            echo "<div class=\"col-md-12\"><h2>Product van de Dag</h2></div>";
            $result1 = ProductClass::get_Product_Van_De_Dag();

            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    if ($row["beschikbaar"]) {
                        echo "
                            <div style='height: 1000px; margin-bottom: -20px;' class=\"col-md-3\">
                                <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                                <h3>" . $row["naam"] . "</h3>
                                <p class=\"videos\">" . $row["prijs"] . "</p>
                                <p class=\"videos\">" . $row["beschrijving"] . "</p>
                                <br><br><br>
                            </div>
                        ";
                    }
                }
            }
            else {
                echo "Op dit moment is er geen product van de dag";
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
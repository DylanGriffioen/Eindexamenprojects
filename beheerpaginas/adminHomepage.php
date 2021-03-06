<?php
$rollen = array("admin");
require_once("./security.php");

require_once("./classes/VerkoopClass.php");
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
        <div class="row">
            <div class="col-md-12"><h2>Admin Homepage</h2></div>
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
                <br><br>
            </div>
          
    </div>
</div>
</body>
</html>
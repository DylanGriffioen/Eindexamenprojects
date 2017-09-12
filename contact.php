<?php
require_once("./classes/ContactClass.php");
if (isset($_POST['submit'])) {
    $naam           = $_POST['naam'];
    $emailAdres     = $_POST['emailAdres'];
    $telefoonNummer = $_POST['telefoonNummer'];
    $bericht        = $_POST['bericht'];
    $from           = 'From: Website_Webshop_Culemborg';
    $to             = 'Dylan1997griffioen@gmail.com';
    $subject        = 'Nieuw bericht van ' . $_POST['naam'];

    $body = "Naam: $naam\nE-Mail: $emailAdres\ntelefoonNummer: $telefoonNummer\n\nBericht:\n$bericht";

    if (mail($to, $subject, $body, $from)) {
        echo '<h3 style=\'text-align: center;\' >Uw bericht is verzonden!</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
        echo '<meta http-equiv="refresh" content="5" />';
        ContactClass::insert_contact_bericht($_POST);
    } else {
        echo '<p>Er is iets fout gegaan. Probeer het opnieuw.</p>';
    }
} else {
    ?>

    <html>
    <head>
        <meta charset="utf-8">
        <meta naam="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript"
                src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
              type="text/css">
        <link href="Contact.css" rel="stylesheet" type="text/css">
        <style>
            .header {
                font-size: 24px;
                padding: 20px;
            }

            .requiredStar {
                color: red;
                font-size: 13px;
            }
        </style>
    </head>
    <body>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><h1>Contact</h1>
                    <p>Als u een vraag of opmerking heeft, vul dan hieronder het contanctformulier in.</p>
                </div>
                <div style=" margin-bottom: -20px;" class="col-md-3">
                    <p><b>Importeur<br></b>De Kleine Benelux b.v.<br>Noteboomstraat 5<br>7941 XD Meppel</p>
                    <p><b>telefoonNummer</b> 0 522 25 14 00<br><b>telefoonNummerefax </b>0 522 26 15 93</p>
                </div>
                <div style=" margin-bottom: -20px;" class="col-md-3">
                    <p><b>Gebr. Märklin &amp; Cie. GmbH<br></b>Stuttgarter Strasse 55-57<br>D-73033 Göppingen</p>
                    <p><b>telefoonNummer</b>&nbsp;+49 (0) 7161 608-0<br><b>telefoonNummerefax</b>&nbsp;+49 (0) 7161 698-20</p>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left">
                    <form role="form" action="index.php?content=contact" method="post">
                        <div class="form-group"><label class="control-label" for="naam">Naam</label><span
                                    class="requiredStar">*</span>
                            <input class="form-control" id="naam" placeholder="Naam" type="text" name="naam" required>
                        </div>
                        <div class="form-group"><label class="control-label" for="emailAdres">E-mail</label><span
                                    class="requiredStar">*</span>
                            <input class="form-control" id="emailAdres" placeholder="E-mail" type="emailAdres" name="emailAdres" required></div>
                        <div class="form-group"><label class="control-label" for="telefoonNummer">telefoonNummer<br></label>
                            <input class="form-control" id="telefoonNummer" placeholder="telefoonNummer" type="telefoonNummer" name="telefoonNummer"
                                   required></div>
                        <div class="form-group"><label class="control-label" for="bericht">Vraag/Opmerking</label><span
                                    class="requiredStar">*</span>
                            <input class="form-control" id="bericht" placeholder="Vraag/Opmerking" type="text"
                                   name="bericht" required></div>

                        <button type="submit" class="btn btn-primary" name="submit">Verzend</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
}
?>
<?php
require_once('MySqlDatabaseClass.php');
require_once("LoginClass.php");
require_once("SessionClass.php");

class VerkoopClass
{
    //Fields
    private $idWinkelmand;
    private $idUserWm;
    private $idProductWm;
    private $aantalWm;
    private $dagProduct;
    //Properties
    //getters

    public function getIdWinkelmand(){ return $this->idWinkelmand; }
    public function getIdUserWm(){ return $this->idUserWm; }
    public function getIdProductWm(){ return $this->idProductWm; }
    public function getAantalWm(){ return $this->aantalWm; }
    public function getDagProduct() { return $this->dagProduct; }

    //setters
    public function setIdWinkelmand($value){ $this->idWinkelmand = $value; }
    public function setIdUserWm($value){ $this->idUserWm = $value; }
    public function setIdProductWm($value){ $this->idProductWm = $value; }
    public function setAantalWm($value){ $this->aantalWm = $value; }
    public function setDagProduct($value) { $this->dagProduct = $value; }

    public function __construct(){}


    //wijzigingsopdracht
        public static function dagProductAanwezig()
        {

            global $database;

            $query = "SELECT * FROM `winkelmand` where `dagProductWm` = 1 AND `idUserWm` =  ".$_SESSION['idUser']." ";

            $result = $database->fire_query($query);

            return $result;
        }


    //Methods
    public static function insert_winkelmanditem_database($post)
    {
        $idUserWm = $_POST['idUser'];
        $idProductWm = $_POST['idProduct'];
        $idAantalWm = $_POST['amount'];
        global $database;
        $query = "INSERT INTO `winkelmand` (`idWinkelmand`, `idUserWm`, `idProductWm`, `aantalWm`, `dagProductWm`) 
                                    VALUES (NULL, '" . $idUserWm . "', '" . $idProductWm . "', " . $idAantalWm . ", " . $_POST['dagProduct'] . ")";

        $database->fire_query($query);
        $last_id = mysqli_insert_id($database->getDb_connection());
    }

    //gooit de winkelmand van de user leeg nadat hij alles besteld heeft
    public static function clear_winkelmand()
    {
        global $database;
        $query = "DELETE FROM `winkelmand` WHERE `idUserWm` = " . $_SESSION['idUser'] . " ";
//            echo $query;
        $database->fire_query($query);
    }

    //haalt een geselecteerd winkelmand item uit de winkelmand van de klant
    public static function remove_item_winkelmand($post)
    {
        global $database;
        $query = "DELETE FROM `winkelmand` WHERE `idUserWm` = " . $_SESSION['idUser'] . "
                                                    AND `idWinkelmand` = " . $post["idWinkelmand"] . " ";
        // echo $query;
        $database->fire_query($query);
    }


    //dit maakt een nieuwe order voor de klant aan als hij het besteld
    public static function insert_bestelling_database($post, $priceTotal)
    {
        global $database;

        $datetime = date('Y-m-d');

        $query = "INSERT INTO `order` (`idOrder`, 
                                            `idUser`, 
                                            `totaalPrijs`,
                                            `orderdatum`) 
                  VALUES                    (NULL, 
                                            '" . $_SESSION['idUser'] . "', 
                                            '" . $priceTotal . "',
                                            '" . $datetime . "')";

        // echo $query . "<br>";

        $database->fire_query($query);

        self::send_email();
//        self::lower_amount_Artikelen($post);
//        self::send_email($post, $last_id, $ophaaldatum);
//        self::increase_amount_hired($post);
//        self::update_beschikbaar();
    }

    //dit loopt door alle items in de winkelmand heen en stopt die winkelmand items in een orderregel die hij koppelt aan de order van de functie hierboven
    public static function insert_order_in_orderregel($row, $priceTotal)
    {
        global $database;
//        idOrderregel, idProduct, idOrder, prijs, aantal;
        $sql = "SELECT `idOrder` from `order` WHERE `idUser` = '" . $_SESSION['idUser']. "' AND `totaalPrijs` = '" . $priceTotal . "'";
        // echo $sql;
        $idOrderVoorRegels = $database->fire_query($sql);

        // echo $idOrderVoorRegel . "<<<";
        $idOrderVoorRegel = $idOrderVoorRegels->fetch_assoc();

        $query = "INSERT INTO `orderregel` (`idOrderregel`, 
                                    `idProduct`,
                                     `idOrder`,
                                    `prijsOr`,
                                    `aantal`) 
          VALUES                    (NULL, 
                                    '" . $row['idProductWm'] . "',
                                    '" . $idOrderVoorRegel['idOrder'] . "', 
                                    '" . $row['totaalPrijs'] . "', 
                                    '" . $row['aantalWm'] . "')";

        // echo $query . "<br>";
        $database->fire_query($query);
        self::lower_amount_Artikelen($row);
        self::increase_amount_hired($row);
    }

    public static function lower_amount_Artikelen($row)
    {
        global $database;

        $query = "UPDATE `producten`
					  SET `aantalBeschikbaar` = `aantalBeschikbaar` - '" . $row['aantalWm'] . "'
					  WHERE `idProduct` = '" . $row['idProductWm'] . "'";
        //echo $query;
        $database->fire_query($query);

    }

    private static function send_email()
    {
        $to = $_SESSION['emailAdres'];
        $subject = "Bevestigingsmail Bestelling Webshop Marklin";
        $message = "Geachte heer/mevrouw<br>";

        $message .= "Hartelijk dank voor het bestellen bij Webshop Marklin" . "<br>";

        $message .= "Wij wensen u veel plezier met uw aankoop.<br>";
        $message .= "Met vriendelijke groet," . "<br>";
        $message .= "Team Marklin" . "<br>";

        $headers = 'From: no-reply@WebshopMarklin.nl' . "\r\n";
        $headers .= 'Reply-To: webmaster@webshopMarklin.nl' . "\r\n";
        $headers .= 'Bcc: accountant@webshopMarklin.nl' . "\r\n";
        //$headers .= "MIME-version: 1.0"."\r\n";
        //$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();


        mail($to, $subject, $message, $headers);
    }

    public static function increase_amount_hired($row)
    {
        global $database;

        $query = "UPDATE `producten` SET `aantalVerkocht` =  `aantalVerkocht` + '" .$row['aantalWm'] . "' WHERE `idProduct` = '" . $row['idProductWm'] ."'";



        $database->fire_query($query);
    }

    public static function get_all_orders()
    {
        global $database;

        $sql = "SELECT * FROM `order` WHERE `idUser` = " . $_SESSION['idUser'] . " ";

        $result = $database->fire_query($sql);

        return $result;
    }

    public static function get_regels_by_order($opgehaaldeOrders)
    {
        global $database;

        $sql = "SELECT * FROM `orderregel` INNER JOIN `producten` on orderregel.idProduct = producten.idProduct WHERE `idOrder` = " . $opgehaaldeOrders["idOrder"] . " ";

        // echo $sql;
        $result2 = $database->fire_query($sql);

        foreach ($result2 as $opgehaaldeOrders2) {
            return $result2;
            echo 1;
        }
    }


    public static function get_total_price_with_shipping()
    {
        global $database;
        $sql = "select `idWinkelmand`, `idProductWm`, `prijs`, `aantalWm`,`aantalWm` * `prijs` as totaalPrijs, `naam`  from `winkelmand`
                INNER JOIN `producten` on winkelmand.idProductWm = producten.idProduct
                where `idUserWm` = " . $_SESSION['idUser'] . " ";

        // echo $sql;

        $priceWithShipping = $database->fire_query($sql);

        return $priceWithShipping;

    }

    public static function selecteer_totaal_prijs_niet_dagproduct_winkelmand_items(){
        global $database;
        $sql =  "select `dagProduct`, sum(`aantalWm` * `prijs`) as totaalPrijs  from `winkelmand`
                INNER JOIN `producten` on winkelmand.idProductWm = producten.idProduct
                where `idUserWm` = " . $_SESSION['idUser'] . " AND `dagProduct` = 0 ";

//        echo $sql;

        $result = $database->fire_query($sql);

        $totalePrijs = $result->fetch_assoc();
//        print_r($totalePrijs);

        return $totalePrijs;
    }

    public static function selecteer_totaal_prijs_dagproduct_winkelmand_items(){
        global $database;
        $sql =  "select sum(`aantalWm` * (`prijs` * 0.5)) as totaalPrijs, `dagProduct`  from `winkelmand`
                INNER JOIN `producten` on winkelmand.idProductWm = producten.idProduct
                where `idUserWm` = " . $_SESSION['idUser'] . " AND `dagProduct` = 1 ";

//        echo $sql;

        $result = $database->fire_query($sql);

        $totalePrijs = $result->fetch_assoc();
//        print_r($totalePrijs);
        return $totalePrijs;
    }
}
?>
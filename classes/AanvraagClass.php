<?php
require_once("MySqlDatabaseClass.php");

class AanvraagClass
{
    //Fields
    private $idAanvraag;
    private $idUser;
    private $idProduct;
    private $reden;



    public function getIdAanvraag()                     { return $this->idAanvraag; }
    public function setIdAanvraag($idAanvraag)          { $this->idAanvraag = $idAanvraag; }
    public function getidUser()                         { return $this->idUser; }
    public function setidUser($idUser)                  { $this->idUser = $idUser; }
    public function getidProduct()                      { return $this->idProduct; }
    public function setidProduct($idProduct)            { $this->idProduct = $idProduct; }
    public function getreden()                          { return $this->reden; }
    public function setreden($reden)                    { $this->reden = $reden; }





    //Constructor
    public function __construct()
    {
    }

    //Methods
    /* Hier komen de methods die de informatie in/uit de database stoppen/halen
    */
    public static function find_by_sql($query)
    {
        // Maak het $database-object vindbaar binnen deze method
        global $database;

        // Vuur de query af op de database
        $result = $database->fire_query($query);

        // Maak een array aan waarin je LoginClass-objecten instopt
        $object_array = array();

        // Doorloop alle gevonden records uit de database
        while ($row = mysqli_fetch_array($result)) {
            // Een object aan van de LoginClass (De class waarin we ons bevinden)
            $object = new AanvraagClass();

            // Stop de gevonden recordwaarden uit de database in de fields van een LoginClass-object
            $object->idAanvraag = $row['idAanvraag'];
            $object->idUser = $row['idUser'];
            $object->idProduct = $row['idProduct'];
            $object->reden = $row['reden'];



            $object_array[] = $object;
        }
        return $object_array;
    }

    public static function insert_Aanvraag_bericht($post){
        global $database;


        $query = "INSERT INTO `Aanvragen` (`idAanvraag`,
									   `idUser`,
									   `idProduct`,
									   `reden`)
				  VALUES			 (NULL,
				  					   '" . $_SESSION['idUser'] . "',
									   '" . $post['idProduct'] . "',
									   '" . $post['reden'] . "')";

        $database->fire_query($query);
    }

    public static function selecteer_aanvragen_van_product($idProduct){
        global $database;

        $query = "SELECT * from aanvragen WHERE idProduct = " . $idProduct . " ";

        return $database->fire_query($query);
    }

}

?>
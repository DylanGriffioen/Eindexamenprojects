<?php
require_once("MySqlDatabaseClass.php");

class RollClass
{
    //Fields
    private $idRoll;
    private $naam;
    private $beschrijving;


    public function getIdRoll()
    {
        return $this->idRoll;
    }

    public function setIdRoll($idRoll)
    {
        $this->idRoll = $idRoll;
    }

    public function getNaam()
    {
        return $this->naam;
    }

    public function setNaam($naam)
    {
        $this->naam = $naam;
    }

    public function getBeschrijving()
    {
        return $this->beschrijving;
    }

    public function setBeschrijving($beschrijving)
    {
        $this->beschrijving = $beschrijving;
    }


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
            $object->idRoll = $row['idRoll'];
            $object->naam = $row['naam'];
            $object->beschrijving = $row['beschrijving'];


            $object_array[] = $object;
        }
        return $object_array;
    }

    public static function get_all_roles(){
        global $database;

        $query = "SELECT * FROM `rollen`";

        return $database->fire_query($query);
    }

}



?>
<?php
require_once("MySqlDatabaseClass.php");

class TypeClass
{
    //Fields
    private $idType;
    private $naam;
    private $beschrijving;

    public function getidType()                     { return $this->idType; }
    public function setidType($idType)          { $this->idType = $idType; }
    public function getnaam()                      { return $this->naam; }
    public function setnaam($naam)            { $this->naam = $naam; }
    public function getbeschrijving()                         { return $this->beschrijving; }
    public function setbeschrijving($beschrijving)                  { $this->beschrijving = $beschrijving; }






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
            $object = new FavorietClass();

            // Stop de gevonden recordwaarden uit de database in de fields van een LoginClass-object
            $object->idType = $row['idType'];
            $object->naam = $row['naam'];
            $object->beschrijving = $row['beschrijving'];


            $object_array[] = $object;
        }
        return $object_array;
    }

    public static function get_all_types(){
        global $database;

        $query = "SELECT * FROM type";


        return $database->fire_query($query);
    }



}

?>
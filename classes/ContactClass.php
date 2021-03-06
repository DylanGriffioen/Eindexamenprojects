<?php
require_once("MySqlDatabaseClass.php");

class ContactClass
{
    //Fields
    private $idContact;
    private $naam;
    private $emailAdres;
    private $telefoonNummer;
    private $bericht;


    public function getIdContact()                      { return $this->idContact; }
    public function setIdContact($idContact)            { $this->idContact = $idContact; }
    public function getNaam()                           { return $this->naam; }
    public function setNaam($naam)                      { $this->naam = $naam; }
    public function getEmailAdres()                     { return $this->emailAdres; }
    public function setEmailAdres($emailAdres)          { $this->emailAdres = $emailAdres; }
    public function getTelefoonNummer()                 { return $this->telefoonNummer; }
    public function setTelefoonNummer($telefoonNummer)  { $this->telefoonNummer = $telefoonNummer; }
    public function getBericht()                        { return $this->bericht; }
    public function setBericht($bericht)                { $this->bericht = $bericht; }




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
            $object = new ContactClass();

            // Stop de gevonden recordwaarden uit de database in de fields van een LoginClass-object
            $object->idContact = $row['idContact'];
            $object->naam = $row['naam'];
            $object->emailAdres = $row['emailAdres'];
            $object->telefoonNummer = $row['telefoonNummer'];
            $object->bericht = $row['bericht'];


            $object_array[] = $object;
        }
        return $object_array;
    }

    public static function insert_contact_bericht($post){
        global $database;


        $query = "INSERT INTO `contact` (`idContact`,
									   `naam`,
									   `emailAdres`,
									   `telefoonNummer`,
									   `bericht`)
				  VALUES			 (NULL,
				  					   '" . $post['naam'] . "',
									   '" . $post['emailAdres'] . "',
									   '" . $post['telefoonNummer'] . "',
									   '" . $post['bericht'] . "')";

        $database->fire_query($query);
    }

}

?>
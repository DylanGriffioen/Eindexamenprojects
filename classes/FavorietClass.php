<?php
require_once("MySqlDatabaseClass.php");

class FavorietClass
{
    //Fields
    private $idFavoriet;
    private $idProduct;
    private $idUser;

    public function getIdFavoriet()                     { return $this->idFavoriet; }
    public function setIdFavoriet($idFavoriet)          { $this->idFavoriet = $idFavoriet; }
    public function getIdProduct()                      { return $this->idProduct; }
    public function setIdProduct($idProduct)            { $this->idProduct = $idProduct; }
    public function getIdUser()                         { return $this->idUser; }
    public function setIdUser($idUser)                  { $this->idUser = $idUser; }






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
            $object->idfavoriet = $row['idfavoriet'];
            $object->idProduct = $row['idProduct'];
            $object->idUser = $row['idUser'];


            $object_array[] = $object;
        }
        return $object_array;
    }

    public static function add_to_favorites($post) {

        global $database;

        $query = "INSERT INTO `favorieten` (`idFavoriet`,
									   `idProduct`,
									   `idUser`)
				  VALUES			 (NULL,
				  					   '" . $post['idProduct'] . "',
									   '" . $_SESSION['idUser'] . "')";


        $database->fire_query($query);
    }

    public static function remove_from_favorites($post) {

        global $database;

        $query = "DELETE FROM favorieten WHERE idProduct = ".$_POST['idProduct']." AND idUser = ". $_SESSION['idUser'] ." ";

        $database->fire_query($query);
    }

    public static function get_favoriete_producten () {
        global $database;

        $query = "SELECT * FROM favorieten
                  INNER JOIN producten ON favorieten.idProduct = producten.idProduct
                  WHERE idUser = ".$_SESSION['idUser']." ";
        $result = $database->fire_query($query);

        // echo $query;

        return $result;
    }

    public static function check_if_exists($post)
    {
        global $database;

        $query = "SELECT *
					  FROM	 `favorieten`
					  WHERE	 `idProduct` = '" . $post['idProduct'] . "' and `idUser` = '" . $_SESSION['idUser'] . "'";
        // echo $query;
        $result = $database->fire_query($query);

        // echo $query;
        //ternary operator
        return (mysqli_num_rows($result) > 0) ? true : false;
    }


}

?>
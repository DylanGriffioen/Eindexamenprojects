<?php
require_once("MySqlDatabaseClass.php");
require_once("ProductClass.php");

class LoginClass
{
    //Fields
    private $idUser;
    private $naam;
    private $emailAdres;
    private $wachtwoord;
    private $adres;
    private $woonplaats;
    private $betaalwijze;
    private $rol;
    private $geactiveerd;
    private $activatiedatum;
    private $geblokkeerd;

    //Properties
    public function getidUser()                { return $this->idUser; }
    public function getNaam()                   { return $this->naam; }
    public function getEmailAdres()             { return $this->emailAdres; }
    public function getWachtwoord()             { return $this->wachtwoord; }
    public function getAdres()                  { return $this->adres; }
    public function getWoonplaats()             { return $this->woonplaats; }
    public function getBetaalwijze()            { return $this->betaalwijze; }
    public function getRol()                    { return $this->rol; }
    public function getGeactiveerd()            { return $this->geactiveerd; }
    public function getActivatiedatum()         { return $this->activatiedatum; }
    public function getGeblokkeerd()            { return $this->geblokkeerd; }

    public function setidUser($value)          { $this->idUser = $value; }
    public function setNaam($value)             { $this->naam = $value; }
    public function setEmailAdres($value)       { $this->emailAdres = $value; }
    public function setWachtwoord($value)       { $this->wachtwoord = $value; }
    public function setAdres($value)            { $this->adres = $value; }
    public function setWoonplaats($value)       { $this->woonplaats = $value; }
    public function setBetaalwijze($value)      { $this->betaalwijze = $value; }
    public function setRol($value)              { $this->rol = $value; }
    public function setGeactiveerd($value)      { $this->geactiveerd = $value; }
    public function setActivatiedatum($value)   { $this->activatiedatum = $value; }
    public function setGeblokkeerd($value)      { $this->geblokkeerd = $value; }

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
            $object = new LoginClass();

            // Stop de gevonden recordwaarden uit de database in de fields van een LoginClass-object
            $object->idUser = $row['idUser'];
            $object->naam = $row['naam'];
            $object->emailAdres = $row['emailAdres'];
            $object->wachtwoord = $row['wachtwoord'];
            $object->adres = $row['adres'];
            $object->woonplaats = $row['woonplaats'];
            $object->betaalwijze = $row['betaalwijze'];
            $object->rol = $row['rol'];
            $object->geactiveerd = $row['geactiveerd'];
            $object->activatiedatum = $row['activatiedatum'];
            $object->geblokkeerd = $row['geblokkeerd'];

            $object_array[] = $object;
        }
        return $object_array;
    }

    public static function delete_user(){
        global $database;

        $query = "DELETE FROM	`users` WHERE `idUser` = " . $_POST['idUser'] . " ";
        echo $query;

        $database->fire_query($query);
    }

    public static function update_rol(){
        global $database;

        $query = "UPDATE	`users` 
                     SET 		`rol`		=	'" . $_POST['rolSelect'] . "'
                     WHERE	    `idUser`			=	 " . $_POST['idUser'] . " ";

        return $database->fire_query($query);
    }

    public static function get_all_users(){
        global $database;

        $query = "SELECT * from `users`";

        return $database->fire_query($query);
    }

    public static function find_login_by_email_password($emailAdres, $wachtwoord)
    {
        $query = "SELECT *
					  FROM `users`
					  WHERE `emailAdres` 	= '" . $emailAdres . "'
					  AND	`wachtwoord`	= '" . $wachtwoord . "'";

        $loginClassObjectArray = self::find_by_sql($query);
        $loginClassObject = array_shift($loginClassObjectArray);
        return $loginClassObject;
    }


    public static function insert_into_database($post)
    {
        global $database;
        // echo"test3";
        date_default_timezone_set("Europe/Amsterdam");

        $datum = date('Y-m-d');

        $wachtwoord = MD5($post['emailAdres'] . date('Y-m-d H:i:s'));

        $query = "INSERT INTO `users` (`idUser`,
									   `naam`,
									   `emailAdres`,
									   `wachtwoord`,
									   `adres`,
									   `woonplaats`,
									   `betaalwijze`,
									   `rol`,
									   `geactiveerd`,
									   `activatiedatum`,
									   `geblokkeerd`)
				  VALUES			 (NULL,
				  					   '" . $post['naam'] . "',
									   '" . $post['emailAdres'] . "',
									   '" . $wachtwoord . "',
									   '" . $post['adres'] . "',
									   '" . $post['woonplaats'] . "',
									   '" . $post['betaalwijze'] . "',
									   '" . '2'. "',
									   '" . '0' . "',
									   '" . $datum . "',
									   '" . '0' . "')";

        $database->fire_query($query);

        $last_id = mysqli_insert_id($database->getDb_connection());

        self::send_email($last_id, $post, $wachtwoord);
    }

    public static function check_if_email_exists($emailAdres)
    {
        global $database;

        $query = "SELECT `emailAdres`
					  FROM	 `users`
					  WHERE	 `emailAdres` = '" . $emailAdres . "'";
        // echo $query;
        $result = $database->fire_query($query);

        // echo $query;
        //ternary operator
        return (mysqli_num_rows($result) > 0) ? true : false;
    }


    public static function check_if_email_password_exists($emailAdres, $wachtwoord, $geactiveerd)
    {
        global $database;

        $query = "SELECT `emailAdres`, `wachtwoord`, `geactiveerd`
					  FROM	 `users`
					  WHERE	 `emailAdres` = '" . $emailAdres . "'
					  AND	 `wachtwoord` = '" . $wachtwoord . "'";

        $result = $database->fire_query($query);
        // echo $query;
        $record = mysqli_fetch_array($result);

        return (mysqli_num_rows($result) > 0 && $record['geactiveerd'] == $geactiveerd) ? true : false;
    }

    public static function check_if_activated($emailAdres, $wachtwoord)
    {
        global $database;

        $query = "SELECT `geactiveerd`
					  FROM	 `users`
					  WHERE	 `emailAdres` = '" . $emailAdres . "'
					  AND	 `wachtwoord` = '" . $wachtwoord . "'";

        $result = $database->fire_query($query);
        $record = mysqli_fetch_array($result);

        return ($record['geactiveerd'] == '0') ? true : false;
    }

    public static function check_if_geblokkeerd($idUser)
    {
        global $database;

        $query = "SELECT `geblokkeerd`
					  FROM	 `users`
					  WHERE	 `idUser` = '" . $idUser . "'";

        $result = $database->fire_query($query);
        $record = mysqli_fetch_array($result);
        return $geblokt = ($record['geblokkeerd'] == '0') ? true : false;

    }

    private static function send_email($idUser, $post, $wachtwoord)
    {

        $to = $post['emailAdres'];
        $subject = "Activatiemail Webshop";
        $message = "Geachte heer/mevrouw " . $post['naam'] . " <br> ";

        $message .= '<style>a { color:red;}</style>';
        $message .= "Hartelijk dank voor het registreren" . "<br>";
        $message .= "Uw registratienummer is: " . $idUser . "<br>";
        $message .= "U kunt de registratie voltooien door op de onderstaande" . "<br>";
        $message .= "activatielink te klikken:" . "<br>";

        $message .= "klik <a href='" . MAIL_PATH . "index.php?content=activate&idUser=" . $idUser . "&emailAdres=" . $post['emailAdres'] . "&wachtwoord=" . $wachtwoord . "'><b>Hier</b></a> om uw account te activeren" . "<br>";

        $message .= "U kunt dan vervolgens een nieuw wachtwoord instellen." . "<br>";
        $message .= "Met vriendelijke groet," . "<br>";
        $message .= "Het Webshopteam" . "<br>";

        $headers = 'From: no-reply@Webshopteam.nl' . "\r\n";
        $headers .= 'Reply-To: webmaster@Webshopteam.nl' . "\r\n";
        $headers .= 'Bcc: accountant@Webshopteam.nl' . "\r\n";
        //$headers .= "MIME-version: 1.0"."\r\n";
        //$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();


        mail($to, $subject, $message, $headers);
    }

    public static function activate_account_by_id($idUser)
    {
        global $database;
        $query = "UPDATE `users`
					  SET `geactiveerd` = '1'
					  WHERE `idUser` = '" . $idUser . "'";

        $database->fire_query($query);

    }

    public static function update_password($idUser, $wachtwoord)
    {
        global $database;
        $query = "UPDATE `users` 
					  SET	 `wachtwoord` =	'" . MD5($wachtwoord) . "'
					  WHERE	 `idUser`		=	'" . $idUser . "'";
        $database->fire_query($query);

    }

    public static function check_old_password($oud_wachtwoord)
    {
        $query = "SELECT *
					  FROM	 `users`
					  WHERE	 `idUser`	=	'" . $_SESSION['idUser'] . "'";
        $arrayLoginClassObjecten = self::find_by_sql($query);
        $loginClassObject = array_shift($arrayLoginClassObjecten);
        //var_dump($loginClassObject);
        //echo $loginClassObject->getPassword()."<br>";
        //echo MD5($old_password);
        if (!strcmp(MD5($oud_wachtwoord), $loginClassObject->getWachtwoord())) {
            return true;
        } else {
            return false;
        }
    }

    public static function update_database($post)
    {
        global $database;
        $query = "UPDATE `users` SET `naam`='" . $post['naam'] . "' where `idUser`='" . $_SESSION['idUser'] . "'";
        //echo"users update";
        $database->fire_query($query);
    }

    public static function find_info_by_id($idUser)
    {
        global $database;
        $query = "SELECT 	*
					  FROM 		`users`
					  WHERE		`idUser`	=	" . $idUser;
        $object_array = self::find_by_sql($query);
        $usersclassObject = array_shift($object_array);
        //var_dump($usersclassObject); exit();
        return $usersclassObject;
    }

    public static function check_Rol($post)
    {
        global $database;

        $query = "SELECT `rol`
					  FROM	 `users`
					  WHERE	 `rol` = '" . $_SESSION['rol'] . "'
					  AND    `idUser` = '" . $_SESSION['idUser'] . "'";
        // echo $query;
        $result = $database->fire_query($query);
        $record = mysqli_fetch_array($result);

        if ($_SESSION['rol'] == '1' && $record['rol'] == '1') { // Admin
            $sessieRol = "admin";
        } elseif ($_SESSION['rol'] == '2' && $record['rol'] == '2') { // Klant
            $sessieRol = "klant";
        } elseif ($_SESSION['rol'] == '3' && $record['rol'] == '3') { // verkoopleidster
            $sessieRol = "verkoopleidster";
        }
        return $sessieRol;
    }

    public static function get_account_info()
    {
        global $database;

        $query = "SELECT * FROM `users` where `idUser` = '" . $_SESSION['idUser'] . "'";

        $result = $database->fire_query($query);

        return $result;
    }

    public static function update_account_info($post)
    {
        global $database;

        $query = "UPDATE	`users` 
			                 SET 		`naam`		=	'" . $_POST['naam'] . "',
						                `adres`	= 	'" . $_POST['adres'] . "',
						                `woonplaats`	= 	'" . $_POST['woonplaats'] . "'
			                 WHERE	`idUser`			=	'" . $_SESSION['idUser'] . "';";

        $database->fire_query($query);
    }

    public static function update_betaalmethode($post)
    {
        global $database;

        $query = "UPDATE `users` SET `betaalwijze` = '" . $_POST['idBetaalmethode'] . "'
                  WHERE `idUser` = '" . $_SESSION['idUser'] . "'";

//sec
        $database->fire_query($query);
    }

    public static function get_klant_betaalmethode()
    {
        global $database;

        $query = "select betaalwijze, betaalwijze.naam from `users` INNER JOIN `betaalwijze` 
                  on users.betaalwijze = betaalwijze.idBetaalwijze 
                  WHERE `idUser` = '" . $_SESSION['idUser'] . "' ";

        // echo $query;
        return $database->fire_query($query);

    }

    public static function get_all_payment_methods()
    {
        global $database;

        $query = "select * from betaalwijze";

        $result = $database->fire_query($query);

        return $result;
    }
}

?>
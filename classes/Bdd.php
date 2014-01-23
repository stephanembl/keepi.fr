<?php

/**
 * Description of Bdd
 *
 * @author stef
 */
 
class Bdd {
   
    public function __construct($bdd){
        $this->connect($bdd);
    }

    private function connect($bdd){

        mysql_connect("localhost","keepi","xFyECRuASsKfwSj2") or die ("Impossible de se connecter");
        mysql_select_db($bdd) or die ("Impossible d'ouvrir la base de données");
    }

	public function addRegistration($email){
		$sql = mysql_query('SELECT email FROM newsletter WHERE email = "'.mysql_real_escape_string($email).'"');
		if (mysql_num_rows($sql) < 1)
		{
			$sql = mysql_query('INSERT INTO newsletter VALUES("", "'.mysql_real_escape_string($email).'", NOW())');
			return true;
		}
		return false;
	}
}
?>

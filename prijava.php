<?php
			if (isset($_POST["korisnicko_ime"])||isset($_POST["lozinka"])){
				$username=$_POST["korisnicko_ime"];
				$password=$_POST["lozinka"];
				$postoji=CheckLogin($username,$password);
				
			if ($postoji){
				//echo "<b>USPJEŠNA PRIJAVA!</b><br>";
				//echo "<div class=\"information-box round\">USPJEŠNA PRIJAVA!</div>";
				//echo "<p><a href=\"index1.php\">Kliknite ovdje za nastavak rada...</a></p>";
				$rez=array();
				$uname="";
				$razina=0;
				ReturnUserData($username,$password);
				$rez=ReturnUserData($username,$password);
				//print_r($rez); //ovo je samo za provjeru da vidite kao izgleda polje
				list($uname,$razina)=$rez;
						
				setcookie('uname', $uname, time()+1800,'/');
				setcookie('razina', $razina, time()+1800,'/');
				echo "Napomena: Postavljeni podaci o prijavi (postavljen cookie!) <br>";
				//print_r($_COOKIE); //ovo je samo za provjeru da vidite kao izgleda polje
				
				}
			else {
				echo "<div class=\"information-box round\">Ne postoji korisnik s navednim podacima!</div>";
				echo "<p><a href=\"prij.php\">Kliknite ovdje za ponovnu prijavu...</a></p>";
				}
				
				}
			else {
				echo "<p><a href=\"prij.php\">Kliknite ovdje za prijavu u aplikaciju...</a></p>";
				}
				?>	
<?php
include("html_head.php");
include("header.php");
include("menu.php");
require("config.php");

function CheckLogin($username,$password){
	global $servername, $username, $password, $dbname;
	// povezivanje
	$conn = mysqli_connect("localhost", "root","","knjiznica") or die ('Error connecting to mysql');
	mysqli_select_db($conn, "knjiznica");
	$db_selected = mysqli_select_db($conn, "knjiznica");
	if (!$db_selected) {
		die ('Ne mogu se spojiti na bazu: ' . mysql_error());
	}
	$sql="SELECT * FROM korisnici where KORISNICKO_IME='$username' AND LOZINKA='$password'";
	$result=mysqli_query($conn,$sql) or die("<br>".$sql."<br/><br/>".mysqli_error());
	$num_rows=0;
	while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
		//printf("uSERNAME: %s  lOZINKA: %s", $row["KORISNICKO_IME"], $row["LOZINKA"]);
		$num_rows++;
	}
	mysqli_free_result($result);

	if ($num_rows >= 1) {
		return true;
	}
	else {
		return false;
	}

}
	
	
function ReturnUserData($username,$password){
	global $servername, $username, $password, $dbname;
					// povezivanje
	$conn = mysqli_connect("localhost", "root","","knjiznica") or die ('Error connecting to mysql');
	mysqli_select_db($conn, "knjiznica");
	$sql="SELECT KORISNICKO_IME, RAZINA FROM korisnici where KORISNICKO_IME='$username' AND LOZINKA='$password'";
	$result=mysqli_query($conn,$sql) or die("<br>".$sql."<br/><br/>".mysqli_error());
	$rez=array();
	while($ispisrez = mysqli_fetch_array($result)){
	//print_r($ispisrez);
	$rez=$ispisrez;
	}
	return $rez;
	//print_r($ispisirez);

}

?>				



		
<?php
include("footer.php");
?>
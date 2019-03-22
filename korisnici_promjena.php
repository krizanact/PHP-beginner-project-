<?php
require("config.php");

if (isset($_COOKIE['uname'])){
	$prijavljen=true;
	$razina=$_COOKIE['razina'];
}
else {
	$prijavljen=false;
	$razina=0;
	header('Location: prij.php');
}
?>
<br>
<?php
	$conn = mysql_connect("localhost", "root","") or die ("Ne mogu se spojiti na bazu");
	mysql_select_db("knjiznica",$conn) or die ("Ne mogu izabrati bazu");
	
	mysql_query("SET NAMES utf8");
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET COLLATION_CONNECTION='utf8_unicode_ci'"); 
	
	if ($razina==3){
	if (isset($_POST['update'])){ //
	$id_korisnik=$_POST['id_korisnik'];
	$Korisnicko_ime=$_POST['Korisnicko_ime'];
	$Email=$_POST['email'];
	$JMBG=$_POST['JMBG'];
	
	$sql = "UPDATE korisnici SET Korisnicko_ime='$Korisnicko_ime', Email='$Email', JMBG='$JMBG' WHERE id_korisnik=$id_korisnik";
	//echo $sql; //da vidite kao izgleda SQL upit i je li dobar
	$result = mysql_query($sql, $conn) or die("<h2>Pogreška prilikom ažuriranja</h2>".mysql_error());
	if ($result){
		echo "<h2>Uspješno ažuriranje !</h2>";
	}
	}
	else if (isset($_POST['delete'])) { //brisanje korisnika
	$id_korisnik=$_POST['id_korisnik'];
	$sql = "delete from korisnici WHERE id_korisnik=$id_korisnik";
	//echo $sql; //da vidite kao izgleda SQL upit i je li dobar
	$result = mysql_query($sql, $conn) or die ("<h2>Pogreška prilikom brisanja</h2>".mysql_error());
	
	if ($result){
		echo "<h2>Uspješno brisanje !</h2>";
	}
	}
	else {
		echo "<h2>Ne možete direktno pozvati ovaj program, idite nazad ...</h2>";
	}
	
mysql_close($conn); 
	}	
	else{
		echo "Nemate dovoljnu razinu za pristup.";
	}
?>

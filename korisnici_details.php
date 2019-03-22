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
<h2>Podaci o korisniku:</h2>
<?php
	$conn = mysql_connect("localhost", "root","") or die ("Ne mogu se spojiti na bazu!");
	mysql_select_db("knjiznica",$conn) or die ("Ne mogu izabrati bazu!");
		
	mysql_query("SET NAMES utf8");
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET COLLATION_CONNECTION='utf8_unicode_ci'");
	
	if ($razina==3){
	if (isset($_GET['id'])){
	$id_korisnik=$_GET['id'];
	
	
	$sql = "select * from knjiznica.korisnici where id_korisnik=$id_korisnik";
	$result = mysql_query($sql, $conn);
  
	echo "<table width='90%'>";
	
	while ($row = mysql_fetch_assoc($result)){
	echo "<tr><td colspan='2'><form action='korisnici_promjena.php' method='post'>";
	echo "<tr><td bgcolor=\"#eeeeee\">ID:</td><td> <input type='text' name='id_korisnik' value='".$row['id_korisnik']."' size='30' ></td></tr>";
	echo "<tr><td bgcolor=\"#eeeeee\">Ime i Prezime:</td><td> <input type='text' name='Korisnicko_ime' value='".$row['Korisnicko_ime']."' size='30' ></td></tr>";
	echo "<tr><td bgcolor=\"#eeeeee\">E-mail:</td><td> <input type='text' name='email' value='".$row['Email']."' size='30'>*</td></tr>";
	echo "<tr><td bgcolor=\"#eeeeee\">JMBG:</td><td> <input type='text' name='JMBG' value='".$row['JMBG']."' size='30' ></td></tr>";
	echo "<tr><td>* </td><td><i>Ovi podaci se mogu mijenjati.</i></td></tr>";

	echo "<tr><td colspan='2'><INPUT TYPE='submit' name='update' value='Promjena zapisa'></td></tr>";
	echo "<tr><td colspan='2'><INPUT TYPE='submit' name='delete' value='Briši redak' onclick=\"return confirm('OPREZ: Jeste li sigurni da želite trajno obrisati ovog korisnika?');\" ></td></tr>";
	echo "<tr><td colspan='2'></form></td></tr>";	
	}
	echo "</table>";
	} else {
	echo "Niste odabrali konkretnog korisnika. Vratite se na popis korisnika.";
}
mysql_close($conn); 
	}
	else{
		echo "Nemate dovoljnu razinu za pristup.";
	}
?>

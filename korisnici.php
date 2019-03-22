<?php
require("config.php");
include("html_head.php");
include("header.php");
include("menu.php");

if (isset($_COOKIE['uname'])){
$prijavljen=true;
}
else {
$prijavljen=false;
}

?>

<div id="content-container">
	<div id="content-container2">
		<div id="content-container3">
			<div id="content">
			<h1> Korisnici</h1>
			<p>Pregled korisnika ...</p>

			<?php
			if (!$prijavljen){
			echo "<h2>Niste prijavljeni i nemate pravo pregleda!</h2><br></div></div></div>";
			include ("footer.php");
			die();
			}
			else {
			//continue with script execution
			}
			// konfiguracija za spajanje na mysql bazu
				global $servername, $username, $password, $dbname;
				// povezivanje
				$conn = mysql_connect($servername, $username, $password) or die ('Error connecting to mysql');
				mysql_select_db($dbname);
				//echo "<p>Ispis iz baze</p>";
				$sql="SELECT * FROM `korisnici` WHERE 1";
				$result=mysql_query($sql);
			?>

				<table class="sample">
					<tr class="tbl_naslov">
					<td>ID</td>
					<td>IME I PREZIME</td>
					<td>JMBG</td>
					<td>E-MAIL</td>
					</tr>
			<?php
				  while($ispisrez = mysql_fetch_array($result)){
					echo "<tr>"; 
					echo "<td>".$ispisrez['id_korisnik']."</td>";
					
					echo "<td><a href=\"#\" onclick=\"Popup=window.open('korisnici_details.php?id=".$ispisrez['id_korisnik']."','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=400,height=500,left=500,top=100'); return false;\"> ".$ispisrez['Korisnicko_ime']."</a></td>";
					
					
					echo "<td>".$ispisrez['JMBG']."</td>";
					echo "<td>".$ispisrez['Email']."</td>";
					echo "</tr>"; 
				// zatvaranje while petlje
				  }
					//zatvaranje
					mysql_close($conn);
					echo "</table>";	
				?>
			
			</div>
			<div id="aside">
				
			</div>
		</div>
	</div>
</div>

<?php
include("footer.php");
?>

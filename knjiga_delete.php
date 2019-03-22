<?php
require("config.php");
include("html_head.php");
include("header.php");
include("menu.php");


if (isset($_COOKIE['uname'])){
$prijavljen=true;
$razina=$_COOKIE['razina'];
}
else {
$prijavljen=false;
$razina=0;
}

function IspisKnjiga(){
		global $servername, $username, $password,$dbname;
		$conn = mysql_connect("localhost", "root","") or die ('Error connecting to mysql');
		mysql_select_db("knjiznica");
		//echo "<h2>Pregled opcina</h2>";
		$sql="SELECT k.*, p.* FROM knjiga k, pisac p where k.id_pisac=p.id_pisac ORDER BY 1";
		$result=mysql_query($sql);
		echo "<table class=\"sample\"><tr class=\"tbl_naslov\"><th>ID knjige</th><th>Naziv knjige</th><th>Naziv pisca</th><th>Slika</th><th></th><th></th></tr>";
		 while($ispisrez = mysql_fetch_array($result)){

			echo "<tr>"; 
			echo "<td>".$ispisrez['id_knjiga']."</td>";
			echo "<td>".$ispisrez['Naziv_knjige']."</td>";
			 echo "<td>".$ispisrez['Ime']."".$ispisrez['Prezime']."</td>";
			 echo "<td>".$ispisrez['Slika']."</td>";
			 
			echo "<td><a href=\"knjiga_edit.php?id=".$ispisrez['id_knjiga']."\">Ažuriraj knjigu</a></td>";
			echo "<td><a href=\"knjiga_delete.php?id=".$ispisrez['id_knjiga']."\">Briši knjigu</a></td>";
			echo "</tr>"; 

			// zatvaranje while petlje
			  }
			//zatvaranje
			mysql_close($conn);
			echo "</table>";
}

?>
<div id="content-container">
	<div id="content-container2">
		<div id="content-container3">
			<div id="content">
			<h1> UPRAVLJANJE KNJIGAMA</h1>
			
			<?php
			if ($razina==3){
				if (isset($_GET['id'])) {
				$id_knjiga	=	$_GET['id'];
				
				// povezivanje
				$conn = mysql_connect("localhost", "root","") or die ('Error connecting to mysql');
				mysql_select_db("knjiznica");

				$sql="DELETE FROM knjiga WHERE id_knjiga=$id_knjiga";
				$result=mysql_query($sql) or die("<h2>Pogreska kod dodavanja knjiga</h2>".mysql_error());
					if ($result){
					echo "<h2>Uspješno je izbrisana knjiga sa id: <b>$id_knjiga</b> !</h2><br>";
					IspisKnjiga();
					}	
				}
			}
			else {
			echo "<h3>Nemate razinu za pregledavanje ovih podataka</h3><br>";
			}
			?>

			<hr>

			</div>
			<div id="aside">
				<h2>
					<a href="knjiga_add.php">DODAJ NOVU KNJIGU</a>
				</h2>
				
				</p>
			</div>
		</div>
	</div>

</div>
<?php
include("footer.php");
?>

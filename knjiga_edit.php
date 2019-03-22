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
		echo "<table class=\"sample\"><tr class=\"tbl_naslov\"><th>ID</th><th>NAZIV KNJIGE</th><th>NAZIV PISCA</th><th></th><th></th></tr>";
		 while($ispisrez = mysql_fetch_array($result)){

			echo "<tr>"; 
			echo "<td>".$ispisrez['id_knjiga']."</td>";
			echo "<td>".$ispisrez['Naziv_knjige']."</td>";
			echo "<td>".$ispisrez['Ime']."".$ispisrez['Prezime']."</td>";
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
				if (isset($_GET['azuriraj'])){
				$id_knjiga	=	$_GET['id_knjiga'];
				$Naziv_knjige	=	$_GET['Naziv_knjige'];
				$id_pisac	=	$_GET['id_pisac'];
				
				// povezivanje
				$conn = mysql_connect("localhost", "root","") or die ('Error connecting to mysql');
				mysql_select_db("knjiznica");
				$sql="UPDATE knjiga SET Naziv_knjige='$Naziv_knjige', id_pisac='$id_pisac' WHERE id_knjiga=$id_knjiga";
				$result=mysql_query($sql) or die("<h2>Pogreska kod pronalaska knjige</h2>".mysql_error());
					if ($result){
					IspisKnjiga();
					}
				}
				if (isset($_GET['id'])) {
				$id_knjiga	=	$_GET['id'];
				
				// povezivanje
				$conn = mysql_connect("localhost", "root","") or die ('Error connecting to mysql');
				mysql_select_db($dbname);
				$sql="Select * from knjiga k, pisac p where id_knjiga=$id_knjiga and k.id_pisac=p.id_pisac";
				$result=mysql_query($sql) or die("<h2>Pogreska kod pronalaska knjige</h2>".mysql_error());
				while($ispisrez = mysql_fetch_array($result)){
					$trenutni_pisac=$ispisrez['id_pisac'];
					echo "<form action=\"knjiga_edit.php\" method=\"GET\">";
					echo "<span>ID KNJIGE: <input type=\"text\" name=\"id_knjiga\" value=\"".$ispisrez['id_knjiga']."\" READONLY></span><br>";
					echo "<span>NAZIV KNJIGE: <input type=\"text\" name=\"Naziv_knjige\" value=\"".$ispisrez['Naziv_knjige']."\"></span><br>";
					echo "<span>PISAC: <select name=\"id_pisac\"></span>";
					echo "<option value=\"".$ispisrez['id_pisac']."\">".$ispisrez['Ime']."".$ispisrez['Prezime']."</option>";
					$conn2 = mysql_connect("localhost", "root","") or die ('Error connecting to mysql');
								mysql_select_db("knjiznica");
								echo "<h2>Pregled knjiga</h2>";
								$sql2="SELECT * FROM pisac ORDER BY 1";
							$result2=mysql_query($sql2);
							while($ispisrez2 = mysql_fetch_array($result2)){
								echo "<option value=\"".$ispisrez2['id_pisac']."\">".$ispisrez2['Ime']."</option>";
								// zatvaranje while petlje
								}
					echo "</select><br><br></span><span><input type=\"submit\" name=\"azuriraj\" value=\"Ažuriraj knjigu\"></span>";
					echo "</form>";
					}
				}	
			}
			else {
			echo "<h3>Nemate razinu za mjenjanje ovih podataka</h3><br>";
			}
			?>
			
			<hr>
			
			</div>
			<div id="aside">
				<h2>
					<a href="knjiga_add.php">DODAJ NOVU KNJIGU</a>
				</h2>
				
			</div>
		</div>
	</div>

</div>
<?php
include("footer.php");
?>

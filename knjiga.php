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
?>

<div id="content-container">
	<div id="content-container2">
		<div id="content-container3">
			<div id="content">
			<h1> Vrste knjiga</h1>
			<p>Neke od knjiga...</p>

			<?php
			if (!$prijavljen){
			echo "<h2>Niste prijavljeni i nemate pravo pregleda!</h2><br></div></div></div>";
			include ("footer.php");
			die();
			}
			else {
			//continue with script execution
			}

			if ($razina==2 || $razina==3){
			// povezivanje
			$conn = mysql_connect("localhost", "root","") or die ('Error connecting to mysql');
			mysql_select_db("knjiznica");
			$sql="SELECT k.*, p.* FROM knjiga k, pisac p where k.id_pisac=p.id_pisac ORDER BY 1";
			$result=mysql_query($sql);
			?>
			
			<table class="sample">
				<tr class="tbl_naslov">
				<th>ID knjige</th>
				<th>Naziv knjige</th>
				<th>Pisac</th>
				<th>Slika</th>
				<th></th>
				<th></th>
				</tr>
			
			<?php
				
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
			}
			else {
			echo "<h3>Nemate razinu za pregledavanje ovih podataka</h3><br>";
			}
			?>
			
			</table>
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

<?php
session_start();
?>

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
		//echo "<h2>Pregled knjiga</h2>";
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
			<p> Dodajte neku od zeljenih knjiga.</p>
<?php
   if ($razina==3){
			// ID auto increment 						
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
          if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $sql = "SELECT * FROM knjiga WHERE id_knjiga";
    $result = $conn->query($sql);

    $i = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$i = $row["id_knjiga"];
    }
} else {
    echo "0 results";
}
$i += 1;


				if (isset($_POST['Naziv_knjige'])) {
					
				
				$Naziv_knjige	=	$_POST['Naziv_knjige'];
				$id_pisac	=	$_POST['id_pisac'];
				
				
				// Naziv knjige da bude razlicit
				$sql = "SELECT * FROM knjiga WHERE Naziv_knjige='$Naziv_knjige'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
		        echo "<h2>Naziv knjige vec postoji,pokusajte s drugim imenom !<h2>";
            }
        }
		else{
			
		    if($_SERVER['REQUEST_METHOD'] == 'POST')
{
		
    // Upload datoteka
    $tip_datoteke = pathinfo($_FILES['datoteka']['name'], PATHINFO_EXTENSION);

    $direktorij_za_upload = 'datoteke/';
    $novi_naziv_datoteke = uniqid() . '.' . $tip_datoteke;

    $uploadOk = true;

    // Provjeri da li datoteka već postoji
    if(file_exists($direktorij_za_upload . $novi_naziv_datoteke))
    {
        $uploadOk = false;
        $_SESSION['obavijest_greska'] = 'Datoteka već postoji!';
    }

    // Provjeri veličinu datoteke
    else if($_FILES['datoteka']['size'] > 200000)
    {
        $uploadOk = false;
        $_SESSION['obavijest_greska'] = 'Datoteka je prevelika!';
    }

    

    // Provjeri stanje uploada
    if($uploadOk == true)
    {
        // Sve je uredu, uploadaj datoteku

        if(move_uploaded_file($_FILES['datoteka']['tmp_name'], $direktorij_za_upload . $novi_naziv_datoteke))
        {
			$conn = mysql_connect("localhost", "root","") or die ('Error connecting to mysql');
				mysql_select_db("knjiznica");
				$sql="INSERT INTO knjiga(id_knjiga,Naziv_knjige,id_pisac,Slika) VALUES ('$i','$Naziv_knjige','$id_pisac','$novi_naziv_datoteke')";
				$result=mysql_query($sql) or die("<h2>Pogreška kod dodavanja knjiga!</h2>".mysql_error());
		}
	}
}
					
		if ($result){
					echo "<h2>Uspješno je dodana nova knjiga!</h2><br>";
					IspisKnjiga();
					}
        
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
				<h3>
					Dodavanje knjige
				</h3>
				<h2></h2>
			<?php if(isset($_SESSION['obavijest_greska'])): ?>
                <!-- Obavijesti greške -->
                <div class="obavijest">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php

                        // Ispiši obavijest
                        echo $_SESSION['obavijest_greska'];

                        // Isprazni spremnik za obavijesti
                        unset($_SESSION['obavijest_greska']);

                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['obavijest_uspjeh'])): ?>
                <!-- Obavijesti uspjeha -->
                <div class="obavijest">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php

                        // Ispiši obavijest
                        echo $_SESSION['obavijest_uspjeh'];

                        // Isprazni spremnik za obavijesti
                        unset($_SESSION['obavijest_uspjeh']);

                        ?>
                    </div>
                </div>
            <?php endif; ?>

			
			<form class="form-horizontal" action="knjiga_add.php" method="POST" enctype="multipart/form-data">
			
				
				<span>Naziv knjige <input type="text" name="Naziv knjige"><span><br>
				<span>Slika <input type="file" id="datoteka" name="datoteka"><span><br>
				
				
				
				<br>
				<span>
					PISAC:
					<select name="id_pisac">
						<option value="odabir">Odaberite pisca...</option>
						
						<?php
							// povezivanje
							$conn2 = mysql_connect("localhost", "root","") or die ('Error connecting to mysql');
							mysql_select_db("knjiznica");

							mysql_query("SET NAMES utf8");
							mysql_query("SET CHARACTER SET utf8");
							mysql_query("SET COLLATION_CONNECTION='utf8_unicode_ci'");

							$sql2="SELECT * FROM pisac ORDER BY 1";
							$result2=mysql_query($sql2);
							while($ispisrez2 = mysql_fetch_array($result2)){
								echo "<option value=\"".$ispisrez2['id_pisac']."\">".$ispisrez2['Ime']."</option>";

								// zatvaranje while petlje
							}
						?>
						
					</select>
					<span>
						
					<br><br>
				<input type="submit" name="posalji" value="Dodaj knjigu"><br>
			</form>
				</p>
			</div>
		</div>
	</div>

</div>

<?php
include("footer.php");
?>

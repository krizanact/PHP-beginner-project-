<?php
if (isset($_COOKIE['uname'])){
$prijavljen=true;
$razina=$_COOKIE['razina'];
}
else {
$prijavljen=false;
}
?>
<div id="navigation-container">
	<div id="navigation">
		<ul>
            <?php			
			if ($prijavljen){
			?>
			<li><a href="index1.php">POČETNA</a></li>
			
			
			<?php if ($razina==2 || $razina==3){
			?>
			<li><a href="korisnici.php">KORISNICI</a></li>
			<li><a href="knjiga.php">KNJIGA</a></li>
			<?php
			}
			?>
			<li><a href="logout.php">ODJAVA</a></li>
			<?php
			}
			else {
			?>
			<li><a href="index.php">POČETNA</a></li>
			<li><a href="prij.php">PRIJAVA</a></li>
			<?php
			}
			?>
			
		</ul>
		
	</div>

</div>
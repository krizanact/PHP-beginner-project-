<?php
include("html_head.php");
include("header.php");
include("menu.php");
?>
<div id="content-container">
	<div id="content-container2">
		<div id="content-container3">
			<div id="content">
				<h2>
					Odjava...
				</h2>
				<p>
				<?php
					if (isset($_COOKIE['uname'])){
					setcookie('uname', "", time()-36000,'/');
					echo "<div class=\"information-box round\">Odjavili ste se iz aplikacije!</div>";
					echo "<p><a href=\"prij.php\">Kliknite ovdje za ponovnu prijavu...</a></p>";
					}
				
				?>

				</p>
			</div>
			<div id="aside">
				
			</div>
		</div>
	</div>
</div>

<?php
include("footer.php");
?>


<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moja web stranica</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>
<body>


<?php


//echo $_POST["korisnicko_ime"];
//echo $_POST["lozinka"];

//header('Content-Type: text/html; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "knjiznica";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$x1 = $_POST["korisnicko_ime"];
$x2 = $_POST["lozinka"];
$x3 = $_POST["Email"];
$x4 = $_POST["JMBG"];



//SELECT * FROM `korisnici` WHERE id_korisnik

$sql = "SELECT * FROM korisnici WHERE id_korisnik";
$result = $conn->query($sql);

$i = 0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id_korisnik"] . "<br>";
		$i = $row["id_korisnik"];
    }
} else {
    echo "0 results";
}

//echo $i;
$i += 1;

$sql = "SELECT * FROM korisnici WHERE Korisnicko_ime='{$x1}' or Email='{$x3}' or JMBG='{$x4}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id_korisnik"] . "<br>";
		//echo $row["Korisnicko_ime"] . "</br>";
		echo "Korisnicko ime ili Email ili JMBG vec postoje,pokusajte ponovo!";
    }
}
 else {
   


$sql = "INSERT INTO korisnici (id_korisnik, Korisnicko_ime, Lozinka, Razina,Email,JMBG)
VALUES ('{$i}', '{$x1}', '{$x2}',1,'{$x3}','{$x4}')";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

//echo "Connected successfully";
}
?>

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mano Paskyra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body>
<?php if(isset($_SESSION["arPrisijunges"]) && $_SESSION["arPrisijunges"] == 1) { ?>}    
    <form method="post" action="manopaskyra.php">
        <button type="submit" name="atsijungti">Atsijungti</button>
    </form>
<?php } ?>

<?php 

    if(isset($_POST["atsijungti"])) {
        // session_destroy();
        //session_unset(); //panaikina tik kintamuosius
        //unset - panikina tik viena kintamaji
        unset($_SESSION["arPrisijunges"]);
        unset($_SESSION["vardas"]);
        $_SESSION["zinutes_stilius"] = "alert-success";
        $_SESSION["zinute"] = "Sėkmingai atsijungėte";
        header("Location: index.php");
    }

?>


<?php 



if(isset($_SESSION["arPrisijunges"]) && $_SESSION["arPrisijunges"] == 1 ) {
    echo "Sveikas prisijunges " . $_SESSION["vardas"];
    echo "<br>";
    echo $_SESSION["vardas"];
    echo $_SESSION["skaicius"];
    echo $_SESSION["skaiciuspokablelio"];

    var_dump( $_SESSION["masyvas"]);
    // var_dump( $_SESSION["objektas"]);

} else {
    echo "<h1>Jus neturite teises prie sios svetaines</h1>";
}



?>    
</body>
</html>


<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagrindinis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body>
       <h1> <?php if(!isset($_SESSION['skaiciuoklis'])){
                $_SESSION['skaiciuoklis'] = 0;
                echo "labas";
        }
        else{
            echo "Bandėte prisijungti: ".$_SESSION['skaiciuoklis'];
        }
         ?>
</h1>

        <?php if(isset($_SESSION["zinute"])) { ?>
            <div class="alert <?php echo $_SESSION["zinutes_stilius"]; ?>">
                <p><?php echo $_SESSION["zinute"]; ?></p>
               
            </div>
            <?php 
            unset($_SESSION["zinute"]); 
            unset($_SESSION["zinutes_stilius"]);
            ?>
        <?php } ?>
        <!-- if jeigu sausainis egzistuoja - forma paslepta, jei ne - forma matoma -->
        <a href="manopaskyra.php">eiti i mano paskyra</a>
        <form method="post" action="index.php" 
        <?php if((isset($_SESSION["arPrisijunges"]) && $_SESSION["arPrisijunges"] == 1)||(isset($_COOKIE['palauk60']))) { 
            echo "style='display:none'";
            
        }
            
            ?> >
            
            <input class="form-control" name="vardas" type="text" placeholder="Vardas">
            <input class="form-control" type="password" name="slaptazodis" placeholder="Slaptazodis">
            <button class="btn btn-primary" type="submit" name="prisijungti">Prisijungti</button>
        </form>    
        <?php if((isset($_COOKIE['palauk60']) && $_COOKIE['palauk60'] == 'labas')) { 
            echo "<h2 class ='alert alert-danger'>Suklydote 3 kartus iš eilės, laukite 1 minutę</h2>";
            ob_flush();
            flush();
            sleep(5);
            ob_end_clean();
            $_SESSION["skaiciuoklis"] = 0;
            echo "<h2><a href='index.php'>Bandyti dar kartą</a></h2>";
            // header("Refresh:0");

         };
         
         ?>
    </div>
   

    <?php 
    //tikriname ar mygtukas paspaustas
    if(isset($_POST["prisijungti"])) {
        $vardas = $_POST["vardas"];
        $slaptazodis = $_POST["slaptazodis"];

        // geras vardas ir geras slaptazods
        $gVardas = "admin";
        $gSlaptazodis = "123";
        // 1 - admin
        // 2 - vartotojas
        // 3 - moderatorius
        // 4 - klientas
       

        if($vardas == $gVardas && $slaptazodis == $gSlaptazodis) {
            $_SESSION["arPrisijunges"] = 1;
            $_SESSION["vardas"] = $vardas;
            $_SESSION["skaiciuoklis"] = 0;
            header("Location: manopaskyra.php");
        } else {
            //zinute turi buti raudona
            //ir kitoks tekstas
            //Sesijos skaitiklis
            // Sesijos skaitiklis $_SESSION["skaitiklis"]++
            //$_SESSION["skaitiklis"] == 3
            //susikurti sausainiukas kuris galiotu 60sec

            $_SESSION["zinute"] = "Neteisingi prisijungimo duomenys";
            $_SESSION["zinutes_stilius"] = "alert-danger";
            $_SESSION["skaiciuoklis"] = $_SESSION["skaiciuoklis"] +1;
            if ($_SESSION["skaiciuoklis"] >= 3){
                setcookie('palauk60', 'labas', time()+5, "/");
            };
            header("Location: index.php");
        }

    }
    
    ?>

</body>
<script>
</script>
</html>
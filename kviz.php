<?php
require "kozos.php";
session_start();
$eredmenyek = loadUsers("kvizeredmenyek.txt");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kvíz</title>
    <meta name="description" content="A Witcher széria oldala"/>
    <link rel="icon" type="image/png" href="logo.jpg"/>
    <link rel="stylesheet" type="text/css" href="projekt.css"/>
</head>
<body>
    <header id="infofejlec" style="position: fixed">
        <a href="index.php" title="Kezdőlap">
            <h1>The Witcher Kvíz</h1>
        </a>
        <img src="TheWitcherQuiz.jpg" alt="ThewitcherQuizz" id="quizz">
        <p class="urlap4">Ha még nem lennél bejelntkezve:<span class="button" style="margin-left: 10px"><a href="bejelentkezes.php" title="Bejelentkezés" class="button">Bejelentkezés</a></span></p>
    </header>
    <?php
    foreach ($eredmenyek as $asd){
        if(array_key_exists($_SESSION["user"], $asd)){
            $lol = $asd;
            break;
        }
    }
    if(search($_SESSION["user"], $eredmenyek)){ ?>
        <span style="font-weight: bold; font-size: 80px; color: #fcfcfc; transform: translate(-350px, 100px); float: right; clear: both">Gratulálunk</span><br>
        <span style="font-weight: bold; font-size: 50px; color: #fcfcfc; transform: translate(-420px, 150px); float: right; clear: both">Eredményed:</span>
    <?php echo "<span style=\"font-weight: bold; font-style: italic; font-size: 40px; color: #fcfcfc; transform: translate(-490px, 200px); float: right; clear: both\">". $lol[$_SESSION["user"]] . "/24 pont</span>"?>
        <form action="kviz.php" method="post"><input type="submit" name="ujra" value="Újra" style="transform: translate(900px, 450px)"></form>
    <?php }else{ ?>
    <form action="kviz.php" method="post">
        <fieldset class="urlap" style="margin-left: 500px">
            <legend>Kvíz</legend>
            <div class="kerdes">Hogy hívják a széria főszereplőjét?</div><br>
                <label>Sigismund Dijkstra<input type="radio" name="kviz" value="dijkstra" required></label><br>
                <label>The bloody baron<input type="radio" name="kviz" value="baron"></label><br>
                <label>Emhyr var Emreis<input type="radio" name="kviz" value="emyhr"></label><br>
                <label>Geralt of Rivia<input type="radio" name="kviz" value="geralt"></label><br>
                <label>Roach<input type="radio" name="kviz" value="roach"></label><br>
            <br>

            <div class="kerdes">Az alábbi lények közül melyek léteznek a The Witcher világában?</div><br>
                <label>Farkasember<input type="checkbox" name="kviz2[]" value="werewolf"></label><br>
                <label>Fojtólidérc<input type="checkbox" name="kviz2[]" value="drowner"></label><br>
                <label>Kentaur<input type="checkbox" name="kviz2[]" value="centaur"></label><br>
                <label>Unikornis<input type="checkbox" name="kviz2[]" value="unicorn"></label><br>
                <label>Óriás<input type="checkbox" name="kviz2[]" value="giant"></label><br>
                <label>Thesztrál<input type="checkbox" name="kviz2[]" value="thesztral"></label><br>
                <label>Shrek<input type="checkbox" name="kviz2[]" value="shrek"></label><br>
                <label>Baziliszkusz<input type="checkbox" name="kviz2[]" value="baziliszkusz"></label><br>
                <label>Vivern<input type="checkbox" name="kviz2[]" value="vivern"></label><br>
                <label>Főnix<input type="checkbox" name="kviz2[]" value="phonix"></label><br>
                <label>Kákalag<input type="checkbox" name="kviz2[]" value="kakalag"></label><br>
                <label>Striga<input type="checkbox" name="kviz2[]" value="striga"></label><br>
            <br><br>

            <div class="kerdes">Az alábbiak közül kivel(kikkel) volt a főhősnek romantikus kapcsolata?</div><br>
                <label>Triss Merigold<input type="checkbox" name="kviz3[]" value="triss"></label><br>
                <label>Yennefer of Vengerberg<input type="checkbox" name="kviz3[]" value="yennefer"></label><br>
                <label>Shani<input type="checkbox" name="kviz3[]" value="shani"></label><br>
                <label>Fringilla Vigo<input type="checkbox" name="kviz3[]" value="fringilla"></label><br>
                <label>Keira Metz<input type="checkbox" name="kviz3[]" value="keira"></label><br>
            <br><br>

            <label class="kerdes">Mikor született a főhős?(év)<br><input type="number" min="0" max="2020" name="kviz4" required></label><br><br>

            <label class="kerdes">Hogy hívják a főhős legkedvesebb barátját, aki mindenhova elkísérte?<br><input type="text" maxlength="20" name="kviz5" required></label><br><br>
            <input type="submit" name="submit-btn" value="Küldés"/>
        </fieldset>
    </form>
    <?php } ?>
<?php
    if(isset($_POST["submit-btn"])){
        $_SESSION["kviz"] = true;
        global $pontok;
        $pontok = 0;
        if(isset($_SESSION["user"])){
            if(isset($_POST["kviz"])){                      //első kérdés ellenőrzése
                             if($_POST["kviz"] === "geralt"){
                                 $pontok++;
                             }
                         }
            if(isset($_POST["kviz2"])){                     //második kérdés ellenőrzése
                $kviz2 = $_POST["kviz2"];
                foreach ($kviz2 as $valasz){
                    if($valasz === "werewolf" || $valasz === "drowner" || $valasz === "unicorn" || $valasz === "giant" || $valasz === "vivern" || $valasz === "phonix" || $valasz === "striga"){
                        $pontok++;
                    }
                }
            }
            if (isset($_POST["kviz3"])){                    //harmadik kérdés ellenőrzése
                $kviz3 = $_POST["kviz3"];
                foreach ($kviz3 as $valasz){
                    if($valasz === "triss" || $valasz === "yennefer"){
                        $pontok++;
                    }
                    if($valasz === "shani" || $valasz === "fringilla" || $valasz === "keira"){
                        $pontok += 2;
                    }
                }
            }
            if(isset($_POST["kviz4"])){                     //negyedik kérdés ellenőrzése
                var_dump($_POST["kviz4"]);
                if($_POST["kviz4"] == 1215){
                    $pontok += 5;
                }
            }
            if (isset($_POST["kviz5"])){                    //ötödik kérdés ellenőrzése
                if($_POST["kviz5"] === "Roach" || $_POST["kviz5"] === "roach" || $_POST["kviz5"] === "Keszeg" || $_POST["kviz5"] === "keszeg"){
                    $pontok += 3;
                }
            }
            $eredmeny = [ $_SESSION["user"] => $pontok];
            saveUser("kvizeredmenyek.txt", $eredmeny);
            header("Location: kviz.php");

        }else{
            echo "<span style='color: #ff0000; font-size: 20px; font-weight: bold; transform: translate( 700px,-50px); float: left'>A kvíz kitöltéséhez be kell jelentkezned!</span>";
        }
    }
    if(isset($_POST["ujra"])) {                                         //reset
        delete($_SESSION["user"], "kvizeredmenyek.txt");
        header("Location: kviz.php");
    }
?>
</body>
</html>


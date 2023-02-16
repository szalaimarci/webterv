<?php
session_start();
include "kozos.php";
$eredmenyek = loadUsers("velemenyek.txt");
$velemenyek = loadUsers("velemenyek.txt");
?>

<?php
$hiba = false;
if(isset($_POST["submit-btn"])){
    $_SESSION["com"] = true;
    if(isset($_SESSION["user"])){
        if(isset($_POST["opinions"])){                         //kedvenc részed kiválasztása
            $reszek = $_POST["opinions"];
            switch ($reszek) {
                case 'witcher': $kedvenc = "The Witcher"; break;
                case 'witcher2': $kedvenc = "The Witcher 2"; break;
                case 'witcher3': $kedvenc = "The Witcher 3";
            }
        }

        if(isset($_POST["valasztas"])){                   //játszottál-e valamelyikkel
            $jatek = $_POST["valasztas"];
            switch ($jatek) {
                case 'opcio1': $igene = "Igen"; break;
                case 'opcio2': $igene = "Nem"; break;
                case 'opcio3': $igene = "Igen, mindhárommal";
            }
        }

        if(isset($_POST["games"])) {                   //melyikkel játszottál
            $kivalasztott = [];

            foreach ($_POST["games"] as $game)
                $kivalasztott[] = $game;
        }

        if(isset($_POST["submit-btn"])) {
            $beirt_szoveg = $_POST["opinion"];
        }

        $eredmeny = [ "user" => $_SESSION["user"], "kedvenc" => $kedvenc, "igene" => $igene, "kivalasztott" => $kivalasztott, "beirt_szoveg" => $beirt_szoveg];
        saveUser("velemenyek.txt", $eredmeny);
        header("Refresh: 0");


    }else{
        $hiba = true;
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Vélemények</title>
    <meta name="description" content="A Witcher széria oldala"/>
    <link rel="icon" type="image/png" href="logo.jpg"/>
    <link rel="stylesheet" type="text/css" href="projekt.css"/>
</head>
<body>
    <header id="infofejlec">
        <a href="index.php" title="Kezdőlap">
            <h1>The Witcher</h1>
        </a>
    </header>
    <nav>
        <div class="nav">
            <div class="dropdown">
                <a href="jatekok.html" title="A játékok">A Játékok</a>
                <div class="dropdown-content">
                    <a href="jatekok.html">The Witcher</a>
                    <a href="jatekok.html#div_id">The Witcher 2: Assasins of Kings</a>
                    <a href="jatekok.html#div_id2">The Witcher 3: Wild Hunt</a>
                </div>
            </div>
            <a href="fejleszto.html" title="Fejlesztő stúdió">Fejlesztő stúdió</a>
            <a href="info.html" title="Információk">Információk</a>
            <a href="velemeny.php" title="Vélemények" class="active">Vélemények</a>
            <a href="bejelentkezes.php" title="Bejelentkezés">Bejelentkezés</a>
            <a href="kviz.php" title="Kviz">Kvíz</a>
        </div>
    </nav>
        <br>
    <section>
        <h2 style="color: #fcfcfc;  font-weight: bold; font-size: 50px; transform: translate(150px)">Felhasználók véleményei:</h2>
        <br>
        <?php foreach ($velemenyek as $asd){ ?>
                <div style="color: #fcfcfc; padding-bottom: 50px;">
                    <h3 style="font-size: 30px; font-weight: bold; transform: translate(250px)"><?php echo $asd["user"]; ?>:</h3>
                    <div style="font-size: 20px; transform: translate(300px); padding-bottom: 40px">Kedvenc játék: <span style="color: #902d26; font-size: 22px; font-weight: bold"><?php echo $asd["kedvenc"]; ?></span> <br></div>
                    <div style="font-size: 20px; font-style: italic; font-weight: bold; transform: translate(300px); margin-right: 600px"><span style="padding-bottom: 20px; font-size: 25px">Vélemény:</span><br><span style="padding-top: 20px">"<?php echo $asd["beirt_szoveg"]; ?>"</span></div>
                </div>
            <?php } ?>
        <fieldset class="urlap5" style="margin-top: 10px">
                         <form action="velemeny.php" method="post" enctype="multipart/form-data">
                             Screenshot kiválasztása:
                             <input type="file" name="fajl" accept=".jpg" />
                             <input type="submit" value="Feltöltés" name="submit">
                         </form>
                     </fieldset>
    </section>
     <?php if(isset($_SESSION["user"])){
         if(!(search2($eredmenyek, $_SESSION["user"]))){ ?>
             <form action="velemeny.php" method="post">
                 <fieldset class="urlap">
                     <legend>Véleményed</legend>
                     <div class="kerdes">Kedvenc részed:</div>
                     <label>The Witcher <input type="radio" name="opinions" value="witcher"/></label>

                     <label>The Witcher 2 <input type="radio" name="opinions" value="witcher2"/></label>

                     <label>The Witcher 3 <input type="radio" name="opinions" value="witcher3"/></label>
                     <br/><br>
                     <label for="jatek" class="kerdes">Játszottál valamelyik résszel?</label><br>
                     <select id="jatek">
                         <option value="opcio1" name="valasztas">Igen</option>
                         <option value="opcio2" name="valasztas">Nem</option>
                         <option value="opcio3" name="valasztas">Igen, mindhárommal</option>
                     </select> <br/><br>
                     <div class="kerdes">Ezekkel a részekkel játszottál:</div>
                     <label>The Witcher: <input type="checkbox" name="games[]" value="witcher1"/></label>

                     <label>The Witcher 2: <input type="checkbox" name="games[]" value="witcher2"/></label>

                     <label>The Witcher 3: <input type="checkbox" name="games[]" value="witcher3"/></label>
                     <br/><br>
                     <label class="kerdes">A véleményed kifejtve: <br><textarea name="opinion" maxlength="600"></textarea> </label><br/>
                     <input type="reset" name="reset-btn" value="Törlés"/>
                     <input type="submit" name="submit-btn" value="Elküld"/>
                 </fieldset>
                 <br>
             </form>
             <p class="urlap5"> Ha van egy screenshot-od a játékból,amit szeretnél megosztani, akkor itt feltöltheted azt:</p>
             <fieldset class="urlap5" style="margin-top: 10px">
                 <form action="velemeny.php" method="post" enctype="multipart/form-data">
                     Screenshot kiválasztása:
                     <input type="file" name="fajl" accept=".jpg" />
                     <input type="submit" value="Feltöltés" name="submit">
                 </form>
             </fieldset>
             <p class="urlap3" style="margin-top: 250px; transform: translate(400px)">Ha te is szeretnél véleményt írni be kell jelentkezned: <span class="button"><a href="bejelentkezes.php" title="Bejelentkezés" class="button">Bejelentkezés</a></span></p>
             <br>
         <?php }
     }else{  ?>
         <form action="velemeny.php" method="post">
             <fieldset class="urlap">
                 <legend>Véleményed</legend>
                 <div class="kerdes">Kedvenc részed:</div>
                 <label>The Witcher <input type="radio" name="opinions" value="witcher"/></label>

                 <label>The Witcher 2 <input type="radio" name="opinions" value="witcher2"/></label>

                 <label>The Witcher 3 <input type="radio" name="opinions" value="witcher3"/></label>
                 <br/><br>
                 <label for="jatek" class="kerdes">Játszottál valamelyik résszel?</label><br>
                 <select id="jatek">
                     <option value="opcio1" name="valasztas">Igen</option>
                     <option value="opcio2" name="valasztas">Nem</option>
                     <option value="opcio3" name="valasztas">Igen, mindhárommal</option>
                 </select> <br/><br>
                 <div class="kerdes">Ezekkel a részekkel játszottál:</div>
                 <label>The Witcher: <input type="checkbox" name="games[]" value="witcher1"/></label>

                 <label>The Witcher 2: <input type="checkbox" name="games[]" value="witcher2"/></label>

                 <label>The Witcher 3: <input type="checkbox" name="games[]" value="witcher3"/></label>
                 <br/><br>
                 <label class="kerdes">A véleményed kifejtve: <br><textarea name="opinion" maxlength="600"></textarea> </label><br/>
                 <input type="reset" name="reset-btn" value="Törlés"/>
                 <input type="submit" name="submit-btn" value="Elküld"/>
             </fieldset>
             <br>
         </form>
         <p class="urlap5"> Ha van egy screenshot-od a játékból,amit szeretnél megosztani, akkor itt feltöltheted azt:</p>
         <fieldset class="urlap5" style="margin-top: 10px">
             <form action="velemeny.php" method="post" enctype="multipart/form-data">
                 Screenshot kiválasztása:
                 <input type="file" name="fajl" accept=".jpg" />
                 <input type="submit" value="Feltöltés" name="submit">
             </form>
         </fieldset>
         <p class="urlap3" style="margin-top: 250px; transform: translate(400px)">Ha te is szeretnél véleményt írni be kell jelentkezned: <span class="button"><a href="bejelentkezes.php" title="Bejelentkezés" class="button">Bejelentkezés</a></span></p>
         <br>
         <?php    } ?>

    <?php
    if($hiba){
        echo "<span style='color: #ff0000; font-size: 20px; font-weight: bold; transform: translate( 700px,-360px); float: left'>Vélemény írásához be kell jelentkezned!</span>";
    }
    if(isset($_POST["submit"]) && isset($_FILES["fajl"])) {
        $images = "C:/xampp/htdocs/wckhcz/images/";

        $img = $images . basename($_FILES["fajl"]["name"]);

        $size = $_FILES["fajl"]["size"];

        $msg = "";

        $extension = pathinfo($img, PATHINFO_EXTENSION);

        $_SESSION["velemeny"] = true;
        if(isset($_SESSION["user"])){
            $file_temp = $_FILES["fajl"]["tmp_name"];
            if(!($file_temp == null)){
                $info = getimagesize($file_temp);
                $width = $info[0];
                $height = $info[1];
                $mime = $info["mime"];

                if ( $size < 2000000 && $extension == "jpg") {
                    $img = $images . $_SESSION["user"] . ".jpg";
                    if (move_uploaded_file($_FILES["fajl"]["tmp_name"], $img)) {
                        echo "<span class='error'>Sikeres fájl feltöltés!</span>";
                    }
                }else{
                    echo "<span class='error'>A fájl méret túl nagy vagy nem jpg kiterjesztésű képet adtál meg!</span>";
                }
            }else{
                echo "<span class='error'>Nem adtál meg fájlt!</span>";
            }
        }else{
            echo "<span class='error'>Fájl küldéséhez be kell jelentkezned!</span>";
        }
    }
    elseif(isset($_POST["submit"]) && !isset($_FILES["fajl"])) {
    echo "<span class='error'>Sikertelen fájlfeltöltés!</span>";
    }


    ?>


</body>
</html>
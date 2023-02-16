<?php
session_start();
require "kozos.php";
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>
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
        <a href="velemeny.php" title="Vélemények">Vélemények</a>
        <a href="bejelentkezes.php" title="Bejelentkezés" class="active">Bejelentkezés</a>
        <a href="kviz.php" title="Kvíz">Kvíz</a>
    </div>
</nav>

<?php  if(isset($_SESSION["user"])){
    echo "<div style='font-size: 20px; margin-left: 200px; margin-top: 100px; color: #fcfcfc; padding-bottom: 40px'>Bejelentkezve <span style='font-weight: bold; color: #900c05; font-size: 22px'>" . $_SESSION["user"] . "</span> nevű felhasználóként.</div>"; ?>
    <form action="sikereslogout.php">
        <label><input type="submit" name="kijelentkezes" value="Kijelentkezés" style="margin-left: 350px"></label>
    </form>
     <?php   }else{     ?>
            echo "<form action="bejelentkezes.php" method="post">
        <fieldset class="urlap">
            <legend>Bejelentkezés</legend>
            <label>Felhasználónév: <input type="text" name="username" size="40" required /></label><br/>
            <label>Jelszó: <input type="password" name="password" required/></label><br/>
            <input type="submit" name="submit-btn" value="Bejelentkezés"/>
        </fieldset>
        <p class="urlap2">Ha még nem regisztráltál, ide kattintva megteheted: <span class="button"><a href="regisztracio.php" title="Regisztráció" class="button">Regisztráció</a></span></p>
        <br>
    </form>";
    
<?php    }
        $accounts = loadUsers("felhasznalok.txt");


        $user = "";
        $pass = "";
        $loggedin = false;

        if (isset($_POST["submit-btn"])) {

            $user = $_POST["username"];
            $pass = $_POST["password"];


            foreach ($accounts as $acc) {
                if ($user === $acc["username"] && $pass === $acc["password"]) {
                    $loggedin = true;
                    $_SESSION["user"] = $user;

                    if($_SESSION["kviz"]){                          //átirányítás kvízhez
                        $_SESSION["kviz"] = false;
                        header("Location: kviz.php");
                        break;
                    }
                    if($_SESSION["com"]){                           //átirányítás véleményekhez
                        $_SESSION["com"] = false;
                        header("Location: velemeny.php");
                        break;
                    }
                    header("Location: index.php");          //átirányítás főoldalra
                }
            }
            if(!$loggedin){
                echo "<div style='color: red; font-size: 20px; margin-left: 530px; font-weight: bold; padding-top: 50px'>A felhasználó név vagy a jelszó nem megfelelő!</div>";
            }
        }
        ?>
</body>
</html>
<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kijelentkezés</title>
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
        <a href="kviz.php" title="Bejelentkezés">Kvíz</a>
    </div>
</nav>

<h2 class="sikreg">Sikeres kijelentkezés</h2>
<span class="button" style="margin-left: 670px"><a href="index.php" title="Főoldal" class="button">Vissza a Főoldalra</a></span>

</body>
</html>
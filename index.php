<?php session_start(); ?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>The  Witcher</title>
    <meta name="description" content="A Witcher széria oldala"/>
    <link rel="icon" type="image/png" href="logo.jpg"/>
    <link rel="stylesheet" type="text/css" href="projekt.css"/>
</head>
<body>
    <header>
        <audio controls autoplay>
            <source src="merchants.mp3" type="audio/mp3"/>
        </audio>
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
            <a href="bejelentkezes.php" title="Bejelentkezés">Bejelentkezés</a>
            <a href="kviz.php" title="Bejelentkezés">Kvíz</a>
        </div>
    </nav>
    <main>
         <img src="TheWitcher.jpg" alt="The Witcher" title="The Witcher" id="kep1" />
        <div>A The Witcher egy lengyel videójáték széria, amit a CD Projekt RED fejlesztő stúdió készített.
        A játékok a lengyel fantasy író, Andrzej Sapkowski Vaják című regénysorozatán alapulnak. A széria
        3 részből áll:</div>
        <ul>
            <li>The Witcher</li>
            <li>The Witcher 2: Assassins of Kings</li>
            <li>The Witcher 3: Wild Hunt</li>
        </ul>
        <div>Illetve három spin-off játék készült még hozzá:</div>
        <ul>
            <li>Thronebreaker: The Witcher Tales</li>
            <li>Gwent: The Witcher card game</li>
            <li>The Witcher Adventure Game</li>
        </ul>
        <div>A The Witcher egy középkori fantasy világban játszódik, ahol a játékos Ríviai Geraltot irányíthatja,
        aki a kevés megmaradt witcher egyike. (Természetfeletti erővel megáldott harcosok, akik főleg vándorként
        járják a világot, hogy különböző szörnyek legyőzésével pénzhez jussanak.) A játék magyar változatában is
        a witcher elnevezés szerepel, míg az első magyarul megjelent kötet a Vaják - Az utolsó kívánság címet
        kapta. A játékok mind kritikailag, mind bevételileg egyöntetű sikert alkottak, a fejlesztő stúdiót az iparág
        legnagyobbjai közé emelte.</div>
        <img src="poster.jpeg" alt="The Witcher2" title="The Witcher" id="kep2" />
    </main>
    <aside>
        <p>
            CD PROJEKT®, The Witcher®
        </p>
    </aside>
    <footer>
        <img src="projektred.png" alt="CD Projekt RED logo" title="CD Projekt RED" id="kep3"/>
    </footer>
</body>
</html>
<?php require "kozos.php"; ?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
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
<fieldset class="urlap">
    <form action="regisztracio.php" method="POST"><fieldset>
        <legend>Regisztráció</legend>
    <label>Felhasználónév: <input type="text" name="username" size="40" required/></label><br/>
    <label>E-mail-cím: <input type="email" name="email" required /></label><br/>
    <label>Jelszó: <input type="password" name="pwd" required /></label><br/>
    <label>Jelszó ismét: <input type="password" name="pwd-check" required /></label><br/>
    <label>Születési dátum: <input type="date" name="birth-date" required /></label><br/>
    Nem:
    <label>Férfi:  <input type="radio" name="sex" value="ferfi"/></label>
    <label>Nő: <input type="radio" name="sex" value="no"/></label>
    <label>Egyéb: <input type="radio" name="sex" value="csillamponi"/></label><br/>
    <input type="submit" name="submit-btn" value="Regisztráció"/>
        </fieldset>
    </form>
</fieldset>
<br>
<br>

<?php

$accounts = loadUsers("felhasznalok.txt");

$user = "";
$pass = "";
$pass2 = "";
$gender = "";
$birthdate = "";
$email = "";

$errors = [];

if (isset($_POST["submit-btn"])) {

    $pass = $_POST["pwd"];
    $pass2 = $_POST["pwd-check"];

    if (isset($_POST["username"])) {                            //felhasználónév ellenőrzés
        $user = $_POST["username"];
        foreach ($accounts as $account) {
            if ($account["username"] === $user) {
                $errors[] = "A felhasználónév már foglalt!";
            }
        }
    } else {
        $errors[] = "Kötelező megadni egy Felhasználónevet!";
    }

    if (isset($_POST["email"])) {                                //email cím ellenőrzés
        $email = $_POST["email"];
        foreach ($accounts as $account) {
            if ($account["email"] === $email) {
                $errors[] = "Az e-mail cím már foglalt!";
            }
        }
    } else {
        $errors[] = "Kötelező e-mail címet megadni!";
    }

    if (isset ($_POST["sex"])) {                                //Nem ellenőrzése
        $gender = $_POST["sex"];
    } else {
        $errors[] = "A nem megadása kötelező!";
    }

    if (strlen($pass) < 10) {                               //jelszo hossz ellenőrzése
        $errors[] = "A jelszónak legalább 10 karakter hosszúnak kell lennie!";
    }

    if ($pass !== $pass2) {                                    //jelszó helyességének ellenőrzése
        $errors[] = "A két jelszó nem egyezik meg!";
    }

    if (isset($_POST["birth-date"]) || 0 < $_POST["birthdate"] || $_POST[$birthdate] == null) {                        //szüldátum ellenőrzése
        $birthdate = $_POST["birth-date"];
    } else {
        $errors[] = "A születési dátumot kötelező megadni!";
    }


    if (count($errors) === 0) {
        header("Location: Sikeresreg.html");

        $data = [
            "username" => $user,
            "email" => $email,
            "password" => $pass,
            "sex" => $gender,
            "birth-date" => $birthdate,
        ];

        saveUser("felhasznalok.txt", $data);

    } else {
        foreach ($errors as $error) {
            echo "<div style='color: red; padding-left: 600px; font-size: 20px; font-weight: bold'>$error</div>"."<br>";
        }
    }
}
?>
</body>
</html>
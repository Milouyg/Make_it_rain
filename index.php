<?php
require "functions.php"; // mag ook include zijn
$connection = dbConnect();

$voornaam = "";
$achternaam = "";
$email = "";
$bericht = "";

// Opslag variabele (array) voor errors
$errors = [];

$trending_games = $connection->query("SELECT * FROM `games` WHERE beoordelingen > 93");
$games = $connection->query("SELECT * FROM `games` WHERE beoordelingen < 94");

// Checken of er gegevens zijn opgestuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gegevens tonen
    $voornaam = $_POST["voornaam"];
    $achternaam = $_POST["achternaam"];
    $email = $_POST["email"];
    $bericht = $_POST["bericht"];
    $tijdstip = date("Y-m-d H:i:s");

    // Fouten controleren / valideren van input
    if (isEmpty($voornaam)) {
        $errors["voornaam"] = "vul uw voornaam in a.u.b.";
    }
    if (isEmpty($achternaam)) {
        $errors["achternaam"] = "vul uw achternaam in a.u.b.";
    }
    if (!isValidEmail($email)) {
        $errors["email"] = "Dit is geen geldig email adres!";
    }
    if (!hasMinLength($bericht, 5)) {
        $errors["bericht"] = "Vul minimaal 5 tekens in.";
    }
    // print_r($errors);

    // Wanneer er 0 foutmeldingen zijn, dan wordt deze if uitgevoerd
    if (count($errors) == 0) {
        $sql = "INSERT INTO `contact_formulier` (`voornaam`, `achternaam`, `email`, `bericht`, `tijdstip`) 
            VALUES (:voornaam, :achternaam, :email, :bericht, :tijdstip);";
        $statement = $connection->prepare($sql);
        $params = [
            "voornaam" => $voornaam,
            "achternaam" => $achternaam,
            "email" => $email,
            "bericht" => $bericht,
            "tijdstip" => $tijdstip
        ];

        $statement->execute($params);

        // Stuur bezoeker door naar bedankt pagina
        header("location: bedankt.html");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/fotoslider.css">
    <link rel="stylesheet" href="css/game.css">
    <link rel="stylesheet" href="css/log_in.css">
    <link rel="stylesheet" href="css/contact_form.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://kit.fontawesome.com/b1a8b29774.js" crossorigin="anonymous"></script>
    <script src="js/main.js" defer></script>
    <title>Notice Games</title>
</head>

<body>
    <!-- Navigatie -->
    <header class="header_navigatie">
        <div class="container">
            <figure class="logo">
                <h2 class="logo">Xlr8</h2>
                <!-- <img class="google" src="img/logo.png" alt=""> -->
            </figure>
            <form class="search_box">
                <input type="text" placeholder="games">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
            <nav class="nav_header">
                <menu class="nav_items">
                    <li><a href="index.php#trending">Games</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                </menu>
            </nav>
            <button class="log_in" onclick="show()">Inloggen</button>
            <div class="container_logIn" id="container_logIn">
                <label id="close_btn" class="close_btn fas fa-times"></label>
                <div class="text">Login Form</div>
                <form>
                    <div class="data">
                        <label for="email">Email</label>
                        <input type="email" required>
                    </div>
                    <div class="data">
                        <label>Wachtwoord</label>
                        <input type="password" required>
                        <div class="forgot_password"><a href="">Wachtwoord vergeten</a></div>
                    </div>
                    <button class="form_log_in" type="submit">Inloggen</button>
                    <div class="sign_up">Nog geen lid? <a class="make_acc" href=""> Maak hier een account</a></div>
                </form>
            </div>
        </div>
    </header>

    <!-- fotoslider start -->
    <main>
        <section class="fotoslider container">
            <div class="slider">
                <div class="slides">
                    <input type="radio" name="radio_btn" id="radio1">
                    <input type="radio" name="radio_btn" id="radio2">
                    <input type="radio" name="radio_btn" id="radio3">
                    <input type="radio" name="radio_btn" id="radio4">

                    <!-- slide image begin -->
                    <figure class="slide first">
                        <img class="foto" src="img_fotoSlider/horizon.webp" alt=""> <!-- 1444x600 -->
                    </figure>

                    <figure class="slide">
                        <img class="foto" src="img_fotoSlider/detroit.webp" alt="">
                    </figure>

                    <figure class="slide">
                        <img class="foto" src="img_fotoSlider/terraria.webp" alt="">
                    </figure>

                    <figure class="slide">
                        <img class="foto" src="img_fotoSlider/zelda.webp" alt="">
                    </figure>
                    <!-- slide image einde -->

                    <nav class="navigatie_auto">
                        <div class="auto_btn1"></div>
                        <div class="auto_btn2"></div>
                        <div class="auto_btn3"></div>
                        <div class="auto_btn4"></div>
                    </nav>

                </div>
                <div class="navigatie_manual">
                    <label for="radio1" class="manual_btn"></label>
                    <label for="radio2" class="manual_btn"></label>
                    <label for="radio3" class="manual_btn"></label>
                    <label for="radio4" class="manual_btn"></label>
                </div>
            </div>
        </section>

        <!-- trending section -->
        <!-- kopje -->
        <section>
            <header id="trending" class="header_trending">
                <div class="header">
                    <i class="fa-solid fa-fire-flame-curved" id="flame_trending"></i>
                    <h2 class="kopje_trending_games">Trending Games</h2>
                </div>
            </header>
            <div class="inputs_filters_trending">
                <input id="checkbox-sandbox-trending" type="checkbox" class="filter_trending_cards">
                <label for="checkbox-sandbox-trending">Sandbox</label>
                <input id="checkbox-co-op-trending" type="checkbox" class="filter_trending_cards">
                <label for="checkbox-co-op-trending">Co-op</label>
                <input id="checkbox-role-play-trending" type="checkbox" class="filter_trending_cards">
                <label for="checkbox-role-play-trending">Role-play</label>
            </div>
            <!-- trending games -->
            <div class="container_trending_cards">
                <?php foreach ($trending_games as $row) : ?>
                    <article class="trending_card" data-category="<?php echo $row["genre"]; ?>">
                        <figure>
                            <img class="product_card" src="img/<?php echo $row["img_link"]; ?>" alt="">
                        </figure>
                        <div class="box_text_trending">
                            <h2 class="titel_game"><?php echo $row["titel"]; ?></h2>
                            <h3 class="genre"><?php echo $row["genre"]; ?></h3>
                            <span class="price">&#x20AC;<?php echo $row["prijzen"]; ?></span>
                            <span class="percentage"><?php echo $row["beoordelingen"]; ?>%</span>
                            <a class="view" href="game_view.php?id=<?php echo $row["id"]; ?>">weergave</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <header class="header_game">
                <div class="header">
                    <i class="fa-solid fa-fire-flame-curved" id="flame_game"></i>
                    <h2 class="kopje_games">Games</h2>
                </div>
            </header>
            <div class="inputs_filters_games">
                <input id="checkbox-sandbox-game" type="checkbox" class="filter_game_cards">
                <label for="checkbox-sandbox-game">Sandbox</label>
                <input id="checkbox-coöp-game" type="checkbox" class="filter_game_cards">
                <label for="checkbox-coöp-game">Co-op</label>
                <input id="checkbox-role-play-game" type="checkbox" class="filter_game_cards">
                <label for="checkbox-role-play-game">Role-play</label>
                <input id="checkbox-shooter-game" type="checkbox" class="filter_game_cards">
                <label for="checkbox-shooter-game">Shooter</label>
                <input id="checkbox-sport-game" type="checkbox" class="filter_game_cards">
                <label for="checkbox-sport-game">Sport</label>

            </div>
            <!-- games -->
            <div class="container_game_cards">
                <?php foreach ($games as $row) : ?>
                    <article class="game_card" data-category="<?php echo $row["genre"]; ?>">
                        <figure>
                            <img class="product_card" src="img/<?php echo $row["img_link"]; ?>" alt="Een afbeelding van een game">
                        </figure>
                        <div class="box_text_game">
                            <h2 class="titel_game"><?php echo $row["titel"]; ?></h2>
                            <h3 class="genre"><?php echo $row["genre"]; ?></h3>
                            <span class="price">&#x20AC;<?php echo $row["prijzen"]; ?></span>
                            <span class="percentage"><?php echo $row["beoordelingen"]; ?>%</span>
                            <a class="view" href="game_view.php?id=<?php echo $row["id"]; ?>">weergave</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <!-- contact form -->
            <header id="contact" class="header_contact">
                <div class="header">
                    <i class="fa-solid fa-file-lines" id="file"></i>
                    <h2 class="kopje_contact">Contact formulier</h2>
                </div>
            </header>
            <section class="contact_form">
                <form action="index.php" method="POST" class="contact_content" novalidate>
                    <ul class="left_side">
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <p class="contact_p">Amsterdam</p>
                        </li>
                        <li>
                            <i class="fa-solid fa-envelope"></i>
                            <p class="contact_p">ma-web@gmail.com</p>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone"></i>
                            <p class="contact_p">+06879254</p>
                        </li>
                    </ul>
                    <ul class="right_side">
                        <li class="field">
                            <input class="contact_input" value="<?php echo $voornaam;?>" id="voornaam" name="voornaam" type="text" placeholder="voornaam" required>
                            <?php if(!empty($errors["voornaam"]) ): ?>
                            <p class= form_error><?php echo $errors["voornaam"]?></p>
                            <?php endif;?>
                        </li>
                        <li class="field">
                            <input class="contact_input" value="<?php echo $achternaam;?>" id="achternaam" name="achternaam" type="text" placeholder="achternaam" required>
                            <?php if(!empty($errors["achternaam"]) ): ?>
                            <p class= form_error><?php echo $errors["achternaam"]?></p>
                            <?php endif;?>
                        </li>
                        <li class="field">
                            <input class="contact_input" value="<?php echo $email;?>" id="email" name="email" type="email" placeholder="email" required>
                            <?php if(!empty($errors["email"]) ): ?>
                            <p class= form_error><?php echo $errors["email"]?></p>
                            <?php endif;?>
                        </li>
                        <li class="field">
                            <textarea class="contact_textarea" id="bericht" name="bericht" placeholder="Vul uw vraag of bericht in" rows="4" cols="50" required><?php echo $bericht;?></textarea>
                                
                            <?php if(!empty($errors["bericht"]) ): ?>
                            <p class= form_error><?php echo $errors["bericht"]?></p>
                            <?php endif;?>
                        </li>
                        <li><button class="send" type="submit" value="submit">Opsturen</button></li>
                    </ul>
                </form>
            </section>
        </section>
        <footer>
            <span>Xlr8</span>
        </footer>
    </main>
</body>

</html>
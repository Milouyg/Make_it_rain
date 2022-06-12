<?php
require "functions.php"; // mag ook include zijn
$connection = dbConnect();

$trending_games = $connection->query("SELECT * FROM `games` WHERE beoordelingen > 93");
$games = $connection->query("SELECT * FROM `games` WHERE beoordelingen < 94");

// Checken of er gegevens zijn opgestuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gegevens tonen
    print_r($_POST);
    exit;
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
    <script src="https://kit.fontawesome.com/b1a8b29774.js" crossorigin="anonymous"></script>
    <script src="js/main.js" defer></script>
    <title>Notice Games</title>
</head>

<body>
    <!-- Navigatie -->
    <header class="header_navigatie">
        <div class="container">
            <label class="mobile_menu">
                <i class="fa fa-bars"></i>
            </label>
            <figure class="logo">
                <img class="google" src="img/logo.png" alt="">
            </figure>
            <form class="search_box">
                <input type="text" placeholder="games">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
            <nav class="nav_header">
                <menu>
                    <li><a href="">Shop</a></li>
                    <li><a href="">Categorie</a></li>
                    <li><a href="">Contact</a></li>
                </menu>
            </nav>
            <button class="log_in" onclick="show()">Inloggen</button>
            <div class="container_logIn" id="container_logIn">
                <label for="show" class="close_btn fas fa-times"></label>
                <div class="text">Login Form</div>
                <form>
                    <div class="data">
                        <label for="email">Email</label>
                        <input type="email" id="email" required>
                    </div>
                    <div class="data">
                        <label for="password">Wachtwoord</label>
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
            <header class="header_trending">
                <div class="header" id="trending">
                    <i class="fa-solid fa-fire-flame-curved"></i>
                    <h2 class="kopje_trending_games">Trending Games</h2>
                </div>
            </header>
            <div class="inputs_filters">
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
                        <div class="box_text">
                            <h2 class="titel_game"><?php echo $row["titel"]; ?></h2>
                            <h3 class="genre"><?php echo $row["genre"]; ?></h3>
                            <span class="price"><?php echo $row["prijzen"]; ?></span>
                            <span class="percentage"><?php echo $row["beoordelingen"]; ?>%</span>
                            <a class="view" href="game_view.php?id=<?php echo $row["id"]; ?>">weergave</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <header class="header_game">
                <div class="header" id="trending">
                    <i class="fa-solid fa-fire-flame-curved"></i>
                    <h2 class="kopje_games">Games</h2>
                </div>
            </header>
            <div class="inputs_filters">
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
                        <div class="box_text">
                            <h2 class="titel_game"><?php echo $row["titel"]; ?></h2>
                            <h3 class="genre"><?php echo $row["genre"]; ?></h3>
                            <span class="price"><?php echo $row["prijzen"]; ?></span>
                            <span class="percentage"><?php echo $row["beoordelingen"]; ?>%</span>
                            <a class="view" href="game_view.php?id=<?php echo $row["id"]; ?>">weergave</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <!-- contact form -->
            <header class="header_contact">
                <div class="header" id="trending">
                    <i class="fa-solid fa-fire-flame-curved"></i>
                    <h2 class="kopje_contact">Contact formulier</h2>
                </div>
            </header>
            <section class="contact_form">
            <form action="index.php" method="POST" class="contact_content">
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
                        <label class="contact_text" for="firstname">Voornaam</label>
                        <input class="contact_input" id="firstname" name="firstname" type="text" placeholder="voornaam"
                            required>
                    </li>
                    <li class="field">
                        <label class="contact_text" for="lastname">Achternaam</label>
                        <input class="contact_input" id="lastname" name="lastname" type="text" placeholder="achternaam"
                            required>
                    </li>
                    <li class="field">
                        <label class="contact_text" for="email">Email</label>
                        <input class="contact_input" id="email" name="email" type="email" placeholder="email" required>
                    </li>
                    <li class="field">
                        <label class="contact_text" for="message">Bericht</label>
                        <textarea class="contact_textarea" id="message" name="message" placeholder="bericht" rows="4"
                            cols="50" required></textarea>
                    </li>
                    <button class="send" type="submit" value="submit">Opsturen</button>
                </ul>
            </form>

        </section>

        </section>
    </main>


</body>

</html>
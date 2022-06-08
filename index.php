<?php
require "functions.php"; // mag ook include zijn
$connection = dbConnect();

$trending_games = $connection->query("SELECT * FROM `games` WHERE beoordelingen > 93");
$games = $connection->query("SELECT * FROM `games` WHERE beoordelingen < 94");
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
    <script src="https://kit.fontawesome.com/b1a8b29774.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
    <title>Notice Games</title>
</head>

<body>
    <!-- Navigatie -->
    <header class="header_navigatie">
        <div class="container">
            <label class="mobile_menu" for="icon">
                <i for="icon" class="fa fa-bars"></i>
            </label>
            <figure class="logo">
                <img class="google" src="img/logo.png" alt="">
            </figure>
            <form class="search_box" for="#">
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
                <form action="#">
                    <div class="data">
                        <label for="#">Email or Telefoon</label>
                        <input type="text" required>
                    </div>
                    <div class="data">
                        <label for="#">Wachtwoord</label>
                        <input type="password" required>
                        <div class="forgot_password"><a href="#">Wachtwoord vergeten</a></div>
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
                            <a class="view" href="game_view.php?id=<?php echo $row["id"];?>">weergave</a>
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
                            <a class="view" href="">weergave</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        </section>
        <!-- game section -->
        <section>

        </section>
    </main>


</body>

</html>
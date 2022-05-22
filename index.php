<?php
require "functions.php"; // mag ook include zijn
$connection = dbConnect();

$result = $connection->query("SELECT * FROM `games`");
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
            <label class="mobile_menu" for="">
                <i class="fa fa-bars"></i>
            </label>
            <figure class="logo">
                <img class="google" src="img/testlogo.png" alt="">
            </figure>
            <form class="search_box" action="">
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
            <button class="log_in" id="show" onclick="show()">Inloggen</button>
                <div class="container_logIn">
                    <label for="show" class="close_btn fas fa-times"></label>
                    <div class="text">Login Form</div>
                    <form action="#">
                        <div class="data">
                            <label for="">Email or Telefoon</label>
                            <input type="text" required>
                        </div>
                        <div class="data">
                            <label for="">Wachtwoord</label>
                            <input type="password" required>
                            <div class="forgot_password"><a href="#">Wachtwoord vergeten</a></div>
                        </div>
                            <button class="form_log_in" type="submit">Inloggen</button>
                            <div class="sign_up">Nog geen lid? <a class="make_acc" href=""> Maak hier een account</a></div>
                        </div>
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
                        <img class="foto" src="img/TestFoto.jpg" alt="">
                    </figure>

                    <figure class="slide">
                        <img class="foto" src="https://via.placeholder.com/1440x600" alt="">
                    </figure>

                    <figure class="slide">
                        <img class="foto" src="https://via.placeholder.com/1440x600" alt="">
                    </figure>

                    <figure class="slide">
                        <img class="foto" src="https://via.placeholder.com/1444x600" alt="">
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
            </header>
            </div>
            <!-- product card -->
            <div class="container_trending_cards">
                <?php foreach($result as $row):?>
                <article class="trending_card">
                    <figure>
                        <img class="product_card" src="img/minecraft.jpg" alt="">
                    </figure>
                    <div class="box_text">
                        <h2 class="titel_game"><?php echo $row["titel"];?></h2>
                        <h3 class="genre"><?php echo $row["genre"]?></h3>
                        <span class="price"><?php echo $row["prijzen"];?></span>
                        <span class="percentage"><?php echo $row["beoordelingen"];?></span>
                        <a class="view" href="">weergave></a>
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
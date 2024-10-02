<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>FireBird</title>
</head>

<body>
    <header>
        <div id="leftHeader">
            <div id="logo">
                <a href="./index.php"><img src="./assets/img/logo.png" alt=""></a>
            </div>
        </div>

        <div id="rightHeader">
            <div id="divConnect">
                <?php
                if (empty($_SESSION['id'])) {
                ?>
                    <a href="./connexion.php"><button class="blue">Se connecter</button></a>
                <?php
                } else {
                ?>
                    <a href="./profil.php"><img src="./assets/img/icon-profil.png" alt=""></a>
                    <a href="./logout.php"><button class="blue">Se déconnecter</button></a>
                <?php } ?>

            </div>
        </div>
    </header>

    <div id="domain" class="carousel d-1200 carousel.d-820" carousel-display="1">
        <div class="carousel-actions">
            <ion-icon class="carousel-btn" name="chevron-back-circle-outline"></ion-icon>
            <ion-icon class="carousel-btn" name="chevron-forward-circle-outline"></ion-icon>
        </div>
        <div class="carousel-container">
            <div class="carousel-item">
                <p>Marketing-digital</p>
                <img class="itemImg" src="./assets/img/Marketing-digital.jpg" alt="">
            </div>
            <div class="carousel-item">
                <p>Développement</p>
                <img class="itemImg" src="./assets/img/img dev.jpg" alt="">
            </div>
            <div class="carousel-item">
                <p>Vidéo & Animation</p>
                <img class="itemImg" src="./assets/img/Vidéo & Animation.jpg" alt="">
            </div>

        </div>
    </div>



    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>
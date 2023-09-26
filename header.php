<?php
require_once("db.php"); 
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E"/>
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
            $('#searchForm').submit(function(event) {
                event.preventDefault();
                var recherche = $('#recherche').val(); 

                $.ajax({
                url: 'search.php',
                method: 'GET',
                data: { recherche: recherche },
                dataType: 'html',
                success: function(response) {
                    $('.container-flex').html(response);
                },
                error: function() {
                    alert('Une erreur s\'est produite lors de la recherche.');
                }
                });
            });
            });
        </script>
    </head>
    <body>
        <header>
            <div class="text-header">
                <b>LIVRAISON GRATUITE</b> POUR LES COMMANDES DE PLUS DE 50 €. RETOURS ET ÉCHANGES <b>GRATUITS</b> SUR 60 JOURS.
            </div>
        </header>
        <nav>
            <div class="nav_left-link">
                <a href="index.php"><img src="img/main-picture/ex.png" class="fbs-logo"></a>
                <ul>
                    <li class="link"><a href="">Homme & Femme</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="adidas-m-w.php" class="dropdown-title"><img src="img/main-picture/adidas.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="1-m-w-a.php">Terrain synthétique</a></li>
                                    <li><a href="2-m-w-a.php">Terrain stabilisé</a></li>
                                    <li><a href="3-m-w-a.php">Terrain souple</a></li>
                                    <li><a href="4-m-w-a.php">Terrain gras</a></li>
                                    <li><a href="5-m-w-a.php">En salle</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="nike-m-w.php" class="dropdown-title"><img src="img/main-picture/nike.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="1-m-w-n.php">Terrain synthétique</a></li>
                                    <li><a href="2-m-w-n.php">Surface synthétique</a></li>
                                    <li><a href="3-m-w-n.php">Terrain sec</a></li>
                                    <li><a href="4-m-w-n.php">Terrain gras</a></li>
                                    <li><a href="5-m-w-n.php">En salle</a></li>
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="#" class="dropdown-title"><img src="img/main-picture/puma.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="#">Terrain synthétique</a></li>
                                    <li><a href="#">Terrain dur</a></li>
                                    <li><a href="#">Terrain souple</a></li>
                                    <li><a href="#">Terrain ferme</a></li>
                                    <li><a href="#">En salle</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-title"><img src="img/main-picture/nb.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="#">Pelouse synthétique</a></li>
                                    <li><a href="#">Terrain artificiel</a></li>
                                    <li><a href="#">Terrain souple</a></li>
                                    <li><a href="#">Terrain ferme</a></li>
                                    <li><a href="#">En salle</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </li>
                    <li class="link"><a href="">Enfant</a>
                        <ul class="dropdown-menu">
                        <li>
                                <a href="adidas-child.php" class="dropdown-title"><img src="img/main-picture/adidas.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="1-child-a.php">Multi-terrain</a></li>
                                    <li><a href="2-child-a.php">Terrain souple</a></li>
                                    <li><a href="3-child-a.php">Terrain gras</a></li>
                                    <li><a href="4-child-a.php">Terrain stabilisé</a></li>
                                    <li><a href="5-child-a.php">En salle</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="nike-child.php" class="dropdown-title"><img src="img/main-picture/nike.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="1-child-n.php">Terrain synthétique</a></li>
                                    <li><a href="2-child-n.php">Surface synthétique</a></li>
                                    <li><a href="3-child-n.php">Multi-terrain</a></li>
                                    <li><a href="4-child-n.php">Terrain sec</a></li>
                                    <li><a href="5-child-n.php">En salle</a></li>
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="#" class="dropdown-title"><img src="img/main-picture/puma.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="#">Entraînement sur gazon</a></li>
                                    <li><a href="#">Terrain synthétique</a></li>
                                    <li><a href="#">Terrain ferme</a></li>
                                    <li><a href="#">Terrain dur</a></li>
                                    <li><a href="#">En salle</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-title"><img src="img/main-picture/nb.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="#">Terrain en gazon artificiel</a></li>
                                    <li><a href="#">Surface ferme</a></li>
                                    <li><a href="#">Terrain artificiel</a></li>
                                    <li><a href="#">Terrain ferme</a></li>
                                    <li><a href="#">En salle</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </li>
                    <!-- <li class="link"><a href="">Promotions</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" class="dropdown-title"><img src="img/main-picture/adidas.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="#">Homme & Femme</a></li>
                                    <li><a href="#">Enfant</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-title"><img src="img/main-picture/nike.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="#">Homme & Femme</a></li>
                                    <li><a href="#">Enfant</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-title"><img src="img/main-picture/puma.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="#">Homme & Femme</a></li>
                                    <li><a href="#">Enfant</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-title"><img src="img/main-picture/nb.png" class="size_logo-title"></a>
                                <div class="lign"></div>
                                <ul>
                                    <li><a href="#">Homme & Femme</a></li>
                                    <li><a href="#">Enfant</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
            <div class="nav_right-link">
                <form method="GET" action="search.php">
                    <div style="display: flex; align-items: center;">
                        <input type="text" id="recherche" name="recherche" placeholder="Recherche">
                        <button type="submit" class="search-button">
                            <img src="img/main-picture/search.png">
                        </button>
                    </div>
                </form>
                <a href="favorites.php"><img src="img/main-picture/favorites.png"></a>
                <a href="basket.php"><img src="img/main-picture/basket.png"></a>
                <div class="dropdown-connect">
                    <a href="" class="dropdown-connect-logo"><img src="img/main-picture/user.png"></a>
                    <div class="dropdown-connect-menu">
                        <?php
                        if (isset($_SESSION['id'])) {
                            $sql = "SELECT firstName, isAdmin FROM user WHERE ID_User = :userID";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':userID', $_SESSION['id']);
                            $stmt->execute();
                            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $firstname = $row["firstName"];
                                $isAdmin = $row["isAdmin"];
                                echo "<p><a class='dropdown-connect-user-name' href='user-panel.php'>" . $firstname . "</a></p>";
                                if ($isAdmin == 1) {
                                    echo "<p>-</p>";
                                    echo "<a class='dropdown-connect-user-name' href='admin-panel.php'>Administration</a>";
                                }
                                else {
                                    echo "<br>";
                                }
                                echo "<p>Se déconnecter ?</p>";
                                echo "<a href='requete/disconnect.php'>Déconnexion</a>";
                            }
                        } else {
                            echo "<p>Déjà client ?</p>";
                            echo "<a href='login.php'>S'identifier</a>";
                            echo "<p>Nouveau client ?</p>";
                            echo "<a href='signup.php'>Nous rejoindre</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
        <!-- <footer>
            <p>© 2023 - FootballShoes</p>
        </footer> -->
    </body>
</html>

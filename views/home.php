<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/img/tt.svg" />
</head>

<body>
    <header>
        <div class="header-container">
            <h1>
                <a href="/">
                    <img src="/img/logo.svg" alt="logo">
                </a>
            </h1>

            <button class="header-nav-button" commandfor="header-nav" command="toggle-popover">
                <img src="img/icon_menu.svg" alt="Menu button">
            </button>

            <nav popover id="header-nav" class="header-nav">
                <ul class="header-menu">
                    <li>
                        <a href="/">Accueil</a>
                    </li>
                    <li>
                        <a href="/books">Nos livres à l'échange</a>
                    </li>
                    <li>
                        <a class="header-chat" href="/chat">Messagerie <span class="header-chat-notification">1</span></a>
                    </li>
                    <li>
                        <a class="header-account" href="/account">Mon compte</a>
                    </li>
                    <li>
                        <a href="/signin">Connexion</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-container">
                <div class="hero-content">
                    <h2 class="hero-title">
                        Rejoignez nos lecteurs passionnés
                    </h2>
                    <p class="hero-description">
                        Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.
                    </p>
                    <a class="btn" href="#">Découvrir</a>
                </div>
                <figure class="hero-figure">
                    <img class="hero-img" src="/img/hamza.jpg" alt="Hamza">
                    <figcaption class="hero-figcaption">
                        Hamza
                    </figcaption>
                </figure>
            </div>
        </section>

        <section class="latest-books">
            <div class="latest-books-container">
                <h2>Les derniers livres ajoutés</h2>
                <div class="latest-books-cards card-container">
                    <figure class="card">
                        <img class="card-img" src="/img/esther.jpg" alt="">
                        <figcaption class="card-figcaption">
                            <h3 class="card-figcaption-title">Esther</h3>
                            <p class="card-figcaption-subtitle">Alabaster</p>
                            <span class="card-figcaption-info">Vendu par : CamilleClubLit</span>
                        </figcaption>
                    </figure>

                    <figure class="card">
                        <img class="card-img" src="/img/the_kinkfolk_table.jpg" alt="">
                        <figcaption class="card-figcaption">
                            <h3 class="card-figcaption-title">The Kinfolk Table</h3>
                            <p class="card-figcaption-subtitle">Nathan Williams</p>
                            <span class="card-figcaption-info">Vendu par : Nathalire</span>
                        </figcaption>
                    </figure>

                    <figure class="card">
                        <img class="card-img" src="/img/wabi_sabi.jpg" alt="">
                        <figcaption class="card-figcaption">
                            <h3 class="card-figcaption-title">Wabi Sabi</h3>
                            <p class="card-figcaption-subtitle">Beth Kempton</p>
                            <span class="card-figcaption-info">Vendu par : Alexlecture</span>
                        </figcaption>
                    </figure>

                    <figure class="card">
                        <img class="card-img" src="/img/milk_and_honey.jpg" alt="">
                        <figcaption class="card-figcaption">
                            <h3 class="card-figcaption-title">Milk & honey</h3>
                            <p class="card-figcaption-subtitle">Rupi Kaur</p>
                            <span class="card-figcaption-info">Vendu par : Hugo1990_12</span>
                        </figcaption>
                    </figure>
                </div>

                <a class="btn" href="/books">Voir tous les livres</a>
            </div>
        </section>

        <section class="how-it-works">
            <div class="how-it-works-container">
                <h2>Comment ça marche ?</h2>

                <p class="how-it-works-description">Échanger des livres avec TomTroc c'est simple et amusant ! Suivez ces étapes pour commencer :</p>

                <div class="how-it-works-list">
                    <span class="how-it-works-item">Inscrivez-vous gratuitement sur <br> notre plateforme.</span>
                    <span class="how-it-works-item">Ajoutez les livres que vous souhaitez échanger à <br> votre profil.</span>
                    <span class="how-it-works-item">Parcourez les livres disponibles chez d'autres membres.</span>
                    <span class="how-it-works-item">Proposez un échange et discutez avec d'autres passionnés de lecture.</span>
                </div>

                <a class="btn btn-invert" href="">Voir tous les livres</a>
            </div>
        </section>
        <div class="strech">
            <img class="strech-img" src="/img/stretch.jpg" alt="">
        </div>
        <section class="our-values">
            <div class="our-values-container">
                <h2 class="our-values-title">Nos valeurs</h2>

                <p class="our-values-description">Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
                <p class="our-values-description">Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. </p>
                <p class="our-values-description">Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>

                <div class="our-values-footer">
                    <span class="our-values-footer-content">L'équipe Tom Troc</span>

                    <img class="our-values-footer-img" src="/img/heart.svg" alt="">
                </div>
            </div>
        </section>
    </main>
    <footer>
        <nav>
            <ul class="footer-menu">
                <li><a>Politique de confidentialité</a></li>
                <li><a>Mentions légales</a></li>
                <li><a>Tom Troc &copy;</a></li>
                <li>
                    <a>
                        <img src="/img/tt.svg" alt="logo">
                    </a>
                </li>
            </ul>
        </nav>
    </footer>
</body>

</html>
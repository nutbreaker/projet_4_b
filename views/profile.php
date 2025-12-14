<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

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
        <section class="profile">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="profile-image-container">
                        <img class="profile-img" src="/img/alexlecture.jpg" alt="alexlecture">
                    </div>

                    <hr class="profile-info-separator">

                    <h3 class="profile-info-title">Alexlecture</h3>
                    <p class="profile-info-date">Membre de puis 1 an</p>
                    <h4 class="profile-info-library">Bibliothèque</h4>
                    <p class="profile-info-books"> 4 livres</p>

                    <a class="profile-chat-btn btn btn-invert" href="/chat">écrire un message</a>
                </div>

                <table class="table profile-books">
                    <thead>
                        <tr class="table-header">
                            <th>photo</th>
                            <th>titre</th>
                            <th>auteur</th>
                            <th>description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-row">
                            <td class="table-row-picture"><img class="table-row-img" src="/img/the_kinkfolk_table.jpg" alt="The Kinkfolk Table"></td>
                            <td class="table-row-title">The Kinkfolk Table</td>
                            <td class="table-row-author">Nathan Williams</td>
                            <td class="table-row-description"><span class="table-row-description-container">J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre
                                    captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager
                                    des
                                    moments authentiques autour de la table.

                                    Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans
                                    un
                                    voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la
                                    convivialité.

                                    Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres
                                    chers.

                                    'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain
                                    que
                                    ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres
                                    inspirantes.</span></td>
                        </tr>

                        <tr class="table-row">
                            <td class="table-row-picture"><img class="table-row-img" src="/img/the_kinkfolk_table.jpg" alt="The Kinkfolk Table"></td>
                            <td class="table-row-title">The Kinkfolk Table</td>
                            <td class="table-row-author">Nathan Williams</td>
                            <td class="table-row-description"><span class="table-row-description-container">J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre
                                    captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager
                                    des
                                    moments authentiques autour de la table.

                                    Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans
                                    un
                                    voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la
                                    convivialité.

                                    Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres
                                    chers.

                                    'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain
                                    que
                                    ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres
                                    inspirantes.</span></td>
                        </tr>
                    </tbody>
                </table>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/img/tt.svg" />
</head>

<body class="account">
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
        <section class="account-admin">
            <h2 class="account-title">Mon compte</h2>

            <div class="account-info">
                <div class="account-profile">
                    <div class="account-image-container">
                        <img class="account-img" src="/img/nathalire.jpg" alt="nathalire">
                    </div>
                    <form class="avatar-form" action="/account" method="POST" enctype="multipart/form-data">
                        <label
                            class="avatar-label"
                            for="avatar"
                            role="button"
                            tabindex="0"
                            onkeydown="if([' ', 'Enter'].includes(event.key)) avatar.click()">modifier</label>

                        <input
                            id="avatar"
                            name="avatar"
                            class="avatar-input"
                            type="file"
                            accept="image/png, image/jpeg"
                            aria-hidden="true"
                            tabindex="-1" />
                    </form>

                    <hr class="account-info-separator">

                    <h3 class="account-info-title">nathalire</h3>
                    <p class="account-info-date">Membre de puis 1 an</p>
                    <h4 class="account-info-library">Bibliothèque</h4>
                    <p class="account-info-books"> 4 livres</p>

                </div>

                <div class="account-form-container">
                    <form class="account-form" action="/account" method="POST">
                        <h3>Vos informations personnelles</h3>
                        <label for="email">
                            Addresse email
                            <input type="email" name="email" id="email" placeholder="nathalie@gmail.com">
                        </label>
                        <label for="password">
                            Mot de passe
                            <input type="password" name="password" id="password" placeholder="•••••••••">
                        </label>
                        <label for="username">
                            Pseudo
                            <input type="text" name="username" id="username" placeholder="nathalire">
                        </label>
                        <button class="btn btn-invert" href="#">Enregistrer</button>
                    </form>
                </div>
            </div>
        </section>
        <section class="account-books">
            <table class="books-table">
                <thead>
                    <tr class="books-table-header">
                        <th>photo</th>
                        <th>titre</th>
                        <th>auteur</th>
                        <th>description</th>
                        <th>disponibilité</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="books-table-row">
                        <td><img src="/img/the_kinkfolk_table.jpg" alt="The Kinkfolk Table"></td>
                        <td>The Kinkfolk Table</td>
                        <td>Nathan Williams</td>
                        <td>J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre
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
                            inspirantes.</td>
                        <td><span class="books-table-available">disponible</span></td>
                        <td class="books-table-action">
                            <a class="books-table-edit" href="edit">éditer</a> <a class="books-table-delete" href="#">supprimer</a>
                        </td>
                    </tr>

                    <tr class="books-table-row">
                        <td><img src="/img/the_kinkfolk_table.jpg" alt="The Kinkfolk Table"></td>
                        <td>The Kinkfolk Table</td>
                        <td>Nathan Williams</td>
                        <td>J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre
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
                            inspirantes.</td>
                        <td>
                <span class="books-table-unavailable">non dispo.</span></td>
                        <td class="books-table-action">
                            <a class="books-table-edit" href="edit">éditer</a> <a class="books-table-delete" href="#">supprimer</a>
                        </td>
                    </tr>
                </tbody>
            </table>
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
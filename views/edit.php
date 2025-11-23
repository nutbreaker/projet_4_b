<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/img/tt.svg" />
</head>

<body class="edit">
    <header>
        <h1>
            <a href="/">
                <img src="/img/logo.svg" alt="logo">
            </a>
        </h1>
        <nav>
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
                    <a href="/account">Mon compte</a>
                </li>
                <li>
                    <a href="/signin">Connexion</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="edit-book-container">
            <div class="edit-book-header">
                <a class="edit-book-back-link" href="/account">retour</a>
                <!-- &#8592; -->
                <h2>Modifier les informations</h2>
            </div>
            <section class="edit-book">
                <div class="edit-book-image-container">
                    <span>Photo</span>

                    <img src="/img/the_kinkfolk_table.jpg" alt="the kinkfolk table">

                    <form class="edit-book-image-form" action="/edit" method="POST" enctype="multipart/form-data">
                        <label
                            class="edit-book-image-label"
                            for="editBookImage"
                            role="button"
                            tabindex="0"
                            onkeydown="if([' ', 'Enter'].includes(event.key)) editBookImage.click()">modifier la photo</label>

                        <input
                            id="editBookImage"
                            name="edit-book-image"
                            class="edit-book-image-input"
                            type="file"
                            accept="image/png, image/jpeg"
                            aria-hidden="true"
                            tabindex="-1" />
                    </form>
                </div>

                <form class="edit-book-form" action="/edit" method="POST">
                    <label for="title">
                        Titre
                        <input type="text" name="title" id="title" placeholder="Title">
                    </label>
                    <label for="author">
                        Auteur
                        <input type="text" name="author" id="author" placeholder="Auteur">
                    </label>
                    <label for="comment">
                        Commentaire
                        <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
                    </label>

                    <label for="availability">
                        Disponibilité
                        <select name="availability" id="availability">
                            <option value="1">disponible</option>
                            <option value="0">non disponible</option>
                        </select>
                    </label>
                    <button class="btn" href="#">Valider</button>
                </form>
            </section>
        </div>
    </main>
    <footer class="footer">
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
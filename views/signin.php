<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/img/tt.svg" />
</head>

<body class="signin">
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
        <section class="signin-section">
            <form action="/signin" method="POST">
                <h2>Inscription</h2>
                <label for="name">
                    Pseudo
                    <input type="text" name="name" id="name">
                </label>
                <label for="email">
                    Addresse e-mail
                    <input type="email" name="email" id="email">
                </label>
                <label for="password">
                    Mot de passe
                    <input type="password" name="password" id="password">
                </label>
                <button class="btn" href="#">S'inscrire</button>

                <span>Déjà inscrit ? <a href="/signup">Connectez-vous</a></span>
            </form>

            <img src="/img/sign-in-up.jpg" alt="signin image">
        </section>
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
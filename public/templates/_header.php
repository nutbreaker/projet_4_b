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
                <?php if ($params['isAuthenticated'] ?? false) : ?>
                    <li>
                        <a class="header-chat" href="/chat">Messagerie <span class="header-chat-notification">1</span></a>
                    </li>
                    <li>
                        <a class="header-account" href="/account">Mon compte</a>
                    </li>
                    <li>
                        <a href="/signout">Déconnexion</a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="/signin">Connexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
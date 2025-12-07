<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/img/tt.svg" />
</head>

<body class="chat">
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
        <aside class="chat-user-list">
            <h2>Messagerie</h2>
            <ul>
                <li class="chat-active">
                    <a class="chat-user" href="#">
                        <img src="/img/alexlecture.jpg" alt="Alexlecture">
                        <div class="chat-details">
                            <div class="chat-details-header">
                                <span class="chat-user-name">Alexlecture</span>
                                <span class="chat-time">15:43</span>
                            </div>
                            <p class="chat-excerpt">Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="chat-user" href="#">
                        <img src="/img/nathalire.jpg" alt="Nathalire">
                        <div class="chat-details">
                            <div class="chat-details-header">
                                <span class="chat-user-name">Nathalire</span>
                                <span class="chat-time">20:08</span>
                            </div>
                            <p class="chat-excerpt">Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="chat-user" href="#">
                        <img src="/img/sas634.jpg" alt="Sas634">
                        <div class="chat-details">
                            <div class="chat-details-header">
                                <span class="chat-user-name">Sas634</span>
                                <span class="chat-time">15:08</span>
                            </div>
                            <p class="chat-excerpt">Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor</p>
                        </div>
                    </a>
                </li>
            </ul>
        </aside>
        <section class="chat-window">
            <div class="chat-header">
                <img src="/img/alexlecture.jpg" alt="Alexlecture">

                <span class="chat-user-name">Alexlecture</span>

            </div>
            <div class="chat-messages">
                <div class="message-sent">
                    <span class="message-time">21.08 15:44</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                </div>
                <div class="message-received">
                    <div class="message-received-header">
                        <img src="/img/alexlecture.jpg" alt="Alexlecture">
                        <span class="message-time">21.08 15:48</span>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                </div>
            </div>
            <div class="chat-input">
                <input type="text" name="chat-message-text" id="chat-message-text">

                <button class="btn">Envoyer</button>
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
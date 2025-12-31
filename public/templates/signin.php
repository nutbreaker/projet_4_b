<section class="signin-section">
    <div class="signin-section-column">
        <form action="/signin" method="POST">
            <h2>Connexion</h2>
            <label for="email">
                Addresse e-mail
                <input type="email" name="email" id="email" value="<?= $params['email'] ?? '' ?>" required>
            </label>
            <label for="password">
                Mot de passe
                <input type="password" name="password" id="password" required>
            </label>
            <button class="btn">Se connecter</button>

            <?php if (!empty($params['errors'])): ?>
                <ul class="errors">
                    <?php foreach ($params['errors'] as $error): ?>
                        <li class="error"><?= htmlentities($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <span>Pas de compte ? <a href="/signup">Inscrivez-vous</a></span>
        </form>
    </div>
    <div class="signin-section-column">
        <img src="/img/sign-in-up.jpg" alt="signin image">
    </div>
</section>
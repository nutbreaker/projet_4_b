<section class="signup-section">
    <div class="signup-section-column">
        <form action="/signup" method="POST">
            <h2>Inscription</h2>
            <label for="username">
                Pseudo
                <input type="text" name="username" id="username" value="<?= $params['username'] ?? '' ?>" required>
            </label>
            <label for="email">
                Addresse e-mail
                <input type="email" name="email" id="email" value="<?= $params['email'] ?? '' ?>" required>
            </label>
            <label for="password">
                Mot de passe
                <input type="password" name="password" id="password" required>
            </label>
            <button class="btn">S'inscrire</button>

            <?php if (!empty($params['errors'])): ?>
                <ul class="errors">
                    <?php foreach ($params['errors'] as $error): ?>
                        <li class="error"><?= htmlentities($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <span>Déjà inscrit ? <a href="/signin">Connectez-vous</a></span>
        </form>
    </div>

    <div class="signup-section-column">
        <img src="/img/sign-in-up.jpg" alt="signup image">
    </div>
</section>
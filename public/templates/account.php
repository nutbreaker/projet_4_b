<div class="account-container">
    <section class="account-admin">
        <h2 class="account-title">Mon compte</h2>

        <div class="account-info">
            <div class="account-profile">
                <div class="account-image-container">
                    <img
                        class="account-img"
                        src="<?= $params['utils']::sanitize($params['user']->getImage()) ?>"
                        alt="<?= $params['utils']::sanitize($params['user']->getUsername()) ?>">
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
                        tabindex="-1"
                        onchange="this.form.submit()" />
                </form>

                <hr class="account-info-separator">

                <h3 class="account-info-title"><?= $params['utils']::sanitize($params['user']->getUsername()) ?></h3>

                <p class="account-info-date">Membre depuis <?= $params['utils']::getTimeAgo($params['user']->getCreatedAt()->getTimeStamp()) ?></p>

                <h4 class="account-info-library">Bibliothèque</h4>
                <p class="account-info-books"> <?= $params['nbBooks']  . " " . ngettext("livre", "livres", $params['nbBooks']) ?></p>

            </div>

            <div class="account-form-container">
                <form class="account-form" action="/account" method="POST">
                    <h3>Vos informations personnelles</h3>
                    <label for="email">
                        Addresse email
                        <input type="email" name="email" id="email" required value="<?= $params['utils']::sanitize($params['user']->getEmail()) ?>">
                    </label>
                    <label for="password">
                        Mot de passe
                        <input type="password" name="password" id="password" placeholder="•••••••••">
                    </label>
                    <label for="username">
                        Pseudo
                        <input type="text" name="username" id="username" required value="<?= $params['utils']::sanitize($params['user']->getUsername()) ?>">
                    </label>
                    <button class="btn btn-invert">Enregistrer</button>
                </form>
            </div>
        </div>
    </section>
    <section class="account-books">
        <?php if ($params['nbBooks'] > 0): ?>
            <a class="account-add-book" href="/add">Ajouter un livre</a>

            <table class="table">
                <thead>
                    <tr class="table-header">
                        <th>photo</th>
                        <th>titre</th>
                        <th>auteur</th>
                        <th>description</th>
                        <th>disponibilité</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($params['books'] as $book): ?>
                        <tr class="table-row">
                            <td class="table-row-picture"><img class="table-row-img" src="<?= $params['utils']::sanitize($book->getImage()) ?>" alt="<?= $params['utils']::sanitize($book->getTitle()) ?>"></td>
                            <td class="table-row-title"><?= $params['utils']::sanitize($book->getTitle()) ?></td>
                            <td class="table-row-author"><?= $params['utils']::sanitize($book->getAuthor()) ?></td>
                            <td class="table-row-description"><span class="table-row-description-container"><?= $params['utils']::sanitize($book->getDescription()) ?></span></td>
                            <td class="table-row-availibility">
                                <?php if ($book->getAvailability()): ?>
                                    <span class="table-row-available">disponible</span>
                                <?php else: ?>
                                    <span class="table-row-unavailable">non dispo.</span>
                                <?php endif; ?>
                            </td>
                            <td class="table-row-action">
                                <span class="table-raw-action-container">
                                    <a
                                        class="table-edit"
                                        href="/edit?book_id=<?= $params['utils']::sanitize($book->getId()) ?>">éditer</a>
                                    <a
                                        class="table-delete"
                                        href="/account?delete_book_id=<?= $params['utils']::sanitize($book->getId()) ?>"
                                        onclick="return confirm('êtes-vous sûr de vouloir supprimer ce livre ?')">supprimer</a>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p class="account-no-books">Vous n'avez pas encore ajouté de livre à votre bibliothèque.</p>
            <a class="btn btn-primary" href="/add">Ajouter un livre</a>
        <?php endif; ?>

    </section>
</div>
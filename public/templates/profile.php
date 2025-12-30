<section class="profile">
    <div class="profile-container">
        <div class="profile-info">
            <div class="profile-image-container">
                <img
                    class="profile-img"
                    src="<?= $params['utils']::sanitize($params['user']->getImage()) ?>"
                    alt="<?= $params['utils']::sanitize($params['user']->getUsername()) ?>">
            </div>

            <hr class="profile-info-separator">

            <h3 class="profile-info-title"><?= $params['utils']::sanitize($params['user']->getUsername()) ?></h3>
            <p class="profile-info-date">Membre <?= $params['utils']::getTimeAgo($params['user']->getCreatedAt()->getTimeStamp()) ?></p>
            <h4 class="profile-info-library">Bibliothèque</h4>
            <p class="profile-info-books"><?= count($params['books']) . " " . ngettext("livre", "livres", count($params['books'])) ?></p>

            <?php if (!$params['isUserMatch']): ?>
                <a class="profile-chat-btn btn btn-invert" href="/chat?id=<?= $params['utils']::sanitize($params['user']->getId()) ?>">écrire un message</a>
            <?php endif; ?>
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

                <?php foreach ($params['books'] as $book): ?>
                    <tr class="table-row">
                        <td class="table-row-picture"><img class="table-row-img" src="<?= $params['utils']::sanitize($book->getImage()) ?>" alt="<?= htmlentities($book->getTitle()) ?>"></td>
                        <td class="table-row-title"><?= $params['utils']::sanitize($book->getTitle()) ?></td>
                        <td class="table-row-author"><?= $params['utils']::sanitize($book->getAuthor()) ?></td>
                        <td class="table-row-description"><span class="table-row-description-container"><?= $params['utils']::sanitize($book->getDescription()) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
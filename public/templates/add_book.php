<?php
// Since no figma design is provided for this page, we reuse the edit book design for adding a book.
?>
<div class="edit-book-container">
    <div class="edit-book-header">
        <a class="edit-book-back-link" href="/account">retour</a>
        <h2>Ajouter un livre</h2>
    </div>
    <section class="edit-book">
        <form class="edit-book-form" action="/add" method="POST" enctype="multipart/form-data">
            <label for="title">
                Titre
                <input type="text" name="title" id="title" value="<?= $params['bookTitle'] ?? '' ?>" placeholder="Titre" required>
            </label>
            <label for="author">
                Auteur
                <input type="text" name="author" id="author" value="<?= $params['bookAuthor'] ?? '' ?>" placeholder="Auteur" required>
            </label>
            <label for="image">
                Image (PNG ou JPEG)
                <input type="file" name="image" id="image" accept="image/png, image/jpeg" multiple="false">
            </label>
            <label for="comment">
                Commentaire
                <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Commentaire" required><?= $params['bookComment'] ?? '' ?></textarea>
            </label>

            <label for="availability">
                Disponibilité
                <select name="availability" id="availability">
                    <option value="1" <?= $_SERVER['REQUEST_METHOD'] === 'POST' && $params['bookAvailability'] ? 'selected' : '' ?>>disponible</option>
                    <option value="0" <?= $_SERVER['REQUEST_METHOD'] === 'POST' && !$params['bookAvailability'] ? 'selected' : '' ?>>non disponible</option>
                </select>
            </label>
            <button class="btn" href="#">Valider</button>

            <?php if (!empty($params['errors'])): ?>
                <ul class="errors">
                    <?php foreach ($params['errors'] as $error): ?>
                        <li class="error"><?= htmlentities($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </form>
    </section>
</div>
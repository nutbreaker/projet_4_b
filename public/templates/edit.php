        <div class="edit-book-container">
            <div class="edit-book-header">
                <a class="edit-book-back-link" href="/account">retour</a>
                <!-- &#8592; -->
                <h2>Modifier les informations</h2>
            </div>
            <section class="edit-book">
                <div class="edit-book-image-container">
                    <span>Photo</span>

                    <img src="<?= $params['utils']::sanitize($params['book']->getImage()) ?>" alt="<?= $params['utils']::sanitize($params['book']->getTitle()) ?>" class="edit-book-image">

                    <form class="edit-book-image-form" action="/edit?book_id=<?= $params['utils']::sanitize($params['book']->getId()) ?>" method="POST" enctype="multipart/form-data">
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
                            tabindex="-1"
                            onchange="this.form.submit()" />
                    </form>
                </div>

                <form class="edit-book-form" action="/edit?book_id=<?= $params['utils']::sanitize($params['book']->getId()) ?>" method="POST">
                    <label for="title">
                        Titre
                        <input type="text" name="title" id="title" placeholder="Title" value="<?= $params['utils']::sanitize($params['book']->getTitle()) ?>" required>
                    </label>
                    <label for="author">
                        Auteur
                        <input type="text" name="author" id="author" placeholder="Auteur" value="<?= $params['utils']::sanitize($params['book']->getAuthor()) ?>" required>
                    </label>
                    <label for="comment">
                        Commentaire
                        <textarea name="comment" id="comment" cols="30" rows="10" required><?= $params['utils']::sanitize($params['book']->getDescription()) ?></textarea>
                    </label>

                    <label for="availability">
                        Disponibilité
                        <select name="availability" id="availability">
                            <option value="1" <?= $params['utils']::sanitize($params['book']->getAvailability()) == 1 ? 'selected' : '' ?>>disponible</option>
                            <option value="0" <?= $params['utils']::sanitize($params['book']->getAvailability()) == 0 ? 'selected' : '' ?>>non disponible</option>
                        </select>
                    </label>
                    <button class="btn" href="#">Valider</button>

                    <?php if (!empty($params['errors'])): ?>
                        <ul class="errors">
                            <?php foreach ($params['errors'] as $error): ?>
                                <li class="error"><?= $params['utils']::sanitize($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </form>
            </section>
        </div>
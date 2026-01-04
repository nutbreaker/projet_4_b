<?php $bookId = $params['utils']::sanitize($book->getId()); ?>
<!-- https://www.w3.org/TR/WCAG20-TECHS/ARIA13.html#ARIA13-examples -->
<!-- https://github.com/validator/validator/issues/2021 -->
<a href="/book?id=<?= $bookId ?>"
    aria-labelledby="card-figcaption-title-<?= $bookId ?> card-figcaption-subtitle-<?= $bookId ?> card-figcaption-unavailable-<?= $bookId ?> card-figcaption-info-<?= $bookId ?>">
    <figure class="card">
        <img
            class="card-img"
            src="<?= $params['utils']::sanitize($book->getImage()) ?>"
            alt="<?= $params['utils']::sanitize($book->getTitle()) ?>">
        <figcaption class="card-figcaption">
            <h3 id="card-figcaption-title-<?= $bookId ?>" class="card-figcaption-title"><?= $params['utils']::sanitize($book->getTitle()) ?></h3>
            <p id="card-figcaption-subtitle-<?= $bookId ?>" class="card-figcaption-subtitle"><?= $params['utils']::sanitize($book->getAuthor()) ?></p>

            <?php if (!$book->getAvailability()): ?>
                <span id="card-figcaption-unavailable-<?= $bookId ?>" class="card-figcaption-unavailable">non dispo.</span>
            <?php endif; ?>

            <span id="card-figcaption-info-<?= $bookId ?>" class="card-figcaption-info">Vendu par : <?= $params['utils']::sanitize($params['userRepository']->find($book->getUserId())->getUsername()); ?></span>
        </figcaption>
    </figure>
</a>
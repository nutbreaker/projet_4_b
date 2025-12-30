 <section class="book-section">

     <figure class="book-section-figure">
         <img src="<?= $params['utils']::sanitize($params['book']->getImage()) ?>" alt="<?= $params['utils']::sanitize($params['book']->getTitle()) ?>">

         <figcaption>
             <h2><?= $params['utils']::sanitize($params['book']->getTitle()) ?></h2>

             <span>par <?= $params['utils']::sanitize($params['book']->getAuthor()) ?></span>

             <hr>

             <h3>Description</h3>

             <p><?= nl2br($params['utils']::sanitize($params['book']->getDescription())) ?></p>

             <h3>Propriétaire</h3>
             <a class="book-owner" href="/profile?id=<?= $params['utils']::sanitize($params['user']->getId()) ?>">
                 <div>
                     <img src="<?= $params['utils']::sanitize($params['user']->getImage()) ?>" alt="<?= $params['utils']::sanitize($params['user']->getUsername()) ?>">
                 </div>
                 <span><?= $params['utils']::sanitize($params['user']->getUsername()) ?></span>
             </a>
             <?php if (!$params['isUserMatch']): ?>
                 <a class="book-send-message btn" href="/chat?id=<?= $params['utils']::sanitize($params['user']->getId()) ?>">Envoyer un message</a>
             <?php endif; ?>
         </figcaption>
     </figure>

 </section>
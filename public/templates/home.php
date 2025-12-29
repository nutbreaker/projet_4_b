  <section class="hero">
      <div class="hero-container">
          <div class="hero-content">
              <h2 class="hero-title">
                  Rejoignez nos lecteurs passionnés
              </h2>
              <p class="hero-description">
                  Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.
              </p>
              <?php if (!($params['isAuthenticated'] ?? false)) : ?>
                  <a class="btn" href="/signup">Découvrir</a>
              <?php endif; ?>
          </div>
          <figure class="hero-figure">
              <img class="hero-img" src="/img/hamza.jpg" alt="Hamza">
              <figcaption class="hero-figcaption">
                  Hamza
              </figcaption>
          </figure>
      </div>
  </section>

  <?php if (!empty($params['books'])) : ?>
      <section class="latest-books">
          <div class="latest-books-container">
              <h2>Les derniers livres ajoutés</h2>
              <div class="latest-books-cards card-container">
                  <?php foreach ($params['books'] as $book): ?>
                      <a href="book?id=<?= $params['utils']::sanitize($book->getId()) ?>">
                          <figure class="card">
                              <img
                                  class="card-img"
                                  src="<?= $params['utils']::sanitize($book->getImage()) ?>"
                                  alt="<?= $params['utils']::sanitize($book->getTitle()) ?>">
                              <figcaption class="card-figcaption">
                                  <h3 class="card-figcaption-title"><?= $params['utils']::sanitize($book->getTitle()) ?></h3>
                                  <p class="card-figcaption-subtitle"><?= $params['utils']::sanitize($book->getAuthor()) ?></p>
                                  <span class="card-figcaption-info">Vendu par : <?= $params['utils']::sanitize($params['userRepository']->find($book->getUserId())->getUsername()) ?></span>
                              </figcaption>
                          </figure>
                      </a>
                  <?php endforeach; ?>
              </div>

              <a class="btn" href="/books">Voir tous les livres</a>
          </div>
      </section>
  <?php endif; ?>

  <section class="how-it-works">
      <div class="how-it-works-container">
          <h2>Comment ça marche ?</h2>

          <p class="how-it-works-description">Échanger des livres avec TomTroc c'est simple et amusant ! Suivez ces étapes pour commencer :</p>

          <div class="how-it-works-list">
              <span class="how-it-works-item">Inscrivez-vous gratuitement sur <br> notre plateforme.</span>
              <span class="how-it-works-item">Ajoutez les livres que vous souhaitez échanger à <br> votre profil.</span>
              <span class="how-it-works-item">Parcourez les livres disponibles chez d'autres membres.</span>
              <span class="how-it-works-item">Proposez un échange et discutez avec d'autres passionnés de lecture.</span>
          </div>

          <?php if (!empty($params['books'])) : ?>
              <a class="btn btn-invert" href="">Voir tous les livres</a>
          <?php endif; ?>
      </div>
  </section>
  <div class="strech">
      <img class="strech-img" src="/img/stretch.jpg" alt="Personne devant une bibliothèque">
  </div>
  <section class="our-values">
      <div class="our-values-container">
          <h2 class="our-values-title">Nos valeurs</h2>

          <p class="our-values-description">Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
          <p class="our-values-description">Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. </p>
          <p class="our-values-description">Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>

          <div class="our-values-footer">
              <span class="our-values-footer-content">L'équipe Tom Troc</span>

              <img class="our-values-footer-img" src="/img/heart.svg" alt="">
          </div>
      </div>
  </section>
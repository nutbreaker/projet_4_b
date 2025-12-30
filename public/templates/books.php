 <section class="book-exchange">
     <div class="book-exchange-container">
         <div class="book-exchange-header">
             <h2 class="book-exchange-title">Nos livres à l'échange</h2>
             <span class="book-exchange-search">
                 <form>
                     <input class="book-exchange-input" type="search" name="q" id="book-exchange-input" placeholder="Rechercher un livre" autofocus value="<?= $params['utils']::sanitize(trim($params['query'] ?? '')) ?>">
                 </form>
             </span>
         </div>

         <div class="book-exchange-cards card-container">
             <?php foreach ($params['books'] as $book): ?>
                 <?php require('_card.php') ?>
             <?php endforeach; ?>
         </div>
     </div>
 </section>
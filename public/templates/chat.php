<?php $hasReceiver = isset($params['receiver']); ?>
<div class="chat-container">
    <aside class="chat-user-list <?= $hasReceiver ? 'hide-reponsive' : '' ?>">
        <h2>Messagerie</h2>
        <ul>
            <?php foreach ($params['chatPartners'] as $chatPartner): ?>
                <li class="<?= $params['receiver'] && $params['receiver']->getId() === $chatPartner['partner']->getId() ? 'chat-active' : '' ?>">
                    <a class="chat-user" href="/chat?id=<?= $chatPartner['partner']->getId() ?>">
                        <img src="<?= $params['utils']::sanitize($chatPartner['partner']->getImage()) ?>" alt="<?= $params['utils']::sanitize($chatPartner['partner']->getUserName()) ?>">
                        <div class="chat-details">
                            <div class="chat-details-header">
                                <span class="chat-user-name"><?= $params['utils']::sanitize($chatPartner['partner']->getUserName()) ?></span>
                                <span class="chat-time"><?= $chatPartner['lastMessage']->getSentAt()->format('H:i') ?></span>
                            </div>
                            <p class="chat-excerpt"><?= $params['utils']::sanitize($chatPartner['lastMessage']->getMessage()) ?></p>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>
    <section class="chat-window <?= !$hasReceiver ? 'hide-reponsive' : '' ?>">
        <?php if ($params['receiver']): ?>
            <?php
            $sanitizedReceiverImage = $params['utils']::sanitize($params['receiver']->getImage());
            $sanitizedReceiverUserName = $params['utils']::sanitize($params['receiver']->getUserName());
            ?>

            <a class="chat-back-link" href="/chat">retour</a>

            <div class="chat-header">
                <img src="<?= $sanitizedReceiverImage ?>" alt="<?= $sanitizedReceiverUserName ?>">

                <span class="chat-user-name"><?= $sanitizedReceiverUserName ?></span>
            </div>

            <div class="chat-messages">
                <?php foreach ($params['messages'] as $message): ?>
                    <?php
                    $sentAt = $message->getSentAt()->format('d.m H:i');
                    $sentAtDetailed = $message->getSentAt()->format('d.m.Y H:i:s');
                    $sanitizedMessage = $params['utils']::sanitize($message->getMessage());
                    ?>
                    <?php if ($message->getSenderId() === $params['user']->getId()): ?>
                        <div class="message-sent">
                            <span class="message-time" title="<?= $sentAtDetailed ?>"><?= $sentAt ?></span>
                            <p><?= $sanitizedMessage ?></p>
                        </div>
                    <?php else: ?>
                        <div class="message-received">
                            <div class="message-received-header">
                                <img src="<?= $sanitizedReceiverImage ?>" alt="<?= $sanitizedReceiverUserName ?>">
                                <span class="message-time" title="<?= $sentAtDetailed ?>"><?= $sentAt ?></span>
                            </div>
                            <p><?= $sanitizedMessage ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <form action="chat?id=<?= $params['utils']::sanitize($params['receiver']->getId()) ?>" method="POST" class="chat-input">
                <input type="text" name="chat-message-text" id="chat-message-text" autocomplete="off" required>

                <button class="btn">Envoyer</button>
            </form>
        <?php elseif ($params['chatPartners']): ?>
            <p class="chat-info">Sélectionner une discussion.</p>
        <?php else: ?>
            <p class="chat-info">Aucune discussion en cours.</p>
        <?php endif; ?>
    </section>
</div>
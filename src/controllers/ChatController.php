<?php

namespace tomtroc\controllers;

use tomtroc\models\Chat;
use tomtroc\models\User;
use tomtroc\services\AuthenticationService;
use tomtroc\services\SessionService;
use tomtroc\services\ViewService;
use tomtroc\repositories\ChatRepository;
use tomtroc\repositories\UserRepository;
use tomtroc\utils\Utils;

class ChatController
{
    private string $title = 'Tom Troc - Messagerie';

    public function __construct(
        private ViewService $viewService,
        private AuthenticationService $authenticationService,
        private SessionService $sessionService,
        private UserRepository $userRepository,
        private ChatRepository $chatRepository
    ) {}

    public function __invoke()
    {
        if (!in_array($_SERVER['REQUEST_METHOD'], ['POST', 'GET'])) {
            $this->viewService->view(
                'error',
                [
                    'title' => '405 Method Not Allowed',
                    'message' => 'Méthode non autorisée',
                ],
                405
            );

            die();
        }

        $this->authenticationService->lock();

        $user = $this->userRepository->find(
            $this->sessionService->getValue("id_user")
        );

        $receiverId = intval($_GET['id'] ?? null);

        if (!$user) {
            $this->viewService->view('error', [
                'title' => '404 Not Found',
                'message' => 'Utilisateur non trouvé.',
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
            ], 404);

            die();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->get($receiverId, $user);

            return;
        }

        $this->post($receiverId, $user);
    }

    public function get(int $receiverId, User $user): void
    {
        try {
            $chatPartners = $this->getChatPartners($user);
            $messages = [];
            $receiver = $this->getMessageReceiver($receiverId, $user);

            if ($receiver) {
                $messages = $this->chatRepository->findAllBySendAndReceiverId($user->getId(), $receiver->getId());
            }

            $this->viewService->view('chat', [
                'title' => $this->title,
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
                'user' => $user,
                'receiver' => $receiver,
                'messages' => $messages,
                'chatPartners' => $chatPartners,
                'utils' => Utils::class,
            ]);
        } catch (\Exception $_) {
            error_log($_);
            $message = "Une erreur est survenue lors de la mise à jour. Veuillez réessayer plus tard.";

            $this->viewService->view(
                'error',
                [
                    'title' => '500 Internal Server Error',
                    'message' => $message
                ],
                500
            );
        }
    }

    public function post(int $receiverId, User $user): void
    {
        try {
            $chatMessage = Utils::sanitize($_POST['chat-message-text'] ?? '');
            $receiver = $this->getMessageReceiver($receiverId, $user);

            if ($chatMessage) {
                $chat = new Chat();
                $chat
                    ->setSenderId($user->getId())
                    ->setReceiverId($receiver->getId())
                    ->setMessage($chatMessage);

                $this->chatRepository->add($chat);
            }

            header("Location: //{$_SERVER['HTTP_HOST']}/chat?id={$receiver->getId()}");
            die();
        } catch (\Exception $_) {
            $message = "Une erreur est survenue lors de la mise à jour. Veuillez réessayer plus tard.";

            $this->viewService->view(
                'error',
                ['title' => '500 Internal Server Error', 'message' => $message],
                500
            );
        }
    }

    private function denySameUserChat(?User $receiver, User $user)
    {
        if ($receiver && $receiver->getId() === $user->getId()) {
            $this->viewService->view('error', [
                'title' => '400 Bad Request',
                'message' => "Opération non permise.",
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
            ], 400);

            die();
        }
    }

    private function getMessageReceiver(int $receiverId, User $user): User|null
    {
        $receiver = null;

        if ($receiverId) {
            $receiver = $this->userRepository->find($receiverId);
        }

        $this->hasChatPartner($receiverId, $receiver);
        $this->denySameUserChat($receiver, $user);

        return $receiver;
    }

    public function hasChatPartner($receiverId, $receiver)
    {
        if ($receiverId && !$receiver) {
            $this->viewService->view(
                'error',
                [
                    'title' => '404 Not Found',
                    'message' => 'Chat non trouvé.',
                ],
                404
            );

            die();
        }
    }

    private function getChatPartners(User $user): array
    {
        $chatPartners = [];
        $chatPartnerIds = $this->chatRepository->findChatPartnerIdsByUserId($user->getId());

        foreach ($chatPartnerIds as $partnerId) {
            $partner = $this->userRepository->find($partnerId);
            $partnerMessages = $this->chatRepository->findAllBySendAndReceiverId($user->getId(), $partner->getId());
            $chatPartners[] = [
                'partner' => $partner,
                'lastMessage' => end($partnerMessages)
            ];
        }

        return $chatPartners;
    }
}

<?php

namespace tomtroc\repositories;

use tomtroc\models\Chat;
use tomtroc\utils\Database;

/**
 * Chat repository
 */
class ChatRepository
{
    private \PDO $database;

    public function __construct(Database $database)
    {
        $this->database = $database->getPDO();
    }

    public function findAllBySendAndReceiverId(int $senderId, int $receiverId, int $last_id = 0): array
    {
        $chats = [];

        $sql =  <<<SQLREQUEST
        SELECT * 
        FROM chats 
        WHERE 
            ((sender_id = :sender_id AND receiver_id = :receiver_id) OR 
                (sender_id = :receiver_id AND receiver_id = :sender_id)) 
            AND id > :last_id 
        ORDER BY sent_at ASC
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':sender_id'  => $senderId,
                ':receiver_id' => $receiverId,
                ':last_id' => $last_id,
            ]);

            $chats = $stmt->fetchAll(\PDO::FETCH_CLASS, Chat::class);

            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $chats;
    }

    public function findChatPartnerIdsByUserId(int $userId): array
    {
        $chatPartners = [];

        $sql =  <<<SQLREQUEST
        SELECT DISTINCT 
            sender_id AS chat_partner_id 
        FROM chats 
        WHERE receiver_id = :user_id

        UNION

        SELECT DISTINCT 
            receiver_id AS chat_partner_id 
        FROM chats 
        WHERE sender_id = :user_id
        ORDER BY chat_partner_id
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':user_id'  => $userId,
            ]);

            $chatPartners = $stmt->fetchAll(\PDO::FETCH_COLUMN);

            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $chatPartners;
    }

    public function findUnreadMessageCountByUserId(int $userId): int
    {
        $unreadMessageCount = false;

        $sql =  <<<SQLREQUEST
        SELECT COUNT(*) AS unread_messages_count
        FROM chats 
        WHERE (receiver_id = :user_id AND is_read = 0)
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':user_id' => $userId
            ]);

            $unreadMessageCount = intval($stmt->fetchColumn());
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $unreadMessageCount;
    }

    public function add(Chat $chat): int
    {
        $lastInsertId = 0;
        $sql =  <<<SQLREQUEST
        INSERT INTO chats (sender_id, receiver_id, message) 
        VALUES (:sender_id, :receiver_id, :message)
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':sender_id'  => $chat->getSenderId(),
                ':receiver_id' => $chat->getReceiverId(),
                ':message' => $chat->getMessage(),
            ]);

            $lastInsertId = intval($this->database->lastInsertId());
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $lastInsertId;
    }
}

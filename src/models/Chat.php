<?php
namespace tomtroc\models;

use DateTime;

/**
 * Chat entity
 */
class Chat
{
    private ?int $id = null;
    private ?int $sender_id = null;
    private ?int $receiver_id = null;
    private ?string $message = null;
    private ?int $is_read = null;
    private ?string $sent_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getSenderId(): ?int
    {
        return $this->sender_id;
    }

    public function setSenderId(int $senderId): self
    {
        $this->sender_id = $senderId;
        return $this;
    }

    public function getReceiverId(): ?int
    {
        return $this->receiver_id;
    }

    public function setReceiverId(int $receiverId): self
    {
        $this->receiver_id = $receiverId;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getIsRead(): ?int
    {
        return $this->is_read;
    }

    public function setIsRead(int $isRead): self
    {
        $this->is_read = $isRead;
        return $this;
    }

    public function getSentAt(): DateTime
    {
        return new DateTime($this->sent_at);
    }

    public function setSentAt(string $sentAt): self
    {
        $this->sent_at = $sentAt;
        return $this;
    }
}

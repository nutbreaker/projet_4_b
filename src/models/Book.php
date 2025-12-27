<?php
namespace tomtroc\models;

use DateTime;

/**
 * Book entity
 */
class Book
{
    private ?int $id = null;
    private ?int $user_id = null;
    private ?string $title = null;
    private ?string $author = null;
    private ?string $image = null;
    private ?string $description = null;
    private ?int $availability = null;
    private ?string $created_at = null;    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }   

    public function setUserId(int $userId): self
    {
        $this->user_id = $userId;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getAvailability(): ?int
    {
        return $this->availability;
    }

    public function setAvailability(int $availability): self
    {
        $this->availability = $availability;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->created_at = $createdAt;
        return $this;
    }
}

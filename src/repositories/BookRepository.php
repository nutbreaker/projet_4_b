<?php

namespace tomtroc\repositories;

use tomtroc\models\Book;
use tomtroc\utils\Database;

/**
 * Book repository
 */
class BookRepository
{
    private \PDO $database;
    public function __construct(Database $database)
    {
        $this->database = $database->getPDO();
    }
    /**
     * Add a new book
     */
    public function add(Book $book): int
    {
        $lastInsertId = 0;
        $sql =  <<<SQLREQUEST
        INSERT INTO books (title, description, author, image, availability, user_id)
        VALUES (:title, :description, :author, :image, :availability, :user_id)
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':author' => $book->getAuthor(),
                ':availability' => $book->getAvailability(),
                ':description' => $book->getDescription(),
                ':image' => $book->getImage(),
                ':title' => $book->getTitle(),
                ':user_id' => $book->getUserId()
            ]);

            $lastInsertId = intval($this->database->lastInsertId());
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $lastInsertId;
    }

    /**
     * Find book by id
     */
    public function find($id): Book|bool
    {
        $book = null;
        $sql = <<<SQLREQUEST
        SELECT * FROM books WHERE id = :id
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            $book = $stmt->fetchObject(Book::class);
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $book;
    }

    /**
     * Find books by title
     */
    public function findByTitle($title): array
    {
        $books = [];
        $sql = <<<SQLREQUEST
        SELECT * FROM books WHERE title LIKE :title
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':title' => "%$title%"
            ]);

            $books = $stmt->fetchAll(\PDO::FETCH_CLASS, Book::class);

            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $books;
    }

    /**
     * Find all books
     */
    public function findAll(): array
    {
        $books = [];
        $sql = <<<SQLREQUEST
        SELECT * FROM books
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute();

            $books = $stmt->fetchAll(\PDO::FETCH_CLASS, Book::class);
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $books;
    }

    /**
     * Find a limited number of books
     */
    public function findLimited(int $limit = 10): array
    {
        $books = [];
        $sql = <<<SQLREQUEST
        SELECT * FROM books LIMIT :limit
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);

            $stmt->execute();

            $books = $stmt->fetchAll(\PDO::FETCH_CLASS, Book::class);
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $books;
    }

    public function findAllByUserId(int $userId): array
    {
        $books = [];
        $sql = <<<SQLREQUEST
        SELECT * FROM books WHERE user_id = :user_id
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':user_id' => $userId
            ]);

            $books = $stmt->fetchAll(\PDO::FETCH_CLASS, Book::class);
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $books;
    }

    public function countBooksByUserId(int $userId): int
    {
        $bookCount = 0;
        $sql = <<<SQLREQUEST
        SELECT COUNT(1) AS NbBooks FROM books WHERE user_id = :user_id
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':user_id' => $userId
            ]);

            $bookCount = intval($stmt->fetchColumn());
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $bookCount;
    }

    /**
     * Update a book
     */
    public function update(Book $book): bool
    {
        $isUpdated = false;
        $sql = <<<SQLREQUEST
        UPDATE books
        SET 
            title = :title,
            author = :author,
            description = :description,
            image = :image,
            availability = :availability
        WHERE id = :id
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $isUpdated = $stmt->execute([
                ':id' => $book->getId(),
                ':author' => $book->getAuthor(),
                ':availability' => $book->getAvailability(),
                ':description' => $book->getDescription(),
                ':image' => $book->getImage(),
                ':title' => $book->getTitle(),
            ]);

            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $isUpdated;
    }

    /**
     * Remove a book
     */
    public function remove(Book $book): bool
    {
        $isRemoved = false;
        $sql = <<<SQLREQUEST
        DELETE FROM books WHERE id = :id
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $isRemoved = $stmt->execute([
                ':id' => $book->getId()
            ]);

            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $isRemoved;
    }
}

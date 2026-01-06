<?php

namespace tomtroc\repositories;

use tomtroc\utils\Database;
use tomtroc\models\User;

/**
 * User repository
 */
class UserRepository
{
    private \PDO $database;

    /**
     * Constructor
     */
    public function __construct(Database $database)
    {
        $this->database = $database->getPDO();
    }

    /**
     * Add a new user
     */
    public function add(User $user): int
    {
        $lastInsertId = 0;
        $sql =  <<<SQLREQUEST
        INSERT INTO users (username, image, email, password)
        VALUES (:username, :image, :email, :password)
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':username' => $user->getUsername(),
                ':image' => $user->getImage()?: null,
                ':email' => $user->getEmail(),
                ':password' => $user->getPassword()
            ]);

            $lastInsertId = intval($this->database->lastInsertId());
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $lastInsertId;
    }

    /**
     * Find user by id
     */
    public function find($id): User|bool
    {
        $user = null;
        $sql = <<<SQLREQUEST
        SELECT * FROM users WHERE id = :id
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            $user = $stmt->fetchObject(User::class);
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $user;
    }

    /**
     * Find user by email
     */
    public function findByEmail($email): User|bool
    {
        $user = null;
        $sql = <<<SQLREQUEST
        SELECT * FROM users WHERE email = :email
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':email' => $email
            ]);

            $user = $stmt->fetchObject(User::class);
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $user;
    }

    /**
     * Find user by email and password
     */
    public function findByEmailAndPassword($email, $password): User|bool
    {
        $user = null;
        $sql = <<<SQLREQUEST
        SELECT * 
        FROM users 
        WHERE email = :email AND password = :password
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':email' => $email,
                ':password' => $password
            ]);

            $user = $stmt->fetchObject(User::class);
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $user;
    }

    /**
     * Find user by username
     */
    public function findByUsername($username): User|bool
    {
        $user = null;
        $sql = <<<SQLREQUEST
        SELECT * FROM users WHERE username = :username
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute([
                ':username' => $username
            ]);

            $user = $stmt->fetchObject(User::class);
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $user;
    }

    /**
     * Find all users
     */
    public function findAll(): array
    {
        $users = [];
        $sql = <<<SQLREQUEST
        SELECT * FROM users
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $stmt->execute();

            $users = $stmt->fetchAll(User::class);
            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $users;
    }

    /**
     * Update a user
     */
    public function update(User $user): bool
    {
        $isUpdated = false;
        $sql = <<<SQLREQUEST
        UPDATE users
        SET 
            username = :username, 
            image = :image, 
            email = :email, 
            password = :password
        WHERE id = :id
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $isUpdated = $stmt->execute([
                ':id' => $user->getId(),
                ':username' => $user->getUsername(),
                ':image' => $user->getImage(),
                ':email' => $user->getEmail(),
                ':password' => $user->getPassword()
            ]);

            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $isUpdated;
    }

    /**
     * Remove a user
     */
    public function remove(User $user): bool
    {
        $isRemoved = false;
        $sql = <<<SQLREQUEST
        DELETE FROM users WHERE id = :id
        SQLREQUEST;

        try {
            $stmt = $this->database->prepare($sql);

            $isRemoved = $stmt->execute([
                ':id' => $user->getId()
            ]);

            $stmt = null;
        } catch (\PDOException | \Exception $e) {
            throw $e;
        }

        return $isRemoved;
    }
}

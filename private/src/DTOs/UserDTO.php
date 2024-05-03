<?php
declare(strict_types=1);
/**
 * WebServer-FinalProject
 *
 * @autor Paula Miano <paulamiano@gmail.com>
 * (C) Copyright 2024 by Paula Miano
 */

namespace DTOs;

use DateTime;
use Teacher\GivenCode\Abstracts\AbstractDTO;
use Teacher\GivenCode\Exceptions\ValidationException;

class UserDTO extends AbstractDTO {
    
    /**
     * TODO: Class documentation
     * @inheritDoc
     */
    
    public const TABLE_NAME = "users";
    private const USERNAME_MAX_LENGTH = 255;
    private const PASSWORD_HASH_MAX_LENGTH = 255;
    private const EMAIL_MAX_LENGTH = 255;
    
    private string $username;
    private string $passwordHash;
    private string $email;
    private ?DateTime $creationDate;
    private ?DateTime $lastModificationDate;
    
    protected function __construct() {
        parent::__construct();
    }
    
    public function getUsername(): string {
        return $this->username;
    }
    
    public function setUsername(string $username): void {
        if (empty($username) || strlen($username) > self::USERNAME_MAX_LENGTH) {
            throw new ValidationException("Username cannot be empty and must not exceed " . self::USERNAME_MAX_LENGTH . " characters.");
        }
        $this->username = $username;
    }
    
    public function getPasswordHash(): string {
        return $this->passwordHash;
    }
    
    public function setPasswordHash(string $passwordHash): void {
        if (empty($passwordHash) || strlen($passwordHash) > self::PASSWORD_HASH_MAX_LENGTH) {
            throw new ValidationException("Password hash cannot be empty and must not exceed " . self::PASSWORD_HASH_MAX_LENGTH . " characters.");
        }
        $this->passwordHash = $passwordHash;
    }
    
    public function getEmail(): string {
        return $this->email;
    }
    
    public function setEmail(string $email): void {
        if (empty($email) || strlen($email) > self::EMAIL_MAX_LENGTH) {
            throw new ValidationException("Email cannot be empty and must not exceed " . self::EMAIL_MAX_LENGTH . " characters.");
        }
        $this->email = $email;
    }
    
    public function getCreationDate(): ?DateTime {
        return $this->creationDate;
    }
    
    public function getLastModificationDate(): ?DateTime {
        return $this->lastModificationDate;
    }
    
    public static function fromValues(string $username, string $passwordHash, string $email) : UserDTO {
        $userDTO = new UserDTO();
        $userDTO->setUsername($username);
        $userDTO->setPasswordHash($passwordHash);
        $userDTO->setEmail($email);
        // ... Set other properties as needed
        return $userDTO;
    }
    
    public static function fromDbArray(array $dbAssocArray) : UserDTO {
        $userDTO = new UserDTO();
        $userDTO->setId((int) $dbAssocArray["UserID"]);
        $userDTO->setUsername($dbAssocArray["Username"]);
        $userDTO->setPasswordHash($dbAssocArray["PasswordHash"]);
        $userDTO->setEmail($dbAssocArray["Email"]);
        // ... Convert and set other properties, including dates
        return $userDTO;
    }
    
    public function getDatabaseTableName() : string {
        return self::TABLE_NAME;
    }
}
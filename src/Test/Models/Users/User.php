<?php

namespace Test\Models\Users;

use Test\Exceptions\InvalidArgumentException;
use Test\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity
{
    protected $nickname;
    protected $email;
    protected $role;
    protected $isConfirmed;
    protected $passwordHash;
    protected $authToken;
    protected $createdAt;

    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->getRole() === 'admin';
    }

    /**
     * @param bool $isConfirmed
     */
    public function setIsConfirmed(bool $isConfirmed): void
    {
        $this->isConfirmed = $isConfirmed;
    }

    /**
     * @return bool
     */
    public function getIsConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    /**
     * @param string $passwordHash
     */
    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @param string $authToken
     */
    public function setAuthToken(string $authToken): void
    {
        $this->authToken = $authToken;
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'users';
    }

    /**
     * @param array $userData
     * @return static|null
     * @throws InvalidArgumentException
     */
    public static function signIn(array $userData): ?self
    {
        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Введіть ваш Email');
        }

        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Введіть ваш пароль');
        }

        $user = User::findOneByColumn('email', $userData['email']);

        if (empty($user)) {
            throw new InvalidArgumentException('Користувача з таким email не існує');
        }

        if (!password_verify($userData['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Не правильний пароль або email');
        }

        $user->setAuthToken(sha1(random_bytes(100)) . sha1(random_bytes(100)));
        $user->save();

        return $user;
    }

    /**
     * @return void
     */
    public static function logOut(): void
    {
        setcookie('token', '', -1, '/', '');
    }
}
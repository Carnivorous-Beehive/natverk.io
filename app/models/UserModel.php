<?php

namespace Natverk\Models;

use \DateTime;

/**
 * @property-read id
 * @property-read username
 * @property-read hashedPassword
 * @property-read registeredAt
 */
class UserModel extends Model
{
    protected int $id;
    protected string $username;
    protected string $hashedPassword;
    protected DateTime $registeredAt;

    public function __construct(
        int $id,
        string $username,
        string $hashedPassword,
        DateTime $registeredAt,
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
        $this->registeredAt = $registeredAt;
    }

    public function validatePassword(string $password)
    {
        if (!password_verify($password, $this->hashedPassword)) {
            throw new \Error('Invalid username or password');
        }
    }
}

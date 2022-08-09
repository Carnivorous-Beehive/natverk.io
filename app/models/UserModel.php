<?php

namespace Natverk\Models;

use \DateTime;

/**
 * @property-read username
 * @property-read hashedPassword
 * @property-read registeredAt
 */
class UserModel extends Model
{
    protected string $username;
    protected string $hashedPassword;
    protected DateTime $registeredAt;

    public function __construct(
        string $username,
        string $hashedPassword,
        DateTime $registeredAt,
    ) {
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
        $this->registeredAt = $registeredAt;
    }
}

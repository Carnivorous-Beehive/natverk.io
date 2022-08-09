<?php

namespace Natverk\Repositories;

use \PDO;
use Natverk\Models\UserModel;

class UsersRepository extends Repository
{
    /**
     * @return UserModel[]
     */
    public function getAllUsers($page, $size): array
    {
        if (!$page) {
            $page = 1;
        }

        if (!$size) {
            $size = 25;
        }

        $validPage = filter_var($page, FILTER_VALIDATE_INT, array(
            'default' => 1,
            'min_range' => 1,
        ));

        $validSize = filter_var($size, FILTER_VALIDATE_INT, array(
            'default' => 25,
            'min_range' => 1,
            'max_range' => 50,
        ));

        // TODO: don't use offset pagination
        $query = $this->connection()->prepare(
            "SELECT username, hashed_password, registered_at FROM users ORDER BY id LIMIT :offset, :limit"
        );
        $query->bindValue('offset', ($validPage - 1) * $validSize, PDO::PARAM_INT);
        $query->bindValue('limit', $validSize, PDO::PARAM_INT);
        $query->execute();

        $users = array();
        while ($row = $query->fetch()) {
            $registeredAt = new \DateTime();
            $registeredAt->setTimeStamp((int) $row['registered_at']);
            $users[] = new UserModel(
                username: $row['username'],
                hashedPassword: $row['hashed_password'],
                registeredAt: $registeredAt,
            );
        }

        return $users;
    }
}

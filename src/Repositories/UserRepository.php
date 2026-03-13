<?php

namespace App\Repositories;

class UserRepository
{
    private $usersFile;

    public function __construct($usersFile)
    {
        $this->usersFile = $usersFile;
    }

    /**
     * Get all users from JSON file
     */
    public function getAll()
    {
        if (!file_exists($this->usersFile)) {
            return [];
        }
        $content = file_get_contents($this->usersFile);
        return json_decode($content, true) ?: [];
    }

    /**
     * Find a user by their username (CPF)
     */
    public function findByUsername($username)
    {
        $users = $this->getAll();
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                return $user;
            }
        }
        return null;
    }
}

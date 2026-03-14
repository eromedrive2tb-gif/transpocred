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
        $username = preg_replace('/[^0-9]/', '', $username);
        $users = $this->getAll();
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Save all users back to JSON
     */
    public function saveAll(array $users): bool
    {
        return file_put_contents($this->usersFile, json_encode($users, JSON_PRETTY_PRINT)) !== false;
    }

    /**
     * Start a user session after successful login.
     */
    private function startSession(string $username): void
    {
        $username = preg_replace('/[^0-9]/', '', $username);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user'] = $username;
        $_SESSION['logged_in'] = true;
    }

    /**
     * Delete a user and their files
     */
    public function delete(string $username): bool
    {
        $users = $this->getAll();
        $found = false;
        $updatedUsers = [];

        foreach ($users as $user) {
            if ($user['username'] === $username) {
                // Delete associated files if any
                if (isset($user['kyc'])) {
                    foreach ($user['kyc'] as $file) {
                        $filepath = dirname($this->usersFile) . '/../' . $file;
                        if (!empty($file) && file_exists($filepath)) {
                            @unlink($filepath);
                        }
                    }
                }
                $found = true;
            } else {
                $updatedUsers[] = $user;
            }
        }

        if ($found) {
            return $this->saveAll($updatedUsers);
        }
        return false;
    }

    /**
     * Update or add a user
     */
    public function save(array $userData): bool
    {
        $users = $this->getAll();
        $found = false;

        foreach ($users as &$user) {
            if ($user['username'] === $userData['username']) {
                $user = array_merge($user, $userData);
                $found = true;
                break;
            }
        }

        if (!$found) {
            $users[] = $userData;
        }

        return $this->saveAll($users);
    }
}

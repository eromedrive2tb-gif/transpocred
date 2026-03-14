<?php
/**
 * Norse Mythology Naming: Mimir (God of Wisdom/Knowledge)
 * Responsibility: Log file access
 */

namespace App\Repositories;

class MimirRepository
{
    private $logPath;

    public function __construct(string $logPath)
    {
        $this->logPath = $logPath;
    }

    /**
     * Get lines from the log file
     */
    public function getEntries(int $limit = 100): array
    {
        if (!file_exists($this->logPath)) {
            return [];
        }

        $lines = file($this->logPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return [];
        }

        // Return the most recent entries first
        return array_reverse(array_slice($lines, -$limit));
    }

    /**
     * Get raw log content
     */
    public function getRaw(): string
    {
        if (!file_exists($this->logPath)) {
            return "Log file not found.";
        }
        return file_get_contents($this->logPath);
    }
}

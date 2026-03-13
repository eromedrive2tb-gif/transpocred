<?php

namespace App\Repositories;

class TransactionRepository
{
    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $this->ensureDirectoryExists();
    }

    private function ensureDirectoryExists()
    {
        $dir = dirname($this->filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([], JSON_PRETTY_PRINT));
        }
    }

    /**
     * Save a new transaction to the log
     * 
     * @param array $transactionData
     * @return bool
     */
    public function save(array $transactionData): bool
    {
        $fp = fopen($this->filePath, 'c+');
        if (!$fp)
            return false;

        // Acquire exclusive lock
        if (flock($fp, LOCK_EX)) {
            $content = stream_get_contents($fp);
            $transactions = json_decode($content, true) ?: [];

            // Add unique ID and timestamp if not present
            if (!isset($transactionData['id'])) {
                $transactionData['id'] = uniqid('txn_', true);
            }
            if (!isset($transactionData['timestamp'])) {
                $transactionData['timestamp'] = date('c'); // ISO 8601
            }

            $transactions[] = $transactionData;

            // Clear and write new content
            ftruncate($fp, 0);
            rewind($fp);
            fwrite($fp, json_encode($transactions, JSON_PRETTY_PRINT));
            fflush($fp);
            flock($fp, LOCK_UN);
            fclose($fp);
            return true;
        }

        fclose($fp);
        return false;
    }
}

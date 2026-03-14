<?php
/**
 * Hindu Mythology Naming: Kubera (God of Wealth)
 * Responsibility: Transaction data management
 */

namespace App\Repositories;

class KuberaRepository
{
    private $transactionsPath;

    public function __construct(string $transactionsPath)
    {
        $this->transactionsPath = $transactionsPath;
    }

    /**
     * Get all transactions from JSON
     */
    public function getAll(): array
    {
        if (!file_exists($this->transactionsPath)) {
            return [];
        }
        $content = file_get_contents($this->transactionsPath);
        $data = json_decode($content, true);
        return is_array($data) ? $data : [];
    }

    /**
     * Get a specific transaction by ID
     */
    public function getById(string $id): ?array
    {
        $transactions = $this->getAll();
        foreach ($transactions as $txn) {
            if (($txn['id'] ?? '') === $id) {
                return $txn;
            }
        }
        return null;
    }
}

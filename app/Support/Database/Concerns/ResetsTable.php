<?php declare(strict_types = 1);

namespace App\Support\Database\Concerns;

trait ResetsTable
{
    protected function resetTable(?string $table = null): void
    {
        $table = $table ?? $this->getTable();

        if (is_null($table)) {
            return;
        }

        $this->db->table($table)->delete();
        $resetAutoIncrementStm = sprintf('ALTER TABLE %s AUTO_INCREMENT = %d;', $table, 1);
        $this->db->statement($resetAutoIncrementStm);
        $this->note(sprintf('<info>Table reset</info>: %d', $table));
    }
}

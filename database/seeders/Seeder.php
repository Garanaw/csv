<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder as BaseSeeder;
use Illuminate\Database\DatabaseManager;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Cache\Repository as Cache;
use App\Support\Database\Concerns\ResetsTable;

abstract class Seeder extends BaseSeeder
{
    use ResetsTable;

    protected DatabaseManager $db;
    protected ConsoleOutput $output;
    protected Cache $cache;

    protected string $table;

    public function __construct(DatabaseManager $db, ConsoleOutput $output, Cache $cache)
    {
        $this->db = $db;
        $this->output = $output;
        $this->cache = $cache;
    }

    protected function note($message): void
    {
        if ($this->output) {
            $this->output->writeln($message);
        }
    }

    public function getTable(): ?string
    {
        return $this->table;
    }

    public abstract function run(): void;

    protected abstract function getData(): array;
}

<?php declare(strict_types=1);

namespace App\Support\Database;

use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Migrations\Migration as BaseMigration;
use Illuminate\Database\Schema\Builder;

abstract class Migration extends BaseMigration
{
    protected ?string $table = null;

    protected Connection $db;

    protected Builder $schema;

    protected array $seeders = [];

    public function __construct()
    {
        $manager = app(DatabaseManager::class);
        $this->db = $manager->connection();
        $this->schema = $manager->getSchemaBuilder();
    }

    public function hasSeeders(): bool
    {
        return empty($this->seeders) === false;
    }

    public function getSeeders(): array
    {
        return $this->seeders;
    }

    public function getTable(): ?string
    {
        return $this->table;
    }

    public abstract function up(): void;

    public abstract function down(): void;
}

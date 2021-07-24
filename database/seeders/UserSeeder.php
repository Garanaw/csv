<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Cache\Repository as Cache;
use Illuminate\Config\Repository as Config;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Carbon;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Hashing\HashManager;

final class UserSeeder extends Seeder
{
    protected string $table = 'users';

    private Config $config;
    private HashManager $hasher;

    public function __construct(
        DatabaseManager $db,
        ConsoleOutput $output,
        Cache $cache,
        Config $config,
        HashManager $hasher
    ) {
        parent::__construct($db, $output, $cache);
        $this->config = $config;
        $this->hasher = $hasher;
    }

    public function run(): void
    {
        $this->db->table($this->getTable())->insert($this->getData());
    }

    protected function getData(): array
    {
        $now = Carbon::now()->toDateTimeString();

        return [
            [
                'name' => $this->config->get('security.main_user'),
                'email' => $this->config->get('security.admin_email'),
                'email_verified_at' => $now,
                'password' => $this->hasher->make(
                    $this->config->get('security.admin_password')
                ),
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];
    }
}

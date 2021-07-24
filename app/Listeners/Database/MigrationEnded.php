<?php declare(strict_types=1);

namespace App\Listeners\Database;

use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Database\Events\MigrationEnded as Event;
use App\Support\Database\Migration;

class MigrationEnded
{
    private ConsoleOutput $output;

    public function __construct(ConsoleOutput $output)
    {
        $this->output = $output;
    }

    public function handle(Event $event): void
    {
        if ($event->method !== 'up') {
            return;
        }

        /** @var Migration $migration */
        $migration = $event->migration;
        $name = $this->getMigrationName($migration);

        if ($migration->hasSeeders() === false) {
            $this->note("<info>Nothing to seed: </info>{$name}");
            return;
        }

        $this->seedMigration($migration, $name);
    }

    private function seedMigration(Migration $migration, string $name): void
    {
        $this->note(sprintf('<comment>Seeding:</comment> {%s}', $name));

        $startTime = microtime(true);

        foreach ($migration->getSeeders() as $seederClass) {
            $name = $this->getSeedername($seederClass);
            $seeder = app($seederClass);
            $this->note(sprintf('<info>Running seeder</info>: {%s}', $name));
            $seeder->run();
        }

        $runTime = round(microtime(true) - $startTime, 2);

        $this->note(
            sprintf('<info>Seeded: </info> %s (%d seconds)', $name, $runTime)
        );
    }

    private function note(string $message): void
    {
        if ($this->output) {
            $this->output->writeln($message);
        }
    }

    private function getMigrationName(Migration $path): string
    {
        return str_replace('.php', '', get_class($path));
    }

    private function getSeederName(string $path): string
    {
        $pieces = explode('/', $path);

        return end($pieces);
    }
}

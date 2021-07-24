<?php declare(strict_types=1);

use App\Support\Database\Migration;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    protected ?string $table = 'users';

    protected array $seeders = [
        UserSeeder::class,
    ];

    public function up(): void
    {
        $this->schema->create($this->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->schema->dropIfExists($this->getTable());
    }
}

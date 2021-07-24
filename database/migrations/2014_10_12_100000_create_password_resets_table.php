<?php declare(strict_types=1);

use App\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordResetsTable extends Migration
{
    protected ?string $table = 'password_resets';

    public function up(): void
    {
        $this->schema->create($this->getTable(), function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        $this->schema->dropIfExists($this->getTable());
    }
}

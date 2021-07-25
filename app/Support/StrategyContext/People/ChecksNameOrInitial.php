<?php declare(strict_types=1);

namespace App\Support\StrategyContext\People;

use Illuminate\Support\Str;

trait ChecksNameOrInitial
{
    protected function isInitial(string $nameOrInitial): bool
    {
        return Str::of($nameOrInitial)->length() === 1;
    }
}

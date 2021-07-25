<?php declare(strict_types=1);

namespace App\Support\StrategyContext\People;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

trait SanitizesStrings
{
    private function sanitize(string $line): Stringable
    {
        return Str::of($line)
            ->trim(' ')
            ->replace('.', '')
            ->replace("\r\n", '');
    }
}

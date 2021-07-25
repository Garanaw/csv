<?php declare(strict_types=1);

namespace App\Support\StrategyContext\People;

use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;

interface PeopleStrategy
{
    public function parse(Stringable $line): Collection;
}

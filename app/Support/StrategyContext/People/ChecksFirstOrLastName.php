<?php declare(strict_types=1);

namespace App\Support\StrategyContext\People;

use Illuminate\Support\Stringable;

trait ChecksFirstOrLastName
{
    private int $piecesForFullName = 3;

    protected function hasFirstName(Stringable $person): bool
    {
        return $person->explode(' ')->count() >= $this->piecesForFullName;
    }
}

<?php declare(strict_types=1);

namespace App\Support\StrategyContext;

use App\Support\StrategyContext\People\MixedStrategy;
use App\Support\StrategyContext\People\PeopleStrategy;
use App\Support\StrategyContext\People\SingleStrategy;
use Illuminate\Support\Manager;
use Illuminate\Support\Str;

final class PeopleParserStrategyContext extends Manager
{
    private const MIXED = ' and ';
    private const SINGLE = 'single';

    private string $line;

    public function driver($driver = null)
    {
        $this->line = $driver;

        $str = Str::of($driver)
            ->lower()
            ->replace('&', 'and');

        if ($str->contains(self::MIXED)) {
            return parent::driver(self::MIXED);
        }

        return parent::driver(self::SINGLE);
    }

    public function getDefaultDriver()
    {
        return 'single';
    }

    public function createSingleDriver(): PeopleStrategy
    {
        return new SingleStrategy();
    }

    public function createAndDriver(): PeopleStrategy
    {
        return new MixedStrategy();
    }
}

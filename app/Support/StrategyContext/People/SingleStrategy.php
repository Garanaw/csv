<?php declare(strict_types=1);

namespace App\Support\StrategyContext\People;

use App\Dto\Person;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;

final class SingleStrategy implements PeopleStrategy
{
    use ChecksFirstOrLastName;
    use ChecksNameOrInitial;
    use SanitizesStrings;

    public function parse(Stringable $line): Collection
    {
        $pieces = $this->sanitize((string)$line)->explode(' ')
            ->map(fn (string $piece) => $this->sanitize($piece)->__toString())
            ->filter(fn (string $piece) => $piece !== '');

        $firstNameOrInitial = $pieces->slice(1, 1)->first();
        $hasFirstName = $firstNameOrInitial && $this->hasFirstName($line);
        $isInitial = $firstNameOrInitial && $this->isInitial($firstNameOrInitial);

        if ($hasFirstName === false) {
            return new Collection([
                $this->makeWithoutName($pieces),
            ]);
        }

        if ($isInitial) {
            return new Collection([
                $this->makeWithInitial($pieces),
            ]);
        }

        return new Collection([
            $this->makeWithName($pieces),
        ]);
    }

    private function makeWithName(Collection $pieces): Person
    {
        [$title, $firstName, $lastName] = $this->getAllPieces($pieces);

        return Person::makeWithName($title, $firstName, $lastName);
    }

    private function makeWithInitial(Collection $pieces): Person
    {
        [$title, $firstName, $lastName] = $this->getAllPieces($pieces);

        return Person::makeWithInitial($title, $firstName, $lastName);
    }

    private function makeWithoutName(Collection $pieces): Person
    {
        $title = $pieces->first();
        $lastName = $pieces->last();

        return Person::makeWithoutName($title, $lastName);
    }

    private function getAllPieces(Collection $pieces): array
    {
        $pieces = $pieces->toArray();

        $title = array_shift($pieces);
        $firstName = array_shift($pieces);
        $lastName = array_shift($pieces);

        return [$title, $firstName, $lastName];
    }
}

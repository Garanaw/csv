<?php declare(strict_types=1);

namespace App\Support\StrategyContext\People;

use App\Dto\Person;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

final class MixedStrategy implements PeopleStrategy
{
    public function parse(Stringable $line): Collection
    {
        $people = $this->split($line);

        return $this->performParsing($people);
    }

    private function performParsing(Collection $people): Collection
    {
        $firstPersonStr = $people->first();
        $secondPersonStr = $people->last();

        $firstIsComplete = $this->isComplete($firstPersonStr);
        $secondIsComplete = $this->isComplete($secondPersonStr);

        if ($firstIsComplete && $secondIsComplete === false) {
            $secondPersonStr = $this->completeFrom($secondPersonStr, $firstPersonStr);
        }

        if ($secondIsComplete && $firstIsComplete === false) {
            $firstPersonStr = $this->completeFrom($firstPersonStr, $secondPersonStr);
        }

        return new Collection([
            $this->parseCompletePerson($firstPersonStr),
            $this->parseCompletePerson($secondPersonStr),
        ]);
    }

    private function completeFrom(string $incomplete, string $complete): string
    {
        $pieces = explode(' ', $complete);

        // Title is assumed
        $firstName = $pieces[1];
        $lastName = $pieces[2] ?? null;

        return trim(implode(' ', [
            $incomplete,
            $firstName,
            $lastName,
        ]), ' ');
    }

    private function parseCompletePerson(string $person): Person
    {
        return (new SingleStrategy())
            ->parse(Str::of($person))
            ->first();
    }

    private function split(Stringable $line): Collection
    {
        return $line->explode(
            $line->contains('&')
                ? ' & '
                : ' and '
        );
    }

    private function isComplete(string $person): bool
    {
        return Str::contains($person, ' ');
    }
}

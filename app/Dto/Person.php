<?php declare(strict_types=1);

namespace App\Dto;

use Illuminate\Contracts\Support\Arrayable;

final class Person implements Arrayable
{
    private string $title;
    private ?string $initial;
    private ?string $firstName;
    private string $lastName;

    public function __construct(string $title, ?string $initial, ?string $firstName, string $lastName)
    {
        $this->title = $title;
        $this->initial = $initial;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public static function makeWithName(string $title, string $firstName, string $lastName): self
    {
        return new self($title, null, $firstName, $lastName);
    }

    public static function makeWithInitial(string $title, string $initial, string $lastName): self
    {
        return new self($title, $initial, null, $lastName);
    }

    public static function makeWithoutName(string $title, string $lastName): self
    {
        return new self($title, null, null, $lastName);
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getInitial(): ?string
    {
        return $this->initial;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'first_name' => $this->getFirstName(),
            'initial' => $this->getInitial(),
            'last_name' => $this->getLastName(),
        ];
    }
}

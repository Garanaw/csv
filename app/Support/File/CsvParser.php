<?php declare(strict_types=1);

namespace App\Support\File;

use App\Support\StrategyContext\People\PeopleStrategy;
use App\Support\StrategyContext\People\SanitizesStrings;
use App\Support\StrategyContext\PeopleParserStrategyContext as Context;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

final class CsvParser implements DataParser
{
    use SanitizesStrings;

    private Collection $people;
    private Context $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
        $this->people = new Collection();
    }

    public function parse(UploadedFile $file): Collection
    {
        $content = explode(",\r" .PHP_EOL, $file->getContent());

        // The header is not needed anymore
        array_shift($content);

        foreach ($content as $line) {
            if (empty($line)) {
                continue;
            }

            $this->parseLine($line);
        }

        return $this->people;
    }

    private function parseLine(string $line): void
    {
        $line = $this->sanitize($line);

        /** @var PeopleStrategy $strategy */
        $strategy = $this->context->driver((string)$line);

        $this->people = $this->people->merge(
            $strategy->parse($line)
        );
    }
}

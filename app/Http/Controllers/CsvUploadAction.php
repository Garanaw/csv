<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\CsvUploadRequest as Request;
use App\Support\File\DataParser;

final class CsvUploadAction
{
    private DataParser $parser;

    public function __construct(DataParser $parser)
    {
        $this->parser = $parser;
    }

    public function __invoke(Request $request): array
    {
        $result = $this->parser->parse($request->file('csv_file'));

        return $result->toArray();
    }
}

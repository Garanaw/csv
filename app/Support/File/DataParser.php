<?php declare(strict_types=1);

namespace App\Support\File;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface DataParser
{
    public function parse(UploadedFile $file): Collection;
}

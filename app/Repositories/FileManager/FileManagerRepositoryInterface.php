<?php

namespace App\Repositories\FileManager;

use Illuminate\Support\Collection;

interface FileManagerRepositoryInterface
{
    public function all(): Collection;
}

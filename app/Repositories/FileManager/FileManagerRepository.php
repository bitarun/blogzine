<?php

namespace App\Repositories\FileManager;

use App\Models\FileManager;
use Illuminate\Support\Collection;

class FileManagerRepository implements FileManagerRepositoryInterface
{

    public function all(): Collection
    {
        return FileManager::all();
    }
}

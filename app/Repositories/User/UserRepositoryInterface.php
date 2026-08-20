<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function get(?string $searchKey, ?string $status, ?string $role): LengthAwarePaginator;

    public function create(array $data): void;

    public function update(User $user, array $data): void;

    public function destroy(User $user): void;
}

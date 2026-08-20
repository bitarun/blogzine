<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{
    public function get(?string $searchKey, ?string $status, ?string $role): LengthAwarePaginator
    {
        return User::query()->when($searchKey, fn($q) => $this->search($searchKey, $q))
            ->when($status, fn($q) => $this->getStatus($status, $q))
            ->when($role, fn($q) => $this->getRole($role, $q))
            ->paginate(30);
    }

    public function create(array $data): void
    {
        User::create($data);
    }

    public function update(User $user, array $data): void
    {
        $user->update($data);
    }

    public function destroy(User $user): void
    {
        $user->delete();
    }

    private function search(?string $searchKey, Builder $query): void
    {
        $searchKey = '%' . addcslashes($searchKey, '%_') . '%';

        $query->where(function (Builder $query) use ($searchKey) {
            $query->where('name', 'like', $searchKey)->orWhere('email', 'like', $searchKey);
        });
    }

    private function getStatus(?string $status, Builder $query): void
    {
        if (!$status) {
            return;
        }

        match ($status) {
            'active' => $query->whereNotNull('email_verified_at'),
            'inactive' => $query->whereNull('email_verified_at'),
            default => null,
        };
        /*if ($status == 'active') {
            $query->whereNotNull('email_verified_at');
        } elseif ($status == 'inactive') {
            $query->whereNull('email_verified_at');
        }*/
    }

    private function getRole(?string $role, Builder $query): void
    {
        $query->where('role', $role);
    }
}

<?php

namespace App\Services\Dashboard;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    protected UserRepositoryInterface $userRepository;
    protected StatisticsService $statisticsService;

    public function __construct(UserRepositoryInterface $userRepository, StatisticsService $statisticsService)
    {
        $this->userRepository = $userRepository;
        $this->statisticsService = $statisticsService;
    }

    public function get(?string $searchKey, ?string $status, ?string $role): array
    {
        $users = $this->userRepository->get($searchKey, $status, $role);
        $usersCount = $this->statisticsService->getCount()['users'];

        return [
            'users' => $users,
            'usersCount' => $usersCount,
        ];
    }

    public function create(array $data): void
    {
        $this->userRepository->create($data);
    }

    public function update(User $user, array $data): void
    {
        $this->userRepository->update($user, $data);
    }

    public function destroy(User $user): void
    {
        $this->userRepository->destroy($user);
    }
}

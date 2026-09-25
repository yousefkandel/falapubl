<?php

namespace App\Services\Admin\User;

use App\Contracts\User\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function index(): array
    {
        return [
            'users' => $this->userRepository->getAll(),
        ];
    }

    public function store(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->store($data);
    }

    public function update(User $user, array $data): User
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->userRepository->update($user, $data);
    }

    public function delete(User $user): bool
    {
        return $this->userRepository->delete($user);
    }

    public function filter(array $filters): LengthAwarePaginator
    {
        return $this->userRepository->filter($filters);
    }
}

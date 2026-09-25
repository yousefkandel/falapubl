<?php

namespace App\Contracts\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;

    public function store(array $data): User;

    public function update(User $user, array $data): User;

    public function delete(User $user): bool;

    public function filter(array $filters): LengthAwarePaginator;
}

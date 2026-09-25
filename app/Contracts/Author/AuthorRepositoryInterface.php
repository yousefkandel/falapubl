<?php

namespace App\Contracts\Author;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AuthorRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;

    public function store(array $data): Author;

    public function update(Author $author, array $data): Author;

    public function delete(Author $author): bool;

    public function filter(array $filters): LengthAwarePaginator;
}

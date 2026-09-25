<?php

namespace App\Contracts\Book;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;

    public function getAuthors(): Collection;

    public function getTranslators(): Collection;

    public function store(array $data): Book;

    public function update(Book $book, array $data): Book;

    public function delete(Book $book): bool;

    public function filter(array $filters): LengthAwarePaginator;
}

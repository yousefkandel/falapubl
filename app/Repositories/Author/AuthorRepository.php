<?php

namespace App\Repositories\Author;

use App\Contracts\Author\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Author::latest()->paginate(10);
    }

    public function store(array $data): Author
    {
        return Author::create($data);
    }

    public function update(Author $author, array $data): Author
    {
        $author->update($data);
        return $author;
    }

    public function delete(Author $author): bool
    {
        return $author->delete();
    }

    public function filter(array $filters): LengthAwarePaginator
    {
        return Author::withCount('books')
            ->when($filters['status'] ?? null, fn ($q, $status) => $q->status($status))
            ->when($filters['search'] ?? null, fn ($q, $search) => $q->search($search))
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }
}

<?php

namespace App\Repositories\Book;

use App\Contracts\Book\BookRepositoryInterface;
use App\Models\Author;
use App\Models\Book;
use App\Models\Translator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BookRepository implements BookRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Book::with(['author', 'translator'])
            ->latest()
            ->paginate(10);
    }

    public function getAuthors(): Collection
    {
        return Author::orderBy('name_ar')->get();
    }

    public function getTranslators(): Collection
    {
        return Translator::orderBy('name_ar')->get();
    }

    public function store(array $data): Book
    {
        return Book::create($data);
    }

    public function update(Book $book, array $data): Book
    {
        $book->update($data);

        return $book;
    }

    public function delete(Book $book): bool
    {
        return $book->delete();
    }

    public function filter(array $filters): LengthAwarePaginator
    {
        return Book::with(['author', 'translator'])
            ->when($filters['status'] ?? null, fn ($q, $status) => $q->status($status))
            ->when($filters['search'] ?? null, fn ($q, $search) => $q->search($search))
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }
}

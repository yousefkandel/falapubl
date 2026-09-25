<?php

namespace App\Services\Admin\Book;

use App\Contracts\Book\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class BookService
{
    public function __construct(
        private BookRepositoryInterface $bookRepository
    ) {
    }

    public function index(): array
    {
        return [
            'books' => $this->bookRepository->getAll(),
            'authors' => $this->bookRepository->getAuthors(),
            'translators' => $this->bookRepository->getTranslators(),
        ];
    }

public function store(array $data): Book
{
    if (isset($data['image_ar'])) {
        $data['image_ar'] = $data['image_ar']->store('books/ar', 'public');
    }

    if (isset($data['image_en'])) {
        $data['image_en'] = $data['image_en']->store('books/en', 'public');
    }

    $book = $this->bookRepository->store($data);

    return $book->load(['author', 'translator']);
}
public function update(Book $book, array $data): Book
{
    if (isset($data['image_ar'])) {

        if ($book->image_ar) {
            Storage::disk('public')->delete($book->image_ar);
        }

        $data['image_ar'] = $data['image_ar']->store('books/ar', 'public');
    }

    if (isset($data['image_en'])) {

        if ($book->image_en) {
            Storage::disk('public')->delete($book->image_en);
        }

        $data['image_en'] = $data['image_en']->store('books/en', 'public');
    }

    $book = $this->bookRepository->update($book, $data);

    return $book->load(['author', 'translator']);
}

    public function destroy(Book $book): bool
    {
        return $this->bookRepository->delete($book);
    }

    public function filter(array $filters): LengthAwarePaginator
    {
        return $this->bookRepository->filter($filters);
    }
}

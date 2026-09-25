<?php

namespace App\Services\Admin\Author;

use App\Contracts\Author\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class AuthorService
{
    public function __construct(
        private AuthorRepositoryInterface $authorRepository
    ) {
    }

    public function index(): array
    {
        return [
            'authors' => $this->authorRepository->getAll(),
        ];
    }

    public function store(array $data): Author
    {
        // معالجة الصورة
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $data['image']->store('authors', 'public');
        }

        return $this->authorRepository->store($data);
    }

    public function update(Author $author, array $data): Author
    {
        // معالجة الصورة
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            // حذف الصورة القديمة
            if ($author->image) {
                Storage::disk('public')->delete($author->image);
            }
            $data['image'] = $data['image']->store('authors', 'public');
        } else {
            // الاحتفاظ بالصورة القديمة
            $data['image'] = $author->image;
        }

        return $this->authorRepository->update($author, $data);
    }

    public function delete(Author $author): bool
    {
        // حذف الصورة
        if ($author->image) {
            Storage::disk('public')->delete($author->image);
        }

        return $this->authorRepository->delete($author);
    }

    public function filter(array $filters): LengthAwarePaginator
    {
        return $this->authorRepository->filter($filters);
    }
}

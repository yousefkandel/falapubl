<?php

namespace App\Repositories\Translator;

use App\Contracts\Translator\TranslatorRepositoryInterface;
use App\Models\Translator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TranslatorRepository implements TranslatorRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Translator::latest()->paginate(10);
    }

    public function store(array $data): Translator
    {
        return Translator::create($data);
    }

    public function update(Translator $translator, array $data): Translator
    {
        $translator->update($data);
        return $translator;
    }

    public function delete(Translator $translator): bool
    {
        return $translator->delete();
    }

    public function filter(array $filters): LengthAwarePaginator
    {
        return Translator::withCount('books')
            ->when($filters['status'] ?? null, fn ($q, $status) => $q->status($status))
            ->when($filters['search'] ?? null, fn ($q, $search) => $q->search($search))
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }
}

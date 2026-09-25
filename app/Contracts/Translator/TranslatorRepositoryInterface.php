<?php

namespace App\Contracts\Translator;

use App\Models\Translator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TranslatorRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;

    public function store(array $data): Translator;

    public function update(Translator $translator, array $data): Translator;

    public function delete(Translator $translator): bool;

    public function filter(array $filters): LengthAwarePaginator;
}

<?php

namespace App\Services\Admin\Translator;

use App\Contracts\Translator\TranslatorRepositoryInterface;
use App\Models\Translator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class TranslatorService
{
    public function __construct(
        private TranslatorRepositoryInterface $translatorRepository
    ) {
    }

    public function index(): array
    {
        return [
            'translators' => $this->translatorRepository->getAll(),
        ];
    }

    public function store(array $data): Translator
    {
        // معالجة الصورة
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $data['image']->store('translators', 'public');
        }

        return $this->translatorRepository->store($data);
    }

    public function update(Translator $translator, array $data): Translator
    {
        // معالجة الصورة
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            // حذف الصورة القديمة
            if ($translator->image) {
                Storage::disk('public')->delete($translator->image);
            }
            $data['image'] = $data['image']->store('translators', 'public');
        } else {
            // الاحتفاظ بالصورة القديمة
            $data['image'] = $translator->image;
        }

        return $this->translatorRepository->update($translator, $data);
    }

    public function delete(Translator $translator): bool
    {
        // حذف الصورة
        if ($translator->image) {
            Storage::disk('public')->delete($translator->image);
        }

        return $this->translatorRepository->delete($translator);
    }

    public function filter(array $filters): LengthAwarePaginator
    {
        return $this->translatorRepository->filter($filters);
    }
}

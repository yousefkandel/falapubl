<?php

namespace App\Http\Requests\Admin\Translator;

use Illuminate\Foundation\Http\FormRequest;

class TranslatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'bio_ar' => ['nullable', 'string'],
            'bio_en' => ['nullable', 'string'],
            'image' => $isUpdate
                ? ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048']
                : ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name_ar.required' => 'الاسم بالعربية مطلوب.',
            'name_en.required' => 'الاسم بالإنجليزية مطلوب.',
            'name_ar.string' => 'الاسم بالعربية يجب أن يكون نصاً.',
            'name_en.string' => 'الاسم بالإنجليزية يجب أن يكون نصاً.',
            'name_ar.max' => 'الاسم بالعربية لا يزيد عن 255 حرف.',
            'name_en.max' => 'الاسم بالإنجليزية لا يزيد عن 255 حرف.',
            'image.image' => 'الملف يجب أن يكون صورة.',
            'image.mimes' => 'صيغة الصورة غير مدعومة. الصيغ المدعومة: jpg, jpeg, png, webp',
            'image.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            'status.required' => 'حالة المترجم مطلوبة.',
            'status.boolean' => 'قيمة الحالة غير صحيحة.',
        ];
    }
}

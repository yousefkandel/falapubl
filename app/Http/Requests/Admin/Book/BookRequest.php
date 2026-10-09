<?php

namespace App\Http\Requests\Admin\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],

            'category_ar' => ['required', 'string', 'max:255'],
            'category_en' => ['required', 'string', 'max:255'],

            'author_id' => ['required', 'exists:authors,id'],
            'translator_id' => ['nullable', 'exists:translators,id'],

            'publication_year' => ['required', 'digits:4'],
            'pages_count' => ['required', 'integer', 'min:1'],
            'english_publication_year' => ['nullable', 'digits:4'],
            'english_pages' => ['nullable', 'integer', 'min:1'],

            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],

            'image_ar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_en' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'status' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title_ar.required' => 'عنوان الكتاب بالعربية مطلوب.',
            'title_en.required' => 'عنوان الكتاب بالإنجليزية مطلوب.',

            'category_ar.required' => 'التصنيف بالعربية مطلوب.',
            'category_en.required' => 'التصنيف بالإنجليزية مطلوب.',

            'author_id.required' => 'يرجى اختيار المؤلف.',
            'author_id.exists' => 'المؤلف المحدد غير موجود.',

            'translator_id.exists' => 'المترجم المحدد غير موجود.',

            'publication_year.required' => 'سنة النشر مطلوبة.',
            'publication_year.digits' => 'سنة النشر يجب أن تكون 4 أرقام.',

            'pages_count.required' => 'عدد الصفحات مطلوب.',
            'pages_count.integer' => 'عدد الصفحات يجب أن يكون رقمًا.',
            'pages_count.min' => 'عدد الصفحات يجب أن يكون أكبر من صفر.',

            'image_ar.required' => 'صورة الغلاف العربية مطلوبة.',
            'image_ar.image' => 'الملف يجب أن يكون صورة.',

            'image_en.required' => 'صورة الغلاف الإنجليزية مطلوبة.',
            'image_en.image' => 'الملف يجب أن يكون صورة.',

            'status.required' => 'حالة الكتاب مطلوبة.',
            'status.boolean' => 'قيمة الحالة غير صحيحة.',
        ];
    }
}

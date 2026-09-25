<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $about = Page::firstOrCreate(
            ['slug' => 'about'],
            [
                'title_ar' => 'من نحن',
                'title_en' => 'About Us',
                'content_ar' => "دار فلك للنشر والترجمة — نسير في فلك الكتب، حيث لا نهاية للشغف.\n\nنصدر ونترجم الكتب بين العربية والإنجليزية، لنقرّب العوالم ونفتح أبواب المعرفة أمام كل قارئ.",
                'content_en' => "Falak Publishing & Translation — we orbit books, where passion has no end.\n\nWe publish and translate books between Arabic and English, bridging worlds and opening knowledge to every reader.",
                'status' => true,
            ]
        );

        $contact = Page::firstOrCreate(
            ['slug' => 'contact'],
            [
                'title_ar' => 'تواصل معنا',
                'title_en' => 'Contact Us',
                'content_ar' => 'يسعدنا تواصلكم معنا لأي استفسار حول إصداراتنا أو فرص التعاون.',
                'content_en' => 'We are happy to hear from you regarding our publications or collaboration opportunities.',
                'email' => 'info@falak.ae',
                'phone' => '+971 00 000 0000',
                'address_ar' => 'دبي، الإمارات العربية المتحدة',
                'address_en' => 'Dubai, United Arab Emirates',
                'status' => true,
            ]
        );

        return view('admin.content.index', compact('about', 'contact'));
    }

    public function update(Request $request, Page $page)
    {
        $rules = [
            'title_ar'   => 'required|string|max:255',
            'title_en'   => 'nullable|string|max:255',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'status'     => 'required|boolean',
        ];

        if ($page->slug === 'contact') {
            $rules = array_merge($rules, [
                'email'      => 'nullable|email|max:180',
                'phone'      => 'nullable|string|max:50',
                'address_ar' => 'nullable|string|max:255',
                'address_en' => 'nullable|string|max:255',
            ]);
        }

        $data = $request->validate($rules, [
            'title_ar.required' => 'العنوان بالعربية مطلوب.',
            'email.email'       => 'صيغة البريد غير صحيحة.',
        ]);

        $page->update($data);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم حفظ المحتوى بنجاح.',
            ]);
        }

        return redirect()
            ->route('admin.content.index')
            ->with('success', 'تم حفظ المحتوى بنجاح.');
    }
}

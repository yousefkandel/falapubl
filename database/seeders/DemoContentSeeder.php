<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Translator;
use Illuminate\Database\Seeder;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $author1 = Author::firstOrCreate(
            ['name_en' => 'Layla Marzouk'],
            [
                'name_ar' => 'ليلى مرزوق',
                'bio_ar' => 'كاتبة وروائية عربية، صدر لها العديد من الأعمال الأدبية.',
                'bio_en' => 'An Arab novelist with several published literary works.',
                'status' => true,
            ]
        );

        $author2 = Author::firstOrCreate(
            ['name_en' => 'Ahmad Rashed'],
            [
                'name_ar' => 'أحمد راشد',
                'bio_ar' => 'كاتب مهتم بأدب الخيال والمدن الساحلية.',
                'bio_en' => 'A writer focused on fiction and coastal cities.',
                'status' => true,
            ]
        );

        $translator1 = Translator::firstOrCreate(
            ['name_en' => 'Omar Nabil'],
            [
                'name_ar' => 'عمر نبيل',
                'bio_ar' => 'مترجم أدبي متخصص في الترجمة بين العربية والإنجليزية.',
                'bio_en' => 'A literary translator specializing in Arabic-English translation.',
                'status' => true,
            ]
        );

        Book::firstOrCreate(
            ['title_en' => 'Days at the Torunka Café'],
            [
                'title_ar' => 'أيام في مقهى تورونكا',
                'category_ar' => 'أدب روائي',
                'category_en' => 'Literary Fiction',
                'author_id' => $author1->id,
                'translator_id' => $translator1->id,
                'publication_year' => 2024,
                'pages_count' => 312,
                'description_ar' => 'في زقاق هادئ من طوكيو، يقف هذا المقهى الصغير كملاذ لمن أثقلتهم الأيام. هنا تتقاطع مصائر غرباء يحمل كل منهم قصة لم تُروَ بعد: قلب مكسور، وداع لم يكتمل، أو حلم يرفض أن يموت.',
                'description_en' => "From the internationally bestselling author of the Morisaki Bookshop novels comes a charming and poignant story about a small café where strangers' broken lives quietly begin to mend.",
                'status' => true,
            ]
        );

        Book::firstOrCreate(
            ['title_en' => 'The Quiet Comet'],
            [
                'title_ar' => 'المذنّب الهادئ',
                'category_ar' => 'خيال',
                'category_en' => 'Fiction',
                'author_id' => $author2->id,
                'translator_id' => null,
                'publication_year' => 2025,
                'pages_count' => 280,
                'description_ar' => 'رواية قادمة عن مدينة ساحلية ينتظر أهلها مذنبًا لا يأتي أبدًا.',
                'description_en' => 'A forthcoming novel about a coastal city awaiting a comet that never arrives.',
                'status' => true,
            ]
        );

        \App\Models\Page::firstOrCreate(
            ['slug' => 'about'],
            [
                'title_ar' => 'من نحن',
                'title_en' => 'About Us',
                'content_ar' => "دار فلك للنشر والترجمة — نسير في فلك الكتب، حيث لا نهاية للشغف.\n\nنصدر ونترجم الكتب بين العربية والإنجليزية، لنقرّب العوالم ونفتح أبواب المعرفة أمام كل قارئ.",
                'content_en' => "Falak Publishing & Translation — we orbit books, where passion has no end.",
                'status' => true,
            ]
        );

        \App\Models\Page::firstOrCreate(
            ['slug' => 'contact'],
            [
                'title_ar' => 'تواصل معنا',
                'title_en' => 'Contact Us',
                'content_ar' => 'يسعدنا تواصلكم معنا لأي استفسار حول إصداراتنا أو فرص التعاون.',
                'content_en' => 'We are happy to hear from you.',
                'email' => 'info@falak.ae',
                'phone' => '+971 00 000 0000',
                'address_ar' => 'دبي، الإمارات العربية المتحدة',
                'address_en' => 'Dubai, United Arab Emirates',
                'status' => true,
            ]
        );

    }
}

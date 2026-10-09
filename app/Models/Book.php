<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

protected $fillable = [
    'title_ar',
    'title_en',

    'category_ar',
    'category_en',

    'author_id',
    'translator_id',

    'publication_year',
    'pages_count',
    'english_publication_year',
    'english_pages',

    'description_ar',
    'description_en',

    'image_ar',
    'image_en',

    'status',
];

 protected $casts = [
    'publication_year' => 'integer',
    'pages_count' => 'integer',
    'english_publication_year' => 'integer',
    'english_pages' => 'integer',
    'status' => 'boolean',
];


    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function translator()
    {
        return $this->belongsTo(Translator::class);
    }

    /** فلترة حسب الحالة */
    public function scopeStatus($query, ?string $status)
    {
        return $status ? $query->where('status', $status) : $query;
    }

    /** فلترة حسب القسم */


    /** بحث بالعنوان */
   public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;

        return $query->where(function($q) use ($term) {
            $q->where('title_ar', 'like', "%{$term}%")
              ->orWhere('title_en', 'like', "%{$term}%");
        });
    }
}

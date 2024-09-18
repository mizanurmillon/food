<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Blogcategory;

class Blog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'title',
        'title_slug',
        'image',
        'description',
        'created_date',
        'created_month',
        'user_id',
    ];
    public function blogcategory()
    {
        return $this->belongsTo(Blogcategory::class, 'category_id');
    }
}

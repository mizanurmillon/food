<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\User;

class Food extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id','subcategory_id','user_id','food_name','slug','tags','price','discount_price','image','description','date','month','year','status',
    ];
    protected $table='foods';
    //join with category table
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    //join with subcategory table
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
    //join with user table
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

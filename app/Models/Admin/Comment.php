<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Food;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'food_id',
        'comment',
        'rating',
        'comment_date',
        'comment_month',
        'comment_year',
    ];

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

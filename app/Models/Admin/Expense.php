<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Expensetype;


class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'expenstype_id',
        'user',
        'amount',
        'details',
        'month',
        'date',
        'year',
    ];
    public function expensetype()
    {
        return $this->belongsTo(Expensetype::class, 'expenstype_id');
    }
}

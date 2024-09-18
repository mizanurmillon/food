<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Employee;

class Award extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'award_name',
        'award',
        'details',
        'award_date',
        'award_month',
        'award_year',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}

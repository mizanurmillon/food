<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Department;
use App\Models\Admin\Designation;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'designation_id',
        'department_id',
        'name',
        'phone',
        'address',
        'gender',
        'blood',
        'nid',
        'joining_date',
        'salary',
        'status',
        'image',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}

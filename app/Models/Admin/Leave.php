<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Employee;
use App\Models\Admin\Leavetype;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id','leavetype_id','start_date','end_date','leave_day','date','month','year','status',
        
    ];
    //join with employee table
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    //join with employee table
    public function leavetype()
    {
        return $this->belongsTo(Leavetype::class, 'leavetype_id');
    }
}

<?php

namespace App\Http\Controllers\Admin\Hrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Employee;
use App\Models\Admin\Award;
use DataTables;

class AwardController extends Controller
{
    //constructor for checking admin authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data=Award::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name',function($row){
                    return $row->employee->name.'-'.$row->employee->employee_id;
                })
                ->addColumn('action',function($row){
                    $actionBtn='<a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('award.delete',[$row->id]).'" class="m-1" id="award_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','name'])
                ->make(true); 
        }
        $employee=Employee::all();
       return view('admin.hrm.employee.award.index',compact('employee'));
    }

    //store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'award_name' => 'required',
        ]);

        $data=array();
        $data['employee_id']=$request->employee_id;
        $data['award_name']=$request->award_name;
        $data['award']=$request->award;
        $data['award_date']=$request->award_date;
        $data['award_month']=$request->award_month;
        $data['award_year']=$request->award_year;
        $data['details']=$request->details;

        DB::table('awards')->insert($data);
        return response()->json('successful inserted!');
    }

    //edit method
    public function edit($id)
    {
        $data=DB::table('awards')->where('id',$id)->first();
        $employee=Employee::all();
        return view('admin.hrm.employee.award.edit',compact('data','employee'));    
    }

    //update method
    public function update(Request $request)
    {
        $data=array();
        $data['employee_id']=$request->employee_id;
        $data['award_name']=$request->award_name;
        $data['award']=$request->award;
        $data['award_date']=$request->award_date;
        $data['award_month']=$request->award_month;
        $data['award_year']=$request->award_year;
        $data['details']=$request->details;

        DB::table('awards')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }

    //delete method
    public function destroy($id)
    {
       DB::table('awards')->where('id',$id)->delete();
       return response()->json('successful deleted!');
    }
    
}

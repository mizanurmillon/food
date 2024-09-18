<?php

namespace App\Http\Controllers\Admin\Hrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Leavetype;
use App\Models\Admin\Leave;
use App\Models\Admin\Employee;
use DataTables;

class LeaveController extends Controller
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
            $data=Leavetype::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('leavetype.delete',[$row->id]).'" class="m-1" id="leavetype_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
       return view('admin.hrm.leavetype.index');
    }

    //store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_name' => 'required',
            'leave_day' => 'required',
        ]);
        
        $data=array();
        $data['type_name']=$request->type_name;
        $data['leave_day']=$request->leave_day;
        DB::table('leavetypes')->insert($data);
        return response()->json('successful inserted!');
    }

    //edit method
    public function edit($id)
    {
       $data=DB::table('leavetypes')->where('id',$id)->first();
       return view('admin.hrm.leavetype.edit',compact('data'));
    }

    //update method
    public function update(Request $request)
    {
        $data=array();
        $data['type_name']=$request->type_name;
        $data['leave_day']=$request->leave_day;
        DB::table('leavetypes')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }

    //delete method
    public function destroy($id)
    {
       DB::table('leavetypes')->where('id',$id)->delete();
       return response()->json('successful deleted!');
    }

    //leave application all method
       //Index method for leave application
    public function leaveIndex(Request $request)
    {
       if ($request->ajax()) {
            $data=Leave::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name',function($row){
                    return $row->employee->name.'-'.$row->employee->employee_id;
                })
                ->editColumn('type_name',function($row){
                    return $row->leavetype->type_name;
                })
                ->editColumn('status',function($row){
                   if ($row->status==1) {
                       return '<span class="badge badge-success">Approved</span>';
                    }else if($row->status==3){
                        return '<span class="badge badge-danger">Declined</span>';
                    }else{
                        return '<span class="badge badge-warning">Pending</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('leave.delete',[$row->id]).'" class="m-1" id="leave_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','name','type_name','status'])
                ->make(true); 
        }
        $leavetype=Leavetype::all();
        $employee=Employee::all();
       return view('admin.hrm.leave.index',compact('leavetype','employee'));
    }
    
    //store method for leave application
    public function leaveStore(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'leavetype_id' => 'required',
        ]);
        
        $data=array();
        $data['employee_id']=$request->employee_id;
        $data['leavetype_id']=$request->leavetype_id;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['leave_day']=$request->leave_day;
        $data['status']=$request->status;
        $data['date']=date('d-m-Y');
        $data['month']=date('F');
        $data['year']=date('Y');

        DB::table('leaves')->insert($data);
        return response()->json('successful inserted!');
    }

    //edit method for leave application
    public function leaveEdit($id)
    {
        $data=DB::table('leaves')->where('id',$id)->first();
        $leavetype=Leavetype::all();
        $employee=Employee::all();
        return view('admin.hrm.leave.edit',compact('data','leavetype','employee'));
    }

    //update method for leave application
    public function LeaveUpdate(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'leavetype_id' => 'required',
        ]);
        
        $data=array();
        $data['employee_id']=$request->employee_id;
        $data['leavetype_id']=$request->leavetype_id;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['leave_day']=$request->leave_day;
        $data['status']=$request->status;
        $data['date']=date('d-m-Y');
        $data['month']=date('F');
        $data['year']=date('Y');

        DB::table('leaves')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }

    //delete method for leave application
    public function leaveDestroy($id)
    {
        DB::table('leaves')->where('id',$id)->delete();
        return response()->json('successful deleted!');
    }
}

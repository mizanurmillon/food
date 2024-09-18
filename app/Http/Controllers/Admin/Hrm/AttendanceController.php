<?php

namespace App\Http\Controllers\Admin\Hrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Employee;
use App\Models\Admin\Attendance;
use DataTables;

 class AttendanceController extends Controller
{
       //constructor for checking admin authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Index method
    public function Index(Request $request)
    {
        $employee=Employee::all();
        return view('admin.hrm.attendance.single_attendance',compact('employee'));
    }

    //row create method
    public function CreateRow($user_id)
    {
       $attendance=DB::table('attendances')
                    ->leftjoin('employees','attendances.employee_id','employees.id')
                    ->whereDate('attendances.date',date('d-m-Y'))
                    ->where('attendances.employee_id',$user_id)
                    ->select(
                        'attendances.*',
                        'employees.id as emp_id',
                        'employees.name',
                        'employees.employee_id'
                    )
                    ->orderBy('attendances.id','desc')
                    ->first();
        $employee=DB::table('employees')->where('id',$user_id)->first();
        return view('admin.hrm.attendance.partial.row_create',compact('attendance','employee'));

    }

    //personwise attendance store method
    public function personwise(Request $request)
    {
        if ($request->user_ids==null) {
            return response()->json(['errorMsg'=>'Select employee first for attendance.']);
        }
        foreach($request->user_ids as $key => $user_id)
        {
            $updateAttendance=Attendance::whereDate('date', date('d-m-Y'))
                    ->where('employee_id', $user_id)->first();
            if ($updateAttendance) {
                $updateAttendance->clock_out = $request->clock_outs[$key];
                if ($request->clock_outs[$key]) {
                   $updateAttendance->status = "Present";
                }
                $updateAttendance->clock_in_note = $request->clock_in_notes[$key];
                $updateAttendance->clock_out_note = $request->clock_out_notes[$key];
                $updateAttendance->save();
            }else{
                $data = new Attendance();
                $data->employee_id = $user_id;
                $data->date = date('d-m-Y');
                $data->clock_in = $request->clock_ins[$key];
                $data->clock_out = $request->clock_outs[$key];
                if ($request->clock_outs[$key]) {
                   $data->status = "Present";
                }
                $data->clock_in_note = $request->clock_in_notes[$key];
                $data->clock_out_note = $request->clock_out_notes[$key];
                $data->month = date('F');
                $data->year = date('Y');
                $data->save();
            }
        }
        return response()->json('Successful Attendances Taken!');
    }

    //all attendance method
    public function allAttendance(Request $request)
    {
        if ($request->ajax()) {

            $data="";
               $query=DB::table('attendances')->leftjoin('employees','attendances.employee_id','employees.id');
               if ($request->date) {
                    $request_date=date('d-m-Y',strtotime($request->date));
                    $query->where('attendances.date',$request_date);
               }
               if ($request->month) {
                   $query->where('attendances.month',$request->month);
               }
               if ($request->employee_id) {
                   $query->where('attendances.employee_id',$request->employee_id);
               }
            $data=$query->select( 'attendances.*','employees.id as emp_id','employees.name',
                'employees.employee_id')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name',function($row){
                    return $row->name.'-'.$row->employee_id;
                })
                ->editColumn('status',function($row){
                   if ($row->status=='Present') {
                       return '<span class="badge badge-success">Present</span>';
                   }else{
                        return '<span class="badge badge-danger">Missing</span>';
                   }
                })
                ->addColumn('action',function($row){
                    $actionBtn='<a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('attendance.delete',[$row->id]).'" class="m-1" id="attendance_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','name','status'])
                ->make(true); 
        }
        $employee=Employee::all();
       return view('admin.hrm.attendance.all_attendance',compact('employee'));
    }

    //Missing attendance method
    public function missingStore(Request $request)
    {
        $request_date=date('d-m-Y',strtotime($request->date));
        $check=DB::table('attendances')->where('employee_id',$request->employee_id)->where('date',$request_date)->first();
        if ($check) {
            return response()->json(['errorMsg'=>'Allready Attendance Exist With This Date!.']);
        }else{
            $data=array();
            $data['employee_id']=$request->employee_id;
            $data['date']=$request_date;
            $data['clock_in']=$request->clock_in;
            $data['clock_out']=$request->clock_out;
            $data['clock_in_note']=$request->clock_in_note;
            $data['clock_out_note']=$request->clock_out_note;
            $data['month']=date('F');
            $data['year']=date('Y');
            $data['status']="Present";

            DB::table('attendances')->insert($data);
            return response()->json('Successful Attendances Taken!');
        }
    }

    //Attendance Edit Method 
    public function AttendanceEdit($id)
    {
        $data=DB::table('attendances')->where('id',$id)->first();
        $employee=Employee::all();
        return view('admin.hrm.attendance.partial.edit_attendance',compact('data','employee'));
    }

    //Attendance update method
    public function AttendanceUpdate(Request $request)
    {
        $data=array();
        $data['employee_id']=$request->employee_id;
        $data['clock_in']=$request->clock_in;
        $data['clock_out']=$request->clock_out;
        $data['clock_in_note']=$request->clock_in_note;
        $data['clock_out_note']=$request->clock_out_note;
        $data['month']=date('F');
        $data['year']=date('Y');
        $data['status']="Present";

        DB::table('attendances')->where('id',$request->id)->update($data);
        return response()->json('Successful Attendances Updated!');
    }

    //Attendance Delete method
    public function AttendanceDestroy($id)
    {
        DB::table('attendances')->where('id',$id)->delete();
        return response()->json('successful deleted!');
    }

    //Attendance Adjustment page
    public function Adjustment()
    {
        $employee=Employee::all();
        return view('admin.hrm.attendance.adjustment_attendance_form',compact('employee'));
    }

    // Attendance Adjustment Form method
    public function AdjustmentForm(Request $request)
    {
        $attendance=DB::table('attendances')->where('month',$request->month)->where('year',$request->year)->where('employee_id',$request->employee_id)->orderBy('date','ASC')->get();
        $user=DB::table('employees')->where('id',$request->employee_id)->first();
        $employee=DB::table('employees')->get();
        return view('admin.hrm.attendance.adjustment_attendance',compact('attendance','employee','user'));
    }
    
    // Clock In Update Method
    public function clockInChange($id,$date,$clock_in){
        DB::table('attendances')->where('employee_id',$id)->where('date',$date)->update(['clock_in' =>$clock_in]);
        return response()->json('Successful updated!');
    }

    // clock out update method
    public function clockOutChange($id,$date,$clock_out){
        DB::table('attendances')->where('employee_id',$id)->where('date',$date)->update(['clock_in' =>$clock_out]);
        return response()->json('Successful updated!');
    }
    
}
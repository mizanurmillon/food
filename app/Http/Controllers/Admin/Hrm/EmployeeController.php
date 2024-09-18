<?php

namespace App\Http\Controllers\Admin\Hrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Designation;
use App\Models\Admin\Department;
use App\Models\Admin\Employee;
use DataTables;
use Image;

class EmployeeController extends Controller
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
            $data=Employee::all();
            $imgurl=asset('public/files/employee/');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('department_name',function($row){
                    return $row->department->department_name;
                })
                ->editColumn('designation_name',function($row){
                    return $row->designation->designation_name;
                })
                ->editColumn('image', function($row) use($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->image.'" height="30" width="30" />';
                })
                ->editColumn('status',function($row){
                   if ($row->status==1) {
                       return '<span class="badge badge-success">Active</span>';
                   }else{
                        return '<span class="badge badge-danger">Unactive</span>';
                   }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('employee.delete',[$row->id]).'" class="m-1" id="employee_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','image','department_name','designation_name','status'])
                ->make(true); 
        }
        $department=Department::all();
        $designation=Designation::all();
       return view('admin.hrm.employee.employee.index',compact('department','designation'));
    }
    //store method 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]);

        $data=array();
        $data['employee_id']=$request->employee_id;
        $data['name']=$request->name;
        $data['department_id']=$request->department_id;
        $data['designation_id']=$request->designation_id;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['gender']=$request->gender;
        $data['blood']=$request->blood;
        $data['nid']=$request->nid;
        $data['joining_date']=$request->joining_date;
        $data['salary']=$request->salary;
        $data['status']=$request->status;

        $image=$request->image;
        $imagename=uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(200,200)->save('public/files/employee/'. $imagename);
        $data['image']=$imagename;

        DB::table('employees')->insert($data);
        return response()->json('successful inserted!');
    }
    //delete method
    public function destroy($id)
    {
        DB::table('employees')->where('id',$id)->delete();
        return response()->json('successful deleted!');
    }
    //edit method
    public function edit($id)
    {
        $data=DB::table('employees')->where('id',$id)->first();
        $department=Department::all();
        $designation=Designation::all();
        return view('admin.hrm.employee.employee.edit',compact('data','department','designation'));
    }
    //update method
    public function update(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]);
        
        $data=array();
        $data['employee_id']=$request->employee_id;
        $data['name']=$request->name;
        $data['department_id']=$request->department_id;
        $data['designation_id']=$request->designation_id;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['gender']=$request->gender;
        $data['blood']=$request->blood;
        $data['nid']=$request->nid;
        $data['joining_date']=$request->joining_date;
        $data['salary']=$request->salary;
        $data['status']=$request->status;

        if ($request->image) {
            $image=$request->image;
            $imagename=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('public/files/employee/'. $imagename);
            $data['image']=$imagename;
        }else{
            $data['image']=$request->old_image;
        }

        DB::table('employees')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }

    
}

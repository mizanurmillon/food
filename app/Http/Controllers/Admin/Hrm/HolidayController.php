<?php

namespace App\Http\Controllers\Admin\Hrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class HolidayController extends Controller
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
            $data=DB::table('holidays')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('holiday.delete',[$row->id]).'" class="m-1" id="holiday_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
       return view('admin.hrm.holiday.index');
    }
    //store method 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'name' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        $data=array();
        $data['type']=$request->type;
        $data['name']=$request->name;
        $data['from']=$request->from;
        $data['to']=$request->to;
        $data['num_of_days']=$request->num_of_days;
        $data['month']=date('F');
        $data['year']=date('Y');

        DB::table('holidays')->insert($data);
        return response()->json('successful inserted!');
    }

    //edit method
    public function edit($id)
    {
        $data=DB::table('holidays')->where('id',$id)->first();
        return view('admin.hrm.holiday.edit',compact('data'));
    }

    //update method
    public function update(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'name' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        $data=array();
        $data['type']=$request->type;
        $data['name']=$request->name;
        $data['from']=$request->from;
        $data['to']=$request->to;
        $data['num_of_days']=$request->num_of_days;

        DB::table('holidays')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }

    //delete method
    public function destroy($id)
    {
        DB::table('holidays')->where('id',$id)->delete();
        return response()->json('successful deleted!');
    }

}

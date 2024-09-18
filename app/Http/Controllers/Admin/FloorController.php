<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Floor;
use DataTables;

class FloorController extends Controller
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
            $data=Floor::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('floor.delete',[$row->id]).'" class="m-1" id="floor_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
       return view('admin.setup.floor.index');
    }
    //store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'floor_name' => 'required|unique:floors|max:255',
        ]);
        $data=array();
        $data['floor_name']=$request->floor_name;
        DB::table('floors')->insert($data);
        return response()->json('successful inserted!');
    }
    //Edit method
    public function edit($id)
    {
        $data=DB::table('floors')->where('id',$id)->first();
        return view('admin.setup.floor.edit',compact('data'));
    }
    //update method
    public function update(Request $request)
    {
        $data=array();
        $data['floor_name']=$request->floor_name;
        DB::table('floors')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }
    //delete method
    public function destroy($id)
    {
        DB::table('floors')->where('id',$id)->delete();
        return response()->json('successful deleted!');
    }
}

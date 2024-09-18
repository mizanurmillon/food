<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Expensetype;
use DataTables;

class ExpensetypeController extends Controller
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
            $data=Expensetype::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('expensetype.delete',[$row->id]).'" class="m-1" id="expensetype_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
       return view('admin.expense.expensetype.index');
    }
    //store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_name' => 'required|unique:expenstypes|max:255',
        ]);
        $data=array();
        $data['type_name']=$request->type_name;
        DB::table('expenstypes')->insert($data);
        return response()->json('successful inserted!');
    }
    //edit method
    public function edit($id)
    {
        $data=DB::table('expenstypes')->where('id',$id)->first();
        return view('admin.expense.expensetype.edit',compact('data'));
    }
    //update method
    public function update(Request $request)
    {
        $data=array();
        $data['type_name']=$request->type_name;
        DB::table('expenstypes')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }
    //delete method
    public function destroy($id)
    {
        DB::table('expenstypes')->where('id',$id)->delete();
        return response()->json('successful deleted!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Floor;
use App\Models\Admin\Table;
use DataTables;
use DB;

class TableController extends Controller {
    //constructor for checking admin authentication
    public function __construct() {
        $this->middleware('auth');
    }
    //Index method
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Table::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('floor_name', function ($row) {
                return $row->floor->floor_name;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '
                <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                <a href="'.route('table.delete', [$row->id]).'" class="m-1" id="table_delete"><i class="fa fa-trash text-danger"></i></a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action','floor_name'])
            ->make(true);
        }
        $floor = Floor::all();
        return view('admin.setup.table.index', compact('floor'));
    }
    //store method
    public function store(Request $request) {
        $validated =$request->validate([
                'table_code'=>'required|unique:tables',
            ]);
        $data= array();
        $data['floor_id']=$request->floor_id;
        $data['table_code']=$request->table_code;
        $data['table_sit'] =$request->table_sit;
        DB::table('tables')->insert($data);
        return response()->json('successful inserted!');
    }
    //edit method
    public function edit($id) {
        $data=DB::table('tables')->where('id', $id)->first();
        $floor=DB::table('floors')->get();
        return view('admin.setup.table.edit', compact('data', 'floor'));
    }
    //update method
    public function update(Request $request) {
        $data=array();
        $data['floor_id']=$request->floor_id;
        $data['table_code']=$request->table_code;
        $data['table_sit']=$request->table_sit;
        DB::table('tables')->where('id', $request->id)->update($data);
        return response()->json('successful updated!');
    }
    //delete method
    public function destroy($id) {
        DB::table('tables')->where('id', $id)->delete();
        return response()->json('successful deleted!');
    }
}

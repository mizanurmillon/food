<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Expensetype;
use App\Models\Admin\Expense;
use DataTables;
use Auth;

class ExpenseController extends Controller
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
            $data = Expense::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('type_name', function ($row) {
                return $row->expensetype->type_name;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '
                <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                <a href="'.route('expense.delete', [$row->id]).'" class="m-1" id="expense_delete"><i class="fa fa-trash text-danger"></i></a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action','type_name'])
            ->make(true);
        }
        $expensetype=Expensetype::all();
        return view('admin.expense.index', compact('expensetype'));
    }
    //store method
    public function store(Request $request)
    {
       $validated = $request->validate([
            'amount' => 'required',
            'details' => 'required',
            'date' => 'required',
        ]);
        $data=array();
        $data['expenstype_id']=$request->expenstype_id;
        $data['user']=Auth::user()->name;
        $data['amount']=$request->amount;
        $data['details']=$request->details;
        $data['date']=$request->date;
        $data['month']=date('F',strtotime($request->date));
        $data['year']=date('Y',strtotime($request->date));
        DB::table('expenses')->insert($data);
        return response()->json('successful inserted!');
    }
    //edit method 
    public function edit($id)
    {
        $data=DB::table('expenses')->where('id',$id)->first();
        $expenstype=DB::table('expenstypes')->get();
        return view('admin.expense.edit',compact('data','expenstype'));
    }
    //update method
    public function update(Request $request)
    {
        $data=array();
        $data['expenstype_id']=$request->expenstype_id;
        $data['user']=Auth::user()->name;
        $data['amount']=$request->amount;
        $data['details']=$request->details;
        $data['date']=$request->date;
        $data['month']=date('F',strtotime($request->date));
        $data['year']=date('Y',strtotime($request->date));
        DB::table('expenses')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }
    //delete method 
    public function destroy($id)
    {
       Db::table('expenses')->where('id',$id)->delete();
       return response()->json('successful deleted!');    
    }
}

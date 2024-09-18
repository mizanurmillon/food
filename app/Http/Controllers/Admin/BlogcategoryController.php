<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Blogcategory;
use DataTables;
use Illuminate\Support\Str;

class BlogcategoryController extends Controller
{
    //constructor for checking admin authentication
    public function __construct()
    {
        $this->middleware('auth');
    }
    // blog category index method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Blogcategory::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('blogcategory.delete',[$row->id]).'" class="m-1" id="blog_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
       return view('admin.blog.category.index');
    }
    //store blog category method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:blogcategories|max:255',
        ]);
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name, '-');
        DB::table('blogcategories')->insert($data);
        return response()->json('successful inserted!');
    }
    //blog category Edit method
    public function edit($id)
    {
        $data=DB::table('blogcategories')->where('id',$id)->first();
        return view('admin.blog.category.edit',compact('data'));
    }
    //Update blog category method
    public function update(Request $request)
    {
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name, '-');
        DB::table('blogcategories')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }

    //delete blog category method
    public function destroy($id)
    {
       DB::table('blogcategories')->where('id',$id)->delete();
       return response()->json('successful deleted!');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Category;
use DataTables;
use Illuminate\Support\Str;
use Image;

class CategoryController extends Controller
{
    //constructor for checking admin authentication
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Index Method For Show Category
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Category::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('category.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
       return view('admin.category.index');
    }
    //category store Method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name, '-');
        DB::table('categories')->insert($data);
        return response()->json('successful inserted!');
    }
    //category Edit method
    public function edit($id)
    {
        $data=DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('data'));
    }
    //category update method
    public function update(Request $request)
    {
        $data=array(
            'category_name'=>$request->category_name,
            'category_slug'=>Str::slug($request->category_name, '-'),
        );
        DB::table('categories')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }
    //category delete method
    public function destroy($id)
    {
        DB::table('categories')->where('id',$id)->delete();
        return response()->json('successful deleted!');
    }

    //beverage all method below
        //b_index method
    public function b_index(Request $request)
    {
        if ($request->ajax()) {

            $data=DB::table('beverages')->get();

            $imgurl=asset('public/files/beverage/');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('b_image', function($row) use($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->b_image.'" height="25" width="25" />';
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa-regular fa-edit text-primary"></i></a>
                    <a href="'.route('beverage.delete',[$row->id]).'" class="m-1" id="beverage_delete"><i class="fa-solid fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','b_image'])
                ->make(true); 
        }
        return view('admin.beverage.index');
    }
    //b_store method
    public function b_store(Request $request)
    {
        $validated = $request->validate([
            'b_name' => 'required|max:255',
            'b_price' => 'required',
            'b_image' => 'required',
        ]);
      
        $data=array();
        $data['b_name']=$request->b_name;
        $data['b_price']=$request->b_price;

        $image=$request->b_image;
        $imagename=uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(190,300)->save('public/files/beverage/'. $imagename);
        $data['b_image']=$imagename;

        DB::table('beverages')->insert($data);
        return response()->json('successful inserted!');
    }

    //b_edit method
    public function b_edit($id)
    {
       $data=DB::table('beverages')->where ('id',$id)->first();
       return view('admin.beverage.edit',compact('data'));
    }

    //b_update method
    public function b_update(Request $request)
    {
        
        $data=array();
        $data['b_name']=$request->b_name;
        $data['b_price']=$request->b_price;

        if ($request->b_image ) {
            $image=$request->b_image ;
            $imagename=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image )->resize(190,300)->save('public/files/beverage/'. $imagename);
            $data['b_image']=$imagename;
        }else{
            $data['b_image']=$request->old_image;
        }
        DB::table('beverages')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }

    //b_delete method
    public function b_destroy($id)
    {
       DB::table('beverages')->where('id',$id)->delete();
       return response()->json('successful deleted!');
    }
}

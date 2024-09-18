<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Food;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use DataTables;
use Illuminate\Support\Str;
use Auth;
use Image;

class FoodController extends Controller
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

            $food="";

               $query=DB::table('foods')
                    ->leftjoin('categories','foods.category_id','categories.id')
                    ->leftjoin('subcategories','foods.subcategory_id','subcategories.id');
               if ($request->subcategory_id) {
                   $query->where('subcategory_id',$request->subcategory_id);
               }
            $food=$query->select('foods.*','categories.category_name','subcategories.subcategory_name')->get();

            $imgurl=asset('public/files/food/');

            return DataTables::of($food)
                ->addIndexColumn()
                ->editColumn('image', function($row) use($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->image.'" height="30" width="30" />';
                })
                ->editColumn('status',function($row){
                   if ($row->status==1) {
                       return '<span class="badge badge-success">Published</span>';
                   }else{
                        return '<span class="badge badge-danger">Unpublished</span>';
                   }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('food.delete',[$row->id]).'" class="m-1" id="food_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true); 
        }
        $category=Category::all();
        $subcategory=Subcategory::all();
       return view('admin.food.index',compact('category','subcategory'));
    }

    //store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'food_name' => 'required|max:255',
            'image' => 'required',
            'price' => 'required',
        ]);
        //category called
        $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();

        $slug=Str::slug($request->food_name, '-');
        $data=array();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['user_id']=Auth::id();
        $data['food_name']=$request->food_name;
        $data['top']=$request->top;
        $data['slug']=$slug;
        $data['price']=$request->price;
        $data['discount_price']=$request->discount_price;
        $data['description']=$request->description;
        $data['status']=$request->status;
        $data['slider']=$request->slider;
        $data['date']=date('d-m-Y');
        $data['month']=date('F');
        $data['year']=date('Y');

        $image=$request->image;
        $imagename=uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(600,600)->save('public/files/food/'. $imagename);
        $data['image']=$imagename;

        DB::table('foods')->insert($data);
        return response()->json('successful inserted!');
    }

    //edit method
    public function edit($id)
    {
        $category=DB::table('categories')->get();
        $data=DB::table('foods')->where('id',$id)->first();
        return view('admin.food.edit',compact('data','category'));
    }

    //update method 
    public function update(Request $request)
    {
        //category called
        $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();

        $slug=Str::slug($request->food_name, '-');
        $data=array();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['user_id']=Auth::id();
        $data['food_name']=$request->food_name;
        $data['top']=$request->top;
        $data['slug']=$slug;
        $data['price']=$request->price;
        $data['discount_price']=$request->discount_price;
        $data['description']=$request->description;
        $data['status']=$request->status;
        $data['slider']=$request->slider;

        if ($request->image) {
            $image=$request->image;
            $imagename=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(600,600)->save('public/files/food/'. $imagename);
            $data['image']=$imagename;
        }else{
            $data['image']=$request->old_image;
        }
        
        DB::table('foods')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }

    //delete method
    public function destroy($id)
    {
        DB::table('foods')->where('id',$id)->delete();
        return response()->json('successful deleted!');
    }
}

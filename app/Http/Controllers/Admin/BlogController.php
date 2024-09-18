<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Blogcategory;
use App\Models\Admin\Blog;
use DataTables;
use Illuminate\Support\Str;
use Auth;
use Image;

class BlogController extends Controller
{
    //constructor for checking admin authentication
    public function __construct()
    {
        $this->middleware('auth');
    }
    //blog index method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Blog::all();
            $imgurl=asset('public/files/blog/');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('category_name',function($row){
                    return $row->blogcategory->category_name;
                })
                ->editColumn('image', function($row) use($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->image.'" height="25" width="25" />';
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('blog.delete',[$row->id]).'" class="m-1" id="blog_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','image','category_name'])
                ->make(true); 
        }
        $category=Blogcategory::all();
       return view('admin.blog.blog.index',compact('category'));
    }
    //store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        $slug=Str::slug($request->title, '-');
        $data=array();
        $data['category_id']=$request->category_id;
        $data['user_id']=Auth::id();
        $data['title']=$request->title;
        $data['title_slug']=$slug;
        $data['description']=$request->description;
        $data['created_date']=date('d-m-Y');
        $data['created_month']=date('F');

        $image=$request->image;
        $imagename=uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1200,630)->save('public/files/blog/'. $imagename);
        $data['image']=$imagename;

        DB::table('blogs')->insert($data);
        return response()->json('successful inserted!');
    }
    //edit method
    public function edit($id)
    {
        $data=DB::table('blogs')->where('id',$id)->first();
        $blogcategory=DB::table('blogcategories')->get();
        return view('admin.blog.blog.edit',compact('data','blogcategory'));
    }
    //update method
    public function update(Request $request)
    {
        $slug=Str::slug($request->title, '-');
        $data=array();
        $data['category_id']=$request->category_id;
        $data['user_id']=Auth::id();
        $data['title']=$request->title;
        $data['title_slug']=$slug;
        $data['description']=$request->description;
        $data['created_date']=date('d-m-Y');
        $data['created_month']=date('F');

        if ($request->image) {
            $image=$request->image;
            $imagename=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1200,630)->save('public/files/blog/'. $imagename);
            $data['image']=$imagename;
        }else{
           $data['image']=$request->old_image;
        }

        DB::table('blogs')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }
    //delete method
    public function destroy($id)
    {
        DB::table('blogs')->where('id',$id)->delete();
        return response()->json('successful deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Category::get();
        foreach($data as $key=>$value){
            $parentname=Category::select('name')->where('id',$value->parent_id)->first();
            $data[$key]['parentname']= !empty($parentname->name)?$parentname->name:"";
        }
        return view('admin.categoriesList',['cat'=>$data]);
    }
    public function categoryadd(){
        $cat=Category::where('status',1)->where('parent_id',0)->get();
        $title="Add New Category";
        return view('admin.categoryform',['title'=>$title,'category'=>$cat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savecategory(Request $request)
    {
       if(!empty($request->category_old_id) && isset($request->category_old_id)){
         
        $checkexisted=Category::where('name',$request->category_name)->where('id','!=',$request->category_old_id)->first();
       }
       else{
        $checkexisted=Category::where('name',$request->category_name)->first();
       }
       if($checkexisted){
            return Redirect::back()->with('errormsg',"Category Exists Already");
       }
       else{
           $data=[
               'name'=>$request->category_name,
               'parent_id'=>$request->parent_id,
               'status'=>1
           ];
           if(!empty($request->category_old_id) && isset($request->category_old_id)){
            Category::where('id',$request->category_old_id)->update($data);
            $message="Update Category Successfully";
           }
           else{
            Category::create($data);
            $message="Category Added Successfully";
           }
           return Redirect::to('categories')->with('successmessage',$message);
       }
    }
    public function categoryedit($id){
        $data=Category::where('id',$id)->first();
        $cat=Category::where('status',1)->where('parent_id',0)->get();
        $title="Edit Category";
        return view('admin.categoryform',['title'=>$title,'category'=>$cat,'data'=>$data]);
    }
    public function categorydelete($id){
        Category::where('id',$id)->delete();
        return Redirect::to('categories')->with('successmessage',"Category Deleted");
    }

}

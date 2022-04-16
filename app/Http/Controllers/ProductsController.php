<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Products::get();
        foreach($data as $key=>$value){
        }
        return view('admin.productList',['products'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productadd()
    {
        $category=Category::where('status',1)->where('parent_id',0)->get();
        $title="Add New Product";
        return view('admin.productform',['title'=>$title,'category'=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getsubcategory(Request $request)
    {
        $data=Category::where('parent_id',$request->parent_id)->get();
        $html='<option value=0>Select Sub Category</option>';
        foreach($data as $key=>$value){
            $html.='<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        return $html;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function productdelete($id)
    {
        Products::where('id',$id)->delete();
        DB::table('zipcode')->where('product_id',$id)->delete();
        DB::table('product_variation')->where('product_id',$id)->delete();
        return Redirect::to('products')->with('successmessage',"Deleted Product"); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function savproduct(Request $request)
    {
        $imageName = time().'.'.$request->Image->extension();  
        $request->Image->move(public_path('proimages'), $imageName);
        $data=[
            'product_desc'=>$request->product_desc,
            'product_name'=>$request->product_name,
            'default_price'=>$request->default_price,
            'status'=>1,
            'image'=>$imageName,
            'category_id'=>$request->parent_id,
            'subcatgeory_id'=>$request->subcat_id
        ];
        $id=Products::create($data)->id;
        if(count($request->material)>0){
            foreach($request->material as $key=>$values){
                $data=[
                    'demesion'=>$values,
                    'pack_size'=>$request->pack_size[$key],
                    'material'=>$request->dimension[$key],
                    'price'=>$request->price[$key],
                    'product_id'=>$id
                ];
                DB::table('product_variation')->insert($data);
            }
        }
        if(count($request->zipcode)>0){
            foreach($request->zipcode as $key=>$values){
                $data=[
                    'zipcode'=>$values,
                    'price'=>$request->deliverycharges[$key],
                    'product_id'=>$id
                ];
                DB::table('product_zip')->insert($data);
            }
        }
        return Redirect::to('products')->with('successmessage',"Added New Product"); 
    }
    public function productedit($id){
        $category=Category::where('status',1)->where('parent_id',0)->get();
        $title="Edit Old Product";
        $data=Products::where('id',$id)->first();
        return view('admin.productform',['title'=>$title,'category'=>$category,'data'=>$data]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Category::getTreeList();
        return view("admin/category/list")->with("rows",$rows);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rows = Category::getTreeList();
//        return view('admin/category/create')->with("rows",$rows);
        return view('admin/category/create',compact('rows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        if($category->save()!==false){
            return redirect("admin/category");
        }else{
            return back()->with("msg","保存失败!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = collect([1,2,3]);
        var_dump($result->toArray());;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $rows = Category::getTreeList();

        return view("admin/category/edit",compact("rows","category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $all = $request->all();
        $category = Category::findOrFail($id); //先找到
        if($category->update($all)!==false){
            return redirect("admin/category");
        }else{
            return back()->with("msg","更新失败!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = [
            "success"=>true,
        ];
        if(Category::destroy($id)!==false){
            $result['msg'] = '删除成功!';
        }else{
            $result['success']= true;
            $result['msg'] = '删除成功!';
        }
        return response()->json($result);
    }

    public function changeOrd(Request $request){
        if($request->ajax()){
             $id = $request->input('id');
             $category = Category::find($id);
             $category->order = $request->input('ord',0);

             $result = [
                 "success"=>true,
             ];
             if($category->update()){
                 $result['msg'] = '更新成功!';
             }else{
                 $result['success']= true;
                 $result['msg'] = '更新成功!';
             }
            return response()->json($result);
        }
    }
}

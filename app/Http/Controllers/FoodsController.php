<?php

namespace App\Http\Controllers;

use App\Commodity;
use App\Foods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use OSS\Core\OssException;

class FoodsController extends Controller
{
    //
    public function index(Request $request,Commodity $commodity)
    {
        $name=$request->keywords;
        $foods=Foods::where('name','like',"%$name%")->where('commodity_id',$commodity->id)->paginate(2);
        return view('food.index',compact('foods','commodity','name'));
    }
    public function create(Commodity $commodity)
    {
//        dd($commodity->id);
       return view('food.create',compact('commodity'));
    }

    public function store(Request $request,Commodity $commodity)
    {
        $this->validate($request,[
           'name'=>'required|min:2|max:8',
           'goods_price'=>'required|numeric',
           'description'=>'max:20',
           'tips'=>'max:20',
        ],[
            'name.required'=>'名称不能为空',
            'name.min'=>'名称不能少于两位',
            'name.max'=>'名称不能大于八位',
            'goods_img.image'=>'上传图片格式不正确',
            'goods_price.required'=>'请输入食物价格',
            'goods_price.numeric'=>'食物价格必须是数字',
            'description.max'=>'食物描述不能超过20字',
            'tips.max'=>'提示信息不能超过20字',
        ]);
        $food=new Foods();
            $food->name=$request->name;
            $food->goods_img=$request->goods_img;
            $food->goods_price= $request->goods_price;
            $food->description= $request->description??'';
            $food->tips= $request->tips??'';
            $food->commodity_id= $commodity->id;
            $food->save();
        return redirect()->route('foods.index',$commodity->id)->with('添加成功');
    }

    public function edit(Foods $food)
    {
        return view('food.edit',compact('food'));
    }

    public function update(Request $request,Foods $food)
    {
        $this->validate($request,[
            'name'=>'required|min:2|max:8',
            'goods_price'=>'required|numeric',
            'description'=>'max:20',
            'tips'=>'max:20',
        ],[
            'name.required'=>'名称不能为空',
            'name.min'=>'名称不能少于两位',
            'name.max'=>'名称不能大于八位',
            'goods_img.max'=>'上传图片格式不正确',
            'goods_price.required'=>'请输入食物价格',
            'goods_price.numeric'=>'食物价格必须是数字',
            'description.max'=>'食物描述不能超过20字',
            'tips.max'=>'提示信息不能超过20字',
        ]);
        $cover=$food->goods_img;
        if($request->goods_img!=null){
            $cover=$request->goods_img;
        }
        $food->update([
            'name'=>$request->name,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'tips'=>$request->tips,
            'goods_img'=>$cover,
        ]);
        return redirect()->route('foods.index',$food->commodity_id)->with('success','修改成功');
    }

    public function destroy(Foods $food)
    {
        $food->delete();
        return redirect()->route('foods.index',$food->commodity_id)->with('success','删除成功');
    }
}

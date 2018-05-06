<?php

namespace App\Http\Controllers;

use App\Commodity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommodityController extends Controller
{
    //
    public function index(Request $request)
    {
        $name = $request->keywords;
        $commodities = Commodity::where('name', 'like', "%$name%")->where('user_id',Auth::user()->user_id)->paginate(3);
        return view('commodity.index', compact('commodities', 'name'));
    }

    public function create()
    {
        return view('commodity.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:8',
            'description' => 'required|min:6|max:20',
            'captcha' => 'required|captcha',
        ], [
            'name.required' => '分类名称必填',
            'name.min' => '分类名称不能小于两位',
            'name.max' => '分类名称不能大于八位',
            'description.required' => '分类名称必填',
            'description.max' => '分类描述不能大于二十位',
            'description.min' => '分类描述不能小于六位',
            'captcha.required'=>'请填写验证码',
            'captcha.captcha'=>'验证码错误',
        ]);
//        dd(Auth::user()->id);
        if ($request->is_selected==1) {
           $res= DB::table('commodities')->where('user_id', '=', Auth::user()->id)->update(['is_selected' => 0]);
//       dd($res);
        }
        Commodity::create([
            'description' => $request->description,
            'name' => $request->name,
            'is_selected' => $request->is_selected??0,
            'type_accumulation' => 'c1',
            'user_id' => Auth::user()->user_id,
        ]);
        session()->flash('success', '添加分类成功');
        return redirect()->route('commodity.index');
    }

    public function show(Commodity $commodity)
    {
        return view('commodity.show',compact('commodity'));
    }

    public function edit(Commodity $commodity)
    {
        return view('commodity.edit',compact('commodity'));
    }

    public function update(Request $request,Commodity $commodity)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:8',
            'description' => 'required|min:6|max:20',
            'captcha' => 'required|captcha',
        ], [
            'name.required' => '分类名称必填',
            'name.min' => '分类名称不能小于两位',
            'name.max' => '分类名称不能大于八位',
            'description.required' => '分类名称必填',
            'description.max' => '分类描述不能大于二十位',
            'description.min' => '分类描述不能小于六位',
            'captcha.captcha' => '验证码错误',
            'captcha.required' => '验证码必须填写',
        ]);
//        dd($request->is_selected=='1');
        if ($request->is_selected==1) {
            DB::table('commodities')
                ->where('user_id', '=', Auth::user()->user_id)
                ->update(['is_selected' => 0]);
//        dd($res);
        }
        $commodity->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected??0,
            ]);
    return redirect()->route('commodity.index')->with('success','修改成功');
    }

    public function destroy(Commodity $commodity)
    {
    $commodity->delete();
    }
}

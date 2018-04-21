<?php

namespace App\Http\Controllers;
use App\BusinessDetails;
use App\Businessuser;
use App\ShopUser;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopUsersController extends Controller
{
    //<?php
//use App\ShopUser;
        //
        public function create()
        {
            $categories=DB::table('businessusers')->pluck('name','id');
            return view('shop_user.create',compact('categories'));
        }

        public function store(Request $request)
        {
            $this->validate($request,[
                'name'=>'required|min:2|max:20',
                'password'=>'required|min:6|max:18|confirmed',
                'cover'=>'image',
                'phone'=>'required|max:11|min:11',
            ],[
                'name.required'=>'姓名不能为空',
                'name.min'=>'姓名长度至少2位',
                'name.max'=>'姓名长度不能超过20位',
                'password.required'=>'密码不能为空',
                'password.min'=>'密码长度不能少于6位',
                'password.max'=>'密码长度不能大于18位',
                'password.confirmed'=>'确认密码与密码不一致',
                'phone.required'=>'手机不能为空',
                'phone.max'=>'手机号格式错误',
                'phone.min'=>'手机号格式错误',
            ]);
            DB::transaction(function ()use($request){
                DB::table('business_details')->insert([
                    'shop_name'=>$request->name,
                ]);
                $bd=DB::getPdo()->lastInsertId();

//                dd($bd);
                DB::table('businessusers')->insert([
                    ['phone' =>$request->phone, 'name' => $request->name,'password'=>bcrypt($request->password),'category_id'=>$request->category_id,'user_id'=>$bd],
                ]);

            });
            session()->flash('success','注册进行中,请耐心等待2-3个工作日,我们会以短信的方式通知你进程');
            return redirect()->route('login');
        }

    public function edit(Businessuser $shopuser)
    {
        return view('shop_user.edit',compact('shopuser'));
    }

    public function update(Request $request,Businessuser $shopuser)
    {
        $this->validate($request,[
            'name'=>'required|min:2|max:8',
            'phone'=>'required|numeric',
        ],[
            'name.required'=>'必须填写商店名字!',
            'name.min'=>'商店名字不能少于两位!',
            'name.max'=>'商店名字不能大于八位!',
            'phone.required'=>'必须填写手机号码!',
            'phone.numeric'=>'手机号码必须为数字!',
        ]);
        DB::transaction(function ()use($request,$shopuser){
            $shopuser->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'category_id'=>$request->category_id,
            ]);
            $name=$request->name;

//           $rows= BusinessDetails::where('id',$shopuser->user_id)->pluck('shop_name');
            DB::update("update business_details set shop_name = '{$name}' where id = ?", [ $shopuser->user_id]);
        });
        session()->flash('success','修改成功');
        return redirect()->route('businessuser.index');


    }
    }
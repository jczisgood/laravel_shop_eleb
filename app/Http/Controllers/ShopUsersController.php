<?php

namespace App\Http\Controllers;
use App\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopUsersController extends Controller
{
    //<?php
//use App\ShopUser;


        //
        public function create()
        {
            $categories=DB::table('shop_categories')->pluck('name','id');
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
            ShopUser::create([            'name'=>$request->name,
                    'password'=>$request->password,
                    'phone'=>$request->phone,
                    'category_id'=>$request->category_id,
                ]
            );
            session()->flash('success','注册进行中,请耐心等待2-3个工作日,我们会以短信的方式通知你进程');
            return redirect()->route('shopusers.create');
        }


    }

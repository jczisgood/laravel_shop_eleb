<?php

namespace App\Http\Controllers;

use App\Businessuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangesController extends Controller
{
    //
    public function edit(Businessuser $businessuser)
    {
//        dd($businessuser->id);
        return view('change.edit',compact('businessuser'));
    }

    public function update(Request $request,Businessuser $businessuser)
    {
        if (Hash::check($request->oldpassword, $businessuser->password)){
            return back()->with('danger','修改失败旧密码错误');
        }
        $this->validate($request,[
            'password'=>'required|min:6|max:18|confirmed',
        ],[
            'password.max'=>'密码最长为十八位',
            'password.min'=>'密码最短为六位',
            'password.required'=>'密码必填',
        ]);
        $businessuser->update([
            'password'=>bcrypt($request->password)
        ]);
        session()->flash('success','修改成功,需要重新登录');
        return redirect()->route('logout2');
    }
}

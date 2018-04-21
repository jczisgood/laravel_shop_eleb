<?php

namespace App\Http\Controllers;

use App\BusinessDetails;
use App\Businessuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BusinessUserController extends Controller
{
    //
    public function index()
    {
        return view('businessu.index');
    }

    public function show(Businessuser $businessuser)
    {
        $row=DB::table('business_details')->where('id','=',$businessuser->user_id)->get();
        return view('businessu.show',compact('row'));
    }

    public function edit(Businessuser $businessuser)
    {
        $row=DB::table('business_details')->where('id','=',$businessuser->user_id)->get();
//        dd($row[0]);
        return view('businessu.index2',compact('row'));
//        $row=DB::table('business_details')->where('id','=',$businessuser->user_id)->get();
//        return view('businessu.show',compact('row'));
    }

    public function update(Request $request,Businessuser $businessuser)
    {
        $this->validate($request,[
            'shop_img'=>'image',
            'start_send'=>'required|numeric',
            'send_cost'=>'required|numeric',
            'estimate_time'=>'required|numeric',
            'notice'=>'max:50',
            'discount'=>'max:30',
        ],[
        'shop_img.image'=>'图片格式不正确',
        'start_send.required'=>'起送金额没填',
        'start_send.numeric'=>'起送金额必须是整数',
        'send_cost.numeric'=>'配送费用必须是整数',
        'send_cost.required'=>'配送费用没填',
        'estimate_time.required'=>'预计时间没填',
        'estimate_time.numeric'=>'预计时间请填写数字',
        'notice.max'=>'公告最多50位',
        'discount.max'=>'优惠活动最多30位',
        ]);
        $img=BusinessDetails::where('id',Auth::user()->user_id)->pluck('shop_img');
//       dd($img);
        $cover=$img[0];

        if ($request->file('shop_img')!=null){
            $res=$request->file('shop_img')->store('public/shop_img');
            $cover=url(Storage::url($res));
//            dd($cover);
        }
            $businessd=BusinessDetails::where('id',$businessuser->user_id);
        $businessd->update([
            'shop_img'=>$cover,
            'brand'=>$request->brand??0,
            'on_time'=>$request->on_time??0,
            'fengniao'=>$request->fengniao??0,
            'bao'=>$request->bao??0,
            'piao'=>$request->piao??0,
            'zhun'=>$request->zhun??0,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'estimate_time'=>$request->estimate_time,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('businessuser.index');
    }

}

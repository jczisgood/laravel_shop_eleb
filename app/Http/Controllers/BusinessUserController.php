<?php

namespace App\Http\Controllers;

use App\Activity;
use App\BusinessDetails;
use App\Businessuser;
use App\Event;
use App\EventMember;
use App\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BusinessUserController extends Controller
{
    //
    public function index()
    {
        $t=date('Y-m-d H:i:s');
        $events=DB::table('events')->where('signup_end','>',$t)->get();
//        dd($rows);
        return view('businessu.index',compact('events'));
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

        if ($request->shop_img!=null){
            $cover=$request->shop_img;
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

    public function showa(Event $event)
    {
//        dd($activity);
       $rows= EventMember::where('events_id',$event->id)->get()->count();
       $vals= EventMember::where('member_id',Auth::user()->id)->get()->count();
//       dd($rows);
        return view('businessu.showa',compact('event','rows','vals'));
    }

    public function join(Event $event)
    {
        $rows= EventMember::where('events_id',$event->id)->get()->count();
        $vals= EventMember::where('member_id',Auth::user()->id)->get()->count();
        if($rows>=$event->signup_num || $vals>1){
            return redirect()->route('activity.showa',$event->id)->with('success','参与失败,人数已满');
        }
        //写入数据库
        EventMember::create([
            'events_id'=>$event->id,
            'member_id'=>Auth::user()->id,
        ]);
        return redirect()->route('activity.showa',$event->id)->with('success','参与成功');
    }

    public function see(Event $event)
    {
        $eventprizes=EventPrize::where('events_id',$event->id)->where('member_id','<>',0)->get();
        return view('businessu.see',compact('eventprizes'));
    }


}

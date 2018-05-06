<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {

        $name=$request->keywords;
        $orders=Order::where('order_code','like',"%$name%")->where('shop_id',Auth::user()->user_id)->paginate(2);
        return view('order.index',compact('orders','name'));
    }

    public function show(Order $order)
    {
        return view('order.show',compact('order'));
    }

    public function update(Order $order)
//    {dd(1);
    {
        //修改状态为2
        $order->update([
                'order_status'=>2
            ]
        );
        return redirect()->route('order.index')->with('success','已经成功取消,提示---已经对你的行为进行扣分');
    }

    public function count(Request $request)
    {   $time=3600*24*30;
        $time=time()-$time;
        $start=$request->start_time??date('Y-m-d H:i:s',$time);
//        dd($start);
        $end=$request->end_time??date('Y-m-d H:i:s',time());
        //得到商家ID
       $user_id= Auth::user()->user_id;
       //查询 区域内的订单
        $orders=DB::select("select count(*) as c from orders where created_at>'{$start}' and created_at<'{$end}' and shop_id='{$user_id}'");
//       dump($orders[0]);
        return view('order.count',compact('orders'));
    }

    public function foodlist(Request $request)
    {
        $time=3600*24*30;
        $time=time()-$time;
        $start=$request->start_time??date('Y-m-d H:i:s',$time);
//        dd($start);
        $user_id= Auth::user()->user_id;
        $end=$request->end_time??date('Y-m-d H:i:s',time());
        $orders=DB::select("select goods_name,sum(amount) as number from order_goods where created_at>'{$start}' and created_at<'{$end}' and order_id in (select id from orders where shop_id ='{$user_id}') GROUP by goods_name HAVING sum(amount) ORDER BY sum(amount) desc limit 3");
//       dd($orders);die;
        $timer=['start'=>$start,'end'=>$end];
        return view('order.foodlist',compact('orders','timer'));
    }

    public function send(Order $order)
    {
        $order->update([
           'order_status'=>1,
        ]);
        $params = array ();
        // *** 需用户填写部分 ***
        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = "LTAIpRDhsMZCuFq2";
        $accessKeySecret = "bMGlY2BkOKs8WPKGb7fxW0ysQUNbQL";

        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $order->receipt_tel;

        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = "大诚烧烤";

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = "SMS_133979547";

        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = Array (
            "name" => $order->receipt_name,
//            "product" => "阿里通信"
        );
        // fixme 可选: 设置发送短信流水号
//        $params['OutId'] = "12345";

        // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
//        $params['SmsUpExtendCode'] = "1234567";


        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelperController();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
        // fixme 选填: 启用https
        // ,true
        );
//        dd($content->Message);
        return redirect()->route('order.show',compact('order'))->with('success','发货成功,我们会一短信的方式提醒用户');
    }

}

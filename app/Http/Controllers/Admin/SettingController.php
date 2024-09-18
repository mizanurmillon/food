<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class SettingController extends Controller
{
    //constructor for checking admin authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //SEO setting method
    public function seoSetting()
    {
        $data=DB::table('seos')->first();
        return view('admin/setting/seo/index',compact('data'));
    }
    //SEO update method
    public function SeoUpdate(Request $request,$id)
    {
        $data=array();

        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_keyword']=$request->meta_keyword;
        $data['meta_description']=$request->meta_description;
        $data['google_verification']=$request->google_verification;
        $data['alexa_verification']=$request->alexa_verification;
        $data['google_analytics']=$request->google_analytics;
        $data['google_adsense']=$request->google_adsense;

        DB::table('seos')->where('id',$id)->update($data);
        $notification=array('message' => 'SEO Setting Updated !', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //Website setting method
    public function Setting()
    {
        $setting=DB::table('settings')->first();
        return view('admin/setting/website/index',compact('setting'));
    }

    //Website setting update
    public function SettingUpdate(Request $request , $id)
    {
        $data=array();
        $data['currency']=$request->currency;
        $data['phone_one']=$request->phone_one;
        $data['phone_two']=$request->phone_two;
        $data['main_email']=$request->main_email;
        $data['support_email']=$request->support_email;
        $data['address']=$request->address;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['instagram']=$request->instagram;
        $data['linkedin']=$request->linkedin;
        $data['youtube']=$request->youtube;
        if ($request->logo) { //New logo
            $logo=$request->logo;
            $logoName=uniqid().'.'.$logo->getClientOriginalExtension();
            Image::make($logo)->resize(320,120)->save('public/files/setting/'.$logoName);
            $data['logo']=$logoName;
        }else{ //Old logo
           $data['logo']=$request->old_logo;
        }
        if ($request->favicon) { //New Favicon===
            $favicon=$request->favicon;
            $faviconName=uniqid().'.'.$favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(32,32)->save('public/files/setting/'.$faviconName);
            $data['favicon']=$faviconName;
        }else{ //Old Favicon===
            $data['favicon']=$request->old_favicon;
        }
        DB::table('settings')->where('id',$id)->update($data);
        $notification=array('message' => 'Website Setting Updated!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

    //smtp setting method
    public function smtpSetting()
    {
       $smtp=DB::table('smtps')->first();
       return view('admin/setting/smtp/index',compact('smtp'));
    }

    //SMTP Setting Update method
    public function SmtpUpdate(Request $request , $id)
    {
       $data=array();
       $data['mail_mailer']=$request->mail_mailer;
       $data['mail_host']=$request->mail_host;
       $data['mail_port']=$request->mail_port;
       $data['mail_username']=$request->mail_username;
       $data['mail_password']=$request->mail_password;

       DB::table('smtps')->where('id',$id)->update($data);
       $notification=array('message' => 'SMTP Setting Updated!', 'alert-type' => 'success'); 
       return redirect()->back()->with($notification);

    }

    //__payment gateway method__//
    public function paymentGateway()
    {
        $aamarpay=DB::table('payment_gateway_bd')->first();
        $surjopay=DB::table('payment_gateway_bd')->skip(1)->first();
        $ssl=DB::table('payment_gateway_bd')->skip(2)->first();

        return view('admin.setting.bdpayment_gateway.edit',compact('aamarpay','surjopay','ssl'));
    }

    // __aamarpay update method__//
    public function AamarpayUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;

        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification=array('message' => 'Payment Gateway Updated!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }
    // __surjopay update method__//
    public function SurjopayUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;

        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification=array('message' => 'Payment Gateway Updated!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }
    // __ssl update method__//
    public function SSLUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;

        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification=array('message' => 'Payment Gateway Updated!', 'alert-type' => 'success'); 
        return redirect()->back()->with($notification);
    }

}

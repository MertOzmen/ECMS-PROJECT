<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sliders;
use App\Models\Blogs;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class DefaultsController extends Controller
{
    public function index()
    {
        $data['blog'] = Blogs::all()->sortby('blog_must');
        $data['slider'] = Sliders::all()->sortby('slider_must');
        return view('frontend.default.index', compact('data'));
    }

    public function contact()
    {
        return view('frontend.default.contact');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ]);

         $data=[
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' =>$request->message
         ];

         Mail::to('info@blabla.com.tr')->send(new SendMail($data));
         
         return back()->with('success','Mail Başarılı bir şekilde Gönderildi');
    }
}

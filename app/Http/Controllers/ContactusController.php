<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactInfo;
use Mail;
use App\Contact;
use App\Maildata;
use Carbon\Carbon;
use Validator;

class ContactusController extends Controller
{
    public function contact(Request $request) {

        $messages = ['Name.regex' => '拜託別黑我'];

        $validator = Validator::make($request->all(), [
            'Name' => [
                'required',
                'regex:/^([^0-9]+)$/',
            ],
            'g-recaptcha-response' => 'required|captcha'
        ], $messages);

        if ($validator->fails()) {
            return redirect(url()->previous().'#'.$request->input('section_id'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $input = $request->input();
        $emails = Contact::select('email')->where('active', '=', 1)->pluck('email');
        $emails[] = 'haogood.sun@gmail.com';
        
        try {
            $this->saveInfo($input);
            Mail::to($emails)->queue(new ContactInfo($input));
        } catch (\Exception $e) {
            return abort(500);
        }

        return view('single.success');
        
    }

    /*
     * 2017/12/07
     * 儲存"聯絡我們"訊息
     * 目的: 避免email寄丟
     */
    private function saveInfo(Array $input) {
        Maildata::insert([
            'name' => $input['Name'],
            'contact' => $input['Email'],
            'job' => $input['Career'],
            'message' => $input['Content'],
            'ip' => \Request::ip(),
            'created_at' => Carbon::now()
        ]);
    }

}

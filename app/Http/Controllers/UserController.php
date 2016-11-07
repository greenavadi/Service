<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\AppUsers;
use App\UserVerification;
use \Illuminate\Support\Facades\Mail;

class UserController extends Controller {

    public function signin(Request $request) {
        $email = $request->input('email', '');
        $password = $request->input('password', '');

        $app_user = AppUsers::
                where('email_address', '=', $email)
                ->where('password', '=', $password)
                ->first();
        if ($app_user == null) {
            return response('Incorrect email/password', 401);
        } else if ($app_user->status == 0) {
            return $this->sendResponse(1, 'Account not verified');
        } else if ($app_user->status == 2) {
            return $this->sendResponse(2, 'Account blocked.');
        }

        $auth_token = $app_user->auth_token;
        if ($auth_token == null) {
            $auth_token = str_random(48);
            $app_user->auth_token = $auth_token;
            $app_user->save();
        }

        $user_details = array();
        $user_details['user_id'] = $app_user->id;
        $user_details['auth_token'] = $auth_token;
        return $this->sendResponse(0, $user_details);
    }

    public function signup(Request $request) {
        $email = $request->input('email', '');
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'address' => 'required',
            'contact' => 'required',
            'reference' => 'required',
            'volunteer' => 'required',
        ];
        $error_messages = [
            'first_name.required' => 'The First name parameter is required.',
            'last_name.required' => 'The Last name parameter is required.',
            'email.required' => 'The Email parameter is required.',
            'email.email' => 'The Email parameter must be a valid email address.',
        ];
        $validator = Validator::make($request->all(), $rules, $error_messages);

        if ($validator->fails()) {
            return $this->sendResponse(1, $validator->errors()->all());
        }

        // TODO: check email uniqueness
        $app_user_check = AppUsers::
                where('email_address', '=', $email)
                ->first();
        if ($app_user_check != null) {
            return $this->sendResponse(2, 'The provided email already used.');
        }

        // all validations passed
        $app_user = new AppUsers;
        $app_user->email_address = $email;
        $app_user->first_name = $request->input('first_name');
        $app_user->last_name = $request->input('last_name');
        $app_user->password = $request->input('password');
        $app_user->address = $request->input('address');
        $app_user->phone_number = $request->input('contact');
        $app_user->reference = $request->input('reference');
        $app_user->volunteer = $request->input('volunteer');
        $app_user->save();

        $verification_code = strtoupper(str_random(8));
        $uv = new UserVerification;
        $uv->user_id = $app_user->id;
        $uv->verification_code = $verification_code;
        $uv->save();

        $data = array();
        $data['email'] = $email;
        $data['name'] = $request->input('first_name');
        Mail::raw($verification_code, function($message) use ($data) {
            $message->from('noreply@verify.com', 'Verification');
            $message->to($data['email'], $data['name']);
            $message->subject('Verify your email address');
        });

        $result_data['user_id'] = $app_user->id;
        return $this->sendResponse(0, $result_data);
    }

    public function verifyEmailAddress(Request $request) {
        $rules = [
            'verification_code' => 'required',
        ];
        $error_messages = [
            'verification_code.required' => 'Verification code is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $error_messages);

        if ($validator->fails()) {
            return $this->sendResponse(1, $validator->errors()->all());
        }

        $uv = UserVerification::where('user_id', '=', $request->input('user_id'))->orderBy('id', 'desc')->first();
        if ($uv != null) {
            if ($uv->verification_code == $request->input('verification_code')) {
                $uv->status = 1;
                $uv->save();

                $app_user = AppUsers::where('id', '=', $request->input('user_id'))->first();
                $app_user->status = 1;
                $app_user->save();
                return 'Verification Succcess';
            } else {
                return $this->sendResponse(2, "The submitted verification code is incorrect.");
            }
        }
        return $this->sendResponse(0, "Email verification failed.");
    }

}

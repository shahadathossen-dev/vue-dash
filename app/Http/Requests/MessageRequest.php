<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|string',
                    'email' => 'required',
                    'phone' => 'required|string',
                    'message' => 'required|string',
                    'g-recaptcha-response' => 'required|string',
                    // 'captcha' => 'required|captcha', // this will validate captcha
                ];
            default:break;
        }
    }
}

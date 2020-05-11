<?php

namespace App\Http\Requests;

use App\Models\Backend\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch($this->method()) {
            case 'POST':
            case 'GET':
            case 'DELETE':
            case 'PUT':
            case 'PATCH':
                return $this->user()->id == $this->id;

            default:break;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => ['required', Rule::unique((new User())->getTable())->ignore($this->id)],
            'phone' => 'required|string',
            'postal_address' => 'nullable|string',
            'city' => 'required|string',
            'zip_code' => 'required|string',
            'country' => 'required|string',
            'dob' => 'required|date',
            'avatar' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
        ];
    }
}

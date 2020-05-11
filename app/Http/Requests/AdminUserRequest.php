<?php

namespace App\Http\Requests;

use App\Models\Backend\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch($this->method()) {
            case 'GET':
            case 'DELETE':
            case 'POST':
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
            'username' => 'required|string',
            'email' => ['required', Rule::unique((new User())->getTable())->ignore($this->id)],
            'phone' => 'nullable|string',
            'dob' => 'nullable|v',
            'role_id' => 'required|integer',
            'status_id' => 'required|integer',
        ];
    }
}

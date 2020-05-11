<?php

namespace App\Http\Requests;

use App\Models\Backeend\Replies;
use Illuminate\Foundation\Http\FormRequest;

class RepliesRequest extends FormRequest
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
                return $this->user()->can('reply messages');

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
        switch($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
            case 'PUT':
            case 'PATCH':
                return [
                    'message_id' => 'required|integer',
                    'message' => 'required|string',
                ];
            default:break;
        }
    }
}

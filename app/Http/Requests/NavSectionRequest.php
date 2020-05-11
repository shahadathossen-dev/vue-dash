<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavSectionRequest extends FormRequest
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
                return $this->user()->can('manage sections');

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
                    'bg_color' => 'required',
                    'text_color' => 'required',
                    'hover_color' => 'required',
                ];
            default:break;
        }
    }
}

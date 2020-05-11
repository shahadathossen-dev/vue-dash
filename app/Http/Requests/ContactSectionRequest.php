<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Backend\Sections\ContactSection;
use Illuminate\Foundation\Http\FormRequest;

class ContactSectionRequest extends FormRequest
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
                    'section_title' => ['required', Rule::unique((new ContactSection)->getTable())->ignore($this->id)],
                    'bg' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
                ];
            default:break;
        }
    }
}

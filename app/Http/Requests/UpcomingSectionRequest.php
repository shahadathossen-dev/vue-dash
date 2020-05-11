<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Backend\Sections\UpcomingSection;

class UpcomingSectionRequest extends FormRequest
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
                    'section_title' => ['required', Rule::unique((new UpcomingSection)->getTable())->ignore($this->id)],
                    'feature' => 'required|max:500',
                    'playback' => 'mimetypes:video/mp4|max:20480',
                    'poster' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
                ];
            default:break;
        }
    }
}

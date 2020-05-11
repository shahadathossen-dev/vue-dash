<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Backend\Sections\SliderSection;
use Illuminate\Foundation\Http\FormRequest;

class SliderSectionRequest extends FormRequest
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
                    'title' => ['required', Rule::unique((new SliderSection)->getTable())->ignore($this->id)],
                    'subtitle' => 'required|string',
                    'banner' => 'required_without:playback|required_without:length|image|mimes:jpeg,jpg,png,gif|max:2048',
                    'playback' => 'required_without:banner|required_with:length|mimetypes:video/mp4|max:20480',
                    'length' => 'required_with:playback|required_without:banner|string',
                ];
            default:break;
        }
    }
}

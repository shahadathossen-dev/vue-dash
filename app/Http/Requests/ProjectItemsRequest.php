<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Backend\Sections\ProjectItems;

class ProjectItemsRequest extends FormRequest
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
            case 'POST':
            case 'PUT':
            case 'PATCH':
                return [
                    // 'project_title' => ['required', Rule::unique((new ProjectItems)->getTable())->ignore($this->id)],
                    'project_title' => 'required|string',
                    'projects_section_id' => 'required|integer',
                    'url' => 'required|url',
                    'poster' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
                ];
            default:break;
        }
    }
}

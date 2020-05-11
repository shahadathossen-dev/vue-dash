<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Backend\Sections\GalleryTiles;

class GalleryTilesRequest extends FormRequest
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
                    'tile_title' => ['required', Rule::unique((new GalleryTiles)->getTable())->ignore($this->id)],
                    'gallery_section_id' => 'required|integer',
                    'tile_image' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
                ];
            default:break;
        }
    }
}

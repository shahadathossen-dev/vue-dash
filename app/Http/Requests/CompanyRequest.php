<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Backend\System\Company;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
                return $this->user()->can('manage company-settings');

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
                    'company_name' => ['required', Rule::unique((new Company)->getTable())->ignore($this->id)],
                    'logo' => 'required_without:id|image|mimes:jpeg,jpg,png,gif|max:1024',
                    'icon' => 'required_without:id|image|mimes:jpeg,jpg,png,gif|max:1024',
                    'phone' => 'required',
                    'invoice_prefix' => ['required', Rule::unique((new Company)->getTable())->ignore($this->id)],
                    'city' => 'required',
                    'zip_code' => 'required',
                    'country' => 'required',
                    'postal_address' => 'required|max:100',
                    'bank_details' => 'max:100',
                    'mail_from_email' => 'required|email',
                    'mail_from_name' => 'required',
                    'test_mail' => 'boolean',
                    'default_company' => 'boolean',
                    'test_mail_address' => 'bail|required_if:test_mail,1|nullable|email',
                ];
            default:break;
        }

    }
}

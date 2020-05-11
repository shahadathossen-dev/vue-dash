<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CompanyRequest;
use App\Models\Backend\System\Company;
use Illuminate\Support\Facades\Artisan;
use App\Mail\Backend\CompanyDetailsMail;

class CompanyController extends Controller
{
    public function index(CompanyRequest $request)
    {
        return view('backend.system.company.company-settings');
    }

    public function update(CompanyRequest $request)
    {
        $updateCompanyDetails = Company::updateOrCreate(['id' => $request->id],[
                                    'company_name' => $request->company_name,
                                    'phone' => $request->phone,
                                    'invoice_prefix' => $request->invoice_prefix,
                                    'city' => $request->city,
                                    'zip_code' => $request->zip_code,
                                    'country' => $request->country,
                                    'postal_address' => $request->postal_address,
                                    'bank_details' => $request->bank_details,
                                    'default_company' => $request->default_company,
                                    'mail_from_email' => $request->mail_from_email,
                                    'mail_from_name' => $request->mail_from_name,
                                ]);

        if($updateCompanyDetails)
        {
            $keyValues = [];

            if($request->has('logo'))
            {
                $updateCompanyLogo = $updateCompanyDetails->addMediaFromRequest('logo')->toMediaCollection('logo');

                if($updateCompanyLogo)
                {
                    $updateCompanyDetails->update([
                        'logo' => $updateCompanyDetails->getFirstMediaUrl('logo'),
                    ]);
                }
            }

            if($request->has('icon'))
            {
                $updateCompanyicon = $updateCompanyDetails->addMediaFromRequest('icon')->toMediaCollection('icon');
                if($updateCompanyicon)
                {
                    $updateCompanyDetails->update([
                        'icon' => $updateCompanyDetails->getFirstMediaUrl('icon'),
                    ]);
                }
            }

            if($request->default_company)
            {
                $keyValues['APP_ICON'] = $updateCompanyDetails->icon;
                $keyValues['APP_LOGO'] = $updateCompanyDetails->logo;
                $keyValues['APP_NAME'] = str_replace(' ', '-', $updateCompanyDetails->company_name);
                $keyValues['MAIL_FROM_ADDRESS'] = $updateCompanyDetails->mail_from_email;
                $keyValues['MAIL_FROM_NAME'] = str_replace(' ', '-', $updateCompanyDetails->mail_from_name);

                if($old_default_company = Company::whereDefaultCompany(1)->where('id', '!=', $updateCompanyDetails->id)->first())
                {
                    $update_default_company = $old_default_company->update(['default_company' => 0]);
                }

                if($this->setEnvironmentValue($keyValues))
                {
                    $this->refreshApp();

                    if($request->test_mail) {
                        Mail::to($request->test_mail_address)
                            ->send(new CompanyDetailsMail($updateCompanyDetails));
                    }
                }
            }

            return response(['status' => 'success', 'message' => 'Company details updated successfully.']);
        }

        return response(['status' => 'error', 'message' => 'Oops! Something went wrong.']);
    }

    public function setEnvironmentValue($keyValues)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str .= "\n"; // In case the searched variable is in the last line without \n

        if (count($keyValues) > 0) {
            foreach ($keyValues as $envKey => $envValue) {
                // If key does not exist, add it
                if (!$oldValue = env($envKey)) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }

    public function refreshApp()
    {
        $configClear = Artisan::call('config:clear');
        // $cacheClear = Artisan::call('cache:clear');
        // $routeClear = Artisan::call('route:cache');
        // $viewClear = Artisan::call('view:cache');
        return true; //Return anything
    }

    public function getSettings()
    {
        return $company = Company::first();
    }


}

<?php

namespace App\Observers;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyObserver
{
    /**
     * Handle the Company "deleting" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function deleting(Company $company)
    {
        if(!is_null($company->logo)) {
            //check if file exists
            if (Storage::disk('public')->exists($company->logo)) {
                //delete the file
                Storage::disk('public')->delete($company->logo);
            }
        }
    }


    /**
     * Handle the Company "updating" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function updating(Company $company)
    {
        //check if logo has been changed
        if($company->isDirty('logo')) {
            $originalFile = $company->getOriginal('logo');
            if (Storage::disk('public')->exists($originalFile)) {
                //delete the file
                Storage::disk('public')->delete($originalFile);
            }
        }
    }
}

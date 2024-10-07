<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Support\Facades\App;


trait LanguageTrait
{
    protected $languageUrl;

    public function setLanguageUrl()
    {
        $locale = App::getLocale();

        if ($locale === 'ar') {
            $this->languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json';
        } else {
            $this->languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json';
        }
    }

    public function getLanguageUrl()
    {
        return $this->languageUrl;
    }

}
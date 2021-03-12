<?php

namespace Dawnstar\Api\Http\Controllers;

use Dawnstar\Models\Language;
use Dawnstar\Models\Website;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->setWebsite();
        $this->setLanguage();
    }

    private function setWebsite()
    {
        $parsedUrl = parse_url(request()->fullUrl());

        $domain = $parsedUrl["host"] = str_replace("www.", "", $parsedUrl["host"]);
        $domainArray = [$domain, "www.".$domain];

        $website = Website::whereIn('slug', $domainArray)->first();

        if(is_null($website)) {
            dd("There is no website"); // TODO: Check later
        }
        dawnstar()->website = $website;
    }

    private function setLanguage()
    {
        $language = null;
        $languageCode = strip_tags(request('language'));

        if($languageCode) {
            $language = Language::where('code', request('language'))->first();
        }

        if(is_null($language)) {
            $language = dawnstar()->website->defaultLanguage();
        }

        dawnstar()->language = $language;
    }

}

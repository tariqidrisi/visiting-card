<?php

namespace App\Http\Controllers;
use JeroenDesloovere\VCard\VCard;

use App\Models\Company;
use App\Models\CompanyVideo;
use App\Models\CutomerInformation;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FrontendController extends Controller
{
    public function profile(Request $request, Response $response, $profile) {

        $data = [];

        $data['company'] = Company::where('company', $profile)->get()->toArray();
        $company_id = $data['company'][0]['id'];

        $data['info'] = CutomerInformation::where('company_id', $company_id)->get()->toArray();
        $data['social_media'] = SocialMedia::where('company_id', $company_id)->get()->toArray();;
        $data['video'] = CompanyVideo::where('company_id', $company_id)->get()->toArray();;

//        dd($data['company']);

        return view('frontend/theme-1/profile',compact(
            'data'
        ));
    }

    public function downloadVcf(Request $request, Response $response, $id) {
        $vcard = new VCard();
        $company = Company::where('id', $id)->get()->toArray();
        $info = CutomerInformation::where('company_id', $id)->get()->toArray();
        $media = SocialMedia::where('company_id', $id)->get()->toArray();

//        dd($company);

// define variables
        $lastname = $info[0]['owner'];
        $firstname = '';
        $additional = '';
        $prefix = '';
        $suffix = '';

// add personal data
        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

// add work data
        $vcard->addCompany($company[0]['company']);
        $vcard->addJobtitle('Owner');
//        $vcard->addRole('Data Protection Officer');
        $vcard->addEmail($info[0]['email']);
        $vcard->addPhoneNumber($info[0]['contact'], 'PREF;WORK');
//        $vcard->addPhoneNumber(123456789, 'WORK');
//        $vcard->addAddress(null, null, 'street', 'worktown', null, 'workpostcode', 'Belgium');
//        $vcard->addLabel('street, worktown, workpostcode Belgium');
        $vcard->addURL($media[0]['website']);

//        $vcard->addPhoto(__DIR__ . '/landscape.jpeg');

// return vcard as a string
//return $vcard->getOutput();

// return vcard as a download
        return $vcard->download();
    }

}

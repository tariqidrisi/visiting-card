<?php

namespace App\Http\Controllers;
use App\Models\CompanyLogo;
use JeroenDesloovere\VCard\VCard;

use App\Models\Company;
use App\Models\CompanyVideo;
use App\Models\CutomerInformation;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function profile(Request $request, Response $response, $profile) {

        $data = [];

        $data['company'] = Company::where('company', $profile)->get()->toArray();
        $company_id = $data['company'][0]['id'];

        $data['info'] = CutomerInformation::where('company_id', $company_id)->get()->toArray();
        $data['social_media'] = SocialMedia::where('company_id', $company_id)->get()->toArray();;
        $data['video'] = CompanyVideo::where('company_id', $company_id)->get()->toArray();;

//        dd($data['company'][0]['theme']);

        // fetch logo from AWS bucket
        $filename = CompanyLogo::where('company_id', $company_id)->pluck('img_path')->toArray();
//        dd($filename[0]);
        $key = 'images/'.$filename[0];
        $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();
        $bucket = env('AWS_BUCKET');

        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $key
        ]);
        $request = $client->createPresignedRequest($command, '+20 minutes');
        $presignedUrl = (string)$request->getUri();


        // theme selection
        if ($data['company'][0]['theme'] == '1') {
            $theme = 'theme-1';
        } else {
            $theme = 'theme-2';
        }

        return view('frontend/'.$theme.'/profile',compact(
            'data', 'presignedUrl'
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

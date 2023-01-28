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

        $data['company'] = Company::where('username', $profile)->get()->toArray();
        $company_id = $data['company'][0]['id'];

        $data['info'] = CutomerInformation::where('company_id', $company_id)->get()->toArray();
        $data['social_media'] = SocialMedia::where('company_id', $company_id)->get()->toArray();;
        $data['video'] = CompanyVideo::where('company_id', $company_id)->get()->toArray();;

//        dd($data['company'][0]['theme']);

        // fetch logo from AWS bucket
        $filename = CompanyLogo::where('company_id', $company_id)->select('img_path', 'qr_path')->get();
//        dd($filename[0]['qr_path']);
        if ($filename[0]['img_path']) {
            $presignedUrl = $this->fetchAWSImage('images/'.$filename[0]['img_path']);
        } else {
            $presignedUrl = '';
        }
        if ($filename[0]['qr_path']) {
            $qrUrl = $this->fetchAWSImage('qr-codes/'.$filename[0]['qr_path']);
        } else {
            $qrUrl = "";
        }

        // theme selection
        if ($data['company'][0]['theme'] == '1') {
            $theme = 'theme-1';
        } else {
            $theme = 'theme-2';
        }

        return view('frontend/'.$theme.'/profile',compact(
            'data', 'presignedUrl', 'qrUrl'
        ));
    }

    public function fetchAWSImage($key) {
        $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();
        $bucket = env('AWS_BUCKET');

        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $key
        ]);
        $request = $client->createPresignedRequest($command, '+20 minutes');
        return (string)$request->getUri();
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

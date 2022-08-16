<?php

namespace App\Http\Controllers;

use App\Models\CompanyVideo;
use App\Models\CutomerInformation;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Company;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request, Response $response) {

        $totalCustomer = Company::withTrashed()->count();
        $activeCustomer = Company::whereNull('deleted_at')->get()->count();
        $inActiveCustomer = Company::onlyTrashed()->count();

        return view('backend/dashboard', compact(
            'totalCustomer', 'activeCustomer', 'inActiveCustomer'
        ));
    }

    public function company(Request $request, Response $response) {

        $data = Company::all();

        return view('backend/company', compact(
            'data'
        ));
    }

    public function newCompany(Request $request, Response $response) {
        return view('backend/new-company');
    }

    public function createCompany(Request $request, Response $response) {
//        dd($request->all());

        $array = [
            '_token' => $request->input('_token'),
            'company' => trim(preg_replace('/\s+/', '-', strtolower($request->input('company')))),
            'theme' => $request->input('theme'),
            'desc' => trim($request->input('desc')),

        ];

        $saved = Company::create($array);

        if(!$saved){
            Alert::error('Error', 'Failed!');
        } else {
            Alert::success('Success', 'Data saved successfully');
        }

        return back()->withInput();


    }

    public function ajaxUpdateCompany(Request $request)
    {
//        dd($request->all());
        if($request->ajax()){
            Company::find($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
            return response()->json(['success' => true]);
        }
    }

    public function viewCompany(Request $request, $id)
    {
        $update = Company::find($id);

        return view('backend/new-company', compact(
            'update'
        ));

    }

    public function viewCustomer(Request $request, $id)
    {
        $update = CutomerInformation::find($id);
        $companies = Company::all();
        $old_Vals = $update->closed;
//        dd($old_Vals);
        return view('backend/new-customer-info', compact(
            'update', 'companies', 'old_Vals'
        ));

    }

    public function updateCompany(Request $request, $id)
    {
        $update = Company::find($id);

        if(!is_null($update)){
            $update->company = trim(preg_replace('/\s+/', '-', $request->input('company')));
            $update->theme = trim($request->input('theme'));
            $update->desc = trim($request->input('desc'));
            $update->save();
            Alert::success('Success', 'Data updated successfully');
        }else{
            Alert::error('Error', 'Failed!');
        }

        return view('backend/new-company', compact(
            'update'
        ));

    }

    public function updateCustomer(Request $request, $id)
    {
        $update = CutomerInformation::find($id);
        $companies = Company::all();
        $old_Vals = $update->closed;

        if(!is_null($update)){
            $update->company_id = trim($request->input('company_id'));
            $update->owner = trim($request->input('owner'));
            $update->email = trim($request->input('email'));
            $update->contact = trim($request->input('contact'));
            $update->address = trim($request->input('address'));
            $update->opening_hours = trim($request->input('opening_hours'));
            $update->from_day = trim($request->input('from_day'));
            $update->to_day = trim($request->input('to_day'));
            $update->from_time = trim($request->input('from_time'));
            $update->to_time = trim($request->input('to_time'));
            $update->closed = $request->input('closed');
            $update->save();
            Alert::success('Success', 'Data updated successfully');
        }else{
            Alert::error('Error', 'Failed!');
        }

        return view('backend/new-customer-info', compact(
            'update', 'companies', 'old_Vals'
        ));

    }

    public function customerInfo(Request $request, Response $response) {
        $data = CutomerInformation::with("company")->get();
//        dd($data);

        return view('backend/cutomer-info', compact(
            'data'
        ));
    }

    public function newCustomerInfo(Request $request, Response $response) {
        $companies = Company::all();
        return view('backend/new-customer-info', compact('companies'));
    }

    public function ajaxUpdateCustomer(Request $request)
    {
//        dd($request->all());
        if($request->ajax()){
            CutomerInformation::find($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
            return response()->json(['success' => true]);
        }
    }

    public function createCustomerInfo(Request $request, Response $response) {
//        dd($request->all());

        $saved = CutomerInformation::create($request->all());

        if(!$saved){
            Alert::error('Error', 'Failed!');
        } else {
            Alert::success('Success', 'Data saved successfully');
        }

        return back()->withInput();
    }

    public function destroy(Request $request, Response $response, $id) {
//        dd($id);
        $deleteCo = Company::find($id);
        $deleteCo->delete();

        $deleteCustomerInfo = CutomerInformation::where("company_id", $id);
        $deleteCustomerInfo->delete();

        if(!$deleteCo || !$deleteCustomerInfo){

            Company::withTrashed()->find($id)->restore();
            CutomerInformation::withTrashed()->where("company_id",$id)->restore();

            Alert::error('Error', 'Failed!');
        } else {
            Alert::success('Success', 'Data deleted successfully');
        }

        return redirect()->back();
    }

    public function socialMedia(Request $request, Response $response) {

        $companies = Company::all();
        $data = '';

//        dd($data[0]->website);

        return view('backend/social-media', compact(
            'companies', 'data'
        ));
    }

    public function ajxSocialMedia(Request $request, Response $response, $id) {
//        dd($id);
        $companies = Company::all();
        $result = SocialMedia::where('company_id', $id)->get()->toArray();;

//dd($result[0]);

        if (!empty($result)) {
            // check empty or null fields
            $array = [
                "website" => $result[0]['website'],
                "facebook" => $result[0]['facebook'],
                "instagram" => $result[0]['instagram'],
                "whatsapp" => $result[0]['whatsapp'],
                "linkedin" => $result[0]['linkedin'],
                "twitter" => $result[0]['twitter'],
                "youtube" => $result[0]['youtube'],
                "email" => $result[0]['email'],
                "portfolio" => $result[0]['portfolio'],
                "pricing" => $result[0]['pricing'],
            ];

            foreach ($array as $key => $value) {
                if ($value) {
                    $data[$key] = $value;
                }
            }
        } else {
            $data = [];
        }

//        dd($data);

        return view('backend/social-media',[
            'companies' => $companies,
            'data' => $data,
            'id' => $id
        ]);
    }

    public function companySocialMedia(Request $request, Response $response) {

//        dd($request->all());
        $id = SocialMedia::where(['company_id'=> $request->Input("company_id")])->get()->toArray();
//        dd($id);
        if (!empty($id)) {

            $array = [
                'company_id' => $request->Input("company_id"),
                'website' => $request->Input("website"),
                'facebook' => $request->Input("facebook"),
                'instagram' => $request->Input("instagram"),
                'whatsapp' => $request->Input("whatsapp"),
                'linkedin' => $request->Input("linkedin"),
                'twitter' => $request->Input("twitter"),
                'youtube' => $request->Input("youtube"),
                'email' => $request->Input("email"),
                'portfolio' => $request->Input("portfolio"),
                'pricing' => $request->Input("pricing"),
            ];

//            dd($array);

            $social = SocialMedia::where('company_id', $request->Input("company_id"))
                ->update([
                    'company_id' => $request->Input("company_id"),
                    'website' => $request->Input("website"),
                    'facebook' => $request->Input("facebook"),
                    'instagram' => $request->Input("instagram"),
                    'whatsapp' => $request->Input("whatsapp"),
                    'linkedin' => $request->Input("linkedin"),
                    'twitter' => $request->Input("twitter"),
                    'youtube' => $request->Input("youtube"),
                    'email' => $request->Input("email"),
                    'portfolio' => $request->Input("portfolio"),
                    'pricing' => $request->Input("pricing"),
                ]);
            $message = "Data updated successfully";

        } else {
            $social = new SocialMedia();
            $social->company_id = $request->Input("company_id");
            $social->website = $request->Input("website");
            $social->facebook = $request->Input("facebook");
            $social->instagram = $request->Input("instagram");
            $social->whatsapp = $request->Input("whatsapp");
            $social->linkedin = $request->Input("linkedin");
            $social->twitter = $request->Input("twitter");
            $social->youtube = $request->Input("youtube");
            $social->email = $request->Input("email");
            $social->portfolio = $request->Input("portfolio");
            $social->pricing = $request->Input("pricing");
            $social->save();

            $message = "Data saved successfully";
        }


        if(!$social){
            Alert::error('Error', 'Failed!');
        } else {
            Alert::success('Success', $message);
        }

        return back()->withInput();

    }

    public function embedVideo(Request $request, Response $response) {

        $companies = Company::all();
        $data = '';

//        dd($data);

        return view('backend/embed-video', compact(
            'companies', 'data'
        ));
    }

    public function saveVideo(Request $request, Response $response) {

//        dd($request->all());
        $id = CompanyVideo::where(['company_id'=> $request->Input("company_id")])->get()->toArray();

        $array = [
            'company_id' => $request->Input("company_id"),
            'video_link' => $request->Input("video_link"),
        ];

//        dd($id);
        if (!empty($id)) {


//            dd($array);

            $company = CompanyVideo::where('company_id', $request->Input("company_id"))
                ->update([
                    'company_id' => $request->Input("company_id"),
                    'video_link' => $request->Input("video_link"),
                ]);
            $message = "Data updated successfully";

        } else {
            $company = new CompanyVideo();
            $company->company_id = $request->Input("company_id");
            $company->video_link = $request->Input("video_link");
            $company->save();

            $message = "Data saved successfully";
        }


        if(!$company){
            Alert::error('Error', 'Failed!');
        } else {
            Alert::success('Success', $message);
        }

        return back()->withInput();

    }

    public function ajaxEmbedVideo(Request $request, Response $response, $id) {
//        dd($id);
        $companies = Company::all();
        $data = CompanyVideo::where('company_id', $id)->get()->toArray();

//        dd($data);

//dd($result[0]);
//        dd($data);

        return view('backend/embed-video',compact(
            'companies', 'data', 'id'
        ));
    }

}

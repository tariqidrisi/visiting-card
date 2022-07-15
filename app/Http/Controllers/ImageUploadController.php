<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyLogo;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        $companies = Company::all();

        return view('backend/image-upload', compact('companies'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $path = Storage::disk('s3')->put('images', $request->image);
        $path = Storage::disk('s3')->url($path);

//        dd($path);

        /* Store $imageName name in DATABASE from HERE */

        $id = CompanyLogo::where(['company_id'=> $request->Input("company_id")])->get()->toArray();
//        dd($id);
        if (!empty($id)) {

            $array = [
                'company_id' => $request->Input("company_id"),
                'img_path' => $path,
            ];

//            dd($array);

            $logo = CompanyLogo::where('company_id', $request->Input("company_id"))
                ->update([
                    'company_id' => $request->Input("company_id"),
                    'img_path' => $path,
                ]);
            $message = "Data updated successfully";

        } else {
            $logo = new CompanyLogo();
            $logo->company_id = $request->Input("company_id");
            $logo->img_path = $path;
            $logo->save();

            $message = "Data saved successfully";
        }


        if(!$logo){
            Alert::error('Error', 'Failed!');
        } else {
            Alert::success('Success', $message);
        }

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image', $path);
    }
}

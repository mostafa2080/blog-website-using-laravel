<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Carbon;
use Image;


class ServiceController extends Controller
{
    public function AllServices()
    {
        $allservices = Service::latest()->get();
        return view('admin.service.all_services', compact('allservices'));
    } //end methid

    public function AddService()
    {
        return view('admin.service.add_service');
    }

    public function StoreService(Request $request)
    {

        $image = $request->file('service_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // 3434343443.jpg

        Image::make($image)->resize(323, 240)->save('upload/service/' . $name_gen);
        $save_url = 'upload/service/' . $name_gen;

        Service::insert([
            'service_title' => $request->service_title,
            'service_header' => $request->service_header,
            'service_short_description' => $request->service_short_description,
            'service_list' => $request->service_list,
            'service_image' => $save_url,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.services')->with($notification);
    } // End Method
    public function EditService($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.service.edit_service', compact('service'));
    } // End Method
}

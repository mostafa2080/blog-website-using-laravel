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
            'message' => 'Service Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.services')->with($notification);
    } // End Method
    public function EditService($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.service.edit_service', compact('service'));
    } // End Method

    public function UpdateService(Request $request)
    {

        $service_id = $request->id;

        if ($request->file('service_image')) {
            $image = $request->file('service_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(323, 240)->save('upload/service/' . $name_gen);
            $save_url = 'upload/service/' . $name_gen;

            Service::findOrFail($service_id)->update([
                'service_title' => $request->service_title,
                'service_header' => $request->service_header,
                'service_short_description' => $request->service_short_description,
                'service_list' => $request->service_list,
                'service_image' => $save_url,

            ]);
            $notification = array(
                'message' => 'Service Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.services')->with($notification);
        } else {

            Service::findOrFail($service_id)->update([
                'service_title' => $request->service_title,
                'service_header' => $request->service_header,
                'service_short_description' => $request->service_short_description,
                'service_list' => $request->service_list,

            ]);

            $notification = array(
                'message' => 'Service Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.services')->with($notification);
        } // end Else

    } // End Method

    public function HomeServices()
    {
        $services = Service::latest()->get();
        return view('frontend.services', compact('services'));
    }
}

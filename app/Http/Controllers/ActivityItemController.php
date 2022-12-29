<?php

namespace App\Http\Controllers;

use App\Models\ActivityItem;
use App\Models\ActivityType;

use Illuminate\Http\Request;
use Session;

class ActivityItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function Access()
    {
        if (Session::get('role') == 'crewmember') {
            return true;
        }
    }

    public function UploadSingleImage($img, $path)
    {
        // return  $img;
        if (isset($img)) {
            $name  = uniqid() . $img->getClientOriginalName();
            $extension  = $img->getClientOriginalExtension();
            $arr = array('jpg', 'png', 'jpeg', 'PNG', 'JPEG', 'JPG', 'TIFF');
            if (in_array($extension, $arr)) {

                $save_path       = public_path($path);
                $url = $img->move($save_path, $name);
                return $name;
            } else {
                return 'File Extension Error';
            }
        } else {
            return 'Image Found Empty';
        }
    }


    public function index()
    {
        if ($this->Access()) {
            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }

        $items = ActivityItem::all()->toArray();
        // dd($items);
        if (!empty($items)) {
            return view('/pages/activity-items', compact('items'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagetitle = "Activity Item Create";

        if (Session::has('role') && Session::get('role') == 'crewmember') {
            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }
        $activitytypes = ActivityType::all();

        return view('pages/activity-items-create')->with('pagetitle', $pagetitle)->with("activitytypes",$activitytypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());


        $this->validate(request(), [
            'activityname' => 'required',
            'activitytype' => 'required',
            'activitycapacity' => 'required',
            'minimumcrew' => 'required',
            'rgbcolor' => 'required',
            'activitypicture' => 'required'
        ]);

        if ($request->has('activitypicture')) {
            //path will be after choosing any directory inside public folder
            $path =  $this->UploadSingleImage($request->file('activitypicture'), 'assets/activity-images');
        } else {

            $path = NULL;
        }

        $data = array(
            "activityname" => $request->activityname,
            "activitytype" => $request->activitytype,
            "activitycapacity" => $request->activitycapacity,
            "minimumcrew" => $request->minimumcrew,
            "rgbcolor" => $request->rgbcolor,
            "activitypicture" => $path
        );

        $result = ActivityItem::create($data);
        if (isset($result->id)) {
            return redirect('/activity-items')->with(['status' => true, 'msg' => 'Success ! Activity Added']);
        } else {
            return redirect('/activity-items')->with(['status' => false, 'msg' => 'Erorr ! Activity Failed']);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityItem  $activityItem
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityItem $activityItem)
    {
        $items = ActivityItem::all();
        if (!empty($items)) {
            //  return view('/pages/activity-items',compact('items'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityItem  $activityItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activitytypes = ActivityType::all();

        // dd($activitytypes);
        $items = ActivityItem::findorFail($id);
        if (!empty($items)) {
            return view('pages/activity-items-edit')->with('items', $items)->with('activitytypes',$activitytypes);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActivityItem  $activityItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityItem $activityItem)
    {
        // dd($request->all());

        $this->validate(request(), [
            'activityname' => 'required',
            'activitytype' => 'required',
            'activitycapacity' => 'required',
            'minimumcrew' => 'required',
            'rgbcolor' => 'required',
        ]);

        if ($request->has('activitypicture')) {
            //path will be after choosing any directory inside public folder
            $path =  $this->UploadSingleImage($request->file('activitypicture'), 'assets/activity-images');
            if ($path == 'File Extension Error' || $path == 'Image Found Empty') {
                return redirect()->back()->withErrors(['image' => 'Please Select a Suitable Image']);
            }
        } else {

            $image = $activityItem->Where('id', $request->update_id)->get();
            // dd($image[0]->activitypicture);

            if (!empty($image) && isset($image[0]->activitypicture)) {
                $path = $image[0]->activitypicture;
            } else {
                $path = NULL;
            }
        }

        $data = array(
            "activityname" => $request->activityname,
            "activitytype" => $request->activitytype,
            "activitycapacity" => $request->activitycapacity,
            "minimumcrew" => $request->minimumcrew,
            "rgbcolor" => $request->rgbcolor,
            "activitypicture" => $path
        );

        $result = $activityItem->Where('id', $request->update_id)->update($data);

        if ($result) {
            return redirect('/activity-items')->with(['status' => true, 'msg' => 'Success ! Activity Updded']);
        } else {
            return redirect('/activity-items')->with(['status' => false, 'msg' => 'Erorr ! Activity Update Failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityItem  $activityItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityItem $activityItem)
    {
        //
    }
}

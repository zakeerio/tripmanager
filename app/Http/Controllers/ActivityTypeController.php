<?php

namespace App\Http\Controllers;

// Import Models

use App\Models\{ActivityType, ActivityItem };

use Illuminate\Http\Request;


class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagetitle = "Activity Type";

        $types = ActivityType::all();
        return view('pages/activity-types')->with('types', $types)->with('pagetitle', $pagetitle);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(), [
            'type_name' => 'required'
        ]);

        $add = ActivityType::CREATE(['type_name' => $request->type_name]);

        if (isset($add->id) && $add->id != 0) {
            //dd($add->id);
            return redirect()->back()->with(['status' => true, 'msg' => 'Success ! Type Added']);
        } else {
            return redirect()->back()->with(['status' => false, 'msg' => 'Failed ! Type Adding Failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityType $activityType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pagetitle = "Edit Activity Item";
        $cat = ActivityType::where('id', $id)->get();

        if ($cat->isNotEmpty()) {

            return view('pages/activity-type-edit')->with('cat', $cat)->with('pagetitle', $pagetitle);
        } else {
            return redirect()->back()->with(['status' => false, 'msg' => 'Error ! Someting Went Wrong']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityType $activityType)
    {
        $this->validate(request(), [
            'type_name' => 'required'
        ]);

        if (!isset($request->type_name)) {
            return redirect()->back()->with(['status' => false, 'msg' => 'Error ! Type Name Can Not Be Empty']);
        }
        $update = ActivityType::where('id', $request->update_id)->update(['type_name' => $request->type_name]);

        if ($update) {
            return redirect('/activity-types')->with(['status' => true, 'msg' => 'Success ! Type Name Update']);
        } else {
            return redirect()->back()->with(['status' => false, 'msg' => 'Error ! Someting Went Wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $files = ActivityItem::where('activitytype', $id)->get();

        if ($files->isNotEmpty()) {
            return redirect()->back()->with(['status' => false, 'msg' => 'This Contains Data']);
        } else {
            $delete =  ActivityType::where('id', $id)->delete();
            return redirect()->back()->with(['status' => true, 'msg' => 'Success ! Deleted Activity type. ']);
        }
    }
}

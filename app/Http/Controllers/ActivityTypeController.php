<?php

namespace App\Http\Controllers;

use App\Models\ActivityType;
use Illuminate\Http\Request;

use App\Models\ActivityItem;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = ActivityType::all();
        return view('pages/activity-types')->with('types', $types);
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
        $cat = ActivityType::where('id', $id)->get();

        if ($cat->isNotEmpty()) {

            return view('pages/activity-type-edit')->with('cat', $cat);
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
        if (!isset($request->type_name)) {
            return redirect()->back()->with(['status' => false, 'msg' => 'Error ! Type Name Can Not Be Empty']);
        }
        $update = ActivityType::where('id', $request->update_id)->update(['type_name' => $request->type_name]);

        if ($update) {
            return redirect()->back()->with(['status' => true, 'msg' => 'Success ! Type Name Update']);
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
            return redirect()->back()->with(['status' => true, 'msg' => 'Success ! Deleted ']);
        }
    }
}

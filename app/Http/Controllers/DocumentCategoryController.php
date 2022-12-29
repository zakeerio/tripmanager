<?php

namespace App\Http\Controllers;

use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use App\Models\Documents;

class DocumentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/document-category-create');
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
        // $this->validate(request(), [
        //     'doc_name' => 'required',
        // ]);

        $add = DocumentCategory::CREATE(['name' => $request->doc_name]);

        if (isset($add->id) && $add->id != 0) {
            //dd($add->id);
            return redirect('/create-document-category')->with(['status' => true, 'msg' => 'Success ! Category Added']);
        } else {
            return redirect('/create-document-category')->with(['status' => false, 'msg' => 'Failed ! Category Added Failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentCategory  $documentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentCategory $documentCategory)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentCategory  $documentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = DocumentCategory::where('id', $id)->get();

        if ($cat->isNotEmpty()) {

            return view('pages/document-category-edit')->with('cat', $cat);
        } else {
            return redirect()->with(['status' => false, 'msg' => 'Error ! Someting Went Wrong']);
        }

        // dd($cat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentCategory  $documentCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentCategory $documentCategory)
    {
        // dd($request->all());

        if (!isset($request->doc_name)) {
            return redirect()->back()->with(['status' => false, 'msg' => 'Error ! Category Name Can Not Be Empty']);
        }
        $update = DocumentCategory::where('id', $request->update_id)->update(['name' => $request->doc_name]);

        if ($update) {
            return redirect('pages/activity-types')->with(['status' => true, 'msg' => 'Success ! Category Name Update']);
        } else {
            return redirect()->back()->with(['status' => false, 'msg' => 'Error ! Someting Went Wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentCategory  $documentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);



        $files = Documents::where('category_id', $id)->get();

        if ($files->isNotEmpty()) {
            return redirect()->back()->with(['status' => false, 'msg' => 'Category Contains Data']);
        } else {
            $delete = DocumentCategory::where('id', $id)->delete();
            return redirect()->back()->with(['status' => true, 'msg' => 'Success ! Category Deleted ']);
        }

        // dd();


    }
}

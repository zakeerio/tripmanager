<?php

namespace App\Http\Controllers;

use App\Models\DocumentCategory;
use Illuminate\Http\Request;

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
    public function edit(DocumentCategory $documentCategory)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentCategory  $documentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentCategory $documentCategory)
    {
        //
    }
}

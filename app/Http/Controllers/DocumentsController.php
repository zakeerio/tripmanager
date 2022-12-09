<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use DB;
use League\CommonMark\Node\Block\Document;
use Response;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $insert;
    public $uploaded_files;
    public function index()
    {



        $files = DocumentCategory::with('GetFiles')->get();


        // foreach ($files as $f) {
        //     echo $f->name . "<br>";
        //     //echo $f->file_name;

        //     foreach ($f->GetFiles as $t) {
        //         echo $t->file_name . "<br>";
        //     }
        // }

        return view('pages/documents', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function download($file)
    {

        //echo $file;
        $path = public_path() . "/assets/documents/" . $file;
        if (file_exists($path)) {
            return Response::download($path);
        } else {
            return redirect()->back()->with(['status' => false, 'msg' => 'File Does Not Exist']);
        }
        //  dd($path);

    }
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

    public function UploadMultipleFiles($files, $path)
    {

        if (!empty($files)) {

            $arr = array();
            foreach ($files as $file) {

                foreach ($file as $f) {
                    $name  = uniqid() . '@_@' . $f->getClientOriginalName();
                    if (str_contains($name, ' ')) {

                        for ($i = 0; isset($name[$i]); $i++) {
                            if ($name[$i] == " ") {
                                $name[$i] = "_";
                            }
                        }
                    }

                    $extension  = $f->getClientOriginalExtension();
                    // $f->store('public/product_images', $f->getClientOriginalName());


                    if (
                        $extension == 'pdf' || $extension == 'xls' || $extension == 'txt'
                        ||  $extension == 'docx' || $extension == 'jpg'
                        || $extension == 'png' || $extension == 'jpeg'
                        || $extension == 'PNG'
                    ) {

                        $path_to_save       =  public_path($path);
                        $f->move($path_to_save, $name);
                        $arr[] = $name;
                    } else {
                        return 'File Not Allowed';
                    }
                }
            }
            return $arr;
        } else {
            return 'File Not Found';
        }
    }
    public function store(Request $request, $id)
    {  // dd($id);
        // dd($request->all());

        if (!$request->has('files')) {
            return redirect()->back()->with(['status' => false, 'msg' => 'Select a File']);
        }

        try {

            DB::transaction(function () use ($request, $id) {

                if ($request->has('files')) {
                    //dd($request->files);
                    $this->uploaded_files = $this->UploadMultipleFiles($request->files, '/assets/documents');

                    if (!empty($this->uploaded_files) && is_array($this->uploaded_files)) {

                        foreach ($this->uploaded_files as $f) {
                            $result = Documents::CREATE([
                                'category_id' => $id,
                                'file_name' => $f
                            ]);

                            $this->insert = $result;
                        }
                    }
                }
            });



            if ($this->uploaded_files == 'File Not Allowed' || $this->uploaded_files == 'File Not Found') {
                return redirect()->back()->with(['status' => false, 'msg' => 'Select a Suitable  File']);
            }

            if ($this->insert && !empty($this->uploaded_files) && is_array($this->uploaded_files)) {
                return redirect('/documents')->with(['status' => true, 'msg' => 'Success ! File Uploaded']);
            } else {
                return redirect('/documents')->with(['status' => false, 'msg' => 'Failed ! File Upload Failed']);
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect('/documents')->with(['status' => false, 'msg' => 'Contact Your Developer']);
        }

        // dd($move);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function show(Documents $documents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function edit(Documents $documents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documents $documents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documents $documents, $id)
    {
        //
        try {
            $file = Documents::findOrFail($id);

            if (!empty($file)) {
                if (isset($file->file_name)) {
                    $path = public_path() . "/assets/documents/" . $file->file_name;
                    if (file_exists($path)) {
                        unlink($path);
                    }

                    $d = Documents::whereId($id)->delete();
                    //  dd($d);
                    return redirect()->back()->with(['status' => true, 'msg' => 'Success ! File Deleted']);
                } else {
                    return redirect()->back()->with(['status' => true, 'msg' => 'Success ! File Deleted']);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => true, 'msg' => 'Success ! File Deleted']);

            //  dd($e->getMessage());

        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\HearingDate;
use App\Models\Upload;
use App\Traits\ImageStore;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FileController extends Controller
{
    use ImageStore;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Cases::with('allFiles')->findOrFail(request()->case);
        return view('case.file.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $case_id = request()->case;
        Cases::findOrFail($case_id);
        $date_id = request()->date;
        if ($date_id){
           HearingDate::findOrFail($date_id);
        }

        return view('file.create', compact('date_id', 'case_id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $case = Cases::find(request()->case);
        if (!$case){
            throw ValidationException::withMessages(['message' => __('common.Something Went Wrong')]);
        }
        $goto = route('file.index', ['case' => $case->id]);

        $date_id = request()->date;
        if ($date_id){
            $date = HearingDate::find($date_id);
            if (!$date){
                throw ValidationException::withMessages(['message' => __('common.Something Went Wrong')]);
            }
            $goto = route('case.show', $case->id);
        }

        $validate_rules =  [
            'file.*' => 'sometimes|nullable|mimes:jpg,bmp,png,doc,docx,pdf,jpeg,txt',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        if ($request->file){
            foreach($request->file as $file){
                $this->storeFile($file, $case->id, $date_id);
            }
        }

        $response = [
            'goto' => $goto,
            'message' => __('common.Successfully Updated'),
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = Upload::where('uuid', $id)->firstOrFail();
        return view('file.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = Upload::where('uuid', $id)->firstOrFail();
        return view('file.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate_rules =  [
            'file.*' => 'sometimes|nullable|mimes:jpg,bmp,png,doc,docx,pdf,jpeg,txt',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        $file = Upload::where('uuid', $id)->first();
        if (!$file){
            throw ValidationException::withMessages(['file' => __('common.Something Went Wrong')]);
        }
        if ($request->has('file')){
            $this->updateFile($request->file, $file);
        }

        return response()->json(['message' => __('common.Successfully Updated'), 'goto' => route('case.show', $file->case_id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = Upload::where('uuid', $id)->first();
        if (!$file){
            throw ValidationException::withMessages(['message' => __('common.Something Went Wrong')]);
        }
        if (\Illuminate\Support\Facades\File::exists($file->filepath)){
            \Illuminate\Support\Facades\File::delete($file->filepath);
        }
        $case_id = $file->case_id;
        $file->delete();
        return response()->json(['message' => __('common.Successfully deleted'), 'goto' => route('case.show', $case_id)]);
    }
}

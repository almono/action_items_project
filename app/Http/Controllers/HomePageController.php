<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Validator;
use DB;

use App\Action;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actions = Action::orderBy('id','ASC')->get();
        return view('welcome', compact('actions'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $action = Action::findOrFail($id);
        try {
            $action->status = "done";
            $action->save();
        }
        catch(Exception $e) {
            dd($e);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadJson(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seed_file' => 'required|file'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            //dd($errors);
            return redirect('/')->withErrors($errors);
        }
        else {
            DB::beginTransaction();
            $file = (file_get_contents(Input::file('seed_file')));
            $objects = json_decode($file);

            foreach($objects as $o) {
                try {
                    $input = [
                        'id' => $o->id,
                        'description' => $o->descr,
                        'status' => 'new',
                    ];

                    Action::create($input);
                }
                catch (Exception $e) {
                    DB::rollback();
                    dd($e);
                }
            }
            DB::commit();
            return back();
        }
    }

    public function uploadFile(Request $request)
    {
        $action_item = Action::findOrFail($request->get("action_id"));

        // If by some chance file for that action already exists, delete it
        if(Storage::exists("photos/" . $action_item->filepath))
        {
            Storage::delete('photos/' . $action_item->filepath);
        }

        $messages = [
            'mimes' => 'The ::attribute must have type of jpg, png or jpeg!',
            'size' => 'The :attribute must be less than :size KB.'
        ];

        $validator = Validator::make($request->all(), [
            'action_file' => 'required|file|mimes:jpg,png,jpeg|max:2048'
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect('/')->withErrors($errors);
        }
        else {
            DB::beginTransaction();

            try {
                Storage::putFileAs('photos', $request->file('action_file'), $action_item->id . "-photo.jpg");
                $action_item->filepath = $action_item->id . "-photo.jpg";
                $action_item->status = "completed";
                $action_item->save();
            }
            catch (Exception $e) {
                DB::rollback();
                dd($e);
            }

            DB::commit();
            return back();
        }
    }

    public function downloadFile($id)
    {
        $action = Action::findOrFail($id);
        if(Storage::exists("photos/" . $action->filepath))
        {
            return Storage::download("photos/" . $action->filepath);
        }
        else {
            return back();
        }
    }
}

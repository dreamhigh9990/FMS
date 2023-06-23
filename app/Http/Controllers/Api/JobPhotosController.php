<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job_photos;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class JobPhotosController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        for($i=0; $i<count($request->photos); $i++){
                $file = $request->photos[$i];
                $fileName = time().'_'.$file->getClientOriginalName();
                $destinationPath = 'uploads';
                $file->move($destinationPath,$fileName);

                $job_photo = new Job_photos();
                $job_photo->job_id = $request->job_id;
                $job_photo->driver_id = auth()->user()->id;
                $job_photo->file = $fileName;
                $job_photo->save();

        }
        return response()->json(['status'=>true,'message' => 'photos inserted succesfully'], 200);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}

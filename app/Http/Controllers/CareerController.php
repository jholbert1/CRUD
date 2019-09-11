<?php

namespace App\Http\Controllers;

use App\Model\Career;
use Illuminate\Http\Request;
use Validator;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Career::all();
        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // return $data;
        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Verifique los campos',
                'data' => $validator,
            ]);
        };
        $carrear = Career::create($data);

        return response()->json([
            'message' => 'Registro Exitoso',
            'data' => $carrear,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $career = Career::where('id',$id)->update($request->all());

        return response()->json([
            'message' => 'Registro Exitoso',
            'data' => $career,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Career::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Eliminado Exitosamente',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Model\Student;
use Illuminate\Http\Request;
use Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Student::all();
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
            'last_name' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'email' => 'required|email',
            'county' => 'required',
            'city' => 'required',
            'state' => 'required',
            'career' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Verifique los campos',
                'data' => $validator,
            ]);
        };
        $student = Student::create($data);

        return response()->json([
            'message' => 'Registro Exitoso',
            'data' => $student,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $student = Student::where('id',$id)->update($request->all());

        return response()->json([
            'message' => 'Registro Exitoso',
            'data' => $student,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Eliminado Exitosamente',
        ]);
    }
}

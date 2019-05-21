<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\Students as StudentCollection;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->query('includes') === 'classroom'){
            $student = Student::with('classroom')->get();
        }else{
            $student = Student::paginate(1);
        }

        return (new StudentCollection($student))
                    ->response()
                    ->setStatuscode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        return Student::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
        //return Student::findOrFail($id);

        /*
        $student = Student::find($id);

        if($student){
            return response()->json($student, Response::HTTP_FOUND);
        }
        return response()->json([
            "erros" => [
                [
                    "status" => 404,
                    "code" => "01",
                    "message" => "O recurso nao foi encontrado"
                ]
            ]
        ], Response::HTTP_NOT_FOUND);
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->all());

        return [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return [];
    }
}

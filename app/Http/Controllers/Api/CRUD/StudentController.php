<?php

namespace App\Http\Controllers\Api\CRUD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('get') === 'all') {
            $students = Student::with(['user' => function ($query) {
                $query->where('profile_type', '=', Student::class);
            }])->get();

            return response()->json(compact('students'));

        } else {
            $students = Student::with(['subject', 'group', 'user' => function ($query) {
                $query->where('profile_type', '=', Student::class);
            }])->paginate(5);

            $response = [
                'pagination' => [
                    'total' => $students->total(),
                    'per_page' => $students->perPage(),
                    'current_page' => $students->currentPage(),
                    'last_page' => $students->lastPage(),
                    'from' => $students->firstItem(),
                    'to' => $students->lastItem(),
                ],
                'students' => $students
            ];

            return response()->json($response);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response('Ответ на создание ресурса', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student = $student::with('subject', 'group', 'user')->findOrFail($student->id);
        return response()->json(compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        return response('Ответ на обновление', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $deleteItem = Student::findOrFail($student->id);
        if ($deleteItem) {
            $deleteItem->delete();
        } else {
            return response('error', 404);
        }
    }
}

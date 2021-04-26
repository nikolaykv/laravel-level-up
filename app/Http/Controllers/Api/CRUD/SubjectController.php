<?php

namespace App\Http\Controllers\Api\CRUD;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use Carbon\Carbon;
use App\Http\Requests\CRUD\Subject\SubjectFormRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subjects = Subject::with('student')->paginate(5);

        $response = [
            'pagination' => [
                'total' => $subjects->total(),
                'per_page' => $subjects->perPage(),
                'current_page' => $subjects->currentPage(),
                'last_page' => $subjects->lastPage(),
                'from' => $subjects->firstItem(),
                'to' => $subjects->lastItem(),
            ],
            'subjects' => $subjects
        ];

        return response()->json($response);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subject = [
            "id" => $subject->id,
            "name" => $subject->name,
            "student_full_name" => User::find($subject->student_id)->full_name,
            "value" => $subject->value,
            "created_at" => Carbon::parse($subject->created_at)->format('Y-m-d H:m'),
            "updated_at" => Carbon::parse($subject->updated_at)->format('Y-m-d H:m')
        ];

        return response()->json(compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\CRUD\Subject $request
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectFormRequest $request, Subject $subject)
    {
        $updateItem = Subject::findOrFail($subject->id);
        $studentData = explode(' ', $request->student);

        $name = $studentData[0];
        if (count($studentData) < 2) {
            $surname = ' ';
        } else {
            $surname = $studentData[1];
        }

        if ($updateItem) {
            // Валидация входящих данных формы
            $validator = $request->validated();
            // Поиск связанной модели
            $student = User::find($subject->student_id);
            // Обновить информацию об учебном предмете
            $updateItem->update($request->all('name', 'value'));

            // Обновить связанную модель
            $student->update(array(
                'name' => $name,
                'surname' => $surname,
            ));

            return response()->json($validator);
        } else {
            return response('Not Found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $deleteItem = Subject::findOrFail($subject->id);
        if ($deleteItem) {
            $deleteItem->delete();
        } else {
            return response('error', 404);
        }
    }
}

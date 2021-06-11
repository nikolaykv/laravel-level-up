<?php

namespace App\Http\Controllers\Api\CRUD;

use App\Http\Requests\CRUD\Subject\SubjectFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('get') === 'all') {
            return response()->json(Subject::all());
        } else {
            $subjects = Subject::with('student.user')->paginate(5);

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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CRUD\Subject $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectFormRequest $request)
    {
         $validator = $request->validated();
         return response()->json($validator);


        /*  $studentData = explode(' ', $request->student);

          $name = $studentData[0];
          if (count($studentData) < 2) {
              $surname = ' ';
          } else {
              $surname = $studentData[1];
          }

          $validator = $request->validated();

          // Создать нового студента
          $student = Student::create([
              'group_id' => $request->group_id,
          ]);

          // Создаём нового пользователя
          $student->user()->create(
              [
                  'name' => $name,
                  'surname' => $surname,
                  'profile_id' => $student->id,
                  'profile_type' => App\Models\Student::class
              ]
          );

          // Создаём новый учебный предмет
          $student->subject()->save(
              new Subject([
                  'name' => $request->name,
                  'value' => $request->value,
                  'student_id' => $student->id
              ])
          );

          return response()->json($validator);*/
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subject = $subject::with('student.user')->findOrFail($subject->id);
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

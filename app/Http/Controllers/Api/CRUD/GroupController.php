<?php

namespace App\Http\Controllers\Api\CRUD;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();

        if (count($groups) > 0) {
            return response()->json(compact('groups'));
        } else {
            return response('Нет данных', 204);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return response()->json(compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $updateItem = Group::findOrFail($group->id);
        if ($updateItem) {

            // Да, запихал проверку сюда, ради одного поля нет смысла юзать FormRequest
            $rules = [
                'name' => ['required', 'string', 'max:20'],
            ];
            $messages = [
                'name.required' => 'Поле должно быть заполнено!',
                'name.string' => 'Поле должно быть строкой!',
                'name.max:20' => 'Поле не должно быть длиннее 20 символов!'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response([
                    'message' => $validator->errors()->first()
                ]);
            } else {
                $updateItem->update($request->all('name'));
                return response([
                    'success' => true,
                    'message' => 'Успешно обновлено!',
                    'name' => $updateItem->name
                ]);
            }
        } else {
            return response('Нет данных', 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}

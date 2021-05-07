<?php

namespace App\Http\Controllers\Api\CRUD;

use App\Http\Requests\CRUD\Group\NewNameFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Group;
use App\Models\User;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with(['students.user' => function ($query) {
            $query->where('profile_type', '=', Student::class);
        }])->paginate(5);

        $response = [
            'pagination' => [
                'total' => $groups->total(),
                'per_page' => $groups->perPage(),
                'current_page' => $groups->currentPage(),
                'last_page' => $groups->lastPage(),
                'from' => $groups->firstItem(),
                'to' => $groups->lastItem(),
            ],
            'groups' => $groups
        ];

        return response()->json($response);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewNameFormRequest $request)
    {
        // TODO нужно дать возможность создавать группы без привязки студентов
        $validator = $request->validated();
        $users = array();
        foreach ($request->students as $student) {
            $userData = explode(' ', $student);
            array_push($users, User::where('name', '=', $userData[0])
                ->where('surname', '=', $userData[1])
                ->get());
        }
        $group = Group::create($request->all());

        foreach ($users as $user) {
            Student::where('id', '=', $user[0]->profile_id)
                ->update(['group_id' => $group->id]);
        }
        return response()->json($validator);
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
     * @param \App\Http\Requests\CRUD\Group $request
     * @param \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(NewNameFormRequest $request, Group $group)
    {
        $updateItem = Group::findOrFail($group->id);
        if ($updateItem) {
            $validator = $request->validated();
            $updateItem->update($request->all('name'));
            return response()->json($validator);
        } else {
            return response('Not Found', 404);
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
        $deleteItem = Group::findOrFail($group->id);
        if ($deleteItem) {
            $deleteItem->delete();
        } else {
            return response('error', 404);
        }
    }
}

<?php

namespace App\Http\Controllers\Api\CRUD;

use App\Http\Requests\CRUD\Group\StoreGroupRequest;
use App\Http\Requests\CRUD\Group\UpdateGroupRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Group;
use App\Models\User;
use App\Helpers\Main;

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
     * @param \App\Http\Requests\CRUD\Group\StoreGroupRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        $validator = $request->validated();
        if ($request->get('students')[0] === 'false') {
            Group::create($request->all());
        } else {
            $users = Main::getStudentsByFullName($request->students);
            $group = Group::create($request->all());
            foreach ($users as $user) {
                Student::where('id', '=', $user[0]->profile_id)
                    ->update(['group_id' => $group->id]);
            }
        }
        return response()->json($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Group $group)
    {
        if ($request->input('action') === 'edit') {
            $group = $group->students()->get();
            $group->map(function ($item) {
                $item->user = User::where('id', '=', $item->id)
                    ->where('profile_type', '=', Student::class)->get();
            });
            return response()->json(compact('group'));
        } else {
            return response()->json(compact('group'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\CRUD\Group\UpdateGroupRequest $request
     * @param \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        if (Group::findOrFail($group->id)) {
            $validator = $request->validated();
            if ($request->get('students')[0] === 'false') {
                $group->update($request->all('name'));
            } else {
                $users = Main::getStudentsByFullName($request->students);
                $group->update($request->all('name'));

                foreach ($users as $user) {
                    Student::where('id', '=', $user[0]->profile_id)
                        ->update(['group_id' => $group->id]);
                }
            }
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

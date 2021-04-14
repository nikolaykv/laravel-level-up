<?php

namespace App\Http\Controllers\Api\CRUD;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Requests\CRUD\Group\NewNameFormRequest;

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
        //
    }
}

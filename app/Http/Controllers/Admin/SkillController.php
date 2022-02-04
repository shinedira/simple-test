<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SkillRequest;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:view', 'can:read'])->only(['index']);
        $this->middleware('can:add')->only(['create', 'store']);
        $this->middleware('can:update')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::filter()->paginate(10);

        return view('admin.pages.skill.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->form(new Skill());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillRequest $request)
    {
        $skill = new Skill($request->validated());

        return $this->save($request, $skill, trans('page.store-success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        return $this->form($skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SkillRequest $request, Skill $skill)
    {
        $skill = $skill->fill($request->validated());

        return $this->save($request, $skill, trans('page.update-success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response()->json([
            'message'  => trans('page.delete-success'),
            'redirect' => route('admin.skill.index')
        ]);
    }

    /**
     * Undocumented function
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Skill $skill
     * @param [type] $message
     *
     * @return void
     */
    private function save(Request $request, Skill $skill, $message)
    {
        $skill->save();

        return response()->json([
            'message'  => $message,
            'redirect' => route('admin.skill.index')
        ]);
    }

    /**
     * Undocumented function
     *
     * @param \App\Models\Skill $model
     *
     * @return void
     */
    private function form(Skill $model)
    {
        return view('admin.pages.skill.form', compact('model'));
    }
}

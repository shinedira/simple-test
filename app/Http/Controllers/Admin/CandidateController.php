<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CandidateRequest;
use App\Http\Resources\Admin\CandidateResource;
use App\Models\File;
use App\Service\UploadTrait;

class CandidateController extends Controller
{
    use UploadTrait;

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
    public function index(Request $request)
    {
        $candidates = Candidate::with(['skills', 'file'])
                        ->filter();

        if ($request->expectsJson()) {
            $candidates = $candidates->get();

            return CandidateResource::collection($candidates);
        }

        
        $candidates = $candidates->paginate(10);

        return view('admin.pages.candidate.index', compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->form(new Candidate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateRequest $request)
    {
        $candidate = new Candidate($request->validated());

        return $this->save($request, $candidate, trans('page.store-success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        $candidate->load('skills', 'file');

        return $this->form($candidate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CandidateRequest $request, Candidate $candidate)
    {
        $candidate = $candidate->fill($request->validated());

        return $this->save($request, $candidate, trans('page.update-success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Candidate $candidate)
    {
        $candidate->delete();

        if ($request->expectsJson()) {
            return response()->json(['data' => new \stdClass]);
        }

        return response()->json([
            'message'  => trans('page.delete-success'),
            'redirect' => route('admin.candidate.index')
        ]);
    }

    private function save(Request $request, Candidate $candidate, String $message)
    {
        DB::beginTransaction();
        try {
            // save candidate
            $candidate->save();

            //save skills candiate
            $candidate->skills()->sync($request->skills);

            //save file
            if ($request->hasFile('file')) {
                $upload = $this->upload($request, $candidate);

                $file   = File::firstOrNew([
                    'fileable_type' => Candidate::class,
                    'fileable_id'   => $candidate->id
                ]);

                $file->name = $upload;

                $candidate->file()->save($file);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }

        if ($request->expectsJson()) {
            return response()->json(['data' => new \stdClass]);
        }

        return redirect()
            ->route('admin.candidate.index')
            ->with('success', $message);
    }

    private function form(Candidate $model)
    {
        $skills = Skill::get()->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });

        return view('admin.pages.candidate.form', compact('model', 'skills'));
    }
}

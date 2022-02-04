<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hrd;
use Illuminate\Http\Request;

class HrdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hrds = Hrd::with('roles')
                    ->filter()
                    ->paginate(10);

        return view('admin.pages.hrd.index', compact('hrds'));
    }
}

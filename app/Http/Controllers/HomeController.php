<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $counts = $data = DB::select("SELECT 
            (SELECT COUNT(*) FROM tasks where status = 'Pending' AND user_id = " . auth()->user()->id . " AND deleted_at IS NULL) as pending,
            (SELECT COUNT(*) FROM tasks where status = 'On Hold' AND user_id = " . auth()->user()->id . " AND deleted_at IS NULL) as on_hold,
            (SELECT COUNT(*) FROM tasks where status = 'In Progress' AND user_id = " . auth()->user()->id . " AND deleted_at IS NULL) as in_progress,
            (SELECT COUNT(*) FROM tasks where status = 'To Review' AND user_id = " . auth()->user()->id . " AND deleted_at IS NULL) as to_review,
            (SELECT COUNT(*) FROM tasks where status = 'In Testing' AND user_id = " . auth()->user()->id . " AND deleted_at IS NULL) as in_testing,
            (SELECT COUNT(*) FROM tasks where status = 'Completed' AND user_id = " . auth()->user()->id . " AND deleted_at IS NULL) as completed
        ");

        $data['counts'] = collect($counts)->first();

        return view('home', $data);
    }
}

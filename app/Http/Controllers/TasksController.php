<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Task;

class TasksController extends Controller
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
        $data['reporters'] = User::select('id', 'firstname', 'lastname')->where('type', 'Reporter')->orderBy('firstname', 'asc')->get();

        return view('tasks', $data);
    }

    public function getList(Request $request)
    {
        if ($request->ajax()) {

            $data = Task::join('users', 'users.id', '=', 'tasks.reporter_id')
            ->select('tasks.*', 'users.firstname', 'users.lastname')
            ->whereNull('deleted_at')
            ->where('tasks.user_id', auth()->user()->id);
            return Datatables::of($data)
                ->order(function ($query) use ($request) {
                    if ($request->order[0]['column'] == 5) {
                        $query->orderBy('created_at', $request->order[0]['dir']);
                        $query->orderBy('id', $request->order[0]['dir']);
                    } else {
                        $query->orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);
                    }
                })
                ->editColumn('created_at', function($data){
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d M Y h:i A');
                    return $formatedDate;
                })
                ->editColumn('updated_at', function($data){
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)->format('d M Y h:i A');
                    return $formatedDate;
                })
                ->escapeColumns('description')
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'reporter_id' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);
 
        if ($validator->fails()) {

            session()->flash('error', 'Invalid inputs!');

            return redirect('/tasks')->withErrors($validator)->withInput();

        }

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'user_id' => auth()->user()->id,
            'reporter_id' => $request->reporter_id,
            'status' => $request->status,
        ]);

        if(!empty($task->id)) {

            session()->flash('success', 'Task created successfully.');

        } else {

            session()->flash('error', 'Something went wrong!');

        }

        return redirect('/tasks');
    }

    public function destroy($id)
    {
        $isDeleted = Task::where('id', '=', $id)->where('user_id', auth()->user()->id)->delete();

        if(!empty($isDeleted)) {

            session()->flash('success', 'Task deleted successfully.');

        } else {

            session()->flash('error', 'Something went wrong!');

        }

        return redirect('/tasks');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'reporter_id' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);
 
        if ($validator->fails()) {

            session()->flash('error', 'Invalid inputs!');

            return redirect('/tasks')->withErrors($validator)->withInput();

        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'reporter_id' => $request->reporter_id,
            'status' => $request->status,
        ];

        $isUpdated = Task::where(['id' => $id])->update($data);

        if(!empty($isUpdated)) {

            session()->flash('success', 'Task updated successfully.');

        } else {

            session()->flash('error', 'Something went wrong!');

        }

        return redirect('/tasks');
    }

    public function view(Request $request, $id) {

        $data['task'] = Task::join('users', 'users.id', '=', 'tasks.reporter_id')
        ->select('tasks.*', 'users.firstname', 'users.lastname')
        ->whereNull('deleted_at')
        ->where('tasks.id', $id)
        ->where('tasks.user_id', auth()->user()->id)
        ->whereNull('tasks.deleted_at')
        ->first();

        return view('task-details', $data);

    }

    public function getTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer']
        ]);
 
        if ($validator->fails()) {

            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);

        }

        $data = Task::join('users', 'users.id', '=', 'tasks.reporter_id')
        ->select('tasks.*', 'users.firstname', 'users.lastname')
        ->whereNull('deleted_at')
        ->where('tasks.id', $request->id)
        ->where('tasks.user_id', auth()->user()->id)
        ->whereNull('tasks.deleted_at')
        ->first();

        return response()->json([
            'message' => 'Task data fetched successfully.',
            'data' => $data
        ], 200);
    }
}

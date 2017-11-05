<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Role;
use App\Models\Admin\Task as Task;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    protected $fields = [
        'name'  => '',
        'content' => '',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $data['recordsTotal'] = Task::count();
            if (strlen($search['value']) > 0) {
                $data['recordsFiltered'] = Task::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('content', 'like', '%' . $search['value'] . '%');
                })->count();
                $data['data'] = Task::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('content', 'like', '%' . $search['value'] . '%');
                })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            } else {
                $data['recordsFiltered'] = Task::count();
                $data['data'] = Task::
                skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            }

            return response()->json($data);
        }

        return view('admin.task.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }


        return view('admin.task.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\TaskCreateRequest $request)
    {
        $task = new Task();
        foreach (array_keys($this->fields) as $field) {
            $task->$field = $request->get($field);
        }

        $task->save();

        event(new \App\Events\userActionEvent('\App\Models\Admin\Task', $task->id, 1, '添加了任务中心' . $task->name));

        return redirect('/admin/task')->withSuccess('添加成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find((int)$id);
        if (!$task) return redirect('/admin/task')->withErrors("找不到该任务!");

        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $task->$field);
        }

        $data['id'] = (int)$id;
        event(new \App\Events\userActionEvent('\App\Models\Admin\Task', $task->id, 3, '编辑了任务中心' . $task->name));

        return view('admin.task.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\TaskUpdateRequest $request, $id)
    {
        $task = Task::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $task->$field = $request->get($field);
        }
      

        $task->save();

        return redirect('/admin/task')->withSuccess('添加成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Task::find((int)$id);

        if ($tag) {
            $tag->delete();
        } else {
            return redirect()->back()
                ->withErrors("删除失败");
        }

        return redirect()->back()
            ->withSuccess("删除成功");
    }
}

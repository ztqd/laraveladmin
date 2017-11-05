<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Role;
use App\Models\Admin\Target as Target;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TargetCreateRequest;
use App\Http\Requests\TargetUpdateRequest;
use App\Http\Controllers\Controller;

class TargetController extends Controller
{
    protected $fields = [
        'type'  => '',
		'name'  => '',
		'area'  => '',
		'memo'  => '',
		'address'  => '',
		'lon'  => '',
		'lat'  => '',
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
            $data['recordsTotal'] = Target::count();
            if (strlen($search['value']) > 0) {
                $data['recordsFiltered'] = Target::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('content', 'like', '%' . $search['value'] . '%');
                })->count();
                $data['data'] = Target::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('content', 'like', '%' . $search['value'] . '%');
                })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            } else {
                $data['recordsFiltered'] = Target::count();
                $data['data'] = Target::
                skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            }

            return response()->json($data);
        }

        return view('admin.target.index');
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


        return view('admin.target.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\TargetCreateRequest $request)
    {
        $target = new Target();
        foreach (array_keys($this->fields) as $field) {
            $target->$field = $request->get($field);
        }

        $target->save();

        event(new \App\Events\userActionEvent('\App\Models\Admin\Target', $target->id, 1, '添加了任务中心' . $target->name));

        return redirect('/admin/target')->withSuccess('添加成功！');
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
        $target = Target::find((int)$id);
        if (!$target) return redirect('/admin/target')->withErrors("找不到该任务!");

        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $target->$field);
        }

        $data['id'] = (int)$id;
        event(new \App\Events\userActionEvent('\App\Models\Admin\Target', $target->id, 3, '编辑了任务中心' . $target->name));

        return view('admin.target.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\TargetUpdateRequest $request, $id)
    {
        $target = Target::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $target->$field = $request->get($field);
        }
      

        $target->save();

        return redirect('/admin/target')->withSuccess('添加成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Target::find((int)$id);

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

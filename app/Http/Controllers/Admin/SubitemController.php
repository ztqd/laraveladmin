<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Role;
use App\Models\Admin\Subitem as Subitem;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SubitemCreateRequest;
use App\Http\Requests\SubitemUpdateRequest;
use App\Http\Controllers\Controller;

class SubitemController extends Controller
{
    protected $fields = [
        'type'  => '',
        'content' => '',
        'sort' => '',
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
            $data['recordsTotal'] = Subitem::count();
            if (strlen($search['value']) > 0) {
                $data['recordsFiltered'] = Subitem::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('content', 'like', '%' . $search['value'] . '%');
                })->count();
                $data['data'] = Subitem::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('content', 'like', '%' . $search['value'] . '%');
                })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            } else {
                $data['recordsFiltered'] = Subitem::count();
                $data['data'] = Subitem::
                skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            }

            return response()->json($data);
        }

        return view('admin.subitem.index');
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


        return view('admin.subitem.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\SubitemCreateRequest $request)
    {
        $subitem = new Subitem();
        foreach (array_keys($this->fields) as $field) {
            $subitem->$field = $request->get($field);
        }

        $subitem->save();

        event(new \App\Events\userActionEvent('\App\Models\Admin\Subitem', $subitem->id, 1, '添加了任务中心' . $subitem->name));

        return redirect('/admin/subitem')->withSuccess('添加成功！');
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
        $subitem = Subitem::find((int)$id);
        if (!$subitem) return redirect('/admin/subitem')->withErrors("找不到该任务!");

        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $subitem->$field);
        }

        $data['id'] = (int)$id;
        event(new \App\Events\userActionEvent('\App\Models\Admin\Subitem', $subitem->id, 3, '编辑了任务中心' . $subitem->name));

        return view('admin.subitem.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\SubitemUpdateRequest $request, $id)
    {
        $subitem = Subitem::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $subitem->$field = $request->get($field);
        }
      

        $subitem->save();

        return redirect('/admin/subitem')->withSuccess('添加成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Subitem::find((int)$id);

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

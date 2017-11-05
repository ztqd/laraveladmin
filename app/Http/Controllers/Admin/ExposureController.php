<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Role;
use App\Models\Admin\Exposure as Exposure;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ExposureCreateRequest;
use App\Http\Requests\ExposureUpdateRequest;
use App\Http\Controllers\Controller;

class ExposureController extends Controller
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
            $data['recordsTotal'] = Exposure::count();
            if (strlen($search['value']) > 0) {
                $data['recordsFiltered'] = Exposure::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('content', 'like', '%' . $search['value'] . '%');
                })->count();
                $data['data'] = Exposure::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('content', 'like', '%' . $search['value'] . '%');
                })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            } else {
                $data['recordsFiltered'] = Exposure::count();
                $data['data'] = Exposure::
                skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            }

            return response()->json($data);
        }

        return view('admin.exposure.index');
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


        return view('admin.exposure.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ExposureCreateRequest $request)
    {
        $exposure = new Exposure();
        foreach (array_keys($this->fields) as $field) {
            $exposure->$field = $request->get($field);
        }

        $exposure->save();

        event(new \App\Events\userActionEvent('\App\Models\Admin\Exposure', $exposure->id, 1, '添加了任务中心' . $exposure->name));

        return redirect('/admin/exposure')->withSuccess('添加成功！');
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
        $exposure = Exposure::find((int)$id);
        if (!$exposure) return redirect('/admin/exposure')->withErrors("找不到该任务!");

        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $exposure->$field);
        }

        $data['id'] = (int)$id;
        event(new \App\Events\userActionEvent('\App\Models\Admin\Exposure', $exposure->id, 3, '编辑了任务中心' . $exposure->name));

        return view('admin.exposure.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ExposureUpdateRequest $request, $id)
    {
        $exposure = Exposure::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $exposure->$field = $request->get($field);
        }
      

        $exposure->save();

        return redirect('/admin/exposure')->withSuccess('添加成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Exposure::find((int)$id);

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

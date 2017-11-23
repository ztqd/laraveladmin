<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Role;
use App\Models\Admin\Check as Check;
use App\Models\Admin\Subitem as Subitem;
use App\Models\Admin\Target as Target;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CheckCreateRequest;
use App\Http\Requests\CheckUpdateRequest;
use App\Http\Controllers\Controller;


class CheckController extends Controller
{
    protected $fields = [
        'id' => '',
        'type' => '',
        'area' => '',
        'name' => '',
        'checkcontent' => '',
        'memo' => '',
        'starlevel' => '',
        'checkusername' => '',
        'checkuserid' => '0',
        'inspectionname' => '',
        'checktime' => '',

    ];
    protected $feedbackfields = [

        'status' => '2',
        'feedback' => '',
        'feedbacktime' => '',
        'feedbackuser' => '',
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
            $data['recordsTotal'] = Check::count();


            if (auth('admin')->user()->hasRole('areaadmin')) {
                $area = auth('admin')->user()->area;
                if (strlen($search['value']) > 0) {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $area) {
                        $query->where('area', $area)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $area) {
                        $query->where('area', $area)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                } else {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($area) {
                        $query->where('area', $area);
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($area) {
                        $query->where('area', $area);
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                }
            } else {
                if (strlen($search['value']) > 0) {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                } else {
                    $data['recordsFiltered'] = Check::count();
                    $data['data'] = Check::
                    skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                }
            }


            return response()->json($data);
        }

        return view('admin.check.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index1(Request $request)
    {
        $type = 1;
        if ($request->ajax()) {
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $data['recordsTotal'] = Check::count();


            if (auth('admin')->user()->hasRole('areaadmin')) {
                $area = auth('admin')->user()->area;
                if (strlen($search['value']) > 0) {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $area, $type) {
                        $query->where('type', $type)->where('area', $area)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $area, $type) {
                        $query->where('type', $type)->where('area', $area)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                } else {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($area, $type) {
                        $query->where('type', $type)->where('area', $area);
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($area, $type) {
                        $query->where('type', $type)->where('area', $area);
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                }
            } else {
                if (strlen($search['value']) > 0) {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                } else {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type);
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type);
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                }
            }


            return response()->json($data);
        }
        $data['type'] = $type;

        return view('admin.check.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index2(Request $request)
    {
        $type = 2;
        if ($request->ajax()) {
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $data['recordsTotal'] = Check::count();


            if (auth('admin')->user()->hasRole('areaadmin')) {
                $area = auth('admin')->user()->area;
                if (strlen($search['value']) > 0) {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $area, $type) {
                        $query->where('type', $type)->where('area', $area)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $area, $type) {
                        $query->where('type', $type)->where('area', $area)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                } else {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($area, $type) {
                        $query->where('type', $type)->where('area', $area);
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($area, $type) {
                        $query->where('type', $type)->where('area', $area);
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                }
            } else {
                if (strlen($search['value']) > 0) {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                } else {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($type) {
                        $query->where('type', $type);
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($type) {
                        $query->where('type', $type);
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                }
            }


            return response()->json($data);
        }
        $data['type'] = $type;

        return view('admin.check.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index3(Request $request)
    {
        $type = 3;

        if ($request->ajax()) {
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $data['recordsTotal'] = Check::count();


            if (auth('admin')->user()->hasRole('areaadmin')) {
                $area = auth('admin')->user()->area;
                if (strlen($search['value']) > 0) {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $area, $type) {
                        $query->where('type', $type)->where('area', $area)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $area, $type) {
                        $query->where('type', $type)->where('area', $area)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                } else {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($area, $type) {
                        $query->where('type', $type)->where('area', $area);
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($area, $type) {
                        $query->where('type', $type)->where('area', $area);
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                }
            } else {
                if (strlen($search['value']) > 0) {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                } else {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type);
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type);
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                }
            }


            return response()->json($data);
        }
        $data['type'] = $type;

        return view('admin.check.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index4(Request $request)
    {
        $type = 4;
        if ($request->ajax()) {
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $data['recordsTotal'] = Check::count();


            if (auth('admin')->user()->hasRole('areaadmin')) {
                $area = auth('admin')->user()->area;
                if (strlen($search['value']) > 0) {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $area, $type) {
                        $query->where('type', $type)->where('area', $area)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $area, $type) {
                        $query->where('type', $type)->where('area', $area)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                } else {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($area, $type) {
                        $query->where('type', $type)->where('area', $area);
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($area, $type) {
                        $query->where('type', $type)->where('area', $area);
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                }
            } else {
                if (strlen($search['value']) > 0) {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type)->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('content', 'like', '%' . $search['value'] . '%');
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                } else {
                    $data['recordsFiltered'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type);
                    })->count();
                    $data['data'] = Check::where(function ($query) use ($search, $type) {
                        $query->where('type', $type);
                    })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
                }
            }


            return response()->json($data);
        }
        $data['type'] = $type;

        return view('admin.check.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function feedbackindex(Request $request)
    {

        if ($request->ajax()) {
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');

            $data['recordsTotal'] = Check::count();
			$c = count($columns);
			$data['c'] =$c;
            unset($wherearray);
            for ($i = 0, $c = count($columns); $i < $c; $i++) {
                if ($i != 8 && $columns[$i]['searchable'] == "true" && $columns[$i]['search']['value'] != '') {
                    $column_name = $columns[$i]['data'];
                    $wherearray[$columns[$i]['data']] = $columns[$i]['search']['value'];

					$data['c'] = $data['c'].$columns[$i]['data'].$columns[$i]['search']['value'];
					 

                }
            }
			

            $date = "";
            if ($columns[8]['searchable'] == "true" && $columns[8]['search']['value'] != '') {
                $date = $columns[8]['search']['value'];
            }

            if (auth('admin')->user()->hasRole('areaadmin')) {
                $area = auth('admin')->user()->area;
            } else {
                $area = "";
            }
            if (isset($wherearray)) {
				$data['wherearray']=implode(',',$wherearray);
                $data['recordsFiltered'] = Check::where($wherearray)
                    ->where(function ($query) use ($search) {
                    if (strlen($search['value']) > 0) {
                        $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('memo', 'like', '%' . $search['value'] . '%');
                    }
                })->where(function ($query) use ($area) {
                    if ($area != "") {
                        $query->where('area', $area);
                    }
                })->where(function ($query) use ($date) {
                    if (!empty($date)) {

                        list($date_start, $date_end) = explode(':', $date);
                        $query->where('checktime', ">", "$date_start")
                            ->where('checktime', "<", "$date_end");
                    }
                })->count();
                $data['data'] = Check::where($wherearray)
                    ->where(function ($query) use ($search) {
                    if (strlen($search['value']) > 0) {
                        $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('memo', 'like', '%' . $search['value'] . '%');
                    }
                })->where(function ($query) use ($area) {
                    if ($area != "") {
                        $query->where('area', $area);
                    }
                })->where(function ($query) use ($date) {
                    if (!empty($date)) {

                        list($date_start, $date_end) = explode(':', $date);
                        $query->where('checktime', ">", "$date_start")
                            ->where('checktime', "<", "$date_end");
                    }
                })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
                $data['sql'] = Check::where($wherearray)
                    ->where(function ($query) use ($search) {
                        if (strlen($search['value']) > 0) {
                            $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                                ->orWhere('memo', 'like', '%' . $search['value'] . '%');
                        }
                    })->where(function ($query) use ($area) {
                        if ($area != "") {
                            $query->where('area', $area);
                        }
                    })->where(function ($query) use ($date) {
                        if (!empty($date)) {

                            list($date_start, $date_end) = explode(':', $date);
                            $query->where('checktime', ">", "$date_start")
                                ->where('checktime', "<", "$date_end");
                        }
                    })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->toSql();
            } else {
                $data['recordsFiltered'] = Check::where(function ($query) use ($search) {
                    if (strlen($search['value']) > 0) {
                        $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('memo', 'like', '%' . $search['value'] . '%');
                    }
                })->where(function ($query) use ($area) {
                    if ($area != "") {
                        $query->where('area', $area);
                    }
                })->where(function ($query) use ($date) {
                    if (!empty($date)) {

                        list($date_start, $date_end) = explode(':', $date);
                        $query->where('checktime', ">", "$date_start")
                            ->where('checktime', "<", "$date_end");
                    }
                })->count();
                $data['data'] = Check::where(function ($query) use ($search) {
                    if (strlen($search['value']) > 0) {
                        $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                            ->orWhere('memo', 'like', '%' . $search['value'] . '%');
                    }
                })->where(function ($query) use ($area) {
                    if ($area != "") {
                        $query->where('area', $area);
                    }
                })->where(function ($query) use ($date) {
                    if (!empty($date)) {
                        list($date_start, $date_end) = explode(':', $date);
                        $query->where('checktime', ">", "$date_start")
                            ->where('checktime', "<", "$date_end");
                    }
                })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
                $data['sql'] = Check::where(function ($query) use ($search) {
                        if (strlen($search['value']) > 0) {
                            $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                                ->orWhere('memo', 'like', '%' . $search['value'] . '%');
                        }
                    })->where(function ($query) use ($area) {
                        if ($area != "") {
                            $query->where('area', $area);
                        }
                    })->where(function ($query) use ($date) {
                        if (!empty($date)) {

                            list($date_start, $date_end) = explode(':', $date);
                            $query->where('checktime', ">", "$date_start")
                                ->where('checktime', "<", "$date_end");
                        }
                    })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->toSql();
            }


            return response()->json($data);
        }
        return view('admin.check.feedbackindex');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [];
        $type = $request->get('type');

        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $data['subitem'] = Subitem::where('type', $type)
            ->orderBy('sort', 'asc')
            ->get();


        $targets = Target::where('type', $type)
            ->orderBy('id', 'asc')
            ->get();
        $data['target']['请选择县区']['请选择'] = "";
        foreach ($targets as $target) {
            $data['target'][$target->area][] = $target->name;
        }
        $data['type'] = $type;

        return view("admin.check.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CheckCreateRequest $request)
    {
        $check = new Check();
        foreach (array_keys($this->fields) as $field) {
            $check->$field = $request->get($field);
        }
        $type = $request->get('type');
        $check->checkuserid = auth('admin')->user()->id;
        $check->save();

        event(new \App\Events\userActionEvent('\App\Models\Admin\Check', $check->id, 1, '添加了任务中心' . $check->name));

        return redirect("/admin/check$type/index")->withSuccess('添加成功！');
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
        $check = Check::find((int)$id);
        if (!$check) return redirect('/admin/check')->withErrors("找不到该记录!");

        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $check->$field);
        }

        $data['id'] = (int)$id;
        event(new \App\Events\userActionEvent('\App\Models\Admin\Check', $check->id, 3, '编辑了记录中心' . $check->name));

        return view('admin.check.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function feedback($id)
    {
        $check = Check::find((int)$id);
        if (!$check) return redirect('/admin/check')->withErrors("找不到该记录!");

        foreach (array_keys($this->feedbackfields) as $field) {
            $data[$field] = old($field, $check->$field);
        }

        $data['id'] = (int)$id;
        event(new \App\Events\userActionEvent('\App\Models\Admin\Check', $check->id, 3, '编辑了记录中心' . $check->name));

        return view('admin.check.feedback', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CheckUpdateRequest $request, $id)
    {
        $check = Check::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $check->$field = $request->get($field);
        }

        $check->save();

        return redirect('/admin/check')->withSuccess('反馈成功！');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function feedbacksave(Request $request, $id)
    {
        $check = Check::find((int)$id);
        foreach (array_keys($this->feedbackfields) as $field) {
            $check->$field = $request->get($field);
        }
        $check->feedbackuser = auth('admin')->user()->id;
        $check->save();


        return redirect('/admin/check' . $check->type . '/index')->withSuccess('添加成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Check::find((int)$id);

        if ($tag) {
            $tag->delete();
        } else {
            return redirect()->back()
                ->withErrors("删除失败");
        }

        return redirect()->back()
            ->withSuccess("删除成功");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkmap(Request $request)
    {
        if ($request->ajax()) {
            $data = array();

            $data['recordsTotal'] = Check::count();

            $start = 0;
            $length = 30;

            if (auth('admin')->user()->hasRole('areaadmin')) {
                $area = auth('admin')->user()->area;

                $checks = Check::join('targets', function ($join) use ($area) {
                    $join->on('checks.name', '=', 'targets.name')
                        ->where('area', $area);
                })->get();

            } else {

                $checks = Check::join('targets', function ($join) {
                    $join->on('checks.name', '=', 'targets.name');

                })->get();


            }
            $data['checks'] = $checks;


            return response()->json($data);
        }

        return view('admin.check.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function maptypeajax(Request $request)
    {
        $type = $request->get('type');
        $data = array();


        $data['recordsTotal'] = Check::count();

        $start = 0;
        $length = 30;

        if (auth('admin')->user()->hasRole('areaadmin')) {
            $area = auth('admin')->user()->area;

            $checks = Check::select('checks.*', 'targets.lon',
                'targets.lat', 'oc.status as ostatus', 'oc.starlevel as ostarlevel')->where('checks.type', $type)->join('targets', function ($join) use ($area) {
                $join->on('checks.name', '=', 'targets.name')
                    ->where('area', $area);
            })->leftjoin('checks as oc', function ($join) {
                $join->on('checks.name', '=', 'oc.name')
                    ->where('checks.id', '<', 'oc.id');
            })->get();

        } else {

            $checks = Check::select('checks.*', 'targets.lon',
                'targets.lat', 'oc.status as ostatus', 'oc.starlevel as ostarlevel')
                ->where('checks.type', $type)->join('targets', function ($join) {
                    $join->on('checks.name', '=', 'targets.name');

                })->leftjoin('checks as oc', function ($join) {
                    $join->on('checks.name', '=', 'oc.name')
                        ->where('checks.id', '<', 'oc.id');
                })->get();


        }
        $data['checks'] = $checks;


        return response()->json($data);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function maptype(Request $request)
    {
        $type = $request->get('type');
        if ($request->ajax()) {
            $data = array();


            $data['recordsTotal'] = Check::count();

            $start = 0;
            $length = 30;

            if (auth('admin')->user()->hasRole('areaadmin')) {
                $area = auth('admin')->user()->area;

                $checks = Check::where('type', $type)->join('targets', function ($join) use ($area) {
                    $join->on('checks.name', '=', 'targets.name')
                        ->where('area', $area);
                })->leftjoin('checks as oc', function ($join) {
                    $join->on('checks.name', '=', 'oc.name')
                        ->where('checks.id', '<', oc . id);
                })->get();

            } else {

                $checks = Check::where('type', $type)->join('targets', function ($join) {
                    $join->on('checks.name', '=', 'targets.name');

                })->leftjoin('checks as oc', function ($join) {
                    $join->on('checks.name', '=', 'oc.name')
                        ->where('checks.id', '<', oc . id);
                })->get();


            }
            $data['checks'] = $checks;


            return response()->json($data);
        }
        $data['type'] = $type;

        return view('admin.check.map', $data);
    }


}

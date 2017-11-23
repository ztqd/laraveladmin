@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')
    <div class="row page-title-row" style="margin:5px;">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-right">
            @if(Gate::forUser(auth('admin')->user())->check('admin.check.create'))
                <a href="/admin/check/create?type={{ $type }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 增加
                </a>
            @endif
        </div>
    </div>
    <div class="row page-title-row" style="margin:5px;">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-right">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                @include('admin.partials.errors')
                @include('admin.partials.success')
                <div class="box-body">
                    <table id="tags-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th data-sortable="false"></th>
                            <th>类型</th>
                            <th>县区</th>
                            <th>内容</th>
                            <th>备注</th>
                            <th>星级</th>
                            <th>检查人</th>
                            <th>被检查人</th>
                            <th>检查时间</th>
                            <th>状态</th>
                            <th>反馈</th>
                            <th>反馈时间</th>
                            <th>反馈人</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="modal fade" id="modal-delete" tabIndex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">提示</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i>
                        确认要删除这个吗?
                    </p>
                </div>
                <div class="modal-footer">
                    <form class="deleteForm" method="POST" action="/admin/role">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i>确认
                        </button>
                    </form>
                </div>
            </div>
            @stop
            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">详细信息</h4>
                  </div>
                  <div class="modal-body">
                    <p></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">关闭</button>
                  </div>
                </div>
              </div>
            </div>
            @section('js')
                <script>
                    $(function () {
                        var cols = $("#tags-table th").map(function(ind, ele) {
                            return $(ele).text()
                        })

                        var col = {
                            // "id": "z",
                            "type": "类型",
                            "area": "县区",
                            "checkcontent": "内容",
                            "memo": "备注",
                            "starlevel": "星级",
                            "checkusername": "检查人",
                            "inspectionname": "被检查人",
                            "checktime": "检查时间",
                            "status": "状态",
                            "feedback": "反馈",
                            "feedbacktime": "反馈时间",
                            "feedbackuser": "反馈人"
                        }

                      
                        var table = $("#tags-table").DataTable({
                            "scrollX": true,
                            language: {
                                "sProcessing": "处理中...",
                                "sLengthMenu": "显示 _MENU_ 项结果",
                                "sZeroRecords": "没有匹配结果",
                                "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                                "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                                "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                                "sInfoPostFix": "",
                                "sSearch": "搜索:",
                                "sUrl": "",
                                "sEmptyTable": "表中数据为空",
                                "sLoadingRecords": "载入中...",
                                "sInfoThousands": ",",
                                "oPaginate": {
                                    "sFirst": "首页",
                                    "sPrevious": "上页",
                                    "sNext": "下页",
                                    "sLast": "末页"
                                },
                                "oAria": {
                                    "sSortAscending": ": 以升序排列此列",
                                    "sSortDescending": ": 以降序排列此列"
                                }
                            },
                            order: [[1, "desc"]],
                            serverSide: true,
                            ajax: {
                                url: '/admin/check{{ $type }}/index',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }  
                            },
                            "columns": [
                                {"data": "id", "visible": false },
                                {"data": "type"},
                                {"data": "area"},
                                {"data": "name"},
                                {"data": "memo", "visible": false },
                                {"data": "starlevel"},
                                {"data": "checkusername", "visible": false },
                                {"data": "inspectionname", "visible": false },
                                {"data": "checktime", "visible": false },
                                {"data": "status", "visible": false },
                                {"data": "feedback", "visible": false },
                                {"data": "feedbacktime", "visible": false },
                                {"data": "feedbackuser", "visible": false },
                                {"data": ""}
                            ],
                            columnDefs: [
                                {
                                    'targets': -1, 
                                    "render": function (data, type, row) {
                                        var row_edit = {{Gate::forUser(auth('admin')->user())->check('admin.check.edit') ? 1 : 0}};
                                        var row_feedback = {{Gate::forUser(auth('admin')->user())->check('admin.check.feedback') ? 1 : 0}};
                                        var row_delete = {{Gate::forUser(auth('admin')->user())->check('admin.check.destroy') ? 1 :0}};
                                        var str = '';
                                        // console.log(data.aoData)
                                        //编辑
                                        if (row_edit) {
                                            str += '<a style="margin:3px;" href="/admin/check/' + row['id'] + '/edit" class="X-Small btn-xs text-success "><i class="fa fa-edit"></i> 编辑</a>';
                                        }

                                        //编辑
                                        if (row_feedback&&row['starlevel']<5) {
                                            str += '<a style="margin:3px;" href="/admin/check/' + row['id'] + '/feedback" class="X-Small btn-xs text-success "><i class="fa fa-edit"></i> 反馈</a>';
                                        }

                                        //删除
                                        if (row_delete) {
                                            str += '<a style="margin:3px;" href="#" attr="' + row['id'] + '" class="delBtn X-Small btn-xs text-danger"><i class="fa fa-times-circle"></i> 删除</a>';
                                        }

                                        // str += '<a style="margin:3px;" href="#" attr="' + row['id'] + '" class="details btn-xs"> 详情</a>';

                                        return str;
                                    }
                                }// ,{
                                //    "targets": [0,9], 
                                //    "visible": false 
                                // }
                            ],
                            fnInitComplete  : function(d) {
                                $('.X-Small, .delBtn').click(function(e) {
                                    e.stopPropagation();
                                });
                                // console.log(d.aoData)
                                // var datas = d.aoData;
                                // // var tables = $('#tags-table').DataTable();
                                // $('.details').on('click', function(e) {
                                //     console.log(e.target)
                                //     var tds = $(e.target).parent().parent().children('td');
                                //     console.log(tds)
                                //     var content = '';
                                //     for ( var i = 1; i < tds.length-1; i ++ ){
                                //         console.log($(tds[i]).text())
                                //         if ($(tds[i]).text() != '') {
                                //             content =  content + '<li>' + cols[i] + '<br />' + $(tds[i]).text() + '</li>'
                                //         }
                                //     }
                                //     console.log(content)
                                //     $('#modal-default .modal-body').html(content)
                                //     $('#modal-default').modal({
                                //         keyboard: true
                                //     })


                                // })
                                // $('.details').on('click', function(e) {
                                //     console.log($(this).parent().parent());
                                //     var data = table.row( this ).data();
                                //     console.log(data)
                                // })
                            }
                        });
                       
                        $('#tags-table tbody').on('click', 'tr', function () {
                            console.log(this)
                            // console.log($('#tags-table tbody tr')[2])
                            var data = table.row( this ).data();

                            var content = '';
                            for ( var i in data ){
                                if (data[i] != '' && data[i] != null && col[i] != undefined) {
                                    content =  content + '<li>' + col[i] + '<br />' + data[i] + '</li>'
                                }
                            }
                         
                            $('#modal-default .modal-body').html(content)
                            $('#modal-default').modal({
                                keyboard: true
                            })
                        } );

                        table.on('preXhr.dt', function () {
                            loadShow();
                        });

                        table.on('draw.dt', function () {
                            loadFadeOut();
                        });

                        table.on('order.dt search.dt', function () {
                            table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                                cell.innerHTML = i + 1;
                            });
                        }).draw();

                        $("table").delegate('.delBtn', 'click', function () {
                            var id = $(this).attr('attr');
                            $('.deleteForm').attr('action', '/admin/check/' + id);
                            $("#modal-delete").modal();
                        });

                    });
                </script>
@stop
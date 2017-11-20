@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')
    <div class="row page-title-row" style="margin:5px;">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-right">

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

<!-- 搜索框 -->
                    <table cellpadding="2" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
                        <thead>
                        <tr>
                            <th>目标列</th>
                            <th>查询内容</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="filter_col2" data-column="1">
                            <td>类型</td>
                            <td align="center">

                                <select  class='form-control' id="col1_filter" name="col1_filter" autocomplete="off"><option value='1'>综合楼安全检查</option>
<option value='2'>营业厅安全检查</option>
<option value='3'>通信基站安全检查</option>
<option value='4'>工程建设施工检查</option>
 option></select>
                            </td>
                        </tr>
                        <tr id="filter_col3" data-column="2">
                            <td>县区</td>
                            <td align="center">
                                <select  class='form-control' id="col2_filter" name="col2_filter" autocomplete="off">
<option value='宿城区'>宿城区</option>
<option value='宿豫区 '>宿豫区 </option>
<option value='沭阳县'>沭阳县</option>
<option value='泗洪县'>泗洪县</option>
<option value='泗阳县'>泗阳县</option></select>
                            </td>
                        </tr>
                         

                        <tr id="filter_col6" data-column="3">
                            <td>名称</td>
                            <td align="center"><input type="text"  class='form-control' id="col3_filter"></td>

                        </tr>
                        <tr id="filter_col7" data-column="9">
                            <td>时间</td>
                            <td align="center">
                                <input type="text"  placeholder="开始时间" class=" pull-left" data-date-format="yyyy-mm-dd" id="start_time" name="start_time"  >

                                <input type="text" placeholder="结束时间"  data-date-format="yyyy-mm-dd" id="end_time" name="end_time" onchange="$('#col8_filter').val($('#start_time').val()+':'+$('#end_time').val());filterColumn(8);" >
                                <input type="hidden" class="column_filter" id="col8_filter"></td>

                        </tr>
                        </tbody>
                    </table>
 
                    <table id="tags-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th data-sortable="false" class="hidden-sm"></th>
                            <th class="hidden-sm">类型</th>
                            <th class="hidden-sm">县区</th>
                            <th class="hidden-sm">内容</th>
                            <th class="hidden-sm">备注</th>
                            <th class="hidden-sm">星级</th>
                            <th class="hidden-sm">检查人</th>
                            <th class="hidden-sm">被检查人</th>
                            <th class="hidden-sm">检查时间</th>
                            <th class="hidden-sm">状态</th>
                            <th class="hidden-sm">反馈</th>
                            <th class="hidden-md">反馈时间</th>
                            <th class="hidden-md">反馈人</th>
                            
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

              @section('css')
                @parent
                <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker-bs3.css">
                <!-- bootstrap datepicker -->
                <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">

            @stop


            @section('js')
                @parent
                <script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
                <script src="/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js"></script>

                <script type="text/javascript">
                    $('#start_time').datepicker({
                        language: 'zh-CN',
                        autoclose: true
                    });
                    $('#end_time').datepicker({
                        language: 'zh-CN',
                        autoclose: true
                    });
                
                    $(function () {
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
                                url: '/admin/feedback/index',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            },
                            "columns": [
                                {"data": "id"},
                                {"data": "type"},
                                {"data": "area"},
                                {"data": "name"},
                                {"data": "memo"},
                                {"data": "starlevel"},
                                {"data": "checkusername"},

                                {"data": "inspectionname"},
                                {"data": "checktime"},
                                {"data": "status"},
                                {"data": "feedback"},
                                {"data": "feedbacktime"},
                                {"data": "feedbackuser"}
                            ],
                            columnDefs: [
                                {
                                    
                                
                                }
                            ]
                        });

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



                    });
                    function filterGlobal () {
                        $('#tags-table').DataTable().search(
                                $('#global_filter').val()

                        ).draw();
                    }

                    function filterColumn ( i ) {
                        $('#tags-table').DataTable().column( i ).search(
                                $('#col'+i+'_filter').val()

                        ).draw();
                    }
                    $(document).ready(function() {

                        // DataTable
                        var table = $('#tags-table').DataTable();
                        
                        $('input.global_filter').on( 'keyup click', function () {
                            filterGlobal();
                        } );

                        $('input.column_filter').on( 'keyup click blur', function () {
                            filterColumn( $(this).parents('tr').attr('data-column') );
                        } );
                        $('select.form-control').on( 'change', function () {
                            filterColumn( $(this).parents('tr').attr('data-column') );
                        } );
                        $('input.form-control').on( 'keyup click blur', function () {
                            filterColumn( $(this).parents('tr').attr('data-column') );
                        } );


                    } );
                </script>
@stop
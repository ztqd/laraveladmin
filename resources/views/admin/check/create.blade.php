@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')
    <div class="main animsition">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">添加 </h3>
                        </div>
                        <div class="panel-body">

                            @include('admin.partials.errors')
                            @include('admin.partials.success')

                            <form class="form-horizontal" role="form" method="POST" action="/admin/check" id="building">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="cove_image"/>

                                <!-- <div id="" class="tab-pane fade in active"> -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div id="city_1" class="" style="padding-left: 0;">
                                                <select style="width: 50%" class="prov form-control col-sm-6 col-xs-6" name="area"></select>
                                                <select style="width: 50%" class="city form-control col-sm-6 col-xs-6"  name="name"></select>
                                            </div>


                                            <table class="table table-hover" style="margin-top: 40px;">
                                                <thead>
                                                <tr>
                                                    <td >检查内容及标准</td>
                                                    <td style="width: 80px">不合格的请打勾</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($subitem as $km=>$vm)
                                                    <tr>
                                                        <td>
                                                            {{$vm->content}}
                                                        </td>
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" style="width: 1em;" />
                                                            </label>
                                                        </td>
                                                    </tr>

                                                @endforeach


                                                </tbody>
                                            </table>
                                        </div><!-- /.span -->
                                    </div>
                                    <!-- <div class="row"></div> -->

                                    <div class="form-group">
                                        <label class="col-xs-3 control-label no-padding-right" for="form-field-6">备注</label>
                                        <div class="col-xs-9">
                                            <textarea class="form-control memo" name="memo" placeholder="请先完成上面检查内容再写备注"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3 control-label no-padding-top">星级评定</label>
                                        <div class="col-xs-12" id="rate" >
                                            <input type="hidden" name="starlevel" class="starlevel">
                                            <div class="inline" id="rating"style="display: none;"></div>
                                            <div class="hr hr-16 hr-dotted"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3 control-label no-padding-right" for="form-field-6">检查人员</label>
                                        <div class="col-xs-9">
                                            <input class="form-control" data-rel="tooltip" type="text" id="form-field-6" placeholder="检查人员" title="Hello Tooltip!" data-placement="bottom" name="checkusername" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3 control-label no-padding-right" for="form-field-6">受检人</label>
                                        <div class="col-xs-9">
                                            <input name="inspectionname" class="form-control person" data-rel="tooltip" type="text" id="form-field-6" placeholder="受检人" title="Hello Tooltip!" data-placement="bottom" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3 control-label no-padding-right" for="form-field-6">时间

                                        </label>
                                        <div class="col-xs-9">
                                            <input name="checktime" class="form-control" data-rel="tooltip" type="text" id="form-field-6" placeholder="月日" title="Hello Tooltip!" data-placement="bottom" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3 control-label no-padding-right" for="form-field-6"></label>
                                        <div class="col-xs-9">
                                            <input type="hidden" name="type" value="{{ $type }}" >
                                            {{-- <button class="btn btn-info">提交</button> --}}
                                        </div>
                                    </div>

                                <!-- </div> -->
                                

                                <div class="form-group">
                                    <div class="col-md-7 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary btn-md">
                                            <i class="fa fa-plus-circle"></i>
                                            添加
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        @parent

        {{-- <script src="/plugins/datepicker/bootstrap-datepicker.js"></script> --}}
        <script src="/plugins/jquery.raty.min.js"></script>
        <script src="/plugins/jquery.cityselect.js"></script>

        <script type="text/javascript">
            $(function() {
                $.fn.raty.defaults.path = 'lib/img';
                var a = $('#rate').raty({
                    number: 5,//多少个星星设置
                    // targetType: 'hint',//类型选择，number是数字值，hint，是设置的数组值
                    path      : '/',
                    hints     : ['差','一般','好','非常好','全五星'],
                    cancelOff : 'cancel-off-big.png',
                    cancelOn  : 'cancel-on-big.png',
                    size      : 24,
                    starHalf  : 'star-half-big.png',
                    starOff   : 'star-off-big.png',
                    starOn    : 'star-on-big.png',
                    target    : '#rating',
                    cancel    : false,
                    targetKeep: true,
                    width: '200px',
                    readOnly: true,
                    targetText: '请选择评分',

                });

                $("#city_1").citySelect({
                    url:{"citylist":[

                            @foreach($target as $k=>$v)
                        {"p":"{{$k}}","c":[
                                @foreach($target[$k] as $km=>$vm)
                            {"n":"{{$vm}}"},

                            @endforeach


                        ]},
                        @endforeach

                    ]},
                    prov:"宿城",
                    city:"HTML5",
                    dist:"",
                    nodata:"none"
                });

                var star = $('#building #rate img');
                stark(star, 5); // 初始星星个数
                memo($('#building')); //拼接字符串和click事件

                function memo(id) {
                    $(id).find('table input').on('click', function(e) {
                        $('.memo').val('');
                        var inputs = $(id).find('table input:checked');
                        for (var i = 0; i < inputs.length; i ++) {
                            $('.memo').val($('.memo').val() +$.trim( $(inputs[i]).parent().parent().siblings('td').text())+ '\r\n' )
                        }


                        if({{$type}}==1){
                            staring(star, $('#building table input:checked'), 4, 9, 15);
                        }
                        if({{$type}}==2){
                            staring(star, $('#building table input:checked'), 3, 5, 8);

                        }
                        if({{$type}}==3){
                            staring(star, $('#building table input:checked'), 3, 5, 8);

                        }
                        if({{$type}}==4){
                            staring(star, $('#building table input:checked'), 2, 4,6);

                        }

                    })

                }
                function staring(star, obj, n4, n3, n2) {
                    //obj为打分项，
                    var l = obj.length;
                    console.log(l)
                    if (!l  || l == 0) {
                        stark(star, 5);
                    } else {
                        if (1<= l && l < n4) {
                            stark(star, 4);
                        } else if (n4<= l && l < n3) {
                            stark(star, 3);
                        }   else if (n3<= l && l < n2) {
                            stark(star, 2);
                        }else if (n2<= l) {
                            stark(star, 1);
                        }
                    }
                }

                function stark(star, n) {
                    for (var i = 0; i < n; i ++) {
                        $(star)[i].src = '/star-on-big.png';
                        $('.starlevel').val(n)
                    }
                    for (var i = n; i < 5; i ++) {
                        $(star)[i].src = '/star-off-big.png';
                    }
                }

            });
        </script>

    @stop
@stop
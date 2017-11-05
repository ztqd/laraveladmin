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
                            <h3 class="panel-title">编辑</h3>
                        </div>
                        <div class="panel-body">

                            @include('admin.partials.errors')
                            @include('admin.partials.success')
                            <form class="form-horizontal" role="form" method="POST"
                                  action="/admin/check/{{ $id }}/feedbacksave">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="{{ $id }}">


                                <input type="hidden" class="form-control" name="status" id="tag" value="2" autofocus>


                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">反馈内容</label>
                                    <div class="col-md-6">
                                        <textarea name="feedback" class="form-control" rows="3">{{ $feedback}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">反馈时间</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="feedbacktime" id="tag" value="{{ date('Y-m-d') }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">反馈人</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="feedbackuser" id="tag" value="{{ auth('admin')->user()->name }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-7 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary btn-md">
                                            <i class="fa fa-plus-circle"></i>
                                            保存
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
@stop
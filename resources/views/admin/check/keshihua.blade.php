@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

 
@section('content')

<style type="text/css">
    .index_icon {
        width: 70px;
        height: 70px;
        border-radius: 70px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }
    .icon-text {
        margin-top: 6px;
        font-size: 18px;
    }
    .syinner>img {
        width: 45%;
    }
    @media screen and (max-width: 768px) {
        #allmap {
            height:50%;
        }
        .content {
            padding: 0;
        }
    }
    @media screen and (min-width: 768px) {
        #allmap {
            height:70%;
        }
   }
   /* 
    .view_link>div {
        height: 100px;
        margin-top: 10px;
    }
        .link_to {
        height: 300px;
    }
    .page_ul li {
        float: left;
        font-size: 18px;
        text-align: center;
        list-style: none;
    }
    .page_ul li div {
        height: 200px;
        border: 1px solid #77f;
        border-radius: 5px;
        background: #00c0ef;
        transition: .3s;
        margin: 10px;
    }
    .page_ul li:nth-child(2) div {
         background: #00a65a;
         border-color: #00a65a;
    }
    .page_ul li:nth-child(3) div {
         background: #f39c12;
         border-color: #f39c12;
    }
    .page_ul li:nth-child(4) div {
         background: #dd4b39;
         border-color: #dd4b39;
    }
    .page_ul li div:hover {
        box-shadow: 0px 0px 10px #aaa;
        font-size: 16px;
    }
    .page_ul li a {
        color: #fff;
        text-decoration: none;
    }
    .page_ul li i {
        color: #fff;font-size: 3em;
    }*/
</style>
<div id="allmap" style="width:100%;overflow:hidden;margin:0;z-index:1000"></div>
<section class="box-body"> {{-- hidden-xs --}}
{{-- <ul class="page_ul" style="margin: auto;">
    <li class="col-sm-6">
        <a href="check/maptype?type=1" class=" radius-4">
        <div>
            <br> <br>
            <i class="fa fa-fw fa-tv"></i>
            <br> <br> <br>
        综合楼可视化
        </div>
        </a>
    </li>
    <li class="col-sm-6">
        <a href="check/maptype?type=2" class=" radius-4">
        <div>
            <br> <br>
            <i class="fa fa-fw fa-object-ungroup"></i>
            <br> <br> <br>
            营业厅可视化
        </div>
        </a>
    </li>
    <li class="col-sm-6">
        <a href="check/maptype?type=3" class=" radius-4">
        <div>
            <br> <br>
            <i class="fa fa-fw fa-object-group"></i>
            <br> <br> <br>
            通信基站可视化
            </div>
            </a>
    </li>
    <li class="col-sm-6">
        <div>
        <a href="check/maptype?type=4" class=" radius-4">
            <br> <br>
            <i class="fa fa-fw fa-safari"></i>
            <br> <br> <br>
            工程建设可视化
            </a>
            </div>
    </li>
</ul> --}}

{{-- <div class="row">
    <div class="view_link col-sm-6">
        <div class="col-sm-10 col-offset-1">
            综合楼可视化
        </div>    
    </div>
     <div class="view_link col-sm-6">
        <div class="col-sm-10 col-offset-1">
            营业厅可视化
        </div>    
    </div>
     <div class="view_link col-sm-6">
        <div class="col-sm-10 col-offset-1">
            通信基站可视化
        </div>    
    </div>
     <div class="view_link col-sm-6">
        <div class="col-sm-10 col-offset-1">
            工程建设可视化
        </div>    
    </div>
    
</div> --}}
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>综合楼可视化</p>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-object-group"></i>
            </div>
            <a href="check/maptype?type=1" class="small-box-footer">查看 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53</h3>

              <p>营业厅可视化</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="check/maptype?type=2" class="small-box-footer">查看 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>通信基站可视化</p>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-tv"></i>
            </div>
            <a href="check/maptype?type=3" class="small-box-footer">查看 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>工程建设可视化</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="check/maptype?type=4" class="small-box-footer">查看 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

</section>
{{-- <div class="row visible-xs" style="padding: 20px 0;background: #fff;border-top: 1px solid #cdcdcd;">
    <div class="col-xs-6 text-center syinner">
        <a class="index_icon" href="/admin/log-viewer" style="background: #3E9EE0">
                <i class="ace-icon fa fa-book white" style="font-size: 2em"></i>
        </a>
        <!-- <img src="assets/img/2.png" alt=""> -->
        <div class="icon-text">可视化</div>
    </div>
    <div class="col-xs-6 text-center syinner">
        <a class="index_icon" href="/admin/check1/index" style="background: #F67C3C">
            <i class="ace-icon fa fa-star white" style="font-size: 2em"></i>
        </a>
        <!-- <img src="assets/img/2.png" alt=""> -->
        <div class="icon-text">打分检查</div>
    </div>
</div>
<div class="row visible-xs" style="padding-bottom: 23px;background: #fff;border-bottom: 1px solid #cdcdcd;">
    <div class="col-xs-6 text-center syinner">
        <a class="index_icon" href="/admin/feedback/index" style="background: #F36464">
            <i class="ace-icon fa fa-calendar white" style="font-size: 2em"></i>
        </a>
        <!-- <img src="assets/img/2.png" alt=""> -->
        <div class="icon-text">整改进度</div>
    </div>
    <div class="col-xs-6 text-center syinner">
        <a class="index_icon" href="/admin/exposure/index" style="background: #16C3BC">
            <i class="ace-icon fa fa-desktop white" style="font-size: 2em"></i>
            <!-- </div> -->
        </a>
        <div class="icon-text">曝光台</div>
    </div>
</div> --}}
@endsection
 
@section('js')
    @parent
     
@endsection
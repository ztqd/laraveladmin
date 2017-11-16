@extends('log-viewer::_template.master')

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
{{-- <div id="allmap" style="width:100%;overflow:hidden;margin:0;z-index:1000"></div> --}}
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

@section('scripts')
   

    <script>
        $(function() {
            var data = {!! $reports !!};

            // new Chart($('#stats-doughnut-chart')[0].getContext('2d'))
            //     .Doughnut(data, {
            //         animationEasing : "easeOutQuart"
            //     });
        });
    </script>
@endsection
@section('js')
    @parent
    <script type="text/javascript" src="http://api.map.baidu.com/getscript?v=2.0&ak=piXQ5CgHFqEefqCVbhhBFfe6HjF7l4zW"></script>
    <script type="text/javascript">
        $(function() {
            var data = {!! $reports !!};
            console.log(data)

            // var icon1 = new BMap.Icon('/img/star1.png', new BMap.Size(20, 35), {
            //     imageSize: new BMap.Size(20, 30)
            // })
            // var icon2 = new BMap.Icon('/img/star2.png', new BMap.Size(20, 35), {
            //     imageSize: new BMap.Size(20, 30)
            // })

            // var icon3 = new BMap.Icon('/img/star3.png', new BMap.Size(20, 35), {
            //     imageSize: new BMap.Size(20, 30)
            // })
            // var icon4 = new BMap.Icon('/img/star4.png', new BMap.Size(20, 35), {
            //     imageSize: new BMap.Size(20, 30)
            // })
            // var icon5 = new BMap.Icon('/img/star5.png', new BMap.Size(20, 35), {
            //     imageSize: new BMap.Size(20, 30)
            // })

            // var map = new BMap.Map("allmap");    // 创建Map实例
            // map.centerAndZoom(new BMap.Point( 118.3,33.96), 10);  // 初始化地图,设置中心点坐标和地图级别
            // map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
            // map.setCurrentCity("宿迁");          // 设置地图显示的城市 此项是必须设置的
            // map.enableScrollWheelZoom(true);  
            // map.addControl(new BMap.NavigationControl())
            // $.ajax({
            //     url: 'check/map',
            //     dataType: 'json'
            // })
            // .done(function(res) {
            //     console.log("success");
            //     if (res) {
            //         console.log(res)
            //         var list = res['checks'];
            //         for (var i = 0; i < list.length; i ++) {
            //             var point = new BMap.Point(list[i].lon, list[i].lat);
            //             var myIcon = new BMap.Icon("http://223.68.10.47:8888/img/star1.png");

            //             var marker;
            //             var level = list[i].starlevel;
            //             switch (level) {
            //                 case '1':
            //                     marker = new BMap.Marker(point, {icon: icon1});
            //                     break;
            //                 case '2':
            //                     marker = new BMap.Marker(point, {icon: icon2});
            //                     break;
            //                 case '3':
            //                     marker = new BMap.Marker(point, {icon: icon3});
            //                     break;
            //                 case '4':
            //                     marker = new BMap.Marker(point, {icon: icon4});
            //                     break;
            //                 case '5':
            //                     marker = new BMap.Marker(point, {icon: icon5});
            //                     break;
            //                 default:
            //                     marker = new BMap.Marker(point);
            //             }
            //             // var marker = new BMap.Marker(point, {icon: icon1}); //

            //             marker.info = list[i].name;
            //             map.addOverlay(marker);

            //             marker.addEventListener('click', function (e) {
            //                 this.openInfoWindow(new BMap.InfoWindow(this.info));
            //             })
            //         }
            //     }
            // })
            // .fail(function(e) {
            //     console.log(e);
            // })
            // .always(function() {
            //     console.log("complete");
            // });
            
        });
    </script>
@endsection
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
</style>
<div id="allmap" style="width:100%;overflow:hidden;margin:0;z-index:1000"></div>
<section class="box-body"> {{-- hidden-xs --}}
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>可视化</p>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-object-group"></i>
            </div>
            <a href="/admin/keshihua" class="small-box-footer">查看 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>预警</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/admin/expired/index" class="small-box-footer">查看 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>打分检查</p>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-tv"></i>
            </div>
            <a href="/admin/check1/index" class="small-box-footer">查看 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>整改进度</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/admin/feedback/index" class="small-box-footer">查看 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

</section>
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

            var icon1 = new BMap.Icon('/img/star1.png', new BMap.Size(20, 35), {
                imageSize: new BMap.Size(20, 30)
            })
            var icon2 = new BMap.Icon('/img/star2.png', new BMap.Size(20, 35), {
                imageSize: new BMap.Size(20, 30)
            })

            var icon3 = new BMap.Icon('/img/star3.png', new BMap.Size(20, 35), {
                imageSize: new BMap.Size(20, 30)
            })
            var icon4 = new BMap.Icon('/img/star4.png', new BMap.Size(20, 35), {
                imageSize: new BMap.Size(20, 30)
            })
            var icon5 = new BMap.Icon('/img/star5.png', new BMap.Size(20, 35), {
                imageSize: new BMap.Size(20, 30)
            })

            var map = new BMap.Map("allmap");    // 创建Map实例
            map.centerAndZoom(new BMap.Point( 118.3,33.96), 10);  // 初始化地图,设置中心点坐标和地图级别
            map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
            map.setCurrentCity("宿迁");          // 设置地图显示的城市 此项是必须设置的
            map.enableScrollWheelZoom(true);  
            map.addControl(new BMap.NavigationControl())
            $.ajax({
                url: 'check/map',
                dataType: 'json'
            })
            .done(function(res) {
                console.log("success");
                if (res) {
                    console.log(res)
                    var list = res['checks'];
                    for (var i = 0; i < list.length; i ++) {
                        var point = new BMap.Point(list[i].lon, list[i].lat);
                        var myIcon = new BMap.Icon("http://223.68.10.47:8888/img/star1.png");

                        var marker;
                        var level = list[i].starlevel;
                        switch (level) {
                            case '1':
                                marker = new BMap.Marker(point, {icon: icon1});
                                break;
                            case '2':
                                marker = new BMap.Marker(point, {icon: icon2});
                                break;
                            case '3':
                                marker = new BMap.Marker(point, {icon: icon3});
                                break;
                            case '4':
                                marker = new BMap.Marker(point, {icon: icon4});
                                break;
                            case '5':
                                marker = new BMap.Marker(point, {icon: icon5});
                                break;
                            default:
                                marker = new BMap.Marker(point);
                        }
                        // var marker = new BMap.Marker(point, {icon: icon1}); //

                        marker.info = list[i].name;
                        map.addOverlay(marker);

                        marker.addEventListener('click', function (e) {
                            this.openInfoWindow(new BMap.InfoWindow(this.info));
                        })
                    }
                }
            })
            .fail(function(e) {
                console.log(e);
            })
            .always(function() {
                console.log("complete");
            });
            
        });
    </script>
@endsection
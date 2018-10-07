@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            产品管理
            <small>产品</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">产品管理 - 产品</li>
          </ol>
@stop

@section('content')

              @if(session()->has('message'))
                <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                  {{ session('message') }}
                </div>
              @endif

              <a href="{{ _route('admin:product.create') }}" class="btn btn-primary margin-bottom">录入新产品</a>
              <a href="{{ _route('admin:excel.export',$products ) }}" class="btn btn-primary margin-bottom">导出excel</a>
              <a href="javascript:void(0);" class="btn btn-primary margin-bottom uploadFile" data-id="file">excel导入</a>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">产品列表</h3>
                  @can('article-search')
                  <div class="box-tools">
                    <form action="{{ _route('admin:product.index') }}" method="get">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_title" value="{{ request('s_title') }}" style="width: 150px;" placeholder="搜索文章标题">
                        <div class="input-group-btn">
                          <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                  @endcan
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover table-bordered">
                    <tbody>
                      <!--tr-th start-->
                      <tr>
                        <th>操作</th>
                        <th>标题</th>
                        <th>产品质量</th>
                        <th>条码</th>
                        <th>证书编号</th>
                        <th>含金量</th>
                        <th>企业标准</th>
                        <th>公司名称</th>
                        <th>公司地址</th>
                        <th>客服电话</th>
                        <th>公司网址</th>
                        <th>检测机构</th>
                        <th>二维码</th>
                        <th>描述</th>
                        <th>分类</th>
                        <th>时间</th>
                      </tr>
                      <!--tr-th end-->

                      @foreach ($products as $art)
                      <tr>
                        <td>
                            @can('product-write')
                            <a href="{{ _route('admin:product.edit', $art->id) }}"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                            @endcan
                            <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>
                        </td>
                        <td class="text-muted" title="{{ $art->title }}">{{ str_limit($art->title, 36) }}</td>
                        <td class="text-green">{{$art->quality}}</td>
                        <td >{{ $art->barcode }}</td>
                        <td >{{ $art->certificateNo }}</td>
                        <td >{{ $art->goldContent }}</td>
                        <td >{{ $art->enterpriseStandard }}</td>
                        <td >{{ $art->companyName }}</td>
                        <td >{{ $art->companyAddress }}</td>
                        <td >{{ $art->serviceTel }}</td>
                        <td >{{ $art->companyWebsite }}</td>
                        <td >{{ $art->testingFacility }}</td>
                        <td ><img src="/qrcodes/{{$art->id}}.png" /></td>
                        <td >{{$art->description }}</td>
                        <td class="text-red"><a href="{{ _route('admin:product.index', ['s_cid' => $art->cid] ) }}">{{ $art->category->name }}</a></td>
                        <td>{{ $art->updated_at }}</td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  {!! $products->appends([
                                          's_cid' => request('s_cid'),
                                          's_title' => request('s_title'),
                                        ])->render() !!}
                </div>

              </div>
@stop

@section('extraPlugin')
  <!--引入layer插件-->
  <script src="{{ _asset(ref('layer.js')) }}"></script>
@stop

@section('filledScript')

        $('a.layer_open').on('click', function(evt){
            evt.preventDefault();
            var src = $(this).attr("href");
            var title = $(this).data('title');
            var width = $(window).width();
            if(width > 1080) {
                width = 1080
            } else {
                width = 980;
            }
            layer.open({
                type: 2,
                title: title,
                shadeClose: false,
                shade: 0.8,
                area: [ width+'px', '90%'],
                content: src //iframe的url
            });
        });

        //上传文件
        $('.uploadFile').click(function(){
            var ele = $(this).data('id');
            console.log(ele);
            layer.open({
                type : 2,
                closeBtn : false,
                title: false,
                fix: false,
                area : ['600px' , '200px'],
                offset : ['', ''],
                content: ['{{ _route('admin:upload.document') }}?from=' + ele],
                success: function(layero){
                        //console.log('success:',layero);
                        $(layero['selector']).css('border-radius','6px');
                        $(layero['selector'] + ' .layui-layer-content').css('border-radius','6px');
                },
                cancel : function(index){
                    layer.closeAll();
                },
                end : function(index){
                    //location.reload();
                }
            });
        });

@stop

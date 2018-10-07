@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            内容管理
            <small>文章</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ _route('admin:product.index') }}">内容管理 - 文章</a></li>
            <li class="active">修改文章</li>
          </ol>
@stop

@section('content')

          @if(session()->has('fail'))
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4>  <i class="icon icon fa fa-warning"></i> 提示！</h4>
              {{ session('fail') }}
            </div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> 警告！</h4>
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
            </div>
          @endif

              <h2 class="page-header">修改文章</h2>
              <form method="post" action="{{ _route('admin:product.update', $product->id) }}" accept-charset="utf-8">
              {!! method_field('put') !!}
              {!! csrf_field() !!}
              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                  </ul>
                  <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group">
                        <label>标题 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="title" autocomplete="off" value="{{ old('title', isset($product) ? $product->title : null) }}" placeholder="标题">
                      </div>
                      <div class="form-group">
                        <label>分类 <small class="text-red">*</small></label>
                        <div class="input-group">
                          <select data-placeholder="选择分类..." class="chosen-select" style="min-width:200px;" name="cid">
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ ($product->cid == $category->id) ? 'selected="selected"' : '' }}>{{ $category->name }}</option>
                          @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label> 产品质量<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="quality" autocomplete="off" value="{{ old('quality', isset($product) ? $product->quality : null) }}" placeholder="产品质量" maxlength="80">
                      </div>
                      <div class="form-group">
                        <label> 条码<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="barcode" autocomplete="off" value="{{ old('barcode', isset($product) ? $product->barcode : null) }}" placeholder="条码" maxlength="80">
                      </div>
                      <div class="form-group">
                        <label> 证书编号<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="certificateNo" autocomplete="off" value="{{ old('certificateNo', isset($product) ? $product->certificateNo : null) }}" placeholder="证书编号" maxlength="80">
                      </div>
                      <div class="form-group">
                        <label> 含金量<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="goldContent" autocomplete="off" value="{{ old('goldContent', isset($product) ? $product->goldContent : null) }}" placeholder="含金量" maxlength="80">
                      </div>
                      <div class="form-group">
                        <label> 企业标准<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="enterpriseStandard" autocomplete="off" value="{{ old('enterpriseStandard', isset($product) ? $product->enterpriseStandard : null) }}" placeholder="企业标准" maxlength="80">
                      </div>
                      <div class="form-group">
                        <label>公司名称<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="companyName" autocomplete="off" value="{{ old('companyName', isset($product) ? $product->companyName : null) }}" placeholder="公司名称" maxlength="80">
                      </div>
                      <div class="form-group">
                        <label>公司地址<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="companyAddress" autocomplete="off" value="{{ old('companyAddress', isset($product) ? $product->companyAddress : null) }}" placeholder="公司地址" maxlength="80">
                      </div>
                      <div class="form-group">
                        <label>客服电话<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="serviceTel" autocomplete="off" value="{{ old('serviceTel', isset($product) ? $product->serviceTel : null) }}" placeholder="客服电话" maxlength="80">
                      </div>
                      <div class="form-group">
                        <label>公司网址<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="companyWebsite" autocomplete="off" value="{{ old('companyWebsite', isset($product) ? $product->companyWebsite : null) }}" placeholder="公司网址" maxlength="80">
                      </div>
                      <div class="form-group">
                        <label>检测机构<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="testingFacility" autocomplete="off" value="{{ old('testingFacility', isset($product) ? $product->testingFacility : null) }}" placeholder="检测机构" maxlength="80">
                      </div>

                      <div class="form-group">
                        <label>备注 <small class="text-red">*</small><span class="text-green"></span></label>
                        <textarea class="form-control" name="description" rows="3" cols="200" autocomplete="off" placeholder="备注">{{ old('description', isset($product) ? $product->description: null) }}</textarea>
                      </div>

                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">修改文章</button>

                  </div><!-- /.tab-content -->
                  
              </div>
            </form>
          <div id="layerPreviewPic" class="fn-hide">
            
          </div>

@stop


@section('extraPlugin')

  <!--引入Layer组件-->
  <script src="{{ _asset(ref('layer.js')) }}"></script>
  <!--引入iCheck组件-->
  <script src="{{ _asset(ref('icheck.js')) }}" type="text/javascript"></script>
  <!--引入My97DatePicker日期插件-->
  <script src="{{ _asset(ref('my97datepicker.js')) }}" type="text/javascript"></script>
  <!--引入Chosen组件-->
  @include('admin.scripts.endChosen')
  {!! editor_css() !!}
  {!! editor_js() !!}
  {!! editor_config('mdeditor') !!}

@stop


@section('filledScript')
        <!--缩略名自适应宽度 部分代码来自typecho-->
        function input_auto_size(sw, ele) {
              var t = $(ele), l = t.val().length;
              if (l > 0) {
                var s = (l <= 120) ? l : 120;
                t.css('width', 'auto').attr('size', s);
              } else {
                t.css('width', sw).removeAttr('size');
              }
        }

        var slug = $('#slug');

        if (slug.length > 0) {
          var sw = slug.width();
          var sl = slug.val().length;
          if (sl > 0) {
            var size = (sl <= 120) ? sl : 120;
            slug.css('width', 'auto').attr('size', size);
          }
          slug.bind('input propertychange', function () {
              input_auto_size(sw, this);
          }).width();
        }

        $('.auto-to-pinyin').click(function () {
            var _name = $('input[name="title"]').val();
            var _url = "{{ _route('api:pinyin') }}";
            var _param = {
              'content' : _name
            };
            $.get(_url, _param, function (_data) {
              if (_data.status) {
                var len = _data.slug.length;
                if (len <= 120) {
                  $('input[name="slug"]').val(_data.slug);
                  input_auto_size(sw, 'input[name="slug"]');
                }
              }
            });
         });

        <!--启用iCheck响应checkbox与radio表单控件-->
        $('input[name="flag[]"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          increaseArea: '20%', // optional
        });

        <!--响应点击label 选中或者取消选中-->
        $('label.choice').click(function() {
            var value = $(this).data('value');
            $('input[name="flag[]"][value='+value+']').iCheck('toggle');
        });
        @include('admin.scripts.endSinglePic') {{-- 引入单个图片上传与预览JS，依赖于Layer --}}
@stop

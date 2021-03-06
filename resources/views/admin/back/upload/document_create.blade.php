@extends('admin.layout._layer')

@section('head_style'){{-- layer 表单样式 --}}
    <style type="text/css">
        .close_button{
            margin-bottom: 25px;
        }
        .yascmf_layer{
            width: 560px;
            margin: 0 20px;
        }
        .validation_tips_area {
          line-height: 36px;
          background-color: #f6f6f6;
          color: #666;
          border-radius: 12px;
        }
        /*覆写部分样式,以便适合弹窗*/
        .yascmf_layer .validation_tips_area{
            width: 500px;
        }
        .yascmf_layer ul li label.description,{
            line-height: 20px !important;
        }
        .yascmf_layer ul li .form_item {
            line-height: 20px !important;
            margin: 5px 0;
        }
        .yascmf_layer p.tips_text{
            color: #083;
            font-size: 12px;
            line-height: 20px;
            margin: 5px 0;
        }
        .avgrund-close {
            display: block;
            color: #555;
            font-size: 14px;
            text-decoration: none;
            text-transform: uppercase;
            position: absolute;
            top: 6px;
            right: 10px;
        }
    </style>
@stop

@section('mainLayerCon')

    <div class="validation_tips_area" style="display: none;">
        <div class="tips_text">
            <p class="be_happy"><i class="fa fa-smile-o"></i>  上传文件成功！</p>
            <p class="info_text small_text">本提示栏2秒之后自动关闭！</p>
        </div>
    </div>

<form method="post" action="{{ _route('admin:upload.document.store') }}" accept-charset="utf-8" enctype="multipart/form-data" id="uploadForm">
{!! csrf_field() !!}
    <div class="upload_file_form">
        <div class="form-group">
            <input accept=".xls,.xlsx" name="document" type="file" >
            <span>请先下载模板，录入数据，表头部分不允许修改 - <a href="/assets/doc/产品列表.xls">excel模板下载</a></span>
          
        </div>
        <button type="submit" class="btn btn-primary" id="uploadSubmit">导入</button>
    </div>
</form>
@stop

@section('endLayerJS')
<script src="{{ _asset(ref('layer.js')) }}"></script>{{-- 加载layer插件 --}}
<script src="{{ _asset(ref('form.js')) }}"></script>{{-- 加载jquery.form插件 --}}
<script type="text/javascript">

    //比如在iframe中关闭自身
    var index = parent.layer.getFrameIndex(window.name); //获取当前窗体索引
    $('.avgrund-close').on('click', function(){
        parent.layer.close(index); //执行关闭
    });

    @include('admin.scripts.endBuildHtml')

    // ajax form拦截提交事件
    $('#uploadSubmit').click(function(){
        var options = {
            dataType: 'json',
            timeout: 3000,
            success: function (data) {
                var html = build_html(data.status,data.info,data.operation);
                $('.validation_tips_area').html(html).css('display','block');
                setTimeout( function(){$('.validation_tips_area').fadeOut('slow');},2000);
                if(data.status === 1)  //成功
                {
                    var from = '{{ request('from','thumb') }}';
                    parent.$('#'+ from).val(data.info);  //回调图片地址到父窗口
                    //parent.layer.close(index);
                    console.log('url:',data.info);
                    $.ajax({
                        type: 'GET',
                        url: '/admin/excel/import',
                        data: { url: data.info}, 
                        dataType: 'json',
                        success: function(data){ 
                            //console.log('success:',data);
                           setTimeout("parent.location.reload()",1000);
                        },                
                        error: function(xhr, status, error){ 
                            console.log(xhr); 
                            console.log(status); 
                            console.log(error);
                        } 
                    }); 

                }
                else
                {
                    //setTimeout("location.reload()",1000);
                }
            },
            error: function(){
                var html = build_html(0, '失败：服务器端异常', '操作');
                $('.validation_tips_area').html(html).css('display','block');
                setTimeout( function(){$('.validation_tips_area').fadeOut('slow');},2000);
                //setTimeout("location.reload()",1000);
            }
        };
        $('#uploadForm').ajaxForm(options);
    });
</script>
@stop



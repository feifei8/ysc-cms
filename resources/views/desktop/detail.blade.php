@extends('desktop.layout._base')


@section('mainContent')
        <div class="article">
            <!-- <div class="art_head">
                <h2>{{ $product->title }}</h2>
            </div> -->
            <!-- <div class="art_meta clearfix">
                <span class="icon-folder"></span> <a href="{{ slug_url($product->category->slug) }}" title="查看“{{ $product->category->name }}”分类下文章">{{ $product->category->name }}</a>    
                <span class="icon-calendar"></span> <a href="javascript:void(0);">{{ $product->created_at->format('Y-m-d') }}</a>
            </div> -->
            <div class="art_con">
                <table>
                    <tr>
                        <td width="70px">产品名称：</td>
                        <td>{{$product->title}}</td>
                    </tr>
                     @if($product->quality!="")
                    <tr>
                        <td>产品质量：</td>
                        <td>{{$product->quality}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>条码：</td>
                        <td>{{$product->barcode}}</td>
                    </tr>
                     @if($product->certificateNo!="")
                    <tr>
                        <td>证书编号：</td>
                        <td>{{$product->certificateNo}}</td>
                    </tr>
                    @endif
                     @if($product->goldContent!="")
                    <tr>
                        <td>含金量：</td>
                        <td>{{$product->goldContent}}</td>
                    </tr>
                    @endif
                    @if($product->proTotalWeight!="")
                    <tr>
                        <td>产品总重：</td>
                        <td>{{$product->proTotalWeight}}</td>
                    </tr>
                    @endif
                    @if($product->mainStone!="")
                    <tr>
                        <td>主石：</td>
                        <td>{{$product->mainStone}}</td>
                    </tr>
                    @endif
                    @if($product->mainStoneWeight!="")
                    <tr>
                        <td>主石重量：</td>
                        <td>{{$product->mainStoneWeight}}</td>
                    </tr>
                    @endif
                    @if($product->mainStoneClarity!="")
                    <tr>
                        <td>含金量：</td>
                        <td>{{$product->mainStoneClarity}}</td>
                    </tr>
                    @endif
                    @if($product->mainStoneClarity!="")
                    <tr>
                        <td>主石净度：</td>
                        <td>{{$product->mainStoneClarity}}</td>
                    </tr>
                    @endif
                    @if($product->mainStoneColor!="")
                    <tr>
                        <td>主石颜色：</td>
                        <td>{{$product->mainStoneColor}}</td>
                    </tr>
                    @endif
                    @if($product->standard!="")
                    <tr>
                        <td>执行标准：</td>
                        <td>{{$product->standard}}</td>
                    </tr>
                    @endif
                    @if($product->enterpriseStandard!="")
                    <tr>
                        <td>企业标准：</td>
                        <td>{{$product->enterpriseStandard}}</td>
                    </tr>
                    @endif
                    @if($product->companyName!="")
                    <tr>
                        <td>公司名称：</td>
                        <td>{{$product->companyName}}</td>
                    </tr>
                    @endif
                    @if($product->companyAddress!="")
                    <tr>
                        <td>公司地址：</td>
                        <td>{{$product->companyAddress}}</td>
                    </tr>
                    @endif
                    @if($product->serviceTel!="")
                    <tr>
                        <td>客服电话：</td>
                        <td>{{$product->serviceTel}}</td>
                    </tr>
                    @endif
                    @if($product->companyWebsite!="")
                    <tr>
                        <td>公司网址：</td>
                        <td>{{$product->companyWebsite}}</td>
                    </tr>
                    @endif
                    @if($product->testingFacility!="")
                    <tr>
                        <td>检测机构：</td>
                        <td>{{$product->testingFacility}}</td>
                    </tr>
                    @endif
                    @if($product->companyTel!="")
                    <tr>
                        <td>电话：</td>
                        <td>{{$product->companyTel}}</td>
                    </tr>
                    @endif
                     <tr>
                        
                        <td colspan=2><img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->barcode, 'C128')}}" alt="" /></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- <div class="copyright_text">
            
        </div> -->
@endsection

@section('filledScript')

@stop
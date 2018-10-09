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
                    <tr>
                        <td>产品质量：</td>
                        <td>{{$product->quality}}</td>
                    </tr>
                    <tr>
                        <td>条码：</td>
                        <td>{{$product->barcode}}</td>
                    </tr>
                    <tr>
                        <td>证书编号：</td>
                        <td>{{$product->certificateNo}}</td>
                    </tr>
                    <tr>
                        <td>含金量：</td>
                        <td>{{$product->goldContent}}</td>
                    </tr>
                    <tr>
                        <td>企业标准：</td>
                        <td>{{$product->enterpriseStandard}}</td>
                    </tr>
                    <tr>
                        <td>公司名称：</td>
                        <td>{{$product->companyName}}</td>
                    </tr>
                    <tr>
                        <td>公司地址：</td>
                        <td>{{$product->companyAddress}}</td>
                    </tr>
                    <tr>
                        <td>客服电话：</td>
                        <td>{{$product->serviceTel}}</td>
                    </tr>
                    <tr>
                        <td>公司网址：</td>
                        <td>{{$product->companyWebsite}}</td>
                    </tr>
                    <tr>
                        <td>检测机构：</td>
                        <td>{{$product->testingFacility}}</td>
                    </tr>
                    <tr>
                        <td>电话：</td>
                        <td>{{$product->companyTel}}</td>
                    </tr>
                     <tr>
                        <td></td>
                        <td>{{$product->companyTel}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- <div class="copyright_text">
            
        </div> -->
@endsection

@section('filledScript')

@stop
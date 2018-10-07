<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ cache('website_title') }}</title>
    
    <!-- <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" /> -->
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="@section('description') {{ isset($website_keywords) ? $website_keywords : '' }} @show{{-- meta描述 --}}" />
    <meta name="keywords" content="{{ cache('website_keywords') }}" />
    <meta name="author" content="{{ cache('system_author_website') }}" />

    <link rel="stylesheet" href="{{ _asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ _asset('assets/css/icomoon_style.css') }}" />
    <link rel="stylesheet" href="{{ _asset('assets/css/markdown_style.css') }}" />
    <script src=”http://libs.baidu.com/jquery/1.11.1/jquery.min.js”></script>
    <script type="text/javascript" src="script/lib/touche.js"></script>
    <script type="text/javascript" src="script/p-pull-refresh.js"></script>
    @section('htmlHead')
    @show{{-- head区域 --}}
</head>
<body class="paper">
<div id="solibk" style="font-size: 0px; background: url(&quot;data:image/gif;base64,R0lGODlhcAAaALMAAKurq+Xl5czMzPX19d/f38XFxdXV1b+/v+/v77W1tQAAAAAAAAAAAAAAAAAAAAAAACH5BAEHAAMALAAAAABwABoAAAT/cMhJq704BMyr2F0ojmSIBIQBgNdHsFQifoZwWAmMGUbpl4HeoGBBGFKED+JyO1EQAsNBQLhhnEuLVQDV/b6UYMorKbwO2QmVkHgBCEUCwXkJ2FZ1FBzMtxz3GS9CFAISVAMyFUdBQVYSAVMICI4TPAVZH32aZYZkA3IGORUaNZKFikEIRJQTUBkuhZmbYEEDSwKncQN6hJBJFwYbKAOsu4MWsXqesyanaAMCAETGBTU5GjBwx4pyv5Qoy1wac7XMP8vAHbmfFDcfG45/R3WcQqGA5iW4IsUUNTwHphkL0w9agilRJrQhti3fj0McqonQEIJHhxRp/DncyLGjx48g4EOKHEmypMmTKFOC6SYS3wSXIfbA/DFzxAENBfP1y8kEzoGaJH6CsWLFQAGJxCRUGWAU6Q1IEpraO7rzqBCiPYnBgSRgmtCvPrdOESpVgpWlRvcxrGG2bVIqN7AylONW7s66biuA1cp3Ct2+YfvihZu0HQy70JYGLED0MFW8WiDvDHxgrM9jezMPRltAFiu7QYwWnvBZb952ki9IvMmXNL7MlOuGFliYVRS2n+IamncaGm/fUpjwOHV7HSHWTKmAEFqJcPIqcIor1f0phXGVGJgz64w9JFJmort7ZMmMl7kIADs=&quot;) center center no-repeat; height: 0px;"></div>

<div id="con_wrapper">
    <div id="r_con">
        <div class="header">
            <img src="{{ cache('system_logo') }}" style="width:'313px'; height='52px'"/>
            <!-- <a href="/"><h1>芽丝轻博客</h1></a> -->
        </div>
        
        @section('mainContent')
        @show{{-- 主体内容 --}}


        <div class="footer">
            <p class="slogan">designed &amp; developed by <a href="https://www.lingyusheng.com">凌宇升</a>  </p>
            <p>&copy; 2018 版权所有 -{{cache('company_full_name')}} <a href="http://www.miibeian.gov.cn/">{{ cache('website_icp') }}</a></p>
        </div>
    </div>
</div>

@section('afterFooter')
@show{{-- 页脚区域 --}}
</body>
</html>

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Douyasi\Http\Requests\ProductRequest;
use Douyasi\Models\Product;
use Douyasi\Models\Category;
use Gate;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends BackController
{
    public function __construct()
    {
        parent::__construct();

        // if (Gate::denies('@product')) {
        //     $this->middleware('deny403');
        // }
    }


    public function index(Request $request)
    {
        $s_title = $request->input('s_title');
        $s_cid = $request->input('s_cid');

        $categories = Category::all();
        $products = Product::where('title', 'like', '%'.$s_title.'%')
                            ->where('cid', (($s_cid > 0) ? '=' : '<>'), $s_cid)
                            ->orderBy('created_at','desc')
                            ->paginate(15);
        $scheme = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
        $host = $scheme.$_SERVER['HTTP_HOST'];
        foreach($products as $product){
            $id = $product->id;
            if(!file_exists(public_path('qrcodes/'.$id.'.png'))){
                if(!file_exists(public_path('qrcodes')))
                    mkdir(public_path('qrcodes'));
            
                $category = Category::where('id', '=', $product->cid)->first();
                if($category){
                    $url=$host."/".$category->slug."/".$id.".html";
                    QrCode::format('png')->size(200)->generate($url, public_path('qrcodes/'.$id.'.png'));
                }
            }
        }

        return view('admin.back.product.index', compact('categories', 'products','QrCode'));
    }

    public function create()
    {
        if (Gate::denies('product-write')) {
            return deny();
        }
        $categories = Category::all();
        return view('admin.back.product.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        if (Gate::denies('product-write')) {
            return deny();
        }
        $inputs = $request->all();
        $product = new Product;
        $product->title = e($inputs['title']);
        $product->cid = intval($inputs['cid']);

        $product->quality = $inputs['quality'];
        $product->barcode = $inputs['barcode'];
        $product->certificateNo = $inputs['certificateNo'];
        $product->goldContent = $inputs['goldContent'];
        $product->enterpriseStandard = $inputs['enterpriseStandard'];
        $product->companyName = $inputs['companyName'];
        $product->companyAddress = $inputs['companyAddress'];
        $product->serviceTel = $inputs['serviceTel'];
        $product->companyWebsite = $inputs['companyWebsite'];
        $product->testingFacility = $inputs['testingFacility'];
        $product->companyTel = $inputs['companyTel'];
        $product->description = e($inputs['description']);

        
        if($product->save()) {
            $scheme = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
            $host = $scheme.$_SERVER['HTTP_HOST'];
            $id = $product->id;
            if(!file_exists(public_path('qrcodes')))
            mkdir(public_path('qrcodes'));
        
            $category = Category::where('id', '=', $inputs['cid'])->first();
            if($category){
                $url=$host."/".$category->slug."/".$id.".html";
                QrCode::format('png')->size(200)->generate($url, public_path('qrcodes/'.$id.'.png'));
            }
            return redirect()->to(site_path('product', 'admin'))->with('message', '成功录入产品！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }

    public function edit($id)
    {
        if (Gate::denies('product-write')) {
            return deny();
        }
        $product = Product::find($id);
        $categories = Category::all();
        is_null($product) AND abort(404);
        return view('admin.back.product.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        if (Gate::denies('product-write')) {
            return deny();
        }
        $inputs = $request->all();
        $product = Product::find($id);
        $product->title = e($inputs['title']);
        $product->cid = intval($inputs['cid']);
        $product->quality = $inputs['quality'];
        $product->barcode = $inputs['barcode'];
        $product->certificateNo = $inputs['certificateNo'];
        $product->goldContent = $inputs['goldContent'];
        $product->enterpriseStandard = $inputs['enterpriseStandard'];
        $product->companyName = $inputs['companyName'];
        $product->companyAddress = $inputs['companyAddress'];
        $product->serviceTel = $inputs['serviceTel'];
        $product->companyWebsite = $inputs['companyWebsite'];
        $product->testingFacility = $inputs['testingFacility'];
        $product->companyWebsite = $inputs['companyWebsite'];
        $product->companyTel = $inputs['companyTel'];
        $product->description = e($inputs['description']);
        if($product->save()) {
            return redirect()->to(site_path('product', 'admin'))->with('message', '成功更新产品！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }
    public function import(Request $request) 
    {
        $path = public_path();
        $inputs = $request->all();
        $filePath = $path.$inputs['url'];
        $response = [];
        $response['code'] = '200';
        $response['status'] = 'success';
        $response['msg'] ='导入成功';
        Excel::load($filePath, function($reader) {
            $data = $reader->all();
            
            $products=[];
            foreach($data as $key=>$value){
                $products[]=[
                    'title' =>$value->产品名称,
                    'cid' => 2,
                    'quality' => $value->产品质量,
                    'barcode' => $value->条码,
                    'certificateNo' => $value->证书编号,
                    'goldContent' => $value->含金量,
                    'enterpriseStandard' => $value->企业标准,
                    'companyName' => $value->公司名称,
                    'companyAddress' => $value->公司地址,
                    'serviceTel' => $value->客服电话,
                    'companyWebsite' => $value->公司网址,
                    'testingFacility' => $value->检测机构,
                    'companyTel' => $value->电话,
                    'description' => $value->备注,
                ];
            }
            //dd($products);
            $product=new Product;
            $result = $product::insert($products);
            if(!$result){
                DB::rollBack();
                $response['code'] = '500';
                $response['status'] = 'fail';
                $response['msg'] = '导入错误,请重试';
            }
            
        },'UTF-8');
        return response()->json($response);

    }
    public function export() 
    {
        
        $products = Product::all();
        //dd($products);
        $cellData = [
            ['序号','产品名称','产品质量','条码','证书编号','含金量','企业标准','公司名称','公司地址','客服电话','公司网址','检测机构','电话','二维码','备注']
        ];
        $scheme = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
        $host = $scheme.$_SERVER['HTTP_HOST'];
        foreach ($products as $key => $value){
            if(!file_exists(public_path('qrcodes/'.$value->id.'.png'))){
                if(!file_exists(public_path('qrcodes')))
                    mkdir(public_path('qrcodes'));
                
                $category = Category::where('id', '=', $value->cid)->first();
                if($category){
                    $url=$host."/".$category->slug."/".$value->id.".html";
                    QrCode::format('png')->size(200)->generate($url, public_path('qrcodes/'.$value->id.'.png'));
                }
            
            }
            $product=[];
            array_push($product,$value->id);
            array_push($product,$value->title);
            array_push($product,$value->quality);
            array_push($product,$value->barcode);
            array_push($product,$value->certificateNo);
            array_push($product,$value->goldContent);
            array_push($product,$value->enterpriseStandard);
            array_push($product,$value->companyName);
            array_push($product,$value->companyAddress);
            array_push($product,$value->serviceTel);
            array_push($product,$value->companyWebsite);
            array_push($product,$value->testingFacility);
            array_push($product,$value->companyTel);
            array_push($product,'');
            array_push($product,$value->description);
            array_push($cellData,$product);
        }
        //dd($cellData);
        Excel::create('产品列表',function ($excel) use ($cellData ){
            $excel->sheet('sheet1', function ($sheet) use ($cellData ){
             $sheet->rows($cellData);
             foreach ($cellData as $key => $item) {
                    if($key>0){
                        //计算列名
                        $x = "N";
                        //用网络地址换取本地存储路径
                        $cloudImg = public_path('qrcodes/'.$item[0].'.png');
                        $objDrawing = new \PHPExcel_Worksheet_Drawing();
                        $objDrawing->setPath($cloudImg);
                        //设置图片坐标(单元格)
                        $objDrawing->setCoordinates($x . ($key + 1));
                        //限定图片高度
                        $objDrawing->setHeight(100);
                        //图片在单元格中的偏移位置(若不设置则图位于单元格左上方)
                        $objDrawing->setOffsetX(10);
                        $objDrawing->setOffsetY(10);
                        $objDrawing->setRotation(100);
                        $objDrawing->setWorksheet($sheet);
                        //如果有图片，把列拉宽
                        $sheet->setWidth([$x => 40]);
                    }
            }
    
    
            //设置单元格样式(第一行为title)
            $setCount = count($cellData);
            $sheet->setHeight([1=>20]);
            for ($c = 2; $c <=$setCount; $c++) {
                $sheet->setHeight([//设置第二行起每一行的高度
                    $c => 100,
                ]);
            }
    
            //设置每一行宽度
            // $sheet->setWidth([
            //     'A' => 10,
            //     'B' => 50,
            //     'C' => 20,
            //     'D' => 30,
            //     'E' => 30,
            //     'F' => 20,
            //     'G' => 30,
            //     'H' => 30,
            //     'I' => 30,
            //     'J' => 20,
            //     'K' => 30,
            //     'L' => 30,
            //     'M' => 20,
            //     'N' => 50,
            //     'O' => 30,
            // ]);
    
            //计算总数据量
            $count = count($cellData);
            $sheet->cells("A1:R$count", function ($cells) {
                //设置单元格内元素靠左向上
                $cells->setAlignment('left');
                $cells->setValignment('top');
            });
            //标题加粗
            $sheet->cells("A1:N1", function ($cells) {
                $cells->setFontWeight('bold');
            });
            });
           })->export('xls');
    }
}
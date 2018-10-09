<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Douyasi\Http\Requests\ProductExtRequest;
use Douyasi\Models\productExt;
use Gate;


/**
 * 分类控制器
 * 无关核心业务逻辑，直连模型操作
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class ProductExtController extends BackController
{

    public function __construct()
    {
        parent::__construct();

        if (Gate::denies('@config')) {
            $this->middleware('deny403');
        }
    }

    public function index(Request $request)
    {
        $productExts = ProductExt::paginate(15);
        return view('admin.back.ProductExt.index', compact('productExts'));
    }

    public function create(Request $request)
    {
        if (Gate::denies('productExt-write')) {
            return deny();
        }
        return view('admin.back.productExt.create');
    }

    public function edit($id)
    {
        if (Gate::denies('productExt-write')) {
            return deny();
        }
        $data = ProductExt::find($id);
        is_null($data) AND abort(404);
        return view('admin.back.productExt.edit', compact('data'));
    }


    public function store(ConfigRequest $request)
    {
        if (Gate::denies('config-write')) {
            return deny();
        }
        $inputs = $request->all();
        $config = new Config;
        $config->name = e($inputs['name']);
        $config->value = e($inputs['value']);
        $config->sort = e($inputs['sort']);
        $config->desc = e($inputs['desc']);
        if($config->save()) {
            return redirect()->to(site_path('productExt', 'admin'))->with('message', '新增属性成功！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        if (Gate::denies('productExt-write')) {
            return deny();
        }
        $inputs =$request->all();
        $config = Config::find($id);
        $config = new Config;
        $config->name = e($inputs['name']);
        $config->value = e($inputs['value']);
        $config->sort = e($inputs['sort']);
        $config->desc = e($inputs['desc']);
        if($category->save()) {
            return redirect()->to(site_path('config', 'admin'))->with('message', '修改属性成功！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }

}

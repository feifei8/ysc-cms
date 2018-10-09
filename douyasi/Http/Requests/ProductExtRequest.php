<?php

namespace Douyasi\Http\Requests;

use App\Http\Requests\Request;

class ConfigRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * 自定义验证规则rules
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3) ? ','.$this->segment(3).',id' : '';
        $rules = [
            'name' => 'required|alpha',
            'value' => 'required',
            'sort' => 'required|numeric',
        ];
        return $rules;
    }

    /**
     * 自定义验证信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '名称不能为空',
            'name.alpha'    => '名称必须为常规字符',
            'value.required' => '值不能为空',
            'sort.required' => '分类排序不能为空',
            'sort.numeric'  => '分类排序必须为数字',
        ];
    }
}

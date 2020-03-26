<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Validator;

class StoreGoodsPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   



        $name = \Route::currentRouteName();
        if($name == 'goodsstore'){
            return [
                'goods_name' => 'required|unique:goods|max:50|min:2',
                'goods_num' => 'required|numeric',
                'goods_price' => 'required|numeric',
                'goods_score' => 'required',
            ];
        }
       
        if($name = 'goodsupdate'){
            return [
                'goods_name' => [
                    'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
                    Rule::unique('goods')->ignore(request()->id,'goods_id'),
                 ],
                  'goods_num' => 'required|numeric',
                  'goods_price' => 'required|numeric',
                  'goods_score' => 'required',
            ];
        } 
    }



    public function messages(){
        return [ 
            'goods_name.required'=>'商品名称不能为空',
            'goods_score.required'=>'商品货号不能为空',
            'goods_name.max'=>'商品名称2-50位',
            'goods_name.min'=>'商品名称2-50位',
            'goods_name.unique'=>'品牌名称已被注册',
            'goods_num.required'=>'商品存库不能为空',
            'goods_price.required'=>'商品价格不能为空',
            'goods_num.numeric'=>'商品存库必须为数字',
            'goods_price.numeric'=>'商品价格必须为数字',
           ];
        }
}

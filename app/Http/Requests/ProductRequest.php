<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
        return [
            'title'       =>'required',
            'slug'        =>'string|max:100',
            'price'       =>'required|numeric',
            'quantity'    =>'required|integer',
            'abstract'    =>'string|max:100',
            'category_id' =>'string',
            'published_at'=>'in:ok',
            'status'      =>'in:published,unpublished',
            'picture'     =>'image|max:3000',
        ];
    }
}

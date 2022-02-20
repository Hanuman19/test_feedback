<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\storefactory;
use Validator;

class StoreFeedback extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'phone' => ['required'],
                'text' => ['required']
            ]
        );
        if($validate->fails()){
            return ['message'=>$validate->messages(),
                'obj'=>$request];
        }
        $factory=new StoreFactory;
        $create=$factory->getData($request->slug);
        return $create->storeData($request);
    }
}

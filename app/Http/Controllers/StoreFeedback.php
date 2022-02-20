<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\storefactory;

class StoreFeedback extends Controller
{
    public function store(Request $request)
    {
        $factory=new StoreFactory;
        $create=$factory->getData($request->slug);
        return $create->storeData($request);
    }
}

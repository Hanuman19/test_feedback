<?php

namespace App\Helpers;

use App\Models\Feedback;
use Validator;

class storeDB implements store {
    public function storeData($item){
        $validate = Validator::make(
            $item->all(),
            [
                'name' => ['required'],
                'phone' => ['required'],
                'text' => ['required']
            ]
        );
        if($validate->fails()){
            return ['message'=>$validate->messages(),
                'obj'=>$item];
        }
        $feedback = Feedback::create([
            'name' => $item->name,
            'phone_number' => $item->phone,
            'text' => $item->text,
        ]);
        return [
            'status' => true,
            'feedback' => $feedback
        ];
    }
}

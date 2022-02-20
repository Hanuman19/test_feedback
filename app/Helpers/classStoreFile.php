<?php

namespace App\Helpers;

use App\Models\Feedback;
use Validator;

class storeFile implements store {
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
        $text = 'Имя: '.$item->name.' Телефон: '.$item->phone.' Текст обращения: '.$item->text;
        $fp = fopen("../public/test.txt", "a+");
        fwrite($fp, $text."\r\n");
        fclose($fp);
        return [
            'status' => true
        ];
    }
}

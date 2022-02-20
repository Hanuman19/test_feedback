<?php

namespace App\Helpers;


class storeFile implements store {
    public function storeData($item){
        $text = 'Имя: '.$item->name.' Телефон: '.$item->phone.' Текст обращения: '.$item->text;
        $fp = fopen("../public/test.txt", "a+");
        fwrite($fp, $text."\r\n");
        fclose($fp);
        return [
            'status' => true
        ];
    }
}

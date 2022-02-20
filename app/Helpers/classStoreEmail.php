<?php

namespace App\Helpers;

class storeEmail implements store {
    public function storeData($item){
        return [
            'status' => true,
            'feedback' => 'Данный функционал еще не реализован'
        ];
    }
}

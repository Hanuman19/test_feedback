<?php

namespace App\Helpers;

use App\Helpers\classSroreDb;
use App\Helpers\classSroreFile;
use Exception;

class StoreFactory {
    public function getData($slug){
        switch ($slug){
            case "db": return new storeDB;
            case "file": return new storeFile;
            default: throw new Exception("Что то тут не так");
        }
    }
}

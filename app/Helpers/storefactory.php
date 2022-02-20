<?php

namespace App\Helpers;

use App\Helpers\classSroreDb;
use App\Helpers\classSroreFile;
use App\Helpers\classSroreEmail;
use Exception;

class StoreFactory {
    public function getData($slug){
        switch ($slug){
            case "db": return new storeDB;
            case "file": return new storeFile;
            case "email": return new storeEmail;
            default: throw new Exception("Что то тут не так");
        }
    }
}

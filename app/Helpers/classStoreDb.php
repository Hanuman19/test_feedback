<?php

namespace App\Helpers;

use App\Models\Feedback;
class storeDB implements store {
    public function storeData($item){
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

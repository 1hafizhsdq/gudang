<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CredentialApps {
    public static function check($data){
        $serial = '$2y$10$oanWAwF3j7C/.Wze98DLb.NqtptMA5eJRYbUu5AKHnHb6m3oY0i8W';
        // $serial = '$2y$10$foQvSBCmzQoQdSqiHwVYWek34PpdIplrX5Zkw3zBAdnbahnhrNDKa';
        if(!Hash::check($data,$serial)){
            Session::flash('message', 'Serial Number expired, please contact developer to activation your serial number!');
            return false;
        }

        return true;
    }
}
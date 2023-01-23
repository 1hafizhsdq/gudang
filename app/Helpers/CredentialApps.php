<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CredentialApps {
    public static function check($data){
        $serial = '$2y$10$JYVKEixzeVbj.Xfqif8CaeEgdpX6fjJX6N7lyOHL.F2TGg7.XzH/W';
        if(!Hash::check($data,$serial)){
            Session::flash('message', 'Serial Number expired, please contact developer to activation your serial number!');
            return false;
        }

        return true;
    }
}
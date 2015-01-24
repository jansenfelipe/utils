<?php

namespace JansenFelipe\Utils;

use Illuminate\Support\Facades\Facade;

class FacadeMask extends Facade implements Constants {

    protected static function getFacadeAccessor() {
        return 'mask';
    }

}

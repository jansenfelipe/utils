<?php

use Illuminate\Support\Facades\Facade;
use JansenFelipe\Utils\Constants;

namespace JansenFelipe\Utils;

class FacadeMask extends Facade implements Constants {

    protected static function getFacadeAccessor() {
        return 'mask';
    }

}

<?php

namespace JansenFelipe\Utils;

class Facade extends \Illuminate\Support\Facades\Facade {

    protected static function getFacadeAccessor() {
        return 'utils';
    }

}

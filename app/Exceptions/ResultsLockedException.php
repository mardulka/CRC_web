<?php

namespace App\Exceptions;

use Exception;

class ResultsLockedException extends Exception{

    public function render( $request ){
        return response()->json( [ "error" => true, "message" => $this->getMessage() ] );
    }

    //TODO : Handle this exception
}

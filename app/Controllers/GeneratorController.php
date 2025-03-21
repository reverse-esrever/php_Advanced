<?php

namespace App\Controllers;


class GeneratorController
{
    public function index(){
        $arr = $this->lazyRange(1,300);

        foreach($arr as $item){
            echo $item . "<br>";
        }

        echo $arr->getReturn();
    }

    public function lazyRange($start, $end){
        for($i = $start; $i <= $end; $i++){
            yield $i;
        }

        return 'done';
    }
}

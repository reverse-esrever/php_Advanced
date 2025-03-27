<?php

namespace App\Examples\Enum;

use BackedEnum;

enum Status : int
{
    case PAID = 1;
    case DECLINED = 2;
    case VOID = 3;

    public function toString(){
        return match($this){
            $this::PAID => 'paid',
            $this::DECLINED => 'declined',
            $this::VOID => 'void',
        };
    }
}
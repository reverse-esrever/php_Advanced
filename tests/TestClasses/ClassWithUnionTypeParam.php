<?php

namespace Tests\TestClasses;

class ClassWithUnionTypeParam
{
    public function __construct(int|string $param)
    {
        
    }
}
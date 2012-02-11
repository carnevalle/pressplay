<?php

namespace PressPlay\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PressPlayUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
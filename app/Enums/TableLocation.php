<?php

namespace App\Enums;

#(value' ya '=' işaretinde sonrası yazılır). (name'e '=' işaretinden öncesi yazılır)-->
enum TableLocation: string
{
    case Front = 'front';
    case Inside = 'Inside';
    case Outside = 'outside';

}

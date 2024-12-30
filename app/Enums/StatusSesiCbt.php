<?php

namespace App\Enums;

enum StatusSesiCbt : string
{
    case Draft = 'draft';
    case Active = 'active';
    case Completed = 'completed';
}
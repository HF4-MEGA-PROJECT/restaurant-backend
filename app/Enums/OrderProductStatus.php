<?php

namespace App\Enums;

enum OrderProductStatus: string
{
    case ORDERED = 'ordered';
    case IN_PROGRESS = 'in progress';
    case DELIVERABLE = 'deliverable';
}

<?php

namespace App\Http\Controllers;
use App\Models\Concerns\ApiResponseTrait;
abstract class Controller {
    use ApiResponseTrait;
}

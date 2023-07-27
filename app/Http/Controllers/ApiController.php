<?php

namespace App\Http\Controllers;

use App\Traits\Json;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use AuthorizesRequests;
    use Json;
}

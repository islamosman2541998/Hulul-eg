<?php

namespace App\Http\Controllers;

use App\Traits\Api\ApiResponseTrait;
use App\Traits\FileHandler;
 use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FileHandler , ApiResponseTrait ;

    protected $pagination_count = 50;
    protected $site_pagination_count = 9;

}

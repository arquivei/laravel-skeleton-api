<?php

namespace App\Http\Controllers;

use Arquivei\LogAdapter\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected Log $logger;

    public function __construct(Log $logger)
    {
        $this->logger = $logger;
    }
}

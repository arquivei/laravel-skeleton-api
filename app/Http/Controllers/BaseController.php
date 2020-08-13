<?php

namespace App\Http\Controllers;

use App\Adapters\EventSenderAdapter;
use App\Factories\KafkaFactory;
use Arquivei\Events\Sender\Sender;
use Core\Dependencies\EventSenderInterface;
use Core\Dependencies\LogInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected LogInterface $logger;
    protected EventSenderInterface $eventSender;

    public function __construct(LogInterface $logger, EventSenderInterface $eventSender)
    {
        $this->logger = $logger;
        $this->eventSender = $eventSender;
    }
}

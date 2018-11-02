<?php


namespace App\Controllers;

use App\Models\Test;
use App\Services\MailService;

class IndexController
{

    private $mailService;
    private $message;

    public function __construct(MailService $mailService, $message)
    {
        $this->mailService = $mailService;
        $this->message = $message;
    }

    public function Index()
    {
        $test = new Test();
        $user = $test->getByName('brandon');
        echo '<pre>';
        print_r($user);
        die();
        echo $this->message;
    }

}
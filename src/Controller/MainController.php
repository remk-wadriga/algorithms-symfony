<?php

namespace App\Controller;

use App\Service\ArraySortingService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(ArraySortingService $arraySorter)
    {
        dd($arraySorter->getSorter());
    }
}
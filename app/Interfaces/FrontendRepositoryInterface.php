<?php

namespace App\Interfaces;

interface FrontendRepositoryInterface
{
    public function getDataMainPage();
    public function getBusinessDetails($id);
}

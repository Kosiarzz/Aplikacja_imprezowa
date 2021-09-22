<?php

namespace App\Interfaces;

interface FrontendRepositoryInterface
{
    public function getDataMainPage();
    public function getBusinessDetails($id);
    public function getSearchCities(string $term);
    public function getSearchResults(string $city);
}

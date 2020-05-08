<?php

namespace App\Repositories;

interface Repository
{
    public function makeDataSet();
    public function filterData($query);
}

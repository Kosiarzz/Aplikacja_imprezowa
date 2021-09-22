<?php

namespace App\Presenters;

trait BusinessPresenter
{
    public function getLinkAttribute()
    {
        return route('businessDetails', ['id' => $this->id]);
    }
}
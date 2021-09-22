<?php

namespace App\Presenters;

trait CommentPresenter
{
    //Wyświetlanie gwiazdek(oceny)
    public function getRatingAttribute($value)
    {
        $str = '';

        for($i=1; $i<=5; $i++)
        {
            if($value >= $i){
                $str.='X';
            }
            else
            {
                $str.='x';
            }
        }

        return $str;
    }

}
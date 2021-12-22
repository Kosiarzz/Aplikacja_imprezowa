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
                $str.='<i class="fas fa-star" style="color:gold;"></i>';
            }
            else
            {
                $str.='<i class="fas fa-star" style="color:gray;"></i>';
            }
        }
        $data = [
            'str' => $str,
            'value' => $value,
        ];

        return $data;
    }

}
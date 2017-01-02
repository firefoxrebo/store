<?php
namespace Lilly\Core;

trait Filter
{
    public function filterString($str)
    {
        return htmlentities(filter_var(trim($str), FILTER_SANITIZE_STRING), ENT_QUOTES, 'utf-8');
    }
    
    public function filterInt($number)
    {
        return htmlentities(filter_var(trim($number), FILTER_SANITIZE_NUMBER_INT), ENT_QUOTES, 'utf-8');
    }

    public function filterFloat($number)
    {
        return htmlentities(filter_var(trim($number), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION), ENT_QUOTES, 'utf-8');
    }
    
    public function filterEmail($email)
    {
        return htmlentities(filter_var(trim($email), FILTER_SANITIZE_EMAIL), ENT_QUOTES, 'utf-8');
    }

    public function filterStringArray(array $arr)
    {
        foreach ($arr as $key => $value) {
            $arr[$key] = htmlentities(filter_var(trim($value), FILTER_SANITIZE_STRING), ENT_QUOTES, 'utf-8');
        }
        return $arr;
    }
}
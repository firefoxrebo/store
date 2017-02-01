<?php
namespace Lilly\Core;

trait Validator
{
    public function validate($role, $value)
    {
        if($role == 'required') {
            return $this->required($value);
        }
        if($role == 'alphanumeric') {
            return $this->alphanumeric($value);
        }
        if($role == 'alpha') {
            return $this->alpha($value);
        }
        if($role == 'num') {
            return $this->num($value);
        }
        if($role == 'float') {
            return $this->float($value);
        }
        if($role == 'date') {
            return $this->date($value);
        }
        if($role == 'email') {
            return $this->email($value);
        }
        if($role == 'url') {
            return $this->url($value);
        }
        if(preg_match('/between\([0-9]+,[0-9]+\)/', $role)) {
            if(preg_match_all('/strbetween/', $role, $matches)) {
                preg_match_all('/strbetween\(([0-9]+),([0-9]+)\)/', $role, $matches);
                $min = $matches[1][0];
                $max = $matches[2][0];
                return $this->strbetween($min, $max, $value);
            } elseif (preg_match_all('/intbetween/', $role, $matches)) {
                preg_match_all('/intbetween\(([0-9]+),([0-9]+)\)/', $role, $matches);
                $min = $matches[1][0];
                $max = $matches[2][0];
                return $this->intbetween($min, $max, $value);
            }
        }
        if(preg_match('/lt\([0-9]+\)/', $role)) {
            preg_match_all('/lt\(([0-9]+)\)/', $role, $matches);
            $lt = $matches[1][0];
            return $this->lt($lt, $value);
        }
        if(preg_match('/gt\([0-9]+\)/', $role)) {
            preg_match_all('/gt\(([0-9]+)\)/', $role, $matches);
            $gt = $matches[1][0];
            return $this->gt($gt, $value);
        }
        if(preg_match('/lte\([0-9]+\)/', $role)) {
            preg_match_all('/lte\(([0-9]+)\)/', $role, $matches);
            $lte = $matches[1][0];
            return $this->lte($lte, $value);
        }
        if(preg_match('/gte\([0-9]+\)/', $role)) {
            preg_match_all('/gte\(([0-9]+)\)/', $role, $matches);
            $gte = $matches[1][0];
            return $this->gte($gte, $value);
        }
        if(preg_match('/equals\([a-zA-Z]+\)/', $role)) {
            preg_match_all('/equals\(([a-zA-Z]+)\)/', $role, $matches);
            $matchAgainst = $matches[1][0];
            return $this->equals($matchAgainst, $value);
        }
    }

    public function alphanumeric($str)
    {
        if($str != '') {
            return !preg_match('/[^a-zA-Z0-9\:\?\\-؟\p{Arabic}\s٠١٢٣٤٥٦٧٨٩]/ui', $str);
        }
        return true;
    }

    public function alpha($str)
    {
        if($str != '') {
            return !preg_match('/[^a-zA-Z\:\?\\-؟\p{Arabic}\s]/ui', $str);
        }
        return true;
    }

    public function required($value)
    {
        return '' != $value;
    }
    
    public function num($value)
    {
        if($value != '') {
            return !preg_match('/[^0-9٠١٢٣٤٥٦٧٨٩]/i', $value);
        }
        return true;
    }

    public function float($value)
    {
        if($value != '') {
            return !preg_match('/[^0-9٠١٢٣٤٥٦٧٨٩.]/i', $value);
        }
        return true;
    }
    
    public function strbetween($min, $max, $value)
    {
        if($value != '') {
            $charsCount = mb_strlen($value);

            if($charsCount >= $min && $charsCount <= $max)
            {
                return true;
            }
            return false;
        }
        return true;
    }

    public function intbetween($min, $max, $value)
    {
        $value = (string) $value;
        $numbersCount = strlen($value);
        if($numbersCount >= $min && $numbersCount <= $max)
        {
            return true;
        }
        return false;
    }

    public function equals($matchAgainst, $value)
    {
        return $_POST[$matchAgainst] == $value;
    }

    public function date($value)
    {
        if($value != '') {
            return !preg_match('/^[1-9][1-9][1-9][1-9]-[0-1]?[0-2]-(?:[0-2]?[1-9]|[3][0-1])$/', $value);
        }
        return true;
    }

    public function email($value)
    {
        if($value != '') {
            return !preg_match('/^(?=[A-Z0-9][A-Z0-9@._%+-]{5,253}+$)[A-Z0-9._%+-]{1,64}+@(?:(?=[A-Z0-9-]{1,63}+\.)[A-Z0-9]++(?:-[A-Z0-9]++)*+\.){1,8}+[A-Z]{2,63}+$/', $value);
        }
        return true;
    }

    public function url($value)
    {
        if($value != '') {
            return !preg_match('/^(?:https?:\/\/)(?:www\d?\.)?[-\w\d&#%?\/=\.+]+$/', $value);
        }
        return true;
    }

    public function lt($lt, $value)
    {
        if($this->num($value)) {
            $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
            if($lt > $value) {
                return true;
            }
            return false;
        } else {
            $strlength = mb_strlen($value);
            if($lt > $strlength) {
                return true;
            }
            return false;
        }
    }

    public function lte($lte, $value)
    {
        if($this->num($value)) {
            $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
            if($lte >= $value) {
                return true;
            }
            return false;
        } else {
            $strlength = mb_strlen($value);
            if($lte >= $strlength) {
                return true;
            }
            return false;
        }
    }
    
    public function gt($gt, $value)
    {
        if($this->num($value)) {
            $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
            if($value > $gt) {
                return true;
            }
            return false;
        } else {
            $strlength = mb_strlen($value);
            if($strlength > $gt) {
                return true;
            }
            return false;
        }
    }

    public function gte($gte, $value)
    {
        if($this->num($value)) {
            $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
            if($value >= $gte) {
                return true;
            }
            return false;
        } else {
            $strlength = mb_strlen($value);
            if($strlength >= $gte) {
                return true;
            }
            return false;
        }
    }
}
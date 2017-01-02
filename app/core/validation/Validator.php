<?php
namespace Lilly\Core\Validation;


class Validator
{
    public $_lang;

    const DATA_TYPE_ALPHA_NUMERIC = 'a-zA-Z0-9';
    const DATA_TYPE_ALPHA_ONLY = 'a-zA-Z';
    const DATA_TYPE_NUMERIC_ONLY = '0-9';
    const DATA_TYPE_ALPHA_NUMERIC_WITH_SPACES = 'a-zA-Z0-9 ';
}
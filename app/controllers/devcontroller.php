<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models\CategoryModel;
use Lilly\Models\ProductModel;
use Lilly\Models\ProfileModel;
use Lilly\Models\TeacherModel;
use Lilly\Models\UserClassModel;

class DevController extends AbstractController
{
    public function defaultAction ()
    {
        phpinfo();
    }
}
<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models\ProfileModel;
use Lilly\Models\TeacherModel;
use Lilly\Models\UserClassModel;

class DevController extends AbstractController
{
    public function defaultAction ()
    {
        $user = new TeacherModel();
        $user->ucname = 'demo';
        $user->cryptPwd('demo@2017');
        $user->joined = date('Y-m-d');
        $user->privilege = 6;
        $user->schoolId = 25;
        $user->status = 1;
        if($user->save()) {
            $classes = [3,4,5,6,7];
            foreach ($classes as $class) {
                $cu = new UserClassModel();
                $cu->userId = $user->id;
                $cu->classId = $class;
                $cu->save();
            }
            $userProfile = new ProfileModel;
            $userProfile->userid = $user->id;
            $userProfile->firstname = 'Demo';
            $userProfile->email = 'demo@demo.com';
            $userProfile->save();
            echo $user->ucname;
        }
//        $file = CONTROLLERS_PATH . DS . 'level1unit1.txt';
//        $handler = fopen($file, 'r');
//        $unit = 5;
//        $weeks = [1,2,3];
//        $days = [1,2,3,4,5];
//        for ($i = 0; $i < count($weeks); $i++) {
//            if(feof($handler)) {
//                break;
//            }
//            for ($j = 0; $j < count($days); $j++) {
//                if(feof($handler)) {
//                    break;
//                }
//                for ($l = 0; $l < 8; $l++) {
//                    if(!feof($handler)) {
//                        $skill = new SkillModel();
//                        $skill->title = fgets($handler);
//                        $skill->unitId = $unit;
//                        $skill->day = $days[$j];
//                        $skill->week = $weeks[$i];
//                        $skill->save();
//                    } else {
//                        break;
//                    }
//                }
//            }
//        }
    }
}
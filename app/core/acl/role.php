<?php
namespace Lilly\Core\ACL;

class Role
{
    const MANAGER_ROLE = 1;
    const SCHOOL_MANAGER_ROLE = 2;
    const SCHOOL_SUPERVISOR_ROLE = 3;
    const SCHOOL_TEACHER_ROLE = 4;
    const PARENT_ROLE = 5;
    const DEMO_ROLE = 6;

    protected $roles = array();
    
    protected function __construct() {}
    
    private function __clone() {}
    
    public static function roleFactory($type)
    {
        $roleObj = null;
        switch ($type) {
            case self::MANAGER_ROLE:
                $roleObj = new ManagerRole;
                break;
            case self::SCHOOL_MANAGER_ROLE:
                $roleObj = new SchoolManagerRole();
                break;
            case self::SCHOOL_SUPERVISOR_ROLE:
                $roleObj = new SupervisorRole();
                break;
            case self::SCHOOL_TEACHER_ROLE:
                $roleObj = new TeacherRole();
                break;
            case self::PARENT_ROLE:
                $roleObj = new ParentRole();
                break;
            case self::DEMO_ROLE:
                $roleObj = new DemoRole();
                break;
        }
        return $roleObj;
    }
    
    public function getRoles()
    {
        return $this->roles;
    }
}
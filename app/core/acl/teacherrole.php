<?php
namespace Lilly\Core\ACL;

class TeacherRole extends Role
{
    protected $roles = array(

        '/reports',
        '/reports/default',
        '/reports/checkinout',
        '/reports/places',
        '/reports/skills',
        '/reports/studentonunit',
        '/reports/studentonlevel',
        '/reports/class',

        '/notes',
        '/notes/default',
        '/notes/add',
        '/notes/edit',
        '/notes/delete',

        '/students',
        '/students/default',
        '/students/add',
        '/students/edit',
        '/students/delete',
        '/students/view',
        '/students/report',

        // General Roles
        '/',
        '/index',
        '/index/default',

        '/lang',
        '/land/default',
        
        '/user/profile',
        '/user/password',
        
        '/settings',
        '/settings/default',

        '/mail',
        '/mail/default',
        '/mail/new',
        '/mail/view',
        '/mail/delete',
        '/mail/reply',
        '/mail/forward',
        '/mail/sent',
        
        '/notification',
        '/notification/view',
        '/notification/delete',
        
        '/auth/login',
        '/auth/logout',
        '/auth/denied',
        '/notfound',

        '/media/mediaexists',
        '/cards/teacherpreview',
        '/activities/teacherpreview',
        '/units/teacherdefault',
        '/units/teacherpreview',

    );
}
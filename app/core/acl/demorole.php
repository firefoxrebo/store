<?php
namespace Lilly\Core\ACL;

class DemoRole extends Role
{
    protected $roles = array(

        '/students/view',

        '/units/teacherdefault',
        '/units/teacherpreview',

        '/reports',
        '/reports/default',
        '/reports/checkinout',
        '/reports/places',
        '/reports/skills',

        '/notes',
        '/notes/default',

        '/students',
        '/students/default',
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
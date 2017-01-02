<?php
namespace Lilly\Core\ACL;

class SchoolManagerRole extends Role
{
    protected $roles = array(

        '/user/defaultschool',
        '/user/viewschoolmember',
        '/user/resetpassword',
        '/user/addsupervisor',
        '/user/addteacher',
        '/user/addparent',
        '/user/editsupervisor',
        '/user/editteacher',
        '/user/editparent',
        '/user/deletesupervisor',
        '/user/deleteteacher',
        '/user/deleteparent',
        '/user/canadduser',
        '/user/cannotadduser',

        '/reports',
        '/reports/default',
        '/reports/checkinout',
        '/reports/places',
        '/reports/skills',
        '/reports/studentonunit',
        '/reports/studentonlevel',
        '/reports/class',

        '/classes',
        '/classes/default',
        '/classes/add',
        '/classes/edit',
        '/classes/delete',
        '/classes/view',

        '/students',
        '/students/default',
        '/students/add',
        '/students/edit',
        '/students/delete',
        '/students/view',
        '/students/report',

        '/units/teacherdefault',
        '/units/teacherpreview',

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

        '/licenses',
        '/licenses/default',
        
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
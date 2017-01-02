<?php
namespace Lilly\Core\ACL;

class ParentRole extends Role
{
    protected $roles = array(

        '/user',
        '/user/default',
        '/user/add',
        '/user/edit',
        '/user/delete',
        '/user/view',
        '/user/resetpassword',

        '/schools',
        '/schools/default',
        '/schools/add',
        '/schools/edit',
        '/schools/delete',
        '/schools/view',

//        '/schoolsetup:deny(note,schema):denyfrom(127.0.0.1)',
        '/schoolsetup',
        '/schoolsetup/default',
        '/schoolsetup/license',
        '/schoolsetup/classes',

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

        '/units',
        '/units/default',
        '/units/teacherdefault',
        '/units/teacherpreview',
        '/units/add',
        '/units/edit',
        '/units/delete',
        '/units/view',

        '/chapters',
        '/chapters/default',
        '/chapters/add',
        '/chapters/edit',
        '/chapters/delete',
        '/chapters/view',

        '/media',
        '/media/default',
        '/media/add',
        '/media/edit',
        '/media/delete',
        '/media/view',

        '/licenses',
        '/licenses/default',
        '/licenses/add',
        '/licenses/edit',
        '/licenses/delete',
        '/licenses/view',

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

    );
}
<?php
namespace Lilly\Core\ACL;

class ManagerRole extends Role
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
        '/schools/disable',
        '/schools/enable',

//        '/schoolsetup:deny(note,schema):denyfrom(127.0.0.1)',
        '/schoolsetup',
        '/schoolsetup/default',
        '/schoolsetup/license',
        '/schoolsetup/user',

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
        '/units/forcedelete',
        '/units/view',

        '/chapters',
        '/chapters/default',
        '/chapters/add',
        '/chapters/edit',
        '/chapters/delete',
        '/chapters/view',

        '/cardchapters',
        '/cardchapters/default',
        '/cardchapters/add',
        '/cardchapters/edit',
        '/cardchapters/delete',

        '/actchapters',
        '/actchapters/default',
        '/actchapters/add',
        '/actchapters/edit',
        '/actchapters/delete',

        '/media',
        '/media/default',
        '/media/add',
        '/media/edit',
        '/media/delete',
        '/media/view',
        '/media/open',
        '/media/mediaexists',

        '/cards',
        '/cards/default',
        '/cards/add',
        '/cards/edit',
        '/cards/delete',
        '/cards/view',
        '/cards/teacherpreview',

        '/activities',
        '/activities/default',
        '/activities/add',
        '/activities/edit',
        '/activities/delete',
        '/activities/view',
        '/activities/teacherpreview',

        '/licenses',
        '/licenses/default',
        '/licenses/add',
        '/licenses/edit',
        '/licenses/delete',
        '/licenses/view',

        '/skills',
        '/skills/default',
        '/skills/add',
        '/skills/edit',
        '/skills/delete',

        '/parentfiles',
        '/parentfiles/default',
        '/parentfiles/add',
        '/parentfiles/edit',
        '/parentfiles/delete',
        '/parentfiles/view',

        // General Roles
        '/',
        '/index',
        '/index/default',

        '/lang',
        '/land/default',
        
        '/user/profile',
        '/user/password',
        '/user/add',
        '/user/addsupervisor',
        '/user/addteacher',
        '/user/addparent',
        
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
        '/dev'

    );
}
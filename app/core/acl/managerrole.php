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
        '/user/profile',
        '/user/password',

        '/suppliers',
        '/suppliers/default',
        '/suppliers/add',
        '/suppliers/edit',
        '/suppliers/delete',
        '/suppliers/view',

        '/clients',
        '/clients/default',
        '/clients/add',
        '/clients/edit',
        '/clients/delete',
        '/clients/view',

        '/categories',
        '/categories/default',
        '/categories/add',
        '/categories/edit',
        '/categories/delete',

        '/products',
        '/products/default',
        '/products/add',
        '/products/edit',
        '/products/delete',
        '/products/view',

        '/purchases',
        '/purchases/default',
        '/purchases/add',
        '/purchases/edit',
        '/purchases/delete',
        '/purchases/view',

        '/sales',
        '/sales/default',
        '/sales/add',
        '/sales/edit',
        '/sales/delete',
        '/sales/view',


        '/store',
        '/store/default',

        // General Roles
        '/',
        '/index',
        '/index/default',

        '/lang',
        '/land/default',

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
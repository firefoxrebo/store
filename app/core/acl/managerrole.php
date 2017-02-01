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

        '/supplierstransactions',
        '/supplierstransactions/default',
        '/supplierstransactions/add',
        '/supplierstransactions/edit',
        '/supplierstransactions/delete',
        '/supplierstransactions/view',

        '/clientstransactions',
        '/clientstransactions/default',
        '/clientstransactions/add',
        '/clientstransactions/edit',
        '/clientstransactions/delete',
        '/clientstransactions/view',


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
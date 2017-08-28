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
        '/purchases/deliverproducts',

        '/sales',
        '/sales/default',
        '/sales/add',
        '/sales/edit',
        '/sales/delete',
        '/sales/view',

        '/safetybox',
        '/safetybox/default',

        '/receiptvoucher',
        '/receiptvoucher/default',
        '/receiptvoucher/add',
        '/receiptvoucher/edit',
        '/receiptvoucher/delete',
        '/receiptvoucher/view',
        '/receiptvoucher/attachcopy',

        '/paymentvoucher',
        '/paymentvoucher/default',
        '/paymentvoucher/add',
        '/paymentvoucher/edit',
        '/paymentvoucher/delete',
        '/paymentvoucher/view',
        '/paymentvoucher/attachcopy',

        '/outcomevouchers',
        '/outcomevouchers/default',
        '/outcomevouchers/add',
        '/outcomevouchers/edit',
        '/outcomevouchers/delete',
        '/outcomevouchers/view',
        '/outcomevouchers/attachcopy',

        '/incomevouchers',
        '/incomevouchers/default',
        '/incomevouchers/add',
        '/incomevouchers/edit',
        '/incomevouchers/delete',
        '/incomevouchers/view',
        '/incomevouchers/attachcopy',

        '/expensescategories',
        '/expensescategories/default',
        '/expensescategories/add',
        '/expensescategories/edit',
        '/expensescategories/delete',

        '/expenseslist',
        '/expenseslist/default',
        '/expenseslist/add',
        '/expenseslist/edit',
        '/expenseslist/delete',

        '/expenses',
        '/expenses/default',
        '/expenses/add',
        '/expenses/edit',
        '/expenses/delete',

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
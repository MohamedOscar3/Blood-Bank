<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $table = 'Permissions';
    
    protected $fillable = ['name','display_name','description'];

}

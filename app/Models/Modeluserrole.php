<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeluserrole extends Model
{
    protected $table      = 'user_role';
    protected $primaryKey = 'id';

    protected $allowedFields = ['role'];
}

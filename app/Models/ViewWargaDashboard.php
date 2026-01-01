<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewWargaDashboard extends Model
{
    protected $table = 'view_warga_dashboard';

    protected $primaryKey = 'warga_id';

    public $incrementing = false;
    public $timestamps = false;

    // View bersifat read-only
    protected $guarded = [];

}

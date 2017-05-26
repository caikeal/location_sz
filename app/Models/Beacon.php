<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beacon extends Model
{
    protected $table = 'beacons';

    protected $fillable = ['major', 'minor', 'rssi', 'x', 'y', 'floor', 'accuracy'];
}

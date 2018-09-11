<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{
    // editable columns
		protected $fillable = [
			'privilege'
		];
}

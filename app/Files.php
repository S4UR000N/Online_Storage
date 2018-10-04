<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    // editable columns
		protected $fillable = [
			'deleted_at',
		];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    // editable columns
		protected $fillable = [
			'file',
			'deleted_at'
		];
}

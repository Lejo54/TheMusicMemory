<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyUser extends Model {
	public $timestamps = false;
	protected $table = 'myusers';
	protected $primaryKey = 'login';
	protected $keyType = 'string';

	public function memos(): HasMany
	{
		return $this->hasMany(Memo::class,'owner');
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Charity extends Model
{
	protected $table = 'charities';

	protected $fillable = ['name','location','category','description'];

	protected $hidden = ['password'];
}

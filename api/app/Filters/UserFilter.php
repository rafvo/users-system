<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AlternativesTemplateGroupFilter
 * 
 * @property int $limit
 * @property int $offset
 * 
 *
 * @package App\Filters
 */
class UserFilter extends Model
{
	protected $casts = [
		'limit' => 'int',
		'offset' => 'int'
	];

	protected $fillable = [
		'limit',
		'offset'
	];
}
<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model {
	protected $table = 'paciente';
	protected $primaryKey = 'registro';
	public $timestamps = false;
}

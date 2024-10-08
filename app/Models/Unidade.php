<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Unidade extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'inaugural_date'];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot(){
        parent::boot();

        static::creating(function ($model) {
            if (!$model-> getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function atendimentos()
{
    return $this->hasMany(Atendimento::class, 'unidade_id');
}

}

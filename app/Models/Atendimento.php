<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Atendimento extends Model 
{
    use HasFactory;

    protected $fillable = [
        'unidade_id', 'servico_id', 'usuario_id', 'comentarios', 'qtd', 'date'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model){
            if(empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }

    // Corrigido o nome do método para usuario (singular)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
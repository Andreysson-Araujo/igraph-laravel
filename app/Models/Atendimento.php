<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model 
{
  use HasFactory;

  protected $fillable = [
    'unidade_id', 'servico_id', 'usuario_id', 'comentarios', 'qtd', 'date'
  ];

  public function unidade()
  {
    return $this->belongsTo(Unidade::class);
  }

  public function servico()
  {
    return $this->belongsTo(Servico::class);
  }

  public function usuarios()
  {
    return $this->belongsTo(User::class);
  }
}
<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terminu extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'terminus';

    protected $dates = [
        'start_time',
        'finish_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'pacjent_id',
        'zaposlenik_id',
        'start_time',
        'finish_time',
        'komentar',
        'created_at',
        'updated_at',
        'deleted_at',
        'selected_teeth',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function pacjent()
    {
        return $this->belongsTo(Pacjenti::class, 'pacjent_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'pacjent_id');
    }


    public function zaposlenik()
    {
        return $this->belongsTo(Zaposlenici::class, 'zaposlenik_id');
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getFinishTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setFinishTimeAttribute($value)
    {
        $this->attributes['finish_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}

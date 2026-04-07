<?php 
use Illuminate\Database\Eloquent\Model;

class AlarmOccurrence extends Model {
    protected $table = 'alarm_occurrences';
    
    public function alarm() {
        return $this->belongsTo(Alarm::class, 'alarm_id');
    }

    protected $fillable = [
        'alarm_id',
        'started_at',
        'ended_at',
        'status'
    ];
}
?>
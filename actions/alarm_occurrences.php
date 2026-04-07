<?php 

AlarmOccurrence::create([
    'alarm_id' => $alarm_id,
    'started_at' => date('Y-m-d H:i:s'),
    'status' => 'ativo'
]);

$occurrence->update([ 
    'ended_at' => date('Y-m-d H:i:s'),
    'status' => 'resolvido'
]);

?>
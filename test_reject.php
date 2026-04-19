<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $klaim = \App\Models\Klaim::find(1);
    
    // Test rejection logic
    if ($klaim->item) {
        $klaim->item->update(['status' => 'Tersedia']);
    }
    
    $klaim->update([
        'status_klaim' => 'Ditolak'
    ]);
    
    echo "SUCCESS\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "TRACE: " . $e->getTraceAsString() . "\n";
}

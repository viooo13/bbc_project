<?php
require 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$pending = App\Models\Pesanan::where('status', 'pending')->get();
echo "Pending orders: " . $pending->count() . PHP_EOL;

foreach ($pending as $p) {
    echo $p->order_id . ' | snap_token: ' . ($p->snap_token ?: 'NULL') . ' | Rp ' . number_format($p->total_price) . ' | ' . $p->customer_name . PHP_EOL;
}

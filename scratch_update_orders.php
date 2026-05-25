<?php
require 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$orders = App\Models\Pesanan::where('status', 'pending')->whereNull('snap_token')->get();
foreach($orders as $o) {
    $old = $o->order_id;
    // append 'N' to make it a new order id for midtrans
    $o->order_id = $old . 'N';
    $o->save();
    echo 'Updated ' . $old . ' to ' . $o->order_id . PHP_EOL;
}
echo "Done.";

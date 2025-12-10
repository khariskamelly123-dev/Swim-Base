<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Auth;

$email = 'superadmin@example.com';
$password = 'password';

$ok = Auth::attempt(['email' => $email, 'password' => $password]);
echo 'attempt: ' . ($ok ? 'true' : 'false') . "\n";
if ($ok) {
    $u = Auth::user();
    echo 'user: ' . ($u->email ?? '') . "\n";
    echo 'role: ' . ($u->role ?? '') . "\n";
}

exit(0);

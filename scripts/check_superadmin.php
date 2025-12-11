<?php

// Script untuk memeriksa keberadaan akun superadmin dan kecocokan password
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = 'superadmin@example.com';
$plain = 'password';

$u = User::where('email', $email)->first();
if (! $u) {
    echo "USER_NOT_FOUND\n";
    exit(1);
}

echo "email: " . $u->email . "\n";
echo "name: " . ($u->name ?? 'null') . "\n";
echo "role: " . ($u->role ?? 'null') . "\n";
echo "password_match: " . (Hash::check($plain, $u->password) ? 'true' : 'false') . "\n";

exit(0);

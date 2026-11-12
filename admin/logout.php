<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/auth.php';
admin_logout();
header('Location: /admin/', true, 302);

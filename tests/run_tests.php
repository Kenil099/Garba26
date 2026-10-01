<?php

require_once __DIR__ . '/../config/app.php';

echo "\n============================================\n";
echo "   GARBA26 TEST SUITE RUNNER\n";
echo "============================================\n\n";

$tests = [
    'AuthTest.php' => __DIR__ . '/AuthTest.php',
    'SongTest.php' => __DIR__ . '/SongTest.php',
    'PlaylistTest.php' => __DIR__ . '/PlaylistTest.php',
    'SearchTest.php' => __DIR__ . '/SearchTest.php',
];

$passed = 0;
$total = count($tests);

foreach ($tests as $name => $path) {
    echo "Running [{$name}]...\n";
    $output = [];
    $exitCode = 0;
    exec(PHP_BINARY . " " . escapeshellarg($path), $output, $exitCode);
    
    echo implode("\n", $output) . "\n";
    if ($exitCode === 0) {
        $passed++;
        echo "--> {$name}: PASSED\n\n";
    } else {
        echo "--> {$name}: FAILED (code {$exitCode})\n\n";
    }
}

echo "============================================\n";
echo "Result: {$passed}/{$total} test suites passed.\n";
echo "============================================\n";

exit($passed === $total ? 0 : 1);

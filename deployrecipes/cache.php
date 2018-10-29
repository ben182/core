<?php

namespace Deployer;

task('artisan:clearAllCaches', function () {
    $aCommands = get('clearCachesCommands') ?: ['view:clear'];
    foreach ($aCommands as $sCommand) {
        run("cd {{release_path}} && php artisan $sCommand");
    }
});

task('artisan:cacheEverything', function () {
    $aCommands = get('cacheEverythingCommands') ?: [];
    foreach ($aCommands as $sCommand) {
        run("cd {{release_path}} && php artisan $sCommand");
    }
});

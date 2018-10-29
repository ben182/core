<?php

namespace Deployer;

task('artisan:backup', function () {
    run("cd {{release_path}} && php artisan backup:run");
});

<?php

namespace Deployer;

task('artisan:backup', function () {
    run("cd {{current_path}} && php artisan backup:run");
});

<?php

arch('check for debuggers in the whole project')
    ->expect(['dump', 'dd', 'ddd', 'kint', 'ray', 'ds', 'var_dump', 'print_r', 'exit', 'die'])
    ->not->toBeUsed();

arch('package do not use to Strict Types')
->expect('TioJobs\AsaasPhp')
->not->toUseStrictTypes();

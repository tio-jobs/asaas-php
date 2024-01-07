<?php

arch('check debuggers in whole project')
    ->expect(['dd', 'dump', 'print_r', 'exit', 'die', 'ray'])
    ->not->toBeUsed();

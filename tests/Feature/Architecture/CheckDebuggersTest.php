<?php

arch('check debuggers in whole project')
    ->expect(['ds', 'dd', 'dump', 'print_r', 'exit', 'die', 'ray'])
    ->not->toBeUsed();

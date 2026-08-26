<?php

arch()->preset()->php();

arch()->expect('App')
    ->not->toUse(['dd', 'die', 'dump', 'eval']);

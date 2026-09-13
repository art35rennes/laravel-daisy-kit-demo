<?php

use Tests\TestCase;

uses(TestCase::class)->in('Feature', 'Browser');

pest()->browser()->timeout(10_000);

pest()->tia()->directory('.pest/tia');

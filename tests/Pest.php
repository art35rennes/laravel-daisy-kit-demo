<?php

use Tests\TestCase;

uses(TestCase::class)->in('Feature', 'Browser');

pest()->tia()->directory('.pest/tia');

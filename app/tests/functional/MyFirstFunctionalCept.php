<?php
$I = new TestGuy($scenario);

$I->wantTo('check the default homepage');

$I->amOnPage('/');

$I->see('You have arrived.');

<?php

use Bengels\LaravelTable\Components\Table\Table;
use Bengels\LaravelTable\Component\Table\Action;
use Bengels\LaravelTable\Components\Table\Td;
use Bengels\LaravelTable\Component\Button\EditButton;
use Bengels\LaravelTable\Component\Button\DeleteButton;
use Bengels\LaravelTable\Component\Button\ShowButton;

return [
	'prefix' => '',

	/* tailwind-3 | bootstrap-5 */
	'framework' => 'bootstrap-5',
	'components' => [
		'table' => [
			'view'  => 'form-components::{framework}.table',
			'class' => Table::class,
		],

	],
];
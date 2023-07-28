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
			'view'  => 'table-components::{framework}.table.table',
			'class' => Table::class,
		],
		'action' => [
			'view'  => 'table-components::{framework}.table.action',
			'class' => Action::class,
		],
		'td' => [
			'view'  => 'table-components::{framework}.table.td',
			'class' => Td::class,
		],
		'btn-edit' => [
			'view'  => 'table-components::{framework}.button.edit',
			'class' => EditButton::class,
		],
		'btn-delete' => [
			'view'  => 'table-components::{framework}.button.delete',
			'class' => DeleteButton::class,
		],
		'btn-show' => [
			'view'  => 'table-components::{framework}.button.show',
			'class' => ShowButton::class,
		],
	],
];
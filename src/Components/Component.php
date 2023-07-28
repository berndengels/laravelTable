<?php

namespace Bengels\LaravelTable\Component;

use Illuminate\Support\Str;
use Illuminate\View\Component as BaseComponent;

abstract class Component extends BaseComponent
{
	public function render()
	{
		$alias		= Str::kebab(class_basename($this));
		$config		= config("table-components.components.{$alias}");
		$framework	= config("table-components.framework");

		return str_replace('{framework}', $framework, $config['view']);
	}
}
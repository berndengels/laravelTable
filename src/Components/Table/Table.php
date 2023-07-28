<?php

namespace Bengels\LaravelTable\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Bengels\LaravelTable\Component\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class Table extends Component
{
    private $styles = [];
    private $captions = [];
    private $links = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Collection|LengthAwarePaginator $items,
        public array $fields,
        public ?array $sortable = null,
        public ?bool $isSmall = true,
        public ?bool $striped = true,
        public ?bool $hasActions = false,
        public ?string $class = null,
    )
    {
        $user = auth('admin')->user();

        if($this->items && $this->items->count() > 0) {
            $classBasename = class_basename(get_class($this->items->first()));
            if( ! $user->hasRole('superadmin') || ! auth('admin')->user()->can("write $classBasename")) {
                $this->hasActions = false;
            }
        }


        foreach ($this->fields as $field) {
            if(false !== stristr($field, ':')) {
                [$f, $c] = explode(':', $field);
                $this->styles[$f] = ($c && $c !== 'sm') ? "d-none d-{$c}-table-cell" : null;
                $this->captions[$f] = $f;
            } else {
                $this->styles[$field] = null;
                $this->captions[$field] = $field;
            }
        }

        if($this->sortable) {
             collect($this->sortable)->each(function($field, $key) {
                 $this->links[$field] = [$key, $field];
            });
        }
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.table.table', [
            'items'         => $this->items,
            'fields'        => $this->fields,
            'styles'        => $this->styles,
            'captions'      => $this->captions,
            'links'         => $this->links,
            'hasActions'    => $this->hasActions,
            'isSmall'       => $this->isSmall,
        ]);
    }
}

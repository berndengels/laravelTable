<?php

namespace Bengels\LaravelTable\Components;

use Closure;
use Illuminate\View\Component;
use App\Libs\DataBinds\DataBinder;
use App\Libs\DataBinds\HandleDataValue;
use Illuminate\Contracts\View\View;

class Td extends Component
{
    use HandleDataValue;

    private $style;
    private $col;
//    public Model $model;
    public $model;
    public mixed $data;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $field,
        public $bind = null,
        public ?string $class = null,
        public ?string $link = null,
        public ?string $target = '_self',
        public ?string $icon = null,
        public ?int $short = null,
        public mixed $append = null,
        public ?string $seperator = null,
        public ?bool $translate = false,
        public ?string $email = null,
        public ?string $color = null,
        public ?bool $fon = false,
        public ?string $currency = null,
        public ?string $dateformat = null,
        public ?bool $count = false,
        public ?bool $center = false,
        public $value = null

    )
    {
        $this->model = app(DataBinder::class)->get();

        if(false !== strpos($field, ':')) {
            [$f, $c] = explode(':', $field);
            $this->style = ($c && $c !== 'sm') ? "$class d-none d-{$c}-table-cell" : $class;
            $this->col = $f;
        } else {
            $this->style = $class;
            $this->col = $field;
        }

        if($email && $this->model->{$this->col}) {
            $this->icon = 'fas fa-at';
            $this->target = '_blank';
        }
        if($fon && $this->model->{$this->col}) {
            $this->icon = 'fas fa-phone';
            $this->target = '_blank';
        }

        $this->setData($this->col, $bind);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.table.td', [
            'model' => $this->model,
            'bind'  => $this->bind,
            'style' => $this->style,
            'col'   => $this->col,
            'data'  => $this->data,
            'link'  => $this->link,
            'target'  => $this->target,
            'icon'    => $this->icon,
            'short'   => $this->short,
            'color'   => $this->color,
            'dateformat'    => $this->dateformat,
            'currency'      => $this->currency,
            'count'         => $this->count,
            'center'        => $this->center,
            'value'         => $this->value,
        ]);
    }
}

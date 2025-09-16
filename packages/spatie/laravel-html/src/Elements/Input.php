<?php

namespace Spatie\Html\Elements;

class Input extends BaseElement
{
    public function __construct(string $type)
    {
        parent::__construct('input', true);

        $this->type($type);
    }

    public function value($value): self
    {
        return $this->attribute('value', $value);
    }
}

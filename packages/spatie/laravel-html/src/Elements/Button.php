<?php

namespace Spatie\Html\Elements;

class Button extends BaseElement
{
    public function __construct()
    {
        parent::__construct('button');

        $this->type('submit');
    }

    public function text(string $content): self
    {
        return $this->value($content);
    }

    public function html(string $content): self
    {
        return $this->raw($content);
    }
}

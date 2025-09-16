<?php

namespace Spatie\Html\Elements;

class Label extends BaseElement
{
    public function __construct(?string $for = null, ?string $text = null)
    {
        parent::__construct('label');

        if ($for !== null) {
            $this->for($for);
        }

        if ($text !== null) {
            $this->value($text);
        }
    }
}

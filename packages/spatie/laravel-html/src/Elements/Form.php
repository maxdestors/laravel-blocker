<?php

namespace Spatie\Html\Elements;

class Form extends BaseElement
{
    public function __construct()
    {
        parent::__construct('form');
    }

    public function method(string $method): self
    {
        return $this->attribute('method', strtoupper($method));
    }

    public function open(): string
    {
        return sprintf('<%s%s>', $this->tag, $this->renderAttributes());
    }

    public function close(): string
    {
        return '</form>';
    }

    public function toHtml(): string
    {
        return $this->open();
    }
}

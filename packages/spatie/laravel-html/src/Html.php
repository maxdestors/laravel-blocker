<?php

namespace Spatie\Html;

use Spatie\Html\Elements\Button;
use Spatie\Html\Elements\Form;
use Spatie\Html\Elements\Input;
use Spatie\Html\Elements\Label;
use Spatie\Html\Elements\Textarea;

class Html
{
    public function form(string $method = 'POST', $action = null): Form
    {
        $form = new Form();

        $form->method(strtoupper($method));

        if ($action !== null) {
            $form->action($action);
        }

        return $form;
    }

    public function text(string $name, $value = null): Input
    {
        $element = new Input('text');
        $element->name($name);

        if ($value !== null) {
            $element->value($value);
        }

        return $element;
    }

    public function password(string $name): Input
    {
        $element = new Input('password');

        return $element->name($name);
    }

    public function hidden(string $name, $value = null): Input
    {
        $element = new Input('hidden');
        $element->name($name);

        if ($value !== null) {
            $element->value($value);
        }

        return $element;
    }

    public function textarea(string $name, $value = null): Textarea
    {
        $element = new Textarea();
        $element->name($name);

        if ($value !== null) {
            $element->value($value);
        }

        return $element;
    }

    public function label(string $for, string $text = ''): Label
    {
        $label = new Label($for);

        if ($text !== '') {
            $label->value($text);
        }

        return $label;
    }

    public function button(string $content = '', bool $isHtml = false): Button
    {
        $button = new Button();

        if ($content !== '') {
            if ($isHtml) {
                $button->html($content);
            } else {
                $button->text($content);
            }
        }

        return $button;
    }

    public function submit(string $content = ''): Button
    {
        $button = $this->button($content);

        return $button->type('submit');
    }
}

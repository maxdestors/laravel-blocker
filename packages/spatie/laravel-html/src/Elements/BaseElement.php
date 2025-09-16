<?php

namespace Spatie\Html\Elements;

class BaseElement
{
    protected string $tag;

    /**
     * @var array<string, string>
     */
    protected array $attributes = [];

    protected bool $selfClosing = false;

    protected string $content = '';

    protected bool $escapeContent = true;

    public function __construct(string $tag, bool $selfClosing = false)
    {
        $this->tag = $tag;
        $this->selfClosing = $selfClosing;
    }

    public function attribute(string $name, $value): self
    {
        $attribute = $this->normalizeAttributeName($name);

        if ($value === null || $value === false) {
            unset($this->attributes[$attribute]);

            return $this;
        }

        if ($value === true) {
            $this->attributes[$attribute] = $attribute;

            return $this;
        }

        $this->attributes[$attribute] = (string) $value;

        return $this;
    }

    public function attributes(array $attributes): self
    {
        foreach ($attributes as $name => $value) {
            $this->attribute($name, $value);
        }

        return $this;
    }

    public function class(string $class): self
    {
        if (! isset($this->attributes['class'])) {
            $this->attributes['class'] = $class;

            return $this;
        }

        $current = $this->attributes['class'];

        $this->attributes['class'] = trim($current.' '.$class);

        return $this;
    }

    public function id(string $id): self
    {
        return $this->attribute('id', $id);
    }

    public function name(string $name): self
    {
        return $this->attribute('name', $name);
    }

    public function for(string $for): self
    {
        return $this->attribute('for', $for);
    }

    public function type(string $type): self
    {
        return $this->attribute('type', $type);
    }

    public function value($value): self
    {
        $this->content = (string) $value;

        return $this;
    }

    public function raw(string $content): self
    {
        $this->content = $content;
        $this->escapeContent = false;

        return $this;
    }

    public function __call(string $method, array $arguments): self
    {
        if (method_exists($this, $method)) {
            return $this->{$method}(...$arguments);
        }

        $value = $arguments[0] ?? null;

        return $this->attribute($method, $value);
    }

    public function toHtml(): string
    {
        $attributes = $this->renderAttributes();

        if ($this->selfClosing) {
            return sprintf('<%s%s>', $this->tag, $attributes);
        }

        return sprintf('<%s%s>%s</%s>', $this->tag, $attributes, $this->renderContent(), $this->tag);
    }

    public function __toString(): string
    {
        return $this->toHtml();
    }

    protected function renderAttributes(): string
    {
        if (empty($this->attributes)) {
            return '';
        }

        $compiled = [];

        foreach ($this->attributes as $name => $value) {
            $compiled[] = sprintf('%s="%s"', $name, $this->escapeAttribute($value));
        }

        return ' '.implode(' ', $compiled);
    }

    protected function renderContent(): string
    {
        if ($this->escapeContent) {
            return $this->escapeAttribute($this->content);
        }

        return $this->content;
    }

    protected function escapeAttribute(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }

    protected function normalizeAttributeName(string $name): string
    {
        $normalized = preg_replace('/([a-z])([A-Z])/', '$1-$2', $name);

        return strtolower($normalized);
    }
}

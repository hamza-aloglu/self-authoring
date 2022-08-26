<?php

namespace app;

use app\exceptions\ViewNotFoundException;

class View
{
    public function __construct(protected string $view, protected array $params = [])
    {
    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    private function render(): string
    {
        $viewPath = VIEW_PATH . '/' . $this->view . '.php';

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        foreach ($this->params as $key => $value) {
            $$key = $value;
        }


        ob_start();

        include $viewPath;

        return (string)ob_get_clean();
    }

    // since render method will be called if View object is returned, controllers return type is View if they are disp-
    // laying some views.
    public function __toString(): string
    {
        return $this->render();
    }
}
<?php

namespace Test\View;

class View
{
    private $templatePath;
    private $extractVars = [];

    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    /**
     * @param string $name
     * @param $value
     * @return void
     */
    public function setVars(string $name, $value): void
    {
        $this->extractVars[$name] = $value;
    }

    /**
     * @param string $templateName
     * @param array $templateVars
     * @param int $code
     * @return void
     */
    public function renderHtml(string $templateName, array $templateVars = [], int $code = 200): void
    {
        http_response_code($code);
        extract($this->extractVars);
        extract($templateVars);

        ob_start();
        include $this->templatePath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
    }
}
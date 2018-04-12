<?php

/* Home.twig */
class __TwigTemplate_75554a95c015e71145b81f1147aa3190292c418f336c5cf5f0685a9fe19a0135 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\"/>
        <title>Document</title>
    </head>
    <body>
        <h1>Aloha</h1>
        <label for=\"\">Your email</label>
        <input name=\"\" type=\"text\" value=\"\"/>
        <label for=\"\">Password</label>
        <input name=\"\" type=\"text\" value=\"\"/><br/>
        <input name=\"\" type=\"submit\" value=\"\"/>
    </body>
</html>

";
    }

    public function getTemplateName()
    {
        return "Home.twig";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Home.twig", "/home/peter/Code/PHP/codabra/templates/Home.twig");
    }
}

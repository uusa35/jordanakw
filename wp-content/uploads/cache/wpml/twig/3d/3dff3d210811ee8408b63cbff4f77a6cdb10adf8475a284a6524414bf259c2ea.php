<?php

/* /setup/multi-currency.twig */
class __TwigTemplate_aad3f2e2c4dd29a5783f944b803121fec453f4d633bc203c9cefe806e65f89da extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<h1>";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "heading", array()), "html", null, true);
        echo "</h1>

<p>";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "description", array()), "html", null, true);
        echo "</p>

<p>
    <label>
        <input type=\"checkbox\" value=\"1\" name=\"enabled\" ";
        // line 7
        if (($context["multi_currency_on"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />&nbsp;";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "label_mco", array()), "html", null, true);
        echo "
    </label>
</p>

<p class=\"wcml-setup-actions step\">
    <a href=\"";
        // line 12
        echo twig_escape_filter($this->env, ($context["continue_url"] ?? null), "html", null, true);
        echo "\" class=\"button button-large button-primary submit\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "continue", array()), "html", null, true);
        echo "</a>
</p>
";
    }

    public function getTemplateName()
    {
        return "/setup/multi-currency.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 12,  32 => 7,  25 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/setup/multi-currency.twig", "/var/www/html/webapps/jordanakw/wp-content/plugins/woocommerce-multilingual/templates/setup/multi-currency.twig");
    }
}

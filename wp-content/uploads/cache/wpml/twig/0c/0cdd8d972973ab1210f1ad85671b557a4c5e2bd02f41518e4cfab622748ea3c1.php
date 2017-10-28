<?php

/* template.twig */
class __TwigTemplate_3a0e96cb879c2f9197a1b35130227eaccd2c4e99f4039758a3a61c35bf3e9d27 extends Twig_Template
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
        echo "<div class=\"";
        echo twig_escape_filter($this->env, ($context["css_classes"] ?? null), "html", null, true);
        echo "\" >
\t<ul>
\t\t<li class=\"wcml-cs-active-currency\" >
\t\t\t<a class=\"wcml-cs-item-toggle\">";
        // line 4
        echo call_user_func_array($this->env->getFunction('get_formatted_price')->getCallable(), array(($context["selected_currency"] ?? null), ($context["format"] ?? null)));
        echo "</a>
\t\t\t<ul class=\"wcml-cs-submenu\">
\t\t\t\t";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
            // line 7
            echo "\t\t\t\t\t";
            if (($context["currency"] != ($context["selected_currency"] ?? null))) {
                // line 8
                echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a rel=\"";
                // line 9
                echo twig_escape_filter($this->env, $context["currency"], "html", null, true);
                echo "\">";
                echo call_user_func_array($this->env->getFunction('get_formatted_price')->getCallable(), array($context["currency"], ($context["format"] ?? null)));
                echo "</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
            }
            // line 12
            echo "\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "\t\t\t</ul>
\t\t</li>
\t</ul>
</div>";
    }

    public function getTemplateName()
    {
        return "template.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 13,  49 => 12,  41 => 9,  38 => 8,  35 => 7,  31 => 6,  26 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"{{ css_classes }}\" >
\t<ul>
\t\t<li class=\"wcml-cs-active-currency\" >
\t\t\t<a class=\"wcml-cs-item-toggle\">{{ get_formatted_price( selected_currency, format )|raw }}</a>
\t\t\t<ul class=\"wcml-cs-submenu\">
\t\t\t\t{% for currency in currencies %}
\t\t\t\t\t{% if currency != selected_currency %}
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a rel=\"{{ currency }}\">{{ get_formatted_price( currency, format )|raw }}</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t{% endif %}
\t\t\t\t{% endfor %}
\t\t\t</ul>
\t\t</li>
\t</ul>
</div>", "template.twig", "/var/www/html/webapps/jordanakw/wp-content/plugins/woocommerce-multilingual/templates/currency-switchers/legacy-dropdown/template.twig");
    }
}

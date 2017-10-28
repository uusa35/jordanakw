<?php

/* custom-files.twig */
class __TwigTemplate_634c3b86413b6b12372ad852e3afa6dbcbbec9619539686ec9ef8ad4b315e151 extends Twig_Template
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
        if (($context["is_variation"] ?? null)) {
            // line 2
            echo "    <tr><td>
";
        }
        // line 4
        echo "
<div class=\"wcml-downloadable-options\">

    <input type=\"checkbox\" name=\"wcml_file_path_option[";
        // line 7
        echo twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
        echo "]\" id=\"wcml_file_path_option\" ";
        if (($context["sync_custom"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " />
    <label for=\"wcml_file_path_option\">";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "use_custom", array()), "html", null, true);
        echo "</label>

    <ul ";
        // line 10
        if (twig_test_empty(($context["sync_custom"] ?? null))) {
            echo " style=\"display: none\"";
        }
        echo ">
        <li>
            <input type=\"radio\" name=\"wcml_file_path_sync[";
        // line 12
        echo twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
        echo "]\" value=\"auto\"
                    ";
        // line 13
        if (((($context["sync_custom"] ?? null) == "auto") || twig_test_empty(($context["sync_custom"] ?? null)))) {
            echo " checked=\"checked\"";
        }
        echo " id=\"wcml_file_path_sync_auto\" />
            <label for=\"wcml_file_path_sync_auto\">";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "use_same", array()), "html", null, true);
        echo "</label>
        </li>
        <li>
            <input type=\"radio\" name=\"wcml_file_path_sync[";
        // line 17
        echo twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
        echo "]\" value=\"self\"
                    ";
        // line 18
        if ((($context["sync_custom"] ?? null) == "self")) {
            echo " checked=\"checked\"";
        }
        echo " id=\"wcml_file_path_sync_self\" />
            <label for=\"wcml_file_path_sync_self\">";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "separate", array()), "html", null, true);
        echo "</label>
        </li>
    </ul>
    <p></p>
    ";
        // line 23
        echo ($context["nonce"] ?? null);
        echo "
</div>

";
        // line 26
        if (($context["is_variation"] ?? null)) {
            // line 27
            echo "    </td></tr>
";
        }
    }

    public function getTemplateName()
    {
        return "custom-files.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 27,  89 => 26,  83 => 23,  76 => 19,  70 => 18,  66 => 17,  60 => 14,  54 => 13,  50 => 12,  43 => 10,  38 => 8,  30 => 7,  25 => 4,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "custom-files.twig", "/var/www/html/webapps/jordanakw/wp-content/plugins/woocommerce-multilingual/templates/custom-files.twig");
    }
}

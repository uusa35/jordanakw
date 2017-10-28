<?php

/* products.twig */
class __TwigTemplate_2a869c27a8568dd08d264479c07995bf894113c20a0d3fd86a94b80ffd0af032 extends Twig_Template
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
        echo "<form method=\"post\" action=\"";
        echo twig_escape_filter($this->env, ($context["request_uri"] ?? null));
        echo "\">

\t";
        // line 3
        $this->loadTemplate("filter.twig", "products.twig", 3)->display(array_merge($context, ($context["filter"] ?? null)));
        // line 4
        echo "
\t<table class=\"widefat fixed wpml-list-table wp-list-table striped\" cellspacing=\"0\">
\t\t<thead>
\t\t\t<tr>
\t\t\t\t<th scope=\"col\" class=\"column-thumb\">
\t\t\t\t\t\t<span class=\"wc-image wcml-tip\"
\t\t\t\t\t\t\t  data-tip=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "image", array()));
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "image", array()), "html", null, true);
        echo "</span>
\t\t\t\t</th>
\t\t\t\t<th scope=\"col\" class=\"wpml-col-title ";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute(($context["filter_urls"] ?? null), "product_sorted", array()), "html", null, true);
        echo "\">
\t\t\t\t\t<a href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute(($context["filter_urls"] ?? null), "product", array()));
        echo "\">
\t\t\t\t\t\t<span>";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "product", array()), "html", null, true);
        echo "</span>
\t\t\t\t\t\t<span class=\"sorting-indicator\"></span>
\t\t\t\t\t</a>
\t\t\t\t</th>
\t\t\t\t<th scope=\"col\" class=\"wpml-col-languages\">
\t\t\t\t\t";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages_flags"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 20
            echo "\t\t\t\t\t\t<span title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["language"], "name", array()));
            echo "\">
\t\t\t\t\t\t\t<img src=\"";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($context["language"], "flag_url", array()), "html", null, true);
            echo "\"  alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["language"], "name", array()));
            echo "\"/>
\t\t\t\t\t\t</span>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "\t\t\t\t</th>
\t\t\t\t<th scope=\"col\"
\t\t\t\t\tclass=\"column-categories\">";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "categories", array()), "html", null, true);
        echo "</th>
\t\t\t\t<th scope=\"col\" class=\"column-product_type\">
\t\t\t\t\t\t<span class=\"wc-type wcml-tip\"
\t\t\t\t\t\t\t  data-tip=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "type", array()));
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "type", array()), "html", null, true);
        echo "</span>
\t\t\t\t</th>
\t\t\t\t<th scope=\"col\" id=\"date\" class=\"column-date ";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute(($context["filter_urls"] ?? null), "date_sorted", array()), "html", null, true);
        echo "\">
\t\t\t\t\t<a href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute(($context["filter_urls"] ?? null), "date", array()));
        echo "\">
\t\t\t\t\t\t<span>";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "date", array()), "html", null, true);
        echo "</span>
\t\t\t\t\t\t<span class=\"sorting-indicator\"></span>
\t\t\t\t\t</a>
\t\t\t\t</th>
\t\t\t</tr>
\t\t</thead>

\t\t<tbody>
\t\t\t";
        // line 41
        if (twig_test_empty($this->getAttribute(($context["data"] ?? null), "products", array()))) {
            // line 42
            echo "\t\t\t\t<tr>
\t\t\t\t\t<td colspan=\"6\" class=\"text-center\">
\t\t\t\t\t\t<strong>";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "no_products", array()), "html", null, true);
            echo "</strong>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t";
        } else {
            // line 48
            echo "\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["data"] ?? null), "products", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 49
                echo "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"thumb column-thumb\">
\t\t\t\t\t\t\t<a href=\"";
                // line 51
                echo $this->getAttribute($context["product"], "edit_post_link", array());
                echo "\">
\t\t\t\t\t\t\t\t<img width=\"150\" height=\"150\" src=\"";
                // line 52
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "post_thumbnail", array()), "html", null, true);
                echo "\" class=\"wp-post-image\" >
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td class=\"wpml-col-title  wpml-col-title-flag\">
\t\t\t\t\t\t\t";
                // line 56
                if (($this->getAttribute($context["product"], "post_parent", array()) != 0)) {
                    echo " &#8212; ";
                }
                // line 57
                echo "\t\t\t\t\t\t\t<strong>
\t\t\t\t\t\t\t\t";
                // line 58
                if ( !$this->getAttribute(($context["data"] ?? null), "slang", array())) {
                    // line 59
                    echo "\t\t\t\t\t\t\t\t\t<span class=\"wpml-title-flag\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
                    // line 60
                    echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "orig_flag_url", array()), "html", null, true);
                    echo "\"/>
\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t";
                }
                // line 63
                echo "
\t\t\t\t\t\t\t\t<a href=\"";
                // line 64
                echo $this->getAttribute($context["product"], "edit_post_link", array());
                echo "\" title=\"";
                echo twig_escape_filter($this->env, strip_tags($this->getAttribute($context["product"], "post_title", array())), "html", null, true);
                echo "\">
\t\t\t\t\t\t\t\t\t";
                // line 65
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "post_title", array()), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t</a>

\t\t\t\t\t\t\t\t";
                // line 68
                if (($this->getAttribute($context["product"], "post_status", array()) == "draft")) {
                    // line 69
                    echo "\t\t\t\t\t\t\t\t\t- <span class=\"post-state\">";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "draft", array()), "html", null, true);
                    echo "</span>
\t\t\t\t\t\t\t\t";
                }
                // line 71
                echo "
\t\t\t\t\t\t\t\t";
                // line 72
                if (($this->getAttribute($context["product"], "post_status", array()) == "private")) {
                    // line 73
                    echo "\t\t\t\t\t\t\t\t\t- <span class=\"post-state\">";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "private", array()), "html", null, true);
                    echo "</span>
\t\t\t\t\t\t\t\t";
                }
                // line 75
                echo "
\t\t\t\t\t\t\t\t";
                // line 76
                if (($this->getAttribute($context["product"], "post_status", array()) == "pending")) {
                    // line 77
                    echo "\t\t\t\t\t\t\t\t\t- <span class=\"post-state\">";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "pending", array()), "html", null, true);
                    echo "</span>
\t\t\t\t\t\t\t\t";
                }
                // line 79
                echo "
\t\t\t\t\t\t\t\t";
                // line 80
                if (($this->getAttribute($context["product"], "post_status", array()) == "future")) {
                    // line 81
                    echo "\t\t\t\t\t\t\t\t\t- <span class=\"post-state\">";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "future", array()), "html", null, true);
                    echo "</span>
\t\t\t\t\t\t\t\t";
                }
                // line 83
                echo "
\t\t\t\t\t\t\t\t";
                // line 84
                if (($this->getAttribute(($context["data"] ?? null), "search", array()) && ($this->getAttribute($context["product"], "post_parent", array()) != 0))) {
                    // line 85
                    echo "\t\t\t\t\t\t\t\t\t| <span class=\"prod_parent_text\">
\t\t\t\t\t\t\t\t\t\t";
                    // line 86
                    echo twig_escape_filter($this->env, sprintf($this->getAttribute(($context["strings"] ?? null), "parent", array()), $this->getAttribute($context["product"], "parent_title", array())), "html", null, true);
                    echo "
\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t";
                }
                // line 89
                echo "\t\t\t\t\t\t\t</strong>

\t\t\t\t\t\t\t<div class=\"row-actions\">
\t\t\t\t\t\t\t\t<span class=\"edit\">
\t\t\t\t\t\t\t\t\t<a href=\"";
                // line 93
                echo $this->getAttribute($context["product"], "edit_post_link", array());
                echo "\"
\t\t\t\t\t\t\t\t\t   title=\"";
                // line 94
                echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "edit_item", array()));
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "edit", array()), "html", null, true);
                echo "</a>
\t\t\t\t\t\t\t\t</span> | <span class=\"view\">
\t\t\t\t\t\t\t\t\t<a href=\"";
                // line 96
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "view_link", array()));
                echo "\"
\t\t\t\t\t\t\t\t\t   title=\"";
                // line 97
                echo twig_escape_filter($this->env, sprintf($this->getAttribute(($context["strings"] ?? null), "view_link", array()), $this->getAttribute($context["product"], "post_title", array())));
                echo "\" target=\"_blank\">";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "view", array()), "html", null, true);
                echo "</a>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t</td>

\t\t\t\t\t\t<td class=\"wpml-col-languages\">
\t\t\t\t\t\t\t";
                // line 104
                echo $this->getAttribute($context["product"], "translation_statuses", array());
                echo "
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td class=\"column-categories\">
\t\t\t\t\t\t\t";
                // line 107
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["product"], "categories_list", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                    // line 108
                    echo "\t\t\t\t\t\t\t\t<a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "href", array()));
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "name", array()), "html", null, true);
                    echo "</a>
\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 110
                echo "\t\t\t\t\t\t</td>

\t\t\t\t\t\t<td class=\"column-product_type\">
\t\t\t\t\t\t\t<span class=\"product-type wcml-tip ";
                // line 113
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "icon_class", array()));
                echo "\"
\t\t\t\t\t\t\t\t  data-tip=\"";
                // line 114
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "icon_class", array()));
                echo "\"></span>
\t\t\t\t\t\t</td>

\t\t\t\t\t\t<td class=\"column-date\">
\t\t\t\t\t\t\t";
                // line 118
                echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "formated_date", array()), "html", null, true);
                echo "

\t\t\t\t\t\t\t";
                // line 120
                if (($this->getAttribute($context["product"], "post_status", array()) == "publish")) {
                    // line 121
                    echo "\t\t\t\t\t\t\t\t<br>";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "published", array()), "html", null, true);
                    echo "
\t\t\t\t\t\t\t";
                } else {
                    // line 123
                    echo "\t\t\t\t\t\t\t\t<br>";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "modified", array()), "html", null, true);
                    echo "
\t\t\t\t\t\t\t";
                }
                // line 125
                echo "\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 128
            echo "\t\t\t";
        }
        // line 129
        echo "\t\t</tbody>
\t</table>

\t<input type=\"hidden\" id=\"upd_product_nonce\" value=\"";
        // line 132
        echo twig_escape_filter($this->env, $this->getAttribute(($context["nonces"] ?? null), "upd_product", array()));
        echo "\" />
\t<input type=\"hidden\" id=\"get_product_data_nonce\" value=\"";
        // line 133
        echo twig_escape_filter($this->env, $this->getAttribute(($context["nonces"] ?? null), "get_product_data", array()));
        echo "\" />

\t";
        // line 135
        $this->loadTemplate("pagination.twig", "products.twig", 135)->display(array_merge($context, ($context["pagination"] ?? null)));
        // line 136
        echo "</form>";
    }

    public function getTemplateName()
    {
        return "products.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  351 => 136,  349 => 135,  344 => 133,  340 => 132,  335 => 129,  332 => 128,  324 => 125,  318 => 123,  312 => 121,  310 => 120,  305 => 118,  298 => 114,  294 => 113,  289 => 110,  278 => 108,  274 => 107,  268 => 104,  256 => 97,  252 => 96,  245 => 94,  241 => 93,  235 => 89,  229 => 86,  226 => 85,  224 => 84,  221 => 83,  215 => 81,  213 => 80,  210 => 79,  204 => 77,  202 => 76,  199 => 75,  193 => 73,  191 => 72,  188 => 71,  182 => 69,  180 => 68,  174 => 65,  168 => 64,  165 => 63,  159 => 60,  156 => 59,  154 => 58,  151 => 57,  147 => 56,  140 => 52,  136 => 51,  132 => 49,  127 => 48,  120 => 44,  116 => 42,  114 => 41,  103 => 33,  99 => 32,  95 => 31,  88 => 29,  82 => 26,  78 => 24,  67 => 21,  62 => 20,  58 => 19,  50 => 14,  46 => 13,  42 => 12,  35 => 10,  27 => 4,  25 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<form method=\"post\" action=\"{{ request_uri|e }}\">

\t{% include 'filter.twig' with filter %}

\t<table class=\"widefat fixed wpml-list-table wp-list-table striped\" cellspacing=\"0\">
\t\t<thead>
\t\t\t<tr>
\t\t\t\t<th scope=\"col\" class=\"column-thumb\">
\t\t\t\t\t\t<span class=\"wc-image wcml-tip\"
\t\t\t\t\t\t\t  data-tip=\"{{ strings.image|e }}\">{{ strings.image }}</span>
\t\t\t\t</th>
\t\t\t\t<th scope=\"col\" class=\"wpml-col-title {{ filter_urls.product_sorted }}\">
\t\t\t\t\t<a href=\"{{ filter_urls.product|e }}\">
\t\t\t\t\t\t<span>{{ strings.product }}</span>
\t\t\t\t\t\t<span class=\"sorting-indicator\"></span>
\t\t\t\t\t</a>
\t\t\t\t</th>
\t\t\t\t<th scope=\"col\" class=\"wpml-col-languages\">
\t\t\t\t\t{% for language in languages_flags %}
\t\t\t\t\t\t<span title=\"{{ language.name|e }}\">
\t\t\t\t\t\t\t<img src=\"{{ language.flag_url }}\"  alt=\"{{ language.name|e }}\"/>
\t\t\t\t\t\t</span>
\t\t\t\t\t{% endfor %}
\t\t\t\t</th>
\t\t\t\t<th scope=\"col\"
\t\t\t\t\tclass=\"column-categories\">{{ strings.categories }}</th>
\t\t\t\t<th scope=\"col\" class=\"column-product_type\">
\t\t\t\t\t\t<span class=\"wc-type wcml-tip\"
\t\t\t\t\t\t\t  data-tip=\"{{ strings.type|e }}\">{{ strings.type }}</span>
\t\t\t\t</th>
\t\t\t\t<th scope=\"col\" id=\"date\" class=\"column-date {{ filter_urls.date_sorted }}\">
\t\t\t\t\t<a href=\"{{ filter_urls.date|e }}\">
\t\t\t\t\t\t<span>{{ strings.date }}</span>
\t\t\t\t\t\t<span class=\"sorting-indicator\"></span>
\t\t\t\t\t</a>
\t\t\t\t</th>
\t\t\t</tr>
\t\t</thead>

\t\t<tbody>
\t\t\t{% if data.products is empty %}
\t\t\t\t<tr>
\t\t\t\t\t<td colspan=\"6\" class=\"text-center\">
\t\t\t\t\t\t<strong>{{ strings.no_products }}</strong>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t{% else %}
\t\t\t\t{% for product in data.products %}
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td class=\"thumb column-thumb\">
\t\t\t\t\t\t\t<a href=\"{{ product.edit_post_link|raw }}\">
\t\t\t\t\t\t\t\t<img width=\"150\" height=\"150\" src=\"{{ product.post_thumbnail }}\" class=\"wp-post-image\" >
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td class=\"wpml-col-title  wpml-col-title-flag\">
\t\t\t\t\t\t\t{% if product.post_parent != 0 %} &#8212; {% endif %}
\t\t\t\t\t\t\t<strong>
\t\t\t\t\t\t\t\t{% if not data.slang %}
\t\t\t\t\t\t\t\t\t<span class=\"wpml-title-flag\">
\t\t\t\t\t\t\t\t\t\t<img src=\"{{ product.orig_flag_url }}\"/>
\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t{% endif %}

\t\t\t\t\t\t\t\t<a href=\"{{ product.edit_post_link|raw }}\" title=\"{{ product.post_title|striptags  }}\">
\t\t\t\t\t\t\t\t\t{{ product.post_title }}
\t\t\t\t\t\t\t\t</a>

\t\t\t\t\t\t\t\t{% if product.post_status == 'draft' %}
\t\t\t\t\t\t\t\t\t- <span class=\"post-state\">{{ strings.draft }}</span>
\t\t\t\t\t\t\t\t{% endif %}

\t\t\t\t\t\t\t\t{% if product.post_status == 'private' %}
\t\t\t\t\t\t\t\t\t- <span class=\"post-state\">{{ strings.private }}</span>
\t\t\t\t\t\t\t\t{% endif %}

\t\t\t\t\t\t\t\t{% if product.post_status == 'pending' %}
\t\t\t\t\t\t\t\t\t- <span class=\"post-state\">{{ strings.pending }}</span>
\t\t\t\t\t\t\t\t{% endif %}

\t\t\t\t\t\t\t\t{% if product.post_status == 'future' %}
\t\t\t\t\t\t\t\t\t- <span class=\"post-state\">{{ strings.future }}</span>
\t\t\t\t\t\t\t\t{% endif %}

\t\t\t\t\t\t\t\t{% if data.search and product.post_parent != 0 %}
\t\t\t\t\t\t\t\t\t| <span class=\"prod_parent_text\">
\t\t\t\t\t\t\t\t\t\t{{ strings.parent|format( product.parent_title ) }}
\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t</strong>

\t\t\t\t\t\t\t<div class=\"row-actions\">
\t\t\t\t\t\t\t\t<span class=\"edit\">
\t\t\t\t\t\t\t\t\t<a href=\"{{ product.edit_post_link|raw }}\"
\t\t\t\t\t\t\t\t\t   title=\"{{ strings.edit_item|e }}\">{{ strings.edit }}</a>
\t\t\t\t\t\t\t\t</span> | <span class=\"view\">
\t\t\t\t\t\t\t\t\t<a href=\"{{ product.view_link|e }}\"
\t\t\t\t\t\t\t\t\t   title=\"{{ strings.view_link|format( product.post_title )|e }}\" target=\"_blank\">{{ strings.view }}</a>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t</td>

\t\t\t\t\t\t<td class=\"wpml-col-languages\">
\t\t\t\t\t\t\t{{ product.translation_statuses|raw  }}
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td class=\"column-categories\">
\t\t\t\t\t\t\t{% for category in product.categories_list %}
\t\t\t\t\t\t\t\t<a href=\"{{ category.href|e }}\">{{ category.name }}</a>
\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t</td>

\t\t\t\t\t\t<td class=\"column-product_type\">
\t\t\t\t\t\t\t<span class=\"product-type wcml-tip {{ product.icon_class|e }}\"
\t\t\t\t\t\t\t\t  data-tip=\"{{ product.icon_class|e }}\"></span>
\t\t\t\t\t\t</td>

\t\t\t\t\t\t<td class=\"column-date\">
\t\t\t\t\t\t\t{{ product.formated_date }}

\t\t\t\t\t\t\t{% if product.post_status == \"publish\" %}
\t\t\t\t\t\t\t\t<br>{{ strings.published }}
\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t<br>{{ strings.modified }}
\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t{% endfor %}
\t\t\t{% endif %}
\t\t</tbody>
\t</table>

\t<input type=\"hidden\" id=\"upd_product_nonce\" value=\"{{ nonces.upd_product|e }}\" />
\t<input type=\"hidden\" id=\"get_product_data_nonce\" value=\"{{ nonces.get_product_data|e }}\" />

\t{% include 'pagination.twig' with pagination %}
</form>", "products.twig", "/var/www/html/webapps/jordanakw/wp-content/plugins/woocommerce-multilingual/templates/products-list/products.twig");
    }
}

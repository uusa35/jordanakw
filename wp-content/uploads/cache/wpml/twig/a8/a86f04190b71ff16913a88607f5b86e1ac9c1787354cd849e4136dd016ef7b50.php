<?php

/* custom-currency-options.twig */
class __TwigTemplate_1348853506aaed3c341129e29cd5cb23983d14ce2a32a13e5505eb11ee2dcf6c extends Twig_Template
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
        echo "<div class=\"wcml-dialog hidden\" id=\"wcml_currency_options_";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "title", array()), "html", null, true);
        echo "\">

    <div class=\"wcml_currency_options wcml-co-dialog\">

        <form id=\"wcml_currency_options_form_";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\" method=\"post\" action=\"\">

            ";
        // line 7
        if (twig_test_empty($this->getAttribute(($context["args"] ?? null), "currency_code", array()))) {
            // line 8
            echo "            <div class=\"wpml-form-row currency_code\">
                <label for=\"wcml_currency_options_code_";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["form"] ?? null), "select", array()), "html", null, true);
            echo "</label>
                <select name=\"currency_options[code]\" id=\"wcml_currency_options_code_";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
            echo "\">
                    ";
            // line 11
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["args"] ?? null), "wc_currencies", array()));
            foreach ($context['_seq'] as $context["code"] => $context["name"]) {
                // line 12
                echo "                    ";
                if (((null === $this->getAttribute($this->getAttribute(($context["args"] ?? null), "currencies", array()), $context["code"])) && ($context["code"] != $this->getAttribute(($context["args"] ?? null), "default_currency", array())))) {
                    // line 13
                    echo "                    <option value=\"";
                    echo twig_escape_filter($this->env, $context["code"], "html", null, true);
                    echo "\" ";
                    if (($context["code"] == $this->getAttribute(($context["args"] ?? null), "currency_code", array()))) {
                        echo "selected=\"selected\"";
                    }
                    echo " data-symbol=\"";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('get_currency_symbol')->getCallable(), array($context["code"])), "html", null, true);
                    echo "\" >";
                    echo $context["name"];
                    echo " (";
                    echo call_user_func_array($this->env->getFunction('get_currency_symbol')->getCallable(), array($context["code"]));
                    echo " )</option>
                    ";
                }
                // line 15
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['code'], $context['name'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "                </select>
            </div>
            ";
        } else {
            // line 19
            echo "            <input type=\"hidden\" name=\"currency_options[code]\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
            echo "\" />
            ";
        }
        // line 21
        echo "
            <div class=\"wpml-form-row wcml-co-exchange-rate\">
                <label for=\"wcml_currency_options_rate_";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rate", array()), "label", array()), "html", null, true);
        echo "</label>
                <div class=\"wcml-co-set-rate\">
                    1 ";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "default_currency", array()), "html", null, true);
        echo " = <input name=\"currency_options[rate]\" size=\"5\" type=\"number\"
                                                           class=\"wcml-exchange-rate";
        // line 26
        if (($context["automatic_rates"] ?? null)) {
            echo " wcml-tip";
        }
        echo "\"
                                                           min=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rate", array()), "min", array()), "html", null, true);
        echo "\" step=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rate", array()), "step", array()), "html", null, true);
        echo "\"  value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "rate", array()), "html", null, true);
        echo "\" data-message=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rate", array()), "only_numeric", array()), "html", null, true);
        echo "\"
                                                           id=\"wcml_currency_options_rate_";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\"
                                                            ";
        // line 29
        if (($context["automatic_rates"] ?? null)) {
            echo "readonly=\"readonly\" data-tip=\"";
            echo twig_escape_filter($this->env, ($context["automatic_rates_tip"] ?? null), "html", null, true);
            echo "\"";
        }
        echo "/>
                    <span class=\"this-currency\">";
        // line 30
        echo twig_escape_filter($this->env, ($context["current_currency"] ?? null), "html", null, true);
        echo "</span>
                    <span class=\"wcml-error\" style=\"display: none\">";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute(($context["form"] ?? null), "number_error", array()), "html", null, true);
        echo "</span>
                    ";
        // line 32
        if ($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "updated", array())) {
            // line 33
            echo "                    <small>
                        ";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rate", array()), "set_on", array()), "html", null, true);
            echo " <i>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rate", array()), "previous", array()), "html", null, true);
            echo "</i>
                    </small>
                    ";
        }
        // line 37
        echo "                </div>
            </div>

            <hr>

            <div class=\"wpml-form-row wcml-co-preview\">
                <label><strong>";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "preview", array()), "label", array()), "html", null, true);
        echo "</strong></label>
                <p class=\"wcml-co-preview-value\">
                    ";
        // line 45
        echo $this->getAttribute($this->getAttribute(($context["form"] ?? null), "preview", array()), "value", array());
        echo "
                </p>
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_position_";
        // line 50
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "position", array()), "label", array()), "html", null, true);
        echo "</label>
                <select class=\"currency_option_position\" name=\"currency_options[position]\" id=\"wcml_currency_options_position_";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\">
                    <option value=\"left\" ";
        // line 52
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "position", array()) == "left")) {
            echo "selected=\"selected\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "position", array()), "left", array()), "html", null, true);
        echo "</option>
                    <option value=\"right\" ";
        // line 53
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "position", array()) == "right")) {
            echo "selected=\"selected\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "position", array()), "right", array()), "html", null, true);
        echo "</option>
                    <option value=\"left_space\" ";
        // line 54
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "position", array()) == "left_space")) {
            echo "selected=\"selected\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "position", array()), "left_space", array()), "html", null, true);
        echo "</option>
                    <option value=\"right_space\" ";
        // line 55
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "position", array()) == "right_space")) {
            echo "selected=\"selected\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "position", array()), "right_space", array()), "html", null, true);
        echo "</option>
                </select>
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_thousand_";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "thousand_sep", array()), "label", array()), "html", null, true);
        echo "</label>
                <input name=\"currency_options[thousand_sep]\" type=\"text\"
                    class=\"currency_option_input currency_option_thousand_sep\" value=\"";
        // line 62
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "thousand_sep", array()), "html", null, true);
        echo "\"
                    id=\"wcml_currency_options_thousand_";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\" />
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_decimal_";
        // line 67
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "decimal_sep", array()), "label", array()), "html", null, true);
        echo "</label>
                <input name=\"currency_options[decimal_sep]\" type=\"text\"
                    class=\"currency_option_input currency_option_decimal_sep\" value=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "decimal_sep", array()), "html", null, true);
        echo "\"
                    id=\"wcml_currency_options_decimal_";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\" />
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_decimals_";
        // line 74
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\" id=\"wcml_currency_options_decimals_";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "num_decimals", array()), "label", array()), "html", null, true);
        echo "</label>
                <input name=\"currency_options[num_decimals]\" type=\"number\" class=\"currency_option_decimals\"
                    value=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "num_decimals", array()), "html", null, true);
        echo "\" min=\"0\" step=\"1\" max=\"5\" data-message=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "num_decimals", array()), "only_numeric", array()), "html", null, true);
        echo "\" />
            </div>

            <hr/>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_rounding_";
        // line 82
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rounding", array()), "label", array()), "html", null, true);
        echo " <i class=\"wcml-tip otgs-ico-help\" data-tip=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rounding", array()), "rounding_tooltip", array()), "html", null, true);
        echo "\"></i></label>
                <select name=\"currency_options[rounding]\" id=\"wcml_currency_options_rounding_";
        // line 83
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\">
                    <option value=\"disabled\" ";
        // line 84
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "rounding", array()) == "disabled")) {
            echo "selected=\"selected\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rounding", array()), "disabled", array()), "html", null, true);
        echo "</option>
                    <option value=\"up\" ";
        // line 85
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "rounding", array()) == "up")) {
            echo "selected=\"selected\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rounding", array()), "up", array()), "html", null, true);
        echo "</option>
                    <option value=\"down\" ";
        // line 86
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "rounding", array()) == "down")) {
            echo "selected=\"selected\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rounding", array()), "down", array()), "html", null, true);
        echo "</option>
                    <option value=\"nearest\" ";
        // line 87
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "rounding", array()) == "nearest")) {
            echo "selected=\"nearest\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rounding", array()), "nearest", array()), "html", null, true);
        echo "</option>
                </select>
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_increment_";
        // line 92
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rounding", array()), "increment", array()), "html", null, true);
        echo " <i class=\"wcml-tip otgs-ico-help\" data-tip=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rounding", array()), "increment_tooltip", array()), "html", null, true);
        echo "\"></i></label>
                <select name=\"currency_options[rounding_increment]\" id=\"wcml_currency_options_increment_";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\">
                    <option value=\"1\" ";
        // line 94
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "rounding_increment", array()) == "1")) {
            echo "selected=\"selected\"";
        }
        echo ">1</option>
                    <option value=\"10\" ";
        // line 95
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "rounding_increment", array()) == "10")) {
            echo "selected=\"selected\"";
        }
        echo ">10</option>
                    <option value=\"100\" ";
        // line 96
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "rounding_increment", array()) == "100")) {
            echo "selected=\"selected\"";
        }
        echo ">100</option>
                    <option value=\"1000\" ";
        // line 97
        if (($this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "rounding_increment", array()) == "1000")) {
            echo "selected=\"selected\"";
        }
        echo ">1000</option>
                </select>
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_subtract_";
        // line 102
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "autosubtract", array()), "label", array()), "html", null, true);
        echo " <i class=\"wcml-tip otgs-ico-help\" data-tip=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "rounding", array()), "autosubtract_tooltip", array()), "html", null, true);
        echo "\"></i></label>

                <input name=\"currency_options[auto_subtract]\" class=\"abstract_amount\"
                    value=\"";
        // line 105
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["args"] ?? null), "currency", array()), "auto_subtract", array()), "html", null, true);
        echo "\" type=\"number\" data-message=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["form"] ?? null), "autosbtract", array()), "only_numeric", array()), "html", null, true);
        echo "\"
                    id=\"wcml_currency_options_subtract_";
        // line 106
        echo twig_escape_filter($this->env, $this->getAttribute(($context["args"] ?? null), "currency_code", array()), "html", null, true);
        echo "\"/>
            </div>


            <footer class=\"wpml-dialog-footer\">
                <input type=\"button\" class=\"cancel wcml-dialog-close-button wpml-dialog-close-button alignleft\"
                    value=\"";
        // line 112
        echo twig_escape_filter($this->env, $this->getAttribute(($context["form"] ?? null), "cancel", array()), "html", null, true);
        echo "\" data-currency=\"";
        echo twig_escape_filter($this->env, ($context["current_currency"] ?? null), "html", null, true);
        echo "\" data-symbol=\"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('get_currency_symbol')->getCallable(), array(($context["current_currency"] ?? null))), "html", null, true);
        echo "\" />&nbsp;
                <input type=\"submit\" class=\"wcml-dialog-close-button wpml-dialog-close-button button-primary currency_options_save alignright\"
                    value=\"";
        // line 114
        echo twig_escape_filter($this->env, $this->getAttribute(($context["form"] ?? null), "save", array()), "html", null, true);
        echo "\" data-currency=\"";
        echo twig_escape_filter($this->env, ($context["current_currency"] ?? null), "html", null, true);
        echo "\" data-symbol=\"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('get_currency_symbol')->getCallable(), array(($context["current_currency"] ?? null))), "html", null, true);
        echo "\" data-stay=\"1\" />
            </footer>

        </form>

    </div>

</div>

";
    }

    public function getTemplateName()
    {
        return "custom-currency-options.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  398 => 114,  389 => 112,  380 => 106,  374 => 105,  364 => 102,  354 => 97,  348 => 96,  342 => 95,  336 => 94,  332 => 93,  324 => 92,  312 => 87,  304 => 86,  296 => 85,  288 => 84,  284 => 83,  276 => 82,  265 => 76,  256 => 74,  249 => 70,  245 => 69,  238 => 67,  231 => 63,  227 => 62,  220 => 60,  208 => 55,  200 => 54,  192 => 53,  184 => 52,  180 => 51,  174 => 50,  166 => 45,  161 => 43,  153 => 37,  145 => 34,  142 => 33,  140 => 32,  136 => 31,  132 => 30,  124 => 29,  120 => 28,  110 => 27,  104 => 26,  100 => 25,  93 => 23,  89 => 21,  83 => 19,  78 => 16,  72 => 15,  56 => 13,  53 => 12,  49 => 11,  45 => 10,  39 => 9,  36 => 8,  34 => 7,  29 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"wcml-dialog hidden\" id=\"wcml_currency_options_{{ args.currency_code }}\" title=\"{{ args.title }}\">

    <div class=\"wcml_currency_options wcml-co-dialog\">

        <form id=\"wcml_currency_options_form_{{ args.currency_code }}\" method=\"post\" action=\"\">

            {% if args.currency_code is empty %}
            <div class=\"wpml-form-row currency_code\">
                <label for=\"wcml_currency_options_code_{{ args.currency_code }}\">{{ form.select }}</label>
                <select name=\"currency_options[code]\" id=\"wcml_currency_options_code_{{ args.currency_code }}\">
                    {% for code, name in args.wc_currencies %}
                    {% if attribute(args.currencies, code) is null and code != args.default_currency %}
                    <option value=\"{{ code }}\" {% if code == args.currency_code %}selected=\"selected\"{% endif %} data-symbol=\"{{ get_currency_symbol(code) }}\" >{{ name|raw }} ({{ get_currency_symbol(code)|raw }} )</option>
                    {% endif %}
                    {% endfor %}
                </select>
            </div>
            {% else %}
            <input type=\"hidden\" name=\"currency_options[code]\" value=\"{{ args.currency_code }}\" />
            {% endif %}

            <div class=\"wpml-form-row wcml-co-exchange-rate\">
                <label for=\"wcml_currency_options_rate_{{ args.currency_code }}\">{{ form.rate.label }}</label>
                <div class=\"wcml-co-set-rate\">
                    1 {{ args.default_currency }} = <input name=\"currency_options[rate]\" size=\"5\" type=\"number\"
                                                           class=\"wcml-exchange-rate{% if automatic_rates %} wcml-tip{% endif %}\"
                                                           min=\"{{ form.rate.min }}\" step=\"{{ form.rate.step }}\"  value=\"{{ args.currency.rate }}\" data-message=\"{{ form.rate.only_numeric }}\"
                                                           id=\"wcml_currency_options_rate_{{ args.currency_code }}\"
                                                            {% if automatic_rates %}readonly=\"readonly\" data-tip=\"{{ automatic_rates_tip }}\"{% endif %}/>
                    <span class=\"this-currency\">{{ current_currency }}</span>
                    <span class=\"wcml-error\" style=\"display: none\">{{ form.number_error }}</span>
                    {% if args.currency.updated %}
                    <small>
                        {{ form.rate.set_on }} <i>{{ form.rate.previous }}</i>
                    </small>
                    {% endif %}
                </div>
            </div>

            <hr>

            <div class=\"wpml-form-row wcml-co-preview\">
                <label><strong>{{ form.preview.label }}</strong></label>
                <p class=\"wcml-co-preview-value\">
                    {{ form.preview.value|raw }}
                </p>
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_position_{{ args.currency_code }}\">{{ form.position.label }}</label>
                <select class=\"currency_option_position\" name=\"currency_options[position]\" id=\"wcml_currency_options_position_{{ args.currency_code }}\">
                    <option value=\"left\" {% if args.currency.position == 'left' %}selected=\"selected\"{% endif %}>{{ form.position.left }}</option>
                    <option value=\"right\" {% if args.currency.position == 'right' %}selected=\"selected\"{% endif %}>{{ form.position.right }}</option>
                    <option value=\"left_space\" {% if args.currency.position == 'left_space' %}selected=\"selected\"{% endif %}>{{ form.position.left_space }}</option>
                    <option value=\"right_space\" {% if args.currency.position == 'right_space' %}selected=\"selected\"{% endif %}>{{ form.position.right_space }}</option>
                </select>
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_thousand_{{ args.currency_code }}\">{{ form.thousand_sep.label }}</label>
                <input name=\"currency_options[thousand_sep]\" type=\"text\"
                    class=\"currency_option_input currency_option_thousand_sep\" value=\"{{ args.currency.thousand_sep }}\"
                    id=\"wcml_currency_options_thousand_{{ args.currency_code }}\" />
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_decimal_{{ args.currency_code }}\">{{ form.decimal_sep.label }}</label>
                <input name=\"currency_options[decimal_sep]\" type=\"text\"
                    class=\"currency_option_input currency_option_decimal_sep\" value=\"{{ args.currency.decimal_sep }}\"
                    id=\"wcml_currency_options_decimal_{{ args.currency_code }}\" />
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_decimals_{{ args.currency_code }}\" id=\"wcml_currency_options_decimals_{{ args.currency_code }}\">{{ form.num_decimals.label }}</label>
                <input name=\"currency_options[num_decimals]\" type=\"number\" class=\"currency_option_decimals\"
                    value=\"{{ args.currency.num_decimals }}\" min=\"0\" step=\"1\" max=\"5\" data-message=\"{{ form.num_decimals.only_numeric }}\" />
            </div>

            <hr/>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_rounding_{{ args.currency_code }}\">{{ form.rounding.label }} <i class=\"wcml-tip otgs-ico-help\" data-tip=\"{{ form.rounding.rounding_tooltip }}\"></i></label>
                <select name=\"currency_options[rounding]\" id=\"wcml_currency_options_rounding_{{ args.currency_code }}\">
                    <option value=\"disabled\" {% if args.currency.rounding == 'disabled' %}selected=\"selected\"{% endif %}>{{ form.rounding.disabled}}</option>
                    <option value=\"up\" {% if args.currency.rounding == 'up' %}selected=\"selected\"{% endif %}>{{ form.rounding.up}}</option>
                    <option value=\"down\" {% if args.currency.rounding == 'down' %}selected=\"selected\"{% endif %}>{{ form.rounding.down}}</option>
                    <option value=\"nearest\" {% if args.currency.rounding == 'nearest' %}selected=\"nearest\"{% endif %}>{{ form.rounding.nearest}}</option>
                </select>
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_increment_{{ args.currency_code }}\">{{ form.rounding.increment}} <i class=\"wcml-tip otgs-ico-help\" data-tip=\"{{ form.rounding.increment_tooltip }}\"></i></label>
                <select name=\"currency_options[rounding_increment]\" id=\"wcml_currency_options_increment_{{ args.currency_code }}\">
                    <option value=\"1\" {% if args.currency.rounding_increment == '1' %}selected=\"selected\"{% endif %}>1</option>
                    <option value=\"10\" {% if args.currency.rounding_increment == '10' %}selected=\"selected\"{% endif %}>10</option>
                    <option value=\"100\" {% if args.currency.rounding_increment == '100' %}selected=\"selected\"{% endif %}>100</option>
                    <option value=\"1000\" {% if args.currency.rounding_increment == '1000' %}selected=\"selected\"{% endif %}>1000</option>
                </select>
            </div>

            <div class=\"wpml-form-row\">
                <label for=\"wcml_currency_options_subtract_{{ args.currency_code }}\">{{ form.autosubtract.label }} <i class=\"wcml-tip otgs-ico-help\" data-tip=\"{{ form.rounding.autosubtract_tooltip }}\"></i></label>

                <input name=\"currency_options[auto_subtract]\" class=\"abstract_amount\"
                    value=\"{{ args.currency.auto_subtract }}\" type=\"number\" data-message=\"{{ form.autosbtract.only_numeric }}\"
                    id=\"wcml_currency_options_subtract_{{ args.currency_code }}\"/>
            </div>


            <footer class=\"wpml-dialog-footer\">
                <input type=\"button\" class=\"cancel wcml-dialog-close-button wpml-dialog-close-button alignleft\"
                    value=\"{{ form.cancel }}\" data-currency=\"{{ current_currency }}\" data-symbol=\"{{ get_currency_symbol(current_currency) }}\" />&nbsp;
                <input type=\"submit\" class=\"wcml-dialog-close-button wpml-dialog-close-button button-primary currency_options_save alignright\"
                    value=\"{{ form.save }}\" data-currency=\"{{ current_currency }}\" data-symbol=\"{{ get_currency_symbol(current_currency) }}\" data-stay=\"1\" />
            </footer>

        </form>

    </div>

</div>

", "custom-currency-options.twig", "/var/www/html/webapps/jordanakw/wp-content/plugins/woocommerce-multilingual/templates/multi-currency/custom-currency-options.twig");
    }
}

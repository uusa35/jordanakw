<?php

/* exchange-rates.twig */
class __TwigTemplate_7029bfc03fac958f322fca404b7fdba53b7d01fadb0b367d5eb01baf440043e0 extends Twig_Template
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
        echo "<div class=\"wcml-section\" id=\"online-exchange-rates\" ";
        if (twig_test_empty(($context["multi_currency_on"] ?? null))) {
            echo "style=\"display:none\"";
        }
        echo ">

    <div class=\"wcml-section-header\">
        <h3>";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "header", array()), "html", null, true);
        echo "</h3>
    </div>

    <div class=\"wcml-section-content\" id=\"online-exchange-rates-no-currencies\" ";
        // line 7
        if ($this->getAttribute(($context["exchange_rates"] ?? null), "secondary_currencies", array())) {
            echo " style=\"display:none\"";
        }
        echo ">
        <p><i>";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "no_currencies", array()), "html", null, true);
        echo "</i></p>
    </div>
    <div class=\"wcml-section-content\" ";
        // line 10
        if (twig_test_empty($this->getAttribute(($context["exchange_rates"] ?? null), "secondary_currencies", array()))) {
            echo " style=\"display:none\"";
        }
        echo ">
        <p>
            <input type=\"checkbox\" id=\"exchange-rates-automatic\" name=\"exchange-rates-automatic\" value=\"1\"
                   ";
        // line 13
        if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "automatic", array()) == 1)) {
            echo "checked=\"checked\"";
        }
        echo " />
            <label for=\"exchange-rates-automatic\">";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "enable_automatic", array()), "html", null, true);
        echo "</label>
        </p>

        <div id=\"exchange-rates-online-wrap\"
             class=\"exchange-rates-online-wrap\"";
        // line 18
        if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "automatic", array()) == 0)) {
            echo " style=\"display: none;\"";
        }
        echo " >

        <div class=\"wcml-section-content-inner\">
            <p id=\"update-rates-time\">";
        // line 21
        echo $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "updated_time", array());
        echo "</p>

            <p>
                <input type=\"button\" id=\"update-rates-manually\" class=\"button-secondary\"
                       value=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "update", array()), "html", null, true);
        echo "\" />
                <i class=\"otgs-ico-help wcml-tip\" data-tip=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "update_tip", array()), "html", null, true);
        echo "\" style=\"display: none\"></i>
                <span id=\"update-rates-spinner\" class=\"spinner\" style=\"float:none;\"></span>
                <input type=\"hidden\" id=\"update-exchange-rates-nonce\" value=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "nonce", array()), "html", null, true);
        echo "\"/>
            </p>

            <p class=\"notice inline notice-success\" id=\"exchange-rates-success\"
               style=\"display:none\">";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "updated_success", array()), "html", null, true);
        echo "</p>
            <p class=\"notice inline notice-error\" id=\"exchange-rates-error\" style=\"display:none\"></p>
        </div>

        <div class=\"wcml-section-content-inner\">
            <h4>";
        // line 37
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "services_label", array()), "html", null, true);
        echo "</h4>
            <ul class=\"exchange-rates-sources\">

                ";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["exchange_rates"] ?? null), "services", array()));
        foreach ($context['_seq'] as $context["id"] => $context["service"]) {
            // line 41
            echo "                    <li>
                        <input type=\"radio\" id=\"service-";
            // line 42
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "\" name=\"exchange-rates-service\" value=\"";
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "\"
                               ";
            // line 43
            if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "service", array()) == $context["id"])) {
                echo "checked=\"checked\"";
            }
            echo " />
                        <label for=\"service-";
            // line 44
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "\">
                            ";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute($context["service"], "name", array()), "html", null, true);
            echo "
                        </label>
                        <a href=\"";
            // line 47
            echo twig_escape_filter($this->env, $this->getAttribute($context["service"], "url", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "visit_website", array()), "html", null, true);
            echo "\" class=\"exchange-rate-service-website no-ico\" target=\"_blank\">
                            <span class=\"dashicons dashicons-external\"></span>
                        </a>
                        <div class=\"service-details-wrap\" ";
            // line 50
            if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "service", array()) != $context["id"])) {
                echo " style=\"display: none;\"";
            }
            echo " >

                            ";
            // line 52
            if ($this->getAttribute($context["service"], "requires_key", array())) {
                // line 53
                echo "
                            ";
                // line 54
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "key_required", array()), "html", null, true);
                echo "
                            <input type=\"text\" name=\"services[";
                // line 55
                echo twig_escape_filter($this->env, $context["id"], "html", null, true);
                echo "][api-key]\"
                                   value=\"";
                // line 56
                echo twig_escape_filter($this->env, $this->getAttribute($context["service"], "api_key", array()), "html", null, true);
                echo "\"
                                   placeholder=\"";
                // line 57
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "key_placeholder", array()), "html", null, true);
                echo "\"
                                   size=\"40\" />

                            ";
            }
            // line 61
            echo "                            <p class=\"notice inline notice-error\" id=\"service-error-";
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($context["service"], "last_error", array()) == false)) {
                echo "style=\"display:none\"";
            }
            echo ">
                            ";
            // line 62
            if ($this->getAttribute($context["service"], "last_error", array())) {
                // line 63
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["service"], "last_error", array()), "text", array()), "html", null, true);
                echo " <i>(";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["service"], "last_error", array()), "time", array()), "html", null, true);
                echo ")</i>
                            ";
            }
            // line 65
            echo "                            </p>

                        </div>
                    </li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['service'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "            </ul>
        </div>

        <div class=\"wcml-section-content-inner\">
            <h4>";
        // line 74
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "lifting_label", array()), "html", null, true);
        echo "</h4>
            <p>";
        // line 75
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "lifting_details1", array()), "html", null, true);
        echo "</p>
            <input type=\"number\" name=\"lifting_charge\" value=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "lifting_charge", array()), "html", null, true);
        echo "\" step=\"any\" style=\"width:64px\" /> %
            <p><i>";
        // line 77
        echo twig_escape_filter($this->env, sprintf($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "lifting_details2", array()), $this->getAttribute($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "services", array()), $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "service", array()), array(), "array"), "name", array())), "html", null, true);
        echo "</i></p>
        </div>

        <div class=\"wcml-section-content-inner\">

            <h4>";
        // line 82
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "frequency", array()), "html", null, true);
        echo "</h4>

            <ul>
                <li>
                    <input type=\"radio\" id=\"update-frequency-daily\" name=\"update-schedule\" value=\"daily\"
                           ";
        // line 87
        if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "schedule", array()) == "daily")) {
            echo "checked=\"checked\"";
        }
        echo "/>
                    <label for=\"update-frequency-daily\">";
        // line 88
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "daily", array()), "html", null, true);
        echo "</label>
                </li>

                <li>
                    <input type=\"radio\" id=\"update-frequency-weekly\" name=\"update-schedule\" value=\"weekly\"
                           ";
        // line 93
        if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "schedule", array()) == "weekly")) {
            echo "checked=\"checked\"";
        }
        echo " />
                    <label for=\"update-frequency-weekly\">";
        // line 94
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "weekly", array()), "html", null, true);
        echo "</label>
                    <select name=\"update-weekly-day\"
                            ";
        // line 96
        if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "schedule", array()) != "weekly")) {
            echo "disabled";
        }
        echo ">
                        ";
        // line 97
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(0, 6));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 98
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "\"";
            if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "week_day", array()) == $context["i"])) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('get_weekday')->getCallable(), array($context["i"])), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 100
        echo "                    </select>
                </li>

                <li>
                    <input type=\"radio\" id=\"update-frequency-monthly\" name=\"update-schedule\" value=\"monthly\"
                           ";
        // line 105
        if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "schedule", array()) == "monthly")) {
            echo "checked=\"checked\"";
        }
        echo " />
                    <label for=\"update-frequency-monthly\">";
        // line 106
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "monthly", array()), "html", null, true);
        echo "</label>
                    <select name=\"update-monthly-day\"
                            ";
        // line 108
        if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "schedule", array()) != "monthly")) {
            echo "disabled";
        }
        echo ">
                        ";
        // line 109
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(1, 31));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 110
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "\"";
            if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "month_day", array()) == $context["i"])) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            if (($context["i"] == 1)) {
                echo "st";
            } elseif (($context["i"] == 2)) {
                echo "nd";
            } elseif (($context["i"] == 2)) {
                echo "rd";
            } else {
                echo "th";
            }
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 112
        echo "                    </select>
                </li>

                <li>
                    <input type=\"radio\" id=\"update-frequency-manual\" name=\"update-schedule\" value=\"manual\"
                           ";
        // line 117
        if (($this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "settings", array()), "schedule", array()) == "manual")) {
            echo "checked=\"checked\"";
        }
        echo " />
                    <label for=\"update-frequency-manual\">";
        // line 118
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["exchange_rates"] ?? null), "strings", array()), "manually", array()), "html", null, true);
        echo "</label>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>";
    }

    public function getTemplateName()
    {
        return "exchange-rates.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  356 => 118,  350 => 117,  343 => 112,  319 => 110,  315 => 109,  309 => 108,  304 => 106,  298 => 105,  291 => 100,  276 => 98,  272 => 97,  266 => 96,  261 => 94,  255 => 93,  247 => 88,  241 => 87,  233 => 82,  225 => 77,  221 => 76,  217 => 75,  213 => 74,  207 => 70,  197 => 65,  189 => 63,  187 => 62,  178 => 61,  171 => 57,  167 => 56,  163 => 55,  159 => 54,  156 => 53,  154 => 52,  147 => 50,  139 => 47,  134 => 45,  130 => 44,  124 => 43,  118 => 42,  115 => 41,  111 => 40,  105 => 37,  97 => 32,  90 => 28,  85 => 26,  81 => 25,  74 => 21,  66 => 18,  59 => 14,  53 => 13,  45 => 10,  40 => 8,  34 => 7,  28 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"wcml-section\" id=\"online-exchange-rates\" {% if multi_currency_on is empty %}style=\"display:none\"{% endif %}>

    <div class=\"wcml-section-header\">
        <h3>{{ exchange_rates.strings.header }}</h3>
    </div>

    <div class=\"wcml-section-content\" id=\"online-exchange-rates-no-currencies\" {% if exchange_rates.secondary_currencies %} style=\"display:none\"{% endif %}>
        <p><i>{{ exchange_rates.strings.no_currencies }}</i></p>
    </div>
    <div class=\"wcml-section-content\" {% if exchange_rates.secondary_currencies is empty %} style=\"display:none\"{% endif %}>
        <p>
            <input type=\"checkbox\" id=\"exchange-rates-automatic\" name=\"exchange-rates-automatic\" value=\"1\"
                   {% if exchange_rates.settings.automatic == 1 %}checked=\"checked\"{% endif %} />
            <label for=\"exchange-rates-automatic\">{{ exchange_rates.strings.enable_automatic }}</label>
        </p>

        <div id=\"exchange-rates-online-wrap\"
             class=\"exchange-rates-online-wrap\"{% if exchange_rates.settings.automatic == 0 %} style=\"display: none;\"{% endif %} >

        <div class=\"wcml-section-content-inner\">
            <p id=\"update-rates-time\">{{ exchange_rates.strings.updated_time|raw }}</p>

            <p>
                <input type=\"button\" id=\"update-rates-manually\" class=\"button-secondary\"
                       value=\"{{ exchange_rates.strings.update }}\" />
                <i class=\"otgs-ico-help wcml-tip\" data-tip=\"{{ exchange_rates.strings.update_tip }}\" style=\"display: none\"></i>
                <span id=\"update-rates-spinner\" class=\"spinner\" style=\"float:none;\"></span>
                <input type=\"hidden\" id=\"update-exchange-rates-nonce\" value=\"{{ exchange_rates.strings.nonce }}\"/>
            </p>

            <p class=\"notice inline notice-success\" id=\"exchange-rates-success\"
               style=\"display:none\">{{ exchange_rates.strings.updated_success }}</p>
            <p class=\"notice inline notice-error\" id=\"exchange-rates-error\" style=\"display:none\"></p>
        </div>

        <div class=\"wcml-section-content-inner\">
            <h4>{{ exchange_rates.strings.services_label }}</h4>
            <ul class=\"exchange-rates-sources\">

                {% for id, service in exchange_rates.services %}
                    <li>
                        <input type=\"radio\" id=\"service-{{ id }}\" name=\"exchange-rates-service\" value=\"{{ id }}\"
                               {% if exchange_rates.settings.service == id %}checked=\"checked\"{% endif %} />
                        <label for=\"service-{{ id }}\">
                            {{ service.name }}
                        </label>
                        <a href=\"{{ service.url }}\" title=\"{{ exchange_rates.strings.visit_website }}\" class=\"exchange-rate-service-website no-ico\" target=\"_blank\">
                            <span class=\"dashicons dashicons-external\"></span>
                        </a>
                        <div class=\"service-details-wrap\" {% if exchange_rates.settings.service != id %} style=\"display: none;\"{% endif %} >

                            {% if service.requires_key %}

                            {{ exchange_rates.strings.key_required }}
                            <input type=\"text\" name=\"services[{{ id }}][api-key]\"
                                   value=\"{{ service.api_key }}\"
                                   placeholder=\"{{ exchange_rates.strings.key_placeholder }}\"
                                   size=\"40\" />

                            {% endif %}
                            <p class=\"notice inline notice-error\" id=\"service-error-{{ id }}\" {% if service.last_error == false %}style=\"display:none\"{% endif %}>
                            {% if service.last_error %}
                                {{service.last_error.text}} <i>({{service.last_error.time}})</i>
                            {% endif %}
                            </p>

                        </div>
                    </li>
                {% endfor %}
            </ul>
        </div>

        <div class=\"wcml-section-content-inner\">
            <h4>{{ exchange_rates.strings.lifting_label }}</h4>
            <p>{{ exchange_rates.strings.lifting_details1 }}</p>
            <input type=\"number\" name=\"lifting_charge\" value=\"{{ settings.lifting_charge }}\" step=\"any\" style=\"width:64px\" /> %
            <p><i>{{ exchange_rates.strings.lifting_details2|format( exchange_rates.services[exchange_rates.settings.service].name ) }}</i></p>
        </div>

        <div class=\"wcml-section-content-inner\">

            <h4>{{ exchange_rates.strings.frequency }}</h4>

            <ul>
                <li>
                    <input type=\"radio\" id=\"update-frequency-daily\" name=\"update-schedule\" value=\"daily\"
                           {% if exchange_rates.settings.schedule == 'daily' %}checked=\"checked\"{% endif %}/>
                    <label for=\"update-frequency-daily\">{{ exchange_rates.strings.daily }}</label>
                </li>

                <li>
                    <input type=\"radio\" id=\"update-frequency-weekly\" name=\"update-schedule\" value=\"weekly\"
                           {% if exchange_rates.settings.schedule == 'weekly' %}checked=\"checked\"{% endif %} />
                    <label for=\"update-frequency-weekly\">{{ exchange_rates.strings.weekly }}</label>
                    <select name=\"update-weekly-day\"
                            {% if exchange_rates.settings.schedule != 'weekly' %}disabled{% endif %}>
                        {% for i in 0..6 %}
                            <option value=\"{{ i }}\"{% if exchange_rates.settings.week_day == i %} selected=\"selected\"{% endif %}>{{ get_weekday(i) }}</option>
                        {% endfor %}
                    </select>
                </li>

                <li>
                    <input type=\"radio\" id=\"update-frequency-monthly\" name=\"update-schedule\" value=\"monthly\"
                           {% if exchange_rates.settings.schedule == 'monthly' %}checked=\"checked\"{% endif %} />
                    <label for=\"update-frequency-monthly\">{{ exchange_rates.strings.monthly }}</label>
                    <select name=\"update-monthly-day\"
                            {% if exchange_rates.settings.schedule != 'monthly' %}disabled{% endif %}>
                        {% for i in 1..31 %}
                            <option value=\"{{ i }}\"{% if exchange_rates.settings.month_day == i %} selected=\"selected\"{% endif %}>{{ i }}{% if i == 1 %}st{% elseif i == 2 %}nd{% elseif i == 2 %}rd{% else %}th{% endif %}</option>
                        {% endfor %}
                    </select>
                </li>

                <li>
                    <input type=\"radio\" id=\"update-frequency-manual\" name=\"update-schedule\" value=\"manual\"
                           {% if exchange_rates.settings.schedule == 'manual' %}checked=\"checked\"{% endif %} />
                    <label for=\"update-frequency-manual\">{{ exchange_rates.strings.manually }}</label>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>", "exchange-rates.twig", "/var/www/html/webapps/jordanakw/wp-content/plugins/woocommerce-multilingual/templates/multi-currency/exchange-rates.twig");
    }
}

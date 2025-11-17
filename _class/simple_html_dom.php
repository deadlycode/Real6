<?php


define("HDOM_TYPE_ELEMENT", 1);
define("HDOM_TYPE_COMMENT", 2);
define("HDOM_TYPE_TEXT", 3);
define("HDOM_TYPE_ENDTAG", 4);
define("HDOM_TYPE_ROOT", 5);
define("HDOM_TYPE_UNKNOWN", 6);
define("HDOM_QUOTE_DOUBLE", 0);
define("HDOM_QUOTE_SINGLE", 1);
define("HDOM_QUOTE_NO", 3);
define("HDOM_INFO_BEGIN", 0);
define("HDOM_INFO_END", 1);
define("HDOM_INFO_QUOTE", 2);
define("HDOM_INFO_SPACE", 3);
define("HDOM_INFO_TEXT", 4);
define("HDOM_INFO_INNER", 5);
define("HDOM_INFO_OUTER", 6);
define("HDOM_INFO_ENDSPACE", 7);
defined("DEFAULT_TARGET_CHARSET") || define("DEFAULT_TARGET_CHARSET", "UTF-8");
defined("DEFAULT_BR_TEXT") || define("DEFAULT_BR_TEXT", "\r\n");
defined("DEFAULT_SPAN_TEXT") || define("DEFAULT_SPAN_TEXT", " ");
defined("MAX_FILE_SIZE") || define("MAX_FILE_SIZE", 600000);
define("HDOM_SMARTY_AS_TEXT", 1);
class simple_html_dom_node
{
    public $nodetype = HDOM_TYPE_TEXT;
    public $tag = "text";
    public $attr = [];
    public $children = [];
    public $nodes = [];
    public $parent = NULL;
    public $_ = [];
    public $tag_start = 0;
    private $dom = NULL;
    public function __construct($dom)
    {
        $this->dom = $dom;
        $dom->nodes[] = $this;
    }
    public function __destruct()
    {
        $this->clear();
    }
    public function __toString()
    {
        return $this->outertext();
    }
    public function clear()
    {
        $this->dom = NULL;
        $this->nodes = NULL;
        $this->parent = NULL;
        $this->children = NULL;
    }
    public function dump($show_attr = true, $depth = 0)
    {
        echo str_repeat("\t", $depth) . $this->tag;
        if ($show_attr && 0 < count($this->attr)) {
            echo "(";
            foreach ($this->attr as $k => $v) {
                echo "[" . $k . "]=>\"" . $v . "\", ";
            }
            echo ")";
        }
        echo "\n";
        if ($this->nodes) {
            foreach ($this->nodes as $node) {
                $node->dump($show_attr, $depth + 1);
            }
        }
    }
    public function dump_node($echo = true)
    {
        $string = $this->tag;
        if (0 < count($this->attr)) {
            $string .= "(";
            foreach ($this->attr as $k => $v) {
                $string .= "[" . $k . "]=>\"" . $v . "\", ";
            }
            $string .= ")";
        }
        if (0 < count($this->_)) {
            $string .= " \$_ (";
            foreach ($this->_ as $k => $v) {
                if (is_array($v)) {
                    $string .= "[" . $k . "]=>(";
                    foreach ($v as $k2 => $v2) {
                        $string .= "[" . $k2 . "]=>\"" . $v2 . "\", ";
                    }
                    $string .= ")";
                } else {
                    $string .= "[" . $k . "]=>\"" . $v . "\", ";
                }
            }
            $string .= ")";
        }
        if (isset($this->text)) {
            $string .= " text: (" . $this->text . ")";
        }
        $string .= " HDOM_INNER_INFO: ";
        if (isset($node->_[HDOM_INFO_INNER])) {
            $string .= "'" . $node->_[HDOM_INFO_INNER] . "'";
        } else {
            $string .= " NULL ";
        }
        $string .= " children: " . count($this->children);
        $string .= " nodes: " . count($this->nodes);
        $string .= " tag_start: " . $this->tag_start;
        $string .= "\n";
        if ($echo) {
            echo $string;
            return NULL;
        }
        return $string;
    }
    public function parent($parent = NULL)
    {
        if ($parent !== NULL) {
            $this->parent = $parent;
            $this->parent->nodes[] = $this;
            $this->parent->children[] = $this;
        }
        return $this->parent;
    }
    public function has_child()
    {
        return !empty($this->children);
    }
    public function children($idx = -1)
    {
        if ($idx === -1) {
            return $this->children;
        }
        if (isset($this->children[$idx])) {
            return $this->children[$idx];
        }
        return NULL;
    }
    public function first_child()
    {
        if (0 < count($this->children)) {
            return $this->children[0];
        }
        return NULL;
    }
    public function last_child()
    {
        if (0 < count($this->children)) {
            return end($this->children);
        }
        return NULL;
    }
    public function next_sibling()
    {
        if ($this->parent === NULL) {
            return NULL;
        }
        $idx = array_search($this, $this->parent->children, true);
        if ($idx !== false && isset($this->parent->children[$idx + 1])) {
            return $this->parent->children[$idx + 1];
        }
        return NULL;
    }
    public function prev_sibling()
    {
        if ($this->parent === NULL) {
            return NULL;
        }
        $idx = array_search($this, $this->parent->children, true);
        if ($idx !== false && 0 < $idx) {
            return $this->parent->children[$idx - 1];
        }
        return NULL;
    }
    public function find_ancestor_tag($tag)
    {
        global $debug_object;
        if (is_object($debug_object)) {
            $debug_object->debug_log_entry(1);
        }
        if ($this->parent === NULL) {
            return NULL;
        }
        $ancestor = $this->parent;
        while (!is_null($ancestor)) {
            if (is_object($debug_object)) {
                $debug_object->debug_log(2, "Current tag is: " . $ancestor->tag);
            }
            if ($ancestor->tag !== $tag) {
                $ancestor = $ancestor->parent;
            }
        }
        return $ancestor;
    }
    public function innertext()
    {
        if (isset($this->_[HDOM_INFO_INNER])) {
            return $this->_[HDOM_INFO_INNER];
        }
        if (isset($this->_[HDOM_INFO_TEXT])) {
            return $this->dom->restore_noise($this->_[HDOM_INFO_TEXT]);
        }
        $ret = "";
        foreach ($this->nodes as $n) {
            $ret .= $n->outertext();
        }
        return $ret;
    }
    public function outertext()
    {
        global $debug_object;
        if (is_object($debug_object)) {
            $text = "";
            if ($this->tag === "text" && !empty($this->text)) {
                $text = " with text: " . $this->text;
            }
            $debug_object->debug_log(1, "Innertext of tag: " . $this->tag . $text);
        }
        if ($this->tag === "root") {
            return $this->innertext();
        }
        if ($this->dom && $this->dom->callback !== NULL) {
            call_user_func_array($this->dom->callback, [$this]);
        }
        if (isset($this->_[HDOM_INFO_OUTER])) {
            return $this->_[HDOM_INFO_OUTER];
        }
        if (isset($this->_[HDOM_INFO_TEXT])) {
            return $this->dom->restore_noise($this->_[HDOM_INFO_TEXT]);
        }
        $ret = "";
        if ($this->dom && $this->dom->nodes[$this->_[HDOM_INFO_BEGIN]]) {
            $ret = $this->dom->nodes[$this->_[HDOM_INFO_BEGIN]]->makeup();
        }
        if (isset($this->_[HDOM_INFO_INNER])) {
            if ($this->tag !== "br") {
                $ret .= $this->_[HDOM_INFO_INNER];
            }
        } else {
            if ($this->nodes) {
                foreach ($this->nodes as $n) {
                    $ret .= $this->convert_text($n->outertext());
                }
            }
        }
        if (isset($this->_[HDOM_INFO_END]) && $this->_[HDOM_INFO_END] != 0) {
            $ret .= "</" . $this->tag . ">";
        }
        return $ret;
    }
    public function text()
    {
        if (isset($this->_[HDOM_INFO_INNER])) {
            return $this->_[HDOM_INFO_INNER];
        }
        switch ($this->nodetype) {
            case HDOM_TYPE_TEXT:
                return $this->dom->restore_noise($this->_[HDOM_INFO_TEXT]);
                break;
            case HDOM_TYPE_COMMENT:
                return "";
                break;
            case HDOM_TYPE_UNKNOWN:
                return "";
                break;
            default:
                if (strcasecmp($this->tag, "script") === 0) {
                    return "";
                }
                if (strcasecmp($this->tag, "style") === 0) {
                    return "";
                }
                $ret = "";
                if (!is_null($this->nodes)) {
                    foreach ($this->nodes as $n) {
                        if ($n->tag === "p") {
                            $ret = trim($ret) . "\n\n";
                        }
                        $ret .= $this->convert_text($n->text());
                        if ($n->tag === "span") {
                            $ret .= $this->dom->default_span_text;
                        }
                    }
                }
                return $ret;
        }
    }
    public function xmltext()
    {
        $ret = $this->innertext();
        $ret = str_ireplace("<![CDATA[", "", $ret);
        $ret = str_replace("]]>", "", $ret);
        return $ret;
    }
    public function makeup()
    {
        if (isset($this->_[HDOM_INFO_TEXT])) {
            return $this->dom->restore_noise($this->_[HDOM_INFO_TEXT]);
        }
        $ret = "<" . $this->tag;
        $i = -1;
        foreach ($this->attr as $key => $val) {
            $i++;
            if (!($val === NULL || $val === false)) {
                $ret .= $this->_[HDOM_INFO_SPACE][$i][0];
                if ($val === true) {
                    $ret .= $key;
                } else {
                    switch ($this->_[HDOM_INFO_QUOTE][$i]) {
                        case HDOM_QUOTE_DOUBLE:
                            $quote = "\"";
                            break;
                        case HDOM_QUOTE_SINGLE:
                            $quote = "'";
                            break;
                        default:
                            $quote = "";
                            $ret .= $key . $this->_[HDOM_INFO_SPACE][$i][1] . "=" . $this->_[HDOM_INFO_SPACE][$i][2] . $quote . $val . $quote;
                    }
                }
            }
        }
        $ret = $this->dom->restore_noise($ret);
        return $ret . $this->_[HDOM_INFO_ENDSPACE] . ">";
    }
    public function find($selector, $idx = NULL, $lowercase = false)
    {
        $selectors = $this->parse_selector($selector);
        if (($count = count($selectors)) === 0) {
            return [];
        }
        $found_keys = [];
        for ($c = 0; $c < $count; $c++) {
            if (($levle = count($selectors[$c])) === 0) {
                return [];
            }
            if (!isset($this->_[HDOM_INFO_BEGIN])) {
                return [];
            }
            $head = [$this->_[HDOM_INFO_BEGIN] => 1];
            $cmd = " ";
            for ($l = 0; $l < $levle; $l++) {
                $ret = [];
                foreach ($head as $k => $v) {
                    $n = $k === -1 ? $this->dom->root : $this->dom->nodes[$k];
                    $n->seek($selectors[$c][$l], $ret, $cmd, $lowercase);
                }
                $head = $ret;
                $cmd = $selectors[$c][$l][4];
            }
            foreach ($head as $k => $v) {
                if (!isset($found_keys[$k])) {
                    $found_keys[$k] = 1;
                }
            }
        }
        ksort($found_keys);
        $found = [];
        foreach ($found_keys as $k => $v) {
            $found[] = $this->dom->nodes[$k];
        }
        if (is_null($idx)) {
            return $found;
        }
        if ($idx < 0) {
            $idx = count($found) + $idx;
        }
        return isset($found[$idx]) ? $found[$idx] : NULL;
    }
    protected function seek($selector, &$ret, $parent_cmd, $lowercase = false)
    {
        global $debug_object;
        if (is_object($debug_object)) {
            $debug_object->debug_log_entry(1);
        }
        list($tag, $id, $class, $attributes, $cmb) = $selector;
        $nodes = [];
        if ($parent_cmd === " ") {
            $end = !empty($this->_[HDOM_INFO_END]) ? $this->_[HDOM_INFO_END] : 0;
            if ($end == 0) {
                $parent = $this->parent;
                while (!isset($parent->_[HDOM_INFO_END]) && $parent !== NULL) {
                    $end -= 1;
                    $parent = $parent->parent;
                }
                $end += $parent->_[HDOM_INFO_END];
            }
            $nodes_start = $this->_[HDOM_INFO_BEGIN] + 1;
            $nodes_count = $end - $nodes_start;
            $nodes = array_slice($this->dom->nodes, $nodes_start, $nodes_count, true);
        } else {
            if ($parent_cmd === ">") {
                $nodes = $this->children;
            } else {
                if ($parent_cmd === "+" && $this->parent && in_array($this, $this->parent->children)) {
                    $index = array_search($this, $this->parent->children, true) + 1;
                    if ($index < count($this->parent->children)) {
                        $nodes[] = $this->parent->children[$index];
                    }
                } else {
                    if ($parent_cmd === "~" && $this->parent && in_array($this, $this->parent->children)) {
                        $index = array_search($this, $this->parent->children, true);
                        $nodes = array_slice($this->parent->children, $index);
                    }
                }
            }
        }
        foreach ($nodes as $node) {
            $pass = true;
            if (!$node->parent) {
                $pass = false;
            }
            if ($pass && $tag === "text" && $node->tag === "text") {
                $ret[array_search($node, $this->dom->nodes, true)] = 1;
                unset($node);
            } else {
                if ($pass && !in_array($node, $node->parent->children, true)) {
                    $pass = false;
                }
                if ($pass && $tag !== "" && $tag !== $node->tag && $tag !== "*") {
                    $pass = false;
                }
                if ($pass && $id !== "" && !isset($node->attr["id"])) {
                    $pass = false;
                }
                if ($pass && $id !== "" && isset($node->attr["id"])) {
                    list($node_id) = explode(" ", trim($node->attr["id"]));
                    if ($id !== $node_id) {
                        $pass = false;
                    }
                }
                if ($pass && $class !== "" && is_array($class) && !empty($class)) {
                    if (isset($node->attr["class"])) {
                        $node_classes = explode(" ", $node->attr["class"]);
                        if ($lowercase) {
                            $node_classes = array_map("strtolower", $node_classes);
                        }
                        foreach ($class as $c) {
                            if (!in_array($c, $node_classes)) {
                                $pass = false;
                            }
                        }
                    } else {
                        $pass = false;
                    }
                }
                if ($pass && $attributes !== "" && is_array($attributes) && !empty($attributes)) {
                    foreach ($attributes as $a) {
                        list($att_name, $att_expr, $att_val, $att_inv, $att_case_sensitivity) = $a;
                        if (is_numeric($att_name) && $att_expr === "" && $att_val === "") {
                            $count = 0;
                            foreach ($node->parent->children as $c) {
                                if ($c->tag === $node->tag) {
                                    $count++;
                                }
                                if ($c === $node) {
                                    if ($count !== (unset) $att_name) {
                                    }
                                }
                            }
                        }
                        if ($att_inv) {
                            if (isset($node->attr[$att_name])) {
                                $pass = false;
                            }
                        } else {
                            if ($att_name !== "plaintext" && !isset($node->attr[$att_name])) {
                                $pass = false;
                            }
                        }
                        if ($att_expr !== "") {
                            if ($att_name === "plaintext") {
                                $nodeKeyValue = $node->text();
                            } else {
                                $nodeKeyValue = $node->attr[$att_name];
                            }
                            if (is_object($debug_object)) {
                                $debug_object->debug_log(2, "testing node: " . $node->tag . " for attribute: " . $att_name . $att_expr . $att_val . " where nodes value is: " . $nodeKeyValue);
                            }
                            if ($lowercase) {
                                $check = $this->match($att_expr, strtolower($att_val), strtolower($nodeKeyValue), $att_case_sensitivity);
                            } else {
                                $check = $this->match($att_expr, $att_val, $nodeKeyValue, $att_case_sensitivity);
                            }
                            if (is_object($debug_object)) {
                                $debug_object->debug_log(2, "after match: " . ($check ? "true" : "false"));
                            }
                            if (!$check) {
                                $pass = false;
                            }
                        }
                    }
                }
                if ($pass) {
                    $ret[$node->_[HDOM_INFO_BEGIN]] = 1;
                }
                unset($node);
            }
        }
        if (is_object($debug_object)) {
            $debug_object->debug_log(1, "EXIT - ret: ", $ret);
        }
    }
    protected function match($exp, $pattern, $value, $case_sensitivity)
    {
        global $debug_object;
        if (is_object($debug_object)) {
            $debug_object->debug_log_entry(1);
        }
        if ($case_sensitivity === "i") {
            $pattern = strtolower($pattern);
            $value = strtolower($value);
        }
        switch ($exp) {
            case "=":
                return $value === $pattern;
                break;
            case "!=":
                return $value !== $pattern;
                break;
            case "^=":
                return preg_match("/^" . preg_quote($pattern, "/") . "/", $value);
                break;
            case "\$=":
                return preg_match("/" . preg_quote($pattern, "/") . "\$/", $value);
                break;
            case "*=":
                return preg_match("/" . preg_quote($pattern, "/") . "/", $value);
                break;
            case "|=":
                return strpos($value, $pattern) === 0;
                break;
            case "~=":
                return in_array($pattern, explode(" ", trim($value)), true);
                break;
            default:
                return false;
        }
    }
    protected function parse_selector($selector_string)
    {
        global $debug_object;
        if (is_object($debug_object)) {
            $debug_object->debug_log_entry(1);
        }
        $pattern = "/([\\w:\\*-]*)(?:\\#([\\w-]+))?(?:|\\.([\\w\\.-]+))?((?:\\[@?(?:!?[\\w:-]+)(?:(?:[!*^\$|~]?=)[\"']?(?:.*?)[\"']?)?(?:\\s*?(?:[iIsS])?)?\\])+)?([\\/, >+~]+)/is";
        preg_match_all($pattern, trim($selector_string) . " ", $matches, PREG_SET_ORDER);
        if (is_object($debug_object)) {
            $debug_object->debug_log(2, "Matches Array: ", $matches);
        }
        $selectors = [];
        $result = [];
        foreach ($matches as $m) {
            $m[0] = trim($m[0]);
            if (!($m[0] === "" || $m[0] === "/" || $m[0] === "//")) {
                if ($this->dom->lowercase) {
                    $m[1] = strtolower($m[1]);
                }
                if ($m[3] !== "") {
                    $m[3] = explode(".", $m[3]);
                }
                if ($m[4] !== "") {
                    preg_match_all("/\\[@?(!?[\\w:-]+)(?:([!*^\$|~]?=)[\"']?(.*?)[\"']?)?(?:\\s+?([iIsS])?)?\\]/is", trim($m[4]), $attributes, PREG_SET_ORDER);
                    $m[4] = [];
                    foreach ($attributes as $att) {
                        if (trim($att[0]) !== "") {
                            $inverted = isset($att[1][0]) && $att[1][0] === "!";
                            $m[4][] = [$inverted ? substr($att[1], 1) : $att[1], isset($att[2]) ? $att[2] : "", isset($att[3]) ? $att[3] : "", $inverted, isset($att[4]) ? strtolower($att[4]) : ""];
                        }
                    }
                }
                if ($m[5] !== "" && trim($m[5]) === "") {
                    $m[5] = " ";
                } else {
                    $m[5] = trim($m[5]);
                }
                if ($is_list = $m[5] === ",") {
                    $m[5] = "";
                }
                array_shift($m);
                $result[] = $m;
                if ($is_list) {
                    $selectors[] = $result;
                    $result = [];
                }
            }
        }
        if (0 < count($result)) {
            $selectors[] = $result;
        }
        return $selectors;
    }
    public function __get($name)
    {
        if (isset($this->attr[$name])) {
            return $this->convert_text($this->attr[$name]);
        }
        switch ($name) {
            case "outertext":
                return $this->outertext();
                break;
            case "innertext":
                return $this->innertext();
                break;
            case "plaintext":
                return $this->text();
                break;
            case "xmltext":
                return $this->xmltext();
                break;
            default:
                return array_key_exists($name, $this->attr);
        }
    }
    public function __set($name, $value)
    {
        global $debug_object;
        if (is_object($debug_object)) {
            $debug_object->debug_log_entry(1);
        }
        switch ($name) {
            case "outertext":
                $this->_[HDOM_INFO_OUTER] = $value;
                return $this->_[HDOM_INFO_OUTER];
                break;
            case "innertext":
                if (isset($this->_[HDOM_INFO_TEXT])) {
                    $this->_[HDOM_INFO_TEXT] = $value;
                    return $this->_[HDOM_INFO_TEXT];
                }
                $this->_[HDOM_INFO_INNER] = $value;
                return $this->_[HDOM_INFO_INNER];
                break;
            default:
                if (!isset($this->attr[$name])) {
                    $this->_[HDOM_INFO_SPACE][] = [" ", "", ""];
                    $this->_[HDOM_INFO_QUOTE][] = HDOM_QUOTE_DOUBLE;
                }
                $this->attr[$name] = $value;
        }
    }
    public function __isset($name)
    {
        switch ($name) {
            case "outertext":
                return true;
                break;
            case "innertext":
                return true;
                break;
            case "plaintext":
                return true;
                break;
            default:
                return array_key_exists($name, $this->attr) ? true : isset($this->attr[$name]);
        }
    }
    public function __unset($name)
    {
        if (isset($this->attr[$name])) {
            unset($this->attr[$name]);
        }
    }
    public function convert_text($text)
    {
        global $debug_object;
        if (is_object($debug_object)) {
            $debug_object->debug_log_entry(1);
        }
        $converted_text = $text;
        $sourceCharset = "";
        $targetCharset = "";
        if ($this->dom) {
            $sourceCharset = strtoupper($this->dom->_charset);
            $targetCharset = strtoupper($this->dom->_target_charset);
        }
        if (is_object($debug_object)) {
            $debug_object->debug_log(3, "source charset: " . $sourceCharset . " target charaset: " . $targetCharset);
        }
        if (!empty($sourceCharset) && !empty($targetCharset) && strcasecmp($sourceCharset, $targetCharset) != 0) {
            if (strcasecmp($targetCharset, "UTF-8") == 0 && $this->is_utf8($text)) {
                $converted_text = $text;
            } else {
                $converted_text = iconv($sourceCharset, $targetCharset, $text);
            }
        }
        if ($targetCharset === "UTF-8") {
            if (substr($converted_text, 0, 3) === "﻿") {
                $converted_text = substr($converted_text, 3);
            }
            if (substr($converted_text, -3) === "﻿") {
                $converted_text = substr($converted_text, 0, -3);
            }
        }
        return $converted_text;
    }
    public static function is_utf8($str)
    {
        $c = 0;
        $b = 0;
        $bits = 0;
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            $c = ord($str[$i]);
            if (128 < $c) {
                if (254 <= $c) {
                    return false;
                }
                if (252 <= $c) {
                    $bits = 6;
                } else {
                    if (248 <= $c) {
                        $bits = 5;
                    } else {
                        if (240 <= $c) {
                            $bits = 4;
                        } else {
                            if (224 <= $c) {
                                $bits = 3;
                            } else {
                                if (192 <= $c) {
                                    $bits = 2;
                                } else {
                                    return false;
                                }
                            }
                        }
                    }
                }
                if ($len < $i + $bits) {
                    return false;
                }
                while (1 < $bits) {
                    $i++;
                    $b = ord($str[$i]);
                    if ($b < 128 || 191 < $b) {
                        return false;
                    }
                    $bits--;
                }
            }
        }
        return true;
    }
    public function get_display_size()
    {
        global $debug_object;
        $width = -1;
        $height = -1;
        if ($this->tag !== "img") {
            return false;
        }
        if (isset($this->attr["width"])) {
            $width = $this->attr["width"];
        }
        if (isset($this->attr["height"])) {
            $height = $this->attr["height"];
        }
        if (isset($this->attr["style"])) {
            $attributes = [];
            preg_match_all("/([\\w-]+)\\s*:\\s*([^;]+)\\s*;?/", $this->attr["style"], $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $attributes[$match[1]] = $match[2];
            }
            if (isset($attributes["width"]) && $width == -1 && strtolower(substr($attributes["width"], -2)) === "px") {
                $proposed_width = substr($attributes["width"], 0, -2);
                if (filter_var($proposed_width, FILTER_VALIDATE_INT)) {
                    $width = $proposed_width;
                }
            }
            if (isset($attributes["height"]) && $height == -1 && strtolower(substr($attributes["height"], -2)) == "px") {
                $proposed_height = substr($attributes["height"], 0, -2);
                if (filter_var($proposed_height, FILTER_VALIDATE_INT)) {
                    $height = $proposed_height;
                }
            }
        }
        $result = ["height" => $height, "width" => $width];
        return $result;
    }
    public function save($filepath = "")
    {
        $ret = $this->outertext();
        if ($filepath !== "") {
            file_put_contents($filepath, $ret, LOCK_EX);
        }
        return $ret;
    }
    public function addClass($class)
    {
        if (is_string($class)) {
            $class = explode(" ", $class);
        }
        if (is_array($class)) {
            foreach ($class as $c) {
                if (isset($this->class)) {
                    if (!$this->hasClass($c)) {
                        $this->class .= " " . $c;
                    }
                } else {
                    $this->class = $c;
                }
            }
        } else {
            if (is_object($debug_object)) {
                $debug_object->debug_log(2, "Invalid type: ", gettype($class));
            }
        }
    }
    public function hasClass($class)
    {
        if (is_string($class)) {
            if (isset($this->class)) {
                return in_array($class, explode(" ", $this->class), true);
            }
        } else {
            if (is_object($debug_object)) {
                $debug_object->debug_log(2, "Invalid type: ", gettype($class));
            }
        }
        return false;
    }
    public function removeClass($class = NULL)
    {
        if (!isset($this->class)) {
            return NULL;
        }
        if (is_null($class)) {
            $this->removeAttribute("class");
        } else {
            if (is_string($class)) {
                $class = explode(" ", $class);
            }
            if (is_array($class)) {
                $class = array_diff(explode(" ", $this->class), $class);
                if (empty($class)) {
                    $this->removeAttribute("class");
                } else {
                    $this->class = implode(" ", $class);
                }
            }
        }
    }
    public function getAllAttributes()
    {
        return $this->attr;
    }
    public function getAttribute($name)
    {
        return $this->__get($name);
    }
    public function setAttribute($name, $value)
    {
        $this->__set($name, $value);
    }
    public function hasAttribute($name)
    {
        return $this->__isset($name);
    }
    public function removeAttribute($name)
    {
        $this->__set($name, NULL);
    }
    public function remove()
    {
        if ($this->parent) {
            $this->parent->removeChild($this);
        }
    }
    public function removeChild($node)
    {
        $nidx = array_search($node, $this->nodes, true);
        $cidx = array_search($node, $this->children, true);
        $didx = array_search($node, $this->dom->nodes, true);
        if ($nidx !== false && $cidx !== false && $didx !== false) {
            foreach ($node->children as $child) {
                $node->removeChild($child);
            }
            foreach ($node->nodes as $entity) {
                $enidx = array_search($entity, $node->nodes, true);
                $edidx = array_search($entity, $node->dom->nodes, true);
                if ($enidx !== false && $edidx !== false) {
                    unset($node->nodes[$enidx]);
                    unset($node->dom->nodes[$edidx]);
                }
            }
            unset($this->nodes[$nidx]);
            unset($this->children[$cidx]);
            unset($this->dom->nodes[$didx]);
            $node->clear();
        }
    }
    public function getElementById($id)
    {
        return $this->find("#" . $id, 0);
    }
    public function getElementsById($id, $idx = NULL)
    {
        return $this->find("#" . $id, $idx);
    }
    public function getElementByTagName($name)
    {
        return $this->find($name, 0);
    }
    public function getElementsByTagName($name, $idx = NULL)
    {
        return $this->find($name, $idx);
    }
    public function parentNode()
    {
        return $this->parent();
    }
    public function childNodes($idx = -1)
    {
        return $this->children($idx);
    }
    public function firstChild()
    {
        return $this->first_child();
    }
    public function lastChild()
    {
        return $this->last_child();
    }
    public function nextSibling()
    {
        return $this->next_sibling();
    }
    public function previousSibling()
    {
        return $this->prev_sibling();
    }
    public function hasChildNodes()
    {
        return $this->has_child();
    }
    public function nodeName()
    {
        return $this->tag;
    }
    public function appendChild($node)
    {
        $node->parent($this);
        return $node;
    }
}
class simple_html_dom
{
    public $root = NULL;
    public $nodes = [];
    public $callback = NULL;
    public $lowercase = false;
    public $original_size = NULL;
    public $size = NULL;
    protected $pos = NULL;
    protected $doc = NULL;
    protected $char = NULL;
    protected $cursor = NULL;
    protected $parent = NULL;
    protected $noise = [];
    protected $token_blank = " \t\r\n";
    protected $token_equal = " =/>";
    protected $token_slash = " />\r\n\t";
    protected $token_attr = " >";
    public $_charset = "";
    public $_target_charset = "";
    protected $default_br_text = "";
    public $default_span_text = "";
    protected $self_closing_tags = ["area" => 1, "base" => 1, "br" => 1, "col" => 1, "embed" => 1, "hr" => 1, "img" => 1, "input" => 1, "link" => 1, "meta" => 1, "param" => 1, "source" => 1, "track" => 1, "wbr" => 1];
    protected $block_tags = ["body" => 1, "div" => 1, "form" => 1, "root" => 1, "span" => 1, "table" => 1];
    protected $optional_closing_tags = ["b" => ["b" => 1], "dd" => ["dd" => 1, "dt" => 1], "dl" => ["dd" => 1, "dt" => 1], "dt" => ["dd" => 1, "dt" => 1], "li" => ["li" => 1], "optgroup" => ["optgroup" => 1, "option" => 1], "option" => ["optgroup" => 1, "option" => 1], "p" => ["p" => 1], "rp" => ["rp" => 1, "rt" => 1], "rt" => ["rp" => 1, "rt" => 1], "td" => ["td" => 1, "th" => 1], "th" => ["td" => 1, "th" => 1], "tr" => ["td" => 1, "th" => 1, "tr" => 1]];
    public function __construct($str = NULL, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = true, $defaultBRText = DEFAULT_BR_TEXT, $defaultSpanText = DEFAULT_SPAN_TEXT, $options = 0)
    {
        if ($str) {
            if (preg_match("/^http:\\/\\//i", $str) || is_file($str)) {
                $this->load_file($str);
            } else {
                $this->load($str, $lowercase, $stripRN, $defaultBRText, $defaultSpanText, $options);
            }
        }
        if (!$forceTagsClosed) {
            $this->optional_closing_array = [];
        }
        $this->_target_charset = $target_charset;
    }
    public function __destruct()
    {
        $this->clear();
    }
    public function load($str, $lowercase = true, $stripRN = true, $defaultBRText = DEFAULT_BR_TEXT, $defaultSpanText = DEFAULT_SPAN_TEXT, $options = 0)
    {
        global $debug_object;
        $this->prepare($str, $lowercase, $defaultBRText, $defaultSpanText);
        $this->remove_noise("'<\\s*script[^>]*[^/]>(.*?)<\\s*/\\s*script\\s*>'is");
        $this->remove_noise("'<\\s*script\\s*>(.*?)<\\s*/\\s*script\\s*>'is");
        if ($stripRN) {
            $this->doc = str_replace("\r", " ", $this->doc);
            $this->doc = str_replace("\n", " ", $this->doc);
            $this->size = strlen($this->doc);
        }
        $this->remove_noise("'<!\\[CDATA\\[(.*?)\\]\\]>'is", true);
        $this->remove_noise("'<!--(.*?)-->'is");
        $this->remove_noise("'<\\s*style[^>]*[^/]>(.*?)<\\s*/\\s*style\\s*>'is");
        $this->remove_noise("'<\\s*style\\s*>(.*?)<\\s*/\\s*style\\s*>'is");
        $this->remove_noise("'<\\s*(?:code)[^>]*>(.*?)<\\s*/\\s*(?:code)\\s*>'is");
        $this->remove_noise("'(<\\?)(.*?)(\\?>)'s", true);
        if ($options & HDOM_SMARTY_AS_TEXT) {
            $this->remove_noise("'(\\{\\w)(.*?)(\\})'s", true);
        }
        $this->parse();
        $this->root->_[HDOM_INFO_END] = $this->cursor;
        $this->parse_charset();
        return $this;
    }
    public function load_file()
    {
        $args = func_get_args();
        if (($doc = call_user_func_array("file_get_contents", $args)) !== false) {
            $this->load($doc, true);
        } else {
            return false;
        }
    }
    public function set_callback($function_name)
    {
        $this->callback = $function_name;
    }
    public function remove_callback()
    {
        $this->callback = NULL;
    }
    public function save($filepath = "")
    {
        $ret = $this->root->innertext();
        if ($filepath !== "") {
            file_put_contents($filepath, $ret, LOCK_EX);
        }
        return $ret;
    }
    public function find($selector, $idx = NULL, $lowercase = false)
    {
        return $this->root->find($selector, $idx, $lowercase);
    }
    public function clear()
    {
        if (isset($this->nodes)) {
            foreach ($this->nodes as $n) {
                $n->clear();
                $n = NULL;
            }
        }
        if (isset($this->children)) {
            foreach ($this->children as $n) {
                $n->clear();
                $n = NULL;
            }
        }
        if (isset($this->parent)) {
            $this->parent->clear();
            unset($this->parent);
        }
        if (isset($this->root)) {
            $this->root->clear();
            unset($this->root);
        }
        unset($this->doc);
        unset($this->noise);
    }
    public function dump($show_attr = true)
    {
        $this->root->dump($show_attr);
    }
    protected function prepare($str, $lowercase = true, $defaultBRText = DEFAULT_BR_TEXT, $defaultSpanText = DEFAULT_SPAN_TEXT)
    {
        $this->clear();
        $this->doc = trim($str);
        $this->size = strlen($this->doc);
        $this->original_size = $this->size;
        $this->pos = 0;
        $this->cursor = 1;
        $this->noise = [];
        $this->nodes = [];
        $this->lowercase = $lowercase;
        $this->default_br_text = $defaultBRText;
        $this->default_span_text = $defaultSpanText;
        $this->root = new simple_html_dom_node($this);
        $this->root->tag = "root";
        $this->root->_[HDOM_INFO_BEGIN] = -1;
        $this->root->nodetype = HDOM_TYPE_ROOT;
        $this->parent = $this->root;
        if (0 < $this->size) {
            $this->char = $this->doc[0];
        }
    }
    protected function parse()
    {
        while (true) {
            if (($s = $this->copy_until_char("<")) === "") {
                if (!$this->read_tag()) {
                    return true;
                }
            } else {
                $node = new simple_html_dom_node($this);
                $this->cursor++;
                $node->_[HDOM_INFO_TEXT] = $s;
                $this->link_nodes($node, false);
            }
        }
    }
    protected function parse_charset()
    {
        global $debug_object;
        $charset = NULL;
        if (function_exists("get_last_retrieve_url_contents_content_type")) {
            $contentTypeHeader = get_last_retrieve_url_contents_content_type();
            $success = preg_match("/charset=(.+)/", $contentTypeHeader, $matches);
            if ($success) {
                $charset = $matches[1];
                if (is_object($debug_object)) {
                    $debug_object->debug_log(2, "header content-type found charset of: " . $charset);
                }
            }
        }
        if (empty($charset)) {
            $el = $this->root->find("meta[http-equiv=Content-Type]", 0, true);
            if (!empty($el)) {
                $fullvalue = $el->content;
                if (is_object($debug_object)) {
                    $debug_object->debug_log(2, "meta content-type tag found" . $fullvalue);
                }
                if (!empty($fullvalue)) {
                    $success = preg_match("/charset=(.+)/i", $fullvalue, $matches);
                    if ($success) {
                        $charset = $matches[1];
                    } else {
                        if (is_object($debug_object)) {
                            $debug_object->debug_log(2, "meta content-type tag couldn't be parsed. using iso-8859 default.");
                        }
                        $charset = "ISO-8859-1";
                    }
                }
            }
        }
        if (empty($charset) && ($meta = $this->root->find("meta[charset]", 0))) {
            $charset = $meta->charset;
            if (is_object($debug_object)) {
                $debug_object->debug_log(2, "meta charset: " . $charset);
            }
        }
        if (empty($charset) && function_exists("mb_detect_encoding")) {
            $encoding = mb_detect_encoding($this->doc, ["UTF-8", "CP1252", "ISO-8859-1"]);
            if (($encoding === "CP1252" || $encoding === "ISO-8859-1") && !@iconv("CP1252", "UTF-8", $this->doc)) {
                $encoding = "CP1251";
            }
            if ($encoding !== false) {
                $charset = $encoding;
                if (is_object($debug_object)) {
                    $debug_object->debug_log(2, "mb_detect: " . $charset);
                }
            }
        }
        if (empty($charset)) {
            $charset = "UTF-8";
            if (is_object($debug_object)) {
                $debug_object->debug_log(2, "No match found, assume " . $charset);
            }
        }
        if (strtolower($charset) == "iso-8859-1" || strtolower($charset) == "latin1" || strtolower($charset) == "latin-1") {
            $charset = "CP1252";
            if (is_object($debug_object)) {
                $debug_object->debug_log(2, "replacing " . $charset . " with CP1252 as its a superset");
            }
        }
        if (is_object($debug_object)) {
            $debug_object->debug_log(1, "EXIT - " . $charset);
        }
        return $this->_charset = $charset;
    }
    protected function read_tag()
    {
        if ($this->char !== "<") {
            $this->root->_[HDOM_INFO_END] = $this->cursor;
            return false;
        }
        $begin_tag_pos = $this->pos;
        $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
        if ($this->char === "/") {
            $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
            $this->skip($this->token_blank);
            $tag = $this->copy_until_char(">");
            if (($pos = strpos($tag, " ")) !== false) {
                $tag = substr($tag, 0, $pos);
            }
            $parent_lower = strtolower($this->parent->tag);
            $tag_lower = strtolower($tag);
            if ($parent_lower !== $tag_lower) {
                if (isset($this->optional_closing_tags[$parent_lower]) && isset($this->block_tags[$tag_lower])) {
                    $this->parent->_[HDOM_INFO_END] = 0;
                    $org_parent = $this->parent;
                    while ($this->parent->parent && strtolower($this->parent->tag) !== $tag_lower) {
                        $this->parent = $this->parent->parent;
                    }
                    if (strtolower($this->parent->tag) !== $tag_lower) {
                        $this->parent = $org_parent;
                        if ($this->parent->parent) {
                            $this->parent = $this->parent->parent;
                        }
                        $this->parent->_[HDOM_INFO_END] = $this->cursor;
                        return $this->as_text_node($tag);
                    }
                } else {
                    if ($this->parent->parent && isset($this->block_tags[$tag_lower])) {
                        $this->parent->_[HDOM_INFO_END] = 0;
                        $org_parent = $this->parent;
                        while ($this->parent->parent && strtolower($this->parent->tag) !== $tag_lower) {
                            $this->parent = $this->parent->parent;
                        }
                        if (strtolower($this->parent->tag) !== $tag_lower) {
                            $this->parent = $org_parent;
                            $this->parent->_[HDOM_INFO_END] = $this->cursor;
                            return $this->as_text_node($tag);
                        }
                    } else {
                        if ($this->parent->parent && strtolower($this->parent->parent->tag) === $tag_lower) {
                            $this->parent->_[HDOM_INFO_END] = 0;
                            $this->parent = $this->parent->parent;
                        } else {
                            return $this->as_text_node($tag);
                        }
                    }
                }
            }
            $this->parent->_[HDOM_INFO_END] = $this->cursor;
            if ($this->parent->parent) {
                $this->parent = $this->parent->parent;
            }
            $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
            return true;
        }
        $node = new simple_html_dom_node($this);
        $node->_[HDOM_INFO_BEGIN] = $this->cursor;
        $this->cursor++;
        $tag = $this->copy_until($this->token_slash);
        $node->tag_start = $begin_tag_pos;
        if (isset($tag[0]) && $tag[0] === "!") {
            $node->_[HDOM_INFO_TEXT] = "<" . $tag . $this->copy_until_char(">");
            if (isset($tag[2]) && $tag[1] === "-" && $tag[2] === "-") {
                $node->nodetype = HDOM_TYPE_COMMENT;
                $node->tag = "comment";
            } else {
                $node->nodetype = HDOM_TYPE_UNKNOWN;
                $node->tag = "unknown";
            }
            if ($this->char === ">") {
                $node->_[HDOM_INFO_TEXT] .= ">";
            }
            $this->link_nodes($node, true);
            $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
            return true;
        }
        if ($pos = strpos($tag, "<") !== false) {
            $tag = "<" . substr($tag, 0, -1);
            $node->_[HDOM_INFO_TEXT] = $tag;
            $this->link_nodes($node, false);
            $this->char = $this->doc[--$this->pos];
            return true;
        }
        if (!preg_match("/^\\w[\\w:-]*\$/", $tag)) {
            $node->_[HDOM_INFO_TEXT] = "<" . $tag . $this->copy_until("<>");
            if ($this->char === "<") {
                $this->link_nodes($node, false);
                return true;
            }
            if ($this->char === ">") {
                $node->_[HDOM_INFO_TEXT] .= ">";
            }
            $this->link_nodes($node, false);
            $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
            return true;
        }
        $node->nodetype = HDOM_TYPE_ELEMENT;
        $tag_lower = strtolower($tag);
        $node->tag = $this->lowercase ? $tag_lower : $tag;
        if (isset($this->optional_closing_tags[$tag_lower])) {
            while (isset($this->optional_closing_tags[$tag_lower][strtolower($this->parent->tag)])) {
                $this->parent->_[HDOM_INFO_END] = 0;
                $this->parent = $this->parent->parent;
            }
            $node->parent = $this->parent;
        }
        $guard = 0;
        $space = [$this->copy_skip($this->token_blank), "", ""];
        $name = $this->copy_until($this->token_equal);
        if (!($name === "" && $this->char !== NULL && $space[0] === "")) {
            if ($guard === $this->pos) {
                $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
            } else {
                $guard = $this->pos;
                if ($this->size - 1 <= $this->pos && $this->char !== ">") {
                    $node->nodetype = HDOM_TYPE_TEXT;
                    $node->_[HDOM_INFO_END] = 0;
                    $node->_[HDOM_INFO_TEXT] = "<" . $tag . $space[0] . $name;
                    $node->tag = "text";
                    $this->link_nodes($node, false);
                    return true;
                }
                if ($this->doc[$this->pos - 1] == "<") {
                    $node->nodetype = HDOM_TYPE_TEXT;
                    $node->tag = "text";
                    $node->attr = [];
                    $node->_[HDOM_INFO_END] = 0;
                    $node->_[HDOM_INFO_TEXT] = substr($this->doc, $begin_tag_pos, $this->pos - $begin_tag_pos - 1);
                    $this->pos -= 2;
                    $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
                    $this->link_nodes($node, false);
                    return true;
                }
                if ($name !== "/" && $name !== "") {
                    $space[1] = $this->copy_skip($this->token_blank);
                    $name = $this->restore_noise($name);
                    if ($this->lowercase) {
                        $name = strtolower($name);
                    }
                    if ($this->char === "=") {
                        $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
                        $this->parse_attr($node, $name, $space);
                    } else {
                        $node->_[HDOM_INFO_QUOTE][] = HDOM_QUOTE_NO;
                        $node->attr[$name] = true;
                        if ($this->char != ">") {
                            $this->char = $this->doc[--$this->pos];
                        }
                    }
                    $node->_[HDOM_INFO_SPACE][] = $space;
                    $space = [$this->copy_skip($this->token_blank), "", ""];
                }
            }
            if ($this->char !== ">" && $this->char !== "/") {
            }
        }
        $this->link_nodes($node, true);
        $node->_[HDOM_INFO_ENDSPACE] = $space[0];
        if ($this->copy_until_char(">") === "/") {
            $node->_[HDOM_INFO_ENDSPACE] .= "/";
            $node->_[HDOM_INFO_END] = 0;
        } else {
            if (!isset($this->self_closing_tags[strtolower($node->tag)])) {
                $this->parent = $node;
            }
        }
        $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
        if ($node->tag === "br") {
            $node->_[HDOM_INFO_INNER] = $this->default_br_text;
        }
        return true;
    }
    protected function parse_attr($node, $name, &$space)
    {
        $is_duplicate = isset($node->attr[$name]);
        if (!$is_duplicate) {
            $space[2] = $this->copy_skip($this->token_blank);
        }
        switch ($this->char) {
            case "\"":
                $quote_type = HDOM_QUOTE_DOUBLE;
                $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
                $value = $this->copy_until_char("\"");
                $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
                break;
            case "'":
                $quote_type = HDOM_QUOTE_SINGLE;
                $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
                $value = $this->copy_until_char("'");
                $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
                break;
            default:
                $quote_type = HDOM_QUOTE_NO;
                $value = $this->copy_until($this->token_attr);
                $value = $this->restore_noise($value);
                $value = str_replace("\r", "", $value);
                $value = str_replace("\n", "", $value);
                if ($name === "class") {
                    $value = trim($value);
                }
                if (!$is_duplicate) {
                    $node->_[HDOM_INFO_QUOTE][] = $quote_type;
                    $node->attr[$name] = $value;
                }
        }
    }
    protected function link_nodes(&$node, $is_child)
    {
        $node->parent = $this->parent;
        $this->parent->nodes[] = $node;
        if ($is_child) {
            $this->parent->children[] = $node;
        }
    }
    protected function as_text_node($tag)
    {
        $node = new simple_html_dom_node($this);
        $this->cursor++;
        $node->_[HDOM_INFO_TEXT] = "</" . $tag . ">";
        $this->link_nodes($node, false);
        $this->char = ++$this->pos < $this->size ? $this->doc[$this->pos] : NULL;
        return true;
    }
    protected function skip($chars)
    {
        $this->pos += strspn($this->doc, $chars, $this->pos);
        $this->char = $this->pos < $this->size ? $this->doc[$this->pos] : NULL;
    }
    protected function copy_skip($chars)
    {
        $pos = $this->pos;
        $len = strspn($this->doc, $chars, $pos);
        $this->pos += $len;
        $this->char = $this->pos < $this->size ? $this->doc[$this->pos] : NULL;
        if ($len === 0) {
            return "";
        }
        return substr($this->doc, $pos, $len);
    }
    protected function copy_until($chars)
    {
        $pos = $this->pos;
        $len = strcspn($this->doc, $chars, $pos);
        $this->pos += $len;
        $this->char = $this->pos < $this->size ? $this->doc[$this->pos] : NULL;
        return substr($this->doc, $pos, $len);
    }
    protected function copy_until_char($char)
    {
        if ($this->char === NULL) {
            return "";
        }
        if (($pos = strpos($this->doc, $char, $this->pos)) === false) {
            $ret = substr($this->doc, $this->pos, $this->size - $this->pos);
            $this->char = NULL;
            $this->pos = $this->size;
            return $ret;
        }
        if ($pos === $this->pos) {
            return "";
        }
        $pos_old = $this->pos;
        $this->char = $this->doc[$pos];
        $this->pos = $pos;
        return substr($this->doc, $pos_old, $pos - $pos_old);
    }
    protected function remove_noise($pattern, $remove_tag = false)
    {
        global $debug_object;
        if (is_object($debug_object)) {
            $debug_object->debug_log_entry(1);
        }
        $count = preg_match_all($pattern, $this->doc, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE);
        $i = $count - 1;
        while (-1 < $i) {
            $key = "___noise___" . sprintf("% 5d", count($this->noise) + 1000);
            if (is_object($debug_object)) {
                $debug_object->debug_log(2, "key is: " . $key);
            }
            $idx = $remove_tag ? 0 : 1;
            $this->noise[$key] = $matches[$i][$idx][0];
            $this->doc = substr_replace($this->doc, $key, $matches[$i][$idx][1], strlen($matches[$i][$idx][0]));
            --$i;
        }
        $this->size = strlen($this->doc);
        if (0 < $this->size) {
            $this->char = $this->doc[0];
        }
    }
    public function restore_noise($text)
    {
        global $debug_object;
        if (is_object($debug_object)) {
            $debug_object->debug_log_entry(1);
            while (($pos = strpos($text, "___noise___")) !== false) {
            }
            return $text;
        }
        if ($pos + 15 < strlen($text)) {
            $key = "___noise___" . $text[$pos + 11] . $text[$pos + 12] . $text[$pos + 13] . $text[$pos + 14] . $text[$pos + 15];
            if (is_object($debug_object)) {
                $debug_object->debug_log(2, "located key of: " . $key);
            }
            if (isset($this->noise[$key])) {
                $text = substr($text, 0, $pos) . $this->noise[$key] . substr($text, $pos + 16);
            } else {
                $text = substr($text, 0, $pos) . "UNDEFINED NOISE FOR KEY: " . $key . substr($text, $pos + 16);
            }
        } else {
            $text = substr($text, 0, $pos) . "NO NUMERIC NOISE KEY" . substr($text, $pos + 11);
        }
    }
    public function search_noise($text)
    {
        global $debug_object;
        if (is_object($debug_object)) {
            $debug_object->debug_log_entry(1);
        }
        foreach ($this->noise as $noiseElement) {
            if (strpos($noiseElement, $text) !== false) {
                return $noiseElement;
            }
        }
    }
    public function __toString()
    {
        return $this->root->innertext();
    }
    public function __get($name)
    {
        switch ($name) {
            case "outertext":
                return $this->root->innertext();
                break;
            case "innertext":
                return $this->root->innertext();
                break;
            case "plaintext":
                return $this->root->text();
                break;
            case "charset":
                return $this->_charset;
                break;
            case "target_charset":
                return $this->_target_charset;
                break;
        }
    }
    public function childNodes($idx = -1)
    {
        return $this->root->childNodes($idx);
    }
    public function firstChild()
    {
        return $this->root->first_child();
    }
    public function lastChild()
    {
        return $this->root->last_child();
    }
    public function createElement($name, $value = NULL)
    {
        return @@str_get_html("<" . $name . ">" . $value . "</" . $name . ">")->firstChild();
    }
    public function createTextNode($value)
    {
        return @end(@str_get_html($value)->nodes);
    }
    public function getElementById($id)
    {
        return $this->find("#" . $id, 0);
    }
    public function getElementsById($id, $idx = NULL)
    {
        return $this->find("#" . $id, $idx);
    }
    public function getElementByTagName($name)
    {
        return $this->find($name, 0);
    }
    public function getElementsByTagName($name, $idx = -1)
    {
        return $this->find($name, $idx);
    }
    public function loadFile()
    {
        $args = func_get_args();
        $this->load_file($args);
    }
}
function file_get_html($url, $use_include_path = false, $context = NULL, $offset = 0, $maxLen = -1, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = true, $defaultBRText = DEFAULT_BR_TEXT, $defaultSpanText = DEFAULT_SPAN_TEXT)
{
    if ($maxLen <= 0) {
        $maxLen = MAX_FILE_SIZE;
    }
    $dom = new simple_html_dom(NULL, $lowercase, $forceTagsClosed, $target_charset, $stripRN, $defaultBRText, $defaultSpanText);
    $contents = file_get_contents($url, $use_include_path, $context, $offset, $maxLen);
    if (empty($contents) || $maxLen < strlen($contents)) {
        $dom->clear();
        return false;
    }
    return $dom->load($contents, $lowercase, $stripRN);
}
function str_get_html($str, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = true, $defaultBRText = DEFAULT_BR_TEXT, $defaultSpanText = DEFAULT_SPAN_TEXT)
{
    $dom = new simple_html_dom(NULL, $lowercase, $forceTagsClosed, $target_charset, $stripRN, $defaultBRText, $defaultSpanText);
    if (empty($str) || MAX_FILE_SIZE < strlen($str)) {
        $dom->clear();
        return false;
    }
    return $dom->load($str, $lowercase, $stripRN);
}
function dump_html_tree($node, $show_attr = true, $deep = 0)
{
    $node->dump($node);
}

?>
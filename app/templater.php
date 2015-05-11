<?php
    class templater {
        private $template;
        private $pagevars = [];
        public function __construct($template) {
            $this->template = $template;
        }
        public function set($var, $val) {
            $this->pagevars[$var] = $val;
        }
        public function render() {
            extract($this->pagevars);
            ob_start();
            require_once($this->template);
            echo ob_get_clean();
        }
    }
?>
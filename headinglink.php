<?php
// Headinglink extension, https://github.com/pftnhr/yellow-headinglink

class YellowHeadinglink {
	const VERSION = "0.8.21";
	public $yellow;            //access to API

	// Handle initialisation
	public function onLoad($yellow) {
		$this->yellow = $yellow;
	}

	// Handle page content of shortcut
	public function onParseContentShortcut($page, $name, $text, $type) {
		$output = null;
		if ($name=="heading" && ($type=="block" || $type=="inline")) {
			list($level, $content) = $this->yellow->toolbox->getTextArguments($text);
			if (is_string_empty($level)) $level = "2";
			if (is_string_empty($content)) $content = "Heading";
			$output .= "<h".$level." id=\"".preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($content))."\" class=\"anchor-heading\">".$content."<a href=\"#".preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($content))."\" class=\"headinglink\" aria-hidden=\"true\" hidden>#</a></h".$level.">";
		}
		return $output;
	}

	// Handle page extra data
	public function onParsePageExtra($page, $name) {
		$output = null;
		if ($name=="header") {
			$extensionLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreExtensionLocation");
			$output = "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$extensionLocation}headinglink.css\" />\n";
		}
		return $output;
	}
}

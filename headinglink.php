<?php
// Headinglink extension, https://github.com/pftnhr/yellow-headinglink

class YellowHeadinglink {
	const VERSION = "0.8.22";
	public $yellow;            //access to API

	// Handle initialisation
	public function onLoad($yellow) {
		$this->yellow = $yellow;
		$this->yellow->system->setDefault("headinglinkContent", "#");
	}

	// Handle page content of shortcut
	public function onParseContentShortcut($page, $name, $text, $type) {
		$output = null;
		$allowedNames = ["h1", "h2", "h3", "h4", "h5", "h6"];
		if (in_array($name, $allowedNames) && ($type=="block" || $type=="inline")) {
			list($content, $headlinktext) = $this->yellow->toolbox->getTextArguments($text);
			if (is_string_empty($content)) $content = "Heading";
			if (is_string_empty($headlinktext)) $headlinktext = $this->yellow->system->get("headinglinkContent");
			$output .= "<".$name." id=\"".preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($content))."\" class=\"anchor-heading\">".$content."<a href=\"#".preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($content))."\" class=\"headinglink\" aria-hidden=\"true\" hidden>".$headlinktext."</a></".$name.">";
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

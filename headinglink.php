<?php
// Headinglink extension, https://github.com/pftnhr/yellow-headinglink

class YellowHeadinglink {
	const VERSION = "0.8.23";
	public $yellow;            //access to API

	// Handle initialisation
	public function onLoad($yellow) {
		$this->yellow = $yellow;
		$this->yellow->system->setDefault("HeadinglinkContent", "#");
	}

	// Handle page content of shortcut
	public function onParseContentShortcut($page, $name, $text, $type) {
		$output = null;
		$allowedNames = ["h1", "h2", "h3", "h4", "h5", "h6"];
		if (in_array($name, $allowedNames) && ($type=="block" || $type=="inline")) {
			list($content, $headinglinktext) = $this->yellow->toolbox->getTextArguments($text);
			if (is_string_empty($content)) $content = "Heading";
			if (is_string_empty($headinglinktext)) $headinglinktext = $this->yellow->system->get("HeadinglinkContent");
			
			$headinglinkid = preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($content));
			
			$output .= "<".$name." id=\"".$headinglinkid."\">".$content."<a href=\"#".$headinglinkid."\" class=\"headinglink\" aria-hidden=\"true\" hidden>".$headinglinktext."</a></".$name.">";
		}
		return $output;
	}

	// Handle page extra data
	public function onParsePageExtra($page, $name) {
		$output = null;
		if ($name=="header") {
			$extensionLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreExtensionLocation");
			$output = "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$extensionLocation}headinglink.css\" />\n";
			$output .= "<script type=\"text/javascript\" defer=\"defer\" src=\"{$extensionLocation}headinglink.js\"></script>\n";
		}
		return $output;
	}
}

<?php
// Anchor extension, https://github.com/pftnhr/yellow-anchor

class YellowAnchor {
	const VERSION = "0.8.24";
	public $yellow;            //access to API

	// Handle initialisation
	public function onLoad($yellow) {
		$this->yellow = $yellow;
		$this->yellow->system->setDefault("AnchorContent", "#");
	}

	// Handle page content of shortcut
	public function onParseContentShortcut($page, $name, $text, $type) {
		$output = null;
		$allowedNames = ["h1", "h2", "h3", "h4", "h5", "h6"];
		if (in_array($name, $allowedNames) && ($type=="block" || $type=="inline")) {
			list($content, $anchortext) = $this->yellow->toolbox->getTextArguments($text);
			if (is_string_empty($content)) $content = "Heading";
			if (is_string_empty($anchortext)) $anchortext = $this->yellow->system->get("AnchorContent");
			
			$anchorid = preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($content));
			
			$output .= "<".$name." id=\"".$anchorid."\">".$content."<a href=\"#".$anchorid."\" class=\"anchor\" aria-hidden=\"true\" hidden>".$anchortext."</a></".$name.">";
		}
		return $output;
	}

	// Handle page extra data
	public function onParsePageExtra($page, $name) {
		$output = null;
		if ($name=="header") {
			$extensionLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreExtensionLocation");
			$output = "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$extensionLocation}anchor.css\" />\n";
		}
		return $output;
	}
}

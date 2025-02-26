<?php
// Anchor extension, https://github.com/pftnhr/yellow-anchor

class YellowAnchor {
    const VERSION = "0.9.3";
    public $yellow;            //access to API

    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("anchorIcon", "anchor-icon-default");
    }

    // Handle page content in HTML format
    public function onParseContentHtml($page, $text) {
        $output = null;
        if (!preg_match("/exclude/i", $page->get("anchor"))) {
            $location = $page->getPage("main")->getLocation(true);
            $icon = $this->yellow->system->get("anchorIcon");
            if ($icon=="anchor-icon-default") $icon = "anchor-icon anchor-icon-default";
            $callback = function ($matches) use ($location, $icon) {
                $anchor = "<a href=\"$location#$matches[2]\" class=\"anchor-link\" title=\"#".htmlspecialchars($matches[2])."\"><i class=\"".htmlspecialchars($icon)."\" role=\"img\" aria-label=\"Anchor\"></i></a>";
                return "<h$matches[1] id=\"$matches[2]\">$matches[3]$anchor</h$matches[1]>";
            };
            $textWithAnchor = preg_replace_callback("/<h(\d) id=\"([^\"]+)\">(.*?)<\/h\d>/i", $callback, $text);
            if ($textWithAnchor!=$text) $output = $textWithAnchor;
        }
        return $output;
    }

    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            $assetLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreAssetLocation");
            $output = "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$assetLocation}anchor.css\">\n";
        }
        return $output;
    }
}

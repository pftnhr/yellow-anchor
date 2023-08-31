# Headinglink 0.8.21

Add anchor links next to headings in the content.

<p align="center"><img src="headinglink-screenshot.png" alt="Screenshot"></p>

## How to install an extension

[Download ZIP file](https://github.com/pftnhr/yellow-headinglink/archive/refs/heads/main.zip) and copy it into your `system/extensions` folder. [Learn more about extensions](https://github.com/annaesvensson/yellow-update).

## How to make anchor links next to the contents headline

Create a `[h2]` shortcut.

## Examples

Making a headline with anchor link:

    [h2 "My level 2 headline"]
    [h3 "My level 3 headline" ¶]

becomes

    <h2 id="my-level-2-headline" class="anchor-heading">My level 2 headline<a href="#my-level-2-headline" class="headinglink smooth" aria-hidden="true" hidden>#</a></h2>
    <h3 id="my-level-3-headline" class="anchor-heading">My level 3 headline<a href="#my-level-3-headline" class="headinglink smooth" aria-hidden="true" hidden>¶</a></h3>

You can create headings for all 6 levels but keep in mind that a level 1 headline should only appear once per page. Class `smooth` is only for smooth scrolling via JavaScript (see `headinglink.js`).

## Settings

The following settings can be configured in file system/extensions/yellow-system.ini:

headinglinkContent = default link text

After your headline text you can set a link text other than default.

## Acknowledgements

I built this extension because of an encouraging [comment](https://github.com/datenstrom/yellow/discussions/887#discussioncomment-6846569) by Mark Seuffert.

## Developer

Robert Pfotenhauer. [Get help](https://datenstrom.se/yellow/help/).

## ToDo

- [x] Make it work with syntax (`h2`)
- [x] Make link text customizable

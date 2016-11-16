# RD-String
ExpressionEngine3 plugin that adds string manipulation functionality to directly call PHP's string functions

This plugin takes 2 parameters, `functions` and `params`. Each is a pipe-delimited list (no pipes needed if only running one function). Functions will be called on the tag contents in the order provided. Add `parse="inward"` to parse contained EE tags first.

## Basic Example

```html
{exp:rd_string functions="substr" params="10"}
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a ipsum
{/exp:rd_string}
```

returns:

```html
Lorem ipsu
```

## Multiple Example

```html
{exp:rd_string functions="substr|strtoupper" params="15|"}
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a ipsum
{/exp:rd_string}
```

returns:

```html
LOREM IPSUM DOL
```

## Included PHP functions:

* **strip_tags** - Strip HTML and PHP tags from a string
* **strtolower** — Make a string lowercase
* **strtoupper** — Make a string uppercase
* **substr** — Return part of a string
* **substr_replace** — Replace text within a portion of a string
* **url_encode** — URL-encodes string

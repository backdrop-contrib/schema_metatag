# Schema.org Metatag

This project extends Backdrop's Metatag module to display structured data as
JSON-LD in the head of web pages. Either hard-code properties or identify
patterns using token replacements. Using the override system in Metatag module
you can define default structured data values for all content types, override
the global content defaults for a particular content type, or even override
everything else on an individual node to provide specific values for that node.

Read more about [Schema.org](https://schema.org/), JSON-LD, and how this module works in an article on
Lullabot.com:
Create SEO Juice From JSON LD Structured Data in Backdrop
https://www.lullabot.com/articles/create-seo-juice-by-adding-json-ld-structured-data-to-drupal-8.

Since the Schema.org [1] list is huge, and growing, this module only provides a
small subset of those values, but it is designed to be extensible. Several types
are included which can be copied to add new types (groups) with any number of
their own properties.

The module creates the following Schema.org object types:

Schema.org/Article
Schema.org/Event
Schema.org/ItemList (for Views)
Schema.org/Organization
Schema.org/VideoObject
Schema.org/WebPage
Schema.org/WebSite


## Requirements

The [Metatag](https://backdropcms.org/project/metatag) module is required

This module requires PHP 5.6 or higher. It will not work with older versions of PHP.


## Validation
For more information and to test the results:
- https://developers.google.com/search/docs/guides/intro-structured-data
- https://schema.org/docs/full.html
- https://search.google.com/structured-data/testing-tool

If you are new to structured data you should definitely read the first reference
carefully.

### Known Issues
- Some themes may strip out part of the JSON LD element,
  invalidating the result. Use a different theme.
 
- To populate the image width and height properties, use the appropriate tokens.

### Development Instructions
This module defines Metatag groups that map to Schema.org types, and Metatag
tags for Schema.org properties, then steps in before the values are rendered as
metatags, pulls the Schema.org values out of the header created by Metatag, and
instead renders them as JSON-LD when the page is displayed.

The module includes a base group class and several base tag classes that can be
extended. Many properties are simple key/value pairs that require nothing more
than extending the base class and giving them their own ids. Some are more
complex, like Person and Organization, and BreadcrumbList, and they collect
multiple values and serialize the results.

The development process for adding groups and properties:

- Create a file MODULE_NAME.metatag.inc and define the groups and properties
  there. The $info array allows you to indicate a class for each property, where
  you can use the appropriate base class.

In either case, you should be able to copy one of the existing modules as a
starting point.


Examples
--------------------------------------------------------------------------------
Using this module, the code in the head might end up looking like this:
```html
<code>
<script type="application/ld+json">{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "Article",
            "description": "Curabitur arcu erat.",
            "datePublished": "2009-11-30T13:04:01-0600",
            "dateModified": "2017-05-17T19:02:01-0500",
            "headline": "Curabitur arcu erat]",
            "author": {
                "@type": "Person",
                "name": "Minney Mouse",
                "sameAs": "https://example.com/user/2"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Example.com",
                "sameAs": "https://example.com/",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://example.com/sites/default/files/logo.png",
                    "width": "600",
                    "height": "60"
                }
            },
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "https://example.com/story/example-story"
            },
        },
    ]
}</script>
</code>
```

### Credits

- The initial development was by [Karen Stevenson](https://www.drupal.org/u/karens).
- Ported for Backdrop CMS by [argiepiano](https://github.com/argiepiano)

### Current maintainers for the Backdrop version

- [argiepiano](https://github.com/argiepiano)
- Seeking co-maintainers

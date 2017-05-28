Schema.org Metatag

This project extends Drupal's Metatag module (https://www.drupal.org/project/metatag) to display Schema.org vocabulary information as JSON LD in the head of web pages.

The Metatag module is used to define and store the values, and to handle token replacements for the values. Metatag module also provides a nice system of overrides, so you can define default values for all content types, override the node defaults for a particular content type, or even override everything else to provide specific values for an individual node.

This module defines metatag groups that map to Schema.org types, and metatag tags for Schema.org items, then steps in before the values are rendered as metatags, pulls the Schema.org values out of the header created by Metatag, and instead renders them as JSON LD when the page is displayed.

For instance, the code in the head might end up looking like this:

<code>
<script type="application/ld+json">{
    "@context": "http://schema.org",
    "@graph": [
        {
            "@type": "Article",
            "description": "Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec sollicitudin molestie malesuada. Donec sollicitudin molestie malesuada. Donec rutrum congue leo eget malesuada. Nulla quis lorem ut libero malesuada feugiat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.",
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

Since the Schema.org list is huge, and growing, this module only provides a small subset of those values. But it is designed to be extensible. There is an included module, Schema.org Article Example, that shows how other modules can add more properties to types that are already defined. Several types are included which can be copied to add new types (groups) with any number of their own properties.

The module includes a base group class and several base tag classes that can be extended. Many properties are simple key/value pairs that require nothing more than extending the base class and giving them their own ids. Some are more complex, like Person and Organization, and BreadcrumbList, and they collect multiple values and serialize the results.

For more information and to test the results:
- https://schema.org/docs/full.html
- https://search.google.com/structured-data/testing-tool

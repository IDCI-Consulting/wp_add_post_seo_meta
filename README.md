Welcome to the *Add post seo meta plugin*
=========================================

What is this seo plugin ?
========================

This plugin allow you to add post meta data on wordpress post to optimize your
wordpress webiste seo :
You can manage the title, meta description and meta keywords by post !

Indeed it is sometimes important to differentiate the content visible to visitors
of content considered by indexing bots in order to highlight certain keywords.

You can also use qTranslate plugin in order to have specific title / metakeywords/
metadescription by language for each post.

Installation requirements
=========================

* Wordpress

Optional dependencies
=====================

* qTranslate plugin

Installation
============

Installation is easy:

1. Upload *add-post-seo-meta* plugin to the */wp-content/plugins/* directory
2. Activate the plugin through the *Plugins* menu in WordPress backend

That's done! Easy, right ?

Configuration
=============

The plugin requires no configuration, it comes turnkey.

Using *Add post seo meta plugin*
================================

After activating the plugin you have now a new administration part in your posts: 
A "SEO Meta" block containing the fields title, meta description and meta keywords.
You have as much input fields as enabled languages in qTranslate.
By default, at least your wordpress language is used.

When you have filled the fields, they are used in the head html code:
* The title is used in <title> tag
* The meta description is used in <meta name="description" /> tag
* The meta keywords are used in <meta name="keywords" /> tag

Keywords must be comma seperated in order to let indexing bot know where
a keyword starts and where it ends.

Licence
=======

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

A copy of the software license is included in the LICENSE file

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

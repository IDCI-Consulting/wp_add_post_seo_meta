=== Plugin Name ===
Contributors: Webokage
Tags: seo, meta
Requires at least: 2.0.2

Add post meta data on wordpress post to optimize your wordpress website seo.

== Description ==

This plugin allow you to add post meta data on wordpress post to optimize your
wordpress webiste seo :
You can manage the title, meta description and meta keywords by post !

Indeed it is sometimes important to differentiate the content visible to visitors
of content considered by indexing bots in order to highlight certain keywords.

You can also use [qTranslate plugin](http://wordpress.org/extend/plugins/qtranslate/)
in order to have specific title / metakeywords/
metadescription by language for each post.

== Installation ==

Installation is easy:

1. Upload *add-post-seo-meta* plugin to the */wp-content/plugins/* directory
2. Activate the plugin through the *Plugins* menu in WordPress backend

That's done! Easy, right ?

== How to use it ? ==

After activating the plugin you have now a new administration part in your posts: 
A "SEO Meta" block containing the fields title, meta description and meta keywords.

![Meta fields without qTranslate](https://github.com/IDCI-Consulting/wp_add_post_seo_meta/raw/master/images/snapshot.png "Meta fields without qTranslate ")

You have as much input fields as enabled languages in qTranslate.
By default, at least your wordpress language is used.

![Meta fields with qTranslate](https://github.com/IDCI-Consulting/wp_add_post_seo_meta/raw/master/images/snapshot2.png "Meta fields with qTranslate")

When you have filled the fields, they are used in the head html code:

* The title is used in &lt;title&gt; tag
* The meta description is used in &lt;meta name="description" /&gt; tag
* The meta keywords are used in &lt;meta name="keywords" /&gt; tag

Keywords must be comma seperated in order to let indexing bot know where
a keyword starts and where it ends.

== Screenshots ==

![Meta fields without qTranslate](https://github.com/IDCI-Consulting/wp_add_post_seo_meta/raw/master/images/snapshot.png "Meta fields without qTranslate ")
![Meta fields with qTranslate](https://github.com/IDCI-Consulting/wp_add_post_seo_meta/raw/master/images/snapshot2.png "Meta fields with qTranslate")

== Changelog ==

= 1.0 =
* A change since the previous version.
* Another change.


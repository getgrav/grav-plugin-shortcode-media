# Grav Shortcode Media Plugin

## About

The **Shortcode Media** plugin provides various media-related shortcodes to embed content.

It currently provides:

* SlideShare

## Installation

Typically a plugin should be installed via [GPM](http://learn.getgrav.org/advanced/grav-gpm) (Grav Package Manager):

```
$ bin/gpm install shortcode-media
```

Alternatively it can be installed via the [Admin Plugin](http://learn.getgrav.org/admin-panel/plugins)

## Configuration Defaults

```
enabled: true
```

## Available Shortcodes

This plugin provides a variety of plugins, each with a specific purpose:

#### SlideShare

An example of the SlideShare shortcode is as follows:

```
[slideshare id="58575464"]
```

Optional parameters let you set a variety of common SlideShare options:

```
[slideshare id="58575464" width="600" height="500" start="2" align="center" class="my-slideshare" style="border:1px solid blue"]
```

| NOTE: this format is compatible with the WordPress shortcode syntax that is available as part of the share option for any slide set.

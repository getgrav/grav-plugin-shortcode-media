# Grav Shortcode Media Plugin

## About

The **Shortcode Media** plugin provides various media-related shortcodes to embed content.

It currently provides:

* IFrame
* PDF
* DocViewer
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
google_viewer: false
```

The `google_viewer` uses the Google Docs "Viewer" to view the PDF rather than letting the browser's built in viewer handle things. THis provides a more consistent viewing experience between browsers and platforms.  However, it only works for externally accessible URLs.

## Available Shortcodes

This plugin provides a variety of shortcodes, each with a specific purpose:

#### IFrame

You can display a specific URL in an iframe:

```
[iframe url="https://getgrav.org" /]
```

You can also provide a specific `width` and `height`:

```
[iframe url="https://getgrav.org" width="800" height="600" /]
```

or full width available:

```
[iframe url="https://getgrav.org" width="100%" height="800" /]
```

also `class`es and `id`s can be set:

```
[iframe url="https://getgrav.org" class="external iframe" id="grav-homepage" /]
```

#### PDF

Very similar to the IFrame shortcode above, you can pass a full URL or a local page media file:

```
[pdf url="https://somesite.com/media/planning-process.pdf" /]
```

local file:

```
[pdf url="planning-process.pdf" /]
```

You can also use `width`, `height`, `class`, and `id` like IFrame shortcode.

To enable to disable the **Google Docs Viewer** you can pass the google param:

```
[pdf url="planning-process.pdf" google="true" /]
```

#### DocViewer

The PDF shortcode is actually very generic and can display any file inline as an iframe (as long as the browser supports it).  But if the browser doesn't support it, Google probably does, so `docviewer` shortcode is an alias:

```
[docviewer url="important-numbers.xls" google="true" /]
```

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

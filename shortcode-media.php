<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;


class ShortcodeMediaPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => [
                ['autoload', 100001],
            ],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'registerNextGenEditorPlugin' => ['registerNextGenEditorPluginShortcodes', 0],
            'onEditorProShortcodeRegister' => ['onEditorProShortcodeRegister', 0],
        ];
    }

    /**
     * [onPluginsInitialized:100000] Composer autoload.
     *
     * @return ClassLoader
     */
    public function autoload()
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Initialize configuration
     */
    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__ . '/classes/shortcodes');
    }

    public function registerNextGenEditorPluginShortcodes($event) {
        $plugins = $event['plugins'];
        $plugins['js'][] = 'plugin://shortcode-media/nextgen-editor/shortcodes/iframe.js';
        $event['plugins']  = $plugins;
        return $event;
    }

    /**
     * Register shortcode definitions for Editor Pro
     */
    public function onEditorProShortcodeRegister(Event $event)
    {
        $shortcodes = $event['shortcodes'];

        $mediaShortcodes = [
            [
                'name' => 'iframe',
                'title' => 'Iframe Embed',
                'description' => 'Embed any URL inside an iframe',
                'type' => 'block',
                'hasContent' => false,
                'category' => 'media',
                'group' => 'Shortcode Media',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2" ry="2"></rect><polyline points="8 8 12 12 8 16"></polyline><line x1="16" y1="12" x2="12" y2="12"></line></svg>',
                'attributes' => [
                    'url' => [
                        'type' => 'string',
                        'default' => '',
                        'required' => true,
                        'description' => 'URL to display inside the iframe'
                    ],
                    'width' => [
                        'type' => 'string',
                        'default' => '640',
                        'required' => false,
                        'description' => 'Iframe width (px or %)'
                    ],
                    'height' => [
                        'type' => 'string',
                        'default' => '480',
                        'required' => false,
                        'description' => 'Iframe height'
                    ],
                    'class' => [
                        'type' => 'string',
                        'default' => '',
                        'required' => false,
                        'description' => 'Custom CSS class'
                    ],
                    'id' => [
                        'type' => 'string',
                        'default' => '',
                        'required' => false,
                        'description' => 'Optional DOM id'
                    ],
                ],
                'titleBarAttributes' => ['url'],
                'cssTemplate' => null,
                'plugin' => 'shortcode-media',
            ],
            [
                'name' => 'pdf',
                'title' => 'PDF Viewer',
                'description' => 'Embed PDFs or other documents with optional Google Viewer',
                'type' => 'block',
                'hasContent' => false,
                'category' => 'media',
                'group' => 'Shortcode Media',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z"></path><path d="M14 2v6h6"></path><path d="M9 13h6"></path><path d="M9 17h6"></path></svg>',
                'attributes' => [
                    'url' => [
                        'type' => 'string',
                        'default' => '',
                        'required' => true,
                        'description' => 'PDF or document URL (supports page media)'
                    ],
                    'width' => [
                        'type' => 'string',
                        'default' => '640',
                        'required' => false,
                    ],
                    'height' => [
                        'type' => 'string',
                        'default' => '480',
                        'required' => false,
                    ],
                    'google' => [
                        'type' => 'select',
                        'options' => ['false', 'true'],
                        'default' => 'false',
                        'required' => false,
                        'description' => 'Force Google Docs Viewer for consistent rendering'
                    ],
                    'class' => [
                        'type' => 'string',
                        'default' => '',
                        'required' => false,
                    ],
                    'id' => [
                        'type' => 'string',
                        'default' => '',
                        'required' => false,
                    ],
                ],
                'titleBarAttributes' => ['url', 'google'],
                'cssTemplate' => null,
                'plugin' => 'shortcode-media',
            ],
            [
                'name' => 'docviewer',
                'title' => 'Document Viewer',
                'description' => 'Convenience alias for PDF shortcode with Google Viewer enabled',
                'type' => 'block',
                'hasContent' => false,
                'category' => 'media',
                'group' => 'Shortcode Media',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2" ry="2"></rect><path d="M7 8h10"></path><path d="M7 12h6"></path><path d="M7 16h4"></path></svg>',
                'attributes' => [
                    'url' => [
                        'type' => 'string',
                        'default' => '',
                        'required' => true,
                    ],
                    'width' => [
                        'type' => 'string',
                        'default' => '640',
                        'required' => false,
                    ],
                    'height' => [
                        'type' => 'string',
                        'default' => '480',
                        'required' => false,
                    ],
                    'google' => [
                        'type' => 'select',
                        'options' => ['false', 'true'],
                        'default' => 'true',
                        'required' => false,
                    ],
                    'class' => [
                        'type' => 'string',
                        'default' => '',
                        'required' => false,
                    ],
                    'id' => [
                        'type' => 'string',
                        'default' => '',
                        'required' => false,
                    ],
                ],
                'titleBarAttributes' => ['url'],
                'cssTemplate' => null,
                'plugin' => 'shortcode-media',
            ],
            [
                'name' => 'slideshare',
                'title' => 'SlideShare Embed',
                'description' => 'Display a SlideShare presentation',
                'type' => 'block',
                'hasContent' => false,
                'category' => 'media',
                'group' => 'Shortcode Media',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2" ry="2"></rect><path d="M7 8h5"></path><path d="M7 12h10"></path><path d="M7 16h8"></path></svg>',
                'attributes' => [
                    'id' => [
                        'type' => 'string',
                        'default' => '',
                        'required' => true,
                        'description' => 'SlideShare presentation ID'
                    ],
                    'align' => [
                        'type' => 'select',
                        'options' => ['left', 'center', 'right'],
                        'default' => 'left',
                        'required' => false,
                    ],
                    'width' => [
                        'type' => 'number',
                        'default' => 597,
                        'required' => false,
                    ],
                    'height' => [
                        'type' => 'number',
                        'default' => 486,
                        'required' => false,
                    ],
                    'start' => [
                        'type' => 'number',
                        'default' => 1,
                        'required' => false,
                        'description' => 'Slide to start from'
                    ],
                    'class' => [
                        'type' => 'string',
                        'default' => '',
                        'required' => false,
                    ],
                    'style' => [
                        'type' => 'string',
                        'default' => 'border:1px solid #CCC; border-width:1px; margin-bottom:5px; max-width: 100%;',
                        'required' => false,
                        'description' => 'Inline styles applied to the container'
                    ],
                ],
                'titleBarAttributes' => ['id', 'align'],
                'cssTemplate' => null,
                'plugin' => 'shortcode-media',
            ],
        ];

        $event['shortcodes'] = array_merge($shortcodes, $mediaShortcodes);

        return $event;
    }
}

<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;


class IframeShortcode extends Shortcode
{
    public function init()
        {
            $this->shortcode->getHandlers()->add('iframe', function(ShortcodeInterface $sc) {

                $url = $sc->getParameter('url', $sc->getBbCode());

                return $this->twig->processTemplate('shortcodes/media-iframe.html.twig', [
                    'url'       => $url,
                    'id'        => $sc->getParameter('id'),
                    'class'     => $sc->getParameter('class', false),
                    'width'     => $sc->getParameter('width', 640),
                    'height'    => $sc->getParameter('height', 480),
                ]);
            });

            $this->shortcode->getHandlers()->add('pdf', function(ShortcodeInterface $sc) {

                $google_default = $this->grav['config']->get('plugins.shortcode-media.google_viewer', false);
                $use_google = $sc->getParameter('google', $google_default);
                $url = $sc->getParameter('url', $sc->getBbCode());
                $page_media = $this->grav['page']->media();

                if (isset($page_media[$url])) {
                    $url = $page_media[$url]->url();
                }

                if ($use_google) {
                    $url = 'https://docs.google.com/gview?url='.Utils::url($url, true).'&embedded=true';
                }

                return $this->twig->processTemplate('shortcodes/media-iframe.html.twig', [
                    'url'       => $url,
                    'id'        => $sc->getParameter('id'),
                    'class'     => $sc->getParameter('class', false),
                    'width'     => $sc->getParameter('width', 640),
                    'height'    => $sc->getParameter('height', 480),
                ]);
            });

            $this->shortcode->getHandlers()->addAlias('docviewer', 'pdf');
        }
}
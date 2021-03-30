<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;


class SlideshareShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('slideshare', function(ShortcodeInterface $sc) {

            $output = $this->twig->processTemplate('shortcodes/media-slideshare.html.twig', [
                'id'        => $sc->getParameter('id'),
                'align'     => $sc->getParameter('align', 'left'),
                'width'     => $sc->getParameter('width', 597),
                'height'    => $sc->getParameter('height', 486),
                'start'     => $sc->getParameter('start', 1),
                'class'     => $sc->getParameter('class', false),
                'style'     => $sc->getParameter('style', 'border:1px solid #CCC; border-width:1px; margin-bottom:5px; max-width: 100%;'),
                'shortcode' => $sc,
            ]);

            return $output;
        });
    }
}
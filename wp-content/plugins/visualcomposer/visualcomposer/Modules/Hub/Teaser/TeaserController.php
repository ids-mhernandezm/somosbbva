<?php

namespace VisualComposer\Modules\Hub\Teaser;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use VisualComposer\Framework\Container;
use VisualComposer\Framework\Illuminate\Support\Module;
use VisualComposer\Helpers\License;
use VisualComposer\Helpers\Options;
use VisualComposer\Helpers\Traits\EventsFilters;

class TeaserController extends Container implements Module
{
    use EventsFilters;

    public function __construct()
    {
        if (vcvenv('VCV_ENV_HUB_TEASER')) {
            $this->addFilter('vcv:frontend:head:extraOutput vcv:backend:extraOutput', 'outputTeaserElements');
            $this->addFilter('vcv:frontend:head:extraOutput vcv:backend:extraOutput', 'outputTeaserBadge');
            $this->addFilter('vcv:ajax:vcv:hub:teaser:visit:adminNonce', 'ajaxSetTeaserBadge');

            if (vcvenv('VCV_HUB_DOWNLOAD_SINGLE_ELEMENT')) {
                $this->addFilter('vcv:frontend:head:extraOutput vcv:backend:extraOutput', 'outputTeaserDownload');
            }
        }
    }

    protected function outputTeaserElements($response, $payload, Options $optionsHelper)
    {
        $value = array_values(
            (array)$optionsHelper->get(
                'hubTeaserElements',
                [
                    'All Elements' => [
                        'id' => 'AllElements0',
                        'index' => 0,
                        'title' => 'All Elements',
                        'elements' => [],
                    ],
                ]
            )
        );

        return array_merge(
            $response,
            [
                vcview(
                    'partials/constant-script',
                    [
                        'key' => 'VCV_HUB_GET_TEASER',
                        'value' => $value,
                    ]
                ),
            ]
        );
    }

    protected function outputTeaserBadge($response, $payload, Options $optionsHelper)
    {
        return array_merge(
            $response,
            [
                vcview(
                    'partials/variable',
                    [
                        'key' => 'vcvHubTeaserShowBadge',
                        'value' => version_compare(
                            $optionsHelper->getUser('hubTeaserVisit'),
                            $optionsHelper->get('hubAction:hubTeaser', '1.0'),
                            '<'
                        ),
                    ]
                ),
            ]
        );
    }

    protected function ajaxSetTeaserBadge(Options $optionsHelper)
    {
        $optionsHelper->setUser('hubTeaserVisit', $optionsHelper->get('hubAction:hubTeaser'));

        return true;
    }

    protected function outputTeaserDownload($response, $payload, License $licenseHelper)
    {
        return array_merge(
            $response,
            [
                vcview(
                    'partials/constant-script',
                    [
                        'key' => 'VCV_HUB_ALLOW_DOWNLOAD',
                        'value' => $licenseHelper->isActivated(),
                    ]
                ),
            ]
        );
    }
}

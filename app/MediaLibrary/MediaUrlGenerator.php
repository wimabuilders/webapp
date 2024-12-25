<?php

namespace App\MediaLibrary;

use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

class MediaUrlGenerator extends DefaultUrlGenerator
{
    public function getUrl(): string
    {
        $url = $this->getDisk()->url($this->getPathRelativeToRoot());

        $versionUrl = $this->versionUrl($url);
        parse_str(parse_url($versionUrl, PHP_URL_QUERY) ?? '', $query);
        $query['wrap'] = 0;

        return strtok($versionUrl, '?') . '?' . http_build_query($query);
    }
}

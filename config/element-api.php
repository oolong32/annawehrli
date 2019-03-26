<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        'wehrli.json' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'projects'],
                'transformer' => function(Entry $entry) {
                    $images = [];
                    foreach ($entry->images->all() as $image) {
                      $images[] = $image->url;
                    }
                    return [
                        'title' => $entry->title,
                        'url' => $entry->url,
                        'jsonUrl' => UrlHelper::url("projects/{$entry->id}.json"),
                        'description' => $entry->description,
                        'images' => $images,
                    ];
                },
            ];
        },
        'projects/<entryId:\d+>.json' => function($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'transformer' => function(Entry $entry) {
                    $images = [];
                    foreach ($entry->images->all() as $image) {
                      $images[] = $image->url;
                    }
                    return [
                        'title' => $entry->title,
                        'url' => $entry->url,
                        'description' => $entry->description,
                        'images' => $images
                        /* 'images' => function(Image $image) { */
                        /*   return  [ */
                        /*     'imageUrl' => $image->url, */
                        /*   ]; */
                        /* }, */
                    ];
                },
            ];
        },
    ]
];

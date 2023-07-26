<?php

namespace App\Enums;

enum DefaultPurposesEnum
{
    public const STANDARD_PURPOSES_SATISFACTION =
        [
            'most_satisfied' => ['label' => 'Très satisfait(e)', 'icon' => 'icon-fontawesome.svgs.regular.face-laugh-beam','satisfied' => true, 'order' => 0 ],
            'satisfied' => ['label' => 'Satisfait(e)', 'icon' => 'icon-fontawesome.svgs.regular.face-smile','satisfied' => true, 'order' => 1 ],
            'not_satisfied' => ['label' => 'Peu satisfait(e)', 'icon' => 'icon-fontawesome.svgs.regular.face-meh','satisfied' => false, 'order' => 2 ],
            'angry' => ['label' => 'Insatisfait(e)', 'icon' => 'icon-fontawesome.svgs.regular.face-frown','satisfied' => false, 'order' => 3 ],
        ];

    public const STANDARD_PURPOSES_CHANGED_MIND =
        [
            'yes_really' => ['label' => 'Oui vraiment', 'icon' => 'icon-fontawesome.svgs.regular.face-laugh-beam','satisfied' => true, 'order' => 0 ],
            'a_few' => ['label' => 'Un peu', 'icon' => 'icon-fontawesome.svgs.regular.face-smile','satisfied' => true, 'order' => 1 ],
            'not_really' => ['label' => 'Pas vraiment', 'icon' => 'icon-fontawesome.svgs.regular.face-meh','satisfied' => false, 'order' => 2 ],
            'no' => ['label' => 'Pas du tout', 'icon' => 'icon-fontawesome.svgs.regular.face-frown','satisfied' => false, 'order' => 3 ],
        ];

    public const OPEN_LAST_QUESTION_PURPOSES =
        [
            'grateful' => [ 'label' => 'Reconnaissant(e)' , 'icon' => 'icon-fontawesome.svgs.regular.face-grin-stars', 'satisfied' => false, 'order' => 0 ],
            'reassured' => ['label' => 'Rassuré(e)' , 'icon' => 'icon-fontawesome.svgs.solid.face-smile-beam', 'satisfied' => false  , 'order' => 1],
            'surprised' => ['label' => 'Surpris(e)' , 'icon' => 'icon-fontawesome.svgs.regular.face-surprise', 'satisfied' => false , 'order' => 2],
            'annoyed' => ['label' => 'Agacé(é)' , 'icon' => 'icon-fontawesome.svgs.regular.face-angry', 'satisfied' => false , 'order' => 3],
            'worried' => ['label' => 'Inquiet(e)' , 'icon' => 'icon-fontawesome.svgs.regular.face-grimace', 'satisfied' => false , 'order' => 4],
            'uncomfortable' => ['label' => 'Gêné(e)' , 'icon' => 'icon-fontawesome.svgs.regular.face-flushed', 'satisfied' => false , 'order' => 5],
        ];
    public const SMILEYS = [
        'icon-fontawesome.svgs.regular.face-laugh-beam',
        'icon-fontawesome.svgs.regular.face-smile',
        'icon-fontawesome.svgs.regular.face-meh',
        'icon-fontawesome.svgs.regular.face-frown'
    ];
    public const STANDARD_PURPOSES  =
        [
            'Très satisfait(e)',
            'Satisfait(e)',
            'Peu satisfait(e)',
            'Insatisfait(e)',
        ];

    public const STANDARD_PURPOSES2  =
        [
            'Très utile',
            'Utile',
            'Peu utile',
            'Inutile',
        ];

    public const STANDARD_PURPOSES3  =
        [
            'Oui',
            'Non',
        ];
}





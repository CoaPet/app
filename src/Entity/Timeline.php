<?php

namespace App\Entity;

class Timeline
{
    const WHOIAM = [
        'ÉTAPE 1'=> [
            'etape' => 'étape 1',
            'picto' => 'phone.svg',
            'title' => 'PREMIER CONTACT',
            'undertitle' => 'par téléphone ou via le formulaire de contact',
            'text' => 'Laissez-moi un message avec vos informations et vos attentes, je vous réponds au plus vite.'
        ],
        'ÉTAPE 2'=> [
            'etape' => 'étape 2',
            'picto' => 'phone.svg',
            'title' => 'PRISE DE RDV',
            'undertitle' => 'par téléphone ou via le formulaire de contact',
            'text' => 'Laissez-moi un message avec vos informations et vos attentes, je vous réponds au plus vite.'
        ],
        'ÉTAPE 3'=> [
            'etape' => 'étape 3',
            'picto' => 'phone.svg',
            'title' => '1ER BILAN',
            'undertitle' => 'par téléphone ou via le formulaire de contact',
            'text' => 'Laissez-moi un message avec vos informations et vos attentes, je vous réponds au plus vite.'
        ],
        'ÉTAPE 4'=> [
            'etape' => 'étape 4',
            'picto' => 'phone.svg',
            'title' => '1ÈRE SÉANCE',
            'undertitle' => 'par téléphone ou via le formulaire de contact',
            'text' => 'Laissez-moi un message avec vos informations et vos attentes, je vous réponds au plus vite.'
        ],
    ];

    const COACHING = [
        'ÉTAPE 1'=> [
            'etape' => 'étape 1',
            'picto' => 'phone.svg',
            'title' => '1er mois',
            'undertitle' => 'Démarrage',
            'text' => 'Languentibus partium animis, quas periculorum varietas fregerat et laborum, nondum.'
        ],
        'ÉTAPE 2'=> [
            'etape' => 'étape 2',
            'picto' => 'phone.svg',
            'title' => '3 mois',
            'undertitle' => 'Condition physique, posture, 1er résultats',
            'text' => 'Languentibus partium animis, quas periculorum varietas fregerat et laborum, locat.'
        ],
        'ÉTAPE 3'=> [
            'etape' => 'étape 3',
            'picto' => 'phone.svg',
            'title' => '6 mois',
            'undertitle' => 'Amélioration des compétences physiques',
            'text' => 'Languentibus partium animis, quas periculorum varietas fregerat et laborum, nondum.'
        ],
        'ÉTAPE 4'=> [
            'etape' => 'étape 4',
            'picto' => 'phone.svg',
            'title' => '12 mois',
            'undertitle' => 'Stabilité du poids',
            'text' => 'Languentibus partium animis, quas periculorum varietas fregerat et laborum, nondum.'
        ],
    ];
}

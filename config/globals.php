<?php
return [

    'classSpec' => [
        'Death Knight' => ['Any','Blood','Frost','Unholy'],
        'Demon Hunter' => ['Any','Havoc','Vengeance'],
        'Druid' => ['Any','Balance','Feral','Guardian', 'Restoration'],
        'Hunter' => ['Any','Beast Mastery','Marskmanship','Survival'],
        'Mage' => ['Any','Arcane','Fire','Frost'],
        'Monk' => ['Any','Brewmaster','Mistweaver','Windwalker'],
        'Paladin' => ['Any','Holy','Protection','Retribution'],
        'Priest' => ['Any','Discipline','Holy','Shadow'],
        'Rogue' => ['Any','Assassination','Outlaw','Subtlety'],
        'Shaman' => ['Any','Elemental','Enhancement','Restoration'],
        'Warlock' => ['Any','Affliction','Demonology','Destruction'],
        'Warrior' => ['Any','Arms','Fury','Protection'],
    ],

    'arrayProducts' => [
        'ULDR' => 'Uldir',
        'MODG' => 'Mythic Dungeon',
        'MPDG' => 'Mythic Plus Dungeon',
        'ISXP' => 'Island Expedition',
    ],

    'arrayDifficulties' => [
        'NM' => 'Normal',
        'HC' => 'Heroic',
        'MY' => 'Mythic',

    ],

    'eventDifficulty'=> [
        'Uldir'                => ['Select...','Normal', 'Heroic', 'Mythic'],
        'Mythic Dungeon'       => [0],
        'Mythic Plus Dungeon'  => ['Select...',0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30],
        'Island Expedition'    => ['Select...','Normal', 'Heroic', 'Mythic'],
    ],

    'arrayStatuses' => [
        0 => "Open",
        1 => "Full",
        2 => "Overbooked",
        3 => "In Progress",
        4 => "Completed",
        5 => "Pending Att.",
        6 => "Archived",
    ],

    'eventStatuses' => [
        'Signed'   => 'Signed',
        'Accepted' => 'Accepted',
        'Declined' => 'Declined',
        'Backup'   => 'Backup'],

    'managers' => 'Manager',

    'executives' => 'Manager|Admin',

    'accountants' => 'Manager|Admin|Accountant|Secretary|Collector',

    'members' => 'Manager|Admin|Accountant|Secretary|Collector|Member'

];
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
        0 => 0,
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        9 => 9,
        10 => 10,
        11 => 11,
        12 => 12,
        13 => 13,
        14 => 14,
        15 => 15,
        16 => 16,
        17 => 17,
        18 => 18,
        19 => 19,
        20 => 20,
        21 => 21,
        22 => 22,
        23 => 23,
        25 => 24,
        25 => 25,
        26 => 26,
        27 => 27,
        28 => 28,
        29 => 29,
        30 => 30,
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

    'eventProgress' => [
        0 => 'Open',
        1 => 'In Progress',
        2 => 'Attendance Ready',
        3 => 'Closed',
        4 => 'Placeholder',
        5 => 'Placeholder',
    ],

    'eventStatuses' => [
        'Signed'   => 'Signed',
        'Accepted' => 'Accepted',
        'Declined' => 'Declined',
        'Backup'   => 'Backup'],

    'attendanceStatuses' => [
        '1' => 'Attended',
        '2' => 'Partial',
    ],

    'goldtrackStatuses' => [
        0 => null,
        1 => 'Placeholder 1',
        2 => 'Placeholder 2',
        3 => 'Placeholder 3',
        4 => 'Placeholder 4',
        5 => 'Placeholder 5',
    ],

    'operationsTransaction' => [
        1 => '(001) Collector Deposit',
        2 => '(002) Withdrawal',
        3 => '(003) Booster Payment',
        4 => '(004) Booster Token Payment',
        5 => '(005) Gold Trade',
        6 => '(006) Uncollected Fee',
        7 => '(007) Guild Bank Transfer',
    ],

    'managers' => 'Manager',

    'executives' => 'Manager|Admin',

    'teamleaders' => 'Manager|Admin|TeamLeader',

    'accountants' => 'Manager|Admin|Accountant|Secretary|',

    'advertisers' => 'Manager|Admin|Accountant|Secretary|Advertiser',

    'collectors' => 'Manager|Admin|Accountant|Secretary|TeamLeader|Advertiser|Collector',

    'members' => 'Manager|Admin|Accountant|Secretary|Collector|Member'

];
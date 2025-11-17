<?php

return [

    'lucky_bracelet' => [
        'label' => 'Lucky Bracelet Calculator',
        'fields' => [
            ['name' => 'name', 'label' => 'Full Name', 'type' => 'text', 'required' => true],
            ['name' => 'dob', 'label' => 'Date of Birth', 'type' => 'date', 'required' => true],
            ['name' => 'gender', 'label' => 'Gender', 'type' => 'select', 'options' => ['Male', 'Female', 'Other'], 'required' => true],
        ],
        'description' => 'Calculates your lucky bracelet stone or metal based on numerology.',
    ],

    'lucky_rudraksha' => [
        'label' => 'Lucky Rudraksha Calculator',
        'fields' => [
            ['name' => 'name', 'label' => 'Full Name', 'type' => 'text', 'required' => true],
            ['name' => 'dob', 'label' => 'Date of Birth', 'type' => 'date', 'required' => true],
        ],
        'description' => 'Determines your most suitable Rudraksha bead based on birth details.',
    ],

    'lucky_date' => [
        'label' => 'Lucky Date Calculator',
        'fields' => [
            ['name' => 'name', 'label' => 'Full Name', 'type' => 'text', 'required' => true],
            ['name' => 'dob', 'label' => 'Date of Birth', 'type' => 'date', 'required' => true],
            ['name' => 'month', 'label' => 'Month to Check', 'type' => 'month', 'required' => true],
        ],
        'description' => 'Finds your luckiest dates for a given month or year.',
    ],

    'lucky_vehicle_number' => [
        'label' => 'Lucky Vehicle Number Calculator',
        'fields' => [
            ['name' => 'vehicle_number', 'label' => 'Vehicle Number', 'type' => 'text', 'required' => true],
            ['name' => 'dob', 'label' => 'Date of Birth', 'type' => 'date', 'required' => true],
        ],
        'description' => 'Checks if your vehicle number aligns with your numerological number.',
    ],

    'numerology_personal_year' => [
        'label' => 'Numerology Personal Year Calculator',
        'fields' => [
            ['name' => 'dob', 'label' => 'Date of Birth', 'type' => 'date', 'required' => true],
            ['name' => 'year', 'label' => 'Year to Check', 'type' => 'number', 'required' => true],
        ],
        'description' => 'Calculates your personal numerology year and its meaning.',
    ],

    'numerology_lucky_colour' => [
        'label' => 'Numerology Lucky Colour Calculator',
        'fields' => [
            ['name' => 'name', 'label' => 'Full Name', 'type' => 'text', 'required' => true],
            ['name' => 'dob', 'label' => 'Date of Birth', 'type' => 'date', 'required' => true],
        ],
        'description' => 'Finds your most auspicious colour for energy and balance.',
    ],

    'numerology_origin_master' => [
        'label' => 'Numerology Origin Master Calculator',
        'fields' => [
            ['name' => 'name', 'label' => 'Full Name', 'type' => 'text', 'required' => true],
            ['name' => 'dob', 'label' => 'Date of Birth', 'type' => 'date', 'required' => true],
        ],
        'description' => 'Determines your origin and master number in numerology.',
    ],

    'unlucky_date' => [
        'label' => 'Unlucky Date Calculator',
        'fields' => [
            ['name' => 'name', 'label' => 'Full Name', 'type' => 'text', 'required' => true],
            ['name' => 'dob', 'label' => 'Date of Birth', 'type' => 'date', 'required' => true],
        ],
        'description' => 'Identifies your least favorable dates according to numerology.',
    ],

];

<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'customers'=> 'c,r,u,d',
            'customerTo'=> 'c,r,u,d',    
            'local'=> 'c,r,u,d',
            'state'=> 'c,r,u,d',
            'lawyers'=> 'c,r,u,d',
            'work'=> 'c,r,u,d',
            'cause_lawsuit'=> 'c,r,u,d',
            'subject_consult'=> 'c,r,u,d',
            'prose_text'=> 'c,r,u,d',
            'courts'=> 'c,r,u,d',
            'contract_subject'=> 'c,r,u,d',
            'claimants_works'=> 'c,r,u,d',
            'administrative_unit'=> 'c,r,u,d',
            'witness','clients'=> 'c,r,u,d',
            'judges','clientsTo'=> 'c,r,u,d',
            'prosecution'=> 'c,r,u,d',
            'sessions'=> 'c,r,u,d',
            'sessions_witness'=> 'c,r,u,d',
            'appeal'=> 'c,r,u,d',
            'consults'=> 'c,r,u,d',
            'contract'=> 'c,r,u,d',
            'authorization'=> 'c,r,u,d',
            'address'=> 'c,r,u,d',
            'messages'=> 'c,r,u,d',
            'subject_authorization'=> 'c,r,u,d',
        ],

        'admin' => []
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];

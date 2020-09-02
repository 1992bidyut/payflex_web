<?php
/**
 * Created by PhpStorm.
 * User: Sanker Saha
 * Date: 29-01-2017
 * Time: 12:59 PM
 */
$config = [
    'userStoreRules' => [
        [
            'field' => 'fullUserName',
            'label' => 'Full Name',
            'rules' => 'required|max_length[250]|trim'
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|max_length[250]|trim|is_unique[cd_user.username]'
        ],
        [
            'field' => 'contact',
            'label' => 'Contact Number',
            'rules' => 'required|max_length[14]|trim'
        ],
//            [
//                'field'=>'userName',
//                'label'=>'User Name',
//                'rules'=>'required|valid_email|max_length[150]|trim|is_unique[cd_user.username]'
//            ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|max_length[250]|trim'
        ],
        [
            'field' => 'confirmPassword',
            'label' => 'Confirm Password',
            'rules' => 'required|matches[password]|max_length[250]|trim'
        ],
        [
            'field' => 'userRoleId',
            'label' => 'User Access',
            'rules' => 'required|max_length[250]|trim'
        ]


    ],
    'updatePassword' => [
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|max_length[250]|trim'
        ],
        [
            'field' => 'confirmPassword',
            'label' => 'Confirm Password',
            'rules' => 'required|matches[password]|max_length[250]|trim'
        ]
    ],
    'updateUser' => [
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim'
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'max_length[250]|trim'

        ],
        [
            'field' => 'confirmPassword',
            'label' => 'Confirm Password',
            'rules' => 'matches[password]|max_length[250]|trim'
        ]
    ],
    'login' => [
        [
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|trim'
        ]
    ],
    'maskStoreRules' => [
        [
            'field' => 'mask',
            'label' => 'Mask',
            'rules' => 'required|max_length[11]|trim'
        ]
    ],
    'routeStore' => [
        [
            'field' => 'routeName',
            'label' => 'Route Name',
            'rules' => 'required|max_length[100]|trim'
        ],
        [
            'field' => 'routeDescription',
            'label' => 'Route Description',
            'rules' => 'required|max_length[100]|trim'
        ],
        [
            'field' => 'routeIdentity',
            'label' => 'Route Identity',
            'rules' => 'required|is_natural|max_length[7]|trim'
        ]
    ],
    'operatorStore' => [
        [
            'field' => 'operatorName',
            'label' => 'Operator Name',
            'rules' => 'required|max_length[100]|trim'
        ],
        [
            'field' => 'operatorDescription',
            'label' => 'Operator Description',
            'rules' => 'required|max_length[100]|trim'
        ],
        [
            'field' => 'operatorIdentity',
            'label' => 'Operator Identity',
            'rules' => 'required|is_natural|max_length[7]|trim'
        ]
    ],
    'operatorRouteStore' => [
        [
            'field' => 'operatorID',
            'label' => 'Operator Name',
            'rules' => 'required|trim|is_natural'
        ],
        [
            'field' => 'routeID',
            'label' => 'Route Name',
            'rules' => 'required|trim|is_natural'
        ],
        [
            'field' => 'standardPrice',
            'label' => 'Standard Price',
            'rules' => 'required|trim'
        ]
    ],
    'routeAssignToUser' => [
        [
            'field' => 'newPrice',
            'label' => 'Route Price',
            'rules' => 'required|trim'
        ]
//            ,
//                [
//                    'field'=>'operatorRouteID',
//                    'label'=>'Operator Route ID',
//                    'rules'=>'is_unique[operator_user.operator_route_id]'
//                ]
    ],
    'sendSMSFromPanel' => [
        [
            'field' => 'contact',
            'label' => 'Mobile Number',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'message',
            'label' => 'Message body',
            'rules' => 'required|trim'
        ]
    ],
    'createClient'=>[
        [
            'field' => 'name',
            'label' => 'Distributor Name',
            'rules' => 'required'
        ],
        [
            'field' => 'representative_name',
            'label' => 'Representative Name',
            'rules' => 'required'
        ],
        [
            'field' => 'client_code',
            'label' => 'Client Code',
            'rules' => 'required'
        ],
        [
            'field' => 'virtual_account_code',
            'label' => 'Virtual A/C no.',
            'rules' => 'required'
        ]
//        ,
//        [
//            'field' => 'username',
//            'label' => 'Username',
//            'rules' => 'required'
//        ],
//        [
//            'field' => 'password',
//            'label' => 'Password',
//            'rules' => 'required|min_length[3]'
//        ],
//        [
//            'field' => 'confirm_password',
//            'label' => 'Confirm Password',
//            'rules' => 'required|matches[password]'
//        ],
//        [
//            'field' => 'contact_value_1',
//            'label' => 'Contact Value',
//            'rules' => 'required'
//        ]

    ],
    'contactValue'=>[
        [
            'field' => 'contact_value_1',
            'label' => 'Contact Value',
            'rules' => 'required'
        ]
    ]

];

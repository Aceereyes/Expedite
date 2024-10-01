<?php
    $_CONFIG['sidebar'] = [

        //Dashboard
        [
            'title' => 'Dashboard', 
            'icon' => 'ti ti-home-2', 
            'route' => 'admin_dashboard.php', 
            'access' => true 
        ],

        [
            'title' => 'Users', 
            'icon' => 'ti ti-friends', 
            'route' => 'admin_users.php', 
            'access' => true 
        ],

    
        [
            'title' => 'HR - External', 
            'icon' => 'ti ti-arrow-up-right', 
            'route' => '#', 
            'access' => admin()->accessAll() || admin()->isHRM(), 
            'submenu' => [
                [
                    'title' => 'Interview Scheduling',
                    'route' => 'admin_hr_partners.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],

                [
                    'title' => 'Rejections and Teminations',
                    'route' => 'admin_hr_terminations.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],

                [
                    'title' => 'Placements',
                    'route' => 'admin_hr_partners.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],


                [
                    'title' => 'Payroll and Time Keeping', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],

                [
                    'title' => 'Mail', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
                [
                    'title' => 'Inbox', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],

            ]
        ],


        [
            'title' => 'HR - Internal', 
            'icon' => 'ti ti-arrow-down-left', 
            'route' => '#', 
            'access' => admin()->accessAll() || admin()->isHRM(), 
            'submenu' => [
                [
                    'title' => 'Employees',
                    'route' => 'admin_hr_employees.php',
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
                [
                    'title' => 'Career Opportunities',
                    'route' => 'admin_hr_careers.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
                [
                    'title' => 'Attendance',
                    'route' => 'admin_hr_attendances.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
                [
                    'title' => 'Payroll', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
                [
                    'title' => 'Mail', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
                [
                    'title' => 'Inbox', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],

            ]
        ],
        

        [
            'title' => 'Marketing And Advetising', 
            'icon' => 'ti ti-mood-check', 
            'route' => '#', 
            'access' => admin()->accessAll() || admin()->isCRM(),
            'submenu' => [
                [
                    'title' => 'Email Marketing', 
                    'route' => 'admin_crm_email_marketing.php', 
                    'access' => admin()->accessAll() || admin()->isCRM()
                ],
                [
                    'title' => 'FAQs', 
                    'route' => 'admin_crm_faqs.php', 
                    'access' => admin()->accessAll() || admin()->isCRM()
                ],
                [
                    'title' => 'Contact Us Messages', 
                    'route' => 'admin_crm_messages.php', 
                    'access' => admin()->accessAll() || admin()->isCRM()
                ],
                [
                    'title' => 'Social Media', 
                    'route' => 'admin_crm_socialmedia.php', 
                    'access' => admin()->accessAll() || admin()->isCRM()
                ],
                [
                    'title' => 'Survey', 
                    'route' => 'javascript:Swal.fire(\'Coming Soon\');', 
                    'access' => admin()->accessAll() || admin()->isCRM()
                ],

                [
                    'title' => 'Mail', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
                [
                    'title' => 'Inbox', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
            ],
        ],
        

        [
            'title' => 'Accounting and Finance', 
            'icon' => 'ti ti-coins', 
            'route' => '#', 
            'access' => admin()->accessAll() || admin()->isFRM(),
            'submenu' => [
                [
                    'title' => 'Funds', 
                    'route' => 'javascript:Swal.fire(\'Coming Soon\');', 
                    'access' => admin()->accessAll() || admin()->isFRM()
                ],
                [
                    'title' => 'Receivables', 
                    'route' => 'admin_frm_receivables.php', 
                    'access' => admin()->accessAll() || admin()->isFRM()
                ],
                [
                    'title' => 'Purchasing', 
                    'route' => 'javascript:Swal.fire(\'Coming Soon\');', 
                    'access' => admin()->accessAll() || admin()->isFRM()
                ],
                [
                    'title' => 'Taxation', 
                    'route' => 'javascript:Swal.fire(\'Coming Soon\');', 
                    'access' => admin()->accessAll() || admin()->isFRM()
                ],

                [
                    'title' => 'Mail', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
                [
                    'title' => 'Inbox', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
            ],
        ],

        [
            'title' => 'Checker', 
            'icon' => 'ti ti-check', 
            'route' => '#', 
            'access' => admin()->accessAll() || admin()->isChecker(),
            'submenu' => [
                
                ['title' => 'Submissions', 'route' => 'javascript:Swal.fire(\'Coming Soon\');', 'access' => admin()->accessAll() || admin()->isChecker()],
                [
                    'title' => 'Mail', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
                [
                    'title' => 'Inbox', 
                    'route' => 'admin_hr_payroll.php', 
                    'access' => admin()->accessAll() || admin()->isHRM()
                ],
            ],
            
        ],
        [
            'title' => 'Mail', 
            'icon' => 'ti ti-mail', 
            'route' => 'admin_mail.php', 
            'access' => admin()->accessAll()
        ],
        [
            'title' => 'Inbox', 
            'icon' => 'ti ti-inbox', 
            'route' => 'admin_inbox.php', 
            'access' => admin()->accessAll()
        ],

        [
            'title' => 'Admins', 
            'icon' => 'ti ti-users', 
            'route' => 'admin_accounts.php', 
            'access' => admin()->accessAll()
        ],

        [
            'title' => 'Profile', 
            'icon' => 'ti ti-user', 
            'route' => 'admin_profile.php', 
            'access' => admin()->accessAll(),
        ],

        [
            'title' => 'Settings', 
            'icon' => 'ti ti-settings', 
            'route' => 'admin_settings.php', 
            'access' => admin()->accessAll(),
        ],
    ];

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->first_name . " " . Yii::$app->user->identity->last_name ; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?php if (Yii::$app->user->identity->admin_type=="Admin") { ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    //['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],

                    [
                        'label' => 'Admin Master',
                        'icon' => 'fa fa-graduation-cap',
                        'url' => '#',
                        'items' => [                               
                            ['label' => 'Manage Admins/Subadmins', 'icon' => 'fa fa-graduation-cap', 'url' => ['/adminsubadmin/adminsubadmin'],],
                        ],
                    ],

                    ['label' => 'Manage Countries', 'icon' => 'fa fa-circle', 'url' => ['/countries/countries']],
                    ['label' => 'Manage Style', 'icon' => 'fa fa-circle', 'url' => ['/style/style']],
                    ['label' => 'Manage Occasion', 'icon' => 'fa fa-circle', 'url' => ['/occasion/occasion']],
                    ['label' => 'Manage Brand', 'icon' => 'fa fa-circle', 'url' => ['/brand/brand']],
                    ['label' => 'Manage Size', 'icon' => 'fa fa-circle', 'url' => ['/size/size']],
                    ['label' => 'Manage Colors', 'icon' => 'fa fa-circle', 'url' => ['/colors/colors']],
                    ['label' => 'Manage Category', 'icon' => 'fa fa-circle', 'url' => ['/category/category']],
                    ['label' => 'Manage Subcategory', 'icon' => 'fa fa-circle', 'url' => ['/subcategory/subcategory']],
                    ['label' => 'Manage Banner', 'icon' => 'fa fa-circle', 'url' => ['/banner/banner']],
                    ['label' => 'Manage CMS Pages', 'icon' => 'fa fa-circle', 'url' => ['/cms/cms']],
                    ['label' => 'Manage New Fasion', 'icon' => 'fa fa-circle', 'url' => ['/newsfashion/newsfashion']],
                    ['label' => 'Manage Users', 'icon' => 'fa fa-circle', 'url' => ['/user/user']],
                    


                    [
                        'label' => 'Settings',
                        'icon' => 'fa fa-cogs',
                        'url' => '#',
                        'items' => [
                                [
                                   'label' => 'Access Role Setting',
                                   'icon' => 'fa fa-cog',
                                   'url' => '#',
                                   'items' => [ 
                                        ['label' => 'Manage Roles','icon' => 'fa fa-circle','url' => ['/rbac/role'],],
                                        ['label' => 'Manage Permissions','icon' => 'fa fa-circle','url' => ['/rbac/permission'],],
                                        ['label' => 'Assign Access','icon' => 'fa fa-circle','url' => ['/rbac/assignment'],],
                                   ],
                                ],
                            ],
                    ],

                    //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    // [
                    //     'label' => 'Same tools',
                    //     'icon' => 'share',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    //         ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    //         [
                    //             'label' => 'Level One',
                    //             'icon' => 'circle-o',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    //                 [
                    //                     'label' => 'Level Two',
                    //                     'icon' => 'circle-o',
                    //                     'url' => '#',
                    //                     'items' => [
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                     ],
                    //                 ],
                    //             ],
                    //         ],
                    //     ],
                    // ],
                ],
            ]
        ) ?>
    
    <?php } ?>

    </section>

</aside>

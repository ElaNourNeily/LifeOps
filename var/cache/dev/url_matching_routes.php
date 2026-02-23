<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin' => [[['_route' => 'app_admin_dashboard', '_controller' => 'App\\Controller\\Admin\\AdminDashboardController::index'], null, null, null, false, false, null]],
        '/admin/users' => [[['_route' => 'app_admin_users', '_controller' => 'App\\Controller\\Admin\\AdminModuleController::users'], null, null, null, false, false, null]],
        '/admin/feedback' => [[['_route' => 'app_admin_feedback', '_controller' => 'App\\Controller\\Admin\\AdminModuleController::feedback'], null, null, null, false, false, null]],
        '/admin/sante' => [[['_route' => 'app_admin_sante', '_controller' => 'App\\Controller\\Admin\\AdminModuleController::sante'], null, null, null, false, false, null]],
        '/admin/finances' => [[['_route' => 'app_admin_finances', '_controller' => 'App\\Controller\\Admin\\AdminModuleController::finances'], null, null, null, false, false, null]],
        '/admin/temps' => [[['_route' => 'app_admin_temps', '_controller' => 'App\\Controller\\Admin\\AdminModuleController::temps'], null, null, null, false, false, null]],
        '/admin/taches' => [[['_route' => 'app_admin_taches', '_controller' => 'App\\Controller\\Admin\\AdminModuleController::taches'], null, null, null, false, false, null]],
        '/admin/objectifs' => [[['_route' => 'app_admin_objectifs', '_controller' => 'App\\Controller\\Admin\\AdminModuleController::objectifs'], null, null, null, false, false, null]],
        '/dashboard' => [[['_route' => 'app_dashboard', '_controller' => 'App\\Controller\\Other\\DashboardController::index'], null, null, null, false, false, null]],
        '/finance' => [[['_route' => 'app_finance_index', '_controller' => 'App\\Controller\\Other\\FinanceController::index'], null, ['GET' => 0], null, true, false, null]],
        '/finance/budget/new' => [[['_route' => 'app_budget_new', '_controller' => 'App\\Controller\\Other\\FinanceController::newBudget'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/finance/depense/new' => [[['_route' => 'app_depense_new', '_controller' => 'App\\Controller\\Other\\FinanceController::newDepense'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/goals' => [[['_route' => 'app_goal_index', '_controller' => 'App\\Controller\\Other\\GoalController::index'], null, ['GET' => 0], null, true, false, null]],
        '/goals/new' => [[['_route' => 'app_goal_new', '_controller' => 'App\\Controller\\Other\\GoalController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/health' => [[['_route' => 'app_health_index', '_controller' => 'App\\Controller\\Other\\HealthController::index'], null, ['GET' => 0], null, true, false, null]],
        '/health/bilan/new' => [[['_route' => 'app_bilan_new', '_controller' => 'App\\Controller\\Other\\HealthController::newBilan'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/health/suivi/new' => [[['_route' => 'app_suivi_new', '_controller' => 'App\\Controller\\Other\\HealthController::newSuivi'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/tasks' => [[['_route' => 'app_tasks_index', '_controller' => 'App\\Controller\\Other\\TaskController::index'], null, ['GET' => 0], null, true, false, null]],
        '/tasks/new' => [[['_route' => 'app_tasks_new', '_controller' => 'App\\Controller\\Other\\TaskController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/time' => [[['_route' => 'app_time_index', '_controller' => 'App\\Controller\\Other\\TimeController::index'], null, ['GET' => 0], null, true, false, null]],
        '/time/activite/new' => [[['_route' => 'app_activite_new', '_controller' => 'App\\Controller\\Other\\TimeController::newActivite'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/reset-password' => [[['_route' => 'app_forgot_password_request', '_controller' => 'App\\Controller\\ResetPasswordController::request'], null, null, null, false, false, null]],
        '/reset-password/check-email' => [[['_route' => 'app_check_email', '_controller' => 'App\\Controller\\ResetPasswordController::checkEmail'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_home', '_controller' => 'App\\Controller\\User\\HomeController::index'], null, null, null, false, false, null]],
        '/profile' => [[['_route' => 'app_profile_edit', '_controller' => 'App\\Controller\\User\\ProfileController::edit'], null, ['GET' => 0, 'POST' => 1], null, true, false, null]],
        '/profile/change-password' => [[['_route' => 'app_profile_change_password', '_controller' => 'App\\Controller\\User\\ProfileController::changePassword'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\User\\RegistrationController::register'], null, null, null, false, false, null]],
        '/verify/code' => [[['_route' => 'app_verify_code', '_controller' => 'App\\Controller\\User\\RegistrationController::verifyCode'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\User\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\User\\SecurityController::logout'], null, null, null, false, false, null]],
        '/connect/google' => [[['_route' => 'connect_google_start', '_controller' => 'App\\Controller\\User\\SocialController::connectGoogleStart'], null, null, null, false, false, null]],
        '/connect/google/check' => [[['_route' => 'connect_google_check', '_controller' => 'App\\Controller\\User\\SocialController::connectGoogleCheck'], null, null, null, false, false, null]],
        '/connect/facebook' => [[['_route' => 'connect_facebook_start', '_controller' => 'App\\Controller\\User\\SocialController::connectFacebookStart'], null, null, null, false, false, null]],
        '/connect/facebook/check' => [[['_route' => 'connect_facebook_check', '_controller' => 'App\\Controller\\User\\SocialController::connectFacebookCheck'], null, null, null, false, false, null]],
        '/connect/github' => [[['_route' => 'connect_github_start', '_controller' => 'App\\Controller\\User\\SocialController::connectGithubStart'], null, null, null, false, false, null]],
        '/connect/github/check' => [[['_route' => 'connect_github_check', '_controller' => 'App\\Controller\\User\\SocialController::connectGithubCheck'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/admin/users/([^/]++)/(?'
                    .'|delete(*:233)'
                    .'|ban(*:244)'
                    .'|unban(*:257)'
                .')'
                .'|/goals/([^/]++)(?'
                    .'|(*:284)'
                    .'|/(?'
                        .'|edit(*:300)'
                        .'|action/new(*:318)'
                    .')'
                .')'
                .'|/tasks/([^/]++)(?'
                    .'|/edit(*:351)'
                    .'|(*:359)'
                .')'
                .'|/reset\\-password/reset(?:/([^/]++))?(*:404)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        233 => [[['_route' => 'app_admin_delete_user', '_controller' => 'App\\Controller\\Admin\\AdminDashboardController::deleteUser'], ['id'], ['POST' => 0], null, false, false, null]],
        244 => [[['_route' => 'app_admin_ban_user', '_controller' => 'App\\Controller\\Admin\\AdminDashboardController::banUser'], ['id'], ['POST' => 0], null, false, false, null]],
        257 => [[['_route' => 'app_admin_unban_user', '_controller' => 'App\\Controller\\Admin\\AdminDashboardController::unbanUser'], ['id'], ['POST' => 0], null, false, false, null]],
        284 => [[['_route' => 'app_goal_show', '_controller' => 'App\\Controller\\Other\\GoalController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        300 => [[['_route' => 'app_goal_edit', '_controller' => 'App\\Controller\\Other\\GoalController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        318 => [[['_route' => 'app_goal_action_new', '_controller' => 'App\\Controller\\Other\\GoalController::newAction'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        351 => [[['_route' => 'app_tasks_edit', '_controller' => 'App\\Controller\\Other\\TaskController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        359 => [[['_route' => 'app_tasks_delete', '_controller' => 'App\\Controller\\Other\\TaskController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        404 => [
            [['_route' => 'app_reset_password', 'token' => null, '_controller' => 'App\\Controller\\ResetPasswordController::reset'], ['token'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];

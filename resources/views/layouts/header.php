<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo SITE_NAME; ?></title>

    <link rel="stylesheet" href="/public/css/app.css">
	<link rel="shortcut icon" type="image/x-icon" href="data:image/svg+xml,&lt;svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22&gt;&lt;text y=%22.9em%22 font-size=%2290%22&gt;💻&lt;/text&gt;&lt;/svg&gt;">
</head>
<body>
<section class="w-full px-6 pb-12 antialiased bg-white" data-tails-scripts="//unpkg.com/alpinejs">
    <div class="mx-auto max-w-7xl">
        <nav class="relative z-50 h-24 select-none" x-data="{ showMenu: false }">
            <div class="container relative flex flex-wrap items-center justify-between h-24 mx-auto overflow-hidden font-medium border-b border-gray-200 md:overflow-visible lg:justify-center sm:px-4 md:px-2 lg:px-0">
                <div class="flex items-center justify-start w-1/4 h-full pr-4">
                    <a href="#_" class="inline-block py-4 md:py-0">
                        <span class="p-1 text-xl font-black leading-none text-gray-900"><?php echo SITE_NAME; ?>.</span>
                    </a>
                </div>
                <div class="top-0 left-0 items-start hidden w-full h-full p-4 text-sm bg-gray-900 bg-opacity-50 md:items-center md:w-3/4 md:absolute lg:text-base md:bg-transparent md:p-0 md:relative md:flex" :class="{'flex fixed': showMenu, 'hidden': !showMenu }">
                    <div class="flex-col w-full h-auto overflow-hidden bg-white rounded-lg md:bg-transparent md:overflow-visible md:rounded-none md:relative md:flex md:flex-row">
                        <a href="<?php echo route($routes->get('home')) ?>" class="inline-flex items-center block w-auto h-16 px-6 text-xl font-black leading-none text-gray-900 md:hidden">Notebooks<span class="text-indigo-600">.</span></a>
                        <div class="flex flex-col items-start justify-center w-full space-x-6 text-center lg:space-x-8 md:w-2/3 md:mt-0 md:flex-row md:items-center">
                            <a href="<?php echo route($routes->get('home')) ?>" class="<?php echo isRoute($routes->get('home')) ? 'nav-link-active' : 'nav-link'; ?>">Home</a>
                            <a href="<?php echo route($routes->get('notebooks.index')) ?>" class="<?php echo isUrl('notebooks*') ? 'nav-link-active' : 'nav-link'; ?>">Notebooks</a>
                            <a href="<?php echo route($routes->get('opsystems.index')) ?>" class="<?php echo isUrl('opsystems*') ? 'nav-link-active' : 'nav-link'; ?>">OP systems</a>
                            <a href="<?php echo route($routes->get('processors.index')) ?>" class="<?php echo isUrl('processors*') ? 'nav-link-active' : 'nav-link'; ?>">Processors</a>
                            <a href="<?php echo route($routes->get('mnb')) ?>" class="<?php echo isRoute($routes->get('mnb')) ? 'nav-link-active' : 'nav-link'; ?>">MNB</a>
                        </div>
                        <div class="flex flex-col items-start justify-end w-full pt-4 md:items-center md:w-1/3 md:flex-row md:py-0">
                            <?php if(!auth()->check()) : ?>
                                <a href="<?php echo route($routes->get('login')) ?>" class="w-full px-3 py-2 mr-0 text-gray-700 md:mr-2 lg:mr-3 md:w-auto">Sign In</a>
                                <a href="<?php echo route($routes->get('register')) ?>" class="button-pill">Sign Up</a>
                            <?php else : ?>
                                <span class="w-full, px-3 py-2 mr-0 text-gray-700">
                                    Hi <?php echo auth()->user()->name ?>!
                                </span>
                                <a href="<?php echo route($routes->get('logout')) ?>" class="button-pill">Logout</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div @click="showMenu = !showMenu" class="absolute right-0 flex flex-col items-center items-end justify-center w-10 h-10 bg-white rounded-full cursor-pointer md:hidden hover:bg-gray-100">
                    <svg class="w-6 h-6 text-gray-700" x-show="!showMenu" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 12h16M4 18h16" class=""></path>
                    </svg>
                    <svg class="w-6 h-6 text-gray-700" x-show="showMenu" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </nav>
    </div>
</section>

<main class="overflow-x-hidden flex-grow">
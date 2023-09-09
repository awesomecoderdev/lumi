<?php

/**
 * The header of the Theme.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 * @package           lumi
 *
 *                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>
<!doctype html>
<html <?php language_attributes(); ?> class="darks">

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class("bg-white dark:bg-dark"); ?>>
    <?php wp_body_open(); ?>

    <!-- start:header -->
    <header class="relative" id="header">

        <div class="relative bg-primary-500 h-[72px] md:block hidden">
            <div class="relative container md:flex hidden justify-between items-center h-full w-full mx-auto">
                <div class="flex items-center space-x-3 text-slate-100 dark:text-white font-normal leading-normal">
                    <a href="<?php echo site_url("/woman") ?>">Woman</a>
                    <a href="<?php echo site_url("/man") ?>">Men</a>
                    <a href="<?php echo site_url("/kids") ?>">Kids</a>
                </div>
                <div class="flex items-center space-x-3 text-slate-100 dark:text-white font-normal leading-normal">
                    <select name="lang" id="lang" class="bg-transparent outline-none border-none border-transparent outline-transparent focus:outline-none focus-visible:outline-none focus:ring-transparent">
                        <option value="">UAE</option>
                    </select>
                    <a href="#" class="flex justify-center items-center">English
                        <svg class="ml-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.99 0C4.47 0 0 4.48 0 10C0 15.52 4.47 20 9.99 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 9.99 0ZM16.92 6H13.97C13.65 4.75 13.19 3.55 12.59 2.44C14.43 3.07 15.96 4.35 16.92 6ZM10 2.04C10.83 3.24 11.48 4.57 11.91 6H8.09C8.52 4.57 9.17 3.24 10 2.04ZM2.26 12C2.1 11.36 2 10.69 2 10C2 9.31 2.1 8.64 2.26 8H5.64C5.56 8.66 5.5 9.32 5.5 10C5.5 10.68 5.56 11.34 5.64 12H2.26ZM3.08 14H6.03C6.35 15.25 6.81 16.45 7.41 17.56C5.57 16.93 4.04 15.66 3.08 14ZM6.03 6H3.08C4.04 4.34 5.57 3.07 7.41 2.44C6.81 3.55 6.35 4.75 6.03 6ZM10 17.96C9.17 16.76 8.52 15.43 8.09 14H11.91C11.48 15.43 10.83 16.76 10 17.96ZM12.34 12H7.66C7.57 11.34 7.5 10.68 7.5 10C7.5 9.32 7.57 8.65 7.66 8H12.34C12.43 8.65 12.5 9.32 12.5 10C12.5 10.68 12.43 11.34 12.34 12ZM12.59 17.56C13.19 16.45 13.65 15.25 13.97 14H16.92C15.96 15.65 14.43 16.93 12.59 17.56ZM14.36 12C14.44 11.34 14.5 10.68 14.5 10C14.5 9.32 14.44 8.66 14.36 8H17.74C17.9 8.64 18 9.31 18 10C18 10.69 17.9 11.36 17.74 12H14.36Z" fill="#F7F8F6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>


        <div class="relative md:block hidden  py-6 ">
            <div class="relative container md:flex hidden justify-between items-center h-auto w-full mx-auto">
                <div class="lg:w-[60%] w-1/2 relative flex lg:justify-between justify-start items-center space-x-4">
                    <a href="<?php echo site_url("/") ?>"><img class="h-auto lg:w-[120px] w-20" src="<?php echo url("img/logo.png") ?>" alt="<?php echo bloginfo("title") ?>"></a>
                    <div class="relative border border-primary-100 text-slate-600 dark:text-white rounded-full py-0.5 px-3 xl:w-[420px] lg:w-96 w-full">
                        <svg class="absolute left-2.5 top-[50%] translate-y-[-50%]" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.7555 20.6065L18.3182 17.2458L18.2376 17.1233C18.0878 16.9742 17.883 16.8902 17.6692 16.8902C17.4554 16.8902 17.2505 16.9742 17.1007 17.1233C14.1795 19.8033 9.67815 19.949 6.58201 17.4637C3.48586 14.9784 2.75567 10.6334 4.87568 7.31017C6.9957 3.98697 11.3081 2.71685 14.9528 4.34214C18.5976 5.96743 20.4438 9.98379 19.267 13.7276C19.1823 13.9981 19.2515 14.2922 19.4487 14.4992C19.6459 14.7062 19.9411 14.7946 20.223 14.7311C20.505 14.6676 20.7309 14.4619 20.8156 14.1914C22.2224 9.74864 20.0977 4.96755 15.8161 2.94106C11.5345 0.914562 6.38084 2.25082 3.68905 6.08542C0.99727 9.92001 1.57518 15.1021 5.04893 18.2795C8.52268 21.4569 13.8498 21.6759 17.5841 18.7949L20.6277 21.7705C20.942 22.0765 21.4502 22.0765 21.7645 21.7705C22.0785 21.4602 22.0785 20.9606 21.7645 20.6503L21.7555 20.6065Z" fill="currentColor" />
                        </svg>
                        <form class="relative pl-5 overflow-hidden" action="<?php echo site_url("/") ?>" method="GET">
                            <input type="text" name="s" id="" placeholder="search for product" value="<?php echo get_search_query(); ?>" class="bg-transparent outline-none border-none border-transparent outline-transparent focus:outline-none focus-visible:outline-none focus:ring-transparent w-full">
                        </form>
                    </div>
                </div>

                <nav class="lg:w-[40%] w-1/2 relative flex justify-end">
                    <ul class="relative flex space-x-4 text-slate-600 dark:text-white">
                        <li>
                            <a href="<?php echo site_url("/account") ?>" class="flex justify-center items-center <?php echo lumi_path("account") ? "text-primary-500 dark:text-white" : "" ?>">
                                <svg class="mr-1.5" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                account
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/wishlist") ?>" class="flex justify-center items-center <?php echo lumi_path("wishlist") ? "text-primary-500 dark:text-white" : "" ?>">
                                <svg class="mr-1.5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 20.355C11.9013 20.3556 11.8034 20.3367 11.7121 20.2993C11.6207 20.262 11.5376 20.207 11.4675 20.1375L4.57499 13.245C3.78931 12.4583 3.25438 11.4565 3.03775 10.366C2.82111 9.27553 2.9325 8.1453 3.35783 7.11807C3.78317 6.09085 4.50338 5.21271 5.42749 4.59456C6.35161 3.97641 7.43819 3.64598 8.54999 3.645C9.79938 3.64019 11.0142 4.05483 12 4.8225C13.0833 3.98581 14.4339 3.57163 15.8 3.65718C17.1661 3.74274 18.4545 4.32219 19.425 5.2875C20.477 6.34444 21.0676 7.775 21.0676 9.26625C21.0676 10.7575 20.477 12.1881 19.425 13.245L12.5325 20.1375C12.4624 20.207 12.3793 20.262 12.2879 20.2993C12.1965 20.3367 12.0987 20.3556 12 20.355ZM8.54999 5.145C8.00797 5.14317 7.47099 5.24897 6.97017 5.45625C6.46936 5.66352 6.01467 5.96816 5.63249 6.3525C4.86214 7.12808 4.4298 8.17686 4.4298 9.27C4.4298 10.3631 4.86214 11.4119 5.63249 12.1875L12 18.5475L18.3675 12.1875C19.1378 11.4119 19.5702 10.3631 19.5702 9.27C19.5702 8.17686 19.1378 7.12808 18.3675 6.3525C17.9844 5.96925 17.5296 5.66523 17.029 5.45781C16.5284 5.25039 15.9919 5.14363 15.45 5.14363C14.9081 5.14363 14.3716 5.25039 13.871 5.45781C13.3704 5.66523 12.9156 5.96925 12.5325 6.3525C12.4628 6.4228 12.3798 6.47859 12.2884 6.51667C12.197 6.55474 12.099 6.57435 12 6.57435C11.901 6.57435 11.8029 6.55474 11.7116 6.51667C11.6202 6.47859 11.5372 6.4228 11.4675 6.3525C11.0853 5.96816 10.6306 5.66352 10.1298 5.45625C9.62898 5.24897 9.092 5.14317 8.54999 5.145Z" fill="currentColor" />
                                </svg>
                                wishlist
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/cart") ?>" class="relative flex justify-center items-center <?php echo is_cart() ? "text-primary-500 dark:text-white" : "" ?>" id="lumi-cart-fragment">
                                <svg class="mr-1.5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.651 6.5984C16.651 4.21232 14.7167 2.27799 12.3307 2.27799C11.1817 2.27316 10.0781 2.72619 9.26387 3.53695C8.44968 4.3477 7.992 5.44939 7.992 6.5984M16.5137 21.5H8.16592C5.09955 21.5 2.74715 20.3924 3.41534 15.9348L4.19338 9.89359C4.60528 7.66934 6.02404 6.81808 7.26889 6.81808H17.4474C18.7105 6.81808 20.0469 7.73341 20.5229 9.89359L21.3009 15.9348C21.8684 19.889 19.5801 21.5 16.5137 21.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15.296 11.102H15.251" stroke="#2D2D2D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.46604 11.102H9.42004" stroke="#2D2D2D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                bag


                                <?php if (lumi_get_cart_count()) : ?>
                                    <span class="absolute -top-2 left-3 h-4 w-4 text-[8px] font-medium flex justify-center items-center rounded-full bg-primary-500 text-white"><?php echo lumi_get_cart_count() ?></span>
                                <?php endif ?>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>


        <?php if (wp_is_mobile()) : ?>
            <div class="relative px-4 space-y-4 md:hidden bg-background" style="--bg-opacity-light: 0.5; --bg-opacity-dark: 0.2;">
                <div class="relative md:hidden flex justify-between py-5 text-slate-500 dark:text-white">
                    <a href="<?php echo site_url("/wishlist") ?>" class="flex justify-center items-center">
                        <svg class="mr-1.5 h-14 w-8" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 20.355C11.9013 20.3556 11.8034 20.3367 11.7121 20.2993C11.6207 20.262 11.5376 20.207 11.4675 20.1375L4.57499 13.245C3.78931 12.4583 3.25438 11.4565 3.03775 10.366C2.82111 9.27553 2.9325 8.1453 3.35783 7.11807C3.78317 6.09085 4.50338 5.21271 5.42749 4.59456C6.35161 3.97641 7.43819 3.64598 8.54999 3.645C9.79938 3.64019 11.0142 4.05483 12 4.8225C13.0833 3.98581 14.4339 3.57163 15.8 3.65718C17.1661 3.74274 18.4545 4.32219 19.425 5.2875C20.477 6.34444 21.0676 7.775 21.0676 9.26625C21.0676 10.7575 20.477 12.1881 19.425 13.245L12.5325 20.1375C12.4624 20.207 12.3793 20.262 12.2879 20.2993C12.1965 20.3367 12.0987 20.3556 12 20.355ZM8.54999 5.145C8.00797 5.14317 7.47099 5.24897 6.97017 5.45625C6.46936 5.66352 6.01467 5.96816 5.63249 6.3525C4.86214 7.12808 4.4298 8.17686 4.4298 9.27C4.4298 10.3631 4.86214 11.4119 5.63249 12.1875L12 18.5475L18.3675 12.1875C19.1378 11.4119 19.5702 10.3631 19.5702 9.27C19.5702 8.17686 19.1378 7.12808 18.3675 6.3525C17.9844 5.96925 17.5296 5.66523 17.029 5.45781C16.5284 5.25039 15.9919 5.14363 15.45 5.14363C14.9081 5.14363 14.3716 5.25039 13.871 5.45781C13.3704 5.66523 12.9156 5.96925 12.5325 6.3525C12.4628 6.4228 12.3798 6.47859 12.2884 6.51667C12.197 6.55474 12.099 6.57435 12 6.57435C11.901 6.57435 11.8029 6.55474 11.7116 6.51667C11.6202 6.47859 11.5372 6.4228 11.4675 6.3525C11.0853 5.96816 10.6306 5.66352 10.1298 5.45625C9.62898 5.24897 9.092 5.14317 8.54999 5.145Z" fill="currentColor" />
                        </svg>
                    </a>
                    <a href="<?php echo site_url("/") ?>"><img class="h-auto w-[100px]" src="<?php echo url("img/logo.png") ?>" alt="<?php echo bloginfo("title") ?>"></a>
                    <a href="<?php echo site_url("/cart") ?>" class="relative flex justify-center items-center" id="lumi-cart-mobile-fragment">
                        <svg class="mr-1.5 h-14 w-8" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.651 6.5984C16.651 4.21232 14.7167 2.27799 12.3307 2.27799C11.1817 2.27316 10.0781 2.72619 9.26387 3.53695C8.44968 4.3477 7.992 5.44939 7.992 6.5984M16.5137 21.5H8.16592C5.09955 21.5 2.74715 20.3924 3.41534 15.9348L4.19338 9.89359C4.60528 7.66934 6.02404 6.81808 7.26889 6.81808H17.4474C18.7105 6.81808 20.0469 7.73341 20.5229 9.89359L21.3009 15.9348C21.8684 19.889 19.5801 21.5 16.5137 21.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.296 11.102H15.251" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.46604 11.102H9.42004" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <?php if (lumi_get_cart_count()) : ?>
                            <span class="absolute top-2.5 -right-0.5 h-4 w-4 mr-1 mt-0.5 text-[8px] font-medium flex justify-center items-center text-xs rounded-full bg-primary-500 text-white"><?php echo lumi_get_cart_count() ?></span>
                        <?php endif ?>
                    </a>
                </div>


                <div class="relative border border-primary-100 rounded-2xl py-1 lg:px-5 px-2 lg:w-96 w-full h-full overflow-hidden text-slate-600 dark:text-white">
                    <svg class="absolute left-3 top-[50%] translate-y-[-50%]" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.7555 20.6065L18.3182 17.2458L18.2376 17.1233C18.0878 16.9742 17.883 16.8902 17.6692 16.8902C17.4554 16.8902 17.2505 16.9742 17.1007 17.1233C14.1795 19.8033 9.67815 19.949 6.58201 17.4637C3.48586 14.9784 2.75567 10.6334 4.87568 7.31017C6.9957 3.98697 11.3081 2.71685 14.9528 4.34214C18.5976 5.96743 20.4438 9.98379 19.267 13.7276C19.1823 13.9981 19.2515 14.2922 19.4487 14.4992C19.6459 14.7062 19.9411 14.7946 20.223 14.7311C20.505 14.6676 20.7309 14.4619 20.8156 14.1914C22.2224 9.74864 20.0977 4.96755 15.8161 2.94106C11.5345 0.914562 6.38084 2.25082 3.68905 6.08542C0.99727 9.92001 1.57518 15.1021 5.04893 18.2795C8.52268 21.4569 13.8498 21.6759 17.5841 18.7949L20.6277 21.7705C20.942 22.0765 21.4502 22.0765 21.7645 21.7705C22.0785 21.4602 22.0785 20.9606 21.7645 20.6503L21.7555 20.6065Z" fill="currentColor" />
                    </svg>
                    <form class="relative pl-7 overflow-hidden" action="<?php echo site_url("/") ?>" method="GET">
                        <input type="text" name="s" id="" placeholder="search for product" class="bg-transparent outline-none border-none border-transparent outline-transparent focus:outline-none focus-visible:outline-none focus:ring-transparent w-full">
                    </form>
                    <div class="absolute right-0 top-[50%] translate-y-[-50%] h-full">
                        <div class="relative flex justify-start items-center bg-slate-100 dark:bg-primary-500 w-12 h-full">
                            <svg class="mx-auto" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.6 8.79995H3.20002C2.98785 8.79995 2.78437 8.71567 2.63434 8.56564C2.48431 8.41561 2.40002 8.21212 2.40002 7.99995C2.40002 7.78778 2.48431 7.5843 2.63434 7.43427C2.78437 7.28424 2.98785 7.19995 3.20002 7.19995H13.6C13.8122 7.19995 14.0157 7.28424 14.1657 7.43427C14.3157 7.5843 14.4 7.78778 14.4 7.99995C14.4 8.21212 14.3157 8.41561 14.1657 8.56564C14.0157 8.71567 13.8122 8.79995 13.6 8.79995ZM20.8 8.79995H17.6C17.3879 8.79995 17.1844 8.71567 17.0343 8.56564C16.8843 8.41561 16.8 8.21212 16.8 7.99995C16.8 7.78778 16.8843 7.5843 17.0343 7.43427C17.1844 7.28424 17.3879 7.19995 17.6 7.19995H20.8C21.0122 7.19995 21.2157 7.28424 21.3657 7.43427C21.5157 7.5843 21.6 7.78778 21.6 7.99995C21.6 8.21212 21.5157 8.41561 21.3657 8.56564C21.2157 8.71567 21.0122 8.79995 20.8 8.79995Z" fill="currentColor" />
                                <path d="M15.6 10.8C15.0462 10.8 14.5049 10.6357 14.0444 10.3281C13.584 10.0204 13.2251 9.5831 13.0132 9.07147C12.8012 8.55983 12.7458 7.99685 12.8538 7.4537C12.9619 6.91055 13.2285 6.41164 13.6201 6.02005C14.0117 5.62847 14.5106 5.36179 15.0538 5.25375C15.5969 5.14572 16.1599 5.20116 16.6715 5.41309C17.1832 5.62502 17.6205 5.9839 17.9281 6.44436C18.2358 6.90481 18.4 7.44616 18.4 7.99995C18.4 8.74256 18.105 9.45475 17.5799 9.97985C17.0548 10.505 16.3426 10.8 15.6 10.8ZM15.6 6.79995C15.3627 6.79995 15.1307 6.87033 14.9333 7.00219C14.736 7.13405 14.5822 7.32146 14.4914 7.54073C14.4005 7.76 14.3768 8.00128 14.4231 8.23406C14.4694 8.46684 14.5837 8.68066 14.7515 8.84848C14.9193 9.0163 15.1331 9.13059 15.3659 9.17689C15.5987 9.2232 15.84 9.19943 16.0592 9.10861C16.2785 9.01778 16.4659 8.86398 16.5978 8.66664C16.7296 8.4693 16.8 8.23729 16.8 7.99995C16.8 7.68169 16.6736 7.37647 16.4486 7.15142C16.2235 6.92638 15.9183 6.79995 15.6 6.79995ZM20.8 16.8H10.4C10.1879 16.8 9.98437 16.7157 9.83434 16.5656C9.68431 16.4156 9.60002 16.2121 9.60002 16C9.60002 15.7878 9.68431 15.5843 9.83434 15.4343C9.98437 15.2842 10.1879 15.2 10.4 15.2H20.8C21.0122 15.2 21.2157 15.2842 21.3657 15.4343C21.5157 15.5843 21.6 15.7878 21.6 16C21.6 16.2121 21.5157 16.4156 21.3657 16.5656C21.2157 16.7157 21.0122 16.8 20.8 16.8ZM6.40002 16.8H3.20002C2.98785 16.8 2.78437 16.7157 2.63434 16.5656C2.48431 16.4156 2.40002 16.2121 2.40002 16C2.40002 15.7878 2.48431 15.5843 2.63434 15.4343C2.78437 15.2842 2.98785 15.2 3.20002 15.2H6.40002C6.6122 15.2 6.81568 15.2842 6.96571 15.4343C7.11574 15.5843 7.20002 15.7878 7.20002 16C7.20002 16.2121 7.11574 16.4156 6.96571 16.5656C6.81568 16.7157 6.6122 16.8 6.40002 16.8Z" fill="currentColor" />
                                <path d="M8.39998 18.8C7.84619 18.8 7.30484 18.6357 6.84438 18.3281C6.38392 18.0204 6.02504 17.5831 5.81311 17.0715C5.60119 16.5598 5.54574 15.9968 5.65378 15.4537C5.76182 14.9106 6.02849 14.4116 6.42008 14.0201C6.81166 13.6285 7.31058 13.3618 7.85372 13.2538C8.39687 13.1457 8.95986 13.2012 9.47149 13.4131C9.98312 13.625 10.4204 13.9839 10.7281 14.4444C11.0358 14.9048 11.2 15.4462 11.2 16C11.2 16.7426 10.905 17.4548 10.3799 17.9799C9.85477 18.505 9.14258 18.8 8.39998 18.8ZM8.39998 14.8C8.16264 14.8 7.93063 14.8703 7.73329 15.0022C7.53595 15.134 7.38215 15.3215 7.29132 15.5407C7.2005 15.76 7.17673 16.0013 7.22303 16.2341C7.26934 16.4668 7.38363 16.6807 7.55145 16.8485C7.71927 17.0163 7.93309 17.1306 8.16587 17.1769C8.39865 17.2232 8.63993 17.1994 8.8592 17.1086C9.07847 17.0178 9.26588 16.864 9.39774 16.6666C9.5296 16.4693 9.59998 16.2373 9.59998 16C9.59998 15.6817 9.47355 15.3765 9.24851 15.1514C9.02346 14.9264 8.71824 14.8 8.39998 14.8Z" fill="currentColor" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="relative w-full flex justify-between items-center space-x-3 text-slate-600 dark:text-white font-normal leading-normal">
                    <a href="<?php echo site_url("/") ?>" class="relative py-2 px-3 border-b-2 <?php echo is_front_page() || is_shop() ? "text-primary-500 dark:text-primary-500 border-primary-50 dark:border-primary-500" : "border-slate-100 dark:border-primary-50/5" ?>">All</a>
                    <a href="<?php echo site_url("/woman") ?>" class="relative py-2 px-3 border-b-2 <?php echo lumi_path("woman") ? "text-primary-500 dark:text-primary-500 border-primary-50 dark:border-primary-500" : "border-slate-100 dark:border-primary-50/5" ?>">Woman</a>
                    <a href="<?php echo site_url("/man") ?>" class="relative py-2 px-3 border-b-2 <?php echo lumi_path("man")  ? "text-primary-500 dark:text-primary-500 border-primary-50 dark:border-primary-500" : "border-slate-100 dark:border-primary-50/5" ?>">Men</a>
                    <a href="<?php echo site_url("/kids") ?>" class="relative py-2 px-3 border-b-2 <?php echo lumi_path("kids")  ? "text-primary-500 dark:text-primary-500 border-primary-50 dark:border-primary-500" : "border-slate-100 dark:border-primary-50/5" ?>">Kids</a>
                </div>
            </div>

            <div class="fixed bottom-0 w-full md:hidden border-t border-primary-50/50 dark:border-slate-100/5 bg-white dark:bg-dark z-50">
                <div class="relative flex justify-between items-center px-2.5 text-xs font-medium ">
                    <a class="relative flex flex-col py-2 px-3 <?php echo is_front_page() || is_shop() ? "text-primary-500 dark:text-primary-600 " : "text-gray-600 dark:text-white" ?>" href="<?php echo site_url("/shop") ?>">
                        <svg class="mx-auto" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.5 8.00001L14.5 2.74001C13.95 2.24805 13.2379 1.97607 12.5 1.97607C11.762 1.97607 11.05 2.24805 10.5 2.74001L4.49997 8.00001C4.18234 8.28408 3.92887 8.63256 3.75644 9.02225C3.58402 9.41194 3.49659 9.83389 3.49997 10.26V19C3.49997 19.7957 3.81604 20.5587 4.37865 21.1213C4.94126 21.6839 5.70432 22 6.49997 22H18.5C19.2956 22 20.0587 21.6839 20.6213 21.1213C21.1839 20.5587 21.5 19.7957 21.5 19V10.25C21.5019 9.82557 21.4138 9.40555 21.2414 9.01769C21.0691 8.62983 20.8163 8.28296 20.5 8.00001ZM14.5 20H10.5V15C10.5 14.7348 10.6053 14.4804 10.7929 14.2929C10.9804 14.1054 11.2348 14 11.5 14H13.5C13.7652 14 14.0195 14.1054 14.2071 14.2929C14.3946 14.4804 14.5 14.7348 14.5 15V20ZM19.5 19C19.5 19.2652 19.3946 19.5196 19.2071 19.7071C19.0195 19.8946 18.7652 20 18.5 20H16.5V15C16.5 14.2044 16.1839 13.4413 15.6213 12.8787C15.0587 12.3161 14.2956 12 13.5 12H11.5C10.7043 12 9.94126 12.3161 9.37865 12.8787C8.81604 13.4413 8.49997 14.2044 8.49997 15V20H6.49997C6.23476 20 5.9804 19.8946 5.79287 19.7071C5.60533 19.5196 5.49997 19.2652 5.49997 19V10.25C5.50015 10.108 5.53057 9.9677 5.58919 9.83839C5.64781 9.70907 5.7333 9.59372 5.83997 9.50001L11.84 4.25001C12.0225 4.08969 12.2571 4.00127 12.5 4.00127C12.7429 4.00127 12.9775 4.08969 13.16 4.25001L19.16 9.50001C19.2666 9.59372 19.3521 9.70907 19.4108 9.83839C19.4694 9.9677 19.4998 10.108 19.5 10.25V19Z" fill="currentColor" />
                        </svg>
                        <span class="pt-1">
                            Shop
                        </span>
                    </a>
                    <a class="relative flex flex-col py-2 px-3  <?php echo lumi_path("categories") ? "text-primary-500 dark:text-primary-600 " : "text-gray-600 dark:text-white" ?> " href="<?php echo site_url("/categories") ?>">
                        <svg class="mx-auto" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                            <g clip-path="url(#clip0_40_8729)">
                                <path d="M6.85133 2.85033L6.85193 2.8498C7.41782 2.34885 8.34481 1.83579 9.29857 1.44774C10.2529 1.05945 11.2254 0.799864 11.8813 0.799864H12.2625V5.15611V9.51236H7.90629H3.55004V8.92486C3.55004 8.43646 3.71658 7.71155 3.97613 6.97029C4.23538 6.22992 4.58524 5.47942 4.94778 4.94026L4.94821 4.93962L4.94821 4.93961C5.13092 4.65853 5.26955 4.44471 5.36982 4.28239C5.46952 4.121 5.5334 4.00724 5.56458 3.92743C5.58006 3.88781 5.58954 3.85157 5.58852 3.81947C5.58741 3.78416 5.57336 3.75365 5.54478 3.73286C5.51971 3.71463 5.48821 3.70754 5.45905 3.70403C5.42895 3.70041 5.39368 3.69986 5.35629 3.69986C5.22651 3.69986 5.08957 3.79174 4.95429 3.93152C4.81657 4.07383 4.6705 4.27644 4.52253 4.52021C4.22635 5.00814 3.9181 5.66848 3.65027 6.36153C3.38239 7.05473 3.15419 7.78264 3.01875 8.40624C2.95105 8.718 2.90629 9.00472 2.89158 9.24859C2.87695 9.49113 2.89166 9.69659 2.94704 9.8426L2.94736 9.84344L2.94736 9.84343C2.96416 9.88543 2.98935 9.92375 3.03002 9.95709C3.06995 9.98984 3.12262 10.016 3.19193 10.0376C3.32939 10.0803 3.54292 10.108 3.87946 10.1256C4.55403 10.1608 5.74189 10.1561 7.85048 10.1374L7.85063 10.1374L12.5944 10.0811L12.6432 10.0805L12.6438 10.0317L12.7 5.1942L12.7 5.194L12.7375 0.375253L12.7379 0.323885L12.6866 0.324873L11.7125 0.343614C11.7124 0.343614 11.7122 0.343614 11.7121 0.343614C11.1627 0.343699 10.2205 0.49457 9.63479 0.683494L6.85133 2.85033ZM6.85133 2.85033C6.52244 3.13223 6.24958 3.31542 6.05555 3.38665C5.96017 3.42166 5.8719 3.43415 5.80426 3.40378C5.72988 3.37037 5.70004 3.2957 5.70004 3.20611C5.70004 3.12608 5.74442 3.03684 5.81205 2.94544M6.85133 2.85033L5.81205 2.94544M5.81205 2.94544C5.88102 2.85224 5.98005 2.74906 6.10191 2.63979M5.81205 2.94544L6.10191 2.63979M6.10191 2.63979C6.34583 2.42106 6.68641 2.17331 7.07559 1.92639M6.10191 2.63979L7.07559 1.92639M7.07559 1.92639C7.85372 1.43272 8.83257 0.938351 9.63469 0.683528L7.07559 1.92639Z" fill="currentColor" stroke="currentColor" stroke-width="0.5" />
                                <path d="M14.3625 5.19433H14.3625L14.3625 5.19414L14.325 0.375389L14.3246 0.325H14.375H15.2938C16.3441 0.325 17.547 0.660642 18.6861 1.21838C19.8254 1.77626 20.9042 2.55807 21.706 3.45416L21.7061 3.45428C22.7625 4.64269 23.7039 6.60116 24.0054 8.24096L24.0055 8.24128C24.0851 8.69062 24.1419 9.03585 24.1568 9.29953C24.1715 9.56187 24.1457 9.75495 24.0486 9.89149C23.9501 10.0299 23.7869 10.0987 23.5579 10.1346C23.329 10.1704 23.0225 10.175 22.625 10.175C22.1011 10.175 21.7675 10.1611 21.5645 10.1176C21.4631 10.0959 21.3872 10.0654 21.3365 10.0198C21.2829 9.97159 21.2625 9.91125 21.2625 9.84375C21.2625 9.77749 21.2809 9.71799 21.3289 9.66967C21.3749 9.62329 21.4432 9.59223 21.5326 9.5702C21.7106 9.52632 21.998 9.5125 22.4375 9.5125H23.5125V8.94375C23.5125 7.71931 22.9831 6.30388 22.1334 5.02454C21.2839 3.74567 20.1179 2.60831 18.8516 1.93794L18.8511 1.93767C18.3206 1.64913 17.5973 1.36435 16.9079 1.15168C16.2172 0.938617 15.567 0.8 15.1813 0.8H14.8V5.15625V9.5125H17.7688C18.931 9.5125 19.6829 9.52654 20.1375 9.56187C20.3639 9.57947 20.5207 9.6026 20.6183 9.63348C20.6664 9.64869 20.7067 9.6677 20.733 9.6941C20.7468 9.70798 20.7577 9.72491 20.7628 9.74503C20.7678 9.76532 20.766 9.78519 20.7599 9.80331L20.76 9.80334L20.7589 9.80607C20.7439 9.84353 20.7133 9.87227 20.6747 9.89494C20.636 9.91765 20.5852 9.93664 20.5228 9.95305C20.3978 9.98587 20.2166 10.0107 19.9686 10.0295C19.4719 10.0672 18.6967 10.0813 17.5438 10.0813H14.4688H14.4193L14.4188 10.0318L14.3625 5.19433Z" fill="currentColor" stroke="currentColor" stroke-width="0.5" />
                                <path d="M15.7062 2.23118C15.7625 2.36243 16.2687 2.66244 16.8687 2.90619C19.0625 3.78744 20.9375 5.71868 21.7812 7.96868C22.1187 8.81243 22.4375 9.07493 22.4375 8.51243C22.4375 8.34368 22.175 7.64993 21.8375 6.95618C20.825 4.79993 18.275 2.64368 16.175 2.13743C15.8 2.04368 15.6687 2.08118 15.7062 2.23118Z" fill="currentColor" stroke="currentColor" />
                                <path d="M14.375 21.2375H14.325V21.1875V16.3125V11.4375V11.3875H14.375H19.1562C21.1901 11.3875 22.3917 11.3969 23.0966 11.4368C23.4485 11.4567 23.6801 11.4844 23.8306 11.5236C23.9794 11.5623 24.0641 11.6161 24.0967 11.7008L24.0967 11.701C24.1254 11.7766 24.1398 11.8783 24.1434 11.9977C24.1471 12.1178 24.14 12.2595 24.1238 12.417C24.0912 12.7322 24.0216 13.1141 23.9252 13.5209C23.7324 14.3343 23.4314 15.2519 23.1013 15.9404C21.6689 18.9372 18.24 21.2186 15.1816 21.2375V21.2375H15.1812H14.375ZM23.4379 13.0627L23.4379 13.0627L23.5622 12.05H19.175H14.8V16.425V20.7734L15.6428 20.6505L15.6428 20.6505L15.6431 20.6505C18.7389 20.2215 21.3495 18.3009 22.6735 15.485L22.6738 15.4843C23.0468 14.7196 23.3636 13.675 23.4379 13.0627Z" fill="currentColor" stroke="currentColor" stroke-width="0.5" />
                                <path d="M4.11335 13.9242L4.11335 13.9242C3.88716 14.3012 3.74407 14.5962 3.65098 14.9351C3.5581 15.2733 3.51572 15.6527 3.48755 16.1974L3.48753 16.1976C3.45942 16.788 3.45896 17.1547 3.52836 17.4898C3.59789 17.8254 3.73687 18.1261 3.98075 18.5858L4.11335 13.9242ZM4.11335 13.9242L4.11383 13.9234C4.77702 12.8623 6.12038 11.9342 7.29882 11.763C10.8387 11.233 13.6464 14.3204 12.6605 17.6765C11.8265 20.5195 8.62374 21.9021 5.93387 20.5572L4.99062 20.0855L3.02882 21.9918C3.02879 21.9918 3.02875 21.9919 3.02872 21.9919C2.39089 22.6204 1.8833 23.0857 1.52749 23.3732C1.35006 23.5166 1.20814 23.6175 1.10557 23.672C1.05519 23.6988 1.0091 23.7173 0.970515 23.7209C0.950724 23.7228 0.928596 23.7213 0.908269 23.7108C0.886476 23.6996 0.872219 23.681 0.865044 23.6595L0.864999 23.6595L0.864402 23.6574C0.858386 23.6364 0.861704 23.6146 0.86615 23.5973C0.87093 23.5788 0.878995 23.5583 0.88924 23.5366C0.909783 23.4931 0.941759 23.4392 0.983345 23.3767C1.06673 23.2513 1.19215 23.0863 1.35202 22.8924C1.67194 22.5042 2.13237 21.9969 2.67694 21.4523C2.677 21.4522 2.67706 21.4522 2.67712 21.4521L4.50749 19.5848L3.98081 18.5859L4.11335 13.9242ZM10.0584 12.7569L10.0579 12.7567C9.19403 12.3015 8.33291 12.1403 7.51769 12.265C6.7025 12.3897 5.92916 12.8009 5.24182 13.4976L5.24177 13.4976C4.36823 14.3805 3.9296 15.3949 3.92498 16.4041C3.92036 17.4131 4.34963 18.4226 5.22283 19.2958C7.89019 21.9632 12.2438 20.132 12.2625 16.3124C12.2625 14.8129 11.4296 13.4611 10.0584 12.7569Z" fill="currentColor" stroke="currentColor" stroke-width="0.5" />
                                <path d="M7.00625 13.2187C5.675 13.6875 4.8125 14.85 4.8125 16.1625C4.8125 16.9125 5.05625 16.6687 5.3375 15.6187C5.6 14.7562 6.59375 13.7625 7.4 13.575C8.2625 13.3875 8.39375 13.3125 8.28125 13.125C8.13125 12.8812 7.86875 12.9 7.00625 13.2187Z" fill="currentColor" stroke="currentColor" />
                            </g>
                            <defs>
                                <clipPath id="clip0_40_8729">
                                    <rect width="24" height="24" fill="white" transform="translate(0.5)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span class="pt-1">
                            Categories
                        </span>
                    </a>
                    <a class="relative flex flex-col py-2 px-3 <?php echo lumi_path("brand") ? "text-primary-500 dark:text-primary-600 " : "text-gray-600 dark:text-white" ?>" href="<?php echo site_url("/brand") ?>">
                        <svg class="mx-auto" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                            <g clip-path="url(#clip0_40_8715)">
                                <path d="M11.25 1.5C11.25 1.875 11.625 2.25 12 2.25C12.45 2.25 12.75 1.875 12.75 1.5C12.75 1.05 12.45 0.75 12 0.75C11.625 0.75 11.25 1.05 11.25 1.5Z" fill="currentColor" />
                                <path d="M5.40005 8.775L5.62505 13.875H12H18.375L18.6 8.775L18.825 3.75H12H5.17505L5.40005 8.775ZM17.25 9V13.5H12H6.75005V9V4.5H12H17.25V9Z" fill="currentColor" />
                                <path d="M10.4251 6.75005C9.67505 7.50005 9.30005 8.85005 9.52505 9.90005C10.0501 12.6 13.9501 12.6 14.4751 9.90005C14.7001 8.77505 14.3251 7.57505 13.4251 6.67505C11.7751 5.02505 11.9251 5.02505 10.4251 6.75005ZM13.3501 9.22505C13.5001 10.125 13.1251 10.5 12.0751 10.5C11.1751 10.5 10.5001 10.05 10.5001 9.52505C10.5001 7.20005 12.9001 6.97505 13.3501 9.22505Z" fill="currentColor" />
                                <path d="M2.84997 8.77503C3.37497 9.00003 4.04997 8.92503 4.27497 8.70003C4.57497 8.47503 4.12497 8.25003 3.29997 8.32503C2.47497 8.32503 2.24997 8.55003 2.84997 8.77503Z" fill="currentColor" />
                                <path d="M20.1 8.77503C20.625 9.00003 21.3 8.92503 21.525 8.70003C21.825 8.47503 21.375 8.25003 20.55 8.32503C19.725 8.32503 19.5 8.55003 20.1 8.77503Z" fill="currentColor" />
                                <path d="M19.125 16.1251C16.35 18.3751 15.75 18.4501 16.275 16.5001C16.8 14.6251 14.7 14.4751 10.725 16.1251C9.3 16.7251 6.45 17.2501 4.425 17.2501H0.75V20.1751V23.1001L8.1 22.7251C16.125 22.2751 18.375 21.4501 21.3 18.0001C24.6 14.0251 23.175 12.7501 19.125 16.1251ZM20.85 17.3251C18.3 20.7001 15.75 21.7501 9.75 21.7501C4.65 21.7501 4.5 21.6751 4.5 19.8751C4.5 18.3751 4.875 18.0001 6.3 18.0001C7.275 18.0001 9.3 17.4751 10.725 16.8751C12.225 16.2751 14.025 15.7501 14.775 15.7501C15.9 15.7501 15.825 16.0501 14.25 17.2501C13.2 18.0001 12.6 18.9001 12.9 19.2001C13.8 20.0251 17.025 18.8251 19.275 16.8751C22.2 14.3251 22.875 14.5501 20.85 17.3251ZM3.75 20.2501C3.75 21.7501 3.375 22.5001 2.625 22.5001C1.875 22.5001 1.5 21.7501 1.5 20.2501C1.5 18.7501 1.875 18.0001 2.625 18.0001C3.375 18.0001 3.75 18.7501 3.75 20.2501ZM15.525 18.4501C15.3 18.6751 14.625 18.7501 14.1 18.5251C13.5 18.3001 13.725 18.0751 14.55 18.0751C15.375 18.0001 15.825 18.2251 15.525 18.4501Z" fill="currentColor" />
                            </g>
                            <defs>
                                <clipPath id="clip0_40_8715">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span class="pt-1">
                            Brand
                        </span>
                    </a>
                    <a class="relative flex flex-col py-2 px-3  <?php echo lumi_path("account") ? "text-primary-500 dark:text-primary-600 " : "text-gray-600 dark:text-white" ?> " href="<?php echo site_url("/account") ?>">
                        <svg class="mx-auto" class="mr-1.5" width="25" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 25 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="pt-1">
                            Account
                        </span>
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </header>
    <!-- end:header -->
<?php

/**
 * The footer of the Theme.
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


<!-- start:footer -->
<footer id="footer" class="relative bg-primary-500 dark:bg-[#2D2D2D] py-10 text-slate-100 <?php echo wp_is_mobile() ? "md:pb-10 pb-20" : "" ?>">
    <div class="container grid xl:grid-cols-10 gap-4">
        <div class="relative xl:col-span-6">
            <div class="relative w-full grid md:grid-cols-5 gap-6">
                <div class="relative space-y-4 col-span-2">
                    <h2 class="text-base font-semibold">About Lumi</h2>
                    <p class="lead text-sm font-normal text-balance"><?php echo bloginfo("description"); ?></p>
                </div>
                <div class="relative space-y-4">
                    <h2 class="text-base font-semibold">Top Categories</h2>

                    <div class="relative flex flex-col space-y-3 text-sm font-normal">
                        <?php foreach (get_lumi_categories() as $key => $category) : ?>
                            <a href="<?php echo get_term_link($category); ?>">
                                <?php echo ucfirst($category->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="relative space-y-4 pt-10">
                    <div class="relative flex flex-col space-y-3 text-sm font-normal">
                        <a href="<?php echo site_url("/track-order"); ?>">
                            Track Order
                        </a>
                        <a href="<?php echo site_url("/payment"); ?>">
                            Payment
                        </a>
                        <a href="<?php echo site_url("/faq"); ?>">
                            FQA
                        </a>
                        <a href="<?php echo site_url("/contact-us"); ?>">
                            Contact Us
                        </a>
                    </div>
                </div>
                <div class="relative space-y-4 pt-10">
                    <div class="relative flex flex-col space-y-3 text-sm font-normal">
                        <a href="<?php echo site_url("/shipping-and-delivery"); ?>">
                            Shipping & Delivery
                        </a>
                        <a href="<?php echo site_url("/online-returns"); ?>">
                            Online Returns
                        </a>
                    </div>
                </div>
            </div>
            <div class="relative  xl:block md:hidden ">
                <h2 class="text-base font-semibold pt-4">Download Now</h2>
                <div class="relative w-full flex items-center -ml-3 space-x-2">
                    <a href="#"><img class="w-44 h-auto" src="<?php echo url("img/playstore.png"); ?>" alt="Get it on Google Play"></a>
                    <a href="#"><img class="w-36 h-auto" src="<?php echo url("img/applestore.png"); ?>" alt="Get it on App Store"></a>
                </div>
            </div>
        </div>
        <div class="relative xl:col-span-4 h-full flex xl:items-end items-start xl:justify-end justify-between xl:py-0 md:py-8 py-0">
            <div class="relative xl:hidden md:block hidden ">
                <h2 class="text-base font-semibold">Download Now</h2>
                <div class="relative w-full flex lg:flex-row md:flex-col flex-row items-center -ml-3 lg:space-x-2 md:space-x-0 space-x-2">
                    <a href="#"><img class="w-44 h-auto" src="<?php echo url("img/playstore.png"); ?>" alt="Get it on Google Play"></a>
                    <a href="#"><img class="w-36 h-auto" src="<?php echo url("img/applestore.png"); ?>" alt="Get it on App Store"></a>
                </div>
            </div>
            <div class="relative space-y-4 xl:w-full md:w-[60%] w-full">
                <p>Email-exclusive offers and coupon codes for subscribes!</p>
                <div class="relative">
                    <div class="relative border-[1.5px] border-white py-1 lg:px-5 px-2 lg:w-96 w-full h-full overflow-hidden text-slate-100 rounded-xl">
                        <svg class="absolute w-8 left-3 top-[50%] translate-y-[-50%] border-r border-white pr-2" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.1046 4.5H4.35461C3.31908 4.5 2.47961 5.33947 2.47961 6.375V17.625C2.47961 18.6605 3.31908 19.5 4.35461 19.5H20.1046C21.1401 19.5 21.9796 18.6605 21.9796 17.625V6.375C21.9796 5.33947 21.1401 4.5 20.1046 4.5Z" stroke="#F7F8F6" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5.47961 7.5L12.2296 12.75L18.9796 7.5" stroke="#F7F8F6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <form class="relative lg:pl-6 pl-8 overflow-hidden" action="<?php echo site_url("/") ?>" method="GET">
                            <input type="email" name="email" id="email" placeholder="Email" class="lg:pr-24 pr-[100px] text-slate-100 placeholder:text-primary-50 bg-transparent outline-none border-none border-transparent outline-transparent focus:outline-none focus-visible:outline-none focus:ring-transparent w-full">
                        </form>
                        <div class="absolute right-0 top-[50%] translate-y-[-50%] h-full">
                            <div class="relative flex justify-start items-center bg-white w-full px-4 h-full text-primary-500 font-medium">
                                Subscribe
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative flex items-center justify-between md:w-[70%] w-full">
                    <h2 class="text-base font-semibold">Follow Lumi</h2>

                    <div class="relative flex items-center space-x-2">
                        <a href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.9902 1.5957C16.9814 1.48895 15.9675 1.43707 14.9531 1.44043C11.5898 1.44043 9.5 3.58197 9.5 7.03027V9.37109H6.6748C6.3988 9.37091 6.17493 9.59454 6.1748 9.87054V13.7217C6.17462 13.9977 6.39825 14.2215 6.67426 14.2217H9.5V21.9404C9.49982 22.2164 9.72345 22.4402 9.99945 22.4404H13.9775C14.2535 22.4406 14.4774 22.217 14.4775 21.941V14.2217H17.294C17.5452 14.2216 17.7575 14.0353 17.7901 13.7861L18.2872 9.93555C18.3229 9.66187 18.1299 9.41101 17.8562 9.37531C17.8346 9.3725 17.8129 9.37109 17.7911 9.37109H14.4775V7.41211C14.4775 6.44238 14.6729 6.03711 15.8857 6.03711L17.9248 6.03613C18.2008 6.03626 18.4246 5.81268 18.4248 5.53668V2.0918C18.4249 1.84082 18.239 1.62866 17.9902 1.5957ZM17.4248 5.03613L15.8857 5.03711C13.7275 5.03711 13.4775 6.39258 13.4775 7.41211V9.87115C13.4774 10.1471 13.701 10.371 13.977 10.3711H17.2227L16.8545 13.2217H13.9775C13.7015 13.2216 13.4777 13.4451 13.4775 13.7211V21.4404H10.5V13.7217C10.5002 13.4457 10.2766 13.2219 10.0006 13.2217H7.1748V10.3711H10C10.276 10.3713 10.4998 10.1476 10.5 9.87164V7.03027C10.5 4.15625 12.165 2.44043 14.9531 2.44043C15.9619 2.44043 16.873 2.49512 17.4248 2.54297V5.03613Z" fill="#F7F8F6" />
                            </svg>
                        </a>
                        <a href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_40_1714)">
                                    <path d="M2 3.5C3.21818 4.9935 4.73947 6.21147 6.46331 7.07338C8.18715 7.9353 10.0743 8.42156 12 8.5C11.74 7.44 11.72 4.56 13.74 3.36C14.5612 2.8202 15.5176 2.5222 16.5 2.5C17.1411 2.50145 17.775 2.63545 18.3618 2.89359C18.9486 3.15172 19.4757 3.52841 19.91 4C20.9625 3.77597 21.9743 3.39148 22.91 2.86C22.5815 3.93319 21.8696 4.84798 20.91 5.43C21.8258 5.35076 22.7234 5.12804 23.57 4.77C22.9328 5.71942 22.126 6.5432 21.19 7.2C21.9 13.57 16.19 21.49 8.07 21.49C5.43634 21.5044 2.84679 20.8139 0.57 19.49C1.81132 19.6445 3.07106 19.5471 4.27383 19.2034C5.47661 18.8598 6.59769 18.277 7.57 17.49C6.49426 17.4267 5.45722 17.0659 4.57441 16.448C3.6916 15.83 2.9977 14.9791 2.57 13.99C3.57 14.31 4.52 14.47 5.07 13.99C3.94647 13.7041 2.9445 13.0649 2.21174 12.1665C1.47898 11.2681 1.0542 10.1581 1 9C1.33038 9.32303 1.72129 9.57765 2.1503 9.74926C2.57931 9.92086 3.03798 10.0061 3.5 10C2.49376 9.29115 1.78434 8.23604 1.50757 7.03671C1.2308 5.83738 1.40613 4.57811 2 3.5Z" stroke="#F7F8F6" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_40_1714">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                        <a href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.34 5.46C17.1027 5.46 16.8707 5.53038 16.6733 5.66224C16.476 5.79409 16.3222 5.98151 16.2313 6.20078C16.1405 6.42005 16.1168 6.66133 16.1631 6.89411C16.2094 7.12689 16.3236 7.34071 16.4915 7.50853C16.6593 7.67635 16.8731 7.79064 17.1059 7.83694C17.3387 7.88324 17.5799 7.85948 17.7992 7.76866C18.0185 7.67783 18.2059 7.52402 18.3378 7.32668C18.4696 7.12935 18.54 6.89734 18.54 6.66C18.54 6.34174 18.4136 6.03652 18.1885 5.81147C17.9635 5.58643 17.6583 5.46 17.34 5.46ZM21.94 7.88C21.9206 7.0503 21.7652 6.2294 21.48 5.45C21.2257 4.78313 20.83 4.17928 20.32 3.68C19.8248 3.16743 19.2196 2.77418 18.55 2.53C17.7727 2.23616 16.9508 2.07721 16.12 2.06C15.06 2 14.72 2 12 2C9.28 2 8.94 2 7.88 2.06C7.04915 2.07721 6.22734 2.23616 5.45 2.53C4.78168 2.77665 4.17693 3.16956 3.68 3.68C3.16743 4.17518 2.77418 4.78044 2.53 5.45C2.23616 6.22734 2.07721 7.04915 2.06 7.88C2 8.94 2 9.28 2 12C2 14.72 2 15.06 2.06 16.12C2.07721 16.9508 2.23616 17.7727 2.53 18.55C2.77418 19.2196 3.16743 19.8248 3.68 20.32C4.17693 20.8304 4.78168 21.2234 5.45 21.47C6.22734 21.7638 7.04915 21.9228 7.88 21.94C8.94 22 9.28 22 12 22C14.72 22 15.06 22 16.12 21.94C16.9508 21.9228 17.7727 21.7638 18.55 21.47C19.2196 21.2258 19.8248 20.8326 20.32 20.32C20.8322 19.8226 21.2283 19.2182 21.48 18.55C21.7652 17.7706 21.9206 16.9497 21.94 16.12C21.94 15.06 22 14.72 22 12C22 9.28 22 8.94 21.94 7.88ZM20.14 16C20.1327 16.6348 20.0178 17.2637 19.8 17.86C19.6403 18.2952 19.3839 18.6884 19.05 19.01C18.7256 19.3405 18.3332 19.5964 17.9 19.76C17.3037 19.9778 16.6748 20.0927 16.04 20.1C15.04 20.15 14.67 20.16 12.04 20.16C9.41 20.16 9.04 20.16 8.04 20.1C7.38089 20.1123 6.72459 20.0109 6.1 19.8C5.68578 19.6281 5.31136 19.3728 5 19.05C4.66809 18.7287 4.41484 18.3352 4.26 17.9C4.01586 17.2952 3.88044 16.6519 3.86 16C3.86 15 3.8 14.63 3.8 12C3.8 9.37 3.8 9 3.86 8C3.86448 7.35106 3.98295 6.70795 4.21 6.1C4.38605 5.67791 4.65627 5.30166 5 5C5.30381 4.65617 5.67929 4.3831 6.1 4.2C6.70955 3.98004 7.352 3.86508 8 3.86C9 3.86 9.37 3.8 12 3.8C14.63 3.8 15 3.8 16 3.86C16.6348 3.86728 17.2637 3.98225 17.86 4.2C18.3144 4.36865 18.7223 4.64285 19.05 5C19.3777 5.30718 19.6338 5.68273 19.8 6.1C20.0223 6.70893 20.1373 7.35178 20.14 8C20.19 9 20.2 9.37 20.2 12C20.2 14.63 20.19 15 20.14 16ZM12 6.87C10.9858 6.87198 9.99496 7.17453 9.15265 7.73942C8.31035 8.30431 7.65438 9.1062 7.26763 10.0438C6.88089 10.9813 6.78072 12.0125 6.97979 13.0069C7.17886 14.0014 7.66824 14.9145 8.38608 15.631C9.10392 16.3474 10.018 16.835 11.0129 17.0321C12.0077 17.2293 13.0387 17.1271 13.9755 16.7385C14.9123 16.35 15.7129 15.6924 16.2761 14.849C16.8394 14.0056 17.14 13.0142 17.14 12C17.1413 11.3251 17.0092 10.6566 16.7512 10.033C16.4933 9.40931 16.1146 8.84281 15.6369 8.36605C15.1592 7.88929 14.5919 7.51168 13.9678 7.25493C13.3436 6.99818 12.6749 6.86736 12 6.87ZM12 15.33C11.3414 15.33 10.6976 15.1347 10.15 14.7688C9.60234 14.4029 9.17552 13.8828 8.92348 13.2743C8.67144 12.6659 8.6055 11.9963 8.73398 11.3503C8.86247 10.7044 9.17963 10.111 9.64533 9.64533C10.111 9.17963 10.7044 8.86247 11.3503 8.73398C11.9963 8.6055 12.6659 8.67144 13.2743 8.92348C13.8828 9.17552 14.4029 9.60234 14.7688 10.15C15.1347 10.6976 15.33 11.3414 15.33 12C15.33 12.4373 15.2439 12.8703 15.0765 13.2743C14.9092 13.6784 14.6639 14.0454 14.3547 14.3547C14.0454 14.6639 13.6784 14.9092 13.2743 15.0765C12.8703 15.2439 12.4373 15.33 12 15.33Z" fill="#F7F8F6" />
                            </svg>
                        </a>
                        <a href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.50061 9.00001C7.50037 9.00001 7.50079 9.00001 7.50061 9.00001H3.5C3.224 8.99982 3.00018 9.22346 3 9.4994C3 9.49921 3 9.49964 3 9.4994V21.5C2.99982 21.776 3.22345 21.9998 3.49939 22C3.49921 22 3.49964 22 3.49939 22H7.5C7.776 22.0002 7.99982 21.7766 8 21.5006C8 21.5004 8 21.5007 8 21.5006V9.50001C8.00018 9.22401 7.77655 9.00019 7.50061 9.00001ZM7 21H4V10H7V21ZM18 9.00001C16.9152 9.00007 15.8607 9.3581 15 10.0186V9.50001C15.0002 9.22401 14.7766 9.00019 14.5006 9.00001C14.5004 9.00001 14.5008 9.00001 14.5006 9.00001H10.5C10.224 8.99982 10.0002 9.22346 10 9.4994C10 9.49921 10 9.49964 10 9.4994V21.5C9.99982 21.776 10.2235 21.9998 10.4995 22C10.4993 22 10.4996 22 10.4995 22H14.5C14.776 22.0002 14.9998 21.7766 15 21.5006C15 21.5004 15 21.5007 15 21.5006V16C15 15.1716 15.6716 14.5 16.5 14.5C17.3284 14.5 18 15.1716 18 16V21.5C17.9998 21.776 18.2235 21.9998 18.4995 22C18.4993 22 18.4996 22 18.4995 22H22.5C22.776 22.0002 22.9998 21.7766 23 21.5006C23 21.5004 23 21.5007 23 21.5006V14C22.9968 11.2399 20.7601 9.00324 18 9.00001ZM22 21H19V16C19 14.6193 17.8807 13.5 16.5 13.5C15.1193 13.5 14 14.6193 14 16V21H11V10H14V11.2031C14 11.4156 14.1344 11.6048 14.335 11.6748C14.5352 11.747 14.759 11.6828 14.8907 11.5156C16.2532 9.78882 18.7576 9.4936 20.4844 10.8562C21.4463 11.6152 22.0053 12.7747 22 14V21ZM5.86798 2.00184C5.75037 1.9936 5.63233 1.99299 5.51465 2.00001C4.00537 1.89692 2.6983 3.03687 2.59522 4.54615C2.59107 4.60688 2.58899 4.66767 2.58887 4.72852C2.57587 6.22498 3.77844 7.44861 5.2749 7.46162C5.336 7.46216 5.39704 7.46058 5.45801 7.45698H5.48633C6.99274 7.56238 8.29932 6.42664 8.40473 4.92023C8.51013 3.41382 7.37439 2.10724 5.86798 2.00184ZM5.83344 6.45985C5.71796 6.47047 5.60162 6.46955 5.48633 6.45698H5.45801C4.50189 6.53046 3.6673 5.81501 3.59381 4.85889C3.52033 3.90284 4.23578 3.06818 5.1919 2.9947C5.29944 2.98646 5.40747 2.98823 5.51465 3.00001C6.47003 2.91199 7.31592 3.61512 7.40399 4.5705C7.49201 5.52595 6.78888 6.37183 5.83344 6.45985Z" fill="#F7F8F6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end:footer -->

<?php wp_footer(); ?>

</body>

</html>
<?php

namespace AwesomeCoder\Lumi\Core;

class LumiAjaxController
{
    /**
     * Handle the wishlist for functionality.
     *
     * @since    1.0.0
     */
    public function wishlist()
    {
        try {
            $request = json_decode(file_get_contents('php://input'));
            // $product_id = $request->product_id;
            $product_id = $_REQUEST["product_id"];
            // global $woocommerce;
            // echo $woocommerce->cart->cart_contents_count;
            // $user =  wp_get_current_user()->data;

            // send not allowed error
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                return lumi_response([
                    "success" => false,
                    "message" => __('Method Not Allowed.', 'lumi'),
                ], 405);
            }

            // send not allowed error
            if (!$product_id) {
                return lumi_response([
                    "success" => false,
                    "message" => __('Unacceptable Entries.', 'lumi'),
                    "errors"  => [
                        "product_id" => [
                            "Product ID can't be empty!"
                        ]
                    ]
                ], 422);
            }


            // $items = [];
            // foreach (range(1, 10) as $key => $item) {
            //     $session_wishlist = isset($_SESSION["lumi_wishlist"]) ? $_SESSION["lumi_wishlist"] : [];
            //     $items[] = $item;
            // }
            // $_SESSION["lumi_wishlist"] = $items;
            // $_SESSION["lumi_wishlist"] = [33, 34, 26];

            // get wishlist
            $session_wishlist = isset($_SESSION["lumi_wishlist"]) && is_array($_SESSION["lumi_wishlist"]) ? $_SESSION["lumi_wishlist"] : [];

            if (is_user_logged_in()) {
                $user_id = get_current_user_id();
                $wishlist = get_option("lumi_wishlist_$user_id", $session_wishlist);
                $wishlist = array_values($wishlist);
                $wishlist = array_unique(array_merge($wishlist, $session_wishlist));
                $wishlist = is_array($wishlist) ? $wishlist : $session_wishlist;

                if (in_array($product_id, $wishlist)) {
                    unset($wishlist[array_search($product_id, $wishlist)]);
                    $new_wishlist = array_unique($wishlist);
                } else {
                    $new_wishlist = array_unique(array_merge([$product_id], $wishlist));
                }

                $new_wishlist = array_values($new_wishlist);
                update_option("lumi_wishlist_$user_id", $new_wishlist);
            } else {
                if (in_array($product_id, $session_wishlist)) {
                    unset($session_wishlist[array_search($product_id, $session_wishlist)]);
                    $new_wishlist = array_unique($session_wishlist);
                } else {
                    $new_wishlist = array_unique(array_merge([$product_id], $session_wishlist));
                }

                $new_wishlist = array_values($new_wishlist);
            }

            // set session wishlist
            $_SESSION["lumi_wishlist"] = $new_wishlist;

            return lumi_response([
                "message" => __("Successfully updated to wishlist.", "lumi"),
                "data"    => [
                    "wishlist" => $new_wishlist,
                    // "request" => $_REQUEST,
                    // "wishlist" => $wishlist,
                    // "user" => $user,
                    // "woocommerce" => $woocommerce
                ]
            ]);
        } catch (\Exception $e) {
            return lumi_response([
                "success" => false,
                "message" => $e->getMessage(),
            ], 405);
        }
    }
}

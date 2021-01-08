<?php


namespace Mirele\Network;

use Mirele\Compound\Response;
use Mirele\Framework\Inter;
use Mirele\Framework\Request;


# Endpoint to save or update options
# Endpoint Version: 1.0.0
# Distributors: Axios
class Request_WCAddToCart extends Request
{

    /**
     * The __invoke method is used to compile (if necessary) and process a request with the transferred parameters.
     * The query object also supports working with the 'handler' method, but its use is not recommended.
     *
     * PHPDOC: The __invoke method is called when a script tries to call an object as a function.
     *
     * @param $request array $_REQUEST
     * @return object|array|Response|boolean|string
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(array $request)
    {

        # Parse params
        $ID = abs((MIRELE_POST)['product_id']);
        $QTY = abs((MIRELE_POST)['product_quantity']);
        $VariationID = abs((MIRELE_POST)['product_variation_id']);
        $VariationAttr = (MIRELE_POST)['product_variation'];

        # Checking if it is possible to add the goods to the cart.
        if (apply_filters('woocommerce_add_to_cart_validation', true, $ID, $QTY))
        {

            # Create cart
            $CartItem = WC()->cart->add_to_cart($ID, $QTY, $VariationID, $VariationAttr);

            if ($CartItem)
            {

                do_action('woocommerce_ajax_added_to_cart', $ID);

                if ('yes' === get_option('woocommerce_cart_redirect_after_add'))
                {
                    wc_add_to_cart_message(array($ID => $QTY), true);
                }

                return new Response([
                    'id' => $CartItem
                ], 200
                );

            } else
            {

                return new Response([
                    'error' => 'This product was not added to the cart.'
                ], 500
                );

            }

        }

        return new Response([], 500);

    }


}

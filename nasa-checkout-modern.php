<?php
/**
 * Checkout Form: Layout - Modern
 */
if (!defined('ABSPATH')) {
    exit;
}

// If checkout registration is disabled and not logged in, the user cannot checkout
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) :
    /**
     * Hook Login form
     */
    do_action('woocommerce_before_checkout_form', $checkout);
    
    echo apply_filters('woocommerce_checkout_must_be_logged_in_message', esc_html__('You must be logged in to checkout.', 'elessi-theme'));
    return;
endif;

// $need_shipping = 'no' !== get_option('woocommerce_enable_shipping_calc') && WC()->cart->needs_shipping() ? true : false;
?>

<!-- Checkout BG -->
<div class="checkout-modern-bg hide-for-mobile">
    <div class="checkout-modern-bg-left"></div>
    <div class="checkout-modern-bg-right"></div>
</div>

<div class="row">
    
    <!-- Checkout Wrap -->
    <div class="checkout-modern-wrap large-12 columns">
        
        <!-- Checkout Left -->
        <div class="checkout-modern-left-wrap">
            <!-- Checkout Logo -->
            <div class="mobile-text-center">
                <?php echo elessi_logo(); ?>
            </div>
            
            <!-- Checkout Mobile Your Order -->
            <a href="javascript:void(0);" class="hidden-tag your-order-mobile" rel="nofollow">
                <span class="your-order-title">
                    <i class="nasa-icon icon-nasa-cart-3 margin-right-10 rtl-margin-right-0 rtl-margin-left-10"></i><?php echo esc_html__('Your Order', 'elessi-theme'); ?><i class="nasa-icon icon-nasa-icons-10 margin-left-10 rtl-margin-left-0 rtl-margin-right-10"></i>
                </span>
                <span class="your-order-price"></span>
            </a>
            
            <!-- Checkout Breadcrumb -->
            <nav class="nasa-bc-modern">
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php echo esc_attr__('CART', 'elessi-theme'); ?>"><?php echo esc_html__('CART', 'elessi-theme'); ?></a>
                <i class="nasa-bc-modern-sp"></i>
                
                <a href="javascript:void(0);" title="<?php echo esc_attr__('INFORMATION', 'elessi-theme'); ?>" rel="nofollow" class="nasa-billing-step active"><?php echo esc_html__('INFORMATION', 'elessi-theme'); ?></a>
                <i class="nasa-bc-modern-sp"></i>
                
                <?php // if ($need_shipping) : ?>
                <a href="javascript:void(0);" title="<?php echo esc_attr__('SHIPPING', 'elessi-theme'); ?>" rel="nofollow" class="nasa-shipping-step"><?php echo esc_html__('SHIPPING', 'elessi-theme'); ?></a>
                <i class="nasa-bc-modern-sp"></i>
                <?php // endif; ?>
                
                <a href="javascript:void(0);" title="<?php echo esc_attr__('PAYMENT', 'elessi-theme'); ?>" rel="nofollow" class="nasa-payment-step"><?php echo esc_html__('PAYMENT', 'elessi-theme'); ?></a>
            </nav>

            <?php do_action('woocommerce_before_checkout_form', $checkout); ?>
            
            <!-- Checkout Form -->
            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
                <?php
                $fields = $checkout->get_checkout_fields();
                if ($fields) :
                    
                    do_action('woocommerce_checkout_before_customer_details');
                    
                    $billing_fields = isset($fields['billing']) ? $fields['billing'] : null;
                    $email_fields = isset($billing_fields['billing_email']) ? $billing_fields['billing_email'] : null;
                    
                    if ($email_fields || (!is_user_logged_in() && $checkout->is_registration_enabled())) : ?> 
                        <!-- Custom Contact Information -->
                        <div class="checkout-group checkout-contact margin-bottom-10 clearfix" id="ns-checkout-contact">
                            <h3>
                                <?php echo esc_html__('Contact information', 'elessi-theme'); ?>
                            </h3>
                            <div class="form-row-wrap">
                                <p class="form-row form-row-wide nasa-email-field">
                                    <label for=""><?php echo esc_html__('Email address', 'elessi-theme'); ?>&nbsp;</label>
                                    <span class="woocommerce-input-wrapper">
                                        <input type="email" class="input-text" placeholder="Email address" value="" disabled />
                                    </span>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- (Escrito entre el 21/11/23 ~ 2024 por LxingA [v1]) para la Obtención de Información de una Tienda CR vía Ajax
                    <script type="text/javascript">
                        const $__fn=() => $('[name^="billing_"]')["each"]((_,$__el) => {
                            ($($__el)["attr"]("name")!=="billing_country") && $($__el)["val"]("");
                        });
                        $(document)["ready"](() => $__fn());
                        const $__init__= $v__value__ => {
                        if($v__value__["length"] >= 9 && /^10[A-Z]{2,3}50[A-Z0-9]{3,4}$/["test"]($v__value__)){
                            $["ajax"]({
                                url:"/wp-func/wp-shop-v1.php?cr="+$v__value__,
                                method:"GET",
                                cache:true,
                                async:true,
                                success: $__data__ => {
                                    const $__instance__ = JSON["parse"]($__data__);
                                    if($__instance__["st"]){
                                        $("#customer_custom_field_title")["hide"]();
                                            Object["values"]($__instance__["py"])["forEach"]($__it__ => {
                                                $(`#${$__it__["input"]}`)["addClass"]("has-content")["val"]($__it__["value"]);
                                                    if($__it__["input"] == "billing_state") setTimeout(() => $($('span[class="select2-selection__rendered"]')[0])["attr"]("title",$__it__["value"])["html"]($__it__["value"]),1000);
                                                    });
                                                    }else{
                                                        $__fn();$("#customer_custom_field_title")["show"]();}
                                                    }
                            });
                        }else if($v__value__["length"] === 0){
                            $__fn();$("#customer_custom_field_title")["hide"]();
                        }
                    };</script>
                    <div class="checkout-group woo-billing clearfix">
                        <h3>
                            Información de la Tienda
                        </h3>
                        <div class="form-row-wrap">
                            <p class="form-row form-row-wide nasa-shop-field">
                                <label for="">ID Tienda</label>
                                <span class="woocommerce-input-wrapper">
                                    <input onchange="$__init__(this.value)" type="search" class="input-text" placeholder="Busca ID de Tienda"/>
                                </span>
                            </p>
                        </div>
                    </div>
                    -->

                    <!-- [S - 15/05/24] Obtención de Información de Tiendas mediante un CR para Mutar el DOM [LxingA ~ v2 ~ docs.lxinga.dev] -->
                    <script async type="text/javascript">
                        const _ea206bb4_ = {
                            fdda901ee(p59042759){
                                p59042759["innerHTML"] = "";
                                p59042759["style"]["display"] = "none";
                                document["querySelectorAll"]("input[name^='billing_'],input[name^='shipping_']")["forEach"](v9018cc34 => {
                                    if(v9018cc34["name"] != "billing_email") v9018cc34["value"] = "";
                                });
                            },
                            f1c6a7c64(paea34913,pa0291ac1){
                                _ea206bb4_["fdda901ee"](pa0291ac1["parentElement"]["parentElement"]);
                                const _3b384e9f_ = document["getElementById"]("d82832d7");
                                _3b384e9f_["value"] = (/^[0-9]+/["test"](paea34913["billing_first_name"])) ? paea34913["billing_first_name"] : `${paea34913["billing_first_name"]} ${paea34913["billing_last_name"]}`;
                                document["querySelector"]("input[id='ship-to-different-address-checkbox']")["checked"] = true;
                                document["querySelector"](".shipping_address")["style"]["display"] = "block";
                                Object["keys"](paea34913)["forEach"]((pdb735814,p09726094) => {
                                    const _bb987d0b_ = document["querySelector"](`input[name^="${pdb735814}"]`);
                                    const _f14cc786_ = (Object["values"](paea34913)[p09726094]);
                                    if(_bb987d0b_ && !(["billing_email"]["includes"](pdb735814))) _bb987d0b_["value"] = _f14cc786_;
                                    else if(/\_state$/["test"](pdb735814)) document["querySelectorAll"]("label[for$='_state']")["forEach"](v7e3a8971 => {
                                        const _4f5fcfd6_ = v7e3a8971["parentElement"]["children"][1]["children"];
                                        _4f5fcfd6_[1]["children"][0]["children"][0]["children"][0]["innerHTML"] = _f14cc786_;
                                        _4f5fcfd6_[0]["value"] = _f14cc786_;
                                    });
                                });
                            }
                        };
                        const fbc451c53 = (async f3bae0aa7 => {
                            const _959c3422_ = (document["getElementById"]("44c8f818"));
                            if(f3bae0aa7["value"]["length"] >= 2){
                                const _3b978f9f_ = (await fetch("/wp-func/wp-shop-v2.php",{
                                    mode: "cors",
                                    method: "post",
                                    cache: "force-cache",
                                    headers: {
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON["stringify"]({
                                        r8a90aba9: f3bae0aa7["value"]["trim"]()
                                    })
                                }));
                                if((!_3b978f9f_["ok"]) || (_3b978f9f_["status"] != 200)) _ea206bb4_["fdda901ee"](_959c3422_);
                                else{
                                    const {a7b1311b0,ac449079b} = (await _3b978f9f_["json"]());
                                    const _a8adabec_ = Object["values"](a7b1311b0);
                                    if(ac449079b && _a8adabec_["length"] > 0){
                                        _959c3422_["innerHTML"] = "<div class=\"list\"/>";
                                        _959c3422_["style"]["display"] = "block";
                                        _a8adabec_["forEach"]((_3aa74ce6_,_8a90aba9_) => {
                                            _959c3422_["children"][0]["innerHTML"] += `
                                                <div style="cursor:pointer;" onclick='_ea206bb4_["f1c6a7c64"](${JSON["stringify"](_3aa74ce6_)},this)' class="l-result">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <div class="dtss">
                                                        <strong>
                                                            ${_3aa74ce6_["billing_first_name"]} ${_3aa74ce6_["billing_last_name"]}
                                                        </strong>
                                                        <span>
                                                            ${_3aa74ce6_["billing_email"]}
                                                        </span>
                                                    </div>
                                                </div>
                                            `;
                                        });
                                    }else _ea206bb4_["fdda901ee"](_959c3422_);
                                }
                            }else if(f3bae0aa7["value"]["length"] <= 0) _ea206bb4_["fdda901ee"](_959c3422_);
                        });
                        const f6e9257a7 = (({p0104fa6d,p7a1df772,p89a48e50,p95a355a1}) => {
                            if(!document["getElementById"](p89a48e50["id"])){
                                let _41405e39_ = (document["createElement"](p0104fa6d));
                                (Object["keys"](p89a48e50)["forEach"]((_8a90aba9_,_e5868a15_) => {
                                    const _3aa74ce6_ = (Object["values"](p89a48e50)[_e5868a15_]);
                                    if(_8a90aba9_ == "class") _41405e39_["classList"]["add"](_3aa74ce6_);
                                    else _41405e39_[_8a90aba9_] = _3aa74ce6_;
                                }));
                                switch(p7a1df772){
                                    case "head":
                                        document[p7a1df772]["appendChild"](_41405e39_);
                                    break;
                                    default:
                                        _41405e39_["innerHTML"] = p95a355a1;
                                        document["getElementById"]("c7a2ec1b")["appendChild"](_41405e39_);
                                    break;
                                }
                            }
                        });
                        (f6e9257a7({
                            p0104fa6d: "link",
                            p7a1df772: "head",
                            p89a48e50: {
                                id: "9f584f57",
                                rel: "stylesheet",
                                href: "/wp-func/wp-shop-v2.css?key=4e6a535b",
                                type: "text/css"
                            }
                        }));
                        (document["getElementById"]("9f584f57")["onload"] = () => f6e9257a7({
                            p0104fa6d: "div",
                            p7a1df772: "c7a2ec1b",
                            p89a48e50: {
                                class: "oxxo-inputbyplthmnz"
                            },
                            p95a355a1: `
                                <div class="ctn-input">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <input id="d82832d7" type="search" onkeyup="fbc451c53(this)" placeholder="Buscar la ID de la Tienda"/>
                                </div>
                                <div id="44c8f818" class="ctn-results" style="display:none;"/>
                            `
                        }));
                    </script>
                    <div class="checkout-group woo-billing clearfix">
                        <h3>
                            Información de la Tienda
                        </h3>
                        <div class="form-row-wrap" id="c7a2ec1b"/>
                    </div>
                    <!-- [E] -->
                    </br>

                    <div class="checkout-group woo-billing clearfix">
                        <div id="customer_details">
                            <?php if ('shipping' === get_option('woocommerce_ship_to_destination')) : ?>
                                <div class="ns-shipping-first">
                                    <h3>
                                        <?php echo esc_html__('Shipping address', 'elessi-theme'); ?>
                                    </h3>
                                    <?php do_action('woocommerce_checkout_shipping'); ?>
                                    <?php do_action('woocommerce_checkout_billing'); ?>
                                </div>
                            <?php else : ?>
                                <?php do_action('woocommerce_checkout_billing'); ?>
                                <?php do_action('woocommerce_checkout_shipping'); ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php do_action('woocommerce_checkout_after_customer_details'); ?>
                <?php endif; ?>
            </form>

            <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
        </div>

        <!-- Checkout Right -->
        <div class="checkout-modern-right-wrap">
            <a href="javascript:void(0);" class="hidden-tag close-your-order-mobile nasa-stclose" rel="nofollow"></a>
            
            <?php
            /**
             * Custom action
             */
            do_action('nasa_checkout_before_order_review');
            ?>

            <div class="order-review order-review-modern">
                <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

                <h3 id="order_review_heading" class="order_review-heading">
                    <?php esc_html_e('Your order', 'elessi-theme'); ?>
                </h3>

                <?php do_action('woocommerce_checkout_before_order_review'); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action('woocommerce_checkout_order_review'); ?>
                </div>

                <?php do_action('woocommerce_checkout_after_order_review'); ?>
            </div>

            <?php
            /**
             * Custom action
             */
            do_action('nasa_checkout_after_order_review');
            ?>
        </div>
    </div>
</div>

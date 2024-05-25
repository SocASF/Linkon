<?php
if (!isset($nasa_opt)) :
    global $nasa_opt;
endif;

global $product;

$columnImage = '6';
$columnInfo = '6';

if ($nasa_opt['product_image_layout'] != 'single') {
    if ($nasa_opt['product_image_style'] === 'slide') {
        $columnImage = '8';
        $columnInfo = '4';
    } else {
        $columnImage = '7';
        $columnInfo = '5';
    }
}

$dots = isset($nasa_opt['product_slide_dot']) && $nasa_opt['product_slide_dot'] ? 'true' : 'false';
?>

<div id="product-<?php echo (int) $product->get_id(); ?>" <?php post_class(); ?>>
    <?php if ($nasa_actsidebar && $nasa_sidebar != 'no') : ?>
        <div class="nasa-toggle-layout-side-sidebar nasa-sidebar-single-product <?php echo esc_attr($nasa_sidebar); ?>">
            <div class="li-toggle-sidebar">
                <a class="toggle-sidebar-shop nasa-tip" data-tip="<?php echo esc_attr__('Filters', 'elessi-theme'); ?>" href="javascript:void(0);" rel="nofollow">
                    <i class="nasa-icon pe7-icon pe-7s-menu"></i>
                </a>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="nasa-row nasa-product-details-page modern nasa-layout-new">
        <div class="<?php echo esc_attr($main_class); ?>" data-num_main="<?php echo ($nasa_opt['product_image_layout'] == 'double') ? '2' : '1'; ?>" data-num_thumb="<?php echo ($nasa_opt['product_image_layout'] == 'double') ? '4' : '6'; ?>" data-speed="300" data-dots="<?php echo $dots; ?>">

            <div class="row focus-info">
                <div class="large-<?php echo esc_attr($columnImage); ?> small-12 columns product-gallery rtl-right"> 
                    <?php do_action('woocommerce_before_single_product_summary'); ?>
                </div>
                
                <div class="large-<?php echo esc_attr($columnInfo); ?> small-12 columns product-info summary entry-summary rtl-left">
                    <div class="nasa-product-info-wrap">
                        <div class="nasa-product-info-scroll">
                            <?php do_action('woocommerce_single_product_summary'); ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php do_action('woocommerce_after_single_product_summary'); ?>

        </div>

        <?php if ($nasa_actsidebar && $nasa_sidebar != 'no') : ?>
            <div class="<?php echo esc_attr($bar_class); ?>">
                <a href="javascript:void(0);" title="<?php echo esc_attr__('Close', 'elessi-theme'); ?>" class="hidden-tag nasa-close-sidebar" rel="nofollow">
                    <?php echo esc_html__('Close', 'elessi-theme'); ?>
                </a>
                
                <div class="nasa-sidebar-off-canvas">
                    <?php dynamic_sidebar('product-sidebar'); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<!-- [S - 22/05/24] Definición de las Entradas para el Ingreso de los Números de Empleados [LxingA ~ v1 ~ docs.lxinga.dev] -->
<script async type="text/javascript">
    const _aea34913_ = (document["querySelector"](".nasa-product-info-scroll"))["children"][2]["children"][0]["children"];
    const _51ec4ccd_ = (document["querySelector"](".quantity"));
    const _ac5cff7e_ = (_51ec4ccd_["children"][2]);
    const _e3d7135e_ = (document["getElementById"](_ac5cff7e_["id"]));
    const _3a06ac3d_ = (document["getElementsByName"]("add-to-cart")[0]);
    const _bf396750_ = [];
    const _53865e0c_ = [[]];
    const _3aa74ce6_ = {};
    let _7dabfedf_ = 0;
    if(sessionStorage["getItem"]("_d1ccd9d1_")) _7dabfedf_ = (Number(sessionStorage["getItem"]("_d1ccd9d1_")));
    else sessionStorage["setItem"]("_d1ccd9d1_",_7dabfedf_);
    const _a287426f_ = (new MutationObserver((_959c3422_) => {
        for(let _8a90aba9_ of _959c3422_){
            if(_8a90aba9_["attributeName"] == "class"){
                if(_3a06ac3d_["classList"]["contains"]("loading")){
                    sessionStorage["setItem"]("_d1ccd9d1_",((Number(sessionStorage["getItem"]("_d1ccd9d1_")) + 1)));
                    _53865e0c_["push"]([]);
                }
            }
        }
    }));
    _a287426f_["observe"](_3a06ac3d_,{attributes:true});
    if(_aea34913_["length"] > 0) for(let _8a90aba9_ = 0; _8a90aba9_ <= (_aea34913_["length"] - 1); _8a90aba9_++){
        if(_aea34913_[_8a90aba9_]["getAttribute"]("data-product-name")) _bf396750_["push"](_aea34913_[_8a90aba9_]["children"][1]["children"][0]["id"]);
    }if(_bf396750_["length"] > 0 && _e3d7135e_){
        const _4fa487e1_ = (_51ec4ccd_["children"][(_51ec4ccd_["children"]["length"] - 1)]);
        _4fa487e1_["onclick"] = ((_3bae0aa7_) => {
            let _dcf3340b_ = (_3bae0aa7_["target"]["parentElement"]["children"]["2"]["value"] - 1);
            let _91db9855_ = (document["getElementById"](_bf396750_[_dcf3340b_]));
            if(_91db9855_){
                let _a0434671_ = (JSON["parse"](_91db9855_["getAttribute"]("data-restrictions")));
                delete _a0434671_["required"];
                _91db9855_["setAttribute"]("data-restrictions",(JSON["stringify"](_a0434671_)));
                _91db9855_["removeAttribute"]("data-display-state");
                _91db9855_["value"] = "";
                _91db9855_["focus"]();
                _91db9855_["parentElement"]["parentElement"]["style"]["display"] = "none";
            }
        });
        _3a06ac3d_["onclick"] = ((_3bae0aa7_) => {
            const _4b1efc02_ = [];
            const _2804a4ea_ = (_ac5cff7e_["value"]);
            _bf396750_["forEach"]((_c252057c_,_e5868a15_) => {
                const _41405e39_ = (document["getElementById"](_c252057c_));
                if(_41405e39_ && (/^[0-9]+$/["test"](_41405e39_["value"]))) _53865e0c_[Number(sessionStorage["getItem"]("_d1ccd9d1_"))][_e5868a15_] = _41405e39_["value"];
                else _53865e0c_[Number(sessionStorage["getItem"]("_d1ccd9d1_"))][_e5868a15_] = null;
                if(_e5868a15_ >= 1 && (_41405e39_["getAttribute"]("data-display-state") && _41405e39_["value"]["length"] == 0)) _4b1efc02_["push"](_41405e39_);
            });
            _3aa74ce6_[_3a06ac3d_["value"]] = _53865e0c_;
            _3a06ac3d_["setAttribute"]("data-quantity",(_2804a4ea_ - _4b1efc02_["length"]));
            _ac5cff7e_["value"] = (_2804a4ea_ - _4b1efc02_["length"]);
            _4b1efc02_["forEach"]((_aea34913_) => {
                _aea34913_["removeAttribute"]("data-display-state");
                _aea34913_["parentElement"]["parentElement"]["style"]["display"] = "none";
            });
            localStorage["setItem"]("_547a1b34_",(JSON["stringify"](_3aa74ce6_)));
        });
        _bf396750_["forEach"]((_c252057c_,_77eddc6c_) => {
            let _41405e39_ = (document["getElementById"](_c252057c_));
            if(_77eddc6c_ >= 1 && _41405e39_) _41405e39_["parentElement"]["parentElement"]["style"]["display"] = "none";
        });_e3d7135e_["onchange"] = ((_3bae0aa7_) => {
            for(let _dcf3340b_ = 0; _dcf3340b_ <= (_3bae0aa7_["target"]["value"] - 1); _dcf3340b_++){
                let _4591765b_ = (document["getElementById"](_bf396750_[_dcf3340b_]));
                if(_4591765b_){
                    let _a8adabec_ = (JSON["parse"](_4591765b_["getAttribute"]("data-restrictions")));
                    _a8adabec_["required"] = "yes";
                    _4591765b_["setAttribute"]("data-restrictions",(JSON["stringify"](_a8adabec_)));
                    _4591765b_["setAttribute"]("data-display-state","show");
                    _4591765b_["parentElement"]["parentElement"]["style"]["display"] = "block";
                };
            }
        });
    }
</script>
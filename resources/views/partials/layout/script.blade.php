<!--Gem_Page_Footer_Script-->
<!-- "snippets/gem-app-footer-scripts.liquid" was not rendered, the associated app was uninstalled -->
<!--End_Gem_Page_Footer_Script-->
<!--begin-bc-sf-filter-js-->
<script>
    /* Declare bcSfFilterConfig variable */
    var bcSfFilterMainConfig = {
        api: {
            filterUrl: "https://services.mybcapps.com/bc-sf-filter/filter",
            searchUrl: "https://services.mybcapps.com/bc-sf-filter/search",
            suggestionUrl: "https://services.mybcapps.com/bc-sf-filter/search/suggest",
        },
        shop: {
            name: "StayCool Socks",
            url: "https://www.staycoolsocks.com",
            domain: "staycoolsocks.myshopify.com",
            currency: "IDR",
            money_format: "<span class=money>Rp </span>",
        },
        general: {
            file_url: "//cdn.shopify.com/s/files/1/2854/1776/files/?73189",
            asset_url: "//cdn.shopify.com/s/files/1/2854/1776/t/46/assets/bc-sf-filter.js?v=9461338968457068050",
            collection_id: 35785572397,
            collection_handle: "all-products",

            collection_count: 340,

            collection_tags: null,
            current_tags: null,
            default_sort_by: "manual",
            swatch_extension: "png",
            no_image_url: "//cdn.shopify.com/s/files/1/2854/1776/t/46/assets/bc-sf-filter-no-image.gif?v=4551082043989976841",
            search_term: "",
            template: "collection",
            currencies: ["IDR"],
            current_currency: "IDR",
            isInitFilter: true,
        },

        settings: {
            search: {
                enableSuggestion: true,
                productAvailable: true,
                showSuggestionProductVendor: false,
                showSuggestionProductPrice: false,
                showSuggestionProductSalePrice: false,
                showSuggestionProductSku: false,
                showSuggestionProductImage: true,
                suggestionBlocks: [
                    { type: "suggestions", label: "Suggestions", status: "active", number: 5 },
                    { type: "collections", label: "Collections", status: "active", number: 5 },
                    { type: "products", label: "Products", status: "active", number: 5 },
                    { type: "pages", label: "Pages", status: "active", number: 5 },
                ],
            },
            label: { action_list: {}, recentlyViewed: {}, mostPopular: {}, refine: "FILTER", refineMobile: "FILTER" },
            actionlist: {
                qvBtnBackgroundColor: "rgba(255||255||255||1)",
                qvBtnTextColor: "rgba(61||66||70||1)",
                qvBtnBorderColor: "rgba(255||255||255||1)",
                qvBtnHoverBackgroundColor: "rgba(61||66||70||1)",
                qvBtnHoverTextColor: "rgba(255||255||255||1)",
                qvBtnHoverBorderColor: "rgba(61||66||70||1)",
                atcBtnBackgroundColor: "rgba(0||0||0||1)",
                atcBtnTextColor: "rgba(255||255||255||1)",
                atcBtnBorderColor: "rgba(0||0||0||1)",
                atcBtnHoverBackgroundColor: "rgba(61||66||70||1)",
                atcBtnHoverTextColor: "rgba(255||255||255||1)",
                atcBtnHoverBorderColor: "rgba(61||66||70||1)",
                qvAtcMessage: "",
                alStyle: "bc-al-style4",
                qvTitle: "",
                qvEnable: true,
                actTitle: "",
                atcEnable: true,
            },
            recentlyViewed: { recentlyViewedTitle: "", recentlyViewedEnable: false, recentProductSliderRange: 5, limit: 8 },
            mostPopular: { mostPopularTitle: "", mostPopularEnable: true, popularProductSliderRange: 5, limit: 8 },
            labelTranslations: {},
            general: {
                productAndVariantAvailable: false,
                availableAfterFiltering: false,
                activeFilterScrollbar: false,
                showOutOfStockOption: false,
                keepToggleState: true,
                showRefineBy: true,
                changeMobileButtonLabel: true,
                capitalizeFilterOptionValues: true,
                swatchImageVersion: 111144,
                paginationType: "infinite",
                sortingAvailableFirst: true,
                showLoading: true,
                activeScrollToTop: false,
                showSingleOption: false,
                showFilterOptionCount: false,
                customSortingList: "relevance|best-selling|manual|price-ascending|price-descending|title-ascending|title-descending|created-descending|created-ascending",
            },
            style: {
                filterTitleTextColor: "",
                filterTitleFontSize: "",
                filterTitleFontWeight: "",
                filterTitleFontTransform: "",
                filterTitleFontFamily: "",
                filterOptionTextColor: "",
                filterOptionFontSize: "",
                filterOptionFontFamily: "",
                filterMobileButtonTextColor: "",
                filterMobileButtonFontSize: "",
                filterMobileButtonFontWeight: "",
                filterMobileButtonFontTransform: "",
                filterMobileButtonFontFamily: "Futura",
                filterMobileButtonBackgroundColor: "",
            },
        },
    };
    function mergeObject(obj1, obj2) {
        var obj3 = {};
        for (var attr in obj1) {
            obj3[attr] = obj1[attr];
        }
        for (var attr in obj2) {
            obj3[attr] = obj2[attr];
        }
        return obj3;
    }
    if (typeof bcSfFilterConfig !== "undefined") {
        var bcSfFilterConfig = mergeObject(bcSfFilterConfig, bcSfFilterMainConfig);
    } else {
        var bcSfFilterConfig = mergeObject({}, bcSfFilterMainConfig);
    }
</script>

<!-- Include Resources -->
<script defer src="//cdn.shopify.com/s/files/1/2854/1776/t/46/assets/bc-sf-filter-lib.js?v=14735065614893563020"></script>
<script defer src="//cdn.shopify.com/s/files/1/2854/1776/t/46/assets/bc-sf-search.js?v=8748718214988226108"></script>
<!-- Initialize App -->
<script defer src="//cdn.shopify.com/s/files/1/2854/1776/t/46/assets/bc-sf-filter-init.js?v=14211005573704159095"></script>
<script defer src="//cdn.shopify.com/s/files/1/2854/1776/t/46/assets/bc-sf-filter.js?v=9461338968457068050"></script>
<!-- Initialize App -->
<!--end-bc-sf-filter-js-->

<!-- **BEGIN** Hextom USB Integration // Main Include - DO NOT MODIFY -->
<!-- **BEGIN** Hextom USB Integration // Main - DO NOT MODIFY -->
<script type="application/javascript">
    window.hextom_usb = {
        p1: [],
        p2: [],
        p3: {},
    };
</script>
<!-- **END** Hextom USB Integration // Main - DO NOT MODIFY -->
<!-- **END** Hextom USB Integration // Main Include - DO NOT MODIFY -->
<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+62818514333", // WhatsApp number
            line: "//lin.ee/lK9AwEd", // Line QR code URL
            call_to_action: "Customer Service", // Call to action
            button_color: "#000000", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "whatsapp,line", // Order of buttons
        };
        var proto = document.location.protocol,
            host = "getbutton.io",
            url = proto + "//static." + host;
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        s.src = url + "/widget-send-button/js/init.js";
        s.onload = function () {
            WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName("script")[0];
        x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->
<input type="hidden" name="page_handle" class="get_current_page_handle" value="" /><input type="hidden" name="aaaformbuilder_customer_logged_id" value="" id="aaaformbuilder_customer_logged_id" />
<meta id="th_shop_url" content="staycoolsocks.myshopify.com" />
<meta id="th_shop_money" content="Rp " />
<link href="//bundle.thimatic-apps.com/theme_files/th-pb-style.css?v=259" rel="stylesheet" type="text/css" media="all" />
<script src="//bundle.thimatic-apps.com/theme_files/th-pb-script.js?v=259" type="text/javascript"></script>
<!-- **BEGIN** Hextom FSB Integration // Main Include - DO NOT MODIFY -->
<!-- **BEGIN** Hextom FSB Integration // Main - DO NOT MODIFY -->
<script type="application/javascript">
    window.hextom_fsb_meta = {
        p1: [],
        p2: {},
    };
</script>
<!-- **END** Hextom FSB Integration // Main - DO NOT MODIFY -->
<!-- **END** Hextom FSB Integration // Main Include - DO NOT MODIFY -->

<div class="smile-shopify-init" data-channel-key="channel_5lp95dnNfcpzIYfQMMuao5an"></div>

<script type="text/javascript">
    // Non-editable fields
    var empatkali_shop_currency = "IDR";
    var empatkali_shop_money_format = "\u003cspan class=money\u003eRp \u003c\/span\u003e";
    var empatkali_shop_permanent_domain = "staycoolsocks.myshopify.com";
    var empatkali_theme_name = "SPIFF COPY FG_BAK_Prestige [02\/01\/2020]";
    var empatkali_product = null;
    var empatkali_current_variant = null;
    var empatkali_cart_total_price = 0;
    var empatkali_js_snippet_version = "1.0.0";
</script>
<script type="text/javascript" src="https://static.empatkali.co.id/shopify-empatkali.js"></script>

<noscript>
    <style>
        .limoniapps-discountninja-block {
            animation: unset !important;
        }
        .limoniapps-discountninja-block:after {
            animation: unset !important;
        }
        .limoniapps-discountninja-block .limoniapps-discountninja-button-spinner:before {
            animation: unset !important;
        }
    </style>
    <div class="limoniapps-discountninja-warning-nojs">This website uses JavaScript to apply discounts. To be eligible for discounts, please enable JavaScript for your browser.</div>
</noscript>

<script>
    window.discountNinjaContext = {
        Shop: "staycoolsocks.myshopify.com",
        ShopCurrency: "IDR",
        PresentmentCurrency: "IDR",
        EnabledCurrencies: [],
        MoneyFormat: "<span class=money>Rp </span>",
        Customer: null,
        Cart: {
            note: null,
            attributes: {},
            original_total_price: 0,
            total_price: 0,
            total_discount: 0,
            total_weight: 0.0,
            item_count: 0,
            items: [],
            requires_shipping: false,
            currency: "IDR",
            items_subtotal_price: 0,
            cart_level_discount_applications: [],
        },
        Product: null,
        CollectionProducts: [],
        ProductVariants: null,
        Labels: { From: "From", Here: "here", Free: "FREE", SoldOut: "Sold out" },
        Settings: {
            Cart: { QuantitySpinnerMode: "disable" },
            DrawerCart: {},
            Checkout: {
                LoadingCheckoutMessage1: '<div style="display: inline-flex;justify-content: center;align-items: center;"><div class="limoniapps-discountninja-spinner"></div><span style="font-size: 14px"> Loading checkout...</span></div>',
                LoadingCheckoutMessage2:
                    '<div style="display: inline-flex;justify-content: center;align-items: center;"><div class="limoniapps-discountninja-spinner"></div><span style="font-size: 14px"> Preparing secure checkout...</span></div>',
                LoadingCheckoutMessage3:
                    '<div style="display: inline-flex;justify-content: center;align-items: center;"><div class="limoniapps-discountninja-spinner"></div><span style="font-size: 14px"> Redirecting to secure checkout...</span></div>',
                CheckoutMode: "1,1F,N,NF",
                DiscountCumulationMode: "highestwins",
                DiscountCumulationModeCartLevel: "sum",
                SubscriptionProductsMessage: '<span style="color: rgb(255, 0, 0); font-size: 14px;">Discounts cannot be applied at checkout when subscription products are in the cart</span>',
                HideAdditionalCheckoutButtons: true,
                BlockCheckoutButton: true,
            },
            Currency: { MoneyFormat: "<span class=money>Rp \\{\\{amount_no_decimals_with_comma_separator \\}\\}</span>", BaseCurrency: "IDR", BaseCurrencySymbol: "IDR", RoundPrices: false, RoundToCents: 95, ConversionRates: "null" },
            General: { ShowPoweredBy: false, ExitIntentMode: "default" },
            PriceUpdate: {
                PriceFormat: {
                    Other: { Format: "\\{\\{DISCOUNTED_PRICE\\}\\} \\{\\{ORIGINAL_PRICE,STRIKETHROUGH\\}\\}" },
                    Product: { Format: "\\{\\{DISCOUNTED_PRICE\\}\\} \\{\\{ORIGINAL_PRICE,STRIKETHROUGH\\}\\}" },
                    CartProduct: { Format: "\\{\\{DISCOUNTED_PRICE\\}\\} \\{\\{ORIGINAL_PRICE,STRIKETHROUGH\\}\\}" },
                    CartLine: { Format: "\\{\\{DISCOUNTED_PRICE\\}\\} \\{\\{ORIGINAL_PRICE,STRIKETHROUGH\\}\\}" },
                    CartSubtotal: { Format: "\\{\\{DISCOUNTED_PRICE\\}\\} \\{\\{ORIGINAL_PRICE,STRIKETHROUGH\\}\\}" },
                    DrawerCartProduct: { Format: "\\{\\{DISCOUNTED_PRICE\\}\\}" },
                    DrawerCartLine: { Format: "\\{\\{DISCOUNTED_PRICE\\}\\}" },
                    DrawerCartSubtotal: { Format: "\\{\\{DISCOUNTED_PRICE\\}\\} \\{\\{ORIGINAL_PRICE,STRIKETHROUGH\\}\\}" },
                },
                Enable: { Home: true, Product: true, Collection: true, Search: true, Blog: true, Custom: true, Cart: true, DrawerCart: true },
                Mode: {
                    CollectionProductCard: "custom",
                    CollectionProductHandle: "custom",
                    FeaturedProductPrice: "custom",
                    FeaturedProductBanner: "custom",
                    FeaturedProductCard: "custom",
                    FeaturedProductHandle: "custom",
                    CartItemSelector: "custom",
                    CartItemKeySelector: "custom",
                    CartItemKeyAttribute: "custom",
                    DrawerCartItemSelector: "custom",
                    DrawerCartItemKeySelector: "custom",
                    DrawerCartItemKeyAttribute: "custom",
                    DrawerCartRoot: "custom",
                    ReloadPageAfterCartAdjustmentsOnCart: false,
                    ReloadPageAfterCartAdjustments: false,
                },
            },
            StickyBar: {
                AnimationExit: "animated fadeOutUpBig",
                AnimationOnGoal: "animated rubberBand",
                AnimationOnReminder: "animated shake",
                ReminderDuration: 40000,
                AnimateOnEnterIterations: 1,
                Cycle: { DurationMilliseconds: 6000, Mode: "cycle", AnimationOnCyle: "animated fadeOut fadeIn" },
            },
            Notification: {
                Delay: 10000,
                HideMode: "minimize",
                AnimationEnter: "animated fadeInUpBig",
                AnimationEnterMobile: "animated fadeInUpBig",
                AnimationExit: "animated fadeOutDownBig",
                AnimationOnReminder: "animated rubberBand",
                AnimateOnEnterIterations: 1,
                OfferCounterAnimate: false,
                OfferCounter: true,
                MinimizeButton: true,
                ReminderDuration: 40000,
                MinimizeAfterFirstView: true,
            },
            CountdownClock: {
                FormattingTemplateIn_Style1: "{d}[d] [0,1], {\\d}{h}[h] [1,1], {\\h}{m}[m] [2,1] [4,0] {\\m}[s] [3,1]",
                FormattingTemplateIn_Style2: "{d}[d] [0,1], {\\d}{h}[h] [1,1], {\\h}{m}[m] [2,1] [4,0] {\\m}[s] [3,1]",
                FormattingTemplateIn_Style3: "{d}[d] [0,1], {\\d}{h}[h] [1,1], {\\h}{m}[m] [2,1] [4,0] {\\m}[s] [3,1]",
                FormattingTemplateIn_Style4: "[d]d [h]h [m]m [s]s",
                FormattingTemplateIn_Style5: "[d]d [h]h [m]m [s]s",
                FormattingTemplateOnDate: "dddd, MMMM Do YYYY",
                FormattingTemplateOnTime: "h:mmA",
                RestartFrequency: "oncepersession",
            },
            Badge: { HideThirdPartyBadges: true },
            Label: { UseSoldOutLabelProductPage: true, UseSoldOutLabelCollectionPage: true, UseFromLabelCollectionPage: true },
            PromotionSummary: {
                Footer: {
                    Text:
                        '<div style="text-align: right;"><span style="font-size: 16px;">Discounted subtotal: </span><span class="limoniapps-discountninja-cart-subtotal-price">[[SUBTOTAL PLACEHOLDER - USES (DRAWER) CART SUBTOTAL PRICE FORMAT]]</span></div>',
                },
                FooterTextColor: "#000000",
                ShowComments: false,
                HideSubtotal: true,
                HideSubtotalDrawerCart: true,
            },
        },
        Flags: {
            //Version
            Version: "v4.0.1",

            //VariantPriceUpdateRequiresDelay
            //Default: false
            //If set the app waits before updating the variant price after a new variant is selected
            //This is useful if the shop's theme executes JavaScript immediately after a new variant is selected
            //that updates the variant price html
            VariantPriceUpdateRequiresDelay: false,

            //ProductsAreLoadedAsynchronously
            //Default: false
            //If set the app waits for prices on the collection page
            //This is useful if the shop loads products (or prices for products) asynchronously (search and filter apps)
            ProductsAreLoadedAsynchronously: false,

            //ThemeOverridesReloadPageAfterCartAdjustments
            //Default: true
            //Instructs the app to override the ReloadPageAfterCartAdjustments flags based on the default settings of the theme
            ThemeOverridesReloadPageAfterCartAdjustments: true,

            //ReloadPageAfterCartAdjustmentsOnCart
            //Default: true
            //Instructs the app to reload the cart page when a gift has been added to the cart or the rows of a cart are split
            ReloadPageAfterCartAdjustmentsOnCart: true,

            //ReloadPageAfterCartAdjustments
            //Default: true
            //Instructs the app to reload the page when a gift has been added to the cart or the rows of a cart are split
            ReloadPageAfterCartAdjustments: true,

            //CallbackAfterReloadPageForCartAdjustments
            //Default: null
            //Instructs the app to execute a callback after reloading the page when a gift has been added to the cart or the rows of a cart are split
            CallbackAfterReloadPageForCartAdjustments: null,

            //DrawerCartRefreshMethod
            //Default: null
            //Instructs the app to execute this method when a gift has been added to the cart or the rows of a cart are split
            //Example: DrawerCartRefreshMethod: "buildCart(discountNinjaContext.Cart)"
            DrawerCartRefreshMethod: null,

            //EnableAddToCartHook
            //Default: false
            //Instructs the app to replace the implementation of the add to cart button on the product page with logic to capture the event
            EnableAddToCartHook: false,

            //UnregisterThirdPartyCheckoutClickEvents
            //Default: false
            //Instructs the app to remove any event handlers listening to the submit event of checkout forms
            //This can help Discount Ninja to redirect to the advanced checkout when other apps are also subscribed to the submit of the checkout form
            //Note: the event handlers are removed before the app registers its own event handler
            //      other apps can register other event handlers after this
            UnregisterThirdPartyCheckoutClickEvents: false,

            //ReplaceDefaultCheckoutEventsOnButtons
            //Default: false
            //Instructs the app to remove any event handlers listening to the click or touch events of checkout buttons
            //Note: the event handlers are removed before the app registers its own event handler
            //      other apps can register other event handlers after this
            ReplaceDefaultCheckoutEventsOnButtons: false,

            //ReplaceDefaultCheckoutEventsOnLinks
            //Default: true
            //Instructs the app to remove any event handlers listening to the click or touch events of checkout links
            //Note: the event handlers are removed before the app registers its own event handler
            //      other apps can register other event handlers after this
            ReplaceDefaultCheckoutEventsOnLinks: true,

            //CustomCheckoutButton
            //Default: false
            //Instructs the app to hide checkout buttons marked with the limoniapps-discountninja-checkoutbutton-hide css class
            //and show those with the limoniapps-discountninja-checkoutbutton-show css class
            //This can be useful if the standard checkout button is redirecting to the standard checkout because the app
            //is unable to cancel the standard behavior of the checkout button
            CustomCheckoutButton: false,

            //StickyBarShouldPushSelectors
            //Default: null
            //Instructs the app to move custom elements down when the sticky bar is positioned at the top
            //Expects a comma separated list with the jQuery selectors for those elelements.
            //Example: '#fsb_background, .privy-tab-container'
            //StickyBarShouldPushSelectorsDesktop and StickyBarShouldPushSelectorsMobile are also supported
            StickyBarShouldPushSelectors: null,

            //DelayCheckoutMilliseconds
            //Default: 0
            //The app polls Shopify services to ensure the checkout is ready before redirecting.
            //Use this setting to set a delay in milliseconds if the above mentioned system fails (e.g. 500).
            DelayCheckoutMilliseconds: 0,

            //AllowCancelCheckoutByForm
            //Default: true
            //If set to true, this instructs the app to cancel submit events on forms when a Discount Ninja checkout is in progress.
            AllowCancelCheckoutByForm: true,

            //WaitForProductCards
            //Default: false
            //If set to true, this instructs the app to wait for product cards in a collection to be available before changing prices.
            //This helps to show correct prices for dynamically loaded collection pages
            WaitForProductCards: false,

            //SkipWaitForJQuery
            //Default: false
            //If set to false, the app will wait for the theme to load jQuery for a max. of 150ms.
            //If set to true, this instructs the app to load jQuery if a compatible version is not immediately available.
            SkipWaitForJQuery: false,

            //MandatoryCheckboxes
            //Default: null
            //Add a css selector to select the input element that contains the checkbox
            //If set, this instructs the app to check if those checkboxes are checked before proceeding to checkout
            //Example: MandatoryCheckboxes: "input[name='tos-checkbox'] input.tos-checkbox #tos-checkbox-input"
            MandatoryCheckboxes: null,

            //StickyBarRenderingDelay
            //Default: 0
            //Defines the delay (in ms) to render the sticky bar.
            //This flag can help to avoid conflicts with themes where the header height is calculated dynamically.
            StickyBarRenderingDelay: 1000,
        },
        Status: "20",
    };
    window.discountNinjaContext.EnabledCurrencies.push({ Name: "Indonesian Rupiah", IsoCode: "IDR", Symbol: "Rp" });
    window.discountNinjaContext.PrimaryLocale = "en";
</script>

<div id="limoniapps-discountninja-stickybar-template" class="limoniapps-sticky-bar-wrapper" style="display: none;">
    <div class="limoniapps-sticky-bar [[FLAGS]]" data-token="[[TOKEN]]">
        <div class="limoniapps-box" style="min-height: [[HEIGHT]]px;">
            <a class="limoniapps-poweredby limoniapps-stickybar-poweredby limoniapps-poweredby-hidden" target="_blank" href="https://discountninja.io">Powered By Discount Ninja</a>
            <a class="limoniapps-close" data-notify="dismiss">
                <div class="limoniapps-close-x">×</div>
            </a>
            <div class="limoniapps-content [[WIDTH]]" style="min-height: [[HEIGHT]]px;">
                <div class="limoniapps-col-image" style="min-width: [[HEIGHT]]px; min-height: [[HEIGHT]]px;">
                    <div class="limoniapps-image"></div>
                </div>
                <div class="limoniapps-col-info">
                    <div class="limoniapps-info">
                        <div class="limoniapps-message limoniapps-message-body">[[BODY]]</div>
                        <div class="limoniapps-message limoniapps-message-timerfooter">[[TIMER_FOOTER]]</div>
                    </div>
                    <div class="limoniapps-col-actions">
                        <div class="limoniapps-action button1">
                            <button type="button" class="limoniapps-action-btn limoniapps-action-btn-[[ACTIONBUTTON1_STYLE]] [[ACTIONBUTTON1_SIZE]]" data-action="[[ACTIONBUTTON1_ACTION]]">
                                <div class="limoniapps-action-btn-label">[[ACTIONBUTTON1_LABEL]]</div>
                            </button>
                        </div>
                        <div class="limoniapps-action button2">
                            <button type="button" class="limoniapps-action-btn limoniapps-action-btn-[[ACTIONBUTTON2_STYLE]] [[ACTIONBUTTON2_SIZE]]" data-action="[[ACTIONBUTTON2_ACTION]]">
                                <div class="limoniapps-action-btn-label">[[ACTIONBUTTON2_LABEL]]</div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="limoniapps-discountninja-notification-template" style="display: none;">
    <span class="limoniapps-offercount-minimized [[OFFERCOUNT_FLAGS]]" data-token="[[TOKEN]]"></span>
    <div data-notify="container" class="limoniapps-notification [[FLAGS]]" role="alert">
        <span class="limoniapps-offercount"></span>
        <div class="limoniapps-box">
            <div class="limoniapps-notification-buttons">
                <a class="limoniapps-close" data-notify="dismiss">
                    <div class="limoniapps-close-x">×</div>
                </a>
                <div class="limoniapps-minimize">
                    <div class="limoniapps-minimize-min maximized">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            version="1.1"
                            x="0px"
                            y="0px"
                            class="limoniapps-svg-notification-arrow"
                            viewBox="0 0 960 560"
                            enable-background="new 0 0 960 560"
                            xml:space="preserve"
                        >
                            <g>
                                <path
                                    d="M480,344.181L268.869,131.889c-15.756-15.859-41.3-15.859-57.054,0c-15.754,15.857-15.754,41.57,0,57.431l237.632,238.937 c8.395,8.451,19.562,12.254,30.553,11.698c10.993,0.556,22.159-3.247,30.555-11.698l237.631-238.937 c15.756-15.86,15.756-41.571,0-57.431s-41.299-15.859-57.051,0L480,344.181z"
                                ></path>
                            </g>
                        </svg>
                    </div>
                    <div class="limoniapps-minimize-max minimized">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            version="1.1"
                            x="0px"
                            y="0px"
                            class="limoniapps-svg-notification-arrow"
                            viewBox="0 0 960 560"
                            enable-background="new 0 0 960 560"
                            xml:space="preserve"
                        >
                            <g class="limoniapps-svg-notification-arrow-up">
                                <path
                                    d="M480,344.181L268.869,131.889c-15.756-15.859-41.3-15.859-57.054,0c-15.754,15.857-15.754,41.57,0,57.431l237.632,238.937 c8.395,8.451,19.562,12.254,30.553,11.698c10.993,0.556,22.159-3.247,30.555-11.698l237.631-238.937 c15.756-15.86,15.756-41.571,0-57.431s-41.299-15.859-57.051,0L480,344.181z"
                                ></path>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="limoniapps-col-image maximized">
                <div class="limoniapps-image"></div>
            </div>
            <div class="limoniapps-col-info">
                <div class="limoniapps-title maximized">
                    <span class="text-wrapper">[[HEADER]]</span>
                </div>
                <div class="limoniapps-title minimized">
                    <span class="text-wrapper">[[MINIMIZED]]</span>
                </div>
                <div class="limoniapps-message limoniapps-message-body maximized">
                    <span class="text-wrapper">[[BODY]]</span>
                </div>
                <div class="limoniapps-message limoniapps-message-footer maximized">
                    <span class="text-wrapper">[[FOOTER]]</span>
                </div>
                <div class="limoniapps-message limoniapps-message-timerfooter maximized">
                    <span class="text-wrapper">[[TIMER_FOOTER]]</span>
                </div>
                <a class="limoniapps-poweredby limoniapps-notify-poweredby limoniapps-poweredby-hidden maximized" target="_blank" href="https://discountninja.io">Powered By Discount Ninja</a>
            </div>
        </div>
    </div>
</div>
<div id="limoniapps-discountninja-notification-item-template" style="display: none;">
    <div class="limoniapps-body-item" data-offer-token="[[TOKEN]]">
        <div class="limoniapps-col-info">
            <div class="limoniapps-image"></div>
        </div>
        <span class="text-wrapper">[[TEXT]]</span>
    </div>
</div>

<div id="limoniapps-discountninja-popup-template" style="display: none;">
    <div
        data-token="[[TOKEN]]"
        class="limoniapps-popup limoniapps-size-[[SIZE]] limoniapps-overlay-[[BACKGROUNDOVERLAY]] limoniapps-shape-[[SHAPE]] limoniapps-align-[[CONTENTALIGNMENTHORIZONTAL]] limoniapps-action-[[BUTTONPLACEMENT]] limoniapps-content-[[CONTENTALIGNMENTVERTICAL]]"
    >
        <div class="limoniapps-popup-vertical-alignment-helper">
            <div class="limoniapps-popup-vertical-align-center">
                <div class="limoniapps-content">
                    <div class="limoniapps-content-inner">
                        <a class="limoniapps-close" data-notify="dismiss">
                            <div class="limoniapps-close-x">×</div>
                        </a>
                        <div class="limoniapps-body">
                            <a class="limoniapps-poweredby limoniapps-popup-poweredby limoniapps-poweredby-hidden" target="_blank" href="https://discountninja.io">Powered By Discount Ninja</a>
                            <div class="limoniapps-box">
                                <div class="limoniapps-message-header-row">
                                    <div class="limoniapps-message-header">[[HEADER]]</div>
                                </div>
                                <div class="limoniapps-message-body-row">
                                    <div class="limoniapps-message-body">[[BODY]]</div>
                                </div>
                                <div class="limoniapps-message-footer-row">
                                    <div class="limoniapps-message-footer">[[FOOTER]]</div>
                                </div>
                            </div>
                            <div class="limoniapps-footer-inner">
                                <div class="limoniapps-action">
                                    <button type="button" class="limoniapps-action-btn limoniapps-action-btn-1 limoniapps-action-btn-[[ACTIONBUTTON1STYLE]] [[ACTIONBUTTON1SIZE]]" data-action="apply">
                                        <div class="limoniapps-action-btn-label">[[ACTIONBUTTON1LABEL]]</div>
                                    </button>
                                    <button type="button" class="limoniapps-action-btn limoniapps-action-btn-2 limoniapps-action-btn-[[ACTIONBUTTON2STYLE]] [[ACTIONBUTTON2SIZE]]" data-action="learnmore">
                                        <div class="limoniapps-action-btn-label">[[ACTIONBUTTON2LABEL]]</div>
                                    </button>
                                </div>
                                <a class="limoniapps-lnk-dismiss">[[NOTHANKSBUTTONLABEL]]</a>
                            </div>
                        </div>
                    </div>
                    <div class="limoniapps-footer-outer">
                        <div class="limoniapps-action">
                            <button type="button" class="limoniapps-action-btn limoniapps-action-btn-1 limoniapps-action-btn-[[ACTIONBUTTON1STYLE]] [[ACTIONBUTTON1SIZE]]" data-action="apply">
                                <div class="limoniapps-action-btn-label">[[ACTIONBUTTON1LABEL]]</div>
                            </button>
                            <button type="button" class="limoniapps-action-btn limoniapps-action-btn-2 limoniapps-action-btn-[[ACTIONBUTTON2STYLE]] [[ACTIONBUTTON2SIZE]]" data-action="learnmore">
                                <div class="limoniapps-action-btn-label">[[ACTIONBUTTON2LABEL]]</div>
                            </button>
                        </div>
                        <a class="limoniapps-lnk-dismiss">[[NOTHANKSBUTTONLABEL]]</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="limoniapps-discountninja-badge-template" style="display: none;">
    <div class="limoniapps-discountninja-badge [[SIZE]] [[POSITION]]" data-style="[[STYLE]]" data-token="[[TOKEN]]">
        <div class="limoniapps-discountninja-badge-inner">[[TEXT]]</div>
    </div>
</div>

<div id="limoniapps-giftbox-template" style="display: none;">
    <div class="limoniapps-giftbox-button limoniapps-giftbox-button-md limoniapps-giftbox-button-collapsed limoniapps-animation-done [[HASOFFERCOUNT]] [[POSITION]]">
        <div class="limoniapps-giftbox">
            <div class="limoniapps-giftbox-header">
                <!--<a class="limoniapps-giftbox-close">&times;</a>-->
                <div class="limoniapps-header-details">
                    <div class="limoniapps-title">[[HEADER]]</div>
                    <div class="limoniapps-subtitle">
                        <a class="limoniapps-poweredby limoniapps-notify-poweredby limoniapps-poweredby-hidden maximized" target="_blank" href="https://discountninja.io">Powered By Discount Ninja</a>
                    </div>
                </div>
            </div>
            <div class="limoniapps-giftbox-list">
                <div class="limoniapps-list-item-template" style="display: none;">
                    <div class="limoniapps-item-img-container"></div>
                    <div class="limoniapps-item-details">
                        <div class="limoniapps-item-body">[[BODY]]</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="limoniapps-offercount"></div>
        <a class="limoniapps-giftbox-trigger">
            <svg class="limoniapps-icon limoniapps-icon-collapsed" viewBox="0 0 100 100">
                <defs></defs>
                <g id="icon_3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="noun_Gift_797120" transform="translate(19.000000, 19.000000)" fill="currentColor" fill-rule="nonzero">
                        <g id="Group">
                            <path
                                d="M58.9,15.5 L50.22,15.5 C51.77,13.95 52.7,11.78 52.7,9.3 C52.7,4.03 48.67,0 43.4,0 C40.3,0 34.72,2.79 31,6.51 C27.28,2.79 21.7,0 18.6,0 C13.33,0 9.3,4.03 9.3,9.3 C9.3,11.78 10.23,13.95 11.78,15.5 L3.1,15.5 C1.24,15.5 0,16.74 0,18.6 L0,27.28 C0,27.59 0.31,27.9 0.62,27.9 L26.66,27.9 C27.28,27.9 27.9,27.28 27.9,26.66 L27.9,16.74 C27.9,16.12 28.52,15.5 29.14,15.5 L32.86,15.5 C33.48,15.5 34.1,16.12 34.1,16.74 L34.1,26.66 C34.1,27.28 34.72,27.9 35.34,27.9 L61.38,27.9 C61.69,27.9 62,27.59 62,27.28 L62,18.6 C62,16.74 60.76,15.5 58.9,15.5 Z M18.6,12.4 C16.74,12.4 15.5,11.16 15.5,9.3 C15.5,7.44 16.74,6.2 18.6,6.2 C20.46,6.2 26.04,9.92 27.59,11.78 C26.66,12.09 18.6,12.4 18.6,12.4 Z M43.4,12.4 C43.4,12.4 35.34,12.09 34.41,11.78 C36.27,9.61 41.54,6.2 43.4,6.2 C45.26,6.2 46.5,7.44 46.5,9.3 C46.5,11.16 45.26,12.4 43.4,12.4 Z"
                                id="Shape"
                            ></path>
                            <path d="M26.66,34.1 L3.72,34.1 C3.41,34.1 3.1,34.41 3.1,34.72 L3.1,58.9 C3.1,60.76 4.34,62 6.2,62 L26.66,62 C27.28,62 27.9,61.38 27.9,60.76 L27.9,35.34 C27.9,34.72 27.28,34.1 26.66,34.1 Z" id="Shape"></path>
                            <path
                                d="M58.28,34.1 L35.34,34.1 C34.72,34.1 34.1,34.72 34.1,35.34 L34.1,60.76 C34.1,61.38 34.72,62 35.34,62 L55.8,62 C57.66,62 58.9,60.76 58.9,58.9 L58.9,34.72 C58.9,34.41 58.59,34.1 58.28,34.1 Z"
                                id="Shape"
                            ></path>
                        </g>
                    </g>
                </g>
            </svg>
            <svg class="limoniapps-icon limoniapps-icon-open" width="14" height="14" fill="currentColor">
                <path d="M13.978 12.637l-1.341 1.341L6.989 8.33l-5.648 5.648L0 12.637l5.648-5.648L0 1.341 1.341 0l5.648 5.648L12.637 0l1.341 1.341L8.33 6.989l5.648 5.648z" fill-rule="evenodd"></path>
            </svg>
        </a>
    </div>
</div>

<div id="limoniapps-volumediscounts-template" style="display: none;">
    <div class="limoniapps-discountninja-volumediscounts-table">
        <div class="limoniapps-discountninja-volumediscounts-header">
            <div class="limoniapps-discountninja-volumediscounts-header-col1">[[QUANTITY_LABEL]]</div>
            <div class="limoniapps-discountninja-volumediscounts-header-col2">[[PRICE_LABEL]]</div>
        </div>
        <div class="limoniapps-discountninja-volumediscounts-body">
            <div class="limoniapps-discountninja-volumediscounts-body-col1">[[TIER_ROW]]</div>
            <div class="limoniapps-discountninja-volumediscounts-body-col2">[[PRICE]]</div>
        </div>
        <div class="limoniapps-discountninja-volumediscounts-footer"></div>
    </div>
</div>
<div id="limoniapps-volumediscounts-tier-template" style="display: none;">
    <div class="limoniapps-discountninja-volumediscounts-tier [[RECOMMENDED]]">
        <input class="limoniapps-discountninja-volumediscounts-tier-radiobutton" type="radio" name="limoniapps-discountninja-volumediscounts" value="[[TIER]]" />
        <div class="limoniapps-discountninja-volumediscounts-tier-label">[[LABEL]]</div>
    </div>
</div>

<div id="limoniapps-promotionsummary-template" style="display: none;">
    <div class="limoniapps-discountninja-subtotalcomment-summary-table" data-token="ALL-TOKENS">
        <div class="limoniapps-discountninja-subtotalcomment-summary-header" style="[[SHOWHEADER]]">[[HEADER]]</div>
        <div class="limoniapps-discountninja-subtotalcomment-summary-body">[[BODY]]</div>
        <div class="limoniapps-discountninja-subtotalcomment-summary-promotioncodefield" style="[[SHOWPROMOTIONCODEFIELD]]"></div>
        <div class="limoniapps-discountninja-subtotalcomment-summary-footer" style="[[SHOWFOOTER]]">[[FOOTER]]</div>
    </div>
</div>
<div id="limoniapps-promotionsummary-row-template" style="display: none;">
    <div class="limoniapps-discountninja-subtotalcomment-summary-row">[[ROW]]</div>
</div>

<!-- "snippets/special-offers.liquid" was not rendered, the associated app was uninstalled -->

<script>
    if (typeof Spurit === "undefined") {
        var Spurit = {};
    }
    if (!Spurit.UpsellForProducts2) {
        Spurit.UpsellForProducts2 = {};
    }
    if (!Spurit.UpsellForProducts2.snippet) {
        Spurit.UpsellForProducts2.snippet = {};
    }
    if (!Spurit.UpsellForProducts2.snippet.products) {
        Spurit.UpsellForProducts2.snippet.products = {};
    }
    Spurit.UpsellForProducts2.snippet.shopHash = "b617b38c3789b27ac22c5006e619e58e";
    Spurit.UpsellForProducts2.snippet.cacheTimestamp = 1621317899;

    if (typeof Spurit.globalSnippet === "undefined") {
        Spurit.globalSnippet = {
            shop_currency: "IDR",
            money_format: "<span class=money>Rp </span>",
            cart: {
                note: null,
                attributes: {},
                original_total_price: 0,
                total_price: 0,
                total_discount: 0,
                total_weight: 0.0,
                item_count: 0,
                items: [],
                requires_shipping: false,
                currency: "IDR",
                items_subtotal_price: 0,
                cart_level_discount_applications: [],
            },
            customer_id: "",
        };
    }
</script>

<script src="https://cdn-spurit.com/shopify-apps/8upsell/common.js"></script>
<link href="https://cdn-spurit.com/shopify-apps/8upsell/common.css" rel="stylesheet" type="text/css" media="all" />

<!-- spurit_sri-added -->
<script>
    if (typeof Spurit === "undefined") {
        var Spurit = {};
    }
    if (!Spurit.recurringInvoices) {
        Spurit.recurringInvoices = {};
    }
    if (!Spurit.recurringInvoices.snippet) {
        Spurit.recurringInvoices.snippet = {};
    }
    Spurit.recurringInvoices.snippet.appId = "46";
    Spurit.recurringInvoices.snippet.shopHash = "a96ac99637ba21fbe3d08e9e9dfc9e13";
    Spurit.recurringInvoices.snippet.shopDomain = "staycoolsocks.myshopify.com";
    Spurit.recurringInvoices.snippet.folderStore = "https://cdn-spurit.com/shopify-apps/recurring-invoices/store/";
    Spurit.recurringInvoices.snippet.folderCss = "https://cdn-spurit.com/shopify-apps/recurring-invoices/";
    Spurit.recurringInvoices.snippet.cdnHostPath = "https://cdn-spurit.com/";
    Spurit.recurringInvoices.snippet.cdnJsLibsPath = "https://cdn-spurit.com/all-apps/";
    Spurit.recurringInvoices.snippet.moneyFormat = "<span class=money>Rp </span>";

    if (typeof Spurit.globalSnippet === "undefined") {
        Spurit.globalSnippet = {
            shop_currency: "IDR",
            money_format: "<span class=money>Rp </span>",
            cart: {
                note: null,
                attributes: {},
                original_total_price: 0,
                total_price: 0,
                total_discount: 0,
                total_weight: 0.0,
                item_count: 0,
                items: [],
                requires_shipping: false,
                currency: "IDR",
                items_subtotal_price: 0,
                cart_level_discount_applications: [],
            },
            customer_id: "",
        };
    }

    if (typeof Spurit.recurringInvoices.translation === "undefined") {
        Spurit.recurringInvoices.translation = {
            select_periodicity: "Select frequency:",
            weeks: "Weeks",
            months: "Months",
            weekly: "Weekly",
            monthly: "Monthly",
            custom: "Custom",
        };
    }
</script>
<script src="https://cdn-spurit.com/shopify-apps/recurring-invoices/common.js"></script>
<!-- /spurit_sri-added -->

<div id="shopify-block-5038451100865107764" class="shopify-block shopify-app-block"></div>
<div id="shopify-block-13019466082614940324" class="shopify-block shopify-app-block"></div>

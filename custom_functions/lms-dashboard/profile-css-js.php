<?php
/**
 * Load Files
 */
function enqueue_events_to_class_js() {
    // Check if the current user has 'wpamelia-provider' capability but does not have 'manage_options' capability
    if (current_user_can('wpamelia-provider') && !current_user_can('manage_options')) {
        // Enqueue the JavaScript file
        wp_enqueue_script(
            'events-to-class-js', // Handle for the script
            get_template_directory_uri() . '/custom_functions/lms-dashboard/js/events-to-class.js', // Path to the script
            array(), // Dependencies (if any)
            null, // Version number (optional)
            true // Load in footer
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_events_to_class_js');

/**
 * Hide Admin Bar for Instructor & Amelia Employee ,.am-page-header.am-section,
 */

function add_custom_css_for_wpamelia_provider() {
    if ((current_user_can('wpamelia-provider') && strpos($_SERVER['REQUEST_URI'], 'wpamelia-events') !== false) && !current_user_can('manage_options')) {
        echo '<style>
            /* Hide admin bar, menu, and other elements for wpamelia-provider */
            #adminbar, div#wpadminbar, div#adminmenuback, #adminmenuwrap, ul#adminmenu, #wpfooter, .am-event-translate, .am-logo, #tab-settings, .am-setting-box.am-switch-box {
                display: none !important;
            }
            #wpcontent {
                margin-left: 0 !important;
            }
            .am-body .am-page-header.am-section .el-col:has(.am-logo) {
                padding-top: 0px !important;
                background-color: #fff !important;
                opacity: 0 !important;
            }
            html.wp-toolbar, .wp-toolbar div#wpcontent:has(.amelia-booking) {
                padding: 0 !important;
            }
            .wp-toolbar div#wpcontent:has(.amelia-booking) .am-wrap {
                margin: 0 !important;
            }
            .wp-toolbar div#wpcontent:has(.amelia-booking) .el-button.el-button--primary, .wp-toolbar div#wpcontent:has(.amelia-booking) .am-button-new .el-button, .am-side-dialog.am-dialog-event .am-add-event-date button, .el-button.el-button--primary {
                color: #fff !important;
                background-color: #104627 !important;
                border-color: #104627 !important;
            }
            .el-checkbox__input.is-checked+.el-checkbox__label {
                color: #104627 !important;
            }
            .el-checkbox__input.is-checked .el-checkbox__inner, .el-checkbox__input.is-indeterminate .el-checkbox__inner {
                background-color: #104627 !important;
                border-color: #409EFF;
            }
            .wp-toolbar div#wpcontent:has(.amelia-booking) .el-button.el-button--primary:hover, .wp-toolbar div#wpcontent:has(.amelia-booking) .am-button-new .el-button:hover {
                background-color: #156636 !important;
            }
        </style>';
        echo '<script>
document.addEventListener("DOMContentLoaded", function() {
    var checkExist = setInterval(function() {
        // Select the h1 element with the class "am-page-title"
        var pageTitle = document.querySelector("h1.am-page-title");
        // Select the h2 element within the class "am-dialog-header"
        var dialogHeader = document.querySelector(".am-dialog-header h2");
        
        // Check if the h1 element exists and update its text content
        if (pageTitle) {
            pageTitle.textContent = "Classes";
        }
        
        // Check if the h2 element exists and update its text content
        if (dialogHeader) {
            dialogHeader.textContent = "New Class";
        }

        // If both elements have been found and updated, clear the interval
        if (pageTitle && dialogHeader) {
            clearInterval(checkExist);
        }
    }, 1000); // Check every 1000 milliseconds (1 second)
});
</script>';
    } else if (current_user_can('wpamelia-provider') && !current_user_can('manage_options')) {
        echo '<style>
                   #adminbar, div#wpadminbar {
                    display: none !important;
                   }
             </style>';
    }
}
add_action('admin_head', 'add_custom_css_for_wpamelia_provider');

/**
* Add custom css on frontend
*/
function add_custom_css_for_wpamelia_provider_frontend() {
  if (current_user_can('wpamelia-provider') && !current_user_can('manage_options')) {
        echo '<style>
                   #adminbar, div#wpadminbar {
                    display: none !important;
                   }
             </style>'; 
        if (!is_current_user_allowed()) { // Ensure this function exists and works as intended
            echo '<style>
                button.am-add-new-button {
                 display: none !important;
                }
            </style>';

        }
    }
}
add_action('wp_head', 'add_custom_css_for_wpamelia_provider_frontend');
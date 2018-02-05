/**
 * Customizer custom js
 */

jQuery(document).ready(function() {
   jQuery('.wp-full-overlay-sidebar-content').prepend('<div class="newszine-ads"><a href="http://oceanwebthemes.com/webthemes/newszine-plus-premium-wordpress-theme/" class="button" target="_blank">{pro}</a></div>'.replace('{pro}',newszine_customizer_pro_js_obj.pro));
});
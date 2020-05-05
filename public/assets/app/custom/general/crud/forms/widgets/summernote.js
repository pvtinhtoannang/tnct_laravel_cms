"use strict";
// Class definition

var PostContent = function () {
    // Private functions
    var post_content = function () {
        $('.summernote-post-content').summernote({
            height: 500
        });
    };

    return {
        // public functions
        init: function () {
            post_content();
        }
    };
}();

// Initialization
jQuery(document).ready(function () {
    PostContent.init();
});

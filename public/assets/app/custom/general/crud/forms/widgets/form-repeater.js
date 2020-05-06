// Class definition
var FormRepeater = function() {

    // Private functions
    var postTag = function() {
        $('#post-tag-repeater').repeater({
            initEmpty: false,

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }

    return {
        // public functions
        init: function() {
            postTag();
        }
    };
}();

jQuery(document).ready(function() {
    FormRepeater.init();
});

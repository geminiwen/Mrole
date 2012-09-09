// JavaScript Document
(function($) {
	$.fn.extend({
		placeholder: function() {
			if ('placeholder' in document.createElement('input')) {
				return this
			} else {
				return this.each(function() {
					var _this = $(this),
					this_placeholder = _this.attr('placeholder');
					_this.val(this_placeholder).focus(function() {
						if (_this.val() === this_placeholder) {
							_this.val('')
						}
					}).blur(function() {
						if (_this.val().length === 0) {
							_this.val(this_placeholder)
						}
					})
				})
			}
		}
	})
})(jQuery);
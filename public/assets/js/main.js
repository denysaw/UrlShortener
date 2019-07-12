$.fn.disable = function() {
	return this.attr('disabled', 'disabled');
};

$.fn.enable = function() {
	return this.removeAttr('disabled');
};

$(function() {
	var $url    = $('input#url');
	var $submit = $(this).find('button[type=submit]');
	var $copy   = $(this).find('button.copy');
	var $new    = $(this).find('a.new');

	$('form').submit(function(e) {
		e.preventDefault();

		$submit.disable();

		$.post('/api/shorten', {url: $url.val()}, function(res) {
			res = $.parseJSON(res);

			if (res.slug) {
				$url.val(window.location.origin + '/' + res.slug);
				$submit.remove();
				$copy.removeClass('hidden');
				$new.removeClass('hidden');
				$url.prev().text('Now you may copy your shortened url to clipboard');
			} else {
				$url.prev().addClass('error').text(res.error);
				$submit.enable();
			}
		});

		return false;
	});

	$copy.click(function() {
		$url.select();
		document.execCommand('copy');
		$url.prev().text('Url successfully copied to clipboard');
		$(this).remove();
	});
});
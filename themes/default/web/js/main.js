$(function () {

	// message popup
	$('.fancybox').fancybox();
	$('.fancybox\\\.ajax').fancybox();
	$('.fancybox\\\.image').fancybox({fitToView: false, maxWidth: '90%'});

	$(".fancybox-gallery-item").fancybox({
		openEffect: 'elastic',
		closeEffect: 'elastic',
		prevEffect: 'none',
		nextEffect: 'none',
		closeBtn: true,
		fitToView: false,
		maxWidth: '95%',
		beforeLoad: function () {
			var el, id = $(this.element).data('title-id');

			if (id) {
				el = $('#' + id);

				if (el.length) {
					this.title = el.html();
				}
			}
		},
		helpers: {
			title: { type: 'inside', position: 'top' },
			thumbs: {
				width: 50,
				height: 50,
				position: 'top'
			}
		}
	});
});
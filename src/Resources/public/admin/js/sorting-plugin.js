(function ($) {
	$.getScript('https://code.jquery.com/ui/1.12.1/jquery-ui.js', function() {
		$('#sortableProducts').sortable({
			items: '.sortableItem',
			cursor: 'move',
			placeholder: 'sortableItem-placeholder card',
			tolerance: 'pointer',
			revert: true,
			parent: 'body',
			sort: (event, ui)=>{
				$('.sylius-flash-message').hide();
			}
		});
	});
})(jQuery);

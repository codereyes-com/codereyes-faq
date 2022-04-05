(function( $ ) {
	'use strict';

	jQuery('.codereyes-faq-answer').hide();

	// If a closed question is clicked
	jQuery('.codereyes-faq-question-closed').on('click', function(event) {
		event.preventDefault();
		const codereyes_faq_id = '#' + $(this).attr('id') + '-answer';
		jQuery(this).removeClass().addClass('codereyes-faq-question-open');
		jQuery(codereyes_faq_id + ' .codereyes-faq-triangle').html('&#9660;');
		jQuery('.codereyes-faq-answer' + codereyes_faq_id).slideDown();

	});

	// If an open question is clicked
	jQuery('.codereyes-faq-question-open').on('click', function(event) {
		event.preventDefault();
		const codereyes_faq_id = '#' + $(this).attr('id') + '-answer';
		jQuery(this).removeClass().addClass('codereyes-faq-question-closed');
		jQuery(codereyes_faq_id + ' .codereyes-faq-triangle').html('&#9654;');
		jQuery('.codereyes-faq-answer' + codereyes_faq_id).slideUp();
	});

});

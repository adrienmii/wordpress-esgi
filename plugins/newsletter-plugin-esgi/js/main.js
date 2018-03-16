$ = jQuery;
function initNewsletter(element)
{
	$(function() {
		$(element).submit(function( event ) {
			event.preventDefault();
			_this= this;

			loading(_this ,1);

			var posting = $.post( '', $(this).serialize() );
			posting.done(function(e){
				e = $.parseJSON(e);
				if(e.success == '1'){
					$('input').hide();
					message = '<div class="newsletter-success"><p>'+e.message+'</p></div>';
					showSucess(_this,message);
				}else{
					$("fieldset.newsletter-field .error").remove();
					$.each(e.message,function(field, error) {
						$(element).find(".newsletter-field-"+field).append('<div class="error">'+error+'!</div>');
					});
				}
				loading(_this,0);			
			});
		});
	});
}

function showSucess(element, message)
{
	var showon = $(element).parent().data('showon');
	$(element).find('.error').remove();

	$(element).parent().append(message);	
	
}

function loading(element, method)
{
	if(method == 0)
	{
		$(element).show();
		$(element).parent().find('.newsletter_spinner').hide();
		return 0;
	}
	
	$(element).hide();
	$(element).parent().find('.newsletter_spinner').show();
	return 0;

}
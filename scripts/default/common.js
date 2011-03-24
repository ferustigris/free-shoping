/*! load page
 * \params no
 * \return no
 */
$(function() {
		if(!isCookies())
			$( "#nocookies" ).show();
});
/*! открывает эдит для ввода
 * \params 
 * - id - id element
 * - default_value - default value
 * \return no
 */
function onFocusHandler(id, default_value) 
{
	e = document.getElementById(id);
	e.style.color = 'black';
	if(e.value == default_value)
	{
		e.value = '';
	}
	return true;
}
/*! закрывает эдит для ввода
 * \params
 * - id - id element
 * - default_value - default value
 * \return no
 */
function onBlurHandler(id, default_value) 
{
	e = document.getElementById(id);
	if(e.value == default_value || e.value == '')
	{
		e.style.color = 'gray';
		e.value = default_value;
	}
}
/*! добавить обработчик
 * \params no
 * \return no
 */
function addHandler(object, event, handler, useCapture) {
    if (object.addEventListener) {
          object.addEventListener(event, handler, useCapture ? useCapture : false);
    } else if (object.attachEvent) {
          object.attachEvent('on' + event, handler);
    } else alert("Add handler is not supported");
}
/*! удалить обработчик
 * \params no
 * \return no
 */
function removeHandler(object, event, handler) {
    if (object.removeEventListener) {
          object.removeEventListener(event, handler, false);
    } else if (object.detachEvent) {
          object.detachEvent('on' + event, handler);
    } else alert("Remove handler is not supported");
}
/*! Создаем всплывающие подсказки
 * \params
 * - id - id element
 * - tooltip - id tooltip
 * \return no
 */
function tooltipShow(id, tooltip)
{
	parent = document.getElementById(id);
	e = document.getElementById(tooltip);
	e.style.display = 'block';
	window.setTimeout(function() {
		e.style.display = 'none';
		}, 5000);
	addHandler(e, 'mouseout', function() {
		e = document.getElementById(tooltip);
		e.style.display = 'none'; 
	}, true) ;
	addHandler(parent, 'mouseout', function() {
		e = document.getElementById(tooltip);
		e.style.display = 'none'; 
	}, true) ;
}
/*! image preview function, demonstrating the ui.dialog used as a modal window
 * \params
 * - link - link to image
 * \return no
 */
function viewLargerImage( $link ) {
	var src = $link.attr( "src" ),
		title = $link.attr( "alt" );
		var img = $( "<img src='" + src + "' alt='" + title + "' style='display: none; padding: 20px;' />" )
			.appendTo( "body" ).dialog({
				title: title,
				width: 750,
				height: 550,
				modal: true
			});
}
/*! image preview function, demonstrating the ui.dialog used as a modal window
 * \params
 * - link - link to image
 * \return no
 */
function insertInPage( data ) {
	jQuery(data).each(function() {
		if(jQuery(this).html() != null)
		{				
			if(jQuery(this).attr('id') == 'content')
				jQuery('#main_page').html(jQuery(this).html());
			if(jQuery(this).attr('id') == 'errors')
				jQuery('#top_page').html(jQuery(this).html());
		}
	});
	$('#main_page').show( 300, function() {
		setTimeout(function() 
		{
			$('#main_page').show();
		},	300);		
	});
	$('#top_page').show( 300, function() {
		setTimeout(function() 
				{
					$('#main_page').show();
				},	300);		
		if(!isCookies())
			$( "#nocookies" ).show();
	});
};
/*! apply effect
 * \params
 * - link - link to image
 * \return no
 */
function hideMainSection() 
{
	$('#main_page').hide( 'slow', hideMainSectionCallback );// run the effect
	$('#top_page').hide( 'slow', hideMainSectionCallback );// run the effect
};
/*! callback function to bring a hidden box back
 * \params
 * - link - link to image
 * \return no
 */
function hideMainSectionCallback() 
{
	$('#main_page').hide();
	$('#top_page').hide();
};

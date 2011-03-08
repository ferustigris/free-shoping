jQuery(function() {
	setContatcsIcons();
});
/*! set buttons icons
 * \params no
 * \return no
 */
function setContatcsIcons() {
	if(jQuery('#contacts_send_message_button'))
	jQuery('#contacts_send_message_button').button({
		icons: {
               primary: "ui-icon-mail-closed"
        }
	});
};

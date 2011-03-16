/*! set icons
 * \params no
 * \return no
 */
jQuery(function() {
	onAuthLoad();
});
/*! set icons
 * \params no
 * \return no
 */
function onAuthLoad() {
	jQuery('.save_button').button({
		icons: {
               primary: "ui-icon-key"
        }
	});
	if(jQuery('#registration_ok'))
		jQuery('#registration_ok').button({
			icons: {
	            primary: "ui-icon-key"
	        }
		}).attr('disabled',true).click(function() {
			jQuery.cookie('redirect', '');
			return true;
		});
	jQuery(".registration_valid_check").keyup(checkPassword);
	if($('#auth_edit_user_ok[type="submit"]'))
	{
		$('#auth_edit_user_ok[type="submit"]').click(function() {
			var line = {};
			jQuery('input').each(function(){
				line[$(this).attr('name')] = $(this).attr('value');
			});
			loadAjaxPage("index.php?module=auth&action=edit&page=edit_form", line);
			return false;
		});
	}
	jQuery("#registration_phone").mask("9-(999)-999-9999",{placeholder:"x"});
}
function checkPassword() {
	var has_errors = false;
	if(jQuery('#registration_login'))
	{
		var str = "" + jQuery('#registration_login').attr('value');
		if((str.length > 0)&&(str.length < 20))
		{
			setCheck('login');
		} else 	{
			setUncheck('login');
			has_errors = true;
		}
	};
	if(jQuery('#registration_mail'))
	{
		if(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/.test(jQuery('#registration_mail').attr('value')))
		{
			setCheck('mail');
		} else 	{
			setUncheck('mail');
			has_errors = true;
		}
	};
	if(jQuery('#registration_phone'))
	{
		var str = "" + jQuery('#registration_phone').attr('value');
			if(str.length > 5)
			{
				setCheck('phone');
			} else 	{
				setUncheck('phone');
				has_errors = true;
			}
	};
	if(jQuery('#registration_address'))
	{
		var str = "" + jQuery('#registration_address').attr('value');
		if(str.length > 5)
		{
			setCheck('address');
		} else 	{
			setUncheck('address');
			has_errors = true;
		}
	};
	if((jQuery('#registration_password1'))&&(jQuery('#registration_password2')))
	{
		var str1 = "" + jQuery('#registration_password1').attr('value');
		var str2 = "" + jQuery('#registration_password2').attr('value');
		if((str1.length >= parseInt(jQuery('#registration_password1').attr('min_len')))&&(str1 == str2))
		{
			setCheck('password1');
			setCheck('password2');
		} else
		{
			has_errors = true;
			setUncheck('password1');
			setUncheck('password2');
		}
	};
	if(has_errors)
	{
		if($('#registration_ok[type="submit"]'))
		{
			$('#registration_ok[type="submit"]').attr('disabled',true);
		}
		if($('#auth_edit_user_ok[type="submit"]'))
		{
			$('#auth_edit_user_ok[type="submit"]').attr('disabled',true);
		}
	} else {
		if($('#registration_ok[type="submit"]'))
		{
			$('#registration_ok[type="submit"]').attr('disabled',false);
		}
		if($('#auth_edit_user_ok[type="submit"]'))
		{
			$('#auth_edit_user_ok[type="submit"]').attr('disabled',false);
		}
	}//
}
function setCheck(name) {
	if(jQuery('#registration_icon_' + name))
	jQuery('#registration_icon_' + name).removeClass('ui-icon-alert');
	if(jQuery('#registration_icon_' + name))
	jQuery('#registration_icon_' + name).addClass('ui-icon-check');
	if(jQuery('#registration_wrapper_' + name))
	jQuery('#registration_wrapper_' + name).removeClass('enter_error');
	if(jQuery('#registration_' + name))
	jQuery('#registration_' + name).removeClass('enter_error');
};
function setUncheck(name) {
	if(jQuery('#registration_icon_' + name))
		jQuery('#registration_icon_' + name).removeClass('ui-icon-check');
	if(jQuery('#registration_icon_' + name))
	jQuery('#registration_icon_' + name).addClass('ui-icon-alert');
	if(jQuery('#registration_wrapper_' + name))
	jQuery('#registration_wrapper_' + name).addClass('enter_error');
	if(jQuery('#registration_' + name))
	jQuery('#registration_' + name).addClass('enter_error');
};

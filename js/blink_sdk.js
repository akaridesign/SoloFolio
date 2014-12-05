if (!window.jQuery)
{
   var script = document.createElement('script');
   var that = this;
   script.type = "text/javascript";
   script.src = "http://code.jquery.com/jquery-1.9.1.min.js";
   script.onload = function() { Blink_SDK.start(window.document) };
   document.getElementsByTagName('head')[0].appendChild(script);
}

if (document.registerElement) {
	document.registerElement('blink-location');
	document.registerElement('blink-locationall');
	document.registerElement('blink-locationall-result');
}

/** @namespace Blink_SDK */
(function (context) {
	"strict";
	if (! context.Blink_SDK) {
		context.Blink_SDK = {};
	};
	var Blink_SDK = context.Blink_SDK;

	Blink_SDK.start = function(doc) {

		jQuery.extend(Blink_SDK, {

			BLINK_SDK_URL: "http://blink.la/sdk/",

			BLINK_SDK_LOCATION: "location/",
			BLINK_SDK_LOCATION_ALL: "location_all/",

			locationall: function(agencyId,listener) {
				var that = this;
				jQuery.ajax({
					type: 'GET',
					url: ((window.BLINK_SDK_HOST_URL) ? window.BLINK_SDK_HOST_URL : Blink_SDK.BLINK_SDK_URL) + Blink_SDK.BLINK_SDK_LOCATION_ALL + agencyId,
					dataType: 'text',
					complete: function (response) {
						var result;
						var error;
						if (response.status==200) {
							result = jQuery.parseJSON(response.responseText);
							jQuery('BLINK-LOCATIONALL-RESULT').each(function() {
								if (result[jQuery(this).attr('data-id')])
								{
									jQuery(this).text(result[jQuery(this).attr('data-id')].location);
								}
							});
						}
						else
						{
							if (response.responseText) {
								error = response.responseText;
							}
							else {
								error = response.statusText;
							}
						}
						if (jQuery.isFunction(listener)) {
							listener(result,error);
						}
					}
				});
			},

			location: function(userId,elem) {
				var that = this;
				if (jQuery.type(elem) === "string") {
					elem = jQuery('#'+elem);
				}
				jQuery.ajax({
					type: 'GET',
					url: ((window.BLINK_SDK_HOST_URL) ? window.BLINK_SDK_HOST_URL : Blink_SDK.BLINK_SDK_URL) + Blink_SDK.BLINK_SDK_LOCATION + userId,
					dataType: 'text',
					complete: function (response) {
						var rtext;
						if (response.status==200) {
							rtext = response.responseText;
						}
						else
						{
							if (response.responseText) {
								rtext = response.responseText;
							}
							else {
								rtext = response.statusText;
							}
						}
						jQuery(elem).text(rtext);
					}
				});
			}
		}); // Blink_SDK namespace

		jQuery('*').each(function() {
	    if (this.nodeName.match('BLINK-*')) {
	    	var method = this.nodeName.substr(6).toLowerCase();
	    	if (jQuery.isFunction(Blink_SDK[method])) {
	    		Blink_SDK[method](jQuery(this).attr('data-id'),this);
	    	}
	    }
		});

		if (jQuery.isFunction(window.blinkSdkInitialized)) {
			window.blinkSdkInitialized();
		}
	}

	context.Blink_SDK = Blink_SDK;

})(this);

if (window.jQuery)
{
	jQuery(document).ready(function() { Blink_SDK.start(window.document); });
}

SideEnum = {
	RIGHT:		'right',
	LEFT:		'left'
};

var WIDGETS = {
	//Hashmap that contains all the widgets on the right side of the navigation bar.
	rightWidgets:	{
		topKey:		''
	},
	//Hashmap that contains all the widgets on the left side of the navigation bar.
	leftWidgets:	{
		topKey:		''
	},
	/*
	* Function used to add widgets to the widget hashmap. Takes an id, the side the widget will be on, and
	* a boolean value that determines if the widget is the visible widget as paramters. 
	*/
	add:			function(id, side, onTop, extraProperties) {
		if(side == SideEnum.LEFT) {
			//Adds the new widget to the leftWidget hashmap.
			this.leftWidgets[id] = new NavWidget(id, side, onTop);
			
			/*Tests if the topKey for the leftWidgets hashmap isn't empty. If it's not, set the 
			* current topKey invisible.
			*/
			if($.trim(this.leftWidgets.topKey) === '') {
				this.leftWidgets[id].enableWidget();
				this.leftWidgets.topKey = id;
			}
			else if(onTop) {
				this.leftWidgets[this.leftWidgets.topKey].disableWidget();
				this.leftWidgets[id].enableWidget();
				this.leftWidgets.topKey = id;
			}
			
			if(Object.prototype.toString.call(extraProperties) === "[object Object]") {
				this.leftWidgets[id].extractProperties(extraProperties);
			}
			
			return this.leftWidgets[id];
		}
		else {
			//Adds the new widget to the rightWidget hashmap.
			this.rightWidgets[id] = new NavWidget(id, side, onTop);
			
			/*Tests if the topKey for the rightWidgets hashmap isn't empty. If it's not, set the 
			* current topKey invisible.
			*/
			if($.trim(this.rightWidgets.topKey) === '') {
				this.rightWidgets[id].enableWidget();
				this.rightWidgets.topKey = id;
			}
			else if(onTop) {
				this.rightWidgets[this.rightWidgets.topKey].disableWidget();
				this.rightWidgets[id].enableWidget();
				this.rightWidgets.topKey = id;
			}
			
			if(Object.prototype.toString.call(extraProperties) === "[object Object]") {
				this.rightWidgets[id].extractProperties(extraProperties);
			}
			
			return this.rightWidgets[id];
		}
	},
	/*
	* Function used to set the current top widget. Takes a key to set the top as and a side
	* to determine which top should be updated.
	*/
	setOnTop:			function(key, side) {
		if(side == SideEnum.LEFT) {
			this.leftWidgets[this.leftWidgets.topKey].disableWidget();
			this.leftWidgets[key].enableWidget();
			this.leftWidgets.topKey = key;
		}
		else {
			this.rightWidgets[this.rightWidgets.topKey].disableWidget();
			this.rightWidgets[key].enableWidget();
			this.rightWidgets.topKey = key;
		}
	},
	getTop:				function(side) {
		if(side == SideEnum.LEFT) {
			return this.leftWidgets.topKey;
		}
		else {
			return this.rightWidgets.topKey;
		}
	},
	keyExists:			function(key) {
		var value = false;
		$.each(WIDGETS.rightWidgets, function(index, indexValue) {
			if($.trim(index) == $.trim(key)) {
				value = indexValue;
				return false;
			}
		});
		
		$.each(WIDGETS.leftWidgets, function(index, indexValue) {
			if($.trim(index) == $.trim(key)) {
				value = indexValue;
				return false;
			}
		});
		
		return value;
	},
	showWidget:			function(selector, event, speed, callBack) {
		var widget = this.keyExists(selector);
		
		if(widget != false) {
			widget.showWidget(event, speed, callBack);
			console.log(widget);
		}
	},
	hideWidget:			function(selector, event, speed, callBack) {
		var widget = this.keyExists(selector);
		
		if(widget != false) {
			widget.hideWidget(event, speed, callBack);
			console.log(widget);
		}
	},
	getWidget:			function(key, side) {
		if(arguments.length == 2 && typeof key == "string") {
			if(side == SideEnum.LEFT) {
				if(key in this.leftWidgets) {
					return this.leftWidgets[key];
				}
			}
			else {
				if(key in this.rightWidgets) {
					return this.rightWidgets[key];
				}
			}
		}
		else if(arguments.length == 1 && typeof key == "string"){
			if(key in this.leftWidgets) {
				return this.leftWidgets[key];
			}
			else if(key in this.rightWidgets) {
				return this.rightWidgets[key];
			}
		}
		
		return false;
	}
};


/*
* WidgetAction constructor
*/
var WidgetAction = function(element, bind, action1, action2) {
	if(typeof element == "string" && typeof action1 == "function") {
		this.element = element;
		this.bind = bind;
		this.toggleState = false;
		this.action1 = action1;
		
		if(typeof action2 == "function") {
			this.action2 = action2;
		}
		else {
			this.action2 = false;
		}
		
		this.bindActions();
	}
	else {
		throw "Can't create WidgetAction object.";
	}
};

/*
* WidgetAction properties
*/
WidgetAction.prototype = {
	getAction:			function() {
		return this.action1;
	},
	setAction:			function(action) {
		if(typeof action1 == "function") {
			this.unbindActions();
			this.action1 = action1;
			this.bindActions();
			
			return this.action;
		}
		
		return false;
	},
	getActionTwo:			function() {
		return this.action2;
	},
	setActionTwo:		function(action) {
		if(typeof action == "function" && this.action2 !== false) {
			this.unbindActions();
			this.action2 = action;
			this.bindActions();
			
			return this.action2;
		}
		
		return false;
	},
	getActions:			function() {
		return [this.action1, this.action2];
	},
	setActions:			function(action1, action2) {
		if(typeof action1 == "function" && typeof action2 == "function" && action2 !== false) {
			this.unbindActions();
			this.action1 = action1;
			this.action2 = action2;
			this.bindActions();
			
			return [this.action, this.action2];
		}
	},
	getElement:			function() {
		return this.element;
	},
	setElement:			function(element) {
		if(typeof element == "string") {
			this.unbindActions();
			this.element = element;
			this.bindActions();
			
			return this.element;
		}
		
		return false;
	},
	getBind:			function() {
		return this.bind;
	},
	setBind:			function(bind) {
		if(typeof bind == "string") {
			this.unbindActions();
			this.bind = bind;
			this.bindActions();
			
			return this.bind;
		}
		
		return false;
	},
	getToggleState:		function() {
		return this.toggleState;
	},
	bindActions:			function() {
		$(this.element).on(this.bind, {action1: this.action1, action2: this.action2, toggle: this.toggleState}, function(event) {
			if(typeof event.data.action2 == "function") {
				if(!event.data.toggle) {
					event.data.action1();
					event.data.toggle = true;
				}
				else if(event.data.toggle) {
					event.data.action2();
					event.data.toggle = false;
				}
			}
			else {
				event.data.action1();
			}
			
			event.preventDefault();
		});
	},
	unbindActions:		function() {
		$(this.element).off(this.bind, this.action1);
		$(this.element).off(this.bind, this.action2);
	},
	triggerAction:		function(time, callBack) {
		$(this.element).trigger(this.bind);
		window.setTimeout(callBack, time);
	}
};

/*
* NavWidget constructor.
*/
var NavWidget = function(btnID, side, onTop) {
	var that = this;
	this.button = btnID;
	this.link 	= btnID + '-link';
	this.panel 	= btnID + '-panel';
	this.side = side;
	this.visible = typeof onTop !== 'undefined' ? onTop : false;
	this.actions = {};
	this.addAction(this.button, "click", function() { that.showWidget({}, 500) } , function() { that.hideWidget({}, 500) });
	this.properties = {};
};

NavWidget.prototype = {
	showWidget: 		function(event, speed, callBack) {
		if(this.visible) {
			$(this.link).addClass('selected-link');
			if(arguments.length == 3) {
				$(this.panel).stop().slideDown(speed, callBack);
			}
			else if(arguments.length == 2) {
				$(this.panel).stop().slideDown(speed);
				
			}
			else if(arguments.length == 1 || arguments.length == 0){
				$(this.panel).stop().slideDown();
			}
		}
	},
	hideWidget:			function(event, speed, callBack) {
		if(this.visible) {
			var tempLink = this.link;
			if(arguments.length == 3) {
				$(this.panel).stop().slideUp(speed, function() {
					$(tempLink).removeClass('selected-link');
					callBack();
				});
			}
			else if(arguments.length == 2) {
				$(this.panel).stop().slideUp(speed, function() {
					$(tempLink).removeClass('selected-link');
				});
			}
			else if(arguments.length == 1 || arguments.length == 0){
				$(this.panel).stop().slideUp('slow', function() {
					$(tempLink).removeClass('selected-link');
				});
			}
		}
	},
	disableWidget:		function() {
		this.setVisible(false);
		$(this.button).hide();
		$(this.link).hide();
		$(this.panel).hide();
	},
	enableWidget:		function() {
		this.setVisible(true);
		$(this.button).show();
		$(this.link).show();
	},
	isVisible:			function() {
		return this.visible;
	},
	setVisible:			function(visible) {
		this.visible = visible;
	},
	getButtonID:		function() {
		return String(this.button);
	},
	getLinkID:			function() {
		return this.link;
	},
	addAction:			function(selector, bind, action, action2) {
		if(typeof selector == 'string' && typeof bind == 'string' && typeof action == 'function') {
			var element = $(selector);
			if(element.length === 0) {
				return false;
			}
			else {
				return this.actions[selector] = new WidgetAction(selector, bind, action, action2);
			}
		}
	},
	removeAction:		function(selector) {
		if(typeof selector == 'string') {
			delete this.actions[selector];
			return true;
		}
		
		return false;
	},
	getAction:			function(key) {
		if(typeof key == 'string' && key in this.actions) {
			return this.actions[key];
		}
		
		return false;
	},
	getActions:			function() {
		return this.actions;
	},
	extractProperties:	function(tempProp) {
		if(typeof tempProp == "object") {
			for(var key in tempProp) {
				this.properties[key] = tempProp[key];
			}
		}
		else {
			throw "Parameter not an array.";
		}
	},
	getProperties:		function() {
		return this.properties;
	},
	getProperty:		function(key) {
		if(key in this.properties) {
			if(Object.prototype.toString.call(this.properties[key]) === "[object Function]") {
				return this.properties[key]();
			}
			return this.properties[key];
		}
		
		return false;
	},
	setProperty:		function(key, value) {
		this.properties[key] = value;
	}
};

var NotificationPanel = function(selector) {
	this.panel = selector;
	$(this.panel).css('top', ($(document).height() - $(this.panel).outerHeight()));
};

NotificationPanel.prototype = {

};

function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}

var username = readCookie('username');
var page = 'home';

var buttonOverlay = {
	id:			'#button-overlay',
	height:		0,
	width:		0,
	getID:		function() {
		return this.id;
	},
	setHeight:	function(height) {
		this.height = height + 'px';
	},
	getHeight:	function() {
		return this.height;
	},
	setWidth:	function(width) {
		this.width = width + 'px';
	},
	getWidth:	function() {
		return this.width;
	},
	show:		function() {
		$(this.id).css({width: this.width, height: this.height}).fadeIn(600);
	},
	hide:		function() {
		$(this.id).hide();
	}
};

var Overlay = function(element) {
	this.element = element;
}

Overlay.prototype = {
	getID:		function() {
		return this.element.attr('id');
	},
	setHeight:	function(height) {
			this.element.css('height', height);
	},
	getHeight:	function() {
		return this.element.attr('height');
	},
	setWidth:	function(width) {
		this.element.css('width', width);
	},
	getWidth:	function() {
		return this.element.attr('width');
	},
	show:		function() {
		this.element.css({width: this.element.width, height: this.element.height}).fadeIn(600);
	},
	hide:		function() {
		this.element.hide();
	}
};

var MessageView = function(element) {
	this.element = element;
}

MessageView.prototype = {
	show:		function(message) {
		this.element.text(message).fadeIn(700);
	},
	hide:		function() {
		this.element.hide().text('');
	}
};

var FormView = function(element) {
	this.element = element;
}

FormView.prototype = {
	clearForm:		function() {
		this.element.filter(':input:not(:submit)').val('');
	},
	giveFocus:		function(selector) {
		this.element.children(selector).focus();
	},
	inputError:		function(selector) {
		this.element.children(selector).addClass('inputError');
	},
	clearError:	function(selector) {
		this.element.filter(selector).removeClass('inputError');
	},
	disableInput:	function() {
		this.element.filter(':input').attr('disabled', 'disable');
	},
	enableInput:	function() {
		this.element.filter(':input').removeAttr('disabled');
	}
};

var NavButton = function(element) {
	this.element = element;
	this.actions = {};
}

NavButton.prototype = {
	select:			function() {
		this.element.addClass('selected-link');
	},
	deselect:		function() {
		this.elememt.removeClass('selected-link');
	},
	addAction:			function(key, bind, action, action2) {
		if(typeof key == 'string' && typeof bind == 'string' && typeof action == 'function') {
			return this.actions[key] = new WidgetAction(this.element.attr('id'), bind, action, action2);
		}
	}
};


var ProjectView = function(element) {
	this.element = element;
	this.readMore = element.find('.read-more');
}

ProjectView.prototype = {
	showMore:		function() {
	}
};

$(document).ready(function() {
	var loginWidget = WIDGETS.add('#login', SideEnum.RIGHT, true, {
		loginMessage:		new MessageView($('#login-message')),
		loginOverlay:		new Overlay($('#panel-overlay')),
		signInForm:			new FormView($('#login-panel-form'))
	});
	
	var settingsWidget = WIDGETS.add('#settings', SideEnum.RIGHT, false, {
		username: readCookie('username')
	});
	
	var signupWidget = WIDGETS.add('#signup', SideEnum.RIGHT, false, {
		signupMessage:		new MessageView($('#signup-message')),
		signupOverlay:		new Overlay($('#panel-overlay')),
		signupForm:			new FormView($('#signup-panel-form'))
	});
	
	
	
	if(username) {
		console.log(readCookie('username'));
		WIDGETS.setOnTop('#settings', SideEnum.RIGHT);
	}
	
	/*
	* Removes the default action from the signupWidget and adds a new action to the 
	* main button. The new action sets it so the main button only hides itself, not
	* toggle on hide and show.
	*/
	signupWidget.removeAction('#signup');
	signupWidget.addAction('#signup', 'click', function(event) {
		signupWidget.hideWidget(event, 500, function() {
			signupWidget.disableWidget();
			WIDGETS.setOnTop('#login', SideEnum.RIGHT);
		});
	});
	
	signupWidget.addAction('#signup-submit', 'click', function(event) {
		var tempOverlay = signupWidget.getProperty('signupOverlay');
		var tempSignupMessage = signupWidget.getProperty('signupMessage');
		var tempSignupForm = signupWidget.getProperty('signupForm');
		
		$.ajax({
			url:		"signup.php",
			type:		"POST",
			dataType:	"json",
			data:		{
							"signup-fname":			$('#signup-fname').val(),
							"signup-lname":			$('#signup-lname').val(),
							"signup-email":			$('#signup-email').val(),
							"signup-password1":		$('#signup-password1').val(),
							"signup-password2":		$('#signup-password2').val()
			},
			beforeSend:	function(jqXHR, settings) {
				$('#button-overlay').show();
				tempSignupForm.disableInput();
				tempSignupMessage.hide();
				tempSignupForm.clearError('#signup-panel-form :input:not(:submit)');
				
				tempOverlay.setWidth($('#signup-panel').css('width'));
				tempOverlay.setHeight($('#signup-panel').css('height'));
				tempOverlay.show();
				
				var margRight = Math.abs(parseInt($('#signup li').css('margin-right'), 10));
				var margTop = Math.abs(parseInt($('#signup li').css('margin-top'), 10));
				var w = $('#signup').width() + margRight;
				var h = $('#signup').height() + margTop;
				
				buttonOverlay.setWidth(w);
				buttonOverlay.setHeight(h);
				buttonOverlay.show();
			},
			success:	function(data, textStatus, jqXHR) {
				tempOverlay.hide();
				buttonOverlay.hide();
				
				if(data.error) {
					tempSignupMessage.show(data.message);
					tempSignupForm.inputError(data.selector);
				}
				else {
					createCookie('username', data.firstname, 1);
					settingsWidget.setProperty('username', data.firstname);
					$('#settings-link').text(settingsWidget.getProperty('username'));
					
					signupWidget.getAction('#signup').triggerAction(600, function() {
						WIDGETS.setOnTop('#settings', SideEnum.RIGHT);
					});
					
					tempSignupForm.clearForm();
				}
			},
			error:		function(jqXHR, textStatus, errorThrown) {
				tempOverlay.hide();
				buttonOverlay.hide();
				alert('There was an error while trying to contact the server.');
			},
			complete:	function(jqXHR, textStatus) {
				tempSignupForm.enableInput();
			}
		});
	});
	
	/*
	* Click action listener for the login-signup button. Hides the loginWidget
	* and shows the signupWidget.
	*/
	loginWidget.addAction('#login-signup', 'click', function(event) {
		loginWidget.getAction('#login').triggerAction(500, function() {
			WIDGETS.setOnTop('#signup', SideEnum.RIGHT);
			signupWidget.showWidget(event, 500);
			signupWidget.getProperty('signupForm').giveFocus('#signup-fname');
		});
	});
	
	/*
	* Click action listener for the login-submit button. Trys to log the user in. On
	* success it hides and disables the loginWidget, and enables the settings widget.
	*/
	loginWidget.addAction('#login-submit', 'click', function(event) {
		var tempOverlay = loginWidget.getProperty('loginOverlay');
		var tempLoginMessage = loginWidget.getProperty('loginMessage');
		var tempSignInForm = loginWidget.getProperty('signInForm');
		
		$.ajax({
			url:				"login.php",
			type:				"POST",
			dataType:			"json",
			data:				{
									"login-email":		$('#login-email').val(),
									"login-password":	$('#login-password').val()
			},
			beforeSend: 		function(jqXHR, settings) {
				tempSignInForm.disableInput();
				tempLoginMessage.hide();
				
				tempOverlay.setWidth($('#login-panel').css('width'));
				tempOverlay.setHeight($('#login-panel').css('height'));
				tempOverlay.show();
				
				var margRight = Math.abs(parseInt($('#login li').css('margin-right'), 10));
				var margTop = Math.abs(parseInt($('#login li').css('margin-top'), 10));
				var w = $('#login').width() + margRight;
				var h = $('#login').height() + margTop;
				
				buttonOverlay.setWidth(w);
				buttonOverlay.setHeight(h);
				buttonOverlay.show();
			},
			success:			function(data, textStatus, jqXHR) {
				tempOverlay.hide();
				buttonOverlay.hide();
				
				if(data.error) {
					tempLoginMessage.show(data.message);
				}
				else {
					var expiry = 2;
					if($('#login-remember').val()) {
						expiry = 500;
					}
					
					createCookie('username', data.firstname, expiry);
					settingsWidget.setProperty('username', data.firstname);
					
					loginWidget.getAction('#login').triggerAction(500, function() {
						$(settingsWidget.getLinkID()).text(settingsWidget.getProperty('username'));
						WIDGETS.setOnTop('#settings', SideEnum.RIGHT);
					});
					
					tempSignInForm.clearForm();
				}
			},
			error:			function(jqXHR, textStatus, errorThrown) {
				tempOverlay.hide();
				buttonOverlay.hide();
				
				alert('There was an error while trying to contact the server.');
				
			},
			complete:			function(jqXHR, textStatus) {
				tempSignInForm.enableInput();
			}
		});
	});
	
	/*
	* Click action listener for the signout-link button. Signs the user out, disables the
	* settingsWidget, and puts the loginWidget on top.
	*/
	settingsWidget.addAction('#signout-link', 'click', function(event) {
		eraseCookie('username');
		settingsWidget.setProperty('username', '');
		
		$.ajax({
			url:				"signout.php",
			type:				"POST",
			dataType:			"json",
			error:			function(jqXHR, textStatus, errorThrown) {
				alert('An error occured while trying to log out.');
			},
			success:			function(data, textStatus, jqXHR) {
				settingsWidget.getAction('#settings').triggerAction(500, function() {
					WIDGETS.setOnTop('#login', SideEnum.RIGHT);
				});
			},
			complete:			function(jqXHR, textStatus) {
			}
		});
	});
	
	$('#center-content, #banner').hide();
	
	if(firstname == null || $.trim(firstname) == "") {
		signedIn = true;
	}
	
	if(page == 'home') {
		var linkQuery = {
			"url":			"loadPage.php",
			"type":			"GET",
			"dataType":		"html",
			"data":		{
				"page":		"home"
			},
			"success":		function(data, textStatus, jqXHR) {
				$('#center-content').html(data).fadeIn(850);
				$('#banner').fadeIn(850);
			},
			"error":		function(jqXHR, textStatus, errorThrown) {
				alert('error');
			}
		};
		$.ajax(linkQuery);
	}
	
	/*
	* If any of the top-nav anchor tags don't have the class 'selected-link' then
	* find the first top-nav anchor and add the 'selected-link' to it.
	*/
	if($('#top-nav a').hasClass('selected-link') != true) {
		$('#top-nav a:first').addClass('selected-link');
	}
	
	/*
	* If an element contains an id that starts with the string 'nav-link-' and is
	* clicked, remove the 'selected-link' class from the element that currently has 
	* it and give it to the clicked element. Return false to stop the link from loading
	* a new page.
	*/
	$('[id^="nav-link-"]').click(function(event) {
		$('#top-nav .selected-link').removeClass('selected-link');
		$(this).addClass('selected-link');
		
		var linkQuery = {
			"url":			"loadPage.php",
			"type":			"GET",
			"dataType":		"html",
			"data":		{
				"page":		$(this).attr('id')
			},
			"beforeSend":	function(jqXHR, settings) {
				$('#center-content').hide();
			},
			"success":		function(data, textStatus, jqXHR) {
				$('#center-content').html(data).fadeIn(850);
			},
			"error":		function(jqXHR, textStatus, errorThrown) {
				alert('error');
			}
		};
		$.ajax(linkQuery);
		return false;
	});
});

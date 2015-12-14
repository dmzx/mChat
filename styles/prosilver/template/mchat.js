/**
 *
 * @package mChat JavaScript Code mini
 * @version 1.4.4 of 2013-11-03
 * @copyright (c) 2009 By Shapoval Andrey Vladimirovich (AllCity) ~ http://allcity.net.ru/
 * @copyright (c) 2013 By Rich McGirr (RMcGirr83) http://rmcgirr83.org
 * @copyright (c) 2015 By dmzx - http://www.dmzx-web.net
 * @copyright (c) 2015 By kasimi
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 Code uses the titlealert jQuery plugin, options are below
 interva 500	The flashing interval in milliseconds.
 originalTitleInterval null Time in milliseconds that the original title is diplayed for. If null the time is the same as interval.
 duration 0 The total lenght of the flashing before it is automatically stopped. Zero means infinite.
 stopOnFocus	true If true, the flashing will stop when the window gets focus.
 stopOnMouseMove	false If true, the flashing will stop when the document recieves a mousemove event (i.e. when the user moves the mouse over the document area, regardless of what window is active).
 To use find titlealert in the code and make as so
 $.titleAlert(mChatNewMessageAlert, {
	 requireBlur:false,
	 stopOnFocus:false,
	 duration:4000,
	 interval:700
	});
**/
jQuery(function($) {
	var hasFocus = true;
	if (!mChat.archiveMode) {
		if (!mChat.messageTop) {
			$("#mChatmain").animate({
				scrollTop: $("#mChatmain")[0].scrollHeight
			}, 1000, "swing");
		}
		if (mChat.pause) {
			$("#mChatMessage").bind("keypress", function() {
				clearInterval(mChat.interval);
				$("#mChatLoadIMG,#mChatOkIMG,#mChatErrorIMG").hide();
				$("#mChatRefreshText").html(mChat.refreshNo).addClass("mchat-alert");
				$("#mChatPauseIMG").show();
			});
		}
		$([window, document]).blur(function() {
			hasFocus = false;
		}).focus(function() {
			hasFocus = true;
		});
		$.fn.preventDoubleSubmit = function() {
			var alreadySubmitted = false;
			return $(this).submit(function() {
				if (alreadySubmitted) {
					return false;
				} else {
					alreadySubmitted = true;
				}
			});
		};
		$.fn.autoGrowInput = function(o) {
			var width = $(".mChatPanel").width();
			o = $.extend({
				maxWidth: width - 20,
				minWidth: 0,
				comfortZone: 20
			}, o);
			this.filter("input:text").each(function() {
				var minWidth = o.minWidth || $(this).width(),
					val = "",
					input = $(this),
					testSubject = $("<div/>").css({
						position: "absolute",
						top: -9999,
						left: -9999,
						width: "auto",
						fontSize: input.css("fontSize"),
						fontFamily: input.css("fontFamily"),
						fontWeight: input.css("fontWeight"),
						letterSpacing: input.css("letterSpacing"),
						whiteSpace: "nowrap"
					}),
					check = function() {
						if (val === (val = input.val())) {
							return;
						}
						var escaped = val.replace(/&/g, "&amp;").replace(/\s/g, " ").replace(/</g, "&lt;").replace(/>/g, "&gt;");
						testSubject.html(escaped);
						var testerWidth = testSubject.width(),
							newWidth = (testerWidth + o.comfortZone) >= minWidth ? testerWidth + o.comfortZone : minWidth,
							currentWidth = input.width(),
							isValidWidthChange = (newWidth < currentWidth && newWidth >= minWidth) || (newWidth > minWidth && newWidth < o.maxWidth);
						if (isValidWidthChange) {
							input.width(newWidth);
						}
					};
				testSubject.insertAfter(input);
				$(this).bind("keypress blur change submit focus", check);
			});
			return this;
		};
		$("input.mChatText").autoGrowInput();
		$("#postform").preventDoubleSubmit();
		if (mChat.playSound && $.cookie("mChatNoSound") != "yes") {
			$.cookie("mChatNoSound", null);
			$("#mChatUseSound").attr("checked", "checked");
		} else {
			$.cookie("mChatNoSound", "yes");
			$("#mChatUseSound").removeAttr("checked");
		}
		if ($("#mChatUserList").length && ($.cookie("mChatShowUserList") == "yes" || mChat.customPage)) {
			$("#mChatUserList").show();
		}
	}

	$.extend(mChat, {
		countDown: function() {
			$("#mChatSessMess").removeClass("mchat-alert");
			mChat.sessionTime = mChat.sessionTime - 1;
			var sec = Math.floor(mChat.sessionTime);
			var min = Math.floor(sec / 60);
			var hrs = Math.floor(min / 60);
			sec = (sec % 60);
			if (sec <= 9) {
				sec = "0" + sec;
			}
			min = (min % 60);
			if (min <= 9) {
				min = "0" + min;
			}
			hrs = (hrs % 60);
			if (hrs <= 9) {
				hrs = "0" + hrs;
			}
			var time_left = hrs + ":" + min + ":" + sec;
			$("#mChatSessMess").html(mChat.sessEnds + " " + time_left);
			if (mChat.sessionTime <= 0) {
				clearInterval(mChat.counter);
				$("#mChatSessMess").html(mChat.sessOut).addClass("mchat-alert");
			}
		},
		clear: function() {
			if ($("#mChatMessage").val() === "") {
				return false;
			}
			var answer = confirm(mChat.reset);
			if (answer) {
				$("#mChatRefreshText").removeClass("mchat-alert");
				if (mChat.pause) {
					mChat.interval = setInterval(mChat.refresh, mChat.refreshTime);
				}
				$("#mChatOkIMG").show();
				$("#mChatLoadIMG, #mChatErrorIMG, #mChatPauseIMG").hide();
				$("#mChatRefreshText").html(mChat.refreshYes);
				$("#mChatMessage").val("").focus();
			} else {
				$("#mChatMessage").focus();
			}
		},
		sound: function(file) {
			if ($.cookie("mChatNoSound") == "yes") {
				return;
			}
			if (navigator.userAgent.match(/MSIE ([0-9]+)\./) || navigator.userAgent.match(/Trident\/7.0; rv 11.0/)) {
				$("#mChatSound").html('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" height="0" width="0" type="application/x-shockwave-flash"><param name="movie" value="' + file + '"></object>');
			} else {
				$("#mChatSound").html('<embed src="' + file + '" width="0" height="0" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>');
			}
		},
		notice: function() {
			if (!hasFocus || !document.hasFocus()) {
				$.titleAlert(mChat.newMessageAlert, {interval: 1000});
			}
		},
		toggle: function(id) {
			$("#mChat" + id).slideToggle("normal", function() {
				if ($("#mChat" + id).is(":visible")) {
					$.cookie("mChatShow" + id, "yes");
				} else if ($("#mChat" + id).is(":hidden")) {
					$.cookie("mChatShow" + id, null);
				}
			});
		},
		add: function() {
			if ($("#mChatMessage").val() === "") {
				return false;
			}
			var messChars = $("#mChatMessage").val().replace(/ /g, "");
			if (messChars.length > mChat.mssgLngth && mChat.mssgLngth) {
				alert(mChat.mssgLngthLong);
				return;
			}
			$.ajax({
				url: mChat.file,
				timeout: 10000,
				type: "POST",
				data: $("#postform").serialize(),
				dataType: "text",
				beforeSend: function() {
					$("#submit_button").attr("disabled", "disabled");
					if (mChat.userTimeout) {
						clearInterval(mChat.activeInterval);
						clearInterval(mChat.counter);
					}
					clearInterval(mChat.interval);
				},
				success: function() {
					mChat.refresh();
				},
				error: function(e) {
					if (e.status == 400) {
						alert(mChat.flood);
					} else if (e.status == 403) {
						alert(mChat.noAccess);
					} else if (e.status == 501) {
						alert(mChat.noMessageInput);
					}
				},
				complete: function() {
					$("#mChatNoMessage").remove();
					$("#submit_button").removeAttr("disabled");
					mChat.interval = setInterval(mChat.refresh, mChat.refreshTime);
					if (mChat.userTimeout) {
						mChat.sessionTime = mChat.userTimeout ? mChat.userTimeout / 1000 : false;
						mChat.counter = setInterval(mChat.countDown, 1000);
						mChat.activeInterval = setInterval(mChat.active, mChat.userTimeout);
					}
					$("#mChatMessage").val("").focus();
				}
			});
		},
		edit: function(id) {
			var message = $("#edit" + id).val();
			apprise(mChat.editInfo, {
				"textarea": message,
				"animate": true,
				"position": 200,
				"confirm": true
			}, function(r) {
				if (r) {
					$.ajax({
						url: mChat.file,
						timeout: 10000,
						type: "POST",
						data: {
							mode: "edit",
							message_id: id,
							message: r
						},
						dataType: "text",
						beforeSend: function() {
							clearInterval(mChat.interval);
							if (mChat.userTimeout) {
								clearInterval(mChat.activeInterval);
								clearInterval(mChat.counter);
								$("#mChatSessTimer").html(mChat.refreshing);
							}
						},
						success: function(html) {
							$("#mess" + id).fadeOut("slow", function() {
								$(this).replaceWith(html);
								$("#mess" + id).css("display", "none").fadeIn("slow");
							});
						},
						error: function(resp) {
							if (resp.status == 403) {
								alert(mChat.noAccess);
							} else if (resp.status == 501) {
								alert(mChat.noMessageInput);
							}
						},
						complete: function() {
							mChat.interval = setInterval(mChat.refresh, mChat.refreshTime);
							if (mChat.userTimeout) {
								mChat.sessionTime = mChat.userTimeout ? mChat.userTimeout / 1000 : false;
								mChat.counter = setInterval(mChat.countDown, 1000);
								mChat.activeInterval = setInterval(mChat.active, mChat.userTimeout);
							}
							if (!mChat.archiveMode && !mChat.messageTop) {
								setTimeout(function() {
									$("#mChatmain").animate({scrollTop: $("#mChatmain")[0].scrollHeight}, 1000, "swing");
								}, 1500);
							}
						}
					});
				}
			});
		},
		del: function(id) {
			apprise(mChat.delConfirm, {
				"position": 200,
				"animate": true,
				"confirm": true
			}, function(del) {
				if (del) {
					$.ajax({
						url: mChat.file,
						timeout: 10000,
						type: "POST",
						data: {
							mode: "delete",
							message_id: id
						},
						beforeSend: function() {
							clearInterval(mChat.interval);
							if (mChat.userTimeout) {
								clearInterval(mChat.activeInterval);
								clearInterval(mChat.counter);
								$("#mChatSessTimer").html(mChat.refreshing);
							}
						},
						success: function() {
							$("#mess" + id).fadeOut("slow", function() {
								$(this).remove();
							});
							mChat.sound(mChat.forumRoot + "ext/dmzx/mchat/sounds/del.swf");
						},
						error: function() {
							alert(mChat.noAccess);
						},
						complete: function() {
							mChat.interval = setInterval(mChat.refresh, mChat.refreshTime);
							if (mChat.userTimeout) {
								mChat.sessionTime = mChat.userTimeout ? mChat.userTimeout / 1000 : false;
								mChat.counter = setInterval(mChat.countDown, 1000);
								mChat.activeInterval = setInterval(mChat.active, mChat.userTimeout);
							}
						}
					});
				} else {
					return false;
				}
			});
		},
		refresh: function() {
			if (mChat.archiveMode) {
				return;
			}
			var firstLastSelector = mChat.messageTop ? ":first" : ":last";
			var messId = 0;
			if ($("#mChatData").children().not("#mChatNoMessage").length) {
				$("#mChatNoMessage").remove();
				var attr = $("#mChatData").children(firstLastSelector).not("#mChatNoMessage").attr("id");
				if (attr) {
					messId = attr.replace("mess", "");
				}
			}
			$.ajax({
				url: mChat.file,
				timeout: 10000,
				type: "POST",
				data: {
					mode: "read",
					message_last_id: messId
				},
				dataType: "html",
				beforeSend: function() {
					$("#mChatOkIMG, #mChatErrorIMG, #mChatPauseIMG").hide();
					$("#mChatLoadIMG").show();
				},
				success: function(html) {
					var $html = $($.trim(html));
					if ($html.length) {
						$("#mChatRefreshText").removeClass("mchat-alert");
						$html.hide();
						if (mChat.messageTop) {
							$("#mChatData").prepend($html);
						} else {
							$("#mChatData").append($html);
						}
						$html.fadeIn("slow");
						$("#mChatmain").stop().animate({scrollTop: mChat.messageTop ? 0 : $("#mChatmain")[0].scrollHeight}, 2000);
						mChat.sound(mChat.forumRoot + "ext/dmzx/mchat/sounds/add.swf");
						mChat.notice();
					}
					setTimeout(function() {
						$("#mChatLoadIMG, #mChatErrorIMG, #mChatPauseIMG").hide();
						$("#mChatOkIMG").show();
						$("#mChatRefreshText").html(mChat.refreshYes);
					}, 500);
				},
				error: function() {
					$("#mChatLoadIMG, #mChatOkIMG, #mChatPauseIMG, #mChatRefreshTextNo, #mChatPauseIMG,").hide();
					$("#mChatErrorIMG").show();
					mChat.sound(mChat.forumRoot + "ext/dmzx/mchat/sounds/error.swf");
				},
				complete: function() {
					if (!$("#mChatData").children(firstLastSelector).length) {
						$("#mChatData").append('<div id="mChatNoMessage">' + mChat.noMessages + "</div>").show("slow");
					}
				}
			});
		},
		stats: function() {
			if (!mChat.whois) {
				return;
			}
			$.ajax({
				url: mChat.file,
				timeout: 10000,
				type: "POST",
				data: {
					mode: "stats"
				},
				dataType: "html",
				beforeSend: function() {
					if (mChat.customPage) {
						$("#mChatRefreshN").show();
						$("#mChatRefresh").hide();
					}
				},
				success: function(data) {
					var json = $.parseJSON(data);
					$("#mChatStats").replaceWith(json.message);
					if (mChat.customPage) {
						setTimeout(function() {
							$("#mChatRefreshN").hide();
							$("#mChatRefresh").show();
						}, 500);
					}
				},
				error: function() {
					mChat.sound(mChat.forumRoot + "ext/dmzx/mchat/sounds/error.swf");
				},
				complete: function() {
					if ($("#mChatUserList").length && ($.cookie("mChatShowUserList") == "yes" || mChat.customPage)) {
						$("#mChatUserList").css("display", "block");
					}
				}
			});
		},
		active: function() {
			if (mChat.archiveMode || !mChat.userTimeout) {
				return;
			}
			clearInterval(mChat.interval);
			$("#mChatLoadIMG,#mChatOkIMG,#mChatErrorIMG").hide();
			$("#mChatPauseIMG").show();
			$("#mChatRefreshText").html(mChat.refreshNo).addClass("mchat-alert");
			$("#mChatSessMess").html(mChat.sessOut).addClass("mchat-alert");
		}
	});

	mChat.interval = setInterval(mChat.refresh, mChat.refreshTime);
	mChat.statsInterval = setInterval(mChat.stats, mChat.whoisRefresh);
	mChat.activeInterval = setInterval(mChat.active, mChat.userTimeout);
	mChat.sessionTime = mChat.userTimeout ? mChat.userTimeout / 1000 : false;

	if (mChat.userTimeout) {
		mChat.counter = setInterval(mChat.countDown, 1000);
	}

	if ($.cookie("mChatShowSmiles") == "yes" && $("#mChatSmiles").css("display", "none")) {
		$("#mChatSmiles").slideToggle("slow");
	}

	if ($.cookie("mChatShowBBCodes") == "yes" && $("#mChatBBCodes").css("display", "none")) {
		$("#mChatBBCodes").slideToggle("slow");
	}

	if ($.cookie("mChatShowUserList") == "yes" && $("#mChatUserList").length) {
		$("#mChatUserList").slideToggle("slow");
	}

	if ($.cookie("mChatShowColour") == "yes" && $("#mChatColour").css("display", "none")) {
		$("#mChatColour").slideToggle("slow");
	}

	$("#mChatUseSound").change(function() {
		$.cookie("mChatNoSound", $(this).is(":checked") ? null : "yes");
	});

	// Apprise 1.5 by Daniel Raftery
	// http://thrivingkings.com/apprise
	//
	// Button text added by Adam Bezulski
	//
	// Cached jQuery variables, position center added by Josiah Ruddell
	function apprise(a, b, c) {
		a = '<span style="font-weight:bold; font-size:1.2em;">' + a + "</span>";
		var d = {
			confirm: false,
			verify: false,
			input: false,
			textarea: false,
			animate: false,
			textOk: "Ok",
			textCancel: "Cancel",
			textYes: "Yes",
			textNo: "No",
			position: "center"
		};
		if (b) {
			for (var e in d) {
				if (typeof b[e] == "undefined") b[e] = d[e];
			}
		}
		var f = $(document).height(),
			g = $(document).width(),
			h = $('<div class="appriseOuter"></div>'),
			i = $('<div class="appriseOverlay" id="aOverlay"></div>'),
			j = $('<div class="appriseInner"></div>'),
			k = $('<div class="aButtons"></div>'),
			l = 300;
		i.css({
			height: f,
			width: g
		}).appendTo("body").fadeIn(100, function() {
			$(this).css("filter", "alpha(opacity=70)");
		});
		h.prependTo("body");
		j.append(a).appendTo(h);
		if (b) {
			if (b.input) {
				if (typeof b.input == "string") {
					j.append('<div class="aInput"><input type="text" class="aTextbox" t="aTextbox" value="' + b.input + '" /></div>');
				} else {
					j.append('<div class="aInput"><input type="text" class="aTextbox" t="aTextbox" /></div>');
				}
				$(".aTextbox").focus();
			}
			if (typeof b.textarea == "string") {
				j.append('<div class="aInput"><textarea name="message" class="aEdit" style="height: 9em;" rows="5" cols="180">' + b.textarea + "</textarea></div>");
				$(".aEdit").focus();
			}
		}
		j.append(k);
		if (b) {
			if (b.confirm || b.input) {
				k.append('<button value="ok">' + b.textOk + "</button>");
				k.append('<button value="cancel">' + b.textCancel + "</button>");
			} else if (b.verify) {
				k.append('<button value="ok">' + b.textYes + "</button>");
				k.append('<button value="cancel">' + b.textNo + "</button>");
			} else {
				k.append('<button value="ok">' + b.textOk + "</button>");
			}
		} else {
			k.append('<button value="ok">Ok</button>');
		}
		h.css("left", ($(window).width() - $(".appriseOuter").width()) / 2 + $(window).scrollLeft() + "px");
		if (b) {
			if (b.position && b.position === "center") {
				l = (f - h.height()) / 2;
			}
			if (b.animate) {
				var m = b.animate;
				if (isNaN(m)) {
					m = 400;
				}
				h.css("top", "-200px").show().animate({
					top: l
				}, m);
			} else {
				h.css("top", l).fadeIn(200);
			}
		} else {
			h.css("top", l).fadeIn(200);
		}
		$(document).keydown(function(a) {
			if (i.is(":visible")) {
				if (a.shiftKey && a.keyCode == 13) {
					$(".aEdit").append("<br />");
				} else if (a.keyCode == 13) {
					$('.aButtons > button[value="ok"]').click();
				} else if (a.keyCode == 27) {
					$('.aButtons > button[value="cancel"]').click();
				}
			}
		});
		var n = $(".aTextbox").val();
		if (!n) {
			n = false;
		}
		$(".aTextbox").bind("keydown blur", function() {
			n = $(this).val();
		});
		var o = $(".aEdit").val();
		if (!o) {
			o = false;
		}
		$(".aEdit").bind("keydown blur", function() {
			o = $(this).val();
		});
		$(".aButtons > button").click(function() {
			i.remove();
			h.remove();
			if (c) {
				$(this).text("");
				var a = $(this).attr("value");
				if (a == "ok") {
					if (b) {
						if (b.input) {
							c(n);
						} else if (b.textarea) {
							c(o);
						} else {
							c(true);
						}
					} else {
						c(true);
					}
					$("#mChatMessage").focus();
				} else if (a == "cancel") {
					c(false);
					$("#mChatMessage").focus();
				}
			}
		});
	}
});

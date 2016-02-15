/**
 *
 * @package mChat JavaScript Code mini
 * @version 1.5.1 of 2016-01-17
 * @copyright (c) 2009 By Shapoval Andrey Vladimirovich (AllCity) ~ http://allcity.net.ru/
 * @copyright (c) 2013 By Rich McGirr (RMcGirr83) http://rmcgirr83.org
 * @copyright (c) 2015 By dmzx - http://www.dmzx-web.net
 * @copyright (c) 2015 By kasimi
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */
// Support Opera
if (typeof document.hasFocus === 'undefined') {
	document.hasFocus = function() {
		return document.visibilityState == 'visible';
	};
}

jQuery(function($) {
	var ajaxRequest = function(mode, sendHiddenFields, data) {
		var deferred = $.Deferred();
		var promise = deferred.promise();
		if (sendHiddenFields) {
			$.extend(data, mChat.hiddenFields);
		}
		$.ajax({
			url: mChat.file.replace('mchat', 'mchat-' + mode),
			timeout: 5000,
			type: 'POST',
			dataType: 'json',
			data: data
		}).success(function(json, status, xhr) {
			if (json[mode]) {
				deferred.resolve(json, status, xhr);
			} else {
				deferred.reject(xhr, status, xhr.responseJSON ? 'session' : 'format');
			}
		}).error(function(xhr, status, error) {
			deferred.reject(xhr, status, error);
		});
		return promise.fail(function(xhr, textStatus, errorThrown) {
			mChat.sound('error');
			mChat.$$('refresh-load', 'refresh-ok', 'refresh-paused').hide();
			mChat.$$('refresh-error').show();
			if (errorThrown == 'format') {
				// Unexpected format
			} else if (errorThrown == 'session') {
				mChat.endSession();
				alert(mChat.sessOut);
			} else if (xhr.status == 400) {
				alert(mChat.flood);
			} else if (xhr.status == 403) {
				alert(mChat.noAccess);
			} else if (xhr.status == 413) {
				alert(mChat.mssgLngthLong);
			} else if (xhr.status == 501) {
				alert(mChat.noMessageInput);
			} else if (typeof console !== 'undefined' && console.log) {
				console.log('AJAX error. status: ' + textStatus + ', message: ' + errorThrown);
			}
		});
	};

	$.extend(mChat, {
		clear: function() {
			if (mChat.$$('input').val() !== '') {
				if (confirm(mChat.clearConfirm)) {
					mChat.resetSession(true);
					mChat.$$('input').val('');
				}
				mChat.$$('input').focus();
			}
		},
		sound: function(file) {
			if (!mChat.pageIsUnloading && !Cookies.get('mchat_no_sound')) {
				var audio = mChat.$$('sound-' + file).get(0);
				if (audio.duration) {
					audio.pause();
					audio.currentTime = 0;
					audio.play();
				}
			}
		},
		notice: function() {
			if (!document.hasFocus()) {
				$.titleAlert(mChat.newMessageAlert, {interval: 1000});
			}
		},
		toggle: function(name) {
			var $elem = mChat.$$(name);
			$elem.stop().slideToggle(function() {
				var cookieName = 'mchat_show_' + name;
				if ($elem.is(':visible')) {
					Cookies.set(cookieName, 'yes');
				} else {
					Cookies.remove(cookieName);
				}
			});
		},
		add: function() {
			if (mChat.$$('add').prop('disabled')) {
				return;
			}
			if ($.trim(mChat.$$('input').val()) === '') {
				return;
			}
			var messChars = mChat.$$('input').val().replace(/\s/g, '');
			if (mChat.mssgLngth && messChars.length > mChat.mssgLngth) {
				alert(mChat.mssgLngthLong);
				return;
			}
			mChat.pauseSession();
			mChat.$$('add').prop('disabled', true);
			mChat.refresh(mChat.$$('input').val()).done(function() {
				mChat.$$('input').val('');
			}).always(function() {
				mChat.$$('input').focus();
				mChat.$$('add').prop('disabled', false);
				mChat.resetSession(false);
			});
		},
		edit: function() {
			var $container = $(this).closest('.mchat-message');
			var $message = mChat.$$('confirm').find('textarea').show().val($container.data('message'));
			mChat.$$('confirm').find('p').text(mChat.editInfo);
			phpbb.confirm(mChat.$$('confirm'), function() {
				ajaxRequest('edit', true, {
					message_id: $container.data('id'),
					message: $message.val()
				}).done(function(json) {
					mChat.sound('edit');
					$container.fadeOut('slow', function() {
						$container.replaceWith($(json.edit).hide().fadeIn('slow'));
					});
					mChat.resetSession(true);
				});
			});
		},
		del: function() {
			var $container = $(this).closest('.mchat-message');
			mChat.$$('confirm').find('textarea').hide();
			mChat.$$('confirm').find('p').text(mChat.delConfirm);
			phpbb.confirm(mChat.$$('confirm'), function() {
				ajaxRequest('del', true, {
					message_id: $container.data('id')
				}).done(function() {
					mChat.sound('del');
					$container.fadeOut('slow', function() {
						$container.remove();
					});
					mChat.resetSession(true);
				});
			});
		},
		refresh: function(message) {
			var $messages = mChat.$$('messages').children();
			var data = {
				message_last_id: $messages.filter(mChat.messageTop ? ':first' : ':last').data('id')
			};
			if (message) {
				data.message = message;
			}
			if (mChat.liveUpdates) {
				data.message_first_id = $messages.filter(mChat.messageTop ? ':last' : ':first').data('id');
				data.message_edits = {};
				var now = Math.floor(Date.now() / 1000);
				$.each($messages, function() {
					var $message = $(this);
					var editTime = $message.data('edit-time');
					if (editTime && (!mChat.editDeleteLimit || $message.data('message-time') >= now - mChat.editDeleteLimit / 1000)) {
						data.message_edits[$message.data('id')] = editTime;
					}
				});
			}
			mChat.$$('refresh-ok', 'refresh-error', 'refresh-paused').hide();
			mChat.$$('refresh-load').show();
			return ajaxRequest(message ? 'add' : 'refresh', !!message, data).done(function(json) {
				var $html = $(json.add);
				if ($html.length) {
					mChat.sound('add');
					mChat.notice();
					mChat.$$('no-messages').remove();
					$html.hide().each(function(i) {
						var $message = $(this);
						setTimeout(function() {
							if (mChat.messageTop) {
								mChat.$$('messages').prepend($message);
							} else {
								mChat.$$('messages').append($message);
							}
							$message.css('opacity', 0).slideDown('slow').animate({opacity: 1}, {queue: false, duration: 'slow'});
							mChat.$$('main').animate({scrollTop: mChat.messageTop ? 0 : mChat.$$('main')[0].scrollHeight}, 'slow');
						}, i * 600);
						if (mChat.editDeleteLimit && $message.data('edit-delete-limit') && $message.find('[data-mchat-action="edit"], [data-mchat-action="del"]').length > 0) {
							var id = $message.attr('id');
							setTimeout(function() {
								$('#' + id).find('[data-mchat-action="edit"], [data-mchat-action="del"]').fadeOut('slow', function() {
									$(this).remove();
								});
							}, mChat.editDeleteLimit);
						}
					});
				}
				if (json.edit) {
					var isFirstEdit = true;
					$.each(json.edit, function(id, content) {
						var $container = $('#mchat-message-' + id);
						if ($container.length) {
							if (isFirstEdit) {
								isFirstEdit = false;
								mChat.sound('edit');
							}
							$container.fadeOut('slow', function() {
								$container.replaceWith($(content).hide().fadeIn('slow'));
							});
						}
					});
				}
				if (json.del) {
					var isFirstDelete = true;
					$.each(json.del, function(i, id) {
						var $container = $('#mchat-message-' + id);
						if ($container.length) {
							if (isFirstDelete) {
								isFirstDelete = false;
								mChat.sound('del');
							}
							$container.fadeOut('slow', function() {
								$container.remove();
							});
						}
					});
				}
				setTimeout(function() {
					if (mChat.refreshInterval) {
						mChat.$$('refresh-load', 'refresh-error', 'refresh-paused').hide();
						mChat.$$('refresh-ok').show();
					}
				}, 250);
			});
		},
		whois: function() {
			if (mChat.customPage) {
				mChat.$$('refresh-pending').show();
				mChat.$$('refresh').hide();
			}
			ajaxRequest('whois', false, {}).done(function(json) {
				var $whois = $(json.whois);
				var $userlist = $whois.find('#mchat-userlist');
				if (Cookies.get('mchat_show_userlist')) {
					$userlist.show();
				}
				mChat.$$('whois').replaceWith($whois);
				mChat.cache.whois = $whois;
				mChat.cache.userlist = $userlist;
				if (mChat.customPage) {
					setTimeout(function() {
						mChat.$$('refresh-pending').hide();
						mChat.$$('refresh').show();
					}, 250);
				}
			});
		},
		timeLeft: function(sessionTime) {
			return (new Date(sessionTime * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
		},
		countDown: function() {
			mChat.sessionTime -= 1;
			mChat.$$('session').html(mChat.sessEnds + ' ' + mChat.timeLeft(mChat.sessionTime));
			if (mChat.sessionTime < 1) {
				mChat.endSession();
			}
		},
		pauseSession: function() {
			clearInterval(mChat.refreshInterval);
			if (mChat.userTimeout) {
				clearInterval(mChat.sessionCountdown);
			}
			if (mChat.whoisRefresh) {
				clearInterval(mChat.whoisInterval);
			}
		},
		resetSession: function(updateUi) {
			clearInterval(mChat.refreshInterval);
			mChat.refreshInterval = setInterval(mChat.refresh, mChat.refreshTime);
			if (mChat.userTimeout) {
				mChat.sessionTime = mChat.userTimeout / 1000;
				clearInterval(mChat.sessionCountdown);
				mChat.$$('session').html(mChat.sessEnds + ' ' + mChat.timeLeft(mChat.sessionTime));
				mChat.sessionCountdown = setInterval(mChat.countDown, 1000);
			}
			if (mChat.whoisRefresh) {
				clearInterval(mChat.whoisInterval);
				mChat.whoisInterval = setInterval(mChat.whois, mChat.whoisRefresh);
			}
			if (mChat.pause) {
				mChat.$$('input').one('keypress', mChat.endSession);
			}
			if (updateUi) {
				mChat.$$('refresh-ok').show();
				mChat.$$('refresh-load', 'refresh-error', 'refresh-paused').hide();
				mChat.$$('refresh-text').html(mChat.refreshYes);
			}
		},
		endSession: function() {
			clearInterval(mChat.refreshInterval);
			mChat.refreshInterval = false;
			if (mChat.userTimeout) {
				clearInterval(mChat.sessionCountdown);
				mChat.$$('session').html(mChat.sessOut);
			}
			if (mChat.whoisRefresh) {
				clearInterval(mChat.whoisInterval);
				mChat.whois();
			}
			mChat.$$('refresh-load', 'refresh-ok', 'refresh-error').hide();
			mChat.$$('refresh-paused').show();
			mChat.$$('refresh-text').html(mChat.refreshNo);
		},
		mention: function() {
			var $container = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($container.data('username'));
			var usercolor = $container.data('usercolor');
			if (usercolor) {
				username = '[b][color=' + usercolor + ']' + username + '[/color][/b]';
			} else if (mChat.allowBBCodes) {
				username = '[b]' + username + '[/b]';
			}
			insert_text('@ ' + username + ', ');
		},
		quote: function() {
			var $container = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($container.data('username'));
			var quote = mChat.entityDecode($container.data('message'));
			insert_text('[quote="' + username + '"] ' + quote + '[/quote]');
		},
		like: function() {
			var $container = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($container.data('username'));
			var quote = mChat.entityDecode($container.data('message'));
			insert_text(mChat.likes + '[quote="' + username + '"] ' + quote + '[/quote]');
		},
		entityDecode: function(text) {
			var s = decodeURIComponent(text.toString().replace(/\+/g, ' '));
			s = s.replace(/&lt;/g, '<');
			s = s.replace(/&gt;/g, '>');
			s = s.replace(/&#58;/g, ':');
			s = s.replace(/&#46;/g, '.');
			s = s.replace(/&amp;/g, '&');
			s = s.replace(/&quot;/g, "'");
			return s;
		},
		$$: function() {
			return $($.map(arguments, function(name) {
				if (!mChat.cache[name]) {
					mChat.cache[name] = $('#mchat-' + name);
				}
				return mChat.cache[name];
			})).map(function() {
				return this.toArray();
			});
		}
	});

	mChat.cache = {};
	mChat.$$('confirm').detach().show();

	mChat.hiddenFields = {};
	$('#mchat-form').find('input[type=hidden]').each(function() {
		mChat.hiddenFields[this.name] = this.value;
	});

	if (!mChat.archiveMode) {
		$.fn.autoGrowInput = function() {
			this.filter('input:text').each(function() {
				var comfortZone = 20;
				var minWidth = $(this).width();
				var val = '';
				var input = $(this);
				var testSubject = $('<div>').css({
					position: 'absolute',
					top: -9999,
					left: -9999,
					width: 'auto',
					fontSize: input.css('fontSize'),
					fontFamily: input.css('fontFamily'),
					fontWeight: input.css('fontWeight'),
					letterSpacing: input.css('letterSpacing'),
					whiteSpace: 'nowrap'
				});
				testSubject.insertAfter(input);
				$(this).on('keypress blur change submit focus', function() {
					if (val === (val = input.val())) {
						return;
					}
					var escaped = val.replace(/&/g, '&amp;').replace(/\s/g, ' ').replace(/</g, '&lt;').replace(/>/g, '&gt;');
					var testerWidth = testSubject.html(escaped).width();
					var newWidth = (testerWidth + comfortZone) >= minWidth ? testerWidth + comfortZone : minWidth;
					if ((newWidth < input.width() && newWidth >= minWidth) || (newWidth > minWidth && newWidth < $('.mchat-panel').width() - comfortZone)) {
						input.width(newWidth);
					}
				});
			});
			return this;
		};

		mChat.resetSession(true);

		if (!mChat.messageTop) {
			mChat.$$('main').animate({scrollTop: mChat.$$('main')[0].scrollHeight}, 'slow', 'swing');
		}

		mChat.$$('user-sound').prop('checked', mChat.playSound && !Cookies.get('mchat_no_sound'));

		if (Cookies.get('mchat_show_smilies')) {
			mChat.$$('smilies').slideToggle('slow');
		}

		if (Cookies.get('mchat_show_bbcodes')) {
			mChat.$$('bbcodes').slideToggle('slow', function() {
				if (Cookies.get('mchat_show_colour')) {
					mChat.$$('colour').slideToggle('slow');
				}
			});
		}

		if (Cookies.get('mchat_show_userlist')) {
			mChat.$$('userlist').slideToggle('slow');
		}

		mChat.$$('colour').html(phpbb.colorPalette('h', 15, 10)).on('click', 'a', function(e) {
			var color = $(this).data('color');
			bbfontstyle('[color=#' + color + ']', '[/color]');
			e.preventDefault();
		});

		if (!mChat.$$('user-sound').prop('checked')) {
			Cookies.set('mchat_no_sound', 'yes');
		}

		mChat.$$('user-sound').change(function() {
			if (this.checked) {
				Cookies.remove('mchat_no_sound');
			} else {
				Cookies.set('mchat_no_sound', 'yes');
			}
		});

		if (mChat.$$('input').is('input')) {
			$('#mchat-form').on('keypress', function(e) {
				if (e.which == 13) {
					mChat.add();
					e.preventDefault();
				}
			});
		}

		mChat.$$('input').autoGrowInput();
	}

	$(window).on('beforeunload', function() {
		mChat.pageIsUnloading = true;
	});

	$('#phpbb').on('click', '[data-mchat-action]', function(e) {
		var action = $(this).data('mchat-action');
		mChat[action].call(this);
		e.preventDefault();
	}).on('click', '[data-mchat-toggle]', function(e) {
		var elem = $(this).data('mchat-toggle');
		mChat.toggle(elem);
		e.preventDefault();
	});
});

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2009 By Shapoval Andrey Vladimirovich (AllCity) ~ http://allcity.net.ru/
 * @copyright (c) 2013 By Rich McGirr (RMcGirr83) http://rmcgirr83.org
 * @copyright (c) 2015 By dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 By kasimi
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

// Support Opera
if (typeof document.hasFocus === 'undefined') {
	document.hasFocus = function() {
		return document.visibilityState == 'visible';
	};
}

Array.prototype.max = function() {
	return Math.max.apply(null, this);
};

Array.prototype.min = function() {
	return Math.min.apply(null, this);
};

jQuery.fn.reverse = function(reverse) {
	reverse = typeof reverse === 'undefined' ? true : reverse;
	return reverse ? jQuery(this.toArray().reverse()) : this;
};

jQuery(function($) {
	var ajaxRequest = function(mode, sendHiddenFields, data) {
		var deferred = $.Deferred();
		if (sendHiddenFields) {
			$.extend(data, mChat.hiddenFields);
		}
		$.ajax({
			url: mChat.actionUrls[mode],
			timeout: 5000,
			type: 'POST',
			dataType: 'json',
			data: data
		}).done(function(json, status, xhr) {
			if (json[mode]) {
				deferred.resolve(json, status, xhr);
			} else {
				deferred.reject(xhr, status, xhr.responseJSON ? 'session' : 'format');
			}
		}).fail(function(xhr, status, error) {
			deferred.reject(xhr, status, error);
		});
		return deferred.promise().fail(function(xhr, textStatus, errorThrown) {
			mChat.sound('error');
			mChat.cached('refresh-load', 'refresh-ok', 'refresh-paused').hide();
			mChat.cached('refresh-error').show();
			if (errorThrown == 'format') {
				// Unexpected format
			} else if (errorThrown == 'session') {
				mChat.endSession(true);
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
			if (mChat.cached('input').val() !== '') {
				if (confirm(mChat.clearConfirm)) {
					mChat.resetSession();
					mChat.cached('input').val('');
				}
				setTimeout(function() {
					mChat.cached('input').focus();
				}, 1);
			}
		},
		sound: function(file) {
			if (!mChat.pageIsUnloading && !Cookies.get('mchat_no_sound')) {
				var audio = mChat.cached('sound-' + file).get(0);
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
			var $elem = mChat.cached(name);
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
			if (mChat.cached('add').prop('disabled')) {
				return;
			}
			var message = mChat.cached('input').val();
			if ($.trim(message) === '') {
				return;
			}
			var messChars = message.replace(/\s/g, '');
			if (mChat.mssgLngth && messChars.length > mChat.mssgLngth) {
				alert(mChat.mssgLngthLong);
				return;
			}
			mChat.cached('add').prop('disabled', true);
			mChat.pauseSession();
			mChat.lastInputValue = message;
			mChat.cached('input').val('');
			mChat.refresh(message).done(function() {
				mChat.resetSession();
			}).fail(function() {
				mChat.cached('input').val(mChat.lastInputValue);
			}).always(function() {
				mChat.cached('add').prop('disabled', false);
				setTimeout(function() {
					mChat.cached('input').focus();
				}, 1);
			});
		},
		edit: function() {
			var $container = $(this).closest('.mchat-message');
			var $message = mChat.cached('confirm').find('textarea').show().val($container.data('mchat-message'));
			mChat.cached('confirm').find('p').text(mChat.editInfo);
			phpbb.confirm(mChat.cached('confirm'), function() {
				ajaxRequest('edit', true, {
					message_id: $container.data('mchat-id'),
					message: $message.val(),
					archive: mChat.archiveMode ? 1 : 0
				}).done(function(json) {
					mChat.updateMessages($(json.edit));
					mChat.resetSession();
				});
			});
		},
		del: function() {
			var $container = $(this).closest('.mchat-message');
			mChat.cached('confirm').find('textarea').hide();
			mChat.cached('confirm').find('p').text(mChat.delConfirm);
			phpbb.confirm(mChat.cached('confirm'), function() {
				var delId = $container.data('mchat-id');
				ajaxRequest('del', true, {
					message_id: delId
				}).done(function() {
					mChat.removeMessages([delId]);
					mChat.resetSession();
				});
			});
		},
		refresh: function(message) {
			var $messages = mChat.cached('messages').children();
			var data = {
				message_last_id: mChat.messageIds.length ? mChat.messageIds.max() : 0
			};
			if (message) {
				data.message = message;
			}
			if (mChat.liveUpdates) {
				data.message_first_id = mChat.messageIds.length ? mChat.messageIds.min() : 0;
				data.message_edits = {};
				var now = Math.floor(Date.now() / 1000);
				$.each($messages, function() {
					var $message = $(this);
					var editTime = $message.data('mchat-edit-time');
					if (editTime && (!mChat.editDeleteLimit || $message.data('mchat-message-time') >= now - mChat.editDeleteLimit / 1000)) {
						data.message_edits[$message.data('mchat-id')] = editTime;
					}
				});
			}
			mChat.cached('refresh-ok', 'refresh-error', 'refresh-paused').hide();
			mChat.cached('refresh-load').show();
			return ajaxRequest(message ? 'add' : 'refresh', !!message, data).done(function(json) {
				if (json.add) {
					var $html = $(json.add);
					$('#mchat-no-messages').remove();
					$html.reverse(mChat.messageTop).hide().each(function(i) {
						var $message = $(this);
						mChat.messageIds.push($message.data('mchat-id'));
						setTimeout(function() {
							if (mChat.messageTop) {
								mChat.cached('messages').prepend($message);
							} else {
								mChat.cached('messages').append($message);
							}
							$message.css('opacity', 0).slideDown().animate({opacity: 1}, {queue: false});
							mChat.cached('messages').animate({scrollTop: mChat.messageTop ? 0 : mChat.cached('messages')[0].scrollHeight});
						}, i * 400);
						if (mChat.editDeleteLimit && $message.data('mchat-edit-delete-limit') && $message.find('[data-mchat-action="edit"], [data-mchat-action="del"]').length > 0) {
							var id = $message.prop('id');
							setTimeout(function() {
								$('#' + id).find('[data-mchat-action="edit"], [data-mchat-action="del"]').fadeOut(function() {
									$(this).remove();
								});
							}, mChat.editDeleteLimit);
						}
						mChat.startRelativeTimeUpdate($message);
					});
					mChat.sound('add');
					mChat.notice();
				}
				if (json.edit) {
					mChat.updateMessages($(json.edit));
				}
				if (json.del) {
					mChat.removeMessages(json.del);
				}
				if (json.whois) {
					mChat.whois();
				}
				if (mChat.refreshInterval) {
					mChat.cached('refresh-load', 'refresh-error', 'refresh-paused').hide();
					mChat.cached('refresh-ok').show();
				}
			});
		},
		whois: function() {
			if (mChat.customPage) {
				mChat.cached('refresh-pending').show();
				mChat.cached('refresh-explain').hide();
			}
			ajaxRequest('whois', false, {}).done(function(json) {
				var $whois = $(json.whois);
				var $userlist = $whois.find('#mchat-userlist');
				if (Cookies.get('mchat_show_userlist')) {
					$userlist.show();
				}
				mChat.cached('whois').replaceWith($whois);
				mChat.cache.whois = $whois;
				mChat.cache.userlist = $userlist;
				if (mChat.customPage) {
					mChat.cached('refresh-pending').hide();
					mChat.cached('refresh-explain').show();
				}
			});
		},
		updateMessages: function($messages) {
			var soundPlayed = false;
			$messages.each(function() {
				var $newMessage = $(this);
				var $oldMessage = $('#mchat-message-' + $newMessage.data('mchat-id'));
				mChat.stopRelativeTimeUpdate($oldMessage);
				mChat.startRelativeTimeUpdate($newMessage);
				$oldMessage.fadeOut(function() {
					$oldMessage.replaceWith($newMessage.hide().fadeIn());
				});
				if (!soundPlayed) {
					soundPlayed = true;
					mChat.sound('edit');
				}
			});
		},
		removeMessages: function(ids) {
			var soundPlayed = false;
			$.each(ids, function(i, id) {
				var index = 0;
				while ((index = $.inArray(id, mChat.messageIds, index)) !== -1) {
					mChat.messageIds.splice(index, 1);
					var $message = $('#mchat-message-' + id);
					mChat.stopRelativeTimeUpdate($message);
					$message.fadeOut(function() {
						$message.remove();
					});
					if (!soundPlayed) {
						soundPlayed = true;
						mChat.sound('del');
					}
				}
			});
		},
		startRelativeTimeUpdate: function($messages) {
			if (mChat.relativeTime) {
				$messages.find('.mchat-time[data-mchat-relative-update]').each(function() {
					var $time = $(this);
					setTimeout(function() {
						mChat.relativeTimeUpdate($time);
						$time.data('mchat-relative-interval', setInterval(function() {
							mChat.relativeTimeUpdate($time);
						}, 60 * 1000));
					}, $time.data('mchat-relative-update') * 1000);
				});
			}
		},
		relativeTimeUpdate: function($time) {
			var minutesAgo = $time.data('mchat-minutes-ago') + 1;
			var langMinutesAgo = mChat.minutesAgo[minutesAgo];
			if (langMinutesAgo) {
				$time.text(langMinutesAgo).data('mchat-minutes-ago', minutesAgo);
			} else {
				mChat.stopRelativeTimeUpdate($time);
				$time.text($time.attr('title')).removeAttr('data-mchat-relative-update data-mchat-minutes-ago data-mchat-relative-interval');
			}
		},
		stopRelativeTimeUpdate: function($message) {
			var selector = '.mchat-time[data-mchat-relative-update]';
			clearInterval($message.find(selector).addBack(selector).data('mchat-relative-interval'));
		},
		timeLeft: function(sessionTime) {
			return (new Date(sessionTime * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
		},
		countDown: function() {
			mChat.sessionTime -= 1;
			mChat.cached('session').html(mChat.sessEnds + ' ' + mChat.timeLeft(mChat.sessionTime));
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
		resetSession: function() {
			if (!mChat.archiveMode) {
				clearInterval(mChat.refreshInterval);
				mChat.refreshInterval = setInterval(mChat.refresh, mChat.refreshTime);
				if (mChat.userTimeout) {
					mChat.sessionTime = mChat.userTimeout / 1000;
					clearInterval(mChat.sessionCountdown);
					mChat.cached('session').html(mChat.sessEnds + ' ' + mChat.timeLeft(mChat.sessionTime));
					mChat.sessionCountdown = setInterval(mChat.countDown, 1000);
				}
				if (mChat.whoisRefresh) {
					clearInterval(mChat.whoisInterval);
					mChat.whoisInterval = setInterval(mChat.whois, mChat.whoisRefresh);
				}
				if (mChat.pause) {
					mChat.cached('input').one('keypress', mChat.endSession);
				}
				mChat.cached('refresh-ok').show();
				mChat.cached('refresh-load', 'refresh-error', 'refresh-paused').hide();
				mChat.cached('refresh-text').html(mChat.refreshYes);
			}
		},
		endSession: function(skipUpdateWhois) {
			clearInterval(mChat.refreshInterval);
			mChat.refreshInterval = false;
			if (mChat.userTimeout) {
				clearInterval(mChat.sessionCountdown);
				mChat.cached('session').html(mChat.sessOut);
			}
			if (mChat.whoisRefresh) {
				clearInterval(mChat.whoisInterval);
				if (!skipUpdateWhois) {
					mChat.whois();
				}
			}
			mChat.cached('refresh-load', 'refresh-ok', 'refresh-error').hide();
			mChat.cached('refresh-paused').show();
			mChat.cached('refresh-text').html(mChat.refreshNo);
		},
		mention: function() {
			var $container = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($container.data('mchat-username'));
			var usercolor = $container.data('mchat-usercolor');
			if (usercolor) {
				username = '[b][color=' + usercolor + ']' + username + '[/color][/b]';
			} else if (mChat.allowBBCodes) {
				username = '[b]' + username + '[/b]';
			}
			insert_text('@ ' + username + ', ');
		},
		quote: function() {
			var $container = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($container.data('mchat-username'));
			var quote = mChat.entityDecode($container.data('mchat-message'));
			insert_text('[quote="' + username + '"] ' + quote + '[/quote]');
		},
		like: function() {
			var $container = $(this).closest('.mchat-message');
			var username = mChat.entityDecode($container.data('mchat-username'));
			var quote = mChat.entityDecode($container.data('mchat-message'));
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
		cached: function() {
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
	mChat.cached('confirm').detach().show();

	mChat.messageIds = mChat.cached('messages').children().map(function() {
		return $(this).data('mchat-id');
	}).get();

	mChat.hiddenFields = {};
	$('#mchat-form').find('input[type=hidden]').each(function() {
		mChat.hiddenFields[this.name] = this.value;
	});

	if (!mChat.archiveMode) {
		mChat.resetSession();

		if (!mChat.messageTop) {
			mChat.cached('messages').animate({scrollTop: mChat.cached('messages')[0].scrollHeight, easing: 'swing', duration: 'slow'});
		}

		if (!mChat.cached('user-sound').prop('checked')) {
			Cookies.set('mchat_no_sound', 'yes');
		}

		mChat.cached('user-sound').prop('checked', mChat.playSound && !Cookies.get('mchat_no_sound'));

		mChat.cached('user-sound').change(function() {
			if (this.checked) {
				Cookies.remove('mchat_no_sound');
			} else {
				Cookies.set('mchat_no_sound', 'yes');
			}
		});

		$.each(mChat.removeBBCodes.split('|'), function(i, bbcode) {
			$('#format-buttons .bbcode-' + bbcode).remove();
		});

		var $colourPalette = $('#colour_palette');
		$colourPalette.appendTo($colourPalette.parent()).wrap('<div id="mchat-colour"></div>').show();
		$('#bbpalette,#abbc3_bbpalette').prop('onclick', null).attr('data-mchat-toggle', 'colour');

		$.each(['userlist', 'smilies', 'bbcodes', 'colour'], function(i, elem) {
			if (Cookies.get('mchat_show_' + elem)) {
				mChat.cached(elem).toggle();
			}
		});

		mChat.startRelativeTimeUpdate(mChat.cached('messages'));

		if (mChat.cached('input').is('input')) {
			$('#mchat-form').on('keypress', function(e) {
				if (e.which == 13) {
					mChat.add();
					e.preventDefault();
				}
			});
		}

		mChat.cached('input').autoGrowInput({
			minWidth: mChat.cached('input').width(),
			maxWidth: mChat.cached('form').width() - (mChat.cached('input').outerWidth(true) - mChat.cached('input').width())
		});
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

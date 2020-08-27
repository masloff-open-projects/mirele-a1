var $ = jQuery;

$(document).ready(function () {

	(function (window, $, document, undefined) {
		"use strict";


		var _baseZ = 1000,
			_dargMark = 'dragbar',
			_cdReg = /\{\%cd\}/gi,
			_stCD = '<span data-role="cd"></span>';


		var _config = {
			hasMask: true,
			hasTitle: true,
			hasCross: true,
			hotKeys: true,
			drag: true,
			fixed: false,
			autoFocus: true,
			autoDestroy: false,
			autoReset: false,
			buttonsAlign: 'right',
			titleAlign: 'left',
			contentAlign: 'left',
			title: 'Title',
			content: '',
			buttons: [],
			top: null,
			left: null,
			bottom: null,
			right: null,
			width: 0,
			height: 0,
			gap: 10,
			countdown: 0,
			enterCall: 'confirm,close',
			escCall: 'cancel,close',
			countdownCall: 'close',
			onClose: null,
			onOpen: null,
			onConfirm: null,
			onCancel: null
		};


		var $mask = $('<div class="mgDialog_mask" style="z-index:' + _baseZ + '"></div>'),
			$wrap = $('<div class="mgDialog"></div>'),
			$cross = $('<i class="mgDialog_cross" data-role="btn:cancel,close">×</i>'),
			$title = $('<div data-role="title" class="mgDialog_title"></div>'),
			$header = $('<div class="mgDialog_header"></div>'),
			$content = $('<div data-role="content" class="mgDialog_content"></div>'),
			$btn = $('<a class="mgDialog_button"></a>'),
			$footer = $('<div class="mgDialog_footer">'),

			$hk = $('<input type="text" class="mgDialog_hk">'),
			$gap = $('<i class="mgDialog_gap"></i>'),
			$document = $(document);


		var _hasMask = 0,
			_opened = 0,
			_focus = '',
			_dialogs = {},
			_timer;


		var aniEndName = (function () {
			var eleStyle = document.createElement('div').style;
			var verdors = ['a', 'webkitA', 'MozA', 'OA', 'msA'];
			var endEvents = ['animationend', 'webkitAnimationEnd', 'animationend', 'oAnimationEnd', 'MSAnimationEnd'];
			var animation;
			for (var i = 0, len = verdors.length; i < len; i++) {
				animation = verdors[i] + 'nimation';
				if (animation in eleStyle) {
					return endEvents[i];
				}
			}
		}());

		function getId() {
			var n = 'd' + Math.random().toString().substring(2, 12);
			return _dialogs[n] ? getId() : n;
		}

		function removeDialog(id) {
			delete _dialogs[id];
		}

		function addDialog(dialog) {
			_dialogs[dialog._id] = dialog;
		}


		function focusDialog(id, noFocus) {
			var max = -1000,
				current = _dialogs[id],
				other;

			if (_opened <= 1) {
				current._zIndex = _baseZ + 1;
			} else {
				var name;
				for (name in _dialogs) {
					other = _dialogs[name];

					if (other._bOpen) {
						max = other._zIndex > max ? other._zIndex : max;
						!noFocus && other.dom.wrap.removeClass('mgDialog_focus');
					}

				}

				current._zIndex = max + 1;
			}
			if (!noFocus) {
				_focus = id;
				current.dom.wrap.addClass('mgDialog_focus');
			}
			current.dom.wrap.css('z-index', current._zIndex);

		}


		function focusLast() {
			if (_opened === 0) return;

			var max = -1000,
				id = '',
				current,
				name;
			for (name in _dialogs) {
				current = _dialogs[name];
				if (current._bOpen) {
					if (current._zIndex > max && current.config.autoFocus) {
						max = current._zIndex;
						id = current._id;
					}
					current.dom.wrap.removeClass('mgDialog_focus');
				}
			}

			_focus = id;
			_dialogs[id] && _dialogs[id].dom.wrap.addClass('mgDialog_focus');

		}


		function drag(dialog) {
			dialog.dom.wrap.on('mousedown', { dialog: dialog }, downFn);
		}

		function downFn(e) {
			var oEvent = e.originalEvent,
				src = $(oEvent.srcElement);
			if ((src.data('role') === 'content' || src.parents('[data-role=content]').length > 0) && (src.attr(_dargMark) === undefined)) return;

			var dialog = e.data.dialog,
				wrap = dialog.dom.wrap[0],
				disY = oEvent.clientY - wrap.offsetTop,
				disX = oEvent.clientX - wrap.offsetLeft;

			focusDialog(dialog._id);
			$document.on('mousemove', { disY: disY, disX: disX, dialog: dialog }, moveFn).on('mouseup', { wrap: wrap }, upFn);
			$document.one('mousemove', { wrap: wrap }, rePosition);

			wrap.setCapture && wrap.setCapture();

			return false;
		}

		function moveFn(e) {
			var oEvent = e.originalEvent,
				disY = e.data.disY,
				disX = e.data.disX,
				dialog = e.data.dialog,
				wrap = dialog.dom.wrap[0];

			var t = oEvent.clientY - disY;
			var l = oEvent.clientX - disX;

			if (!dialog.config.fixed) {
				var gap = dialog.config.gap;
				if (t < gap) t = gap;
				if (l < gap) l = gap;
			}

			wrap.style.top = t + 'px';
			wrap.style.left = l + 'px';
		}

		function upFn(e) {
			var wrap = e.data.wrap;
			$document.off('mousemove', moveFn).off('mouseup', upFn);

			wrap.releaseCapture && wrap.releaseCapture();
		}

		function rePosition(e) {
			var wrap = e.data.wrap;
			wrap.style.bottom = 'auto';
			wrap.style.right = 'auto';
		}

		function getHtml(text) {
			return typeof text === 'string' ? text.replace(_cdReg, _stCD) : '';
		}

		function st() {
			return $document.scrollTop();
		}

		function sl() {
			return $document.scrollLeft();
		}

		function cw() {
			return document.documentElement.clientWidth;
		}

		function ch() {
			return document.documentElement.clientHeight;
		}


		$(window).on('resize', windowResize);

		function windowResize() {
			clearTimeout(_timer);

			_timer = setTimeout(function () {
				var name;
				for (name in _dialogs) {
					_dialogs[name]._bOpen && _dialogs[name].setPosition()
				}
			}, 600);

		}

		var Dialog = function (cfg, userWrap) {

			cfg = cfg || {};

			this.config = $.extend({}, _config, cfg || {});

			this.dom = {
				wrap: userWrap,
				hk: $hk.clone(),
				gap: $gap.clone(),
				footer: null,
				footHolder: null,
				buttons: null
			};

			this._bUserWrap = !!userWrap;
			this._bOpen = false;
			this._id = getId();


			this._zIndex = '';
			this._bCD = parseInt(this.config.countdown) > 0;
			this._oldW = 0;
			this._oldH = 0;

			var that = this;


			this._hotkey = function (e) {
				var kc = e.originalEvent.keyCode;

				var nodeName = document.activeElement.nodeName;

				if (_focus === that._id) {
					if (kc === 13 && (nodeName !== 'INPUT' && nodeName !== 'TEXTAREA' || $(document.activeElement).hasClass('mgDialog_hk'))) {
						that.trigger(that.config.enterCall);

					} else if (kc === 27) {
						that.trigger(that.config.escCall);
					}
				}
			};


			this._click = function (e) {

				var target = $(e.target),
					role = target.data('role');


				if (role && /^btn:/.test(role) && !target.hasClass('disabled')) {
					that.trigger(role.split(':')[1].split(','))
				}
			};

			this.init();

		};

		Dialog.prototype = {

			init: function () {
				var dom = this.dom,
					config = this.config;

				dom.wrap = dom.wrap ? dom.wrap.append(this.dom.hk).append(this.dom.gap) : this.createWrap();

				if (this._bUserWrap) {
					this._oldStyle = dom.wrap.attr('style');
					this._oldClass = dom.wrap.attr('class');
					dom.wrap.addClass('mgDialogU');
				} else {
					dom.wrap.appendTo($('body'));
				}

				dom.wrap.on('click', this._click);

				!!config.width && dom.wrap.css('width', config.width);
				!!config.height && dom.wrap.css('height', config.height);

				addDialog(this);

				config.drag && drag(this);
				this.setGap();
			},

			createWrap: function () {

				var config = this.config;
				var wrap = $wrap.clone();


				if (config.hasTitle) {
					var header = $header.clone();
					var title = getHtml(config.title);
					this.dom.title = $title.clone();

					header.append(this.dom.title.html(title)).addClass('mgDialog_align_' + config.titleAlign);
					config.hasCross && header.append($cross.clone());
					wrap.append(header);
				} else {
					config.hasCross && wrap.append($cross.clone());
				}


				this.dom.content = $content.clone();
				wrap.append(this.dom.content.css('text-align', config.contentAlign).html(getHtml(config.content))).append(this.dom.hk).append(this.dom.gap);


				if ($.isArray(config.buttons) && config.buttons.length > 0) {
					this.dom.footer = $footer.clone().addClass('mgDialog_align_' + config.buttonsAlign + ' mgDialog_footer_fixed').css('text-align', config.buttonsAlign);
					wrap.append(this.dom.footer.append(this.cerateButtons(this.config.buttons)));
				}

				return wrap;

			},

			cerateButtons: function (arr) {
				var btns;
				for (var i = 0, b; b = arr[i]; i++) {
					btns = btns ? btns.add(newBtn(b)) : newBtn(b);
				}

				function newBtn(b) {
					var btn, text, call;
					if (typeof b === 'string') {
						btn = $(b)
					} else if (typeof b === 'object') {
						btn = $btn.clone();
						text = getHtml(b.text);

						if (b.type === 'confirm') {
							text = text || 'Confirm';
							call = b.call || 'confirm,close';
							btn.addClass('mgDialog_button_confirm');

						} else if (b.type === 'cancel') {
							text = text || 'Cancel';
							call = b.call || 'cancel,close';

						} else {
							text = text || 'Button';
							call = b.call || '';
						}

						btn.html(text).attr('data-role', 'btn:' + call);
					}

					b.disabled && btn.addClass('disabled');
					b.hidden && btn.addClass('mgDialog_hidden');

					return btn;
				}

				this.dom.buttons = btns;

				return btns;


			},

			setGap: function () {
				var gap = this.config.gap,
					wrap = this.dom.wrap;

				this.dom.gap.css({
					right: -parseInt(wrap.css('border-right-width') || 0) - gap,
					width: gap,
					bottom: -parseInt(wrap.css('border-bottom-width') || 0) - gap,
					height: gap
				});
			},

			setFooterHolder: function () {
				if (this._bUserWrap) return;

				var footer = this.dom.footer;
				if (footer) {
					var h = footer.outerHeight() + 15;
					this.dom.content.css('margin-bottom', h);
				}

			},

			test: function (b, fn) {

				if (b === false) {
					return false
				} else {
					return typeof fn !== 'function' ? true : fn.call(this) !== false;
				}

			},

			setPosition: function () {
				this.setFooterHolder();

				var wrap = this.dom.wrap,
					config = this.config,
					clientW = cw(),
					clientH = ch(),
					scrollTop = st(),
					scrollLeft = sl(),
					width = wrap.outerWidth(),
					height = wrap.outerHeight(),
					positionX = 0,
					positionY = 0,
					dirX = typeof config.left === 'number' ? 'left' : typeof config.right === 'number' ? 'right' : 'center',
					dirY = typeof config.top === 'number' ? 'top' : typeof config.bottom === 'number' ? 'bottom' : 'center';

				var _top, _left;

				wrap.css({
					left: 'auto',
					top: 'auto',
					right: 'auto',
					bottom: 'auto'
				});

				if (config.fixed) {
					if (dirY === 'center') {
						dirY = 'top';
						_top = (clientH - height) / 2;
						positionY = _top < 10 ? 10 : _top;
					} else {
						positionY = config[dirY];
					}

					if (dirX === 'center') {
						dirX = 'left';
						_left = (clientW - width) / 2;
						positionX = _left < 10 ? 10 : _left;
					} else {
						positionX = config[dirX];
					}

					wrap.css('position', 'fixed').css(dirY, positionY + 'px').css(dirX, positionX + 'px');

				} else {
					if (dirY === 'center') {
						_top = scrollTop + (clientH - height) / 2;
						positionY = _top - 10 < scrollTop ? scrollTop + 10 : _top;
					} else {
						positionY = dirY === 'bottom' ? scrollTop + clientH - height - config[dirY] : scrollTop + config[dirY];
					}

					if (dirX === 'center') {
						_left = scrollLeft + (clientW - width) / 2;
						positionX = _left - 10 < scrollLeft ? scrollLeft + 10 : _left;
					} else {
						positionX = dirX === 'right' ? scrollLeft + clientW - width - config[dirX] : scrollLeft + config[dirX];
					}

					wrap.css('top', positionY + 'px').css('left', positionX + 'px');
				}

				this._oldW = width;
				this._oldH = height;

			},

			open: function (b) {

				if (this._bOpen === true || this.test(b, this.config.onOpen) === false) return this;

				_opened++;

				focusDialog(this._id, !this.config.autoFocus);

				this._bOpen = true;

				var that = this,
					wrap = this.dom.wrap,
					config = this.config;

				if (config.hasMask) {
					if (_hasMask === 0) {
						$mask.prependTo($('body')).addClass('mgDialog_show').data('scroll', {
							t: st(),
							l: sl()
						});
					}
					_hasMask++;
				}

				wrap.addClass('mgDialog_show');

				this.setPosition();

				this.dom.hk[0].focus();

				if (this._bCD) {
					var cd = this.config.countdown;
					var cdWrap = wrap.find('[data-role=cd]');

					cdWrap.text(cd);

					this.cdTimer = setInterval(function () {

						cd--;
						if (cd > 0) {
							cdWrap.text(cd);
						} else {
							cdWrap.text(0);
							clearInterval(that.cdTimer);
							that.trigger(that.config.countdownCall);

						}

					}, 1000)
				}

				this.config.hotKeys && $(document).on('keyup', this._hotkey);

				return this;
			},

			close: function (b) {
				if (this._bOpen === false || this.test(b, this.config.onClose) === false) return this;

				var that = this;
				var wrap = this.dom.wrap;
				that._bOpen = false;

				if (aniEndName) {
					wrap.addClass('mgDialog_aniBack');
					wrap.one(aniEndName, end);
				} else {
					end();
				}

				function end() {

					that.config.hotKeys && $(document).off('keyup', that._hotkey);

					that.cdTimer && clearInterval(that.cdTimer);

					wrap.removeClass('mgDialog_show mgDialog_aniBack');

					_opened--;
					if (_opened < 0) _opened = 0;

					if (that.config.hasMask) {
						_hasMask--;
						if (_hasMask < 0) _hasMask = 0;
						if (_hasMask === 0) {
							var s = $mask.data('scroll');
							$document.scrollTop(s.t).scrollLeft(s.l);
							$mask.removeClass('mgDialog_show').remove();
						}
					}

					focusLast();
					that.config.autoReset && that.reset();
					that.config.autoDestroy && that.destroy();
				}

				return this;

			},

			title: function (tit) {
				var title = this.dom.wrap.find('[data-role=title]');
				typeof tit === 'string' ? title.html(tit) : title.empty().append(tit);
				return this;

			},

			content: function (cont) {
				var content = this.dom.wrap.find('[data-role=content]');
				typeof cont === 'string' ? content.html(cont) : content.empty().append(cont);
				return this;

			},

			width: function (num) {
				this.dom.wrap.width(num);
				return this;
			},

			height: function (num) {
				this.dom.wrap.height(num);
				return this;

			},
			button: function (index, opt) {
				var btn = this.dom.buttons.eq(index);

				if (typeof opt.text === 'string') {
					btn.html(getHtml(opt.text));
				}

				if (typeof opt.call === 'string') {
					btn.data('role', 'btn:' + opt.call);
				}

				if (typeof opt.disabled === 'boolean') {
					opt.disabled ? btn.addClass('disabled') : btn.removeClass('disabled');
				}

				if (typeof opt.hidden === 'boolean') {
					opt.hidden ? btn.addClass('mgDialog_hidden') : btn.removeClass('mgDialog_hidden');
				}

				if (opt.type === 'confirm') {
					btn.addClass('mgDialog_button_confirm')
				} else if (opt.type === 'cancel') {
					btn.removeClass('mgDialog_button_confirm')
				}

				return this;

			},

			countdown: function (cd, cb) {
				var that = this;
				if (typeof cd === 'number' && cd > 0) {
					var cdWrap = this.dom.wrap.find('[data-role=cd]');

					cdWrap.text(cd);

					clearInterval(this.cdTimer);
					this.cdTimer = setInterval(function () {

						cd--;
						if (cd > 0) {
							cdWrap.text(cd);
						} else {
							cdWrap.text(0);
							clearInterval(that.cdTimer);
							if (typeof cb === 'function') {
								cb.call(that)
							} else if (typeof cb === 'string') {
								that.trigger(cb)
							} else {
								that.trigger(that.config.countdownCall);
							}


						}

					}, 1000)
				}

				return this;
			},

			position: function (origin) {
				this.setFooterHolder();

				var wrap = this.dom.wrap,
					width = wrap.outerWidth(),
					height = wrap.outerHeight();


				if (width === this._oldW && height === this._oldH) return;

				var config = this.config,
					that = this,
					clientW = cw(),
					clientH = ch(),
					scrollTop = config.fixed ? 0 : st(),
					scrollLeft = config.fixed ? 0 : sl(),
					top = isNaN(parseInt(wrap.css('top'))) ? clientH - parseInt(wrap.css('bottom')) - that._oldH : parseInt(wrap.css('top')),
					left = isNaN(parseInt(wrap.css('left'))) ? clientW - parseInt(wrap.css('right')) - that._oldW : parseInt(wrap.css('left')),
					gap = parseInt(this.config.gap) || 0;

				var _top, _left, resTop, resLeft;


				origin = typeof origin === 'number' && origin >= 0 && origin < 13 ? Math.floor(origin) : 0;
				var aOriMap = ['center', 'top', 'right', 'bottom', 'left'],
					aOrigin = [
						[0, 0],
						[2, 1],
						[2, 1],
						[2, 0],
						[2, 3],
						[2, 3],
						[0, 3],
						[4, 3],
						[4, 3],
						[4, 0],
						[4, 1],
						[4, 1],
						[0, 1]
					],
					oriX = aOriMap[aOrigin[origin][0]],
					oriY = aOriMap[aOrigin[origin][1]];


				if (oriY === 'center') {


					if (height + gap * 2 < clientH) {


						_top = top - (height - this._oldH) / 2;


						if (_top + gap + height - scrollTop > clientH) {
							resTop = scrollTop + clientH - height - gap;


						} else if (_top - gap < scrollTop) {

							resTop = scrollTop + gap;


						} else {

							resTop = _top;
						}


					} else {
						resTop = top - (height - this._oldH);
					}

				} else if (oriY === 'top') {

					if (config.fixed) {
						resTop = top;
					}

				} else if (oriY === 'bottom') {
					resTop = top - (height - this._oldH);
				}


				if (oriX === 'center') {

					if (width + gap * 2 < clientW) {

						_left = left - (width - this._oldW) / 2;

						if (_left + gap + width - scrollLeft > clientW) {
							resLeft = scrollLeft + clientW - width - gap;

						} else if (_left - gap < scrollLeft) {

							resLeft = scrollLeft + gap;

						} else {

							resLeft = _left;
						}

					} else {
						resLeft = left - (width - this._oldW);
					}

				} else if (oriX === 'left') {

					if (config.fixed) {
						resLeft = left;
					}

				} else if (oriX === 'right') {
					resLeft = left - (width - this._oldW);
				}


				if (!config.fixed) {
					if (resTop < gap) resTop = gap;
					if (resLeft < gap) resLeft = gap;
				}

				wrap.css({ 'top': resTop + 'px', 'left': resLeft + 'px' });
				$document.off('mousemove', rePosition);

				this._oldW = width;
				this._oldH = height;

				return this;
			},
			reset: function () {
				if (!this._bUserWrap) {
					var dom = this.dom;
					var config = this.config;


					dom.wrap.css('width', !!config.width ? config.width : '');
					dom.wrap.css('height', !!config.height ? config.height : '');


					if (config.hasTitle) {
						dom.title.html(getHtml(config.title));
					}


					this.dom.content.html(getHtml(config.content));


					this.dom.footer.empty().append(this.cerateButtons(config.buttons))

				}

				return this;
			},

			trigger: function (fns) {
				var config = this.config;
				var fnName = '';

				try {
					var aFn = typeof fns === 'string' ? fns.split(',') : fns;

					for (var i = 0, a; a = aFn[i]; i++) {

						fnName = 'on' + a.substring(0, 1).toUpperCase() + a.substring(1);

						if (a === 'close') {
							this.close();

						} else if (typeof config[fnName] === 'function') {

							if (config[fnName].call(this) === false) {
								break;
							}
						}
					}
				} catch (e) { }

				return this;

			},

			destroy: function () {
				removeDialog(this._id);
				this.dom.wrap.off('mousedown', downFn);

				if (this._bOpen) {

					if (this.config.hasMask) {
						_hasMask--;
						if (_hasMask <= 0) {
							$mask.removeClass('mgDialog_show').remove();
							_hasMask = 0
						}
					}

					_opened--;
					if (_opened < 0) _opened = 0;
				}

				this.cdTimer && clearInterval(this.cdTimer);
				this.config.hotKeys && $(document).off('keyup', this._hotkey);
				this.dom.wrap.off('click', this._click);

				$document.off('mousemove', moveFn).off('mouseup', upFn).off('mousemove', rePosition);

				if (this._bUserWrap) {
					this.dom.hk.remove();
					this.dom.gap.remove();
					this._oldStyle === undefined ? this.dom.wrap.removeAttr('style') : this.dom.wrap.attr('style', this._oldStyle);
					this._oldClass === undefined ? this.dom.wrap.removeAttr('class') : this.dom.wrap.attr('class', this._oldClass);
				} else {
					this.dom.wrap.remove();
				}

				var name;
				for (name in this.dom) {
					this.dom[name] = null;
				}

				for (name in this.config) {
					this.config[name] = null;
				}

				this.config = null;
				this.dom = null;
				this.cdTimer = null;
				this._bOpen = null;
				this._bUserWrap = null;
				this._id = null;
				this._oldStyle = null;
				this._oldClass = null;
				this._zIndex = null;
				this._bCD = null;

				this.destroy = function () { };

			}


		};

		$.extend({
			dialog: function (cfg) {
				return new Dialog(cfg);
			},
			alert: function (text, title) {
				return new Dialog({
					title: title,
					content: text,
					width: 270,
					autoDestroy: true,
					buttons: [{ type: 'confirm' }]
				}).open();
			},
			confirm: function (text, fn, title) {

				return new Dialog({
					title: title,
					content: text,
					width: 270,
					autoDestroy: true,
					buttons: [
						{ type: 'cancel' },
						{ type: 'confirm' }
					],
					onConfirm: function () {
						fn(true);
					},
					onCancel: function () {
						fn(false);
					}
				}).open();
			},
			prompt: function (text, fn, title) {
				function submit(e) {
					if (e.originalEvent.keyCode === 13) {
						d.config.onConfirm()

					}
				}

				var d = new Dialog({
					title: title,
					content: text + '<br><input class="mgDialog_promptInput" type="text" value=""/>',
					width: 270,
					autoDestroy: true,
					buttons: [{
						type: 'cancel',
						call: 'close'
					},
					{
						type: 'confirm',
						call: 'confirm'
					}
					],
					onOpen: function () {
						$document.on('keyup', submit);
					},
					onConfirm: function () {
						typeof fn === 'function' && fn(input.val());
						d.close();
					},
					onClose: function () {
						input = null;
						$document.off('keyup', submit)
					}
				});

				var input = d.dom.wrap.find('.mgDialog_promptInput');

				d.open();

				input[0].focus();

				return d;

			},
			toast: function (text, width) {
				return new Dialog({
					hasTitle: false,
					contentAlign: 'center',
					hasCross: false,
					content: text || 'toast',
					width: width || 'auto',
					autoDestroy: true,
					autoFocus: false,
					countdown: 3,
					hasMask: false,
					hotKeys: false,
					fixed: true,
					bottom: 100
				}).open();
			}
		});

		$.fn.dialog = function (cfg) {

			return new Dialog(cfg, this);
		};

	})(window, jQuery, document);
});

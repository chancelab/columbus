/**
 *
 * AJAX Smart Star Rater
 *
 * @author  MT312 http://www.mt312.com/
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @version 1.0
 * @update  2011/2/16
 *
 */

star = {};
star.num = 1;
star.option = {disabled: 0, sendto: 'vote.php', form: '', step: 0, length: 5, width: 20, height: 20};
star.active = 0;
star.date = new Date();
star.$ = function(id) {
	return document.getElementById(id);
};
star.elpos = function(el) {
	var x = y = 0;
	while (el != null) {
		x += el.offsetLeft;
		y += el.offsetTop;
		el = el.offsetParent;
	}
	return {x: x, y: y};
};
star.evpos = function(ev) {
	var d, x, y;
	if (/*@cc_on!@*/false) {
		d = document;
		x = event.clientX + (d.documentElement && d.documentElement.scrollLeft ? d.documentElement : d.body).scrollLeft;
		y = event.clientY + (d.documentElement && d.documentElement.scrollTop  ? d.documentElement : d.body).scrollTop;
	} else {
		x = ev.pageX;
		y = ev.pageY;
	}
	return {x: x, y: y};
};
star.rates = function(rates, step) {
	var length = star.opt.length;
	var stars;
	if (step > 0) {
		step = (100 / length) * step;
		rates = Math.ceil(rates / step) * step;
		rates = Math.min(rates, 100);
		stars = rates * length / 100;
	} else {
		stars = rates / 20 * length / 5;
	}
	rates = Math.ceil(rates);
	stars = Math.ceil(stars * 10) / 10;
	stars = stars.toFixed(1);
	return {rates: rates, stars: stars}
};
star.start = function(ev, el, num, opt) {
	if (star.active == 0) {
		star.active = 1;
		star.num = num;
		star.opt = {};
		opt = opt || {};
		for (var name in star.option) {
			star.opt[name] = (typeof opt[name] != 'undefined') ? opt[name] : star.option[name];
		}
		if (star.opt.disabled) {
			star.disable(el);
			return;
		}
		el.firstChild.firstChild.style.width = 0;
		el.onmousedown = function(ev) {
			star.opt.form == '' ? star.send(ev, el) : star.form(el);
		};
		var elp = star.elpos(el);
		var w = star.opt.width * star.opt.length;
		var rw = w + 10;
		var rh = star.opt.height;
		document.onmousemove = function(ev) {
			var evp = star.evpos(ev);
			var x = evp.x - elp.x;
			var y = evp.y - elp.y;
			if (x < 1 || x > rw || y < 1 || y > rh) {
				star.stop(el);
			} else {
				var rates = Math.min(x / w, 1) * 100;
				var o = star.rates(rates, star.opt.step);
				star.update('Rates', o.rates);
				star.update('Stars', o.stars);
				el.firstChild.firstChild.style.width = o.rates + '%';
				el.firstChild.lastChild.style.height = 0;
			}
		};
	}
};
star.stop = function(el) {
	if (star.active == 1) {
		star.active = 0;
		el.onmousedown = null;
		document.onmousemove = null;
		var rates = parseInt(el.firstChild.lastChild.style.width);
		var o = star.rates(rates, 0);
		star.update('Rates', o.rates);
		star.update('Stars', o.stars);
		el.firstChild.firstChild.style.width = 0;
		el.firstChild.lastChild.style.height = '100%';
	}
};
star.update = function(name, value, color) {
	var el = star.$('star' + name + star.num);
	if (el) {
		el.style.color = color || '';
		el.innerHTML = value;
	}
	return el != null;
};
star.form = function(el) {
	var rates = parseInt(el.firstChild.firstChild.style.width);
	el.firstChild.lastChild.style.width = rates + '%';
	var frm_el = star.$(star.opt.form);
	if (frm_el) frm_el.value = rates;
	star.stop(el);
};
star.send = function(ev, el) {
	star.lock(el);
	var rates = parseInt(el.firstChild.firstChild.style.width);
	var time = Math.floor(star.date.getTime() / 1000);
	try {
		var url = star.opt.sendto + '?id=' + star.num + '&rates=' + rates + '&time=' + time;
		var req = new XMLHttpRequest();
		req.open('GET', url, false);
		req.send(null);
	} catch(e) {
		alert(e.message);
	}
	if (req.readyState == 4 && req.status == 200) {
		var res = req.responseText;
		if (res != '') {
			if (res.charAt(0) == '{') {
				var o = star.rates(rates, star.opt.step);
				eval('var data = ' + res);
				if (data.result == 'success') {
					res = o.stars + ' Thanks!';
					o = star.rates(data.rates, 0);
					el.firstChild.lastChild.style.width = o.rates + '%';
					star.update('Rates', o.rates);
					star.update('Stars', o.stars);
					star.update('Users', data.users);
					star.update('TotalRating', data.total);
				} else {
					alert('Error: ' + data.reason);
				}
			}
			res = '(' + res + ')';
//			var r = star.update('Alert', res);
//			if (r == false) alert(res);
		}
	} else {
		if (req.readyState > 0)
			alert('Error: ' + req.status + ' ' + req.statusText);
	}
//	star.disable(el);
	star.unlock(el);
};
star.disable = function(el) {
	star.active = 0;
	el.style.cursor = 'auto';
	el.onmousemove = null;
};
star.lock = function(el) {
	star.active = 2;
	el.onmousedown = null;
	document.onmousemove = null;
};
star.unlock = function(el) {
	star.active = 1;
	star.stop(el);
};

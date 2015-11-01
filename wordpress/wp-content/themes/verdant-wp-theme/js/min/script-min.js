!function(){for(var t=0,e=["ms","moz","webkit","o"],n=0;n<e.length&&!window.requestAnimationFrame;++n)window.requestAnimationFrame=window[e[n]+"RequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(t,e){return window.setTimeout(function(){t()},16)})}(),jQuery(document).ready(function($){$("body").on("hover","nav li",function(){if(0!==$(this).find("ul").length){var t=$(this).find("ul"),e=$(window).width(),n=t.offset().left+t.width();n>e&&t.addClass("open-left")}})}),function($){$(document.body).on("post-load",function(){setTimeout(function(){jQuery(".infinite-wrap:eq(-1)").addClass("infinite-fade-in")},10)})}(jQuery),/**
 * Timeago is a jQuery plugin that makes it easy to support automatically
 * updating fuzzy timestamps (e.g. "4 minutes ago" or "about 1 day ago").
 *
 * @name timeago
 * @version 1.4.1
 * @requires jQuery v1.2.3+
 * @author Ryan McGeary
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 *
 * For usage and examples, visit:
 * http://timeago.yarp.com/
 *
 * Copyright (c) 2008-2015, Ryan McGeary (ryan -[at]- mcgeary [*dot*] org)
 */
function(t){"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)}(function($){function t(){if(!$.contains(document.documentElement,this))return $(this).timeago("dispose"),this;var t=e(this),o=a.settings;return isNaN(t.datetime)||(0==o.cutoff||Math.abs(i(t.datetime))<o.cutoff)&&$(this).text(n(t.datetime)),this}function e(t){if(t=$(t),!t.data("timeago")){t.data("timeago",{datetime:a.datetime(t)});var e=$.trim(t.text());a.settings.localeTitle?t.attr("title",t.data("timeago").datetime.toLocaleString()):!(e.length>0)||a.isTime(t)&&t.attr("title")||t.attr("title",e)}return t.data("timeago")}function n(t){return a.inWords(i(t))}function i(t){return(new Date).getTime()-t.getTime()}$.timeago=function(t){return n(t instanceof Date?t:"string"==typeof t?$.timeago.parse(t):"number"==typeof t?new Date(t):$.timeago.datetime(t))};var a=$.timeago;$.extend($.timeago,{settings:{refreshMillis:6e4,allowPast:!0,allowFuture:!1,localeTitle:!1,cutoff:0,strings:{prefixAgo:null,prefixFromNow:null,suffixAgo:"ago",suffixFromNow:"from now",inPast:"any moment now",seconds:"less than a minute",minute:"about a minute",minutes:"%d minutes",hour:"about an hour",hours:"about %d hours",day:"a day",days:"%d days",month:"about a month",months:"%d months",year:"about a year",years:"%d years",wordSeparator:" ",numbers:[]}},inWords:function(t){function e(e,i){var a=$.isFunction(e)?e(i,t):e,o=n.numbers&&n.numbers[i]||i;return a.replace(/%d/i,o)}if(!this.settings.allowPast&&!this.settings.allowFuture)throw"timeago allowPast and allowFuture settings can not both be set to false.";var n=this.settings.strings,i=n.prefixAgo,a=n.suffixAgo;if(this.settings.allowFuture&&0>t&&(i=n.prefixFromNow,a=n.suffixFromNow),!this.settings.allowPast&&t>=0)return this.settings.strings.inPast;var o=Math.abs(t)/1e3,r=o/60,s=r/60,u=s/24,m=u/365,d=45>o&&e(n.seconds,Math.round(o))||90>o&&e(n.minute,1)||45>r&&e(n.minutes,Math.round(r))||90>r&&e(n.hour,1)||24>s&&e(n.hours,Math.round(s))||42>s&&e(n.day,1)||30>u&&e(n.days,Math.round(u))||45>u&&e(n.month,1)||365>u&&e(n.months,Math.round(u/30))||1.5>m&&e(n.year,1)||e(n.years,Math.round(m)),f=n.wordSeparator||"";return void 0===n.wordSeparator&&(f=" "),$.trim([i,d,a].join(f))},parse:function(t){var e=$.trim(t);return e=e.replace(/\.\d+/,""),e=e.replace(/-/,"/").replace(/-/,"/"),e=e.replace(/T/," ").replace(/Z/," UTC"),e=e.replace(/([\+\-]\d\d)\:?(\d\d)/," $1$2"),e=e.replace(/([\+\-]\d\d)$/," $100"),new Date(e)},datetime:function(t){var e=$(t).attr(a.isTime(t)?"datetime":"title");return a.parse(e)},isTime:function(t){return"time"===$(t).get(0).tagName.toLowerCase()}});var o={init:function(){var e=$.proxy(t,this);e();var n=a.settings;n.refreshMillis>0&&(this._timeagoInterval=setInterval(e,n.refreshMillis))},update:function(e){var n=a.parse(e);$(this).data("timeago",{datetime:n}),a.settings.localeTitle&&$(this).attr("title",n.toLocaleString()),t.apply(this)},updateFromDOM:function(){$(this).data("timeago",{datetime:a.parse($(this).attr(a.isTime(this)?"datetime":"title"))}),t.apply(this)},dispose:function(){this._timeagoInterval&&(window.clearInterval(this._timeagoInterval),this._timeagoInterval=null)}};$.fn.timeago=function(t,e){var n=t?o[t]:o.init;if(!n)throw new Error("Unknown function name '"+t+"' for timeago");return this.each(function(){n.call(this,e)}),this},document.createElement("abbr"),document.createElement("time")}),jQuery(document).ready(function($){$("time").timeago()}),jQuery(document).ready(function($){"use strict";$("body").on("click",".top-search",function(){return $(this).toggleClass("showme").next().find("input").focus(),!1})}),jQuery(document).ready(function($){var t=$("#header-image"),e=$(window);if(0!==t.length){var n=function(){var n=.2*e.scrollTop(),i="translate3d(0px, "+n+"px, 0px)";t.css({webkitTransform:i,mozTransform:i,msTransform:i,oTransform:i,transform:i})};$(window).on("scroll",function(){requestAnimationFrame(n)}),n()}}),jQuery(document).ready(function($){"use strict";0!==$(".featured-content").length&&"undefined"!=typeof $(".featured-content").owlCarousel&&$(".featured-content").owlCarousel({items:3,itemsCustom:[[0,1],[621,2],[1100,3]]})});
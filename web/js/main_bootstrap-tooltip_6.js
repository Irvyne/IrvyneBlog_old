!function(c){var b=function(e,d){this.init("tooltip",e,d)};b.prototype={constructor:b,init:function(g,f,e){var h,d;this.type=g;this.$element=c(f);this.options=this.getOptions(e);this.enabled=true;if(this.options.trigger=="click"){this.$element.on("click."+this.type,this.options.selector,c.proxy(this.toggle,this))}else{if(this.options.trigger!="manual"){h=this.options.trigger=="hover"?"mouseenter":"focus";d=this.options.trigger=="hover"?"mouseleave":"blur";this.$element.on(h+"."+this.type,this.options.selector,c.proxy(this.enter,this));this.$element.on(d+"."+this.type,this.options.selector,c.proxy(this.leave,this))}}this.options.selector?(this._options=c.extend({},this.options,{trigger:"manual",selector:""})):this.fixTitle()},getOptions:function(d){d=c.extend({},c.fn[this.type].defaults,d,this.$element.data());if(d.delay&&typeof d.delay=="number"){d.delay={show:d.delay,hide:d.delay}}return d},enter:function(f){var d=c(f.currentTarget)[this.type](this._options).data(this.type);if(!d.options.delay||!d.options.delay.show){return d.show()}clearTimeout(this.timeout);d.hoverState="in";this.timeout=setTimeout(function(){if(d.hoverState=="in"){d.show()}},d.options.delay.show)},leave:function(f){var d=c(f.currentTarget)[this.type](this._options).data(this.type);if(this.timeout){clearTimeout(this.timeout)}if(!d.options.delay||!d.options.delay.hide){return d.hide()}d.hoverState="out";this.timeout=setTimeout(function(){if(d.hoverState=="out"){d.hide()}},d.options.delay.hide)},show:function(){var h,d,j,f,i,e,g;if(this.hasContent()&&this.enabled){h=this.tip();this.setContent();if(this.options.animation){h.addClass("fade")}e=typeof this.options.placement=="function"?this.options.placement.call(this,h[0],this.$element[0]):this.options.placement;d=/in/.test(e);h.detach().css({top:0,left:0,display:"block"}).insertAfter(this.$element);j=this.getPosition(d);f=h[0].offsetWidth;i=h[0].offsetHeight;switch(d?e.split(" ")[1]:e){case"bottom":g={top:j.top+j.height,left:j.left+j.width/2-f/2};break;case"top":g={top:j.top-i,left:j.left+j.width/2-f/2};break;case"left":g={top:j.top+j.height/2-i/2,left:j.left-f};break;case"right":g={top:j.top+j.height/2-i/2,left:j.left+j.width};break}h.offset(g).addClass(e).addClass("in")}},setContent:function(){var e=this.tip(),d=this.getTitle();e.find(".tooltip-inner")[this.options.html?"html":"text"](d);e.removeClass("fade in top bottom left right")},hide:function(){var d=this,e=this.tip();e.removeClass("in");function f(){var g=setTimeout(function(){e.off(c.support.transition.end).detach()},500);e.one(c.support.transition.end,function(){clearTimeout(g);e.detach()})}c.support.transition&&this.$tip.hasClass("fade")?f():e.detach();return this},fixTitle:function(){var d=this.$element;if(d.attr("title")||typeof(d.attr("data-original-title"))!="string"){d.attr("data-original-title",d.attr("title")||"").attr("title","")}},hasContent:function(){return this.getTitle()},getPosition:function(d){return c.extend({},(d?{top:0,left:0}:this.$element.offset()),{width:this.$element[0].offsetWidth,height:this.$element[0].offsetHeight})},getTitle:function(){var f,d=this.$element,e=this.options;f=d.attr("data-original-title")||(typeof e.title=="function"?e.title.call(d[0]):e.title);return f},tip:function(){return this.$tip=this.$tip||c(this.options.template)},validate:function(){if(!this.$element[0].parentNode){this.hide();this.$element=null;this.options=null}},enable:function(){this.enabled=true},disable:function(){this.enabled=false},toggleEnabled:function(){this.enabled=!this.enabled},toggle:function(f){var d=c(f.currentTarget)[this.type](this._options).data(this.type);d[d.tip().hasClass("in")?"hide":"show"]()},destroy:function(){this.hide().$element.off("."+this.type).removeData(this.type)}};var a=c.fn.tooltip;c.fn.tooltip=function(d){return this.each(function(){var g=c(this),f=g.data("tooltip"),e=typeof d=="object"&&d;if(!f){g.data("tooltip",(f=new b(this,e)))}if(typeof d=="string"){f[d]()}})};c.fn.tooltip.Constructor=b;c.fn.tooltip.defaults={animation:true,placement:"top",selector:false,template:'<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover",title:"",delay:0,html:false};c.fn.tooltip.noConflict=function(){c.fn.tooltip=a;return this}}(window.jQuery);
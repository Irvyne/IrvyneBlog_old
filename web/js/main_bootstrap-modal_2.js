!function(c){var b=function(e,d){this.options=d;this.$element=c(e).delegate('[data-dismiss="modal"]',"click.dismiss.modal",c.proxy(this.hide,this));this.options.remote&&this.$element.find(".modal-body").load(this.options.remote)};b.prototype={constructor:b,toggle:function(){return this[!this.isShown?"show":"hide"]()},show:function(){var d=this,f=c.Event("show");this.$element.trigger(f);if(this.isShown||f.isDefaultPrevented()){return}this.isShown=true;this.escape();this.backdrop(function(){var e=c.support.transition&&d.$element.hasClass("fade");if(!d.$element.parent().length){d.$element.appendTo(document.body)}d.$element.show();if(e){d.$element[0].offsetWidth}d.$element.addClass("in").attr("aria-hidden",false);d.enforceFocus();e?d.$element.one(c.support.transition.end,function(){d.$element.focus().trigger("shown")}):d.$element.focus().trigger("shown")})},hide:function(f){f&&f.preventDefault();var d=this;f=c.Event("hide");this.$element.trigger(f);if(!this.isShown||f.isDefaultPrevented()){return}this.isShown=false;this.escape();c(document).off("focusin.modal");this.$element.removeClass("in").attr("aria-hidden",true);c.support.transition&&this.$element.hasClass("fade")?this.hideWithTransition():this.hideModal()},enforceFocus:function(){var d=this;c(document).on("focusin.modal",function(f){if(d.$element[0]!==f.target&&!d.$element.has(f.target).length){d.$element.focus()}})},escape:function(){var d=this;if(this.isShown&&this.options.keyboard){this.$element.on("keyup.dismiss.modal",function(f){f.which==27&&d.hide()})}else{if(!this.isShown){this.$element.off("keyup.dismiss.modal")}}},hideWithTransition:function(){var d=this,e=setTimeout(function(){d.$element.off(c.support.transition.end);d.hideModal()},500);this.$element.one(c.support.transition.end,function(){clearTimeout(e);d.hideModal()})},hideModal:function(d){this.$element.hide().trigger("hidden");this.backdrop()},removeBackdrop:function(){this.$backdrop.remove();this.$backdrop=null},backdrop:function(g){var f=this,e=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var d=c.support.transition&&e;this.$backdrop=c('<div class="modal-backdrop '+e+'" />').appendTo(document.body);this.$backdrop.click(this.options.backdrop=="static"?c.proxy(this.$element[0].focus,this.$element[0]):c.proxy(this.hide,this));if(d){this.$backdrop[0].offsetWidth}this.$backdrop.addClass("in");d?this.$backdrop.one(c.support.transition.end,g):g()}else{if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");c.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one(c.support.transition.end,c.proxy(this.removeBackdrop,this)):this.removeBackdrop()}else{if(g){g()}}}}};var a=c.fn.modal;c.fn.modal=function(d){return this.each(function(){var g=c(this),f=g.data("modal"),e=c.extend({},c.fn.modal.defaults,g.data(),typeof d=="object"&&d);if(!f){g.data("modal",(f=new b(this,e)))}if(typeof d=="string"){f[d]()}else{if(e.show){f.show()}}})};c.fn.modal.defaults={backdrop:true,keyboard:true,show:true};c.fn.modal.Constructor=b;c.fn.modal.noConflict=function(){c.fn.modal=a;return this};c(document).on("click.modal.data-api",'[data-toggle="modal"]',function(i){var h=c(this),f=h.attr("href"),d=c(h.attr("data-target")||(f&&f.replace(/.*(?=#[^\s]+$)/,""))),g=d.data("modal")?"toggle":c.extend({remote:!/#/.test(f)&&f},d.data(),h.data());i.preventDefault();d.modal(g).one("hide",function(){h.focus()})})}(window.jQuery);
jQuery(function(o){window.onbeforeunload=function(e){if(void 0!==window.warningAtReload&&1==window.warningAtReload){var t="Do you want to lose unsaved data?";return(e=e||window.event)&&(e.returnValue=t),t}return null},o(document).on("click","#btn-save-page",function(i){i.preventDefault();var a=o(this),e=o.parseJSON(o("#jform_sptext").val());e.filter(function(e){return e.columns.filter(function(e){return e.addons.filter(function(e){return"sp_row"===e.type||"inner_row"===e.type?e.columns.filter(function(e){return e.addons.filter(function(e){return null!=typeof e.htmlContent&&delete e.htmlContent,null!=typeof e.assets&&delete e.assets,e})}):(null!=typeof e.htmlContent&&delete e.htmlContent,null!=typeof e.assets&&delete e.assets,e)})})}),o("#jform_sptext").val(JSON.stringify(e));var t=o("#adminForm"),n=o("#sp-page-builder").data("pageid");o.ajax({type:"POST",url:pagebuilder_base+"index.php?option=com_sppagebuilder&task=page.apply&pageId="+n,data:t.serialize(),beforeSend:function(){a.find(".fa-save").removeClass("fa-save").addClass("fa-spinner fa-spin")},success:function(e){try{var t=o.parseJSON(e);a.find(".fa").removeClass("fa-spinner fa-spin").addClass("fa-save"),0===o(".sp-pagebuilder-notifications").length&&o('<div class="sp-pagebuilder-notifications"></div>').appendTo("body");var n="success";if(!t.status)n="error";if(t.title&&o("#jform_title").val(t.title),t.id&&o("#jform_id").val(t.id),o('<div class="notify-'+n+'">'+t.message+"</div>").css({opacity:0,"margin-top":-15,"margin-bottom":0}).animate({opacity:1,"margin-top":0,"margin-bottom":15},200).prependTo(".sp-pagebuilder-notifications"),void 0!==window.warningAtReload&&1==window.warningAtReload&&(window.warningAtReload=!1),o(".sp-pagebuilder-notifications").find(">div").each(function(){var e=o(this);setTimeout(function(){e.animate({opacity:0,"margin-top":-15,"margin-bottom":0},200,function(){e.remove()})},3e3)}),!t.status)return;window.history.replaceState("","",t.redirect),t.preview_url&&0===o("#btn-page-preview").length&&o("#btn-page-options").parent().before('<div class="sp-pagebuilder-btn-group"><a id="btn-page-preview" target="_blank" href="'+t.preview_url+'" class="sp-pagebuilder-btn sp-pagebuilder-btn-primary"><i class="fa fa-eye"></i> Preview</a></div>'),"btn-save-new"==i.target.id&&(window.location.href="index.php?option=com_sppagebuilder&view=page&layout=edit"),"btn-save-close"==i.target.id&&(window.location.href="index.php?option=com_sppagebuilder&view=pages")}catch(e){window.location.href="index.php?option=com_sppagebuilder&view=pages"}}})})});
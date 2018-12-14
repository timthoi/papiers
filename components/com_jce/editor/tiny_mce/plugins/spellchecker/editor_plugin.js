/* JCE Editor - 2.5.28 | 07 October 2016 | http://www.joomlacontenteditor.net | Copyright (C) 2006 - 2016 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
(function(){var JSON=tinymce.util.JSON,each=tinymce.each,DOM=tinymce.DOM;tinymce.create('tinymce.plugins.SpellcheckerPlugin',{getInfo:function(){return{longname:'Spellchecker',author:'Moxiecode Systems AB',authorurl:'http://tinymce.moxiecode.com',infourl:'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/spellchecker',version:tinymce.majorVersion+"."+tinymce.minorVersion};},init:function(ed,url){var t=this,cm;t.url=url;t.editor=ed;t.rpcUrl=ed.getParam('site_url')+'index.php?option=com_jce&view=editor&layout=plugin&plugin=spellchecker'
t.native_spellchecker=(t.rpcUrl==''||ed.getParam("spellchecker_engine","browser")=='browser');if(t.native_spellchecker){if(tinymce.isIE&&/MSIE [56789]/.test(navigator.userAgent)){if(t.rpcUrl==''){return;}
t.native_spellchecker=false;}
t.hasSupport=true;if(ed.getParam("spellchecker_suggestions",true)){ed.onContextMenu.addToTop(function(ed,e){if(t.active)
return false;});}}
ed.addCommand('mceSpellCheck',function(){if(t.native_spellchecker){var body=ed.getBody();body.spellcheck=t.active=!t.active;ed.focus();return;}
if(!t.active){ed.setProgressState(1);t._sendRPC('checkWords',[t.selectedLang,t._getWords()],function(r){if(r.length>0){t.active=1;t._markWords(r);ed.setProgressState(0);ed.nodeChanged();}else{ed.setProgressState(0);if(ed.getParam('spellchecker_report_no_misspellings',true))
ed.windowManager.alert('spellchecker.no_mpell');}});}else
t._done();});if(ed.settings.content_css!==false)
ed.contentCSS.push(url+'/css/content.css');if(ed.getParam("spellchecker_suggestions",true)){ed.onClick.add(t._showMenu,t);ed.onContextMenu.add(t._showMenu,t);}
ed.onBeforeGetContent.add(function(){if(t.active)
t._removeWords();});ed.onNodeChange.add(function(ed,cm){cm.setActive('spellchecker',!!t.active);});ed.onSetContent.add(function(){t._done();});ed.onBeforeGetContent.add(function(){t._done();});ed.onBeforeExecCommand.add(function(ed,cmd){if(cmd=='mceFullScreen')
t._done();});t.languages={};each(ed.getParam('spellchecker_languages','+English=en,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Polish=pl,Portuguese=pt,Spanish=es,Swedish=sv','hash'),function(v,k){if(k.indexOf('+')===0){k=k.substring(1);t.selectedLang=v;}
t.languages[k]=v;});ed.onInit.add(function(){if(t.native_spellchecker&&ed.getParam('spellchecker_browser_state',0)){var body=ed.getBody();body.spellcheck=t.active=!t.active;}});},createControl:function(n,cm){var t=this,c,ed=t.editor;if(n=='spellchecker'){if(t.native_spellchecker){if(t.hasSupport)
c=cm.createButton(n,{title:'spellchecker.desc',cmd:'mceSpellCheck',scope:t});return c;}
c=cm.createSplitButton(n,{title:'spellchecker.desc',cmd:'mceSpellCheck',scope:t});c.onRenderMenu.add(function(c,m){m.add({title:'spellchecker.langs','class':'mceMenuItemTitle'}).setDisabled(1);t.menuItems={};each(t.languages,function(v,k){var o={icon:1},mi;o.onclick=function(){if(v==t.selectedLang){return;}
t._updateMenu(mi);t.selectedLang=v;};o.title=k;mi=m.add(o);mi.setSelected(v==t.selectedLang);t.menuItems[v]=mi;if(v==t.selectedLang){t.selectedItem=mi;}});});return c;}},setLanguage:function(lang){var t=this;if(lang==t.selectedLang){return;}
if(tinymce.grep(t.languages,function(v){return v===lang;}).length===0){throw"Unknown language: "+lang;}
t.selectedLang=lang;if(t.menuItems){t._updateMenu(t.menuItems[lang]);}
if(t.active){t._done();}},_updateMenu:function(mi){mi.setSelected(1);this.selectedItem.setSelected(0);this.selectedItem=mi;},_walk:function(n,f){var d=this.editor.getDoc(),w;if(d.createTreeWalker){w=d.createTreeWalker(n,NodeFilter.SHOW_TEXT,null,false);while((n=w.nextNode())!=null)
f.call(this,n);}else
tinymce.walk(n,f,'childNodes');},_getSeparators:function(){var re='',i,str=this.editor.getParam('spellchecker_word_separator_chars','\\s!"#$%&()*+,-./:;<=>?@[\]^_{|}ß©´Æ±∂∑∏ªºΩæø◊˜§\u201d\u201c');for(i=0;i<str.length;i++)
re+='\\'+str.charAt(i);return re;},_getWords:function(){var ed=this.editor,wl=[],tx='',lo={},rawWords=[];this._walk(ed.getBody(),function(n){if(n.nodeType==3)
tx+=n.nodeValue+' ';});if(ed.getParam('spellchecker_word_pattern')){rawWords=tx.match('('+ed.getParam('spellchecker_word_pattern')+')','gi');}else{tx=tx.replace(new RegExp('([0-9]|['+this._getSeparators()+'])','g'),' ');tx=tinymce.trim(tx.replace(/(\s+)/g,' '));rawWords=tx.split(' ');}
each(rawWords,function(v){if(!lo[v]){wl.push(v);lo[v]=1;}});return wl;},_removeWords:function(w){var ed=this.editor,dom=ed.dom,se=ed.selection,r=se.getRng(true);each(dom.select('span').reverse(),function(n){if(n&&(dom.hasClass(n,'mceItemHiddenSpellWord')||dom.hasClass(n,'mceItemHidden'))){if(!w||dom.decode(n.innerHTML)==w)
dom.remove(n,1);}});se.setRng(r);},_markWords:function(wl){var ed=this.editor,dom=ed.dom,doc=ed.getDoc(),se=ed.selection,r=se.getRng(true),nl=[],w=wl.join('|'),re=this._getSeparators(),rx=new RegExp('(^|['+re+'])('+w+')(?=['+re+']|$)','g');this._walk(ed.getBody(),function(n){if(n.nodeType==3){nl.push(n);}});each(nl,function(n){var node,elem,txt,pos,v=n.nodeValue;rx.lastIndex=0;if(rx.test(v)){v=dom.encode(v);elem=dom.create('span',{'class':'mceItemHidden'});if(tinymce.isIE){v=v.replace(rx,'$1<mcespell>$2</mcespell>');while((pos=v.indexOf('<mcespell>'))!=-1){txt=v.substring(0,pos);if(txt.length){node=doc.createTextNode(dom.decode(txt));elem.appendChild(node);}
v=v.substring(pos+10);pos=v.indexOf('</mcespell>');txt=v.substring(0,pos);v=v.substring(pos+11);elem.appendChild(dom.create('span',{'class':'mceItemHiddenSpellWord'},txt));}
if(v.length){node=doc.createTextNode(dom.decode(v));elem.appendChild(node);}}else{elem.innerHTML=v.replace(rx,'$1<span class="mceItemHiddenSpellWord">$2</span>');}
dom.replace(elem,n);}});se.setRng(r);},_showMenu:function(ed,e){var t=this,ed=t.editor,m=t._menu,p1,dom=ed.dom,vp=dom.getViewPort(ed.getWin()),wordSpan=e.target;e=0;if(!m){m=ed.controlManager.createDropMenu('spellcheckermenu',{'class':'mceNoIcons'});t._menu=m;}
if(dom.hasClass(wordSpan,'mceItemHiddenSpellWord')){m.removeAll();m.add({title:'spellchecker.wait','class':'mceMenuItemTitle'}).setDisabled(1);t._sendRPC('getSuggestions',[t.selectedLang,dom.decode(wordSpan.innerHTML)],function(r){var ignoreRpc;m.removeAll();if(r.length>0){m.add({title:'spellchecker.sug','class':'mceMenuItemTitle'}).setDisabled(1);each(r,function(v){m.add({title:v,onclick:function(){dom.replace(ed.getDoc().createTextNode(v),wordSpan);t._checkDone();}});});m.addSeparator();}else
m.add({title:'spellchecker.no_sug','class':'mceMenuItemTitle'}).setDisabled(1);if(ed.getParam('show_ignore_words',true)){ignoreRpc=t.editor.getParam("spellchecker_enable_ignore_rpc",'');m.add({title:'spellchecker.ignore_word',onclick:function(){var word=wordSpan.innerHTML;dom.remove(wordSpan,1);t._checkDone();if(ignoreRpc){ed.setProgressState(1);t._sendRPC('ignoreWord',[t.selectedLang,word],function(r){ed.setProgressState(0);});}}});m.add({title:'spellchecker.ignore_words',onclick:function(){var word=wordSpan.innerHTML;t._removeWords(dom.decode(word));t._checkDone();if(ignoreRpc){ed.setProgressState(1);t._sendRPC('ignoreWords',[t.selectedLang,word],function(r){ed.setProgressState(0);});}}});}
if(t.editor.getParam("spellchecker_enable_learn_rpc")){m.add({title:'spellchecker.learn_word',onclick:function(){var word=wordSpan.innerHTML;dom.remove(wordSpan,1);t._checkDone();ed.setProgressState(1);t._sendRPC('learnWord',[t.selectedLang,word],function(r){ed.setProgressState(0);});}});}
m.update();});p1=DOM.getPos(ed.getContentAreaContainer());m.settings.offset_x=p1.x;m.settings.offset_y=p1.y;ed.selection.select(wordSpan);p1=dom.getPos(wordSpan);m.showMenu(p1.x,p1.y+wordSpan.offsetHeight-vp.y);return tinymce.dom.Event.cancel(e);}else
m.hideMenu();},_checkDone:function(){var t=this,ed=t.editor,dom=ed.dom,o;each(dom.select('span'),function(n){if(n&&dom.hasClass(n,'mceItemHiddenSpellWord')){o=true;return false;}});if(!o)
t._done();},_done:function(){var t=this,la=t.active;if(t.active){t.active=!!t.native_spellchecker;t._removeWords();if(t._menu)
t._menu.hideMenu();if(la)
t.editor.nodeChanged();}},_sendRPC:function(m,p,cb){var t=this,ed=t.editor;var query='',args={'format':'raw'};args[ed.settings.token]=1;for(k in args){query+='&'+k+'='+encodeURIComponent(args[k]);}
tinymce.util.XHR.send({url:t.rpcUrl,content_type:'application/x-www-form-urlencoded',data:'json='+JSON.serialize({'fn':m,'args':p})+query,success:function(o){var c=JSON.parse(o);if(typeof(c)=='undefined'){c={error:'JSON Parse error.'};}
if(c.error){ed.setProgressState(0);var e=c.error;ed.windowManager.alert(e.errstr||('Error response: '+e));}else{cb.call(t,c.result||'');}},error:function(x){ed.setProgressState(0);ed.windowManager.alert('Error response: '+x);}});}});tinymce.PluginManager.add('spellchecker',tinymce.plugins.SpellcheckerPlugin);})();
var _____WB$wombat$assign$function_____ = function(name) {return (self._wb_wombat && self._wb_wombat.local_init && self._wb_wombat.local_init(name)) || self[name]; };
if (!self.__WB_pmw) { self.__WB_pmw = function(obj) { this.__WB_source = obj; return this; } }
{
  let window = _____WB$wombat$assign$function_____("window");
  let self = _____WB$wombat$assign$function_____("self");
  let document = _____WB$wombat$assign$function_____("document");
  let location = _____WB$wombat$assign$function_____("location");
  let top = _____WB$wombat$assign$function_____("top");
  let parent = _____WB$wombat$assign$function_____("parent");
  let frames = _____WB$wombat$assign$function_____("frames");
  let opener = _____WB$wombat$assign$function_____("opener");


(function($){
$.fn.slide=function(options){
$.fn.slide.defaults={
type:"slide",
effect:"fade",
autoPlay:false,
delayTime:500,
interTime:2500,
triggerTime:150,
defaultIndex:0,
titCell:".hd li",
mainCell:".bd",
targetCell:null,
trigger:"mouseover",
scroll:1,
vis:1,
titOnClassName:"on",
autoPage:false,
prevCell:".prev",
nextCell:".next",
pageStateCell:".pageState",
opp: false,
pnLoop:true,
easing:"swing",
startFun:null,
endFun:null,
switchLoad:null,
playStateCell:".playState",
mouseOverStop:true,
defaultPlay:true,
returnDefault:false
};
return this.each(function() {
var opts = $.extend({},$.fn.slide.defaults,options);
var slider = $(this);
var effect = opts.effect;
var prevBtn = $(opts.prevCell, slider);
var nextBtn = $(opts.nextCell, slider);
var pageState = $(opts.pageStateCell, slider);
var playState = $(opts.playStateCell, slider);
var navObj = $(opts.titCell, slider);//导航子元素结合
var navObjSize = navObj.size();
var conBox = $(opts.mainCell , slider);//内容元素父层对象
var conBoxSize=conBox.children().size();
var sLoad=opts.switchLoad;
var tarObj = $(opts.targetCell, slider);
var index=parseInt(opts.defaultIndex);
var delayTime=parseInt(opts.delayTime);
var interTime=parseInt(opts.interTime);
var triggerTime=parseInt(opts.triggerTime);
var scroll=parseInt(opts.scroll);
var vis=parseInt(opts.vis);
var autoPlay = (opts.autoPlay=="false"||opts.autoPlay==false)?false:true;
var opp = (opts.opp=="false"||opts.opp==false)?false:true;
var autoPage = (opts.autoPage=="false"||opts.autoPage==false)?false:true;
var pnLoop = (opts.pnLoop=="false"||opts.pnLoop==false)?false:true;
var mouseOverStop = (opts.mouseOverStop=="false"||opts.mouseOverStop==false)?false:true;
var defaultPlay = (opts.defaultPlay=="false"||opts.defaultPlay==false)?false:true;
var returnDefault = (opts.returnDefault=="false"||opts.returnDefault==false)?false:true;
var slideH=0;
var slideW=0;
var selfW=0;
var selfH=0;
var easing=opts.easing;
var inter=null;//autoPlay-setInterval
var mst =null;//trigger-setTimeout
var rtnST=null;//returnDefault-setTimeout
var titOn = opts.titOnClassName;
var onIndex = navObj.index( slider.find( "."+titOn) );
var oldIndex = index = onIndex==-1?index:onIndex;
var defaultIndex = index;
var _ind = index;
var cloneNum = conBoxSize>=vis?( conBoxSize%scroll!=0?conBoxSize%scroll:scroll):0;
var _tar;
var isMarq = effect=="leftMarquee" || effect=="topMarquee"?true:false;
var doStartFun=function(){ if ( $.isFunction( opts.startFun) ){ opts.startFun( index,navObjSize,slider,$(opts.titCell, slider),conBox,tarObj,prevBtn,nextBtn ) } }
var doEndFun=function(){ if ( $.isFunction( opts.endFun ) ){ opts.endFun( index,navObjSize,slider,$(opts.titCell, slider),conBox,tarObj,prevBtn,nextBtn ) } }
var resetOn=function(){ navObj.removeClass(titOn); if( defaultPlay ) navObj.eq(defaultIndex).addClass(titOn)  }
if (opts.hvValue) {
var box_id = $(this).attr('id');
if (conBoxSize < vis) vis = conBoxSize;
var max_width  = opts.hvValue.max_width;
var max_height = opts.hvValue.max_height;
$(this).css('width', max_width).css('height', max_height).addClass(opts.hvValue.type);;
if (opts.hvValue.type == 'vertical') {
effect = 'topLoop';
$(this).addClass('right');
var bd_width  = Math.round(max_width / 4 - parseInt($('#'+box_id+' .bd').css('margin-left')) - parseInt($('#'+box_id+' .bd').css('margin-right')));
var bd_height = max_height - parseInt($('#'+box_id+' .bd').css('margin-top')) - parseInt($('#'+box_id+' .bd').css('margin-bottom')) - parseInt($('#'+box_id+' .bd').css('padding-top')) - parseInt($('#'+box_id+' .bd').css('padding-bottom'));
var cont_width  = Math.round(max_width / 4 * 3 - parseInt($('.slide_cont').css('margin-left')));
var cont_height = max_height - parseInt($('.slide_cont').css('margin-top')) - parseInt($('.slide_cont').css('margin-bottom'));
var bd_img_width  = bd_width - parseInt($('#'+box_id+' .bd li').css('padding-left')) - parseInt($('#'+box_id+' .bd img').css('border-left-width')) - parseInt($('#'+box_id+' .bd img').css('border-right-width'));
var bd_img_height = Math.round(bd_height / 4 - parseInt($('#'+box_id+' .bd li').css('margin-bottom')) - parseInt($('#'+box_id+' .bd img').css('border-top-width')) - parseInt($('#'+box_id+' .bd img').css('border-bottom-width')));
} else if (opts.hvValue.type == 'horizontal') {
effect = 'leftLoop';
$(this).addClass('bottom');
var bd_width  = max_width - parseInt($('#'+box_id+' .bd').css('margin-left')) - parseInt($('#'+box_id+' .bd').css('margin-right')) - parseInt($('#'+box_id+' .bd').css('padding-left')) - parseInt($('#'+box_id+' .bd').css('padding-right'));
var bd_height = Math.round(max_height / 4 - parseInt($('#'+box_id+' .bd').css('margin-top')) - parseInt($('#'+box_id+' .bd').css('margin-bottom')));
var cont_width  = max_width - parseInt($('.slide_cont').css('margin-left')) - parseInt($('.slide_cont').css('margin-right'));
var cont_height = Math.round(max_height / 4 * 3 - parseInt($('.slide_cont').css('margin-top')));
var bd_img_width  = Math.round(bd_width / 4 - parseInt($('#'+box_id+' .bd li').css('margin-right')) - parseInt($('#'+box_id+' .bd img').css('border-left-width')) - parseInt($('#'+box_id+' .bd img').css('border-right-width')));
var bd_img_height = bd_height - parseInt($('#'+box_id+' .bd li').css('padding-top')) - parseInt($('#'+box_id+' .bd img').css('border-top-width')) - parseInt($('#'+box_id+' .bd img').css('border-bottom-width'));
} else if (opts.hvValue.type == 'number' || opts.hvValue.type == 'dotted') {
effect = 'leftLoop';
$(this).addClass(opts.hvValue.type);
}
if (opts.hvValue.type == 'vertical' || opts.hvValue.type == 'horizontal') {
conBox.children().each(function(){ $(this).width();});
$(this).find('.bd').css('width', bd_width).css('height', bd_height);
$(this).find('.bd img').css('width', bd_img_width).css('height', bd_img_height);
$(this).find('.slide_cont').css('width', cont_width).css('height', cont_height);
$(this).find('.slide_cont img').css('width', cont_width).css('height', cont_height);
var slide_obj = $(this);
var slideActive = function(p_obj) {
slide_obj.find('.slide_cont img').attr('src', p_obj.attr('src'));
slide_obj.find('.slide_cont a').attr('href', p_obj.attr('datahref'));
slide_obj.find('.slide_cont .title a').html(p_obj.attr('title'));
slide_obj.find('.bd li').removeClass('on');
p_obj.parent().addClass('on');
};
opts.startFun = function(i,c) {
var j = i+1;
slideActive(slide_obj.find(".bd img:eq("+j+")"));
}
}
}
if( opts.type=="menu" ){
if( defaultPlay ){ navObj.removeClass(titOn).eq(index).addClass(titOn); }
navObj.hover(
function(){
_tar=$(this).find( opts.targetCell );
var hoverInd =navObj.index($(this));
mst = setTimeout(function(){
index=hoverInd;
navObj.removeClass(titOn).eq	(index).addClass(titOn);
doStartFun();
switch (effect)
{
case "fade":_tar.stop(true,true).animate({opacity:"show"}, delayTime,easing,doEndFun ); break;
case "slideDown":_tar.stop(true,true).animate({height:"show"}, delayTime,easing,doEndFun ); break;
}
} ,opts.triggerTime);
},function(){
clearTimeout(mst);
switch (effect){ case "fade":_tar.animate( {opacity:"hide"},delayTime,easing ); break; case "slideDown":_tar.animate( {height:"hide"},delayTime,easing ); break; }
}
);
if (returnDefault){
slider.hover(function(){clearTimeout(rtnST);},function(){ rtnST = setTimeout( resetOn,delayTime ); });
}
return;
}
if( navObjSize==0 )navObjSize=conBoxSize;//只有左右按钮
if( isMarq ) navObjSize=2;
if( autoPage ){
if(conBoxSize>=vis){
if( effect=="leftLoop" || effect=="topLoop" ){ navObjSize=conBoxSize%scroll!=0?(conBoxSize/scroll^0)+1:conBoxSize/scroll; }
else{
var tempS = conBoxSize-vis;
navObjSize=1+parseInt(tempS%scroll!=0?(tempS/scroll+1):(tempS/scroll));
if(navObjSize<=0)navObjSize=1;
}
}
else{ navObjSize=1 }
navObj.html("");
var str="";
if( opts.autoPage==true || opts.autoPage=="true" ){ for( var i=0; i<navObjSize; i++ ){ str+="<li>"+(i+1)+"</li>" } }
else{ for( var i=0; i<navObjSize; i++ ){ str+=opts.autoPage.replace("$",(i+1))  } }
navObj.html(str);
var navObj = navObj.children();//重置导航子元素对象
}
if(conBoxSize>=vis){
conBox.children().each(function(){
if( $(this).width()>selfW ){ selfW=$(this).width(); slideW=$(this).outerWidth(true);  }
if( $(this).height()>selfH ){ selfH=$(this).height(); slideH=$(this).outerHeight(true);  }
});
var _chr = conBox.children();
var cloneEle = function(){
for( var i=0; i<vis ; i++ ){ _chr.eq(i).clone().addClass("clone").appendTo(conBox); }
for( var i=0; i<cloneNum ; i++ ){ _chr.eq(conBoxSize-i-1).clone().addClass("clone").prependTo(conBox); }
}
switch(effect)
{
case "fold": conBox.css({"position":"relative","width":slideW,"height":slideH}).children().css( {"position":"absolute","width":selfW,"left":0,"top":0,"display":"none"} ); break;
case "top": conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; height:'+vis*slideH+'px"></div>').css( { "top":-(index*scroll)*slideH, "position":"relative","padding":"0","margin":"0"}).children().css( {"height":selfH} ); break;
case "left": conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; width:'+vis*slideW+'px"></div>').css( { "width":conBoxSize*slideW,"left":-(index*scroll)*slideW,"position":"relative","overflow":"hidden","padding":"0","margin":"0"}).children().css( {"float":"left","width":selfW} ); break;
case "leftLoop":
case "leftMarquee":
cloneEle();
conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; width:'+vis*slideW+'px"></div>').css( { "width":(conBoxSize+vis+cloneNum)*slideW,"position":"relative","overflow":"hidden","padding":"0","margin":"0","left":-(cloneNum+index*scroll)*slideW}).children().css( {"float":"left","width":selfW}  ); break;
case "topLoop":
case "topMarquee":
cloneEle();
conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; height:'+vis*slideH+'px"></div>').css( { "height":(conBoxSize+vis+cloneNum)*slideH,"position":"relative","padding":"0","margin":"0","top":-(cloneNum+index*scroll)*slideH}).children().css( {"height":selfH} ); break;
}
}
var scrollNum=function(ind){
var _tempCs= ind*scroll;
if( ind==navObjSize ){ _tempCs=conBoxSize; }else if( ind==-1 && conBoxSize%scroll!=0){ _tempCs=-conBoxSize%scroll; }
return _tempCs;
}
var doSwitchLoad=function(objs){
var changeImg=function(t){
for ( var i= t; i<( vis+ t); i++ ){
objs.eq(i).find("img["+sLoad+"]").each(function(){
var _this =  $(this);
_this.attr("src",_this.attr(sLoad)).removeAttr(sLoad);
if( conBox.find(".clone")[0] ){
var chir = conBox.children();
for ( var j=0 ; j< chir.size() ; j++ )
{
chir.eq(j).find("img["+sLoad+"]").each(function(){
if( $(this).attr(sLoad)==_this.attr("src") ) $(this).attr("src",$(this).attr(sLoad)).removeAttr(sLoad)
})
}
}
})
}
}
switch(effect)
{
case "fade": case "fold": case "top": case "left": case "slideDown":
changeImg( index*scroll );
break;
case "leftLoop": case "topLoop":
changeImg( cloneNum+scrollNum(_ind) );
break;
case "leftMarquee":case "topMarquee":
var curS = effect=="leftMarquee"? conBox.css("left").replace("px",""):conBox.css("top").replace("px","");
var slideT = effect=="leftMarquee"? slideW:slideH;
var mNum=cloneNum;
if( curS%slideT!=0 ){
var curP = Math.abs(curS/slideT^0);
if( index==1 ){ mNum=cloneNum+curP }else{  mNum=cloneNum+curP-1  }
}
changeImg( mNum );
break;
}
}//doSwitchLoad end
var doPlay=function(init){
if( defaultPlay && oldIndex==index && !init && !isMarq ) return;
if( isMarq ){ if ( index>= 1) { index=1; } else if( index<=0) { index = 0; } }
else{
_ind=index; if ( index >= navObjSize) { index = 0; } else if( index < 0) { index = navObjSize-1; }
}
doStartFun();
if( sLoad!=null ){ doSwitchLoad( conBox.children() ) }
if(tarObj[0]){
_tar = tarObj.eq(index);
if( sLoad!=null ){ doSwitchLoad( tarObj ) }
if( effect=="slideDown" ){
tarObj.not(_tar).stop(true,true).slideUp(delayTime);
_tar.slideDown( delayTime,easing,function(){ if(!conBox[0]) doEndFun() });
}
else{
tarObj.not(_tar).stop(true,true).hide();
_tar.animate({opacity:"show"},delayTime,function(){ if(!conBox[0]) doEndFun() });
}
}
if(conBoxSize>=vis){
switch (effect)
{
case "fade":conBox.children().stop(true,true).eq(index).animate({opacity:"show"},delayTime,easing,function(){doEndFun()}).siblings().hide(); break;
case "fold":conBox.children().stop(true,true).eq(index).animate({opacity:"show"},delayTime,easing,function(){doEndFun()}).siblings().animate({opacity:"hide"},delayTime,easing);break;
case "top":conBox.stop(true,false).animate({"top":-index*scroll*slideH},delayTime,easing,function(){doEndFun()});break;
case "left":conBox.stop(true,false).animate({"left":-index*scroll*slideW},delayTime,easing,function(){doEndFun()});break;
case "leftLoop":
var __ind = _ind;
conBox.stop(true,true).animate({"left":-(scrollNum(_ind)+cloneNum)*slideW},delayTime,easing,function(){
if( __ind<=-1 ){ conBox.css("left",-(cloneNum+(navObjSize-1)*scroll)*slideW);  }else if( __ind>=navObjSize ){ conBox.css("left",-cloneNum*slideW); }
doEndFun();
});
break;//leftLoop end
case "topLoop":
var __ind = _ind;
conBox.stop(true,true).animate({"top":-(scrollNum(_ind)+cloneNum)*slideH},delayTime,easing,function(){
if( __ind<=-1 ){ conBox.css("top",-(cloneNum+(navObjSize-1)*scroll)*slideH);  }else if( __ind>=navObjSize ){ conBox.css("top",-cloneNum*slideH); }
doEndFun();
});
break;//topLoop end
case "leftMarquee":
var tempLeft = conBox.css("left").replace("px","");
if(index==0 ){
conBox.animate({"left":++tempLeft},0,function(){
if( conBox.css("left").replace("px","")>= 0){ conBox.css("left",-conBoxSize*slideW) }
});
}
else{
conBox.animate({"left":--tempLeft},0,function(){
if(  conBox.css("left").replace("px","")<= -(conBoxSize+cloneNum)*slideW){ conBox.css("left",-cloneNum*slideW) }
});
}break;// leftMarquee end
case "topMarquee":
var tempTop = conBox.css("top").replace("px","");
if(index==0 ){
conBox.animate({"top":++tempTop},0,function(){
if( conBox.css("top").replace("px","")>= 0){ conBox.css("top",-conBoxSize*slideH) }
});
}
else{
conBox.animate({"top":--tempTop},0,function(){
if(  conBox.css("top").replace("px","")<= -(conBoxSize+cloneNum)*slideH){ conBox.css("top",-cloneNum*slideH) }
});
}break;// topMarquee end
}//switch end
}
navObj.removeClass(titOn).eq(index).addClass(titOn);
oldIndex=index;
if( !pnLoop ){
nextBtn.removeClass("nextStop"); prevBtn.removeClass("prevStop");
if (index==0 ){ prevBtn.addClass("prevStop"); }
if (index==navObjSize-1 ){ nextBtn.addClass("nextStop"); }
}
pageState.html( "<span>"+(index+1)+"</span>/"+navObjSize);
};// doPlay end
if( defaultPlay ){ doPlay(true); }
if (returnDefault)//返回默认状态
{
slider.hover(function(){ clearTimeout(rtnST) },function(){
rtnST = setTimeout( function(){
index=defaultIndex;
if(defaultPlay){ doPlay(); }
else{
if( effect=="slideDown" ){ _tar.slideUp( delayTime, resetOn ); }
else{ _tar.animate({opacity:"hide"},delayTime,resetOn ); }
}
oldIndex=index;
},300 );
});
}
var setInter = function(time){ inter=setInterval(function(){  opp?index--:index++; doPlay() }, !!time?time:interTime);  }
var setMarInter = function(time){ inter = setInterval(doPlay, !!time?time:interTime);  }
var resetInter = function(){ if( !mouseOverStop ){clearInterval(inter); setInter() } }
var nextTrigger = function(){ if ( pnLoop || index!=navObjSize-1 ){ index++; doPlay(); if(!isMarq)resetInter(); } }
var prevTrigger = function(){ if ( pnLoop || index!=0 ){ index--; doPlay(); if(!isMarq)resetInter(); } }
var playStateFun = function(){ clearInterval(inter); isMarq?setMarInter():setInter(); playState.removeClass("pauseState") }
var pauseStateFun = function(){ clearInterval(inter);playState.addClass("pauseState"); }
if (autoPlay) {
if( isMarq ){
opp?index--:index++; setMarInter();
if(mouseOverStop) conBox.hover(pauseStateFun,playStateFun);
}else{
setInter();
if(mouseOverStop) slider.hover( pauseStateFun,playStateFun );
}
}
else{ if( isMarq ){ opp?index--:index++; } playState.addClass("pauseState"); }
playState.click(function(){  playState.hasClass("pauseState")?playStateFun():pauseStateFun()  });
if(opts.trigger=="mouseover"){
navObj.hover(function(){ var hoverInd = navObj.index(this);  mst = setTimeout(function(){  index=hoverInd; doPlay(); resetInter();  },opts.triggerTime); }, function(){ clearTimeout(mst) });
}else{ navObj.click(function(){ index=navObj.index(this); doPlay(); resetInter(); })  }
if (isMarq){
nextBtn.mousedown(nextTrigger);
prevBtn.mousedown(prevTrigger);
if (pnLoop)
{
var st;
var marDown = function(){ st=setTimeout(function(){ clearInterval(inter); setMarInter( interTime/10^0 ) },150) }
var marUp = function(){ clearTimeout(st); clearInterval(inter); setMarInter() }
nextBtn.mousedown(marDown); nextBtn.mouseup(marUp);
prevBtn.mousedown(marDown); prevBtn.mouseup(marUp);
}
if( opts.trigger=="mouseover"  ){ nextBtn.hover(nextTrigger,function(){}); prevBtn.hover(prevTrigger,function(){}); }
}else{
nextBtn.click(nextTrigger);
prevBtn.click(prevTrigger);
}
if (opts.hvValue.type == 'vertical' || opts.hvValue.type == 'horizontal') {
$(this).find(".bd img").click(function() {
slideActive($(this));
});
}
});//each End
};//slide End
})(jQuery);
jQuery.easing['jswing'] = jQuery.easing['swing'];
jQuery.extend( jQuery.easing,
{
def: 'easeOutQuad',
swing: function (x, t, b, c, d) { return jQuery.easing[jQuery.easing.def](x, t, b, c, d); },
easeInQuad: function (x, t, b, c, d) {return c*(t/=d)*t + b;},
easeOutQuad: function (x, t, b, c, d) {return -c *(t/=d)*(t-2) + b},
easeInOutQuad: function (x, t, b, c, d) {if ((t/=d/2) < 1) return c/2*t*t + b;return -c/2 * ((--t)*(t-2) - 1) + b},
easeInCubic: function (x, t, b, c, d) {return c*(t/=d)*t*t + b},
easeOutCubic: function (x, t, b, c, d) {return c*((t=t/d-1)*t*t + 1) + b},
easeInOutCubic: function (x, t, b, c, d) {if ((t/=d/2) < 1) return c/2*t*t*t + b;return c/2*((t-=2)*t*t + 2) + b},
easeInQuart: function (x, t, b, c, d) {return c*(t/=d)*t*t*t + b},
easeOutQuart: function (x, t, b, c, d) {return -c * ((t=t/d-1)*t*t*t - 1) + b},
easeInOutQuart: function (x, t, b, c, d) {if ((t/=d/2) < 1) return c/2*t*t*t*t + b;return -c/2 * ((t-=2)*t*t*t - 2) + b},
easeInQuint: function (x, t, b, c, d) {return c*(t/=d)*t*t*t*t + b},
easeOutQuint: function (x, t, b, c, d) {return c*((t=t/d-1)*t*t*t*t + 1) + b},
easeInOutQuint: function (x, t, b, c, d) {if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;return c/2*((t-=2)*t*t*t*t + 2) + b},
easeInSine: function (x, t, b, c, d) {return -c * Math.cos(t/d * (Math.PI/2)) + c + b},
easeOutSine: function (x, t, b, c, d) {return c * Math.sin(t/d * (Math.PI/2)) + b},
easeInOutSine: function (x, t, b, c, d) {return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b},
easeInExpo: function (x, t, b, c, d) {return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b},
easeOutExpo: function (x, t, b, c, d) {return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b},
easeInOutExpo: function (x, t, b, c, d) {if (t==0) return b;if (t==d) return b+c;if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;return c/2 * (-Math.pow(2, -10 * --t) + 2) + b},
easeInCirc: function (x, t, b, c, d) {return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b},
easeOutCirc: function (x, t, b, c, d) {return c * Math.sqrt(1 - (t=t/d-1)*t) + b},
easeInOutCirc: function (x, t, b, c, d) {if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b},
easeInElastic: function (x, t, b, c, d) {var s=1.70158;var p=0;var a=c;if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;if (a < Math.abs(c)) { a=c; var s=p/4; }
else var s = p/(2*Math.PI) * Math.asin (c/a);return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b},
easeOutElastic: function (x, t, b, c, d) {var s=1.70158;var p=0;var a=c;if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;if (a < Math.abs(c)) { a=c; var s=p/4; }
else var s = p/(2*Math.PI) * Math.asin (c/a);return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b},
easeInOutElastic: function (x, t, b, c, d) {var s=1.70158;var p=0;var a=c;if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);if (a < Math.abs(c)) { a=c; var s=p/4; }
else var s = p/(2*Math.PI) * Math.asin (c/a);if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b},
easeInBack: function (x, t, b, c, d, s) {if (s == undefined) s = 1.70158;return c*(t/=d)*t*((s+1)*t - s) + b},
easeOutBack: function (x, t, b, c, d, s) {if (s == undefined) s = 1.70158;return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b},
easeInOutBack: function (x, t, b, c, d, s) {if (s == undefined) s = 1.70158;
if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b},
easeInBounce: function (x, t, b, c, d) {return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b},
easeOutBounce: function (x, t, b, c, d) {if ((t/=d) < (1/2.75)) {	return c*(7.5625*t*t) + b;} else if (t < (2/2.75)) {	return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;} else if (t < (2.5/2.75)) {	return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;} else {	return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;}},
easeInOutBounce: function (x, t, b, c, d) {if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;}
});
(function( $, undefined ) {
var uuid = 0,
runiqueId = /^ui-id-\d+$/;
$.ui = $.ui || {};
$.extend( $.ui, {
version: "1.10.3",
keyCode: {
BACKSPACE: 8,
COMMA: 188,
DELETE: 46,
DOWN: 40,
END: 35,
ENTER: 13,
ESCAPE: 27,
HOME: 36,
LEFT: 37,
NUMPAD_ADD: 107,
NUMPAD_DECIMAL: 110,
NUMPAD_DIVIDE: 111,
NUMPAD_ENTER: 108,
NUMPAD_MULTIPLY: 106,
NUMPAD_SUBTRACT: 109,
PAGE_DOWN: 34,
PAGE_UP: 33,
PERIOD: 190,
RIGHT: 39,
SPACE: 32,
TAB: 9,
UP: 38
}
});
$.fn.extend({
focus: (function( orig ) {
return function( delay, fn ) {
return typeof delay === "number" ?
this.each(function() {
var elem = this;
setTimeout(function() {
$( elem ).focus();
if ( fn ) {
fn.call( elem );
}
}, delay );
}) :
orig.apply( this, arguments );
};
})( $.fn.focus ),
scrollParent: function() {
var scrollParent;
if (($.ui.ie && (/(static|relative)/).test(this.css("position"))) || (/absolute/).test(this.css("position"))) {
scrollParent = this.parents().filter(function() {
return (/(relative|absolute|fixed)/).test($.css(this,"position")) && (/(auto|scroll)/).test($.css(this,"overflow")+$.css(this,"overflow-y")+$.css(this,"overflow-x"));
}).eq(0);
} else {
scrollParent = this.parents().filter(function() {
return (/(auto|scroll)/).test($.css(this,"overflow")+$.css(this,"overflow-y")+$.css(this,"overflow-x"));
}).eq(0);
}
return (/fixed/).test(this.css("position")) || !scrollParent.length ? $(document) : scrollParent;
},
zIndex: function( zIndex ) {
if ( zIndex !== undefined ) {
return this.css( "zIndex", zIndex );
}
if ( this.length ) {
var elem = $( this[ 0 ] ), position, value;
while ( elem.length && elem[ 0 ] !== document ) {
position = elem.css( "position" );
if ( position === "absolute" || position === "relative" || position === "fixed" ) {
value = parseInt( elem.css( "zIndex" ), 10 );
if ( !isNaN( value ) && value !== 0 ) {
return value;
}
}
elem = elem.parent();
}
}
return 0;
},
uniqueId: function() {
return this.each(function() {
if ( !this.id ) {
this.id = "ui-id-" + (++uuid);
}
});
},
removeUniqueId: function() {
return this.each(function() {
if ( runiqueId.test( this.id ) ) {
$( this ).removeAttr( "id" );
}
});
}
});
function focusable( element, isTabIndexNotNaN ) {
var map, mapName, img,
nodeName = element.nodeName.toLowerCase();
if ( "area" === nodeName ) {
map = element.parentNode;
mapName = map.name;
if ( !element.href || !mapName || map.nodeName.toLowerCase() !== "map" ) {
return false;
}
img = $( "img[usemap=#" + mapName + "]" )[0];
return !!img && visible( img );
}
return ( /input|select|textarea|button|object/.test( nodeName ) ?
!element.disabled :
"a" === nodeName ?
element.href || isTabIndexNotNaN :
isTabIndexNotNaN) &&
visible( element );
}
function visible( element ) {
return $.expr.filters.visible( element ) &&
!$( element ).parents().addBack().filter(function() {
return $.css( this, "visibility" ) === "hidden";
}).length;
}
$.extend( $.expr[ ":" ], {
data: $.expr.createPseudo ?
$.expr.createPseudo(function( dataName ) {
return function( elem ) {
return !!$.data( elem, dataName );
};
}) :
function( elem, i, match ) {
return !!$.data( elem, match[ 3 ] );
},
focusable: function( element ) {
return focusable( element, !isNaN( $.attr( element, "tabindex" ) ) );
},
tabbable: function( element ) {
var tabIndex = $.attr( element, "tabindex" ),
isTabIndexNaN = isNaN( tabIndex );
return ( isTabIndexNaN || tabIndex >= 0 ) && focusable( element, !isTabIndexNaN );
}
});
if ( !$( "<a>" ).outerWidth( 1 ).jquery ) {
$.each( [ "Width", "Height" ], function( i, name ) {
var side = name === "Width" ? [ "Left", "Right" ] : [ "Top", "Bottom" ],
type = name.toLowerCase(),
orig = {
innerWidth: $.fn.innerWidth,
innerHeight: $.fn.innerHeight,
outerWidth: $.fn.outerWidth,
outerHeight: $.fn.outerHeight
};
function reduce( elem, size, border, margin ) {
$.each( side, function() {
size -= parseFloat( $.css( elem, "padding" + this ) ) || 0;
if ( border ) {
size -= parseFloat( $.css( elem, "border" + this + "Width" ) ) || 0;
}
if ( margin ) {
size -= parseFloat( $.css( elem, "margin" + this ) ) || 0;
}
});
return size;
}
$.fn[ "inner" + name ] = function( size ) {
if ( size === undefined ) {
return orig[ "inner" + name ].call( this );
}
return this.each(function() {
$( this ).css( type, reduce( this, size ) + "px" );
});
};
$.fn[ "outer" + name] = function( size, margin ) {
if ( typeof size !== "number" ) {
return orig[ "outer" + name ].call( this, size );
}
return this.each(function() {
$( this).css( type, reduce( this, size, true, margin ) + "px" );
});
};
});
}
if ( !$.fn.addBack ) {
$.fn.addBack = function( selector ) {
return this.add( selector == null ?
this.prevObject : this.prevObject.filter( selector )
);
};
}
if ( $( "<a>" ).data( "a-b", "a" ).removeData( "a-b" ).data( "a-b" ) ) {
$.fn.removeData = (function( removeData ) {
return function( key ) {
if ( arguments.length ) {
return removeData.call( this, $.camelCase( key ) );
} else {
return removeData.call( this );
}
};
})( $.fn.removeData );
}
$.ui.ie = !!/msie [\w.]+/.exec( navigator.userAgent.toLowerCase() );
$.support.selectstart = "onselectstart" in document.createElement( "div" );
$.fn.extend({
disableSelection: function() {
return this.bind( ( $.support.selectstart ? "selectstart" : "mousedown" ) +
".ui-disableSelection", function( event ) {
event.preventDefault();
});
},
enableSelection: function() {
return this.unbind( ".ui-disableSelection" );
}
});
$.extend( $.ui, {
plugin: {
add: function( module, option, set ) {
var i,
proto = $.ui[ module ].prototype;
for ( i in set ) {
proto.plugins[ i ] = proto.plugins[ i ] || [];
proto.plugins[ i ].push( [ option, set[ i ] ] );
}
},
call: function( instance, name, args ) {
var i,
set = instance.plugins[ name ];
if ( !set || !instance.element[ 0 ].parentNode || instance.element[ 0 ].parentNode.nodeType === 11 ) {
return;
}
for ( i = 0; i < set.length; i++ ) {
if ( instance.options[ set[ i ][ 0 ] ] ) {
set[ i ][ 1 ].apply( instance.element, args );
}
}
}
},
hasScroll: function( el, a ) {
if ( $( el ).css( "overflow" ) === "hidden") {
return false;
}
var scroll = ( a && a === "left" ) ? "scrollLeft" : "scrollTop",
has = false;
if ( el[ scroll ] > 0 ) {
return true;
}
el[ scroll ] = 1;
has = ( el[ scroll ] > 0 );
el[ scroll ] = 0;
return has;
}
});
})( jQuery );
(function( $, undefined ) {
var uuid = 0,
slice = Array.prototype.slice,
_cleanData = $.cleanData;
$.cleanData = function( elems ) {
for ( var i = 0, elem; (elem = elems[i]) != null; i++ ) {
try {
$( elem ).triggerHandler( "remove" );
} catch( e ) {}
}
_cleanData( elems );
};
$.widget = function( name, base, prototype ) {
var fullName, existingConstructor, constructor, basePrototype,
proxiedPrototype = {},
namespace = name.split( "." )[ 0 ];
name = name.split( "." )[ 1 ];
fullName = namespace + "-" + name;
if ( !prototype ) {
prototype = base;
base = $.Widget;
}
$.expr[ ":" ][ fullName.toLowerCase() ] = function( elem ) {
return !!$.data( elem, fullName );
};
$[ namespace ] = $[ namespace ] || {};
existingConstructor = $[ namespace ][ name ];
constructor = $[ namespace ][ name ] = function( options, element ) {
if ( !this._createWidget ) {
return new constructor( options, element );
}
if ( arguments.length ) {
this._createWidget( options, element );
}
};
$.extend( constructor, existingConstructor, {
version: prototype.version,
_proto: $.extend( {}, prototype ),
_childConstructors: []
});
basePrototype = new base();
basePrototype.options = $.widget.extend( {}, basePrototype.options );
$.each( prototype, function( prop, value ) {
if ( !$.isFunction( value ) ) {
proxiedPrototype[ prop ] = value;
return;
}
proxiedPrototype[ prop ] = (function() {
var _super = function() {
return base.prototype[ prop ].apply( this, arguments );
},
_superApply = function( args ) {
return base.prototype[ prop ].apply( this, args );
};
return function() {
var __super = this._super,
__superApply = this._superApply,
returnValue;
this._super = _super;
this._superApply = _superApply;
returnValue = value.apply( this, arguments );
this._super = __super;
this._superApply = __superApply;
return returnValue;
};
})();
});
constructor.prototype = $.widget.extend( basePrototype, {
widgetEventPrefix: existingConstructor ? basePrototype.widgetEventPrefix : name
}, proxiedPrototype, {
constructor: constructor,
namespace: namespace,
widgetName: name,
widgetFullName: fullName
});
if ( existingConstructor ) {
$.each( existingConstructor._childConstructors, function( i, child ) {
var childPrototype = child.prototype;
$.widget( childPrototype.namespace + "." + childPrototype.widgetName, constructor, child._proto );
});
delete existingConstructor._childConstructors;
} else {
base._childConstructors.push( constructor );
}
$.widget.bridge( name, constructor );
};
$.widget.extend = function( target ) {
var input = slice.call( arguments, 1 ),
inputIndex = 0,
inputLength = input.length,
key,
value;
for ( ; inputIndex < inputLength; inputIndex++ ) {
for ( key in input[ inputIndex ] ) {
value = input[ inputIndex ][ key ];
if ( input[ inputIndex ].hasOwnProperty( key ) && value !== undefined ) {
if ( $.isPlainObject( value ) ) {
target[ key ] = $.isPlainObject( target[ key ] ) ?
$.widget.extend( {}, target[ key ], value ) :
$.widget.extend( {}, value );
} else {
target[ key ] = value;
}
}
}
}
return target;
};
$.widget.bridge = function( name, object ) {
var fullName = object.prototype.widgetFullName || name;
$.fn[ name ] = function( options ) {
var isMethodCall = typeof options === "string",
args = slice.call( arguments, 1 ),
returnValue = this;
options = !isMethodCall && args.length ?
$.widget.extend.apply( null, [ options ].concat(args) ) :
options;
if ( isMethodCall ) {
this.each(function() {
var methodValue,
instance = $.data( this, fullName );
if ( !instance ) {
return $.error( "cannot call methods on " + name + " prior to initialization; " +
"attempted to call method '" + options + "'" );
}
if ( !$.isFunction( instance[options] ) || options.charAt( 0 ) === "_" ) {
return $.error( "no such method '" + options + "' for " + name + " widget instance" );
}
methodValue = instance[ options ].apply( instance, args );
if ( methodValue !== instance && methodValue !== undefined ) {
returnValue = methodValue && methodValue.jquery ?
returnValue.pushStack( methodValue.get() ) :
methodValue;
return false;
}
});
} else {
this.each(function() {
var instance = $.data( this, fullName );
if ( instance ) {
instance.option( options || {} )._init();
} else {
$.data( this, fullName, new object( options, this ) );
}
});
}
return returnValue;
};
};
$.Widget = function(  ) {};
$.Widget._childConstructors = [];
$.Widget.prototype = {
widgetName: "widget",
widgetEventPrefix: "",
defaultElement: "<div>",
options: {
disabled: false,
create: null
},
_createWidget: function( options, element ) {
element = $( element || this.defaultElement || this )[ 0 ];
this.element = $( element );
this.uuid = uuid++;
this.eventNamespace = "." + this.widgetName + this.uuid;
this.options = $.widget.extend( {},
this.options,
this._getCreateOptions(),
options );
this.bindings = $();
this.hoverable = $();
this.focusable = $();
if ( element !== this ) {
$.data( element, this.widgetFullName, this );
this._on( true, this.element, {
remove: function( event ) {
if ( event.target === element ) {
this.destroy();
}
}
});
this.document = $( element.style ?
element.ownerDocument :
element.document || element );
this.window = $( this.document[0].defaultView || this.document[0].parentWindow );
}
this._create();
this._trigger( "create", null, this._getCreateEventData() );
this._init();
},
_getCreateOptions: $.noop,
_getCreateEventData: $.noop,
_create: $.noop,
_init: $.noop,
destroy: function() {
this._destroy();
this.element
.unbind( this.eventNamespace )
.removeData( this.widgetName )
.removeData( this.widgetFullName )
.removeData( $.camelCase( this.widgetFullName ) );
this.widget()
.unbind( this.eventNamespace )
.removeAttr( "aria-disabled" )
.removeClass(
this.widgetFullName + "-disabled " +
"ui-state-disabled" );
this.bindings.unbind( this.eventNamespace );
this.hoverable.removeClass( "ui-state-hover" );
this.focusable.removeClass( "ui-state-focus" );
},
_destroy: $.noop,
widget: function() {
return this.element;
},
option: function( key, value ) {
var options = key,
parts,
curOption,
i;
if ( arguments.length === 0 ) {
return $.widget.extend( {}, this.options );
}
if ( typeof key === "string" ) {
options = {};
parts = key.split( "." );
key = parts.shift();
if ( parts.length ) {
curOption = options[ key ] = $.widget.extend( {}, this.options[ key ] );
for ( i = 0; i < parts.length - 1; i++ ) {
curOption[ parts[ i ] ] = curOption[ parts[ i ] ] || {};
curOption = curOption[ parts[ i ] ];
}
key = parts.pop();
if ( value === undefined ) {
return curOption[ key ] === undefined ? null : curOption[ key ];
}
curOption[ key ] = value;
} else {
if ( value === undefined ) {
return this.options[ key ] === undefined ? null : this.options[ key ];
}
options[ key ] = value;
}
}
this._setOptions( options );
return this;
},
_setOptions: function( options ) {
var key;
for ( key in options ) {
this._setOption( key, options[ key ] );
}
return this;
},
_setOption: function( key, value ) {
this.options[ key ] = value;
if ( key === "disabled" ) {
this.widget()
.toggleClass( this.widgetFullName + "-disabled ui-state-disabled", !!value )
.attr( "aria-disabled", value );
this.hoverable.removeClass( "ui-state-hover" );
this.focusable.removeClass( "ui-state-focus" );
}
return this;
},
enable: function() {
return this._setOption( "disabled", false );
},
disable: function() {
return this._setOption( "disabled", true );
},
_on: function( suppressDisabledCheck, element, handlers ) {
var delegateElement,
instance = this;
if ( typeof suppressDisabledCheck !== "boolean" ) {
handlers = element;
element = suppressDisabledCheck;
suppressDisabledCheck = false;
}
if ( !handlers ) {
handlers = element;
element = this.element;
delegateElement = this.widget();
} else {
element = delegateElement = $( element );
this.bindings = this.bindings.add( element );
}
$.each( handlers, function( event, handler ) {
function handlerProxy() {
if ( !suppressDisabledCheck &&
( instance.options.disabled === true ||
$( this ).hasClass( "ui-state-disabled" ) ) ) {
return;
}
return ( typeof handler === "string" ? instance[ handler ] : handler )
.apply( instance, arguments );
}
if ( typeof handler !== "string" ) {
handlerProxy.guid = handler.guid =
handler.guid || handlerProxy.guid || $.guid++;
}
var match = event.match( /^(\w+)\s*(.*)$/ ),
eventName = match[1] + instance.eventNamespace,
selector = match[2];
if ( selector ) {
delegateElement.delegate( selector, eventName, handlerProxy );
} else {
element.bind( eventName, handlerProxy );
}
});
},
_off: function( element, eventName ) {
eventName = (eventName || "").split( " " ).join( this.eventNamespace + " " ) + this.eventNamespace;
element.unbind( eventName ).undelegate( eventName );
},
_delay: function( handler, delay ) {
function handlerProxy() {
return ( typeof handler === "string" ? instance[ handler ] : handler )
.apply( instance, arguments );
}
var instance = this;
return setTimeout( handlerProxy, delay || 0 );
},
_hoverable: function( element ) {
this.hoverable = this.hoverable.add( element );
this._on( element, {
mouseenter: function( event ) {
$( event.currentTarget ).addClass( "ui-state-hover" );
},
mouseleave: function( event ) {
$( event.currentTarget ).removeClass( "ui-state-hover" );
}
});
},
_focusable: function( element ) {
this.focusable = this.focusable.add( element );
this._on( element, {
focusin: function( event ) {
$( event.currentTarget ).addClass( "ui-state-focus" );
},
focusout: function( event ) {
$( event.currentTarget ).removeClass( "ui-state-focus" );
}
});
},
_trigger: function( type, event, data ) {
var prop, orig,
callback = this.options[ type ];
data = data || {};
event = $.Event( event );
event.type = ( type === this.widgetEventPrefix ?
type :
this.widgetEventPrefix + type ).toLowerCase();
event.target = this.element[ 0 ];
orig = event.originalEvent;
if ( orig ) {
for ( prop in orig ) {
if ( !( prop in event ) ) {
event[ prop ] = orig[ prop ];
}
}
}
this.element.trigger( event, data );
return !( $.isFunction( callback ) &&
callback.apply( this.element[0], [ event ].concat( data ) ) === false ||
event.isDefaultPrevented() );
}
};
$.each( { show: "fadeIn", hide: "fadeOut" }, function( method, defaultEffect ) {
$.Widget.prototype[ "_" + method ] = function( element, options, callback ) {
if ( typeof options === "string" ) {
options = { effect: options };
}
var hasOptions,
effectName = !options ?
method :
options === true || typeof options === "number" ?
defaultEffect :
options.effect || defaultEffect;
options = options || {};
if ( typeof options === "number" ) {
options = { duration: options };
}
hasOptions = !$.isEmptyObject( options );
options.complete = callback;
if ( options.delay ) {
element.delay( options.delay );
}
if ( hasOptions && $.effects && $.effects.effect[ effectName ] ) {
element[ method ]( options );
} else if ( effectName !== method && element[ effectName ] ) {
element[ effectName ]( options.duration, options.easing, callback );
} else {
element.queue(function( next ) {
$( this )[ method ]();
if ( callback ) {
callback.call( element[ 0 ] );
}
next();
});
}
};
});
})( jQuery );
(function( $, undefined ) {
var mouseHandled = false;
$( document ).mouseup( function() {
mouseHandled = false;
});
$.widget("ui.mouse", {
version: "1.10.3",
options: {
cancel: "input,textarea,button,select,option",
distance: 1,
delay: 0
},
_mouseInit: function() {
var that = this;
this.element
.bind("mousedown."+this.widgetName, function(event) {
return that._mouseDown(event);
})
.bind("click."+this.widgetName, function(event) {
if (true === $.data(event.target, that.widgetName + ".preventClickEvent")) {
$.removeData(event.target, that.widgetName + ".preventClickEvent");
event.stopImmediatePropagation();
return false;
}
});
this.started = false;
},
_mouseDestroy: function() {
this.element.unbind("."+this.widgetName);
if ( this._mouseMoveDelegate ) {
$(document)
.unbind("mousemove."+this.widgetName, this._mouseMoveDelegate)
.unbind("mouseup."+this.widgetName, this._mouseUpDelegate);
}
},
_mouseDown: function(event) {
if( mouseHandled ) { return; }
(this._mouseStarted && this._mouseUp(event));
this._mouseDownEvent = event;
var that = this,
btnIsLeft = (event.which === 1),
elIsCancel = (typeof this.options.cancel === "string" && event.target.nodeName ? $(event.target).closest(this.options.cancel).length : false);
if (!btnIsLeft || elIsCancel || !this._mouseCapture(event)) {
return true;
}
this.mouseDelayMet = !this.options.delay;
if (!this.mouseDelayMet) {
this._mouseDelayTimer = setTimeout(function() {
that.mouseDelayMet = true;
}, this.options.delay);
}
if (this._mouseDistanceMet(event) && this._mouseDelayMet(event)) {
this._mouseStarted = (this._mouseStart(event) !== false);
if (!this._mouseStarted) {
event.preventDefault();
return true;
}
}
if (true === $.data(event.target, this.widgetName + ".preventClickEvent")) {
$.removeData(event.target, this.widgetName + ".preventClickEvent");
}
this._mouseMoveDelegate = function(event) {
return that._mouseMove(event);
};
this._mouseUpDelegate = function(event) {
return that._mouseUp(event);
};
$(document)
.bind("mousemove."+this.widgetName, this._mouseMoveDelegate)
.bind("mouseup."+this.widgetName, this._mouseUpDelegate);
event.preventDefault();
mouseHandled = true;
return true;
},
_mouseMove: function(event) {
if ($.ui.ie && ( !document.documentMode || document.documentMode < 9 ) && !event.button) {
return this._mouseUp(event);
}
if (this._mouseStarted) {
this._mouseDrag(event);
return event.preventDefault();
}
if (this._mouseDistanceMet(event) && this._mouseDelayMet(event)) {
this._mouseStarted =
(this._mouseStart(this._mouseDownEvent, event) !== false);
(this._mouseStarted ? this._mouseDrag(event) : this._mouseUp(event));
}
return !this._mouseStarted;
},
_mouseUp: function(event) {
$(document)
.unbind("mousemove."+this.widgetName, this._mouseMoveDelegate)
.unbind("mouseup."+this.widgetName, this._mouseUpDelegate);
if (this._mouseStarted) {
this._mouseStarted = false;
if (event.target === this._mouseDownEvent.target) {
$.data(event.target, this.widgetName + ".preventClickEvent", true);
}
this._mouseStop(event);
}
return false;
},
_mouseDistanceMet: function(event) {
return (Math.max(
Math.abs(this._mouseDownEvent.pageX - event.pageX),
Math.abs(this._mouseDownEvent.pageY - event.pageY)
) >= this.options.distance
);
},
_mouseDelayMet: function() {
return this.mouseDelayMet;
},
_mouseStart: function() {},
_mouseDrag: function() {},
_mouseStop: function() {},
_mouseCapture: function() { return true; }
});
})(jQuery);
(function( $, undefined ) {
$.widget("ui.draggable", $.ui.mouse, {
version: "1.10.3",
widgetEventPrefix: "drag",
options: {
addClasses: true,
appendTo: "parent",
axis: false,
connectToSortable: false,
containment: false,
cursor: "auto",
cursorAt: false,
grid: false,
handle: false,
helper: "original",
iframeFix: false,
opacity: false,
refreshPositions: false,
revert: false,
revertDuration: 500,
scope: "default",
scroll: true,
scrollSensitivity: 20,
scrollSpeed: 20,
snap: false,
snapMode: "both",
snapTolerance: 20,
stack: false,
zIndex: false,
drag: null,
start: null,
stop: null
},
_create: function() {
if (this.options.helper === "original" && !(/^(?:r|a|f)/).test(this.element.css("position"))) {
this.element[0].style.position = "relative";
}
if (this.options.addClasses){
this.element.addClass("ui-draggable");
}
if (this.options.disabled){
this.element.addClass("ui-draggable-disabled");
}
this._mouseInit();
},
_destroy: function() {
this.element.removeClass( "ui-draggable ui-draggable-dragging ui-draggable-disabled" );
this._mouseDestroy();
},
_mouseCapture: function(event) {
var o = this.options;
if (this.helper || o.disabled || $(event.target).closest(".ui-resizable-handle").length > 0) {
return false;
}
this.handle = this._getHandle(event);
if (!this.handle) {
return false;
}
$(o.iframeFix === true ? "iframe" : o.iframeFix).each(function() {
$("<div class='ui-draggable-iframeFix' style='background: #fff;'></div>")
.css({
width: this.offsetWidth+"px", height: this.offsetHeight+"px",
position: "absolute", opacity: "0.001", zIndex: 1000
})
.css($(this).offset())
.appendTo("body");
});
return true;
},
_mouseStart: function(event) {
var o = this.options;
this.helper = this._createHelper(event);
this.helper.addClass("ui-draggable-dragging");
this._cacheHelperProportions();
if($.ui.ddmanager) {
$.ui.ddmanager.current = this;
}
this._cacheMargins();
this.cssPosition = this.helper.css( "position" );
this.scrollParent = this.helper.scrollParent();
this.offsetParent = this.helper.offsetParent();
this.offsetParentCssPosition = this.offsetParent.css( "position" );
this.offset = this.positionAbs = this.element.offset();
this.offset = {
top: this.offset.top - this.margins.top,
left: this.offset.left - this.margins.left
};
this.offset.scroll = false;
$.extend(this.offset, {
click: {
left: event.pageX - this.offset.left,
top: event.pageY - this.offset.top
},
parent: this._getParentOffset(),
relative: this._getRelativeOffset()
});
this.originalPosition = this.position = this._generatePosition(event);
this.originalPageX = event.pageX;
this.originalPageY = event.pageY;
(o.cursorAt && this._adjustOffsetFromHelper(o.cursorAt));
this._setContainment();
if(this._trigger("start", event) === false) {
this._clear();
return false;
}
this._cacheHelperProportions();
if ($.ui.ddmanager && !o.dropBehaviour) {
$.ui.ddmanager.prepareOffsets(this, event);
}
this._mouseDrag(event, true);
if ( $.ui.ddmanager ) {
$.ui.ddmanager.dragStart(this, event);
}
return true;
},
_mouseDrag: function(event, noPropagation) {
if ( this.offsetParentCssPosition === "fixed" ) {
this.offset.parent = this._getParentOffset();
}
this.position = this._generatePosition(event);
this.positionAbs = this._convertPositionTo("absolute");
if (!noPropagation) {
var ui = this._uiHash();
if(this._trigger("drag", event, ui) === false) {
this._mouseUp({});
return false;
}
this.position = ui.position;
}
if(!this.options.axis || this.options.axis !== "y") {
this.helper[0].style.left = this.position.left+"px";
}
if(!this.options.axis || this.options.axis !== "x") {
this.helper[0].style.top = this.position.top+"px";
}
if($.ui.ddmanager) {
$.ui.ddmanager.drag(this, event);
}
return false;
},
_mouseStop: function(event) {
var that = this,
dropped = false;
if ($.ui.ddmanager && !this.options.dropBehaviour) {
dropped = $.ui.ddmanager.drop(this, event);
}
if(this.dropped) {
dropped = this.dropped;
this.dropped = false;
}
if ( this.options.helper === "original" && !$.contains( this.element[ 0 ].ownerDocument, this.element[ 0 ] ) ) {
return false;
}
if((this.options.revert === "invalid" && !dropped) || (this.options.revert === "valid" && dropped) || this.options.revert === true || ($.isFunction(this.options.revert) && this.options.revert.call(this.element, dropped))) {
$(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function() {
if(that._trigger("stop", event) !== false) {
that._clear();
}
});
} else {
if(this._trigger("stop", event) !== false) {
this._clear();
}
}
return false;
},
_mouseUp: function(event) {
$("div.ui-draggable-iframeFix").each(function() {
this.parentNode.removeChild(this);
});
if( $.ui.ddmanager ) {
$.ui.ddmanager.dragStop(this, event);
}
return $.ui.mouse.prototype._mouseUp.call(this, event);
},
cancel: function() {
if(this.helper.is(".ui-draggable-dragging")) {
this._mouseUp({});
} else {
this._clear();
}
return this;
},
_getHandle: function(event) {
return this.options.handle ?
!!$( event.target ).closest( this.element.find( this.options.handle ) ).length :
true;
},
_createHelper: function(event) {
var o = this.options,
helper = $.isFunction(o.helper) ? $(o.helper.apply(this.element[0], [event])) : (o.helper === "clone" ? this.element.clone().removeAttr("id") : this.element);
if(!helper.parents("body").length) {
helper.appendTo((o.appendTo === "parent" ? this.element[0].parentNode : o.appendTo));
}
if(helper[0] !== this.element[0] && !(/(fixed|absolute)/).test(helper.css("position"))) {
helper.css("position", "absolute");
}
return helper;
},
_adjustOffsetFromHelper: function(obj) {
if (typeof obj === "string") {
obj = obj.split(" ");
}
if ($.isArray(obj)) {
obj = {left: +obj[0], top: +obj[1] || 0};
}
if ("left" in obj) {
this.offset.click.left = obj.left + this.margins.left;
}
if ("right" in obj) {
this.offset.click.left = this.helperProportions.width - obj.right + this.margins.left;
}
if ("top" in obj) {
this.offset.click.top = obj.top + this.margins.top;
}
if ("bottom" in obj) {
this.offset.click.top = this.helperProportions.height - obj.bottom + this.margins.top;
}
},
_getParentOffset: function() {
var po = this.offsetParent.offset();
if(this.cssPosition === "absolute" && this.scrollParent[0] !== document && $.contains(this.scrollParent[0], this.offsetParent[0])) {
po.left += this.scrollParent.scrollLeft();
po.top += this.scrollParent.scrollTop();
}
if((this.offsetParent[0] === document.body) ||
(this.offsetParent[0].tagName && this.offsetParent[0].tagName.toLowerCase() === "html" && $.ui.ie)) {
po = { top: 0, left: 0 };
}
return {
top: po.top + (parseInt(this.offsetParent.css("borderTopWidth"),10) || 0),
left: po.left + (parseInt(this.offsetParent.css("borderLeftWidth"),10) || 0)
};
},
_getRelativeOffset: function() {
if(this.cssPosition === "relative") {
var p = this.element.position();
return {
top: p.top - (parseInt(this.helper.css("top"),10) || 0) + this.scrollParent.scrollTop(),
left: p.left - (parseInt(this.helper.css("left"),10) || 0) + this.scrollParent.scrollLeft()
};
} else {
return { top: 0, left: 0 };
}
},
_cacheMargins: function() {
this.margins = {
left: (parseInt(this.element.css("marginLeft"),10) || 0),
top: (parseInt(this.element.css("marginTop"),10) || 0),
right: (parseInt(this.element.css("marginRight"),10) || 0),
bottom: (parseInt(this.element.css("marginBottom"),10) || 0)
};
},
_cacheHelperProportions: function() {
this.helperProportions = {
width: this.helper.outerWidth(),
height: this.helper.outerHeight()
};
},
_setContainment: function() {
var over, c, ce,
o = this.options;
if ( !o.containment ) {
this.containment = null;
return;
}
if ( o.containment === "window" ) {
this.containment = [
$( window ).scrollLeft() - this.offset.relative.left - this.offset.parent.left,
$( window ).scrollTop() - this.offset.relative.top - this.offset.parent.top,
$( window ).scrollLeft() + $( window ).width() - this.helperProportions.width - this.margins.left,
$( window ).scrollTop() + ( $( window ).height() || document.body.parentNode.scrollHeight ) - this.helperProportions.height - this.margins.top
];
return;
}
if ( o.containment === "document") {
this.containment = [
0,
0,
$( document ).width() - this.helperProportions.width - this.margins.left,
( $( document ).height() || document.body.parentNode.scrollHeight ) - this.helperProportions.height - this.margins.top
];
return;
}
if ( o.containment.constructor === Array ) {
this.containment = o.containment;
return;
}
if ( o.containment === "parent" ) {
o.containment = this.helper[ 0 ].parentNode;
}
c = $( o.containment );
ce = c[ 0 ];
if( !ce ) {
return;
}
over = c.css( "overflow" ) !== "hidden";
this.containment = [
( parseInt( c.css( "borderLeftWidth" ), 10 ) || 0 ) + ( parseInt( c.css( "paddingLeft" ), 10 ) || 0 ),
( parseInt( c.css( "borderTopWidth" ), 10 ) || 0 ) + ( parseInt( c.css( "paddingTop" ), 10 ) || 0 ) ,
( over ? Math.max( ce.scrollWidth, ce.offsetWidth ) : ce.offsetWidth ) - ( parseInt( c.css( "borderRightWidth" ), 10 ) || 0 ) - ( parseInt( c.css( "paddingRight" ), 10 ) || 0 ) - this.helperProportions.width - this.margins.left - this.margins.right,
( over ? Math.max( ce.scrollHeight, ce.offsetHeight ) : ce.offsetHeight ) - ( parseInt( c.css( "borderBottomWidth" ), 10 ) || 0 ) - ( parseInt( c.css( "paddingBottom" ), 10 ) || 0 ) - this.helperProportions.height - this.margins.top  - this.margins.bottom
];
this.relative_container = c;
},
_convertPositionTo: function(d, pos) {
if(!pos) {
pos = this.position;
}
var mod = d === "absolute" ? 1 : -1,
scroll = this.cssPosition === "absolute" && !( this.scrollParent[ 0 ] !== document && $.contains( this.scrollParent[ 0 ], this.offsetParent[ 0 ] ) ) ? this.offsetParent : this.scrollParent;
if (!this.offset.scroll) {
this.offset.scroll = {top : scroll.scrollTop(), left : scroll.scrollLeft()};
}
return {
top: (
pos.top	+
this.offset.relative.top * mod +
this.offset.parent.top * mod -
( ( this.cssPosition === "fixed" ? -this.scrollParent.scrollTop() : this.offset.scroll.top ) * mod )
),
left: (
pos.left +
this.offset.relative.left * mod +
this.offset.parent.left * mod	-
( ( this.cssPosition === "fixed" ? -this.scrollParent.scrollLeft() : this.offset.scroll.left ) * mod )
)
};
},
_generatePosition: function(event) {
var containment, co, top, left,
o = this.options,
scroll = this.cssPosition === "absolute" && !( this.scrollParent[ 0 ] !== document && $.contains( this.scrollParent[ 0 ], this.offsetParent[ 0 ] ) ) ? this.offsetParent : this.scrollParent,
pageX = event.pageX,
pageY = event.pageY;
if (!this.offset.scroll) {
this.offset.scroll = {top : scroll.scrollTop(), left : scroll.scrollLeft()};
}
if ( this.originalPosition ) {
if ( this.containment ) {
if ( this.relative_container ){
co = this.relative_container.offset();
containment = [
this.containment[ 0 ] + co.left,
this.containment[ 1 ] + co.top,
this.containment[ 2 ] + co.left,
this.containment[ 3 ] + co.top
];
}
else {
containment = this.containment;
}
if(event.pageX - this.offset.click.left < containment[0]) {
pageX = containment[0] + this.offset.click.left;
}
if(event.pageY - this.offset.click.top < containment[1]) {
pageY = containment[1] + this.offset.click.top;
}
if(event.pageX - this.offset.click.left > containment[2]) {
pageX = containment[2] + this.offset.click.left;
}
if(event.pageY - this.offset.click.top > containment[3]) {
pageY = containment[3] + this.offset.click.top;
}
}
if(o.grid) {
top = o.grid[1] ? this.originalPageY + Math.round((pageY - this.originalPageY) / o.grid[1]) * o.grid[1] : this.originalPageY;
pageY = containment ? ((top - this.offset.click.top >= containment[1] || top - this.offset.click.top > containment[3]) ? top : ((top - this.offset.click.top >= containment[1]) ? top - o.grid[1] : top + o.grid[1])) : top;
left = o.grid[0] ? this.originalPageX + Math.round((pageX - this.originalPageX) / o.grid[0]) * o.grid[0] : this.originalPageX;
pageX = containment ? ((left - this.offset.click.left >= containment[0] || left - this.offset.click.left > containment[2]) ? left : ((left - this.offset.click.left >= containment[0]) ? left - o.grid[0] : left + o.grid[0])) : left;
}
}
return {
top: (
pageY -
this.offset.click.top	-
this.offset.relative.top -
this.offset.parent.top +
( this.cssPosition === "fixed" ? -this.scrollParent.scrollTop() : this.offset.scroll.top )
),
left: (
pageX -
this.offset.click.left -
this.offset.relative.left -
this.offset.parent.left +
( this.cssPosition === "fixed" ? -this.scrollParent.scrollLeft() : this.offset.scroll.left )
)
};
},
_clear: function() {
this.helper.removeClass("ui-draggable-dragging");
if(this.helper[0] !== this.element[0] && !this.cancelHelperRemoval) {
this.helper.remove();
}
this.helper = null;
this.cancelHelperRemoval = false;
},
_trigger: function(type, event, ui) {
ui = ui || this._uiHash();
$.ui.plugin.call(this, type, [event, ui]);
if(type === "drag") {
this.positionAbs = this._convertPositionTo("absolute");
}
return $.Widget.prototype._trigger.call(this, type, event, ui);
},
plugins: {},
_uiHash: function() {
return {
helper: this.helper,
position: this.position,
originalPosition: this.originalPosition,
offset: this.positionAbs
};
}
});
$.ui.plugin.add("draggable", "connectToSortable", {
start: function(event, ui) {
var inst = $(this).data("ui-draggable"), o = inst.options,
uiSortable = $.extend({}, ui, { item: inst.element });
inst.sortables = [];
$(o.connectToSortable).each(function() {
var sortable = $.data(this, "ui-sortable");
if (sortable && !sortable.options.disabled) {
inst.sortables.push({
instance: sortable,
shouldRevert: sortable.options.revert
});
sortable.refreshPositions();
sortable._trigger("activate", event, uiSortable);
}
});
},
stop: function(event, ui) {
var inst = $(this).data("ui-draggable"),
uiSortable = $.extend({}, ui, { item: inst.element });
$.each(inst.sortables, function() {
if(this.instance.isOver) {
this.instance.isOver = 0;
inst.cancelHelperRemoval = true;
this.instance.cancelHelperRemoval = false;
if(this.shouldRevert) {
this.instance.options.revert = this.shouldRevert;
}
this.instance._mouseStop(event);
this.instance.options.helper = this.instance.options._helper;
if(inst.options.helper === "original") {
this.instance.currentItem.css({ top: "auto", left: "auto" });
}
} else {
this.instance.cancelHelperRemoval = false;
this.instance._trigger("deactivate", event, uiSortable);
}
});
},
drag: function(event, ui) {
var inst = $(this).data("ui-draggable"), that = this;
$.each(inst.sortables, function() {
var innermostIntersecting = false,
thisSortable = this;
this.instance.positionAbs = inst.positionAbs;
this.instance.helperProportions = inst.helperProportions;
this.instance.offset.click = inst.offset.click;
if(this.instance._intersectsWith(this.instance.containerCache)) {
innermostIntersecting = true;
$.each(inst.sortables, function () {
this.instance.positionAbs = inst.positionAbs;
this.instance.helperProportions = inst.helperProportions;
this.instance.offset.click = inst.offset.click;
if (this !== thisSortable &&
this.instance._intersectsWith(this.instance.containerCache) &&
$.contains(thisSortable.instance.element[0], this.instance.element[0])
) {
innermostIntersecting = false;
}
return innermostIntersecting;
});
}
if(innermostIntersecting) {
if(!this.instance.isOver) {
this.instance.isOver = 1;
this.instance.currentItem = $(that).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item", true);
this.instance.options._helper = this.instance.options.helper;
this.instance.options.helper = function() { return ui.helper[0]; };
event.target = this.instance.currentItem[0];
this.instance._mouseCapture(event, true);
this.instance._mouseStart(event, true, true);
this.instance.offset.click.top = inst.offset.click.top;
this.instance.offset.click.left = inst.offset.click.left;
this.instance.offset.parent.left -= inst.offset.parent.left - this.instance.offset.parent.left;
this.instance.offset.parent.top -= inst.offset.parent.top - this.instance.offset.parent.top;
inst._trigger("toSortable", event);
inst.dropped = this.instance.element;
inst.currentItem = inst.element;
this.instance.fromOutside = inst;
}
if(this.instance.currentItem) {
this.instance._mouseDrag(event);
}
} else {
if(this.instance.isOver) {
this.instance.isOver = 0;
this.instance.cancelHelperRemoval = true;
this.instance.options.revert = false;
this.instance._trigger("out", event, this.instance._uiHash(this.instance));
this.instance._mouseStop(event, true);
this.instance.options.helper = this.instance.options._helper;
this.instance.currentItem.remove();
if(this.instance.placeholder) {
this.instance.placeholder.remove();
}
inst._trigger("fromSortable", event);
inst.dropped = false;
}
}
});
}
});
$.ui.plugin.add("draggable", "cursor", {
start: function() {
var t = $("body"), o = $(this).data("ui-draggable").options;
if (t.css("cursor")) {
o._cursor = t.css("cursor");
}
t.css("cursor", o.cursor);
},
stop: function() {
var o = $(this).data("ui-draggable").options;
if (o._cursor) {
$("body").css("cursor", o._cursor);
}
}
});
$.ui.plugin.add("draggable", "opacity", {
start: function(event, ui) {
var t = $(ui.helper), o = $(this).data("ui-draggable").options;
if(t.css("opacity")) {
o._opacity = t.css("opacity");
}
t.css("opacity", o.opacity);
},
stop: function(event, ui) {
var o = $(this).data("ui-draggable").options;
if(o._opacity) {
$(ui.helper).css("opacity", o._opacity);
}
}
});
$.ui.plugin.add("draggable", "scroll", {
start: function() {
var i = $(this).data("ui-draggable");
if(i.scrollParent[0] !== document && i.scrollParent[0].tagName !== "HTML") {
i.overflowOffset = i.scrollParent.offset();
}
},
drag: function( event ) {
var i = $(this).data("ui-draggable"), o = i.options, scrolled = false;
if(i.scrollParent[0] !== document && i.scrollParent[0].tagName !== "HTML") {
if(!o.axis || o.axis !== "x") {
if((i.overflowOffset.top + i.scrollParent[0].offsetHeight) - event.pageY < o.scrollSensitivity) {
i.scrollParent[0].scrollTop = scrolled = i.scrollParent[0].scrollTop + o.scrollSpeed;
} else if(event.pageY - i.overflowOffset.top < o.scrollSensitivity) {
i.scrollParent[0].scrollTop = scrolled = i.scrollParent[0].scrollTop - o.scrollSpeed;
}
}
if(!o.axis || o.axis !== "y") {
if((i.overflowOffset.left + i.scrollParent[0].offsetWidth) - event.pageX < o.scrollSensitivity) {
i.scrollParent[0].scrollLeft = scrolled = i.scrollParent[0].scrollLeft + o.scrollSpeed;
} else if(event.pageX - i.overflowOffset.left < o.scrollSensitivity) {
i.scrollParent[0].scrollLeft = scrolled = i.scrollParent[0].scrollLeft - o.scrollSpeed;
}
}
} else {
if(!o.axis || o.axis !== "x") {
if(event.pageY - $(document).scrollTop() < o.scrollSensitivity) {
scrolled = $(document).scrollTop($(document).scrollTop() - o.scrollSpeed);
} else if($(window).height() - (event.pageY - $(document).scrollTop()) < o.scrollSensitivity) {
scrolled = $(document).scrollTop($(document).scrollTop() + o.scrollSpeed);
}
}
if(!o.axis || o.axis !== "y") {
if(event.pageX - $(document).scrollLeft() < o.scrollSensitivity) {
scrolled = $(document).scrollLeft($(document).scrollLeft() - o.scrollSpeed);
} else if($(window).width() - (event.pageX - $(document).scrollLeft()) < o.scrollSensitivity) {
scrolled = $(document).scrollLeft($(document).scrollLeft() + o.scrollSpeed);
}
}
}
if(scrolled !== false && $.ui.ddmanager && !o.dropBehaviour) {
$.ui.ddmanager.prepareOffsets(i, event);
}
}
});
$.ui.plugin.add("draggable", "snap", {
start: function() {
var i = $(this).data("ui-draggable"),
o = i.options;
i.snapElements = [];
$(o.snap.constructor !== String ? ( o.snap.items || ":data(ui-draggable)" ) : o.snap).each(function() {
var $t = $(this),
$o = $t.offset();
if(this !== i.element[0]) {
i.snapElements.push({
item: this,
width: $t.outerWidth(), height: $t.outerHeight(),
top: $o.top, left: $o.left
});
}
});
},
drag: function(event, ui) {
var ts, bs, ls, rs, l, r, t, b, i, first,
inst = $(this).data("ui-draggable"),
o = inst.options,
d = o.snapTolerance,
x1 = ui.offset.left, x2 = x1 + inst.helperProportions.width,
y1 = ui.offset.top, y2 = y1 + inst.helperProportions.height;
for (i = inst.snapElements.length - 1; i >= 0; i--){
l = inst.snapElements[i].left;
r = l + inst.snapElements[i].width;
t = inst.snapElements[i].top;
b = t + inst.snapElements[i].height;
if ( x2 < l - d || x1 > r + d || y2 < t - d || y1 > b + d || !$.contains( inst.snapElements[ i ].item.ownerDocument, inst.snapElements[ i ].item ) ) {
if(inst.snapElements[i].snapping) {
(inst.options.snap.release && inst.options.snap.release.call(inst.element, event, $.extend(inst._uiHash(), { snapItem: inst.snapElements[i].item })));
}
inst.snapElements[i].snapping = false;
continue;
}
if(o.snapMode !== "inner") {
ts = Math.abs(t - y2) <= d;
bs = Math.abs(b - y1) <= d;
ls = Math.abs(l - x2) <= d;
rs = Math.abs(r - x1) <= d;
if(ts) {
ui.position.top = inst._convertPositionTo("relative", { top: t - inst.helperProportions.height, left: 0 }).top - inst.margins.top;
}
if(bs) {
ui.position.top = inst._convertPositionTo("relative", { top: b, left: 0 }).top - inst.margins.top;
}
if(ls) {
ui.position.left = inst._convertPositionTo("relative", { top: 0, left: l - inst.helperProportions.width }).left - inst.margins.left;
}
if(rs) {
ui.position.left = inst._convertPositionTo("relative", { top: 0, left: r }).left - inst.margins.left;
}
}
first = (ts || bs || ls || rs);
if(o.snapMode !== "outer") {
ts = Math.abs(t - y1) <= d;
bs = Math.abs(b - y2) <= d;
ls = Math.abs(l - x1) <= d;
rs = Math.abs(r - x2) <= d;
if(ts) {
ui.position.top = inst._convertPositionTo("relative", { top: t, left: 0 }).top - inst.margins.top;
}
if(bs) {
ui.position.top = inst._convertPositionTo("relative", { top: b - inst.helperProportions.height, left: 0 }).top - inst.margins.top;
}
if(ls) {
ui.position.left = inst._convertPositionTo("relative", { top: 0, left: l }).left - inst.margins.left;
}
if(rs) {
ui.position.left = inst._convertPositionTo("relative", { top: 0, left: r - inst.helperProportions.width }).left - inst.margins.left;
}
}
if(!inst.snapElements[i].snapping && (ts || bs || ls || rs || first)) {
(inst.options.snap.snap && inst.options.snap.snap.call(inst.element, event, $.extend(inst._uiHash(), { snapItem: inst.snapElements[i].item })));
}
inst.snapElements[i].snapping = (ts || bs || ls || rs || first);
}
}
});
$.ui.plugin.add("draggable", "stack", {
start: function() {
var min,
o = this.data("ui-draggable").options,
group = $.makeArray($(o.stack)).sort(function(a,b) {
return (parseInt($(a).css("zIndex"),10) || 0) - (parseInt($(b).css("zIndex"),10) || 0);
});
if (!group.length) { return; }
min = parseInt($(group[0]).css("zIndex"), 10) || 0;
$(group).each(function(i) {
$(this).css("zIndex", min + i);
});
this.css("zIndex", (min + group.length));
}
});
$.ui.plugin.add("draggable", "zIndex", {
start: function(event, ui) {
var t = $(ui.helper), o = $(this).data("ui-draggable").options;
if(t.css("zIndex")) {
o._zIndex = t.css("zIndex");
}
t.css("zIndex", o.zIndex);
},
stop: function(event, ui) {
var o = $(this).data("ui-draggable").options;
if(o._zIndex) {
$(ui.helper).css("zIndex", o._zIndex);
}
}
});
})(jQuery);
(function( $, undefined ) {
function isOverAxis( x, reference, size ) {
return ( x > reference ) && ( x < ( reference + size ) );
}
$.widget("ui.droppable", {
version: "1.10.3",
widgetEventPrefix: "drop",
options: {
accept: "*",
activeClass: false,
addClasses: true,
greedy: false,
hoverClass: false,
scope: "default",
tolerance: "intersect",
activate: null,
deactivate: null,
drop: null,
out: null,
over: null
},
_create: function() {
var o = this.options,
accept = o.accept;
this.isover = false;
this.isout = true;
this.accept = $.isFunction(accept) ? accept : function(d) {
return d.is(accept);
};
this.proportions = { width: this.element[0].offsetWidth, height: this.element[0].offsetHeight };
$.ui.ddmanager.droppables[o.scope] = $.ui.ddmanager.droppables[o.scope] || [];
$.ui.ddmanager.droppables[o.scope].push(this);
(o.addClasses && this.element.addClass("ui-droppable"));
},
_destroy: function() {
var i = 0,
drop = $.ui.ddmanager.droppables[this.options.scope];
for ( ; i < drop.length; i++ ) {
if ( drop[i] === this ) {
drop.splice(i, 1);
}
}
this.element.removeClass("ui-droppable ui-droppable-disabled");
},
_setOption: function(key, value) {
if(key === "accept") {
this.accept = $.isFunction(value) ? value : function(d) {
return d.is(value);
};
}
$.Widget.prototype._setOption.apply(this, arguments);
},
_activate: function(event) {
var draggable = $.ui.ddmanager.current;
if(this.options.activeClass) {
this.element.addClass(this.options.activeClass);
}
if(draggable){
this._trigger("activate", event, this.ui(draggable));
}
},
_deactivate: function(event) {
var draggable = $.ui.ddmanager.current;
if(this.options.activeClass) {
this.element.removeClass(this.options.activeClass);
}
if(draggable){
this._trigger("deactivate", event, this.ui(draggable));
}
},
_over: function(event) {
var draggable = $.ui.ddmanager.current;
if (!draggable || (draggable.currentItem || draggable.element)[0] === this.element[0]) {
return;
}
if (this.accept.call(this.element[0],(draggable.currentItem || draggable.element))) {
if(this.options.hoverClass) {
this.element.addClass(this.options.hoverClass);
}
this._trigger("over", event, this.ui(draggable));
}
},
_out: function(event) {
var draggable = $.ui.ddmanager.current;
if (!draggable || (draggable.currentItem || draggable.element)[0] === this.element[0]) {
return;
}
if (this.accept.call(this.element[0],(draggable.currentItem || draggable.element))) {
if(this.options.hoverClass) {
this.element.removeClass(this.options.hoverClass);
}
this._trigger("out", event, this.ui(draggable));
}
},
_drop: function(event,custom) {
var draggable = custom || $.ui.ddmanager.current,
childrenIntersection = false;
if (!draggable || (draggable.currentItem || draggable.element)[0] === this.element[0]) {
return false;
}
this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function() {
var inst = $.data(this, "ui-droppable");
if(
inst.options.greedy &&
!inst.options.disabled &&
inst.options.scope === draggable.options.scope &&
inst.accept.call(inst.element[0], (draggable.currentItem || draggable.element)) &&
$.ui.intersect(draggable, $.extend(inst, { offset: inst.element.offset() }), inst.options.tolerance)
) { childrenIntersection = true; return false; }
});
if(childrenIntersection) {
return false;
}
if(this.accept.call(this.element[0],(draggable.currentItem || draggable.element))) {
if(this.options.activeClass) {
this.element.removeClass(this.options.activeClass);
}
if(this.options.hoverClass) {
this.element.removeClass(this.options.hoverClass);
}
this._trigger("drop", event, this.ui(draggable));
return this.element;
}
return false;
},
ui: function(c) {
return {
draggable: (c.currentItem || c.element),
helper: c.helper,
position: c.position,
offset: c.positionAbs
};
}
});
$.ui.intersect = function(draggable, droppable, toleranceMode) {
if (!droppable.offset) {
return false;
}
var draggableLeft, draggableTop,
x1 = (draggable.positionAbs || draggable.position.absolute).left, x2 = x1 + draggable.helperProportions.width,
y1 = (draggable.positionAbs || draggable.position.absolute).top, y2 = y1 + draggable.helperProportions.height,
l = droppable.offset.left, r = l + droppable.proportions.width,
t = droppable.offset.top, b = t + droppable.proportions.height;
switch (toleranceMode) {
case "fit":
return (l <= x1 && x2 <= r && t <= y1 && y2 <= b);
case "intersect":
return (l < x1 + (draggable.helperProportions.width / 2) &&
x2 - (draggable.helperProportions.width / 2) < r &&
t < y1 + (draggable.helperProportions.height / 2) &&
y2 - (draggable.helperProportions.height / 2) < b );
case "pointer":
draggableLeft = ((draggable.positionAbs || draggable.position.absolute).left + (draggable.clickOffset || draggable.offset.click).left);
draggableTop = ((draggable.positionAbs || draggable.position.absolute).top + (draggable.clickOffset || draggable.offset.click).top);
return isOverAxis( draggableTop, t, droppable.proportions.height ) && isOverAxis( draggableLeft, l, droppable.proportions.width );
case "touch":
return (
(y1 >= t && y1 <= b) ||
(y2 >= t && y2 <= b) ||
(y1 < t && y2 > b)
) && (
(x1 >= l && x1 <= r) ||
(x2 >= l && x2 <= r) ||
(x1 < l && x2 > r)
);
default:
return false;
}
};
$.ui.ddmanager = {
current: null,
droppables: { "default": [] },
prepareOffsets: function(t, event) {
var i, j,
m = $.ui.ddmanager.droppables[t.options.scope] || [],
type = event ? event.type : null,
list = (t.currentItem || t.element).find(":data(ui-droppable)").addBack();
droppablesLoop: for (i = 0; i < m.length; i++) {
if(m[i].options.disabled || (t && !m[i].accept.call(m[i].element[0],(t.currentItem || t.element)))) {
continue;
}
for (j=0; j < list.length; j++) {
if(list[j] === m[i].element[0]) {
m[i].proportions.height = 0;
continue droppablesLoop;
}
}
m[i].visible = m[i].element.css("display") !== "none";
if(!m[i].visible) {
continue;
}
if(type === "mousedown") {
m[i]._activate.call(m[i], event);
}
m[i].offset = m[i].element.offset();
m[i].proportions = { width: m[i].element[0].offsetWidth, height: m[i].element[0].offsetHeight };
}
},
drop: function(draggable, event) {
var dropped = false;
$.each(($.ui.ddmanager.droppables[draggable.options.scope] || []).slice(), function() {
if(!this.options) {
return;
}
if (!this.options.disabled && this.visible && $.ui.intersect(draggable, this, this.options.tolerance)) {
dropped = this._drop.call(this, event) || dropped;
}
if (!this.options.disabled && this.visible && this.accept.call(this.element[0],(draggable.currentItem || draggable.element))) {
this.isout = true;
this.isover = false;
this._deactivate.call(this, event);
}
});
return dropped;
},
dragStart: function( draggable, event ) {
draggable.element.parentsUntil( "body" ).bind( "scroll.droppable", function() {
if( !draggable.options.refreshPositions ) {
$.ui.ddmanager.prepareOffsets( draggable, event );
}
});
},
drag: function(draggable, event) {
if(draggable.options.refreshPositions) {
$.ui.ddmanager.prepareOffsets(draggable, event);
}
$.each($.ui.ddmanager.droppables[draggable.options.scope] || [], function() {
if(this.options.disabled || this.greedyChild || !this.visible) {
return;
}
var parentInstance, scope, parent,
intersects = $.ui.intersect(draggable, this, this.options.tolerance),
c = !intersects && this.isover ? "isout" : (intersects && !this.isover ? "isover" : null);
if(!c) {
return;
}
if (this.options.greedy) {
scope = this.options.scope;
parent = this.element.parents(":data(ui-droppable)").filter(function () {
return $.data(this, "ui-droppable").options.scope === scope;
});
if (parent.length) {
parentInstance = $.data(parent[0], "ui-droppable");
parentInstance.greedyChild = (c === "isover");
}
}
if (parentInstance && c === "isover") {
parentInstance.isover = false;
parentInstance.isout = true;
parentInstance._out.call(parentInstance, event);
}
this[c] = true;
this[c === "isout" ? "isover" : "isout"] = false;
this[c === "isover" ? "_over" : "_out"].call(this, event);
if (parentInstance && c === "isout") {
parentInstance.isout = false;
parentInstance.isover = true;
parentInstance._over.call(parentInstance, event);
}
});
},
dragStop: function( draggable, event ) {
draggable.element.parentsUntil( "body" ).unbind( "scroll.droppable" );
if( !draggable.options.refreshPositions ) {
$.ui.ddmanager.prepareOffsets( draggable, event );
}
}
};
})(jQuery);
(function( $, undefined ) {
function num(v) {
return parseInt(v, 10) || 0;
}
function isNumber(value) {
return !isNaN(parseInt(value, 10));
}
$.widget("ui.resizable", $.ui.mouse, {
version: "1.10.3",
widgetEventPrefix: "resize",
options: {
alsoResize: false,
animate: false,
animateDuration: "slow",
animateEasing: "swing",
aspectRatio: false,
autoHide: false,
containment: false,
ghost: false,
grid: false,
handles: "e,s,se",
helper: false,
maxHeight: null,
maxWidth: null,
minHeight: 10,
minWidth: 10,
zIndex: 90,
resize: null,
start: null,
stop: null
},
_create: function() {
var n, i, handle, axis, hname,
that = this,
o = this.options;
this.element.addClass("ui-resizable");
$.extend(this, {
_aspectRatio: !!(o.aspectRatio),
aspectRatio: o.aspectRatio,
originalElement: this.element,
_proportionallyResizeElements: [],
_helper: o.helper || o.ghost || o.animate ? o.helper || "ui-resizable-helper" : null
});
if(this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i)) {
this.element.wrap(
$("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
position: this.element.css("position"),
width: this.element.outerWidth(),
height: this.element.outerHeight(),
top: this.element.css("top"),
left: this.element.css("left")
})
);
this.element = this.element.parent().data(
"ui-resizable", this.element.data("ui-resizable")
);
this.elementIsWrapper = true;
this.element.css({ marginLeft: this.originalElement.css("marginLeft"), marginTop: this.originalElement.css("marginTop"), marginRight: this.originalElement.css("marginRight"), marginBottom: this.originalElement.css("marginBottom") });
this.originalElement.css({ marginLeft: 0, marginTop: 0, marginRight: 0, marginBottom: 0});
this.originalResizeStyle = this.originalElement.css("resize");
this.originalElement.css("resize", "none");
this._proportionallyResizeElements.push(this.originalElement.css({ position: "static", zoom: 1, display: "block" }));
this.originalElement.css({ margin: this.originalElement.css("margin") });
this._proportionallyResize();
}
this.handles = o.handles || (!$(".ui-resizable-handle", this.element).length ? "e,s,se" : { n: ".ui-resizable-n", e: ".ui-resizable-e", s: ".ui-resizable-s", w: ".ui-resizable-w", se: ".ui-resizable-se", sw: ".ui-resizable-sw", ne: ".ui-resizable-ne", nw: ".ui-resizable-nw" });
if(this.handles.constructor === String) {
if ( this.handles === "all") {
this.handles = "n,e,s,w,se,sw,ne,nw";
}
n = this.handles.split(",");
this.handles = {};
for(i = 0; i < n.length; i++) {
handle = $.trim(n[i]);
hname = "ui-resizable-"+handle;
axis = $("<div class='ui-resizable-handle " + hname + "'></div>");
axis.css({ zIndex: o.zIndex });
if ("se" === handle) {
axis.addClass("ui-icon ui-icon-gripsmall-diagonal-se");
}
this.handles[handle] = ".ui-resizable-"+handle;
this.element.append(axis);
}
}
this._renderAxis = function(target) {
var i, axis, padPos, padWrapper;
target = target || this.element;
for(i in this.handles) {
if(this.handles[i].constructor === String) {
this.handles[i] = $(this.handles[i], this.element).show();
}
if (this.elementIsWrapper && this.originalElement[0].nodeName.match(/textarea|input|select|button/i)) {
axis = $(this.handles[i], this.element);
padWrapper = /sw|ne|nw|se|n|s/.test(i) ? axis.outerHeight() : axis.outerWidth();
padPos = [ "padding",
/ne|nw|n/.test(i) ? "Top" :
/se|sw|s/.test(i) ? "Bottom" :
/^e$/.test(i) ? "Right" : "Left" ].join("");
target.css(padPos, padWrapper);
this._proportionallyResize();
}
if(!$(this.handles[i]).length) {
continue;
}
}
};
this._renderAxis(this.element);
this._handles = $(".ui-resizable-handle", this.element)
.disableSelection();
this._handles.mouseover(function() {
if (!that.resizing) {
if (this.className) {
axis = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i);
}
that.axis = axis && axis[1] ? axis[1] : "se";
}
});
if (o.autoHide) {
this._handles.hide();
$(this.element)
.addClass("ui-resizable-autohide")
.mouseenter(function() {
if (o.disabled) {
return;
}
$(this).removeClass("ui-resizable-autohide");
that._handles.show();
})
.mouseleave(function(){
if (o.disabled) {
return;
}
if (!that.resizing) {
$(this).addClass("ui-resizable-autohide");
that._handles.hide();
}
});
}
this._mouseInit();
},
_destroy: function() {
this._mouseDestroy();
var wrapper,
_destroy = function(exp) {
$(exp).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing")
.removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove();
};
if (this.elementIsWrapper) {
_destroy(this.element);
wrapper = this.element;
this.originalElement.css({
position: wrapper.css("position"),
width: wrapper.outerWidth(),
height: wrapper.outerHeight(),
top: wrapper.css("top"),
left: wrapper.css("left")
}).insertAfter( wrapper );
wrapper.remove();
}
this.originalElement.css("resize", this.originalResizeStyle);
_destroy(this.originalElement);
return this;
},
_mouseCapture: function(event) {
var i, handle,
capture = false;
for (i in this.handles) {
handle = $(this.handles[i])[0];
if (handle === event.target || $.contains(handle, event.target)) {
capture = true;
}
}
return !this.options.disabled && capture;
},
_mouseStart: function(event) {
var curleft, curtop, cursor,
o = this.options,
iniPos = this.element.position(),
el = this.element;
this.resizing = true;
if ( (/absolute/).test( el.css("position") ) ) {
el.css({ position: "absolute", top: el.css("top"), left: el.css("left") });
} else if (el.is(".ui-draggable")) {
el.css({ position: "absolute", top: iniPos.top, left: iniPos.left });
}
this._renderProxy();
curleft = num(this.helper.css("left"));
curtop = num(this.helper.css("top"));
if (o.containment) {
curleft += $(o.containment).scrollLeft() || 0;
curtop += $(o.containment).scrollTop() || 0;
}
this.offset = this.helper.offset();
this.position = { left: curleft, top: curtop };
this.size = this._helper ? { width: el.outerWidth(), height: el.outerHeight() } : { width: el.width(), height: el.height() };
this.originalSize = this._helper ? { width: el.outerWidth(), height: el.outerHeight() } : { width: el.width(), height: el.height() };
this.originalPosition = { left: curleft, top: curtop };
this.sizeDiff = { width: el.outerWidth() - el.width(), height: el.outerHeight() - el.height() };
this.originalMousePosition = { left: event.pageX, top: event.pageY };
this.aspectRatio = (typeof o.aspectRatio === "number") ? o.aspectRatio : ((this.originalSize.width / this.originalSize.height) || 1);
cursor = $(".ui-resizable-" + this.axis).css("cursor");
$("body").css("cursor", cursor === "auto" ? this.axis + "-resize" : cursor);
el.addClass("ui-resizable-resizing");
this._propagate("start", event);
return true;
},
_mouseDrag: function(event) {
var data,
el = this.helper, props = {},
smp = this.originalMousePosition,
a = this.axis,
prevTop = this.position.top,
prevLeft = this.position.left,
prevWidth = this.size.width,
prevHeight = this.size.height,
dx = (event.pageX-smp.left)||0,
dy = (event.pageY-smp.top)||0,
trigger = this._change[a];
if (!trigger) {
return false;
}
data = trigger.apply(this, [event, dx, dy]);
this._updateVirtualBoundaries(event.shiftKey);
if (this._aspectRatio || event.shiftKey) {
data = this._updateRatio(data, event);
}
data = this._respectSize(data, event);
this._updateCache(data);
this._propagate("resize", event);
if (this.position.top !== prevTop) {
props.top = this.position.top + "px";
}
if (this.position.left !== prevLeft) {
props.left = this.position.left + "px";
}
if (this.size.width !== prevWidth) {
props.width = this.size.width + "px";
}
if (this.size.height !== prevHeight) {
props.height = this.size.height + "px";
}
el.css(props);
if (!this._helper && this._proportionallyResizeElements.length) {
this._proportionallyResize();
}
if ( ! $.isEmptyObject(props) ) {
this._trigger("resize", event, this.ui());
}
return false;
},
_mouseStop: function(event) {
this.resizing = false;
var pr, ista, soffseth, soffsetw, s, left, top,
o = this.options, that = this;
if(this._helper) {
pr = this._proportionallyResizeElements;
ista = pr.length && (/textarea/i).test(pr[0].nodeName);
soffseth = ista && $.ui.hasScroll(pr[0], "left")  ? 0 : that.sizeDiff.height;
soffsetw = ista ? 0 : that.sizeDiff.width;
s = { width: (that.helper.width()  - soffsetw), height: (that.helper.height() - soffseth) };
left = (parseInt(that.element.css("left"), 10) + (that.position.left - that.originalPosition.left)) || null;
top = (parseInt(that.element.css("top"), 10) + (that.position.top - that.originalPosition.top)) || null;
if (!o.animate) {
this.element.css($.extend(s, { top: top, left: left }));
}
that.helper.height(that.size.height);
that.helper.width(that.size.width);
if (this._helper && !o.animate) {
this._proportionallyResize();
}
}
$("body").css("cursor", "auto");
this.element.removeClass("ui-resizable-resizing");
this._propagate("stop", event);
if (this._helper) {
this.helper.remove();
}
return false;
},
_updateVirtualBoundaries: function(forceAspectRatio) {
var pMinWidth, pMaxWidth, pMinHeight, pMaxHeight, b,
o = this.options;
b = {
minWidth: isNumber(o.minWidth) ? o.minWidth : 0,
maxWidth: isNumber(o.maxWidth) ? o.maxWidth : Infinity,
minHeight: isNumber(o.minHeight) ? o.minHeight : 0,
maxHeight: isNumber(o.maxHeight) ? o.maxHeight : Infinity
};
if(this._aspectRatio || forceAspectRatio) {
pMinWidth = b.minHeight * this.aspectRatio;
pMinHeight = b.minWidth / this.aspectRatio;
pMaxWidth = b.maxHeight * this.aspectRatio;
pMaxHeight = b.maxWidth / this.aspectRatio;
if(pMinWidth > b.minWidth) {
b.minWidth = pMinWidth;
}
if(pMinHeight > b.minHeight) {
b.minHeight = pMinHeight;
}
if(pMaxWidth < b.maxWidth) {
b.maxWidth = pMaxWidth;
}
if(pMaxHeight < b.maxHeight) {
b.maxHeight = pMaxHeight;
}
}
this._vBoundaries = b;
},
_updateCache: function(data) {
this.offset = this.helper.offset();
if (isNumber(data.left)) {
this.position.left = data.left;
}
if (isNumber(data.top)) {
this.position.top = data.top;
}
if (isNumber(data.height)) {
this.size.height = data.height;
}
if (isNumber(data.width)) {
this.size.width = data.width;
}
},
_updateRatio: function( data ) {
var cpos = this.position,
csize = this.size,
a = this.axis;
if (isNumber(data.height)) {
data.width = (data.height * this.aspectRatio);
} else if (isNumber(data.width)) {
data.height = (data.width / this.aspectRatio);
}
if (a === "sw") {
data.left = cpos.left + (csize.width - data.width);
data.top = null;
}
if (a === "nw") {
data.top = cpos.top + (csize.height - data.height);
data.left = cpos.left + (csize.width - data.width);
}
return data;
},
_respectSize: function( data ) {
var o = this._vBoundaries,
a = this.axis,
ismaxw = isNumber(data.width) && o.maxWidth && (o.maxWidth < data.width), ismaxh = isNumber(data.height) && o.maxHeight && (o.maxHeight < data.height),
isminw = isNumber(data.width) && o.minWidth && (o.minWidth > data.width), isminh = isNumber(data.height) && o.minHeight && (o.minHeight > data.height),
dw = this.originalPosition.left + this.originalSize.width,
dh = this.position.top + this.size.height,
cw = /sw|nw|w/.test(a), ch = /nw|ne|n/.test(a);
if (isminw) {
data.width = o.minWidth;
}
if (isminh) {
data.height = o.minHeight;
}
if (ismaxw) {
data.width = o.maxWidth;
}
if (ismaxh) {
data.height = o.maxHeight;
}
if (isminw && cw) {
data.left = dw - o.minWidth;
}
if (ismaxw && cw) {
data.left = dw - o.maxWidth;
}
if (isminh && ch) {
data.top = dh - o.minHeight;
}
if (ismaxh && ch) {
data.top = dh - o.maxHeight;
}
if (!data.width && !data.height && !data.left && data.top) {
data.top = null;
} else if (!data.width && !data.height && !data.top && data.left) {
data.left = null;
}
return data;
},
_proportionallyResize: function() {
if (!this._proportionallyResizeElements.length) {
return;
}
var i, j, borders, paddings, prel,
element = this.helper || this.element;
for ( i=0; i < this._proportionallyResizeElements.length; i++) {
prel = this._proportionallyResizeElements[i];
if (!this.borderDif) {
this.borderDif = [];
borders = [prel.css("borderTopWidth"), prel.css("borderRightWidth"), prel.css("borderBottomWidth"), prel.css("borderLeftWidth")];
paddings = [prel.css("paddingTop"), prel.css("paddingRight"), prel.css("paddingBottom"), prel.css("paddingLeft")];
for ( j = 0; j < borders.length; j++ ) {
this.borderDif[ j ] = ( parseInt( borders[ j ], 10 ) || 0 ) + ( parseInt( paddings[ j ], 10 ) || 0 );
}
}
prel.css({
height: (element.height() - this.borderDif[0] - this.borderDif[2]) || 0,
width: (element.width() - this.borderDif[1] - this.borderDif[3]) || 0
});
}
},
_renderProxy: function() {
var el = this.element, o = this.options;
this.elementOffset = el.offset();
if(this._helper) {
this.helper = this.helper || $("<div style='overflow:hidden;'></div>");
this.helper.addClass(this._helper).css({
width: this.element.outerWidth() - 1,
height: this.element.outerHeight() - 1,
position: "absolute",
left: this.elementOffset.left +"px",
top: this.elementOffset.top +"px",
zIndex: ++o.zIndex
});
this.helper
.appendTo("body")
.disableSelection();
} else {
this.helper = this.element;
}
},
_change: {
e: function(event, dx) {
return { width: this.originalSize.width + dx };
},
w: function(event, dx) {
var cs = this.originalSize, sp = this.originalPosition;
return { left: sp.left + dx, width: cs.width - dx };
},
n: function(event, dx, dy) {
var cs = this.originalSize, sp = this.originalPosition;
return { top: sp.top + dy, height: cs.height - dy };
},
s: function(event, dx, dy) {
return { height: this.originalSize.height + dy };
},
se: function(event, dx, dy) {
return $.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [event, dx, dy]));
},
sw: function(event, dx, dy) {
return $.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [event, dx, dy]));
},
ne: function(event, dx, dy) {
return $.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [event, dx, dy]));
},
nw: function(event, dx, dy) {
return $.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [event, dx, dy]));
}
},
_propagate: function(n, event) {
$.ui.plugin.call(this, n, [event, this.ui()]);
(n !== "resize" && this._trigger(n, event, this.ui()));
},
plugins: {},
ui: function() {
return {
originalElement: this.originalElement,
element: this.element,
helper: this.helper,
position: this.position,
size: this.size,
originalSize: this.originalSize,
originalPosition: this.originalPosition
};
}
});
$.ui.plugin.add("resizable", "animate", {
stop: function( event ) {
var that = $(this).data("ui-resizable"),
o = that.options,
pr = that._proportionallyResizeElements,
ista = pr.length && (/textarea/i).test(pr[0].nodeName),
soffseth = ista && $.ui.hasScroll(pr[0], "left")  ? 0 : that.sizeDiff.height,
soffsetw = ista ? 0 : that.sizeDiff.width,
style = { width: (that.size.width - soffsetw), height: (that.size.height - soffseth) },
left = (parseInt(that.element.css("left"), 10) + (that.position.left - that.originalPosition.left)) || null,
top = (parseInt(that.element.css("top"), 10) + (that.position.top - that.originalPosition.top)) || null;
that.element.animate(
$.extend(style, top && left ? { top: top, left: left } : {}), {
duration: o.animateDuration,
easing: o.animateEasing,
step: function() {
var data = {
width: parseInt(that.element.css("width"), 10),
height: parseInt(that.element.css("height"), 10),
top: parseInt(that.element.css("top"), 10),
left: parseInt(that.element.css("left"), 10)
};
if (pr && pr.length) {
$(pr[0]).css({ width: data.width, height: data.height });
}
that._updateCache(data);
that._propagate("resize", event);
}
}
);
}
});
$.ui.plugin.add("resizable", "containment", {
start: function() {
var element, p, co, ch, cw, width, height,
that = $(this).data("ui-resizable"),
o = that.options,
el = that.element,
oc = o.containment,
ce = (oc instanceof $) ? oc.get(0) : (/parent/.test(oc)) ? el.parent().get(0) : oc;
if (!ce) {
return;
}
that.containerElement = $(ce);
if (/document/.test(oc) || oc === document) {
that.containerOffset = { left: 0, top: 0 };
that.containerPosition = { left: 0, top: 0 };
that.parentData = {
element: $(document), left: 0, top: 0,
width: $(document).width(), height: $(document).height() || document.body.parentNode.scrollHeight
};
}
else {
element = $(ce);
p = [];
$([ "Top", "Right", "Left", "Bottom" ]).each(function(i, name) { p[i] = num(element.css("padding" + name)); });
that.containerOffset = element.offset();
that.containerPosition = element.position();
that.containerSize = { height: (element.innerHeight() - p[3]), width: (element.innerWidth() - p[1]) };
co = that.containerOffset;
ch = that.containerSize.height;
cw = that.containerSize.width;
width = ($.ui.hasScroll(ce, "left") ? ce.scrollWidth : cw );
height = ($.ui.hasScroll(ce) ? ce.scrollHeight : ch);
that.parentData = {
element: ce, left: co.left, top: co.top, width: width, height: height
};
}
},
resize: function( event ) {
var woset, hoset, isParent, isOffsetRelative,
that = $(this).data("ui-resizable"),
o = that.options,
co = that.containerOffset, cp = that.position,
pRatio = that._aspectRatio || event.shiftKey,
cop = { top:0, left:0 }, ce = that.containerElement;
if (ce[0] !== document && (/static/).test(ce.css("position"))) {
cop = co;
}
if (cp.left < (that._helper ? co.left : 0)) {
that.size.width = that.size.width + (that._helper ? (that.position.left - co.left) : (that.position.left - cop.left));
if (pRatio) {
that.size.height = that.size.width / that.aspectRatio;
}
that.position.left = o.helper ? co.left : 0;
}
if (cp.top < (that._helper ? co.top : 0)) {
that.size.height = that.size.height + (that._helper ? (that.position.top - co.top) : that.position.top);
if (pRatio) {
that.size.width = that.size.height * that.aspectRatio;
}
that.position.top = that._helper ? co.top : 0;
}
that.offset.left = that.parentData.left+that.position.left;
that.offset.top = that.parentData.top+that.position.top;
woset = Math.abs( (that._helper ? that.offset.left - cop.left : (that.offset.left - cop.left)) + that.sizeDiff.width );
hoset = Math.abs( (that._helper ? that.offset.top - cop.top : (that.offset.top - co.top)) + that.sizeDiff.height );
isParent = that.containerElement.get(0) === that.element.parent().get(0);
isOffsetRelative = /relative|absolute/.test(that.containerElement.css("position"));
if(isParent && isOffsetRelative) {
woset -= that.parentData.left;
}
if (woset + that.size.width >= that.parentData.width) {
that.size.width = that.parentData.width - woset;
if (pRatio) {
that.size.height = that.size.width / that.aspectRatio;
}
}
if (hoset + that.size.height >= that.parentData.height) {
that.size.height = that.parentData.height - hoset;
if (pRatio) {
that.size.width = that.size.height * that.aspectRatio;
}
}
},
stop: function(){
var that = $(this).data("ui-resizable"),
o = that.options,
co = that.containerOffset,
cop = that.containerPosition,
ce = that.containerElement,
helper = $(that.helper),
ho = helper.offset(),
w = helper.outerWidth() - that.sizeDiff.width,
h = helper.outerHeight() - that.sizeDiff.height;
if (that._helper && !o.animate && (/relative/).test(ce.css("position"))) {
$(this).css({ left: ho.left - cop.left - co.left, width: w, height: h });
}
if (that._helper && !o.animate && (/static/).test(ce.css("position"))) {
$(this).css({ left: ho.left - cop.left - co.left, width: w, height: h });
}
}
});
$.ui.plugin.add("resizable", "alsoResize", {
start: function () {
var that = $(this).data("ui-resizable"),
o = that.options,
_store = function (exp) {
$(exp).each(function() {
var el = $(this);
el.data("ui-resizable-alsoresize", {
width: parseInt(el.width(), 10), height: parseInt(el.height(), 10),
left: parseInt(el.css("left"), 10), top: parseInt(el.css("top"), 10)
});
});
};
if (typeof(o.alsoResize) === "object" && !o.alsoResize.parentNode) {
if (o.alsoResize.length) { o.alsoResize = o.alsoResize[0]; _store(o.alsoResize); }
else { $.each(o.alsoResize, function (exp) { _store(exp); }); }
}else{
_store(o.alsoResize);
}
},
resize: function (event, ui) {
var that = $(this).data("ui-resizable"),
o = that.options,
os = that.originalSize,
op = that.originalPosition,
delta = {
height: (that.size.height - os.height) || 0, width: (that.size.width - os.width) || 0,
top: (that.position.top - op.top) || 0, left: (that.position.left - op.left) || 0
},
_alsoResize = function (exp, c) {
$(exp).each(function() {
var el = $(this), start = $(this).data("ui-resizable-alsoresize"), style = {},
css = c && c.length ? c : el.parents(ui.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];
$.each(css, function (i, prop) {
var sum = (start[prop]||0) + (delta[prop]||0);
if (sum && sum >= 0) {
style[prop] = sum || null;
}
});
el.css(style);
});
};
if (typeof(o.alsoResize) === "object" && !o.alsoResize.nodeType) {
$.each(o.alsoResize, function (exp, c) { _alsoResize(exp, c); });
}else{
_alsoResize(o.alsoResize);
}
},
stop: function () {
$(this).removeData("resizable-alsoresize");
}
});
$.ui.plugin.add("resizable", "ghost", {
start: function() {
var that = $(this).data("ui-resizable"), o = that.options, cs = that.size;
that.ghost = that.originalElement.clone();
that.ghost
.css({ opacity: 0.25, display: "block", position: "relative", height: cs.height, width: cs.width, margin: 0, left: 0, top: 0 })
.addClass("ui-resizable-ghost")
.addClass(typeof o.ghost === "string" ? o.ghost : "");
that.ghost.appendTo(that.helper);
},
resize: function(){
var that = $(this).data("ui-resizable");
if (that.ghost) {
that.ghost.css({ position: "relative", height: that.size.height, width: that.size.width });
}
},
stop: function() {
var that = $(this).data("ui-resizable");
if (that.ghost && that.helper) {
that.helper.get(0).removeChild(that.ghost.get(0));
}
}
});
$.ui.plugin.add("resizable", "grid", {
resize: function() {
var that = $(this).data("ui-resizable"),
o = that.options,
cs = that.size,
os = that.originalSize,
op = that.originalPosition,
a = that.axis,
grid = typeof o.grid === "number" ? [o.grid, o.grid] : o.grid,
gridX = (grid[0]||1),
gridY = (grid[1]||1),
ox = Math.round((cs.width - os.width) / gridX) * gridX,
oy = Math.round((cs.height - os.height) / gridY) * gridY,
newWidth = os.width + ox,
newHeight = os.height + oy,
isMaxWidth = o.maxWidth && (o.maxWidth < newWidth),
isMaxHeight = o.maxHeight && (o.maxHeight < newHeight),
isMinWidth = o.minWidth && (o.minWidth > newWidth),
isMinHeight = o.minHeight && (o.minHeight > newHeight);
o.grid = grid;
if (isMinWidth) {
newWidth = newWidth + gridX;
}
if (isMinHeight) {
newHeight = newHeight + gridY;
}
if (isMaxWidth) {
newWidth = newWidth - gridX;
}
if (isMaxHeight) {
newHeight = newHeight - gridY;
}
if (/^(se|s|e)$/.test(a)) {
that.size.width = newWidth;
that.size.height = newHeight;
} else if (/^(ne)$/.test(a)) {
that.size.width = newWidth;
that.size.height = newHeight;
that.position.top = op.top - oy;
} else if (/^(sw)$/.test(a)) {
that.size.width = newWidth;
that.size.height = newHeight;
that.position.left = op.left - ox;
} else {
that.size.width = newWidth;
that.size.height = newHeight;
that.position.top = op.top - oy;
that.position.left = op.left - ox;
}
}
});
})(jQuery);
(function( $, undefined ) {
$.widget("ui.selectable", $.ui.mouse, {
version: "1.10.3",
options: {
appendTo: "body",
autoRefresh: true,
distance: 0,
filter: "*",
tolerance: "touch",
selected: null,
selecting: null,
start: null,
stop: null,
unselected: null,
unselecting: null
},
_create: function() {
var selectees,
that = this;
this.element.addClass("ui-selectable");
this.dragged = false;
this.refresh = function() {
selectees = $(that.options.filter, that.element[0]);
selectees.addClass("ui-selectee");
selectees.each(function() {
var $this = $(this),
pos = $this.offset();
$.data(this, "selectable-item", {
element: this,
$element: $this,
left: pos.left,
top: pos.top,
right: pos.left + $this.outerWidth(),
bottom: pos.top + $this.outerHeight(),
startselected: false,
selected: $this.hasClass("ui-selected"),
selecting: $this.hasClass("ui-selecting"),
unselecting: $this.hasClass("ui-unselecting")
});
});
};
this.refresh();
this.selectees = selectees.addClass("ui-selectee");
this._mouseInit();
this.helper = $("<div class='ui-selectable-helper'></div>");
},
_destroy: function() {
this.selectees
.removeClass("ui-selectee")
.removeData("selectable-item");
this.element
.removeClass("ui-selectable ui-selectable-disabled");
this._mouseDestroy();
},
_mouseStart: function(event) {
var that = this,
options = this.options;
this.opos = [event.pageX, event.pageY];
if (this.options.disabled) {
return;
}
this.selectees = $(options.filter, this.element[0]);
this._trigger("start", event);
$(options.appendTo).append(this.helper);
this.helper.css({
"left": event.pageX,
"top": event.pageY,
"width": 0,
"height": 0
});
if (options.autoRefresh) {
this.refresh();
}
this.selectees.filter(".ui-selected").each(function() {
var selectee = $.data(this, "selectable-item");
selectee.startselected = true;
if (!event.metaKey && !event.ctrlKey) {
selectee.$element.removeClass("ui-selected");
selectee.selected = false;
selectee.$element.addClass("ui-unselecting");
selectee.unselecting = true;
that._trigger("unselecting", event, {
unselecting: selectee.element
});
}
});
$(event.target).parents().addBack().each(function() {
var doSelect,
selectee = $.data(this, "selectable-item");
if (selectee) {
doSelect = (!event.metaKey && !event.ctrlKey) || !selectee.$element.hasClass("ui-selected");
selectee.$element
.removeClass(doSelect ? "ui-unselecting" : "ui-selected")
.addClass(doSelect ? "ui-selecting" : "ui-unselecting");
selectee.unselecting = !doSelect;
selectee.selecting = doSelect;
selectee.selected = doSelect;
if (doSelect) {
that._trigger("selecting", event, {
selecting: selectee.element
});
} else {
that._trigger("unselecting", event, {
unselecting: selectee.element
});
}
return false;
}
});
},
_mouseDrag: function(event) {
this.dragged = true;
if (this.options.disabled) {
return;
}
var tmp,
that = this,
options = this.options,
x1 = this.opos[0],
y1 = this.opos[1],
x2 = event.pageX,
y2 = event.pageY;
if (x1 > x2) { tmp = x2; x2 = x1; x1 = tmp; }
if (y1 > y2) { tmp = y2; y2 = y1; y1 = tmp; }
this.helper.css({left: x1, top: y1, width: x2-x1, height: y2-y1});
this.selectees.each(function() {
var selectee = $.data(this, "selectable-item"),
hit = false;
if (!selectee || selectee.element === that.element[0]) {
return;
}
if (options.tolerance === "touch") {
hit = ( !(selectee.left > x2 || selectee.right < x1 || selectee.top > y2 || selectee.bottom < y1) );
} else if (options.tolerance === "fit") {
hit = (selectee.left > x1 && selectee.right < x2 && selectee.top > y1 && selectee.bottom < y2);
}
if (hit) {
if (selectee.selected) {
selectee.$element.removeClass("ui-selected");
selectee.selected = false;
}
if (selectee.unselecting) {
selectee.$element.removeClass("ui-unselecting");
selectee.unselecting = false;
}
if (!selectee.selecting) {
selectee.$element.addClass("ui-selecting");
selectee.selecting = true;
that._trigger("selecting", event, {
selecting: selectee.element
});
}
} else {
if (selectee.selecting) {
if ((event.metaKey || event.ctrlKey) && selectee.startselected) {
selectee.$element.removeClass("ui-selecting");
selectee.selecting = false;
selectee.$element.addClass("ui-selected");
selectee.selected = true;
} else {
selectee.$element.removeClass("ui-selecting");
selectee.selecting = false;
if (selectee.startselected) {
selectee.$element.addClass("ui-unselecting");
selectee.unselecting = true;
}
that._trigger("unselecting", event, {
unselecting: selectee.element
});
}
}
if (selectee.selected) {
if (!event.metaKey && !event.ctrlKey && !selectee.startselected) {
selectee.$element.removeClass("ui-selected");
selectee.selected = false;
selectee.$element.addClass("ui-unselecting");
selectee.unselecting = true;
that._trigger("unselecting", event, {
unselecting: selectee.element
});
}
}
}
});
return false;
},
_mouseStop: function(event) {
var that = this;
this.dragged = false;
$(".ui-unselecting", this.element[0]).each(function() {
var selectee = $.data(this, "selectable-item");
selectee.$element.removeClass("ui-unselecting");
selectee.unselecting = false;
selectee.startselected = false;
that._trigger("unselected", event, {
unselected: selectee.element
});
});
$(".ui-selecting", this.element[0]).each(function() {
var selectee = $.data(this, "selectable-item");
selectee.$element.removeClass("ui-selecting").addClass("ui-selected");
selectee.selecting = false;
selectee.selected = true;
selectee.startselected = true;
that._trigger("selected", event, {
selected: selectee.element
});
});
this._trigger("stop", event);
this.helper.remove();
return false;
}
});
})(jQuery);
(function( $, undefined ) {
function isOverAxis( x, reference, size ) {
return ( x > reference ) && ( x < ( reference + size ) );
}
function isFloating(item) {
return (/left|right/).test(item.css("float")) || (/inline|table-cell/).test(item.css("display"));
}
$.widget("ui.sortable", $.ui.mouse, {
version: "1.10.3",
widgetEventPrefix: "sort",
ready: false,
options: {
appendTo: "parent",
axis: false,
connectWith: false,
containment: false,
cursor: "auto",
cursorAt: false,
dropOnEmpty: true,
forcePlaceholderSize: false,
forceHelperSize: false,
grid: false,
handle: false,
helper: "original",
items: "> *",
opacity: false,
placeholder: false,
revert: false,
scroll: true,
scrollSensitivity: 20,
scrollSpeed: 20,
scope: "default",
tolerance: "intersect",
zIndex: 1000,
activate: null,
beforeStop: null,
change: null,
deactivate: null,
out: null,
over: null,
receive: null,
remove: null,
sort: null,
start: null,
stop: null,
update: null
},
_create: function() {
var o = this.options;
this.containerCache = {};
this.element.addClass("ui-sortable");
this.refresh();
this.floating = this.items.length ? o.axis === "x" || isFloating(this.items[0].item) : false;
this.offset = this.element.offset();
this._mouseInit();
this.ready = true;
},
_destroy: function() {
this.element
.removeClass("ui-sortable ui-sortable-disabled");
this._mouseDestroy();
for ( var i = this.items.length - 1; i >= 0; i-- ) {
this.items[i].item.removeData(this.widgetName + "-item");
}
return this;
},
_setOption: function(key, value){
if ( key === "disabled" ) {
this.options[ key ] = value;
this.widget().toggleClass( "ui-sortable-disabled", !!value );
} else {
$.Widget.prototype._setOption.apply(this, arguments);
}
},
_mouseCapture: function(event, overrideHandle) {
var currentItem = null,
validHandle = false,
that = this;
if (this.reverting) {
return false;
}
if(this.options.disabled || this.options.type === "static") {
return false;
}
this._refreshItems(event);
$(event.target).parents().each(function() {
if($.data(this, that.widgetName + "-item") === that) {
currentItem = $(this);
return false;
}
});
if($.data(event.target, that.widgetName + "-item") === that) {
currentItem = $(event.target);
}
if(!currentItem) {
return false;
}
if(this.options.handle && !overrideHandle) {
$(this.options.handle, currentItem).find("*").addBack().each(function() {
if(this === event.target) {
validHandle = true;
}
});
if(!validHandle) {
return false;
}
}
this.currentItem = currentItem;
this._removeCurrentsFromItems();
return true;
},
_mouseStart: function(event, overrideHandle, noActivation) {
var i, body,
o = this.options;
this.currentContainer = this;
this.refreshPositions();
this.helper = this._createHelper(event);
this._cacheHelperProportions();
this._cacheMargins();
this.scrollParent = this.helper.scrollParent();
this.offset = this.currentItem.offset();
this.offset = {
top: this.offset.top - this.margins.top,
left: this.offset.left - this.margins.left
};
$.extend(this.offset, {
click: {
left: event.pageX - this.offset.left,
top: event.pageY - this.offset.top
},
parent: this._getParentOffset(),
relative: this._getRelativeOffset()
});
this.helper.css("position", "absolute");
this.cssPosition = this.helper.css("position");
this.originalPosition = this._generatePosition(event);
this.originalPageX = event.pageX;
this.originalPageY = event.pageY;
(o.cursorAt && this._adjustOffsetFromHelper(o.cursorAt));
this.domPosition = { prev: this.currentItem.prev()[0], parent: this.currentItem.parent()[0] };
if(this.helper[0] !== this.currentItem[0]) {
this.currentItem.hide();
}
this._createPlaceholder();
if(o.containment) {
this._setContainment();
}
if( o.cursor && o.cursor !== "auto" ) {
body = this.document.find( "body" );
this.storedCursor = body.css( "cursor" );
body.css( "cursor", o.cursor );
this.storedStylesheet = $( "<style>*{ cursor: "+o.cursor+" !important; }</style>" ).appendTo( body );
}
if(o.opacity) {
if (this.helper.css("opacity")) {
this._storedOpacity = this.helper.css("opacity");
}
this.helper.css("opacity", o.opacity);
}
if(o.zIndex) {
if (this.helper.css("zIndex")) {
this._storedZIndex = this.helper.css("zIndex");
}
this.helper.css("zIndex", o.zIndex);
}
if(this.scrollParent[0] !== document && this.scrollParent[0].tagName !== "HTML") {
this.overflowOffset = this.scrollParent.offset();
}
this._trigger("start", event, this._uiHash());
if(!this._preserveHelperProportions) {
this._cacheHelperProportions();
}
if( !noActivation ) {
for ( i = this.containers.length - 1; i >= 0; i-- ) {
this.containers[ i ]._trigger( "activate", event, this._uiHash( this ) );
}
}
if($.ui.ddmanager) {
$.ui.ddmanager.current = this;
}
if ($.ui.ddmanager && !o.dropBehaviour) {
$.ui.ddmanager.prepareOffsets(this, event);
}
this.dragging = true;
this.helper.addClass("ui-sortable-helper");
this._mouseDrag(event);
return true;
},
_mouseDrag: function(event) {
var i, item, itemElement, intersection,
o = this.options,
scrolled = false;
this.position = this._generatePosition(event);
this.positionAbs = this._convertPositionTo("absolute");
if (!this.lastPositionAbs) {
this.lastPositionAbs = this.positionAbs;
}
if(this.options.scroll) {
if(this.scrollParent[0] !== document && this.scrollParent[0].tagName !== "HTML") {
if((this.overflowOffset.top + this.scrollParent[0].offsetHeight) - event.pageY < o.scrollSensitivity) {
this.scrollParent[0].scrollTop = scrolled = this.scrollParent[0].scrollTop + o.scrollSpeed;
} else if(event.pageY - this.overflowOffset.top < o.scrollSensitivity) {
this.scrollParent[0].scrollTop = scrolled = this.scrollParent[0].scrollTop - o.scrollSpeed;
}
if((this.overflowOffset.left + this.scrollParent[0].offsetWidth) - event.pageX < o.scrollSensitivity) {
this.scrollParent[0].scrollLeft = scrolled = this.scrollParent[0].scrollLeft + o.scrollSpeed;
} else if(event.pageX - this.overflowOffset.left < o.scrollSensitivity) {
this.scrollParent[0].scrollLeft = scrolled = this.scrollParent[0].scrollLeft - o.scrollSpeed;
}
} else {
if(event.pageY - $(document).scrollTop() < o.scrollSensitivity) {
scrolled = $(document).scrollTop($(document).scrollTop() - o.scrollSpeed);
} else if($(window).height() - (event.pageY - $(document).scrollTop()) < o.scrollSensitivity) {
scrolled = $(document).scrollTop($(document).scrollTop() + o.scrollSpeed);
}
if(event.pageX - $(document).scrollLeft() < o.scrollSensitivity) {
scrolled = $(document).scrollLeft($(document).scrollLeft() - o.scrollSpeed);
} else if($(window).width() - (event.pageX - $(document).scrollLeft()) < o.scrollSensitivity) {
scrolled = $(document).scrollLeft($(document).scrollLeft() + o.scrollSpeed);
}
}
if(scrolled !== false && $.ui.ddmanager && !o.dropBehaviour) {
$.ui.ddmanager.prepareOffsets(this, event);
}
}
this.positionAbs = this._convertPositionTo("absolute");
if(!this.options.axis || this.options.axis !== "y") {
this.helper[0].style.left = this.position.left+"px";
}
if(!this.options.axis || this.options.axis !== "x") {
this.helper[0].style.top = this.position.top+"px";
}
for (i = this.items.length - 1; i >= 0; i--) {
item = this.items[i];
itemElement = item.item[0];
intersection = this._intersectsWithPointer(item);
if (!intersection) {
continue;
}
if (item.instance !== this.currentContainer) {
continue;
}
if (itemElement !== this.currentItem[0] &&
this.placeholder[intersection === 1 ? "next" : "prev"]()[0] !== itemElement &&
!$.contains(this.placeholder[0], itemElement) &&
(this.options.type === "semi-dynamic" ? !$.contains(this.element[0], itemElement) : true)
) {
this.direction = intersection === 1 ? "down" : "up";
if (this.options.tolerance === "pointer" || this._intersectsWithSides(item)) {
this._rearrange(event, item);
} else {
break;
}
this._trigger("change", event, this._uiHash());
break;
}
}
this._contactContainers(event);
if($.ui.ddmanager) {
$.ui.ddmanager.drag(this, event);
}
this._trigger("sort", event, this._uiHash());
this.lastPositionAbs = this.positionAbs;
return false;
},
_mouseStop: function(event, noPropagation) {
if(!event) {
return;
}
if ($.ui.ddmanager && !this.options.dropBehaviour) {
$.ui.ddmanager.drop(this, event);
}
if(this.options.revert) {
var that = this,
cur = this.placeholder.offset(),
axis = this.options.axis,
animation = {};
if ( !axis || axis === "x" ) {
animation.left = cur.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollLeft);
}
if ( !axis || axis === "y" ) {
animation.top = cur.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollTop);
}
this.reverting = true;
$(this.helper).animate( animation, parseInt(this.options.revert, 10) || 500, function() {
that._clear(event);
});
} else {
this._clear(event, noPropagation);
}
return false;
},
cancel: function() {
if(this.dragging) {
this._mouseUp({ target: null });
if(this.options.helper === "original") {
this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper");
} else {
this.currentItem.show();
}
for (var i = this.containers.length - 1; i >= 0; i--){
this.containers[i]._trigger("deactivate", null, this._uiHash(this));
if(this.containers[i].containerCache.over) {
this.containers[i]._trigger("out", null, this._uiHash(this));
this.containers[i].containerCache.over = 0;
}
}
}
if (this.placeholder) {
if(this.placeholder[0].parentNode) {
this.placeholder[0].parentNode.removeChild(this.placeholder[0]);
}
if(this.options.helper !== "original" && this.helper && this.helper[0].parentNode) {
this.helper.remove();
}
$.extend(this, {
helper: null,
dragging: false,
reverting: false,
_noFinalSort: null
});
if(this.domPosition.prev) {
$(this.domPosition.prev).after(this.currentItem);
} else {
$(this.domPosition.parent).prepend(this.currentItem);
}
}
return this;
},
serialize: function(o) {
var items = this._getItemsAsjQuery(o && o.connected),
str = [];
o = o || {};
$(items).each(function() {
var res = ($(o.item || this).attr(o.attribute || "id") || "").match(o.expression || (/(.+)[\-=_](.+)/));
if (res) {
str.push((o.key || res[1]+"[]")+"="+(o.key && o.expression ? res[1] : res[2]));
}
});
if(!str.length && o.key) {
str.push(o.key + "=");
}
return str.join("&");
},
toArray: function(o) {
var items = this._getItemsAsjQuery(o && o.connected),
ret = [];
o = o || {};
items.each(function() { ret.push($(o.item || this).attr(o.attribute || "id") || ""); });
return ret;
},
_intersectsWith: function(item) {
var x1 = this.positionAbs.left,
x2 = x1 + this.helperProportions.width,
y1 = this.positionAbs.top,
y2 = y1 + this.helperProportions.height,
l = item.left,
r = l + item.width,
t = item.top,
b = t + item.height,
dyClick = this.offset.click.top,
dxClick = this.offset.click.left,
isOverElementHeight = ( this.options.axis === "x" ) || ( ( y1 + dyClick ) > t && ( y1 + dyClick ) < b ),
isOverElementWidth = ( this.options.axis === "y" ) || ( ( x1 + dxClick ) > l && ( x1 + dxClick ) < r ),
isOverElement = isOverElementHeight && isOverElementWidth;
if ( this.options.tolerance === "pointer" ||
this.options.forcePointerForContainers ||
(this.options.tolerance !== "pointer" && this.helperProportions[this.floating ? "width" : "height"] > item[this.floating ? "width" : "height"])
) {
return isOverElement;
} else {
return (l < x1 + (this.helperProportions.width / 2) &&
x2 - (this.helperProportions.width / 2) < r &&
t < y1 + (this.helperProportions.height / 2) &&
y2 - (this.helperProportions.height / 2) < b );
}
},
_intersectsWithPointer: function(item) {
var isOverElementHeight = (this.options.axis === "x") || isOverAxis(this.positionAbs.top + this.offset.click.top, item.top, item.height),
isOverElementWidth = (this.options.axis === "y") || isOverAxis(this.positionAbs.left + this.offset.click.left, item.left, item.width),
isOverElement = isOverElementHeight && isOverElementWidth,
verticalDirection = this._getDragVerticalDirection(),
horizontalDirection = this._getDragHorizontalDirection();
if (!isOverElement) {
return false;
}
return this.floating ?
( ((horizontalDirection && horizontalDirection === "right") || verticalDirection === "down") ? 2 : 1 )
: ( verticalDirection && (verticalDirection === "down" ? 2 : 1) );
},
_intersectsWithSides: function(item) {
var isOverBottomHalf = isOverAxis(this.positionAbs.top + this.offset.click.top, item.top + (item.height/2), item.height),
isOverRightHalf = isOverAxis(this.positionAbs.left + this.offset.click.left, item.left + (item.width/2), item.width),
verticalDirection = this._getDragVerticalDirection(),
horizontalDirection = this._getDragHorizontalDirection();
if (this.floating && horizontalDirection) {
return ((horizontalDirection === "right" && isOverRightHalf) || (horizontalDirection === "left" && !isOverRightHalf));
} else {
return verticalDirection && ((verticalDirection === "down" && isOverBottomHalf) || (verticalDirection === "up" && !isOverBottomHalf));
}
},
_getDragVerticalDirection: function() {
var delta = this.positionAbs.top - this.lastPositionAbs.top;
return delta !== 0 && (delta > 0 ? "down" : "up");
},
_getDragHorizontalDirection: function() {
var delta = this.positionAbs.left - this.lastPositionAbs.left;
return delta !== 0 && (delta > 0 ? "right" : "left");
},
refresh: function(event) {
this._refreshItems(event);
this.refreshPositions();
return this;
},
_connectWith: function() {
var options = this.options;
return options.connectWith.constructor === String ? [options.connectWith] : options.connectWith;
},
_getItemsAsjQuery: function(connected) {
var i, j, cur, inst,
items = [],
queries = [],
connectWith = this._connectWith();
if(connectWith && connected) {
for (i = connectWith.length - 1; i >= 0; i--){
cur = $(connectWith[i]);
for ( j = cur.length - 1; j >= 0; j--){
inst = $.data(cur[j], this.widgetFullName);
if(inst && inst !== this && !inst.options.disabled) {
queries.push([$.isFunction(inst.options.items) ? inst.options.items.call(inst.element) : $(inst.options.items, inst.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), inst]);
}
}
}
}
queries.push([$.isFunction(this.options.items) ? this.options.items.call(this.element, null, { options: this.options, item: this.currentItem }) : $(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]);
for (i = queries.length - 1; i >= 0; i--){
queries[i][0].each(function() {
items.push(this);
});
}
return $(items);
},
_removeCurrentsFromItems: function() {
var list = this.currentItem.find(":data(" + this.widgetName + "-item)");
this.items = $.grep(this.items, function (item) {
for (var j=0; j < list.length; j++) {
if(list[j] === item.item[0]) {
return false;
}
}
return true;
});
},
_refreshItems: function(event) {
this.items = [];
this.containers = [this];
var i, j, cur, inst, targetData, _queries, item, queriesLength,
items = this.items,
queries = [[$.isFunction(this.options.items) ? this.options.items.call(this.element[0], event, { item: this.currentItem }) : $(this.options.items, this.element), this]],
connectWith = this._connectWith();
if(connectWith && this.ready) {
for (i = connectWith.length - 1; i >= 0; i--){
cur = $(connectWith[i]);
for (j = cur.length - 1; j >= 0; j--){
inst = $.data(cur[j], this.widgetFullName);
if(inst && inst !== this && !inst.options.disabled) {
queries.push([$.isFunction(inst.options.items) ? inst.options.items.call(inst.element[0], event, { item: this.currentItem }) : $(inst.options.items, inst.element), inst]);
this.containers.push(inst);
}
}
}
}
for (i = queries.length - 1; i >= 0; i--) {
targetData = queries[i][1];
_queries = queries[i][0];
for (j=0, queriesLength = _queries.length; j < queriesLength; j++) {
item = $(_queries[j]);
item.data(this.widgetName + "-item", targetData);
items.push({
item: item,
instance: targetData,
width: 0, height: 0,
left: 0, top: 0
});
}
}
},
refreshPositions: function(fast) {
if(this.offsetParent && this.helper) {
this.offset.parent = this._getParentOffset();
}
var i, item, t, p;
for (i = this.items.length - 1; i >= 0; i--){
item = this.items[i];
if(item.instance !== this.currentContainer && this.currentContainer && item.item[0] !== this.currentItem[0]) {
continue;
}
t = this.options.toleranceElement ? $(this.options.toleranceElement, item.item) : item.item;
if (!fast) {
item.width = t.outerWidth();
item.height = t.outerHeight();
}
p = t.offset();
item.left = p.left;
item.top = p.top;
}
if(this.options.custom && this.options.custom.refreshContainers) {
this.options.custom.refreshContainers.call(this);
} else {
for (i = this.containers.length - 1; i >= 0; i--){
p = this.containers[i].element.offset();
this.containers[i].containerCache.left = p.left;
this.containers[i].containerCache.top = p.top;
this.containers[i].containerCache.width	= this.containers[i].element.outerWidth();
this.containers[i].containerCache.height = this.containers[i].element.outerHeight();
}
}
return this;
},
_createPlaceholder: function(that) {
that = that || this;
var className,
o = that.options;
if(!o.placeholder || o.placeholder.constructor === String) {
className = o.placeholder;
o.placeholder = {
element: function() {
var nodeName = that.currentItem[0].nodeName.toLowerCase(),
element = $( "<" + nodeName + ">", that.document[0] )
.addClass(className || that.currentItem[0].className+" ui-sortable-placeholder")
.removeClass("ui-sortable-helper");
if ( nodeName === "tr" ) {
that.currentItem.children().each(function() {
$( "<td>&#160;</td>", that.document[0] )
.attr( "colspan", $( this ).attr( "colspan" ) || 1 )
.appendTo( element );
});
} else if ( nodeName === "img" ) {
element.attr( "src", that.currentItem.attr( "src" ) );
}
if ( !className ) {
element.css( "visibility", "hidden" );
}
return element;
},
update: function(container, p) {
if(className && !o.forcePlaceholderSize) {
return;
}
if(!p.height()) { p.height(that.currentItem.innerHeight() - parseInt(that.currentItem.css("paddingTop")||0, 10) - parseInt(that.currentItem.css("paddingBottom")||0, 10)); }
if(!p.width()) { p.width(that.currentItem.innerWidth() - parseInt(that.currentItem.css("paddingLeft")||0, 10) - parseInt(that.currentItem.css("paddingRight")||0, 10)); }
}
};
}
that.placeholder = $(o.placeholder.element.call(that.element, that.currentItem));
that.currentItem.after(that.placeholder);
o.placeholder.update(that, that.placeholder);
},
_contactContainers: function(event) {
var i, j, dist, itemWithLeastDistance, posProperty, sizeProperty, base, cur, nearBottom, floating,
innermostContainer = null,
innermostIndex = null;
for (i = this.containers.length - 1; i >= 0; i--) {
if($.contains(this.currentItem[0], this.containers[i].element[0])) {
continue;
}
if(this._intersectsWith(this.containers[i].containerCache)) {
if(innermostContainer && $.contains(this.containers[i].element[0], innermostContainer.element[0])) {
continue;
}
innermostContainer = this.containers[i];
innermostIndex = i;
} else {
if(this.containers[i].containerCache.over) {
this.containers[i]._trigger("out", event, this._uiHash(this));
this.containers[i].containerCache.over = 0;
}
}
}
if(!innermostContainer) {
return;
}
if(this.containers.length === 1) {
if (!this.containers[innermostIndex].containerCache.over) {
this.containers[innermostIndex]._trigger("over", event, this._uiHash(this));
this.containers[innermostIndex].containerCache.over = 1;
}
} else {
dist = 10000;
itemWithLeastDistance = null;
floating = innermostContainer.floating || isFloating(this.currentItem);
posProperty = floating ? "left" : "top";
sizeProperty = floating ? "width" : "height";
base = this.positionAbs[posProperty] + this.offset.click[posProperty];
for (j = this.items.length - 1; j >= 0; j--) {
if(!$.contains(this.containers[innermostIndex].element[0], this.items[j].item[0])) {
continue;
}
if(this.items[j].item[0] === this.currentItem[0]) {
continue;
}
if (floating && !isOverAxis(this.positionAbs.top + this.offset.click.top, this.items[j].top, this.items[j].height)) {
continue;
}
cur = this.items[j].item.offset()[posProperty];
nearBottom = false;
if(Math.abs(cur - base) > Math.abs(cur + this.items[j][sizeProperty] - base)){
nearBottom = true;
cur += this.items[j][sizeProperty];
}
if(Math.abs(cur - base) < dist) {
dist = Math.abs(cur - base); itemWithLeastDistance = this.items[j];
this.direction = nearBottom ? "up": "down";
}
}
if(!itemWithLeastDistance && !this.options.dropOnEmpty) {
return;
}
if(this.currentContainer === this.containers[innermostIndex]) {
return;
}
itemWithLeastDistance ? this._rearrange(event, itemWithLeastDistance, null, true) : this._rearrange(event, null, this.containers[innermostIndex].element, true);
this._trigger("change", event, this._uiHash());
this.containers[innermostIndex]._trigger("change", event, this._uiHash(this));
this.currentContainer = this.containers[innermostIndex];
this.options.placeholder.update(this.currentContainer, this.placeholder);
this.containers[innermostIndex]._trigger("over", event, this._uiHash(this));
this.containers[innermostIndex].containerCache.over = 1;
}
},
_createHelper: function(event) {
var o = this.options,
helper = $.isFunction(o.helper) ? $(o.helper.apply(this.element[0], [event, this.currentItem])) : (o.helper === "clone" ? this.currentItem.clone() : this.currentItem);
if(!helper.parents("body").length) {
$(o.appendTo !== "parent" ? o.appendTo : this.currentItem[0].parentNode)[0].appendChild(helper[0]);
}
if(helper[0] === this.currentItem[0]) {
this._storedCSS = { width: this.currentItem[0].style.width, height: this.currentItem[0].style.height, position: this.currentItem.css("position"), top: this.currentItem.css("top"), left: this.currentItem.css("left") };
}
if(!helper[0].style.width || o.forceHelperSize) {
helper.width(this.currentItem.width());
}
if(!helper[0].style.height || o.forceHelperSize) {
helper.height(this.currentItem.height());
}
return helper;
},
_adjustOffsetFromHelper: function(obj) {
if (typeof obj === "string") {
obj = obj.split(" ");
}
if ($.isArray(obj)) {
obj = {left: +obj[0], top: +obj[1] || 0};
}
if ("left" in obj) {
this.offset.click.left = obj.left + this.margins.left;
}
if ("right" in obj) {
this.offset.click.left = this.helperProportions.width - obj.right + this.margins.left;
}
if ("top" in obj) {
this.offset.click.top = obj.top + this.margins.top;
}
if ("bottom" in obj) {
this.offset.click.top = this.helperProportions.height - obj.bottom + this.margins.top;
}
},
_getParentOffset: function() {
this.offsetParent = this.helper.offsetParent();
var po = this.offsetParent.offset();
if(this.cssPosition === "absolute" && this.scrollParent[0] !== document && $.contains(this.scrollParent[0], this.offsetParent[0])) {
po.left += this.scrollParent.scrollLeft();
po.top += this.scrollParent.scrollTop();
}
if( this.offsetParent[0] === document.body || (this.offsetParent[0].tagName && this.offsetParent[0].tagName.toLowerCase() === "html" && $.ui.ie)) {
po = { top: 0, left: 0 };
}
return {
top: po.top + (parseInt(this.offsetParent.css("borderTopWidth"),10) || 0),
left: po.left + (parseInt(this.offsetParent.css("borderLeftWidth"),10) || 0)
};
},
_getRelativeOffset: function() {
if(this.cssPosition === "relative") {
var p = this.currentItem.position();
return {
top: p.top - (parseInt(this.helper.css("top"),10) || 0) + this.scrollParent.scrollTop(),
left: p.left - (parseInt(this.helper.css("left"),10) || 0) + this.scrollParent.scrollLeft()
};
} else {
return { top: 0, left: 0 };
}
},
_cacheMargins: function() {
this.margins = {
left: (parseInt(this.currentItem.css("marginLeft"),10) || 0),
top: (parseInt(this.currentItem.css("marginTop"),10) || 0)
};
},
_cacheHelperProportions: function() {
this.helperProportions = {
width: this.helper.outerWidth(),
height: this.helper.outerHeight()
};
},
_setContainment: function() {
var ce, co, over,
o = this.options;
if(o.containment === "parent") {
o.containment = this.helper[0].parentNode;
}
if(o.containment === "document" || o.containment === "window") {
this.containment = [
0 - this.offset.relative.left - this.offset.parent.left,
0 - this.offset.relative.top - this.offset.parent.top,
$(o.containment === "document" ? document : window).width() - this.helperProportions.width - this.margins.left,
($(o.containment === "document" ? document : window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top
];
}
if(!(/^(document|window|parent)$/).test(o.containment)) {
ce = $(o.containment)[0];
co = $(o.containment).offset();
over = ($(ce).css("overflow") !== "hidden");
this.containment = [
co.left + (parseInt($(ce).css("borderLeftWidth"),10) || 0) + (parseInt($(ce).css("paddingLeft"),10) || 0) - this.margins.left,
co.top + (parseInt($(ce).css("borderTopWidth"),10) || 0) + (parseInt($(ce).css("paddingTop"),10) || 0) - this.margins.top,
co.left+(over ? Math.max(ce.scrollWidth,ce.offsetWidth) : ce.offsetWidth) - (parseInt($(ce).css("borderLeftWidth"),10) || 0) - (parseInt($(ce).css("paddingRight"),10) || 0) - this.helperProportions.width - this.margins.left,
co.top+(over ? Math.max(ce.scrollHeight,ce.offsetHeight) : ce.offsetHeight) - (parseInt($(ce).css("borderTopWidth"),10) || 0) - (parseInt($(ce).css("paddingBottom"),10) || 0) - this.helperProportions.height - this.margins.top
];
}
},
_convertPositionTo: function(d, pos) {
if(!pos) {
pos = this.position;
}
var mod = d === "absolute" ? 1 : -1,
scroll = this.cssPosition === "absolute" && !(this.scrollParent[0] !== document && $.contains(this.scrollParent[0], this.offsetParent[0])) ? this.offsetParent : this.scrollParent,
scrollIsRootNode = (/(html|body)/i).test(scroll[0].tagName);
return {
top: (
pos.top	+
this.offset.relative.top * mod +
this.offset.parent.top * mod -
( ( this.cssPosition === "fixed" ? -this.scrollParent.scrollTop() : ( scrollIsRootNode ? 0 : scroll.scrollTop() ) ) * mod)
),
left: (
pos.left +
this.offset.relative.left * mod +
this.offset.parent.left * mod	-
( ( this.cssPosition === "fixed" ? -this.scrollParent.scrollLeft() : scrollIsRootNode ? 0 : scroll.scrollLeft() ) * mod)
)
};
},
_generatePosition: function(event) {
var top, left,
o = this.options,
pageX = event.pageX,
pageY = event.pageY,
scroll = this.cssPosition === "absolute" && !(this.scrollParent[0] !== document && $.contains(this.scrollParent[0], this.offsetParent[0])) ? this.offsetParent : this.scrollParent, scrollIsRootNode = (/(html|body)/i).test(scroll[0].tagName);
if(this.cssPosition === "relative" && !(this.scrollParent[0] !== document && this.scrollParent[0] !== this.offsetParent[0])) {
this.offset.relative = this._getRelativeOffset();
}
if(this.originalPosition) {
if(this.containment) {
if(event.pageX - this.offset.click.left < this.containment[0]) {
pageX = this.containment[0] + this.offset.click.left;
}
if(event.pageY - this.offset.click.top < this.containment[1]) {
pageY = this.containment[1] + this.offset.click.top;
}
if(event.pageX - this.offset.click.left > this.containment[2]) {
pageX = this.containment[2] + this.offset.click.left;
}
if(event.pageY - this.offset.click.top > this.containment[3]) {
pageY = this.containment[3] + this.offset.click.top;
}
}
if(o.grid) {
top = this.originalPageY + Math.round((pageY - this.originalPageY) / o.grid[1]) * o.grid[1];
pageY = this.containment ? ( (top - this.offset.click.top >= this.containment[1] && top - this.offset.click.top <= this.containment[3]) ? top : ((top - this.offset.click.top >= this.containment[1]) ? top - o.grid[1] : top + o.grid[1])) : top;
left = this.originalPageX + Math.round((pageX - this.originalPageX) / o.grid[0]) * o.grid[0];
pageX = this.containment ? ( (left - this.offset.click.left >= this.containment[0] && left - this.offset.click.left <= this.containment[2]) ? left : ((left - this.offset.click.left >= this.containment[0]) ? left - o.grid[0] : left + o.grid[0])) : left;
}
}
return {
top: (
pageY -
this.offset.click.top -
this.offset.relative.top	-
this.offset.parent.top +
( ( this.cssPosition === "fixed" ? -this.scrollParent.scrollTop() : ( scrollIsRootNode ? 0 : scroll.scrollTop() ) ))
),
left: (
pageX -
this.offset.click.left -
this.offset.relative.left	-
this.offset.parent.left +
( ( this.cssPosition === "fixed" ? -this.scrollParent.scrollLeft() : scrollIsRootNode ? 0 : scroll.scrollLeft() ))
)
};
},
_rearrange: function(event, i, a, hardRefresh) {
a ? a[0].appendChild(this.placeholder[0]) : i.item[0].parentNode.insertBefore(this.placeholder[0], (this.direction === "down" ? i.item[0] : i.item[0].nextSibling));
this.counter = this.counter ? ++this.counter : 1;
var counter = this.counter;
this._delay(function() {
if(counter === this.counter) {
this.refreshPositions(!hardRefresh);
}
});
},
_clear: function(event, noPropagation) {
this.reverting = false;
var i,
delayedTriggers = [];
if(!this._noFinalSort && this.currentItem.parent().length) {
this.placeholder.before(this.currentItem);
}
this._noFinalSort = null;
if(this.helper[0] === this.currentItem[0]) {
for(i in this._storedCSS) {
if(this._storedCSS[i] === "auto" || this._storedCSS[i] === "static") {
this._storedCSS[i] = "";
}
}
this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper");
} else {
this.currentItem.show();
}
if(this.fromOutside && !noPropagation) {
delayedTriggers.push(function(event) { this._trigger("receive", event, this._uiHash(this.fromOutside)); });
}
if((this.fromOutside || this.domPosition.prev !== this.currentItem.prev().not(".ui-sortable-helper")[0] || this.domPosition.parent !== this.currentItem.parent()[0]) && !noPropagation) {
delayedTriggers.push(function(event) { this._trigger("update", event, this._uiHash()); });
}
if (this !== this.currentContainer) {
if(!noPropagation) {
delayedTriggers.push(function(event) { this._trigger("remove", event, this._uiHash()); });
delayedTriggers.push((function(c) { return function(event) { c._trigger("receive", event, this._uiHash(this)); };  }).call(this, this.currentContainer));
delayedTriggers.push((function(c) { return function(event) { c._trigger("update", event, this._uiHash(this));  }; }).call(this, this.currentContainer));
}
}
for (i = this.containers.length - 1; i >= 0; i--){
if(!noPropagation) {
delayedTriggers.push((function(c) { return function(event) { c._trigger("deactivate", event, this._uiHash(this)); };  }).call(this, this.containers[i]));
}
if(this.containers[i].containerCache.over) {
delayedTriggers.push((function(c) { return function(event) { c._trigger("out", event, this._uiHash(this)); };  }).call(this, this.containers[i]));
this.containers[i].containerCache.over = 0;
}
}
if ( this.storedCursor ) {
this.document.find( "body" ).css( "cursor", this.storedCursor );
this.storedStylesheet.remove();
}
if(this._storedOpacity) {
this.helper.css("opacity", this._storedOpacity);
}
if(this._storedZIndex) {
this.helper.css("zIndex", this._storedZIndex === "auto" ? "" : this._storedZIndex);
}
this.dragging = false;
if(this.cancelHelperRemoval) {
if(!noPropagation) {
this._trigger("beforeStop", event, this._uiHash());
for (i=0; i < delayedTriggers.length; i++) {
delayedTriggers[i].call(this, event);
}
this._trigger("stop", event, this._uiHash());
}
this.fromOutside = false;
return false;
}
if(!noPropagation) {
this._trigger("beforeStop", event, this._uiHash());
}
this.placeholder[0].parentNode.removeChild(this.placeholder[0]);
if(this.helper[0] !== this.currentItem[0]) {
this.helper.remove();
}
this.helper = null;
if(!noPropagation) {
for (i=0; i < delayedTriggers.length; i++) {
delayedTriggers[i].call(this, event);
}
this._trigger("stop", event, this._uiHash());
}
this.fromOutside = false;
return true;
},
_trigger: function() {
if ($.Widget.prototype._trigger.apply(this, arguments) === false) {
this.cancel();
}
},
_uiHash: function(_inst) {
var inst = _inst || this;
return {
helper: inst.helper,
placeholder: inst.placeholder || $([]),
position: inst.position,
originalPosition: inst.originalPosition,
offset: inst.positionAbs,
item: inst.currentItem,
sender: _inst ? _inst.element : null
};
}
});
})(jQuery);
(function($, undefined) {
var dataSpace = "ui-effects-";
$.effects = {
effect: {}
};
(function( jQuery, undefined ) {
var stepHooks = "backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",
rplusequals = /^([\-+])=\s*(\d+\.?\d*)/,
stringParsers = [{
re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
parse: function( execResult ) {
return [
execResult[ 1 ],
execResult[ 2 ],
execResult[ 3 ],
execResult[ 4 ]
];
}
}, {
re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
parse: function( execResult ) {
return [
execResult[ 1 ] * 2.55,
execResult[ 2 ] * 2.55,
execResult[ 3 ] * 2.55,
execResult[ 4 ]
];
}
}, {
re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,
parse: function( execResult ) {
return [
parseInt( execResult[ 1 ], 16 ),
parseInt( execResult[ 2 ], 16 ),
parseInt( execResult[ 3 ], 16 )
];
}
}, {
re: /#([a-f0-9])([a-f0-9])([a-f0-9])/,
parse: function( execResult ) {
return [
parseInt( execResult[ 1 ] + execResult[ 1 ], 16 ),
parseInt( execResult[ 2 ] + execResult[ 2 ], 16 ),
parseInt( execResult[ 3 ] + execResult[ 3 ], 16 )
];
}
}, {
re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
space: "hsla",
parse: function( execResult ) {
return [
execResult[ 1 ],
execResult[ 2 ] / 100,
execResult[ 3 ] / 100,
execResult[ 4 ]
];
}
}],
color = jQuery.Color = function( color, green, blue, alpha ) {
return new jQuery.Color.fn.parse( color, green, blue, alpha );
},
spaces = {
rgba: {
props: {
red: {
idx: 0,
type: "byte"
},
green: {
idx: 1,
type: "byte"
},
blue: {
idx: 2,
type: "byte"
}
}
},
hsla: {
props: {
hue: {
idx: 0,
type: "degrees"
},
saturation: {
idx: 1,
type: "percent"
},
lightness: {
idx: 2,
type: "percent"
}
}
}
},
propTypes = {
"byte": {
floor: true,
max: 255
},
"percent": {
max: 1
},
"degrees": {
mod: 360,
floor: true
}
},
support = color.support = {},
supportElem = jQuery( "<p>" )[ 0 ],
colors,
each = jQuery.each;
supportElem.style.cssText = "background-color:rgba(1,1,1,.5)";
support.rgba = supportElem.style.backgroundColor.indexOf( "rgba" ) > -1;
each( spaces, function( spaceName, space ) {
space.cache = "_" + spaceName;
space.props.alpha = {
idx: 3,
type: "percent",
def: 1
};
});
function clamp( value, prop, allowEmpty ) {
var type = propTypes[ prop.type ] || {};
if ( value == null ) {
return (allowEmpty || !prop.def) ? null : prop.def;
}
value = type.floor ? ~~value : parseFloat( value );
if ( isNaN( value ) ) {
return prop.def;
}
if ( type.mod ) {
return (value + type.mod) % type.mod;
}
return 0 > value ? 0 : type.max < value ? type.max : value;
}
function stringParse( string ) {
var inst = color(),
rgba = inst._rgba = [];
string = string.toLowerCase();
each( stringParsers, function( i, parser ) {
var parsed,
match = parser.re.exec( string ),
values = match && parser.parse( match ),
spaceName = parser.space || "rgba";
if ( values ) {
parsed = inst[ spaceName ]( values );
inst[ spaces[ spaceName ].cache ] = parsed[ spaces[ spaceName ].cache ];
rgba = inst._rgba = parsed._rgba;
return false;
}
});
if ( rgba.length ) {
if ( rgba.join() === "0,0,0,0" ) {
jQuery.extend( rgba, colors.transparent );
}
return inst;
}
return colors[ string ];
}
color.fn = jQuery.extend( color.prototype, {
parse: function( red, green, blue, alpha ) {
if ( red === undefined ) {
this._rgba = [ null, null, null, null ];
return this;
}
if ( red.jquery || red.nodeType ) {
red = jQuery( red ).css( green );
green = undefined;
}
var inst = this,
type = jQuery.type( red ),
rgba = this._rgba = [];
if ( green !== undefined ) {
red = [ red, green, blue, alpha ];
type = "array";
}
if ( type === "string" ) {
return this.parse( stringParse( red ) || colors._default );
}
if ( type === "array" ) {
each( spaces.rgba.props, function( key, prop ) {
rgba[ prop.idx ] = clamp( red[ prop.idx ], prop );
});
return this;
}
if ( type === "object" ) {
if ( red instanceof color ) {
each( spaces, function( spaceName, space ) {
if ( red[ space.cache ] ) {
inst[ space.cache ] = red[ space.cache ].slice();
}
});
} else {
each( spaces, function( spaceName, space ) {
var cache = space.cache;
each( space.props, function( key, prop ) {
if ( !inst[ cache ] && space.to ) {
if ( key === "alpha" || red[ key ] == null ) {
return;
}
inst[ cache ] = space.to( inst._rgba );
}
inst[ cache ][ prop.idx ] = clamp( red[ key ], prop, true );
});
if ( inst[ cache ] && jQuery.inArray( null, inst[ cache ].slice( 0, 3 ) ) < 0 ) {
inst[ cache ][ 3 ] = 1;
if ( space.from ) {
inst._rgba = space.from( inst[ cache ] );
}
}
});
}
return this;
}
},
is: function( compare ) {
var is = color( compare ),
same = true,
inst = this;
each( spaces, function( _, space ) {
var localCache,
isCache = is[ space.cache ];
if (isCache) {
localCache = inst[ space.cache ] || space.to && space.to( inst._rgba ) || [];
each( space.props, function( _, prop ) {
if ( isCache[ prop.idx ] != null ) {
same = ( isCache[ prop.idx ] === localCache[ prop.idx ] );
return same;
}
});
}
return same;
});
return same;
},
_space: function() {
var used = [],
inst = this;
each( spaces, function( spaceName, space ) {
if ( inst[ space.cache ] ) {
used.push( spaceName );
}
});
return used.pop();
},
transition: function( other, distance ) {
var end = color( other ),
spaceName = end._space(),
space = spaces[ spaceName ],
startColor = this.alpha() === 0 ? color( "transparent" ) : this,
start = startColor[ space.cache ] || space.to( startColor._rgba ),
result = start.slice();
end = end[ space.cache ];
each( space.props, function( key, prop ) {
var index = prop.idx,
startValue = start[ index ],
endValue = end[ index ],
type = propTypes[ prop.type ] || {};
if ( endValue === null ) {
return;
}
if ( startValue === null ) {
result[ index ] = endValue;
} else {
if ( type.mod ) {
if ( endValue - startValue > type.mod / 2 ) {
startValue += type.mod;
} else if ( startValue - endValue > type.mod / 2 ) {
startValue -= type.mod;
}
}
result[ index ] = clamp( ( endValue - startValue ) * distance + startValue, prop );
}
});
return this[ spaceName ]( result );
},
blend: function( opaque ) {
if ( this._rgba[ 3 ] === 1 ) {
return this;
}
var rgb = this._rgba.slice(),
a = rgb.pop(),
blend = color( opaque )._rgba;
return color( jQuery.map( rgb, function( v, i ) {
return ( 1 - a ) * blend[ i ] + a * v;
}));
},
toRgbaString: function() {
var prefix = "rgba(",
rgba = jQuery.map( this._rgba, function( v, i ) {
return v == null ? ( i > 2 ? 1 : 0 ) : v;
});
if ( rgba[ 3 ] === 1 ) {
rgba.pop();
prefix = "rgb(";
}
return prefix + rgba.join() + ")";
},
toHslaString: function() {
var prefix = "hsla(",
hsla = jQuery.map( this.hsla(), function( v, i ) {
if ( v == null ) {
v = i > 2 ? 1 : 0;
}
if ( i && i < 3 ) {
v = Math.round( v * 100 ) + "%";
}
return v;
});
if ( hsla[ 3 ] === 1 ) {
hsla.pop();
prefix = "hsl(";
}
return prefix + hsla.join() + ")";
},
toHexString: function( includeAlpha ) {
var rgba = this._rgba.slice(),
alpha = rgba.pop();
if ( includeAlpha ) {
rgba.push( ~~( alpha * 255 ) );
}
return "#" + jQuery.map( rgba, function( v ) {
v = ( v || 0 ).toString( 16 );
return v.length === 1 ? "0" + v : v;
}).join("");
},
toString: function() {
return this._rgba[ 3 ] === 0 ? "transparent" : this.toRgbaString();
}
});
color.fn.parse.prototype = color.fn;
function hue2rgb( p, q, h ) {
h = ( h + 1 ) % 1;
if ( h * 6 < 1 ) {
return p + (q - p) * h * 6;
}
if ( h * 2 < 1) {
return q;
}
if ( h * 3 < 2 ) {
return p + (q - p) * ((2/3) - h) * 6;
}
return p;
}
spaces.hsla.to = function ( rgba ) {
if ( rgba[ 0 ] == null || rgba[ 1 ] == null || rgba[ 2 ] == null ) {
return [ null, null, null, rgba[ 3 ] ];
}
var r = rgba[ 0 ] / 255,
g = rgba[ 1 ] / 255,
b = rgba[ 2 ] / 255,
a = rgba[ 3 ],
max = Math.max( r, g, b ),
min = Math.min( r, g, b ),
diff = max - min,
add = max + min,
l = add * 0.5,
h, s;
if ( min === max ) {
h = 0;
} else if ( r === max ) {
h = ( 60 * ( g - b ) / diff ) + 360;
} else if ( g === max ) {
h = ( 60 * ( b - r ) / diff ) + 120;
} else {
h = ( 60 * ( r - g ) / diff ) + 240;
}
if ( diff === 0 ) {
s = 0;
} else if ( l <= 0.5 ) {
s = diff / add;
} else {
s = diff / ( 2 - add );
}
return [ Math.round(h) % 360, s, l, a == null ? 1 : a ];
};
spaces.hsla.from = function ( hsla ) {
if ( hsla[ 0 ] == null || hsla[ 1 ] == null || hsla[ 2 ] == null ) {
return [ null, null, null, hsla[ 3 ] ];
}
var h = hsla[ 0 ] / 360,
s = hsla[ 1 ],
l = hsla[ 2 ],
a = hsla[ 3 ],
q = l <= 0.5 ? l * ( 1 + s ) : l + s - l * s,
p = 2 * l - q;
return [
Math.round( hue2rgb( p, q, h + ( 1 / 3 ) ) * 255 ),
Math.round( hue2rgb( p, q, h ) * 255 ),
Math.round( hue2rgb( p, q, h - ( 1 / 3 ) ) * 255 ),
a
];
};
each( spaces, function( spaceName, space ) {
var props = space.props,
cache = space.cache,
to = space.to,
from = space.from;
color.fn[ spaceName ] = function( value ) {
if ( to && !this[ cache ] ) {
this[ cache ] = to( this._rgba );
}
if ( value === undefined ) {
return this[ cache ].slice();
}
var ret,
type = jQuery.type( value ),
arr = ( type === "array" || type === "object" ) ? value : arguments,
local = this[ cache ].slice();
each( props, function( key, prop ) {
var val = arr[ type === "object" ? key : prop.idx ];
if ( val == null ) {
val = local[ prop.idx ];
}
local[ prop.idx ] = clamp( val, prop );
});
if ( from ) {
ret = color( from( local ) );
ret[ cache ] = local;
return ret;
} else {
return color( local );
}
};
each( props, function( key, prop ) {
if ( color.fn[ key ] ) {
return;
}
color.fn[ key ] = function( value ) {
var vtype = jQuery.type( value ),
fn = ( key === "alpha" ? ( this._hsla ? "hsla" : "rgba" ) : spaceName ),
local = this[ fn ](),
cur = local[ prop.idx ],
match;
if ( vtype === "undefined" ) {
return cur;
}
if ( vtype === "function" ) {
value = value.call( this, cur );
vtype = jQuery.type( value );
}
if ( value == null && prop.empty ) {
return this;
}
if ( vtype === "string" ) {
match = rplusequals.exec( value );
if ( match ) {
value = cur + parseFloat( match[ 2 ] ) * ( match[ 1 ] === "+" ? 1 : -1 );
}
}
local[ prop.idx ] = value;
return this[ fn ]( local );
};
});
});
color.hook = function( hook ) {
var hooks = hook.split( " " );
each( hooks, function( i, hook ) {
jQuery.cssHooks[ hook ] = {
set: function( elem, value ) {
var parsed, curElem,
backgroundColor = "";
if ( value !== "transparent" && ( jQuery.type( value ) !== "string" || ( parsed = stringParse( value ) ) ) ) {
value = color( parsed || value );
if ( !support.rgba && value._rgba[ 3 ] !== 1 ) {
curElem = hook === "backgroundColor" ? elem.parentNode : elem;
while (
(backgroundColor === "" || backgroundColor === "transparent") &&
curElem && curElem.style
) {
try {
backgroundColor = jQuery.css( curElem, "backgroundColor" );
curElem = curElem.parentNode;
} catch ( e ) {
}
}
value = value.blend( backgroundColor && backgroundColor !== "transparent" ?
backgroundColor :
"_default" );
}
value = value.toRgbaString();
}
try {
elem.style[ hook ] = value;
} catch( e ) {
}
}
};
jQuery.fx.step[ hook ] = function( fx ) {
if ( !fx.colorInit ) {
fx.start = color( fx.elem, hook );
fx.end = color( fx.end );
fx.colorInit = true;
}
jQuery.cssHooks[ hook ].set( fx.elem, fx.start.transition( fx.end, fx.pos ) );
};
});
};
color.hook( stepHooks );
jQuery.cssHooks.borderColor = {
expand: function( value ) {
var expanded = {};
each( [ "Top", "Right", "Bottom", "Left" ], function( i, part ) {
expanded[ "border" + part + "Color" ] = value;
});
return expanded;
}
};
colors = jQuery.Color.names = {
aqua: "#00ffff",
black: "#000000",
blue: "#0000ff",
fuchsia: "#ff00ff",
gray: "#808080",
green: "#008000",
lime: "#00ff00",
maroon: "#800000",
navy: "#000080",
olive: "#808000",
purple: "#800080",
red: "#ff0000",
silver: "#c0c0c0",
teal: "#008080",
white: "#ffffff",
yellow: "#ffff00",
transparent: [ null, null, null, 0 ],
_default: "#ffffff"
};
})( jQuery );
(function() {
var classAnimationActions = [ "add", "remove", "toggle" ],
shorthandStyles = {
border: 1,
borderBottom: 1,
borderColor: 1,
borderLeft: 1,
borderRight: 1,
borderTop: 1,
borderWidth: 1,
margin: 1,
padding: 1
};
$.each([ "borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle" ], function( _, prop ) {
$.fx.step[ prop ] = function( fx ) {
if ( fx.end !== "none" && !fx.setAttr || fx.pos === 1 && !fx.setAttr ) {
jQuery.style( fx.elem, prop, fx.end );
fx.setAttr = true;
}
};
});
function getElementStyles( elem ) {
var key, len,
style = elem.ownerDocument.defaultView ?
elem.ownerDocument.defaultView.getComputedStyle( elem, null ) :
elem.currentStyle,
styles = {};
if ( style && style.length && style[ 0 ] && style[ style[ 0 ] ] ) {
len = style.length;
while ( len-- ) {
key = style[ len ];
if ( typeof style[ key ] === "string" ) {
styles[ $.camelCase( key ) ] = style[ key ];
}
}
} else {
for ( key in style ) {
if ( typeof style[ key ] === "string" ) {
styles[ key ] = style[ key ];
}
}
}
return styles;
}
function styleDifference( oldStyle, newStyle ) {
var diff = {},
name, value;
for ( name in newStyle ) {
value = newStyle[ name ];
if ( oldStyle[ name ] !== value ) {
if ( !shorthandStyles[ name ] ) {
if ( $.fx.step[ name ] || !isNaN( parseFloat( value ) ) ) {
diff[ name ] = value;
}
}
}
}
return diff;
}
if ( !$.fn.addBack ) {
$.fn.addBack = function( selector ) {
return this.add( selector == null ?
this.prevObject : this.prevObject.filter( selector )
);
};
}
$.effects.animateClass = function( value, duration, easing, callback ) {
var o = $.speed( duration, easing, callback );
return this.queue( function() {
var animated = $( this ),
baseClass = animated.attr( "class" ) || "",
applyClassChange,
allAnimations = o.children ? animated.find( "*" ).addBack() : animated;
allAnimations = allAnimations.map(function() {
var el = $( this );
return {
el: el,
start: getElementStyles( this )
};
});
applyClassChange = function() {
$.each( classAnimationActions, function(i, action) {
if ( value[ action ] ) {
animated[ action + "Class" ]( value[ action ] );
}
});
};
applyClassChange();
allAnimations = allAnimations.map(function() {
this.end = getElementStyles( this.el[ 0 ] );
this.diff = styleDifference( this.start, this.end );
return this;
});
animated.attr( "class", baseClass );
allAnimations = allAnimations.map(function() {
var styleInfo = this,
dfd = $.Deferred(),
opts = $.extend({}, o, {
queue: false,
complete: function() {
dfd.resolve( styleInfo );
}
});
this.el.animate( this.diff, opts );
return dfd.promise();
});
$.when.apply( $, allAnimations.get() ).done(function() {
applyClassChange();
$.each( arguments, function() {
var el = this.el;
$.each( this.diff, function(key) {
el.css( key, "" );
});
});
o.complete.call( animated[ 0 ] );
});
});
};
$.fn.extend({
addClass: (function( orig ) {
return function( classNames, speed, easing, callback ) {
return speed ?
$.effects.animateClass.call( this,
{ add: classNames }, speed, easing, callback ) :
orig.apply( this, arguments );
};
})( $.fn.addClass ),
removeClass: (function( orig ) {
return function( classNames, speed, easing, callback ) {
return arguments.length > 1 ?
$.effects.animateClass.call( this,
{ remove: classNames }, speed, easing, callback ) :
orig.apply( this, arguments );
};
})( $.fn.removeClass ),
toggleClass: (function( orig ) {
return function( classNames, force, speed, easing, callback ) {
if ( typeof force === "boolean" || force === undefined ) {
if ( !speed ) {
return orig.apply( this, arguments );
} else {
return $.effects.animateClass.call( this,
(force ? { add: classNames } : { remove: classNames }),
speed, easing, callback );
}
} else {
return $.effects.animateClass.call( this,
{ toggle: classNames }, force, speed, easing );
}
};
})( $.fn.toggleClass ),
switchClass: function( remove, add, speed, easing, callback) {
return $.effects.animateClass.call( this, {
add: add,
remove: remove
}, speed, easing, callback );
}
});
})();
(function() {
$.extend( $.effects, {
version: "1.10.3",
save: function( element, set ) {
for( var i=0; i < set.length; i++ ) {
if ( set[ i ] !== null ) {
element.data( dataSpace + set[ i ], element[ 0 ].style[ set[ i ] ] );
}
}
},
restore: function( element, set ) {
var val, i;
for( i=0; i < set.length; i++ ) {
if ( set[ i ] !== null ) {
val = element.data( dataSpace + set[ i ] );
if ( val === undefined ) {
val = "";
}
element.css( set[ i ], val );
}
}
},
setMode: function( el, mode ) {
if (mode === "toggle") {
mode = el.is( ":hidden" ) ? "show" : "hide";
}
return mode;
},
getBaseline: function( origin, original ) {
var y, x;
switch ( origin[ 0 ] ) {
case "top": y = 0; break;
case "middle": y = 0.5; break;
case "bottom": y = 1; break;
default: y = origin[ 0 ] / original.height;
}
switch ( origin[ 1 ] ) {
case "left": x = 0; break;
case "center": x = 0.5; break;
case "right": x = 1; break;
default: x = origin[ 1 ] / original.width;
}
return {
x: x,
y: y
};
},
createWrapper: function( element ) {
if ( element.parent().is( ".ui-effects-wrapper" )) {
return element.parent();
}
var props = {
width: element.outerWidth(true),
height: element.outerHeight(true),
"float": element.css( "float" )
},
wrapper = $( "<div></div>" )
.addClass( "ui-effects-wrapper" )
.css({
fontSize: "100%",
background: "transparent",
border: "none",
margin: 0,
padding: 0
}),
size = {
width: element.width(),
height: element.height()
},
active = document.activeElement;
try {
active.id;
} catch( e ) {
active = document.body;
}
element.wrap( wrapper );
if ( element[ 0 ] === active || $.contains( element[ 0 ], active ) ) {
$( active ).focus();
}
wrapper = element.parent();
if ( element.css( "position" ) === "static" ) {
wrapper.css({ position: "relative" });
element.css({ position: "relative" });
} else {
$.extend( props, {
position: element.css( "position" ),
zIndex: element.css( "z-index" )
});
$.each([ "top", "left", "bottom", "right" ], function(i, pos) {
props[ pos ] = element.css( pos );
if ( isNaN( parseInt( props[ pos ], 10 ) ) ) {
props[ pos ] = "auto";
}
});
element.css({
position: "relative",
top: 0,
left: 0,
right: "auto",
bottom: "auto"
});
}
element.css(size);
return wrapper.css( props ).show();
},
removeWrapper: function( element ) {
var active = document.activeElement;
if ( element.parent().is( ".ui-effects-wrapper" ) ) {
element.parent().replaceWith( element );
if ( element[ 0 ] === active || $.contains( element[ 0 ], active ) ) {
$( active ).focus();
}
}
return element;
},
setTransition: function( element, list, factor, value ) {
value = value || {};
$.each( list, function( i, x ) {
var unit = element.cssUnit( x );
if ( unit[ 0 ] > 0 ) {
value[ x ] = unit[ 0 ] * factor + unit[ 1 ];
}
});
return value;
}
});
function _normalizeArguments( effect, options, speed, callback ) {
if ( $.isPlainObject( effect ) ) {
options = effect;
effect = effect.effect;
}
effect = { effect: effect };
if ( options == null ) {
options = {};
}
if ( $.isFunction( options ) ) {
callback = options;
speed = null;
options = {};
}
if ( typeof options === "number" || $.fx.speeds[ options ] ) {
callback = speed;
speed = options;
options = {};
}
if ( $.isFunction( speed ) ) {
callback = speed;
speed = null;
}
if ( options ) {
$.extend( effect, options );
}
speed = speed || options.duration;
effect.duration = $.fx.off ? 0 :
typeof speed === "number" ? speed :
speed in $.fx.speeds ? $.fx.speeds[ speed ] :
$.fx.speeds._default;
effect.complete = callback || options.complete;
return effect;
}
function standardAnimationOption( option ) {
if ( !option || typeof option === "number" || $.fx.speeds[ option ] ) {
return true;
}
if ( typeof option === "string" && !$.effects.effect[ option ] ) {
return true;
}
if ( $.isFunction( option ) ) {
return true;
}
if ( typeof option === "object" && !option.effect ) {
return true;
}
return false;
}
$.fn.extend({
effect: function(  ) {
var args = _normalizeArguments.apply( this, arguments ),
mode = args.mode,
queue = args.queue,
effectMethod = $.effects.effect[ args.effect ];
if ( $.fx.off || !effectMethod ) {
if ( mode ) {
return this[ mode ]( args.duration, args.complete );
} else {
return this.each( function() {
if ( args.complete ) {
args.complete.call( this );
}
});
}
}
function run( next ) {
var elem = $( this ),
complete = args.complete,
mode = args.mode;
function done() {
if ( $.isFunction( complete ) ) {
complete.call( elem[0] );
}
if ( $.isFunction( next ) ) {
next();
}
}
if ( elem.is( ":hidden" ) ? mode === "hide" : mode === "show" ) {
elem[ mode ]();
done();
} else {
effectMethod.call( elem[0], args, done );
}
}
return queue === false ? this.each( run ) : this.queue( queue || "fx", run );
},
show: (function( orig ) {
return function( option ) {
if ( standardAnimationOption( option ) ) {
return orig.apply( this, arguments );
} else {
var args = _normalizeArguments.apply( this, arguments );
args.mode = "show";
return this.effect.call( this, args );
}
};
})( $.fn.show ),
hide: (function( orig ) {
return function( option ) {
if ( standardAnimationOption( option ) ) {
return orig.apply( this, arguments );
} else {
var args = _normalizeArguments.apply( this, arguments );
args.mode = "hide";
return this.effect.call( this, args );
}
};
})( $.fn.hide ),
toggle: (function( orig ) {
return function( option ) {
if ( standardAnimationOption( option ) || typeof option === "boolean" ) {
return orig.apply( this, arguments );
} else {
var args = _normalizeArguments.apply( this, arguments );
args.mode = "toggle";
return this.effect.call( this, args );
}
};
})( $.fn.toggle ),
cssUnit: function(key) {
var style = this.css( key ),
val = [];
$.each( [ "em", "px", "%", "pt" ], function( i, unit ) {
if ( style.indexOf( unit ) > 0 ) {
val = [ parseFloat( style ), unit ];
}
});
return val;
}
});
})();
(function() {
var baseEasings = {};
$.each( [ "Quad", "Cubic", "Quart", "Quint", "Expo" ], function( i, name ) {
baseEasings[ name ] = function( p ) {
return Math.pow( p, i + 2 );
};
});
$.extend( baseEasings, {
Sine: function ( p ) {
return 1 - Math.cos( p * Math.PI / 2 );
},
Circ: function ( p ) {
return 1 - Math.sqrt( 1 - p * p );
},
Elastic: function( p ) {
return p === 0 || p === 1 ? p :
-Math.pow( 2, 8 * (p - 1) ) * Math.sin( ( (p - 1) * 80 - 7.5 ) * Math.PI / 15 );
},
Back: function( p ) {
return p * p * ( 3 * p - 2 );
},
Bounce: function ( p ) {
var pow2,
bounce = 4;
while ( p < ( ( pow2 = Math.pow( 2, --bounce ) ) - 1 ) / 11 ) {}
return 1 / Math.pow( 4, 3 - bounce ) - 7.5625 * Math.pow( ( pow2 * 3 - 2 ) / 22 - p, 2 );
}
});
$.each( baseEasings, function( name, easeIn ) {
$.easing[ "easeIn" + name ] = easeIn;
$.easing[ "easeOut" + name ] = function( p ) {
return 1 - easeIn( 1 - p );
};
$.easing[ "easeInOut" + name ] = function( p ) {
return p < 0.5 ?
easeIn( p * 2 ) / 2 :
1 - easeIn( p * -2 + 2 ) / 2;
};
});
})();
})(jQuery);
(function( $, undefined ) {
var uid = 0,
hideProps = {},
showProps = {};
hideProps.height = hideProps.paddingTop = hideProps.paddingBottom =
hideProps.borderTopWidth = hideProps.borderBottomWidth = "hide";
showProps.height = showProps.paddingTop = showProps.paddingBottom =
showProps.borderTopWidth = showProps.borderBottomWidth = "show";
$.widget( "ui.accordion", {
version: "1.10.3",
options: {
active: 0,
animate: {},
collapsible: false,
event: "click",
header: "> li > :first-child,> :not(li):even",
heightStyle: "auto",
icons: {
activeHeader: "ui-icon-triangle-1-s",
header: "ui-icon-triangle-1-e"
},
activate: null,
beforeActivate: null
},
_create: function() {
var options = this.options;
this.prevShow = this.prevHide = $();
this.element.addClass( "ui-accordion ui-widget ui-helper-reset" )
.attr( "role", "tablist" );
if ( !options.collapsible && (options.active === false || options.active == null) ) {
options.active = 0;
}
this._processPanels();
if ( options.active < 0 ) {
options.active += this.headers.length;
}
this._refresh();
},
_getCreateEventData: function() {
return {
header: this.active,
panel: !this.active.length ? $() : this.active.next(),
content: !this.active.length ? $() : this.active.next()
};
},
_createIcons: function() {
var icons = this.options.icons;
if ( icons ) {
$( "<span>" )
.addClass( "ui-accordion-header-icon ui-icon " + icons.header )
.prependTo( this.headers );
this.active.children( ".ui-accordion-header-icon" )
.removeClass( icons.header )
.addClass( icons.activeHeader );
this.headers.addClass( "ui-accordion-icons" );
}
},
_destroyIcons: function() {
this.headers
.removeClass( "ui-accordion-icons" )
.children( ".ui-accordion-header-icon" )
.remove();
},
_destroy: function() {
var contents;
this.element
.removeClass( "ui-accordion ui-widget ui-helper-reset" )
.removeAttr( "role" );
this.headers
.removeClass( "ui-accordion-header ui-accordion-header-active ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top" )
.removeAttr( "role" )
.removeAttr( "aria-selected" )
.removeAttr( "aria-controls" )
.removeAttr( "tabIndex" )
.each(function() {
if ( /^ui-accordion/.test( this.id ) ) {
this.removeAttribute( "id" );
}
});
this._destroyIcons();
contents = this.headers.next()
.css( "display", "" )
.removeAttr( "role" )
.removeAttr( "aria-expanded" )
.removeAttr( "aria-hidden" )
.removeAttr( "aria-labelledby" )
.removeClass( "ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-state-disabled" )
.each(function() {
if ( /^ui-accordion/.test( this.id ) ) {
this.removeAttribute( "id" );
}
});
if ( this.options.heightStyle !== "content" ) {
contents.css( "height", "" );
}
},
_setOption: function( key, value ) {
if ( key === "active" ) {
this._activate( value );
return;
}
if ( key === "event" ) {
if ( this.options.event ) {
this._off( this.headers, this.options.event );
}
this._setupEvents( value );
}
this._super( key, value );
if ( key === "collapsible" && !value && this.options.active === false ) {
this._activate( 0 );
}
if ( key === "icons" ) {
this._destroyIcons();
if ( value ) {
this._createIcons();
}
}
if ( key === "disabled" ) {
this.headers.add( this.headers.next() )
.toggleClass( "ui-state-disabled", !!value );
}
},
_keydown: function( event ) {
if ( event.altKey || event.ctrlKey ) {
return;
}
var keyCode = $.ui.keyCode,
length = this.headers.length,
currentIndex = this.headers.index( event.target ),
toFocus = false;
switch ( event.keyCode ) {
case keyCode.RIGHT:
case keyCode.DOWN:
toFocus = this.headers[ ( currentIndex + 1 ) % length ];
break;
case keyCode.LEFT:
case keyCode.UP:
toFocus = this.headers[ ( currentIndex - 1 + length ) % length ];
break;
case keyCode.SPACE:
case keyCode.ENTER:
this._eventHandler( event );
break;
case keyCode.HOME:
toFocus = this.headers[ 0 ];
break;
case keyCode.END:
toFocus = this.headers[ length - 1 ];
break;
}
if ( toFocus ) {
$( event.target ).attr( "tabIndex", -1 );
$( toFocus ).attr( "tabIndex", 0 );
toFocus.focus();
event.preventDefault();
}
},
_panelKeyDown : function( event ) {
if ( event.keyCode === $.ui.keyCode.UP && event.ctrlKey ) {
$( event.currentTarget ).prev().focus();
}
},
refresh: function() {
var options = this.options;
this._processPanels();
if ( ( options.active === false && options.collapsible === true ) || !this.headers.length ) {
options.active = false;
this.active = $();
} else if ( options.active === false ) {
this._activate( 0 );
} else if ( this.active.length && !$.contains( this.element[ 0 ], this.active[ 0 ] ) ) {
if ( this.headers.length === this.headers.find(".ui-state-disabled").length ) {
options.active = false;
this.active = $();
} else {
this._activate( Math.max( 0, options.active - 1 ) );
}
} else {
options.active = this.headers.index( this.active );
}
this._destroyIcons();
this._refresh();
},
_processPanels: function() {
this.headers = this.element.find( this.options.header )
.addClass( "ui-accordion-header ui-helper-reset ui-state-default ui-corner-all" );
this.headers.next()
.addClass( "ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" )
.filter(":not(.ui-accordion-content-active)")
.hide();
},
_refresh: function() {
var maxHeight,
options = this.options,
heightStyle = options.heightStyle,
parent = this.element.parent(),
accordionId = this.accordionId = "ui-accordion-" +
(this.element.attr( "id" ) || ++uid);
this.active = this._findActive( options.active )
.addClass( "ui-accordion-header-active ui-state-active ui-corner-top" )
.removeClass( "ui-corner-all" );
this.active.next()
.addClass( "ui-accordion-content-active" )
.show();
this.headers
.attr( "role", "tab" )
.each(function( i ) {
var header = $( this ),
headerId = header.attr( "id" ),
panel = header.next(),
panelId = panel.attr( "id" );
if ( !headerId ) {
headerId = accordionId + "-header-" + i;
header.attr( "id", headerId );
}
if ( !panelId ) {
panelId = accordionId + "-panel-" + i;
panel.attr( "id", panelId );
}
header.attr( "aria-controls", panelId );
panel.attr( "aria-labelledby", headerId );
})
.next()
.attr( "role", "tabpanel" );
this.headers
.not( this.active )
.attr({
"aria-selected": "false",
tabIndex: -1
})
.next()
.attr({
"aria-expanded": "false",
"aria-hidden": "true"
})
.hide();
if ( !this.active.length ) {
this.headers.eq( 0 ).attr( "tabIndex", 0 );
} else {
this.active.attr({
"aria-selected": "true",
tabIndex: 0
})
.next()
.attr({
"aria-expanded": "true",
"aria-hidden": "false"
});
}
this._createIcons();
this._setupEvents( options.event );
if ( heightStyle === "fill" ) {
maxHeight = parent.height();
this.element.siblings( ":visible" ).each(function() {
var elem = $( this ),
position = elem.css( "position" );
if ( position === "absolute" || position === "fixed" ) {
return;
}
maxHeight -= elem.outerHeight( true );
});
this.headers.each(function() {
maxHeight -= $( this ).outerHeight( true );
});
this.headers.next()
.each(function() {
$( this ).height( Math.max( 0, maxHeight -
$( this ).innerHeight() + $( this ).height() ) );
})
.css( "overflow", "auto" );
} else if ( heightStyle === "auto" ) {
maxHeight = 0;
this.headers.next()
.each(function() {
maxHeight = Math.max( maxHeight, $( this ).css( "height", "" ).height() );
})
.height( maxHeight );
}
},
_activate: function( index ) {
var active = this._findActive( index )[ 0 ];
if ( active === this.active[ 0 ] ) {
return;
}
active = active || this.active[ 0 ];
this._eventHandler({
target: active,
currentTarget: active,
preventDefault: $.noop
});
},
_findActive: function( selector ) {
return typeof selector === "number" ? this.headers.eq( selector ) : $();
},
_setupEvents: function( event ) {
var events = {
keydown: "_keydown"
};
if ( event ) {
$.each( event.split(" "), function( index, eventName ) {
events[ eventName ] = "_eventHandler";
});
}
this._off( this.headers.add( this.headers.next() ) );
this._on( this.headers, events );
this._on( this.headers.next(), { keydown: "_panelKeyDown" });
this._hoverable( this.headers );
this._focusable( this.headers );
},
_eventHandler: function( event ) {
var options = this.options,
active = this.active,
clicked = $( event.currentTarget ),
clickedIsActive = clicked[ 0 ] === active[ 0 ],
collapsing = clickedIsActive && options.collapsible,
toShow = collapsing ? $() : clicked.next(),
toHide = active.next(),
eventData = {
oldHeader: active,
oldPanel: toHide,
newHeader: collapsing ? $() : clicked,
newPanel: toShow
};
event.preventDefault();
if (
( clickedIsActive && !options.collapsible ) ||
( this._trigger( "beforeActivate", event, eventData ) === false ) ) {
return;
}
options.active = collapsing ? false : this.headers.index( clicked );
this.active = clickedIsActive ? $() : clicked;
this._toggle( eventData );
active.removeClass( "ui-accordion-header-active ui-state-active" );
if ( options.icons ) {
active.children( ".ui-accordion-header-icon" )
.removeClass( options.icons.activeHeader )
.addClass( options.icons.header );
}
if ( !clickedIsActive ) {
clicked
.removeClass( "ui-corner-all" )
.addClass( "ui-accordion-header-active ui-state-active ui-corner-top" );
if ( options.icons ) {
clicked.children( ".ui-accordion-header-icon" )
.removeClass( options.icons.header )
.addClass( options.icons.activeHeader );
}
clicked
.next()
.addClass( "ui-accordion-content-active" );
}
},
_toggle: function( data ) {
var toShow = data.newPanel,
toHide = this.prevShow.length ? this.prevShow : data.oldPanel;
this.prevShow.add( this.prevHide ).stop( true, true );
this.prevShow = toShow;
this.prevHide = toHide;
if ( this.options.animate ) {
this._animate( toShow, toHide, data );
} else {
toHide.hide();
toShow.show();
this._toggleComplete( data );
}
toHide.attr({
"aria-expanded": "false",
"aria-hidden": "true"
});
toHide.prev().attr( "aria-selected", "false" );
if ( toShow.length && toHide.length ) {
toHide.prev().attr( "tabIndex", -1 );
} else if ( toShow.length ) {
this.headers.filter(function() {
return $( this ).attr( "tabIndex" ) === 0;
})
.attr( "tabIndex", -1 );
}
toShow
.attr({
"aria-expanded": "true",
"aria-hidden": "false"
})
.prev()
.attr({
"aria-selected": "true",
tabIndex: 0
});
},
_animate: function( toShow, toHide, data ) {
var total, easing, duration,
that = this,
adjust = 0,
down = toShow.length &&
( !toHide.length || ( toShow.index() < toHide.index() ) ),
animate = this.options.animate || {},
options = down && animate.down || animate,
complete = function() {
that._toggleComplete( data );
};
if ( typeof options === "number" ) {
duration = options;
}
if ( typeof options === "string" ) {
easing = options;
}
easing = easing || options.easing || animate.easing;
duration = duration || options.duration || animate.duration;
if ( !toHide.length ) {
return toShow.animate( showProps, duration, easing, complete );
}
if ( !toShow.length ) {
return toHide.animate( hideProps, duration, easing, complete );
}
total = toShow.show().outerHeight();
toHide.animate( hideProps, {
duration: duration,
easing: easing,
step: function( now, fx ) {
fx.now = Math.round( now );
}
});
toShow
.hide()
.animate( showProps, {
duration: duration,
easing: easing,
complete: complete,
step: function( now, fx ) {
fx.now = Math.round( now );
if ( fx.prop !== "height" ) {
adjust += fx.now;
} else if ( that.options.heightStyle !== "content" ) {
fx.now = Math.round( total - toHide.outerHeight() - adjust );
adjust = 0;
}
}
});
},
_toggleComplete: function( data ) {
var toHide = data.oldPanel;
toHide
.removeClass( "ui-accordion-content-active" )
.prev()
.removeClass( "ui-corner-top" )
.addClass( "ui-corner-all" );
if ( toHide.length ) {
toHide.parent()[0].className = toHide.parent()[0].className;
}
this._trigger( "activate", null, data );
}
});
})( jQuery );
(function( $, undefined ) {
var requestIndex = 0;
$.widget( "ui.autocomplete", {
version: "1.10.3",
defaultElement: "<input>",
options: {
appendTo: null,
autoFocus: false,
delay: 300,
minLength: 1,
position: {
my: "left top",
at: "left bottom",
collision: "none"
},
source: null,
change: null,
close: null,
focus: null,
open: null,
response: null,
search: null,
select: null
},
pending: 0,
_create: function() {
var suppressKeyPress, suppressKeyPressRepeat, suppressInput,
nodeName = this.element[0].nodeName.toLowerCase(),
isTextarea = nodeName === "textarea",
isInput = nodeName === "input";
this.isMultiLine =
isTextarea ? true :
isInput ? false :
this.element.prop( "isContentEditable" );
this.valueMethod = this.element[ isTextarea || isInput ? "val" : "text" ];
this.isNewMenu = true;
this.element
.addClass( "ui-autocomplete-input" )
.attr( "autocomplete", "off" );
this._on( this.element, {
keydown: function( event ) {
if ( this.element.prop( "readOnly" ) ) {
suppressKeyPress = true;
suppressInput = true;
suppressKeyPressRepeat = true;
return;
}
suppressKeyPress = false;
suppressInput = false;
suppressKeyPressRepeat = false;
var keyCode = $.ui.keyCode;
switch( event.keyCode ) {
case keyCode.PAGE_UP:
suppressKeyPress = true;
this._move( "previousPage", event );
break;
case keyCode.PAGE_DOWN:
suppressKeyPress = true;
this._move( "nextPage", event );
break;
case keyCode.UP:
suppressKeyPress = true;
this._keyEvent( "previous", event );
break;
case keyCode.DOWN:
suppressKeyPress = true;
this._keyEvent( "next", event );
break;
case keyCode.ENTER:
case keyCode.NUMPAD_ENTER:
if ( this.menu.active ) {
suppressKeyPress = true;
event.preventDefault();
this.menu.select( event );
}
break;
case keyCode.TAB:
if ( this.menu.active ) {
this.menu.select( event );
}
break;
case keyCode.ESCAPE:
if ( this.menu.element.is( ":visible" ) ) {
this._value( this.term );
this.close( event );
event.preventDefault();
}
break;
default:
suppressKeyPressRepeat = true;
this._searchTimeout( event );
break;
}
},
keypress: function( event ) {
if ( suppressKeyPress ) {
suppressKeyPress = false;
if ( !this.isMultiLine || this.menu.element.is( ":visible" ) ) {
event.preventDefault();
}
return;
}
if ( suppressKeyPressRepeat ) {
return;
}
var keyCode = $.ui.keyCode;
switch( event.keyCode ) {
case keyCode.PAGE_UP:
this._move( "previousPage", event );
break;
case keyCode.PAGE_DOWN:
this._move( "nextPage", event );
break;
case keyCode.UP:
this._keyEvent( "previous", event );
break;
case keyCode.DOWN:
this._keyEvent( "next", event );
break;
}
},
input: function( event ) {
if ( suppressInput ) {
suppressInput = false;
event.preventDefault();
return;
}
this._searchTimeout( event );
},
focus: function() {
this.selectedItem = null;
this.previous = this._value();
},
blur: function( event ) {
if ( this.cancelBlur ) {
delete this.cancelBlur;
return;
}
clearTimeout( this.searching );
this.close( event );
this._change( event );
}
});
this._initSource();
this.menu = $( "<ul>" )
.addClass( "ui-autocomplete ui-front" )
.appendTo( this._appendTo() )
.menu({
role: null
})
.hide()
.data( "ui-menu" );
this._on( this.menu.element, {
mousedown: function( event ) {
event.preventDefault();
this.cancelBlur = true;
this._delay(function() {
delete this.cancelBlur;
});
var menuElement = this.menu.element[ 0 ];
if ( !$( event.target ).closest( ".ui-menu-item" ).length ) {
this._delay(function() {
var that = this;
this.document.one( "mousedown", function( event ) {
if ( event.target !== that.element[ 0 ] &&
event.target !== menuElement &&
!$.contains( menuElement, event.target ) ) {
that.close();
}
});
});
}
},
menufocus: function( event, ui ) {
if ( this.isNewMenu ) {
this.isNewMenu = false;
if ( event.originalEvent && /^mouse/.test( event.originalEvent.type ) ) {
this.menu.blur();
this.document.one( "mousemove", function() {
$( event.target ).trigger( event.originalEvent );
});
return;
}
}
var item = ui.item.data( "ui-autocomplete-item" );
if ( false !== this._trigger( "focus", event, { item: item } ) ) {
if ( event.originalEvent && /^key/.test( event.originalEvent.type ) ) {
this._value( item.value );
}
} else {
this.liveRegion.text( item.value );
}
},
menuselect: function( event, ui ) {
var item = ui.item.data( "ui-autocomplete-item" ),
previous = this.previous;
if ( this.element[0] !== this.document[0].activeElement ) {
this.element.focus();
this.previous = previous;
this._delay(function() {
this.previous = previous;
this.selectedItem = item;
});
}
if ( false !== this._trigger( "select", event, { item: item } ) ) {
this._value( item.value );
}
this.term = this._value();
this.close( event );
this.selectedItem = item;
}
});
this.liveRegion = $( "<span>", {
role: "status",
"aria-live": "polite"
})
.addClass( "ui-helper-hidden-accessible" )
.insertBefore( this.element );
this._on( this.window, {
beforeunload: function() {
this.element.removeAttr( "autocomplete" );
}
});
},
_destroy: function() {
clearTimeout( this.searching );
this.element
.removeClass( "ui-autocomplete-input" )
.removeAttr( "autocomplete" );
this.menu.element.remove();
this.liveRegion.remove();
},
_setOption: function( key, value ) {
this._super( key, value );
if ( key === "source" ) {
this._initSource();
}
if ( key === "appendTo" ) {
this.menu.element.appendTo( this._appendTo() );
}
if ( key === "disabled" && value && this.xhr ) {
this.xhr.abort();
}
},
_appendTo: function() {
var element = this.options.appendTo;
if ( element ) {
element = element.jquery || element.nodeType ?
$( element ) :
this.document.find( element ).eq( 0 );
}
if ( !element ) {
element = this.element.closest( ".ui-front" );
}
if ( !element.length ) {
element = this.document[0].body;
}
return element;
},
_initSource: function() {
var array, url,
that = this;
if ( $.isArray(this.options.source) ) {
array = this.options.source;
this.source = function( request, response ) {
response( $.ui.autocomplete.filter( array, request.term ) );
};
} else if ( typeof this.options.source === "string" ) {
url = this.options.source;
this.source = function( request, response ) {
if ( that.xhr ) {
that.xhr.abort();
}
that.xhr = $.ajax({
url: url,
data: request,
dataType: "json",
success: function( data ) {
response( data );
},
error: function() {
response( [] );
}
});
};
} else {
this.source = this.options.source;
}
},
_searchTimeout: function( event ) {
clearTimeout( this.searching );
this.searching = this._delay(function() {
if ( this.term !== this._value() ) {
this.selectedItem = null;
this.search( null, event );
}
}, this.options.delay );
},
search: function( value, event ) {
value = value != null ? value : this._value();
this.term = this._value();
if ( value.length < this.options.minLength ) {
return this.close( event );
}
if ( this._trigger( "search", event ) === false ) {
return;
}
return this._search( value );
},
_search: function( value ) {
this.pending++;
this.element.addClass( "ui-autocomplete-loading" );
this.cancelSearch = false;
this.source( { term: value }, this._response() );
},
_response: function() {
var that = this,
index = ++requestIndex;
return function( content ) {
if ( index === requestIndex ) {
that.__response( content );
}
that.pending--;
if ( !that.pending ) {
that.element.removeClass( "ui-autocomplete-loading" );
}
};
},
__response: function( content ) {
if ( content ) {
content = this._normalize( content );
}
this._trigger( "response", null, { content: content } );
if ( !this.options.disabled && content && content.length && !this.cancelSearch ) {
this._suggest( content );
this._trigger( "open" );
} else {
this._close();
}
},
close: function( event ) {
this.cancelSearch = true;
this._close( event );
},
_close: function( event ) {
if ( this.menu.element.is( ":visible" ) ) {
this.menu.element.hide();
this.menu.blur();
this.isNewMenu = true;
this._trigger( "close", event );
}
},
_change: function( event ) {
if ( this.previous !== this._value() ) {
this._trigger( "change", event, { item: this.selectedItem } );
}
},
_normalize: function( items ) {
if ( items.length && items[0].label && items[0].value ) {
return items;
}
return $.map( items, function( item ) {
if ( typeof item === "string" ) {
return {
label: item,
value: item
};
}
return $.extend({
label: item.label || item.value,
value: item.value || item.label
}, item );
});
},
_suggest: function( items ) {
var ul = this.menu.element.empty();
this._renderMenu( ul, items );
this.isNewMenu = true;
this.menu.refresh();
ul.show();
this._resizeMenu();
ul.position( $.extend({
of: this.element
}, this.options.position ));
if ( this.options.autoFocus ) {
this.menu.next();
}
},
_resizeMenu: function() {
var ul = this.menu.element;
ul.outerWidth( Math.max(
ul.width( "" ).outerWidth() + 1,
this.element.outerWidth()
) );
},
_renderMenu: function( ul, items ) {
var that = this;
$.each( items, function( index, item ) {
that._renderItemData( ul, item );
});
},
_renderItemData: function( ul, item ) {
return this._renderItem( ul, item ).data( "ui-autocomplete-item", item );
},
_renderItem: function( ul, item ) {
return $( "<li>" )
.append( $( "<a>" ).text( item.label ) )
.appendTo( ul );
},
_move: function( direction, event ) {
if ( !this.menu.element.is( ":visible" ) ) {
this.search( null, event );
return;
}
if ( this.menu.isFirstItem() && /^previous/.test( direction ) ||
this.menu.isLastItem() && /^next/.test( direction ) ) {
this._value( this.term );
this.menu.blur();
return;
}
this.menu[ direction ]( event );
},
widget: function() {
return this.menu.element;
},
_value: function() {
return this.valueMethod.apply( this.element, arguments );
},
_keyEvent: function( keyEvent, event ) {
if ( !this.isMultiLine || this.menu.element.is( ":visible" ) ) {
this._move( keyEvent, event );
event.preventDefault();
}
}
});
$.extend( $.ui.autocomplete, {
escapeRegex: function( value ) {
return value.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
},
filter: function(array, term) {
var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
return $.grep( array, function(value) {
return matcher.test( value.label || value.value || value );
});
}
});
$.widget( "ui.autocomplete", $.ui.autocomplete, {
options: {
messages: {
noResults: "No search results.",
results: function( amount ) {
return amount + ( amount > 1 ? " results are" : " result is" ) +
" available, use up and down arrow keys to navigate.";
}
}
},
__response: function( content ) {
var message;
this._superApply( arguments );
if ( this.options.disabled || this.cancelSearch ) {
return;
}
if ( content && content.length ) {
message = this.options.messages.results( content.length );
} else {
message = this.options.messages.noResults;
}
this.liveRegion.text( message );
}
});
}( jQuery ));
(function( $, undefined ) {
var lastActive, startXPos, startYPos, clickDragged,
baseClasses = "ui-button ui-widget ui-state-default ui-corner-all",
stateClasses = "ui-state-hover ui-state-active ",
typeClasses = "ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",
formResetHandler = function() {
var form = $( this );
setTimeout(function() {
form.find( ":ui-button" ).button( "refresh" );
}, 1 );
},
radioGroup = function( radio ) {
var name = radio.name,
form = radio.form,
radios = $( [] );
if ( name ) {
name = name.replace( /'/g, "\\'" );
if ( form ) {
radios = $( form ).find( "[name='" + name + "']" );
} else {
radios = $( "[name='" + name + "']", radio.ownerDocument )
.filter(function() {
return !this.form;
});
}
}
return radios;
};
$.widget( "ui.button", {
version: "1.10.3",
defaultElement: "<button>",
options: {
disabled: null,
text: true,
label: null,
icons: {
primary: null,
secondary: null
}
},
_create: function() {
this.element.closest( "form" )
.unbind( "reset" + this.eventNamespace )
.bind( "reset" + this.eventNamespace, formResetHandler );
if ( typeof this.options.disabled !== "boolean" ) {
this.options.disabled = !!this.element.prop( "disabled" );
} else {
this.element.prop( "disabled", this.options.disabled );
}
this._determineButtonType();
this.hasTitle = !!this.buttonElement.attr( "title" );
var that = this,
options = this.options,
toggleButton = this.type === "checkbox" || this.type === "radio",
activeClass = !toggleButton ? "ui-state-active" : "",
focusClass = "ui-state-focus";
if ( options.label === null ) {
options.label = (this.type === "input" ? this.buttonElement.val() : this.buttonElement.html());
}
this._hoverable( this.buttonElement );
this.buttonElement
.addClass( baseClasses )
.attr( "role", "button" )
.bind( "mouseenter" + this.eventNamespace, function() {
if ( options.disabled ) {
return;
}
if ( this === lastActive ) {
$( this ).addClass( "ui-state-active" );
}
})
.bind( "mouseleave" + this.eventNamespace, function() {
if ( options.disabled ) {
return;
}
$( this ).removeClass( activeClass );
})
.bind( "click" + this.eventNamespace, function( event ) {
if ( options.disabled ) {
event.preventDefault();
event.stopImmediatePropagation();
}
});
this.element
.bind( "focus" + this.eventNamespace, function() {
that.buttonElement.addClass( focusClass );
})
.bind( "blur" + this.eventNamespace, function() {
that.buttonElement.removeClass( focusClass );
});
if ( toggleButton ) {
this.element.bind( "change" + this.eventNamespace, function() {
if ( clickDragged ) {
return;
}
that.refresh();
});
this.buttonElement
.bind( "mousedown" + this.eventNamespace, function( event ) {
if ( options.disabled ) {
return;
}
clickDragged = false;
startXPos = event.pageX;
startYPos = event.pageY;
})
.bind( "mouseup" + this.eventNamespace, function( event ) {
if ( options.disabled ) {
return;
}
if ( startXPos !== event.pageX || startYPos !== event.pageY ) {
clickDragged = true;
}
});
}
if ( this.type === "checkbox" ) {
this.buttonElement.bind( "click" + this.eventNamespace, function() {
if ( options.disabled || clickDragged ) {
return false;
}
});
} else if ( this.type === "radio" ) {
this.buttonElement.bind( "click" + this.eventNamespace, function() {
if ( options.disabled || clickDragged ) {
return false;
}
$( this ).addClass( "ui-state-active" );
that.buttonElement.attr( "aria-pressed", "true" );
var radio = that.element[ 0 ];
radioGroup( radio )
.not( radio )
.map(function() {
return $( this ).button( "widget" )[ 0 ];
})
.removeClass( "ui-state-active" )
.attr( "aria-pressed", "false" );
});
} else {
this.buttonElement
.bind( "mousedown" + this.eventNamespace, function() {
if ( options.disabled ) {
return false;
}
$( this ).addClass( "ui-state-active" );
lastActive = this;
that.document.one( "mouseup", function() {
lastActive = null;
});
})
.bind( "mouseup" + this.eventNamespace, function() {
if ( options.disabled ) {
return false;
}
$( this ).removeClass( "ui-state-active" );
})
.bind( "keydown" + this.eventNamespace, function(event) {
if ( options.disabled ) {
return false;
}
if ( event.keyCode === $.ui.keyCode.SPACE || event.keyCode === $.ui.keyCode.ENTER ) {
$( this ).addClass( "ui-state-active" );
}
})
.bind( "keyup" + this.eventNamespace + " blur" + this.eventNamespace, function() {
$( this ).removeClass( "ui-state-active" );
});
if ( this.buttonElement.is("a") ) {
this.buttonElement.keyup(function(event) {
if ( event.keyCode === $.ui.keyCode.SPACE ) {
$( this ).click();
}
});
}
}
this._setOption( "disabled", options.disabled );
this._resetButton();
},
_determineButtonType: function() {
var ancestor, labelSelector, checked;
if ( this.element.is("[type=checkbox]") ) {
this.type = "checkbox";
} else if ( this.element.is("[type=radio]") ) {
this.type = "radio";
} else if ( this.element.is("input") ) {
this.type = "input";
} else {
this.type = "button";
}
if ( this.type === "checkbox" || this.type === "radio" ) {
ancestor = this.element.parents().last();
labelSelector = "label[for='" + this.element.attr("id") + "']";
this.buttonElement = ancestor.find( labelSelector );
if ( !this.buttonElement.length ) {
ancestor = ancestor.length ? ancestor.siblings() : this.element.siblings();
this.buttonElement = ancestor.filter( labelSelector );
if ( !this.buttonElement.length ) {
this.buttonElement = ancestor.find( labelSelector );
}
}
this.element.addClass( "ui-helper-hidden-accessible" );
checked = this.element.is( ":checked" );
if ( checked ) {
this.buttonElement.addClass( "ui-state-active" );
}
this.buttonElement.prop( "aria-pressed", checked );
} else {
this.buttonElement = this.element;
}
},
widget: function() {
return this.buttonElement;
},
_destroy: function() {
this.element
.removeClass( "ui-helper-hidden-accessible" );
this.buttonElement
.removeClass( baseClasses + " " + stateClasses + " " + typeClasses )
.removeAttr( "role" )
.removeAttr( "aria-pressed" )
.html( this.buttonElement.find(".ui-button-text").html() );
if ( !this.hasTitle ) {
this.buttonElement.removeAttr( "title" );
}
},
_setOption: function( key, value ) {
this._super( key, value );
if ( key === "disabled" ) {
if ( value ) {
this.element.prop( "disabled", true );
} else {
this.element.prop( "disabled", false );
}
return;
}
this._resetButton();
},
refresh: function() {
var isDisabled = this.element.is( "input, button" ) ? this.element.is( ":disabled" ) : this.element.hasClass( "ui-button-disabled" );
if ( isDisabled !== this.options.disabled ) {
this._setOption( "disabled", isDisabled );
}
if ( this.type === "radio" ) {
radioGroup( this.element[0] ).each(function() {
if ( $( this ).is( ":checked" ) ) {
$( this ).button( "widget" )
.addClass( "ui-state-active" )
.attr( "aria-pressed", "true" );
} else {
$( this ).button( "widget" )
.removeClass( "ui-state-active" )
.attr( "aria-pressed", "false" );
}
});
} else if ( this.type === "checkbox" ) {
if ( this.element.is( ":checked" ) ) {
this.buttonElement
.addClass( "ui-state-active" )
.attr( "aria-pressed", "true" );
} else {
this.buttonElement
.removeClass( "ui-state-active" )
.attr( "aria-pressed", "false" );
}
}
},
_resetButton: function() {
if ( this.type === "input" ) {
if ( this.options.label ) {
this.element.val( this.options.label );
}
return;
}
var buttonElement = this.buttonElement.removeClass( typeClasses ),
buttonText = $( "<span></span>", this.document[0] )
.addClass( "ui-button-text" )
.html( this.options.label )
.appendTo( buttonElement.empty() )
.text(),
icons = this.options.icons,
multipleIcons = icons.primary && icons.secondary,
buttonClasses = [];
if ( icons.primary || icons.secondary ) {
if ( this.options.text ) {
buttonClasses.push( "ui-button-text-icon" + ( multipleIcons ? "s" : ( icons.primary ? "-primary" : "-secondary" ) ) );
}
if ( icons.primary ) {
buttonElement.prepend( "<span class='ui-button-icon-primary ui-icon " + icons.primary + "'></span>" );
}
if ( icons.secondary ) {
buttonElement.append( "<span class='ui-button-icon-secondary ui-icon " + icons.secondary + "'></span>" );
}
if ( !this.options.text ) {
buttonClasses.push( multipleIcons ? "ui-button-icons-only" : "ui-button-icon-only" );
if ( !this.hasTitle ) {
buttonElement.attr( "title", $.trim( buttonText ) );
}
}
} else {
buttonClasses.push( "ui-button-text-only" );
}
buttonElement.addClass( buttonClasses.join( " " ) );
}
});
$.widget( "ui.buttonset", {
version: "1.10.3",
options: {
items: "button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"
},
_create: function() {
this.element.addClass( "ui-buttonset" );
},
_init: function() {
this.refresh();
},
_setOption: function( key, value ) {
if ( key === "disabled" ) {
this.buttons.button( "option", key, value );
}
this._super( key, value );
},
refresh: function() {
var rtl = this.element.css( "direction" ) === "rtl";
this.buttons = this.element.find( this.options.items )
.filter( ":ui-button" )
.button( "refresh" )
.end()
.not( ":ui-button" )
.button()
.end()
.map(function() {
return $( this ).button( "widget" )[ 0 ];
})
.removeClass( "ui-corner-all ui-corner-left ui-corner-right" )
.filter( ":first" )
.addClass( rtl ? "ui-corner-right" : "ui-corner-left" )
.end()
.filter( ":last" )
.addClass( rtl ? "ui-corner-left" : "ui-corner-right" )
.end()
.end();
},
_destroy: function() {
this.element.removeClass( "ui-buttonset" );
this.buttons
.map(function() {
return $( this ).button( "widget" )[ 0 ];
})
.removeClass( "ui-corner-left ui-corner-right" )
.end()
.button( "destroy" );
}
});
}( jQuery ) );
(function( $, undefined ) {
$.extend($.ui, { datepicker: { version: "1.10.3" } });
var PROP_NAME = "datepicker",
instActive;
function Datepicker() {
this._curInst = null;
this._keyEvent = false;
this._disabledInputs = [];
this._datepickerShowing = false;
this._inDialog = false;
this._mainDivId = "ui-datepicker-div";
this._inlineClass = "ui-datepicker-inline";
this._appendClass = "ui-datepicker-append";
this._triggerClass = "ui-datepicker-trigger";
this._dialogClass = "ui-datepicker-dialog";
this._disableClass = "ui-datepicker-disabled";
this._unselectableClass = "ui-datepicker-unselectable";
this._currentClass = "ui-datepicker-current-day";
this._dayOverClass = "ui-datepicker-days-cell-over";
this.regional = [];
this.regional[""] = {
closeText: "Done",
prevText: "Prev",
nextText: "Next",
currentText: "Today",
monthNames: ["January","February","March","April","May","June",
"July","August","September","October","November","December"],
monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
dayNamesMin: ["Su","Mo","Tu","We","Th","Fr","Sa"],
weekHeader: "Wk",
dateFormat: "mm/dd/yy",
firstDay: 0,
isRTL: false,
showMonthAfterYear: false,
yearSuffix: ""
};
this._defaults = {
showOn: "focus",
showAnim: "fadeIn",
showOptions: {},
defaultDate: null,
appendText: "",
buttonText: "...",
buttonImage: "",
buttonImageOnly: false,
hideIfNoPrevNext: false,
navigationAsDateFormat: false,
gotoCurrent: false,
changeMonth: false,
changeYear: false,
yearRange: "c-10:c+10",
showOtherMonths: false,
selectOtherMonths: false,
showWeek: false,
calculateWeek: this.iso8601Week,
shortYearCutoff: "+10",
minDate: null,
maxDate: null,
duration: "fast",
beforeShowDay: null,
beforeShow: null,
onSelect: null,
onChangeMonthYear: null,
onClose: null,
numberOfMonths: 1,
showCurrentAtPos: 0,
stepMonths: 1,
stepBigMonths: 12,
altField: "",
altFormat: "",
constrainInput: true,
showButtonPanel: false,
autoSize: false,
disabled: false
};
$.extend(this._defaults, this.regional[""]);
this.dpDiv = bindHover($("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"));
}
$.extend(Datepicker.prototype, {
markerClassName: "hasDatepicker",
maxRows: 4,
_widgetDatepicker: function() {
return this.dpDiv;
},
setDefaults: function(settings) {
extendRemove(this._defaults, settings || {});
return this;
},
_attachDatepicker: function(target, settings) {
var nodeName, inline, inst;
nodeName = target.nodeName.toLowerCase();
inline = (nodeName === "div" || nodeName === "span");
if (!target.id) {
this.uuid += 1;
target.id = "dp" + this.uuid;
}
inst = this._newInst($(target), inline);
inst.settings = $.extend({}, settings || {});
if (nodeName === "input") {
this._connectDatepicker(target, inst);
} else if (inline) {
this._inlineDatepicker(target, inst);
}
},
_newInst: function(target, inline) {
var id = target[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1");
return {id: id, input: target,
selectedDay: 0, selectedMonth: 0, selectedYear: 0,
drawMonth: 0, drawYear: 0,
inline: inline,
dpDiv: (!inline ? this.dpDiv :
bindHover($("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")))};
},
_connectDatepicker: function(target, inst) {
var input = $(target);
inst.append = $([]);
inst.trigger = $([]);
if (input.hasClass(this.markerClassName)) {
return;
}
this._attachments(input, inst);
input.addClass(this.markerClassName).keydown(this._doKeyDown).
keypress(this._doKeyPress).keyup(this._doKeyUp);
this._autoSize(inst);
$.data(target, PROP_NAME, inst);
if( inst.settings.disabled ) {
this._disableDatepicker( target );
}
},
_attachments: function(input, inst) {
var showOn, buttonText, buttonImage,
appendText = this._get(inst, "appendText"),
isRTL = this._get(inst, "isRTL");
if (inst.append) {
inst.append.remove();
}
if (appendText) {
inst.append = $("<span class='" + this._appendClass + "'>" + appendText + "</span>");
input[isRTL ? "before" : "after"](inst.append);
}
input.unbind("focus", this._showDatepicker);
if (inst.trigger) {
inst.trigger.remove();
}
showOn = this._get(inst, "showOn");
if (showOn === "focus" || showOn === "both") {
input.focus(this._showDatepicker);
}
if (showOn === "button" || showOn === "both") {
buttonText = this._get(inst, "buttonText");
buttonImage = this._get(inst, "buttonImage");
inst.trigger = $(this._get(inst, "buttonImageOnly") ?
$("<img/>").addClass(this._triggerClass).
attr({ src: buttonImage, alt: buttonText, title: buttonText }) :
$("<button type='button'></button>").addClass(this._triggerClass).
html(!buttonImage ? buttonText : $("<img/>").attr(
{ src:buttonImage, alt:buttonText, title:buttonText })));
input[isRTL ? "before" : "after"](inst.trigger);
inst.trigger.click(function() {
if ($.datepicker._datepickerShowing && $.datepicker._lastInput === input[0]) {
$.datepicker._hideDatepicker();
} else if ($.datepicker._datepickerShowing && $.datepicker._lastInput !== input[0]) {
$.datepicker._hideDatepicker();
$.datepicker._showDatepicker(input[0]);
} else {
$.datepicker._showDatepicker(input[0]);
}
return false;
});
}
},
_autoSize: function(inst) {
if (this._get(inst, "autoSize") && !inst.inline) {
var findMax, max, maxI, i,
date = new Date(2009, 12 - 1, 20),
dateFormat = this._get(inst, "dateFormat");
if (dateFormat.match(/[DM]/)) {
findMax = function(names) {
max = 0;
maxI = 0;
for (i = 0; i < names.length; i++) {
if (names[i].length > max) {
max = names[i].length;
maxI = i;
}
}
return maxI;
};
date.setMonth(findMax(this._get(inst, (dateFormat.match(/MM/) ?
"monthNames" : "monthNamesShort"))));
date.setDate(findMax(this._get(inst, (dateFormat.match(/DD/) ?
"dayNames" : "dayNamesShort"))) + 20 - date.getDay());
}
inst.input.attr("size", this._formatDate(inst, date).length);
}
},
_inlineDatepicker: function(target, inst) {
var divSpan = $(target);
if (divSpan.hasClass(this.markerClassName)) {
return;
}
divSpan.addClass(this.markerClassName).append(inst.dpDiv);
$.data(target, PROP_NAME, inst);
this._setDate(inst, this._getDefaultDate(inst), true);
this._updateDatepicker(inst);
this._updateAlternate(inst);
if( inst.settings.disabled ) {
this._disableDatepicker( target );
}
inst.dpDiv.css( "display", "block" );
},
_dialogDatepicker: function(input, date, onSelect, settings, pos) {
var id, browserWidth, browserHeight, scrollX, scrollY,
inst = this._dialogInst;
if (!inst) {
this.uuid += 1;
id = "dp" + this.uuid;
this._dialogInput = $("<input type='text' id='" + id +
"' style='position: absolute; top: -100px; width: 0px;'/>");
this._dialogInput.keydown(this._doKeyDown);
$("body").append(this._dialogInput);
inst = this._dialogInst = this._newInst(this._dialogInput, false);
inst.settings = {};
$.data(this._dialogInput[0], PROP_NAME, inst);
}
extendRemove(inst.settings, settings || {});
date = (date && date.constructor === Date ? this._formatDate(inst, date) : date);
this._dialogInput.val(date);
this._pos = (pos ? (pos.length ? pos : [pos.pageX, pos.pageY]) : null);
if (!this._pos) {
browserWidth = document.documentElement.clientWidth;
browserHeight = document.documentElement.clientHeight;
scrollX = document.documentElement.scrollLeft || document.body.scrollLeft;
scrollY = document.documentElement.scrollTop || document.body.scrollTop;
this._pos =
[(browserWidth / 2) - 100 + scrollX, (browserHeight / 2) - 150 + scrollY];
}
this._dialogInput.css("left", (this._pos[0] + 20) + "px").css("top", this._pos[1] + "px");
inst.settings.onSelect = onSelect;
this._inDialog = true;
this.dpDiv.addClass(this._dialogClass);
this._showDatepicker(this._dialogInput[0]);
if ($.blockUI) {
$.blockUI(this.dpDiv);
}
$.data(this._dialogInput[0], PROP_NAME, inst);
return this;
},
_destroyDatepicker: function(target) {
var nodeName,
$target = $(target),
inst = $.data(target, PROP_NAME);
if (!$target.hasClass(this.markerClassName)) {
return;
}
nodeName = target.nodeName.toLowerCase();
$.removeData(target, PROP_NAME);
if (nodeName === "input") {
inst.append.remove();
inst.trigger.remove();
$target.removeClass(this.markerClassName).
unbind("focus", this._showDatepicker).
unbind("keydown", this._doKeyDown).
unbind("keypress", this._doKeyPress).
unbind("keyup", this._doKeyUp);
} else if (nodeName === "div" || nodeName === "span") {
$target.removeClass(this.markerClassName).empty();
}
},
_enableDatepicker: function(target) {
var nodeName, inline,
$target = $(target),
inst = $.data(target, PROP_NAME);
if (!$target.hasClass(this.markerClassName)) {
return;
}
nodeName = target.nodeName.toLowerCase();
if (nodeName === "input") {
target.disabled = false;
inst.trigger.filter("button").
each(function() { this.disabled = false; }).end().
filter("img").css({opacity: "1.0", cursor: ""});
} else if (nodeName === "div" || nodeName === "span") {
inline = $target.children("." + this._inlineClass);
inline.children().removeClass("ui-state-disabled");
inline.find("select.ui-datepicker-month, select.ui-datepicker-year").
prop("disabled", false);
}
this._disabledInputs = $.map(this._disabledInputs,
function(value) { return (value === target ? null : value); });
},
_disableDatepicker: function(target) {
var nodeName, inline,
$target = $(target),
inst = $.data(target, PROP_NAME);
if (!$target.hasClass(this.markerClassName)) {
return;
}
nodeName = target.nodeName.toLowerCase();
if (nodeName === "input") {
target.disabled = true;
inst.trigger.filter("button").
each(function() { this.disabled = true; }).end().
filter("img").css({opacity: "0.5", cursor: "default"});
} else if (nodeName === "div" || nodeName === "span") {
inline = $target.children("." + this._inlineClass);
inline.children().addClass("ui-state-disabled");
inline.find("select.ui-datepicker-month, select.ui-datepicker-year").
prop("disabled", true);
}
this._disabledInputs = $.map(this._disabledInputs,
function(value) { return (value === target ? null : value); });
this._disabledInputs[this._disabledInputs.length] = target;
},
_isDisabledDatepicker: function(target) {
if (!target) {
return false;
}
for (var i = 0; i < this._disabledInputs.length; i++) {
if (this._disabledInputs[i] === target) {
return true;
}
}
return false;
},
_getInst: function(target) {
try {
return $.data(target, PROP_NAME);
}
catch (err) {
throw "Missing instance data for this datepicker";
}
},
_optionDatepicker: function(target, name, value) {
var settings, date, minDate, maxDate,
inst = this._getInst(target);
if (arguments.length === 2 && typeof name === "string") {
return (name === "defaults" ? $.extend({}, $.datepicker._defaults) :
(inst ? (name === "all" ? $.extend({}, inst.settings) :
this._get(inst, name)) : null));
}
settings = name || {};
if (typeof name === "string") {
settings = {};
settings[name] = value;
}
if (inst) {
if (this._curInst === inst) {
this._hideDatepicker();
}
date = this._getDateDatepicker(target, true);
minDate = this._getMinMaxDate(inst, "min");
maxDate = this._getMinMaxDate(inst, "max");
extendRemove(inst.settings, settings);
if (minDate !== null && settings.dateFormat !== undefined && settings.minDate === undefined) {
inst.settings.minDate = this._formatDate(inst, minDate);
}
if (maxDate !== null && settings.dateFormat !== undefined && settings.maxDate === undefined) {
inst.settings.maxDate = this._formatDate(inst, maxDate);
}
if ( "disabled" in settings ) {
if ( settings.disabled ) {
this._disableDatepicker(target);
} else {
this._enableDatepicker(target);
}
}
this._attachments($(target), inst);
this._autoSize(inst);
this._setDate(inst, date);
this._updateAlternate(inst);
this._updateDatepicker(inst);
}
},
_changeDatepicker: function(target, name, value) {
this._optionDatepicker(target, name, value);
},
_refreshDatepicker: function(target) {
var inst = this._getInst(target);
if (inst) {
this._updateDatepicker(inst);
}
},
_setDateDatepicker: function(target, date) {
var inst = this._getInst(target);
if (inst) {
this._setDate(inst, date);
this._updateDatepicker(inst);
this._updateAlternate(inst);
}
},
_getDateDatepicker: function(target, noDefault) {
var inst = this._getInst(target);
if (inst && !inst.inline) {
this._setDateFromField(inst, noDefault);
}
return (inst ? this._getDate(inst) : null);
},
_doKeyDown: function(event) {
var onSelect, dateStr, sel,
inst = $.datepicker._getInst(event.target),
handled = true,
isRTL = inst.dpDiv.is(".ui-datepicker-rtl");
inst._keyEvent = true;
if ($.datepicker._datepickerShowing) {
switch (event.keyCode) {
case 9: $.datepicker._hideDatepicker();
handled = false;
break;
case 13: sel = $("td." + $.datepicker._dayOverClass + ":not(." +
$.datepicker._currentClass + ")", inst.dpDiv);
if (sel[0]) {
$.datepicker._selectDay(event.target, inst.selectedMonth, inst.selectedYear, sel[0]);
}
onSelect = $.datepicker._get(inst, "onSelect");
if (onSelect) {
dateStr = $.datepicker._formatDate(inst);
onSelect.apply((inst.input ? inst.input[0] : null), [dateStr, inst]);
} else {
$.datepicker._hideDatepicker();
}
return false;
case 27: $.datepicker._hideDatepicker();
break;
case 33: $.datepicker._adjustDate(event.target, (event.ctrlKey ?
-$.datepicker._get(inst, "stepBigMonths") :
-$.datepicker._get(inst, "stepMonths")), "M");
break;
case 34: $.datepicker._adjustDate(event.target, (event.ctrlKey ?
+$.datepicker._get(inst, "stepBigMonths") :
+$.datepicker._get(inst, "stepMonths")), "M");
break;
case 35: if (event.ctrlKey || event.metaKey) {
$.datepicker._clearDate(event.target);
}
handled = event.ctrlKey || event.metaKey;
break;
case 36: if (event.ctrlKey || event.metaKey) {
$.datepicker._gotoToday(event.target);
}
handled = event.ctrlKey || event.metaKey;
break;
case 37: if (event.ctrlKey || event.metaKey) {
$.datepicker._adjustDate(event.target, (isRTL ? +1 : -1), "D");
}
handled = event.ctrlKey || event.metaKey;
if (event.originalEvent.altKey) {
$.datepicker._adjustDate(event.target, (event.ctrlKey ?
-$.datepicker._get(inst, "stepBigMonths") :
-$.datepicker._get(inst, "stepMonths")), "M");
}
break;
case 38: if (event.ctrlKey || event.metaKey) {
$.datepicker._adjustDate(event.target, -7, "D");
}
handled = event.ctrlKey || event.metaKey;
break;
case 39: if (event.ctrlKey || event.metaKey) {
$.datepicker._adjustDate(event.target, (isRTL ? -1 : +1), "D");
}
handled = event.ctrlKey || event.metaKey;
if (event.originalEvent.altKey) {
$.datepicker._adjustDate(event.target, (event.ctrlKey ?
+$.datepicker._get(inst, "stepBigMonths") :
+$.datepicker._get(inst, "stepMonths")), "M");
}
break;
case 40: if (event.ctrlKey || event.metaKey) {
$.datepicker._adjustDate(event.target, +7, "D");
}
handled = event.ctrlKey || event.metaKey;
break;
default: handled = false;
}
} else if (event.keyCode === 36 && event.ctrlKey) {
$.datepicker._showDatepicker(this);
} else {
handled = false;
}
if (handled) {
event.preventDefault();
event.stopPropagation();
}
},
_doKeyPress: function(event) {
var chars, chr,
inst = $.datepicker._getInst(event.target);
if ($.datepicker._get(inst, "constrainInput")) {
chars = $.datepicker._possibleChars($.datepicker._get(inst, "dateFormat"));
chr = String.fromCharCode(event.charCode == null ? event.keyCode : event.charCode);
return event.ctrlKey || event.metaKey || (chr < " " || !chars || chars.indexOf(chr) > -1);
}
},
_doKeyUp: function(event) {
var date,
inst = $.datepicker._getInst(event.target);
if (inst.input.val() !== inst.lastVal) {
try {
date = $.datepicker.parseDate($.datepicker._get(inst, "dateFormat"),
(inst.input ? inst.input.val() : null),
$.datepicker._getFormatConfig(inst));
if (date) {
$.datepicker._setDateFromField(inst);
$.datepicker._updateAlternate(inst);
$.datepicker._updateDatepicker(inst);
}
}
catch (err) {
}
}
return true;
},
_showDatepicker: function(input) {
input = input.target || input;
if (input.nodeName.toLowerCase() !== "input") {
input = $("input", input.parentNode)[0];
}
if ($.datepicker._isDisabledDatepicker(input) || $.datepicker._lastInput === input) {
return;
}
var inst, beforeShow, beforeShowSettings, isFixed,
offset, showAnim, duration;
inst = $.datepicker._getInst(input);
if ($.datepicker._curInst && $.datepicker._curInst !== inst) {
$.datepicker._curInst.dpDiv.stop(true, true);
if ( inst && $.datepicker._datepickerShowing ) {
$.datepicker._hideDatepicker( $.datepicker._curInst.input[0] );
}
}
beforeShow = $.datepicker._get(inst, "beforeShow");
beforeShowSettings = beforeShow ? beforeShow.apply(input, [input, inst]) : {};
if(beforeShowSettings === false){
return;
}
extendRemove(inst.settings, beforeShowSettings);
inst.lastVal = null;
$.datepicker._lastInput = input;
$.datepicker._setDateFromField(inst);
if ($.datepicker._inDialog) {
input.value = "";
}
if (!$.datepicker._pos) {
$.datepicker._pos = $.datepicker._findPos(input);
$.datepicker._pos[1] += input.offsetHeight;
}
isFixed = false;
$(input).parents().each(function() {
isFixed |= $(this).css("position") === "fixed";
return !isFixed;
});
offset = {left: $.datepicker._pos[0], top: $.datepicker._pos[1]};
$.datepicker._pos = null;
inst.dpDiv.empty();
inst.dpDiv.css({position: "absolute", display: "block", top: "-1000px"});
$.datepicker._updateDatepicker(inst);
offset = $.datepicker._checkOffset(inst, offset, isFixed);
inst.dpDiv.css({position: ($.datepicker._inDialog && $.blockUI ?
"static" : (isFixed ? "fixed" : "absolute")), display: "none",
left: offset.left + "px", top: offset.top + "px"});
if (!inst.inline) {
showAnim = $.datepicker._get(inst, "showAnim");
duration = $.datepicker._get(inst, "duration");
inst.dpDiv.zIndex($(input).zIndex()+1);
$.datepicker._datepickerShowing = true;
if ( $.effects && $.effects.effect[ showAnim ] ) {
inst.dpDiv.show(showAnim, $.datepicker._get(inst, "showOptions"), duration);
} else {
inst.dpDiv[showAnim || "show"](showAnim ? duration : null);
}
if ( $.datepicker._shouldFocusInput( inst ) ) {
inst.input.focus();
}
$.datepicker._curInst = inst;
}
},
_updateDatepicker: function(inst) {
this.maxRows = 4;
instActive = inst;
inst.dpDiv.empty().append(this._generateHTML(inst));
this._attachHandlers(inst);
inst.dpDiv.find("." + this._dayOverClass + " a").mouseover();
var origyearshtml,
numMonths = this._getNumberOfMonths(inst),
cols = numMonths[1],
width = 17;
inst.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width("");
if (cols > 1) {
inst.dpDiv.addClass("ui-datepicker-multi-" + cols).css("width", (width * cols) + "em");
}
inst.dpDiv[(numMonths[0] !== 1 || numMonths[1] !== 1 ? "add" : "remove") +
"Class"]("ui-datepicker-multi");
inst.dpDiv[(this._get(inst, "isRTL") ? "add" : "remove") +
"Class"]("ui-datepicker-rtl");
if (inst === $.datepicker._curInst && $.datepicker._datepickerShowing && $.datepicker._shouldFocusInput( inst ) ) {
inst.input.focus();
}
if( inst.yearshtml ){
origyearshtml = inst.yearshtml;
setTimeout(function(){
if( origyearshtml === inst.yearshtml && inst.yearshtml ){
inst.dpDiv.find("select.ui-datepicker-year:first").replaceWith(inst.yearshtml);
}
origyearshtml = inst.yearshtml = null;
}, 0);
}
},
_shouldFocusInput: function( inst ) {
return inst.input && inst.input.is( ":visible" ) && !inst.input.is( ":disabled" ) && !inst.input.is( ":focus" );
},
_checkOffset: function(inst, offset, isFixed) {
var dpWidth = inst.dpDiv.outerWidth(),
dpHeight = inst.dpDiv.outerHeight(),
inputWidth = inst.input ? inst.input.outerWidth() : 0,
inputHeight = inst.input ? inst.input.outerHeight() : 0,
viewWidth = document.documentElement.clientWidth + (isFixed ? 0 : $(document).scrollLeft()),
viewHeight = document.documentElement.clientHeight + (isFixed ? 0 : $(document).scrollTop());
offset.left -= (this._get(inst, "isRTL") ? (dpWidth - inputWidth) : 0);
offset.left -= (isFixed && offset.left === inst.input.offset().left) ? $(document).scrollLeft() : 0;
offset.top -= (isFixed && offset.top === (inst.input.offset().top + inputHeight)) ? $(document).scrollTop() : 0;
offset.left -= Math.min(offset.left, (offset.left + dpWidth > viewWidth && viewWidth > dpWidth) ?
Math.abs(offset.left + dpWidth - viewWidth) : 0);
offset.top -= Math.min(offset.top, (offset.top + dpHeight > viewHeight && viewHeight > dpHeight) ?
Math.abs(dpHeight + inputHeight) : 0);
return offset;
},
_findPos: function(obj) {
var position,
inst = this._getInst(obj),
isRTL = this._get(inst, "isRTL");
while (obj && (obj.type === "hidden" || obj.nodeType !== 1 || $.expr.filters.hidden(obj))) {
obj = obj[isRTL ? "previousSibling" : "nextSibling"];
}
position = $(obj).offset();
return [position.left, position.top];
},
_hideDatepicker: function(input) {
var showAnim, duration, postProcess, onClose,
inst = this._curInst;
if (!inst || (input && inst !== $.data(input, PROP_NAME))) {
return;
}
if (this._datepickerShowing) {
showAnim = this._get(inst, "showAnim");
duration = this._get(inst, "duration");
postProcess = function() {
$.datepicker._tidyDialog(inst);
};
if ( $.effects && ( $.effects.effect[ showAnim ] || $.effects[ showAnim ] ) ) {
inst.dpDiv.hide(showAnim, $.datepicker._get(inst, "showOptions"), duration, postProcess);
} else {
inst.dpDiv[(showAnim === "slideDown" ? "slideUp" :
(showAnim === "fadeIn" ? "fadeOut" : "hide"))]((showAnim ? duration : null), postProcess);
}
if (!showAnim) {
postProcess();
}
this._datepickerShowing = false;
onClose = this._get(inst, "onClose");
if (onClose) {
onClose.apply((inst.input ? inst.input[0] : null), [(inst.input ? inst.input.val() : ""), inst]);
}
this._lastInput = null;
if (this._inDialog) {
this._dialogInput.css({ position: "absolute", left: "0", top: "-100px" });
if ($.blockUI) {
$.unblockUI();
$("body").append(this.dpDiv);
}
}
this._inDialog = false;
}
},
_tidyDialog: function(inst) {
inst.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar");
},
_checkExternalClick: function(event) {
if (!$.datepicker._curInst) {
return;
}
var $target = $(event.target),
inst = $.datepicker._getInst($target[0]);
if ( ( ( $target[0].id !== $.datepicker._mainDivId &&
$target.parents("#" + $.datepicker._mainDivId).length === 0 &&
!$target.hasClass($.datepicker.markerClassName) &&
!$target.closest("." + $.datepicker._triggerClass).length &&
$.datepicker._datepickerShowing && !($.datepicker._inDialog && $.blockUI) ) ) ||
( $target.hasClass($.datepicker.markerClassName) && $.datepicker._curInst !== inst ) ) {
$.datepicker._hideDatepicker();
}
},
_adjustDate: function(id, offset, period) {
var target = $(id),
inst = this._getInst(target[0]);
if (this._isDisabledDatepicker(target[0])) {
return;
}
this._adjustInstDate(inst, offset +
(period === "M" ? this._get(inst, "showCurrentAtPos") : 0),
period);
this._updateDatepicker(inst);
},
_gotoToday: function(id) {
var date,
target = $(id),
inst = this._getInst(target[0]);
if (this._get(inst, "gotoCurrent") && inst.currentDay) {
inst.selectedDay = inst.currentDay;
inst.drawMonth = inst.selectedMonth = inst.currentMonth;
inst.drawYear = inst.selectedYear = inst.currentYear;
} else {
date = new Date();
inst.selectedDay = date.getDate();
inst.drawMonth = inst.selectedMonth = date.getMonth();
inst.drawYear = inst.selectedYear = date.getFullYear();
}
this._notifyChange(inst);
this._adjustDate(target);
},
_selectMonthYear: function(id, select, period) {
var target = $(id),
inst = this._getInst(target[0]);
inst["selected" + (period === "M" ? "Month" : "Year")] =
inst["draw" + (period === "M" ? "Month" : "Year")] =
parseInt(select.options[select.selectedIndex].value,10);
this._notifyChange(inst);
this._adjustDate(target);
},
_selectDay: function(id, month, year, td) {
var inst,
target = $(id);
if ($(td).hasClass(this._unselectableClass) || this._isDisabledDatepicker(target[0])) {
return;
}
inst = this._getInst(target[0]);
inst.selectedDay = inst.currentDay = $("a", td).html();
inst.selectedMonth = inst.currentMonth = month;
inst.selectedYear = inst.currentYear = year;
this._selectDate(id, this._formatDate(inst,
inst.currentDay, inst.currentMonth, inst.currentYear));
},
_clearDate: function(id) {
var target = $(id);
this._selectDate(target, "");
},
_selectDate: function(id, dateStr) {
var onSelect,
target = $(id),
inst = this._getInst(target[0]);
dateStr = (dateStr != null ? dateStr : this._formatDate(inst));
if (inst.input) {
inst.input.val(dateStr);
}
this._updateAlternate(inst);
onSelect = this._get(inst, "onSelect");
if (onSelect) {
onSelect.apply((inst.input ? inst.input[0] : null), [dateStr, inst]);
} else if (inst.input) {
inst.input.trigger("change");
}
if (inst.inline){
this._updateDatepicker(inst);
} else {
this._hideDatepicker();
this._lastInput = inst.input[0];
if (typeof(inst.input[0]) !== "object") {
inst.input.focus();
}
this._lastInput = null;
}
},
_updateAlternate: function(inst) {
var altFormat, date, dateStr,
altField = this._get(inst, "altField");
if (altField) {
altFormat = this._get(inst, "altFormat") || this._get(inst, "dateFormat");
date = this._getDate(inst);
dateStr = this.formatDate(altFormat, date, this._getFormatConfig(inst));
$(altField).each(function() { $(this).val(dateStr); });
}
},
noWeekends: function(date) {
var day = date.getDay();
return [(day > 0 && day < 6), ""];
},
iso8601Week: function(date) {
var time,
checkDate = new Date(date.getTime());
checkDate.setDate(checkDate.getDate() + 4 - (checkDate.getDay() || 7));
time = checkDate.getTime();
checkDate.setMonth(0);
checkDate.setDate(1);
return Math.floor(Math.round((time - checkDate) / 86400000) / 7) + 1;
},
parseDate: function (format, value, settings) {
if (format == null || value == null) {
throw "Invalid arguments";
}
value = (typeof value === "object" ? value.toString() : value + "");
if (value === "") {
return null;
}
var iFormat, dim, extra,
iValue = 0,
shortYearCutoffTemp = (settings ? settings.shortYearCutoff : null) || this._defaults.shortYearCutoff,
shortYearCutoff = (typeof shortYearCutoffTemp !== "string" ? shortYearCutoffTemp :
new Date().getFullYear() % 100 + parseInt(shortYearCutoffTemp, 10)),
dayNamesShort = (settings ? settings.dayNamesShort : null) || this._defaults.dayNamesShort,
dayNames = (settings ? settings.dayNames : null) || this._defaults.dayNames,
monthNamesShort = (settings ? settings.monthNamesShort : null) || this._defaults.monthNamesShort,
monthNames = (settings ? settings.monthNames : null) || this._defaults.monthNames,
year = -1,
month = -1,
day = -1,
doy = -1,
literal = false,
date,
lookAhead = function(match) {
var matches = (iFormat + 1 < format.length && format.charAt(iFormat + 1) === match);
if (matches) {
iFormat++;
}
return matches;
},
getNumber = function(match) {
var isDoubled = lookAhead(match),
size = (match === "@" ? 14 : (match === "!" ? 20 :
(match === "y" && isDoubled ? 4 : (match === "o" ? 3 : 2)))),
digits = new RegExp("^\\d{1," + size + "}"),
num = value.substring(iValue).match(digits);
if (!num) {
throw "Missing number at position " + iValue;
}
iValue += num[0].length;
return parseInt(num[0], 10);
},
getName = function(match, shortNames, longNames) {
var index = -1,
names = $.map(lookAhead(match) ? longNames : shortNames, function (v, k) {
return [ [k, v] ];
}).sort(function (a, b) {
return -(a[1].length - b[1].length);
});
$.each(names, function (i, pair) {
var name = pair[1];
if (value.substr(iValue, name.length).toLowerCase() === name.toLowerCase()) {
index = pair[0];
iValue += name.length;
return false;
}
});
if (index !== -1) {
return index + 1;
} else {
throw "Unknown name at position " + iValue;
}
},
checkLiteral = function() {
if (value.charAt(iValue) !== format.charAt(iFormat)) {
throw "Unexpected literal at position " + iValue;
}
iValue++;
};
for (iFormat = 0; iFormat < format.length; iFormat++) {
if (literal) {
if (format.charAt(iFormat) === "'" && !lookAhead("'")) {
literal = false;
} else {
checkLiteral();
}
} else {
switch (format.charAt(iFormat)) {
case "d":
day = getNumber("d");
break;
case "D":
getName("D", dayNamesShort, dayNames);
break;
case "o":
doy = getNumber("o");
break;
case "m":
month = getNumber("m");
break;
case "M":
month = getName("M", monthNamesShort, monthNames);
break;
case "y":
year = getNumber("y");
break;
case "@":
date = new Date(getNumber("@"));
year = date.getFullYear();
month = date.getMonth() + 1;
day = date.getDate();
break;
case "!":
date = new Date((getNumber("!") - this._ticksTo1970) / 10000);
year = date.getFullYear();
month = date.getMonth() + 1;
day = date.getDate();
break;
case "'":
if (lookAhead("'")){
checkLiteral();
} else {
literal = true;
}
break;
default:
checkLiteral();
}
}
}
if (iValue < value.length){
extra = value.substr(iValue);
if (!/^\s+/.test(extra)) {
throw "Extra/unparsed characters found in date: " + extra;
}
}
if (year === -1) {
year = new Date().getFullYear();
} else if (year < 100) {
year += new Date().getFullYear() - new Date().getFullYear() % 100 +
(year <= shortYearCutoff ? 0 : -100);
}
if (doy > -1) {
month = 1;
day = doy;
do {
dim = this._getDaysInMonth(year, month - 1);
if (day <= dim) {
break;
}
month++;
day -= dim;
} while (true);
}
date = this._daylightSavingAdjust(new Date(year, month - 1, day));
if (date.getFullYear() !== year || date.getMonth() + 1 !== month || date.getDate() !== day) {
throw "Invalid date";
}
return date;
},
ATOM: "yy-mm-dd",
COOKIE: "D, dd M yy",
ISO_8601: "yy-mm-dd",
RFC_822: "D, d M y",
RFC_850: "DD, dd-M-y",
RFC_1036: "D, d M y",
RFC_1123: "D, d M yy",
RFC_2822: "D, d M yy",
RSS: "D, d M y",
TICKS: "!",
TIMESTAMP: "@",
W3C: "yy-mm-dd",
_ticksTo1970: (((1970 - 1) * 365 + Math.floor(1970 / 4) - Math.floor(1970 / 100) +
Math.floor(1970 / 400)) * 24 * 60 * 60 * 10000000),
formatDate: function (format, date, settings) {
if (!date) {
return "";
}
var iFormat,
dayNamesShort = (settings ? settings.dayNamesShort : null) || this._defaults.dayNamesShort,
dayNames = (settings ? settings.dayNames : null) || this._defaults.dayNames,
monthNamesShort = (settings ? settings.monthNamesShort : null) || this._defaults.monthNamesShort,
monthNames = (settings ? settings.monthNames : null) || this._defaults.monthNames,
lookAhead = function(match) {
var matches = (iFormat + 1 < format.length && format.charAt(iFormat + 1) === match);
if (matches) {
iFormat++;
}
return matches;
},
formatNumber = function(match, value, len) {
var num = "" + value;
if (lookAhead(match)) {
while (num.length < len) {
num = "0" + num;
}
}
return num;
},
formatName = function(match, value, shortNames, longNames) {
return (lookAhead(match) ? longNames[value] : shortNames[value]);
},
output = "",
literal = false;
if (date) {
for (iFormat = 0; iFormat < format.length; iFormat++) {
if (literal) {
if (format.charAt(iFormat) === "'" && !lookAhead("'")) {
literal = false;
} else {
output += format.charAt(iFormat);
}
} else {
switch (format.charAt(iFormat)) {
case "d":
output += formatNumber("d", date.getDate(), 2);
break;
case "D":
output += formatName("D", date.getDay(), dayNamesShort, dayNames);
break;
case "o":
output += formatNumber("o",
Math.round((new Date(date.getFullYear(), date.getMonth(), date.getDate()).getTime() - new Date(date.getFullYear(), 0, 0).getTime()) / 86400000), 3);
break;
case "m":
output += formatNumber("m", date.getMonth() + 1, 2);
break;
case "M":
output += formatName("M", date.getMonth(), monthNamesShort, monthNames);
break;
case "y":
output += (lookAhead("y") ? date.getFullYear() :
(date.getYear() % 100 < 10 ? "0" : "") + date.getYear() % 100);
break;
case "@":
output += date.getTime();
break;
case "!":
output += date.getTime() * 10000 + this._ticksTo1970;
break;
case "'":
if (lookAhead("'")) {
output += "'";
} else {
literal = true;
}
break;
default:
output += format.charAt(iFormat);
}
}
}
}
return output;
},
_possibleChars: function (format) {
var iFormat,
chars = "",
literal = false,
lookAhead = function(match) {
var matches = (iFormat + 1 < format.length && format.charAt(iFormat + 1) === match);
if (matches) {
iFormat++;
}
return matches;
};
for (iFormat = 0; iFormat < format.length; iFormat++) {
if (literal) {
if (format.charAt(iFormat) === "'" && !lookAhead("'")) {
literal = false;
} else {
chars += format.charAt(iFormat);
}
} else {
switch (format.charAt(iFormat)) {
case "d": case "m": case "y": case "@":
chars += "0123456789";
break;
case "D": case "M":
return null;
case "'":
if (lookAhead("'")) {
chars += "'";
} else {
literal = true;
}
break;
default:
chars += format.charAt(iFormat);
}
}
}
return chars;
},
_get: function(inst, name) {
return inst.settings[name] !== undefined ?
inst.settings[name] : this._defaults[name];
},
_setDateFromField: function(inst, noDefault) {
if (inst.input.val() === inst.lastVal) {
return;
}
var dateFormat = this._get(inst, "dateFormat"),
dates = inst.lastVal = inst.input ? inst.input.val() : null,
defaultDate = this._getDefaultDate(inst),
date = defaultDate,
settings = this._getFormatConfig(inst);
try {
date = this.parseDate(dateFormat, dates, settings) || defaultDate;
} catch (event) {
dates = (noDefault ? "" : dates);
}
inst.selectedDay = date.getDate();
inst.drawMonth = inst.selectedMonth = date.getMonth();
inst.drawYear = inst.selectedYear = date.getFullYear();
inst.currentDay = (dates ? date.getDate() : 0);
inst.currentMonth = (dates ? date.getMonth() : 0);
inst.currentYear = (dates ? date.getFullYear() : 0);
this._adjustInstDate(inst);
},
_getDefaultDate: function(inst) {
return this._restrictMinMax(inst,
this._determineDate(inst, this._get(inst, "defaultDate"), new Date()));
},
_determineDate: function(inst, date, defaultDate) {
var offsetNumeric = function(offset) {
var date = new Date();
date.setDate(date.getDate() + offset);
return date;
},
offsetString = function(offset) {
try {
return $.datepicker.parseDate($.datepicker._get(inst, "dateFormat"),
offset, $.datepicker._getFormatConfig(inst));
}
catch (e) {
}
var date = (offset.toLowerCase().match(/^c/) ?
$.datepicker._getDate(inst) : null) || new Date(),
year = date.getFullYear(),
month = date.getMonth(),
day = date.getDate(),
pattern = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g,
matches = pattern.exec(offset);
while (matches) {
switch (matches[2] || "d") {
case "d" : case "D" :
day += parseInt(matches[1],10); break;
case "w" : case "W" :
day += parseInt(matches[1],10) * 7; break;
case "m" : case "M" :
month += parseInt(matches[1],10);
day = Math.min(day, $.datepicker._getDaysInMonth(year, month));
break;
case "y": case "Y" :
year += parseInt(matches[1],10);
day = Math.min(day, $.datepicker._getDaysInMonth(year, month));
break;
}
matches = pattern.exec(offset);
}
return new Date(year, month, day);
},
newDate = (date == null || date === "" ? defaultDate : (typeof date === "string" ? offsetString(date) :
(typeof date === "number" ? (isNaN(date) ? defaultDate : offsetNumeric(date)) : new Date(date.getTime()))));
newDate = (newDate && newDate.toString() === "Invalid Date" ? defaultDate : newDate);
if (newDate) {
newDate.setHours(0);
newDate.setMinutes(0);
newDate.setSeconds(0);
newDate.setMilliseconds(0);
}
return this._daylightSavingAdjust(newDate);
},
_daylightSavingAdjust: function(date) {
if (!date) {
return null;
}
date.setHours(date.getHours() > 12 ? date.getHours() + 2 : 0);
return date;
},
_setDate: function(inst, date, noChange) {
var clear = !date,
origMonth = inst.selectedMonth,
origYear = inst.selectedYear,
newDate = this._restrictMinMax(inst, this._determineDate(inst, date, new Date()));
inst.selectedDay = inst.currentDay = newDate.getDate();
inst.drawMonth = inst.selectedMonth = inst.currentMonth = newDate.getMonth();
inst.drawYear = inst.selectedYear = inst.currentYear = newDate.getFullYear();
if ((origMonth !== inst.selectedMonth || origYear !== inst.selectedYear) && !noChange) {
this._notifyChange(inst);
}
this._adjustInstDate(inst);
if (inst.input) {
inst.input.val(clear ? "" : this._formatDate(inst));
}
},
_getDate: function(inst) {
var startDate = (!inst.currentYear || (inst.input && inst.input.val() === "") ? null :
this._daylightSavingAdjust(new Date(
inst.currentYear, inst.currentMonth, inst.currentDay)));
return startDate;
},
_attachHandlers: function(inst) {
var stepMonths = this._get(inst, "stepMonths"),
id = "#" + inst.id.replace( /\\\\/g, "\\" );
inst.dpDiv.find("[data-handler]").map(function () {
var handler = {
prev: function () {
$.datepicker._adjustDate(id, -stepMonths, "M");
},
next: function () {
$.datepicker._adjustDate(id, +stepMonths, "M");
},
hide: function () {
$.datepicker._hideDatepicker();
},
today: function () {
$.datepicker._gotoToday(id);
},
selectDay: function () {
$.datepicker._selectDay(id, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this);
return false;
},
selectMonth: function () {
$.datepicker._selectMonthYear(id, this, "M");
return false;
},
selectYear: function () {
$.datepicker._selectMonthYear(id, this, "Y");
return false;
}
};
$(this).bind(this.getAttribute("data-event"), handler[this.getAttribute("data-handler")]);
});
},
_generateHTML: function(inst) {
var maxDraw, prevText, prev, nextText, next, currentText, gotoDate,
controls, buttonPanel, firstDay, showWeek, dayNames, dayNamesMin,
monthNames, monthNamesShort, beforeShowDay, showOtherMonths,
selectOtherMonths, defaultDate, html, dow, row, group, col, selectedDate,
cornerClass, calender, thead, day, daysInMonth, leadDays, curRows, numRows,
printDate, dRow, tbody, daySettings, otherMonth, unselectable,
tempDate = new Date(),
today = this._daylightSavingAdjust(
new Date(tempDate.getFullYear(), tempDate.getMonth(), tempDate.getDate())),
isRTL = this._get(inst, "isRTL"),
showButtonPanel = this._get(inst, "showButtonPanel"),
hideIfNoPrevNext = this._get(inst, "hideIfNoPrevNext"),
navigationAsDateFormat = this._get(inst, "navigationAsDateFormat"),
numMonths = this._getNumberOfMonths(inst),
showCurrentAtPos = this._get(inst, "showCurrentAtPos"),
stepMonths = this._get(inst, "stepMonths"),
isMultiMonth = (numMonths[0] !== 1 || numMonths[1] !== 1),
currentDate = this._daylightSavingAdjust((!inst.currentDay ? new Date(9999, 9, 9) :
new Date(inst.currentYear, inst.currentMonth, inst.currentDay))),
minDate = this._getMinMaxDate(inst, "min"),
maxDate = this._getMinMaxDate(inst, "max"),
drawMonth = inst.drawMonth - showCurrentAtPos,
drawYear = inst.drawYear;
if (drawMonth < 0) {
drawMonth += 12;
drawYear--;
}
if (maxDate) {
maxDraw = this._daylightSavingAdjust(new Date(maxDate.getFullYear(),
maxDate.getMonth() - (numMonths[0] * numMonths[1]) + 1, maxDate.getDate()));
maxDraw = (minDate && maxDraw < minDate ? minDate : maxDraw);
while (this._daylightSavingAdjust(new Date(drawYear, drawMonth, 1)) > maxDraw) {
drawMonth--;
if (drawMonth < 0) {
drawMonth = 11;
drawYear--;
}
}
}
inst.drawMonth = drawMonth;
inst.drawYear = drawYear;
prevText = this._get(inst, "prevText");
prevText = (!navigationAsDateFormat ? prevText : this.formatDate(prevText,
this._daylightSavingAdjust(new Date(drawYear, drawMonth - stepMonths, 1)),
this._getFormatConfig(inst)));
prev = (this._canAdjustMonth(inst, -1, drawYear, drawMonth) ?
"<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click'" +
" title='" + prevText + "'><span class='ui-icon ui-icon-circle-triangle-" + ( isRTL ? "e" : "w") + "'>" + prevText + "</span></a>" :
(hideIfNoPrevNext ? "" : "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='"+ prevText +"'><span class='ui-icon ui-icon-circle-triangle-" + ( isRTL ? "e" : "w") + "'>" + prevText + "</span></a>"));
nextText = this._get(inst, "nextText");
nextText = (!navigationAsDateFormat ? nextText : this.formatDate(nextText,
this._daylightSavingAdjust(new Date(drawYear, drawMonth + stepMonths, 1)),
this._getFormatConfig(inst)));
next = (this._canAdjustMonth(inst, +1, drawYear, drawMonth) ?
"<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click'" +
" title='" + nextText + "'><span class='ui-icon ui-icon-circle-triangle-" + ( isRTL ? "w" : "e") + "'>" + nextText + "</span></a>" :
(hideIfNoPrevNext ? "" : "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='"+ nextText + "'><span class='ui-icon ui-icon-circle-triangle-" + ( isRTL ? "w" : "e") + "'>" + nextText + "</span></a>"));
currentText = this._get(inst, "currentText");
gotoDate = (this._get(inst, "gotoCurrent") && inst.currentDay ? currentDate : today);
currentText = (!navigationAsDateFormat ? currentText :
this.formatDate(currentText, gotoDate, this._getFormatConfig(inst)));
controls = (!inst.inline ? "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" +
this._get(inst, "closeText") + "</button>" : "");
buttonPanel = (showButtonPanel) ? "<div class='ui-datepicker-buttonpane ui-widget-content'>" + (isRTL ? controls : "") +
(this._isInRange(inst, gotoDate) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'" +
">" + currentText + "</button>" : "") + (isRTL ? "" : controls) + "</div>" : "";
firstDay = parseInt(this._get(inst, "firstDay"),10);
firstDay = (isNaN(firstDay) ? 0 : firstDay);
showWeek = this._get(inst, "showWeek");
dayNames = this._get(inst, "dayNames");
dayNamesMin = this._get(inst, "dayNamesMin");
monthNames = this._get(inst, "monthNames");
monthNamesShort = this._get(inst, "monthNamesShort");
beforeShowDay = this._get(inst, "beforeShowDay");
showOtherMonths = this._get(inst, "showOtherMonths");
selectOtherMonths = this._get(inst, "selectOtherMonths");
defaultDate = this._getDefaultDate(inst);
html = "";
dow;
for (row = 0; row < numMonths[0]; row++) {
group = "";
this.maxRows = 4;
for (col = 0; col < numMonths[1]; col++) {
selectedDate = this._daylightSavingAdjust(new Date(drawYear, drawMonth, inst.selectedDay));
cornerClass = " ui-corner-all";
calender = "";
if (isMultiMonth) {
calender += "<div class='ui-datepicker-group";
if (numMonths[1] > 1) {
switch (col) {
case 0: calender += " ui-datepicker-group-first";
cornerClass = " ui-corner-" + (isRTL ? "right" : "left"); break;
case numMonths[1]-1: calender += " ui-datepicker-group-last";
cornerClass = " ui-corner-" + (isRTL ? "left" : "right"); break;
default: calender += " ui-datepicker-group-middle"; cornerClass = ""; break;
}
}
calender += "'>";
}
calender += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + cornerClass + "'>" +
(/all|left/.test(cornerClass) && row === 0 ? (isRTL ? next : prev) : "") +
(/all|right/.test(cornerClass) && row === 0 ? (isRTL ? prev : next) : "") +
this._generateMonthYearHeader(inst, drawMonth, drawYear, minDate, maxDate,
row > 0 || col > 0, monthNames, monthNamesShort) +
"</div><table class='ui-datepicker-calendar'><thead>" +
"<tr>";
thead = (showWeek ? "<th class='ui-datepicker-week-col'>" + this._get(inst, "weekHeader") + "</th>" : "");
for (dow = 0; dow < 7; dow++) {
day = (dow + firstDay) % 7;
thead += "<th" + ((dow + firstDay + 6) % 7 >= 5 ? " class='ui-datepicker-week-end'" : "") + ">" +
"<span title='" + dayNames[day] + "'>" + dayNamesMin[day] + "</span></th>";
}
calender += thead + "</tr></thead><tbody>";
daysInMonth = this._getDaysInMonth(drawYear, drawMonth);
if (drawYear === inst.selectedYear && drawMonth === inst.selectedMonth) {
inst.selectedDay = Math.min(inst.selectedDay, daysInMonth);
}
leadDays = (this._getFirstDayOfMonth(drawYear, drawMonth) - firstDay + 7) % 7;
curRows = Math.ceil((leadDays + daysInMonth) / 7);
numRows = (isMultiMonth ? this.maxRows > curRows ? this.maxRows : curRows : curRows);
this.maxRows = numRows;
printDate = this._daylightSavingAdjust(new Date(drawYear, drawMonth, 1 - leadDays));
for (dRow = 0; dRow < numRows; dRow++) {
calender += "<tr>";
tbody = (!showWeek ? "" : "<td class='ui-datepicker-week-col'>" +
this._get(inst, "calculateWeek")(printDate) + "</td>");
for (dow = 0; dow < 7; dow++) {
daySettings = (beforeShowDay ?
beforeShowDay.apply((inst.input ? inst.input[0] : null), [printDate]) : [true, ""]);
otherMonth = (printDate.getMonth() !== drawMonth);
unselectable = (otherMonth && !selectOtherMonths) || !daySettings[0] ||
(minDate && printDate < minDate) || (maxDate && printDate > maxDate);
tbody += "<td class='" +
((dow + firstDay + 6) % 7 >= 5 ? " ui-datepicker-week-end" : "") +
(otherMonth ? " ui-datepicker-other-month" : "") +
((printDate.getTime() === selectedDate.getTime() && drawMonth === inst.selectedMonth && inst._keyEvent) ||
(defaultDate.getTime() === printDate.getTime() && defaultDate.getTime() === selectedDate.getTime()) ?
" " + this._dayOverClass : "") +
(unselectable ? " " + this._unselectableClass + " ui-state-disabled": "") +
(otherMonth && !showOtherMonths ? "" : " " + daySettings[1] +
(printDate.getTime() === currentDate.getTime() ? " " + this._currentClass : "") +
(printDate.getTime() === today.getTime() ? " ui-datepicker-today" : "")) + "'" +
((!otherMonth || showOtherMonths) && daySettings[2] ? " title='" + daySettings[2].replace(/'/g, "&#39;") + "'" : "") +
(unselectable ? "" : " data-handler='selectDay' data-event='click' data-month='" + printDate.getMonth() + "' data-year='" + printDate.getFullYear() + "'") + ">" +
(otherMonth && !showOtherMonths ? "&#xa0;" :
(unselectable ? "<span class='ui-state-default'>" + printDate.getDate() + "</span>" : "<a class='ui-state-default" +
(printDate.getTime() === today.getTime() ? " ui-state-highlight" : "") +
(printDate.getTime() === currentDate.getTime() ? " ui-state-active" : "") +
(otherMonth ? " ui-priority-secondary" : "") +
"' href='#'>" + printDate.getDate() + "</a>")) + "</td>";
printDate.setDate(printDate.getDate() + 1);
printDate = this._daylightSavingAdjust(printDate);
}
calender += tbody + "</tr>";
}
drawMonth++;
if (drawMonth > 11) {
drawMonth = 0;
drawYear++;
}
calender += "</tbody></table>" + (isMultiMonth ? "</div>" +
((numMonths[0] > 0 && col === numMonths[1]-1) ? "<div class='ui-datepicker-row-break'></div>" : "") : "");
group += calender;
}
html += group;
}
html += buttonPanel;
inst._keyEvent = false;
return html;
},
_generateMonthYearHeader: function(inst, drawMonth, drawYear, minDate, maxDate,
secondary, monthNames, monthNamesShort) {
var inMinYear, inMaxYear, month, years, thisYear, determineYear, year, endYear,
changeMonth = this._get(inst, "changeMonth"),
changeYear = this._get(inst, "changeYear"),
showMonthAfterYear = this._get(inst, "showMonthAfterYear"),
html = "<div class='ui-datepicker-title'>",
monthHtml = "";
if (secondary || !changeMonth) {
monthHtml += "<span class='ui-datepicker-month'>" + monthNames[drawMonth] + "</span>";
} else {
inMinYear = (minDate && minDate.getFullYear() === drawYear);
inMaxYear = (maxDate && maxDate.getFullYear() === drawYear);
monthHtml += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>";
for ( month = 0; month < 12; month++) {
if ((!inMinYear || month >= minDate.getMonth()) && (!inMaxYear || month <= maxDate.getMonth())) {
monthHtml += "<option value='" + month + "'" +
(month === drawMonth ? " selected='selected'" : "") +
">" + monthNamesShort[month] + "</option>";
}
}
monthHtml += "</select>";
}
if (!showMonthAfterYear) {
html += monthHtml + (secondary || !(changeMonth && changeYear) ? "&#xa0;" : "");
}
if ( !inst.yearshtml ) {
inst.yearshtml = "";
if (secondary || !changeYear) {
html += "<span class='ui-datepicker-year'>" + drawYear + "</span>";
} else {
years = this._get(inst, "yearRange").split(":");
thisYear = new Date().getFullYear();
determineYear = function(value) {
var year = (value.match(/c[+\-].*/) ? drawYear + parseInt(value.substring(1), 10) :
(value.match(/[+\-].*/) ? thisYear + parseInt(value, 10) :
parseInt(value, 10)));
return (isNaN(year) ? thisYear : year);
};
year = determineYear(years[0]);
endYear = Math.max(year, determineYear(years[1] || ""));
year = (minDate ? Math.max(year, minDate.getFullYear()) : year);
endYear = (maxDate ? Math.min(endYear, maxDate.getFullYear()) : endYear);
inst.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>";
for (; year <= endYear; year++) {
inst.yearshtml += "<option value='" + year + "'" +
(year === drawYear ? " selected='selected'" : "") +
">" + year + "</option>";
}
inst.yearshtml += "</select>";
html += inst.yearshtml;
inst.yearshtml = null;
}
}
html += this._get(inst, "yearSuffix");
if (showMonthAfterYear) {
html += (secondary || !(changeMonth && changeYear) ? "&#xa0;" : "") + monthHtml;
}
html += "</div>";
return html;
},
_adjustInstDate: function(inst, offset, period) {
var year = inst.drawYear + (period === "Y" ? offset : 0),
month = inst.drawMonth + (period === "M" ? offset : 0),
day = Math.min(inst.selectedDay, this._getDaysInMonth(year, month)) + (period === "D" ? offset : 0),
date = this._restrictMinMax(inst, this._daylightSavingAdjust(new Date(year, month, day)));
inst.selectedDay = date.getDate();
inst.drawMonth = inst.selectedMonth = date.getMonth();
inst.drawYear = inst.selectedYear = date.getFullYear();
if (period === "M" || period === "Y") {
this._notifyChange(inst);
}
},
_restrictMinMax: function(inst, date) {
var minDate = this._getMinMaxDate(inst, "min"),
maxDate = this._getMinMaxDate(inst, "max"),
newDate = (minDate && date < minDate ? minDate : date);
return (maxDate && newDate > maxDate ? maxDate : newDate);
},
_notifyChange: function(inst) {
var onChange = this._get(inst, "onChangeMonthYear");
if (onChange) {
onChange.apply((inst.input ? inst.input[0] : null),
[inst.selectedYear, inst.selectedMonth + 1, inst]);
}
},
_getNumberOfMonths: function(inst) {
var numMonths = this._get(inst, "numberOfMonths");
return (numMonths == null ? [1, 1] : (typeof numMonths === "number" ? [1, numMonths] : numMonths));
},
_getMinMaxDate: function(inst, minMax) {
return this._determineDate(inst, this._get(inst, minMax + "Date"), null);
},
_getDaysInMonth: function(year, month) {
return 32 - this._daylightSavingAdjust(new Date(year, month, 32)).getDate();
},
_getFirstDayOfMonth: function(year, month) {
return new Date(year, month, 1).getDay();
},
_canAdjustMonth: function(inst, offset, curYear, curMonth) {
var numMonths = this._getNumberOfMonths(inst),
date = this._daylightSavingAdjust(new Date(curYear,
curMonth + (offset < 0 ? offset : numMonths[0] * numMonths[1]), 1));
if (offset < 0) {
date.setDate(this._getDaysInMonth(date.getFullYear(), date.getMonth()));
}
return this._isInRange(inst, date);
},
_isInRange: function(inst, date) {
var yearSplit, currentYear,
minDate = this._getMinMaxDate(inst, "min"),
maxDate = this._getMinMaxDate(inst, "max"),
minYear = null,
maxYear = null,
years = this._get(inst, "yearRange");
if (years){
yearSplit = years.split(":");
currentYear = new Date().getFullYear();
minYear = parseInt(yearSplit[0], 10);
maxYear = parseInt(yearSplit[1], 10);
if ( yearSplit[0].match(/[+\-].*/) ) {
minYear += currentYear;
}
if ( yearSplit[1].match(/[+\-].*/) ) {
maxYear += currentYear;
}
}
return ((!minDate || date.getTime() >= minDate.getTime()) &&
(!maxDate || date.getTime() <= maxDate.getTime()) &&
(!minYear || date.getFullYear() >= minYear) &&
(!maxYear || date.getFullYear() <= maxYear));
},
_getFormatConfig: function(inst) {
var shortYearCutoff = this._get(inst, "shortYearCutoff");
shortYearCutoff = (typeof shortYearCutoff !== "string" ? shortYearCutoff :
new Date().getFullYear() % 100 + parseInt(shortYearCutoff, 10));
return {shortYearCutoff: shortYearCutoff,
dayNamesShort: this._get(inst, "dayNamesShort"), dayNames: this._get(inst, "dayNames"),
monthNamesShort: this._get(inst, "monthNamesShort"), monthNames: this._get(inst, "monthNames")};
},
_formatDate: function(inst, day, month, year) {
if (!day) {
inst.currentDay = inst.selectedDay;
inst.currentMonth = inst.selectedMonth;
inst.currentYear = inst.selectedYear;
}
var date = (day ? (typeof day === "object" ? day :
this._daylightSavingAdjust(new Date(year, month, day))) :
this._daylightSavingAdjust(new Date(inst.currentYear, inst.currentMonth, inst.currentDay)));
return this.formatDate(this._get(inst, "dateFormat"), date, this._getFormatConfig(inst));
}
});
function bindHover(dpDiv) {
var selector = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
return dpDiv.delegate(selector, "mouseout", function() {
$(this).removeClass("ui-state-hover");
if (this.className.indexOf("ui-datepicker-prev") !== -1) {
$(this).removeClass("ui-datepicker-prev-hover");
}
if (this.className.indexOf("ui-datepicker-next") !== -1) {
$(this).removeClass("ui-datepicker-next-hover");
}
})
.delegate(selector, "mouseover", function(){
if (!$.datepicker._isDisabledDatepicker( instActive.inline ? dpDiv.parent()[0] : instActive.input[0])) {
$(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover");
$(this).addClass("ui-state-hover");
if (this.className.indexOf("ui-datepicker-prev") !== -1) {
$(this).addClass("ui-datepicker-prev-hover");
}
if (this.className.indexOf("ui-datepicker-next") !== -1) {
$(this).addClass("ui-datepicker-next-hover");
}
}
});
}
function extendRemove(target, props) {
$.extend(target, props);
for (var name in props) {
if (props[name] == null) {
target[name] = props[name];
}
}
return target;
}
$.fn.datepicker = function(options){
if ( !this.length ) {
return this;
}
if (!$.datepicker.initialized) {
$(document).mousedown($.datepicker._checkExternalClick);
$.datepicker.initialized = true;
}
if ($("#"+$.datepicker._mainDivId).length === 0) {
$("body").append($.datepicker.dpDiv);
}
var otherArgs = Array.prototype.slice.call(arguments, 1);
if (typeof options === "string" && (options === "isDisabled" || options === "getDate" || options === "widget")) {
return $.datepicker["_" + options + "Datepicker"].
apply($.datepicker, [this[0]].concat(otherArgs));
}
if (options === "option" && arguments.length === 2 && typeof arguments[1] === "string") {
return $.datepicker["_" + options + "Datepicker"].
apply($.datepicker, [this[0]].concat(otherArgs));
}
return this.each(function() {
typeof options === "string" ?
$.datepicker["_" + options + "Datepicker"].
apply($.datepicker, [this].concat(otherArgs)) :
$.datepicker._attachDatepicker(this, options);
});
};
$.datepicker = new Datepicker();
$.datepicker.initialized = false;
$.datepicker.uuid = new Date().getTime();
$.datepicker.version = "1.10.3";
})(jQuery);
(function( $, undefined ) {
var sizeRelatedOptions = {
buttons: true,
height: true,
maxHeight: true,
maxWidth: true,
minHeight: true,
minWidth: true,
width: true
},
resizableRelatedOptions = {
maxHeight: true,
maxWidth: true,
minHeight: true,
minWidth: true
};
$.widget( "ui.dialog", {
version: "1.10.3",
options: {
appendTo: "body",
autoOpen: true,
buttons: [],
closeOnEscape: true,
closeText: "close",
dialogClass: "",
draggable: true,
hide: null,
height: "auto",
maxHeight: null,
maxWidth: null,
minHeight: 150,
minWidth: 150,
modal: false,
position: {
my: "center",
at: "center",
of: window,
collision: "fit",
using: function( pos ) {
var topOffset = $( this ).css( pos ).offset().top;
if ( topOffset < 0 ) {
$( this ).css( "top", pos.top - topOffset );
}
}
},
resizable: true,
show: null,
title: null,
width: 300,
beforeClose: null,
close: null,
drag: null,
dragStart: null,
dragStop: null,
focus: null,
open: null,
resize: null,
resizeStart: null,
resizeStop: null
},
_create: function() {
this.originalCss = {
display: this.element[0].style.display,
width: this.element[0].style.width,
minHeight: this.element[0].style.minHeight,
maxHeight: this.element[0].style.maxHeight,
height: this.element[0].style.height
};
this.originalPosition = {
parent: this.element.parent(),
index: this.element.parent().children().index( this.element )
};
this.originalTitle = this.element.attr("title");
this.options.title = this.options.title || this.originalTitle;
this._createWrapper();
this.element
.show()
.removeAttr("title")
.addClass("ui-dialog-content ui-widget-content")
.appendTo( this.uiDialog );
this._createTitlebar();
this._createButtonPane();
if ( this.options.draggable && $.fn.draggable ) {
this._makeDraggable();
}
if ( this.options.resizable && $.fn.resizable ) {
this._makeResizable();
}
this._isOpen = false;
},
_init: function() {
if ( this.options.autoOpen ) {
this.open();
}
},
_appendTo: function() {
var element = this.options.appendTo;
if ( element && (element.jquery || element.nodeType) ) {
return $( element );
}
return this.document.find( element || "body" ).eq( 0 );
},
_destroy: function() {
var next,
originalPosition = this.originalPosition;
this._destroyOverlay();
this.element
.removeUniqueId()
.removeClass("ui-dialog-content ui-widget-content")
.css( this.originalCss )
.detach();
this.uiDialog.stop( true, true ).remove();
if ( this.originalTitle ) {
this.element.attr( "title", this.originalTitle );
}
next = originalPosition.parent.children().eq( originalPosition.index );
if ( next.length && next[0] !== this.element[0] ) {
next.before( this.element );
} else {
originalPosition.parent.append( this.element );
}
},
widget: function() {
return this.uiDialog;
},
disable: $.noop,
enable: $.noop,
close: function( event ) {
var that = this;
if ( !this._isOpen || this._trigger( "beforeClose", event ) === false ) {
return;
}
this._isOpen = false;
this._destroyOverlay();
if ( !this.opener.filter(":focusable").focus().length ) {
$( this.document[0].activeElement ).blur();
}
this._hide( this.uiDialog, this.options.hide, function() {
that._trigger( "close", event );
});
},
isOpen: function() {
return this._isOpen;
},
moveToTop: function() {
this._moveToTop();
},
_moveToTop: function( event, silent ) {
var moved = !!this.uiDialog.nextAll(":visible").insertBefore( this.uiDialog ).length;
if ( moved && !silent ) {
this._trigger( "focus", event );
}
return moved;
},
open: function() {
var that = this;
if ( this._isOpen ) {
if ( this._moveToTop() ) {
this._focusTabbable();
}
return;
}
this._isOpen = true;
this.opener = $( this.document[0].activeElement );
this._size();
this._position();
this._createOverlay();
this._moveToTop( null, true );
this._show( this.uiDialog, this.options.show, function() {
that._focusTabbable();
that._trigger("focus");
});
this._trigger("open");
},
_focusTabbable: function() {
var hasFocus = this.element.find("[autofocus]");
if ( !hasFocus.length ) {
hasFocus = this.element.find(":tabbable");
}
if ( !hasFocus.length ) {
hasFocus = this.uiDialogButtonPane.find(":tabbable");
}
if ( !hasFocus.length ) {
hasFocus = this.uiDialogTitlebarClose.filter(":tabbable");
}
if ( !hasFocus.length ) {
hasFocus = this.uiDialog;
}
hasFocus.eq( 0 ).focus();
},
_keepFocus: function( event ) {
function checkFocus() {
var activeElement = this.document[0].activeElement,
isActive = this.uiDialog[0] === activeElement ||
$.contains( this.uiDialog[0], activeElement );
if ( !isActive ) {
this._focusTabbable();
}
}
event.preventDefault();
checkFocus.call( this );
this._delay( checkFocus );
},
_createWrapper: function() {
this.uiDialog = $("<div>")
.addClass( "ui-dialog ui-widget ui-widget-content ui-corner-all ui-front " +
this.options.dialogClass )
.hide()
.attr({
tabIndex: -1,
role: "dialog"
})
.appendTo( this._appendTo() );
this._on( this.uiDialog, {
keydown: function( event ) {
if ( this.options.closeOnEscape && !event.isDefaultPrevented() && event.keyCode &&
event.keyCode === $.ui.keyCode.ESCAPE ) {
event.preventDefault();
this.close( event );
return;
}
if ( event.keyCode !== $.ui.keyCode.TAB ) {
return;
}
var tabbables = this.uiDialog.find(":tabbable"),
first = tabbables.filter(":first"),
last  = tabbables.filter(":last");
if ( ( event.target === last[0] || event.target === this.uiDialog[0] ) && !event.shiftKey ) {
first.focus( 1 );
event.preventDefault();
} else if ( ( event.target === first[0] || event.target === this.uiDialog[0] ) && event.shiftKey ) {
last.focus( 1 );
event.preventDefault();
}
},
mousedown: function( event ) {
if ( this._moveToTop( event ) ) {
this._focusTabbable();
}
}
});
if ( !this.element.find("[aria-describedby]").length ) {
this.uiDialog.attr({
"aria-describedby": this.element.uniqueId().attr("id")
});
}
},
_createTitlebar: function() {
var uiDialogTitle;
this.uiDialogTitlebar = $("<div>")
.addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix")
.prependTo( this.uiDialog );
this._on( this.uiDialogTitlebar, {
mousedown: function( event ) {
if ( !$( event.target ).closest(".ui-dialog-titlebar-close") ) {
this.uiDialog.focus();
}
}
});
this.uiDialogTitlebarClose = $("<button></button>")
.button({
label: this.options.closeText,
icons: {
primary: "ui-icon-closethick"
},
text: false
})
.addClass("ui-dialog-titlebar-close")
.appendTo( this.uiDialogTitlebar );
this._on( this.uiDialogTitlebarClose, {
click: function( event ) {
event.preventDefault();
this.close( event );
}
});
uiDialogTitle = $("<span>")
.uniqueId()
.addClass("ui-dialog-title")
.prependTo( this.uiDialogTitlebar );
this._title( uiDialogTitle );
this.uiDialog.attr({
"aria-labelledby": uiDialogTitle.attr("id")
});
},
_title: function( title ) {
if ( !this.options.title ) {
title.html("&#160;");
}
title.text( this.options.title );
},
_createButtonPane: function() {
this.uiDialogButtonPane = $("<div>")
.addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix");
this.uiButtonSet = $("<div>")
.addClass("ui-dialog-buttonset")
.appendTo( this.uiDialogButtonPane );
this._createButtons();
},
_createButtons: function() {
var that = this,
buttons = this.options.buttons;
this.uiDialogButtonPane.remove();
this.uiButtonSet.empty();
if ( $.isEmptyObject( buttons ) || ($.isArray( buttons ) && !buttons.length) ) {
this.uiDialog.removeClass("ui-dialog-buttons");
return;
}
$.each( buttons, function( name, props ) {
var click, buttonOptions;
props = $.isFunction( props ) ?
{ click: props, text: name } :
props;
props = $.extend( { type: "button" }, props );
click = props.click;
props.click = function() {
click.apply( that.element[0], arguments );
};
buttonOptions = {
icons: props.icons,
text: props.showText
};
delete props.icons;
delete props.showText;
$( "<button></button>", props )
.button( buttonOptions )
.appendTo( that.uiButtonSet );
});
this.uiDialog.addClass("ui-dialog-buttons");
this.uiDialogButtonPane.appendTo( this.uiDialog );
},
_makeDraggable: function() {
var that = this,
options = this.options;
function filteredUi( ui ) {
return {
position: ui.position,
offset: ui.offset
};
}
this.uiDialog.draggable({
cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
handle: ".ui-dialog-titlebar",
containment: "document",
start: function( event, ui ) {
$( this ).addClass("ui-dialog-dragging");
that._blockFrames();
that._trigger( "dragStart", event, filteredUi( ui ) );
},
drag: function( event, ui ) {
that._trigger( "drag", event, filteredUi( ui ) );
},
stop: function( event, ui ) {
options.position = [
ui.position.left - that.document.scrollLeft(),
ui.position.top - that.document.scrollTop()
];
$( this ).removeClass("ui-dialog-dragging");
that._unblockFrames();
that._trigger( "dragStop", event, filteredUi( ui ) );
}
});
},
_makeResizable: function() {
var that = this,
options = this.options,
handles = options.resizable,
position = this.uiDialog.css("position"),
resizeHandles = typeof handles === "string" ?
handles	:
"n,e,s,w,se,sw,ne,nw";
function filteredUi( ui ) {
return {
originalPosition: ui.originalPosition,
originalSize: ui.originalSize,
position: ui.position,
size: ui.size
};
}
this.uiDialog.resizable({
cancel: ".ui-dialog-content",
containment: "document",
alsoResize: this.element,
maxWidth: options.maxWidth,
maxHeight: options.maxHeight,
minWidth: options.minWidth,
minHeight: this._minHeight(),
handles: resizeHandles,
start: function( event, ui ) {
$( this ).addClass("ui-dialog-resizing");
that._blockFrames();
that._trigger( "resizeStart", event, filteredUi( ui ) );
},
resize: function( event, ui ) {
that._trigger( "resize", event, filteredUi( ui ) );
},
stop: function( event, ui ) {
options.height = $( this ).height();
options.width = $( this ).width();
$( this ).removeClass("ui-dialog-resizing");
that._unblockFrames();
that._trigger( "resizeStop", event, filteredUi( ui ) );
}
})
.css( "position", position );
},
_minHeight: function() {
var options = this.options;
return options.height === "auto" ?
options.minHeight :
Math.min( options.minHeight, options.height );
},
_position: function() {
var isVisible = this.uiDialog.is(":visible");
if ( !isVisible ) {
this.uiDialog.show();
}
this.uiDialog.position( this.options.position );
if ( !isVisible ) {
this.uiDialog.hide();
}
},
_setOptions: function( options ) {
var that = this,
resize = false,
resizableOptions = {};
$.each( options, function( key, value ) {
that._setOption( key, value );
if ( key in sizeRelatedOptions ) {
resize = true;
}
if ( key in resizableRelatedOptions ) {
resizableOptions[ key ] = value;
}
});
if ( resize ) {
this._size();
this._position();
}
if ( this.uiDialog.is(":data(ui-resizable)") ) {
this.uiDialog.resizable( "option", resizableOptions );
}
},
_setOption: function( key, value ) {
var isDraggable, isResizable,
uiDialog = this.uiDialog;
if ( key === "dialogClass" ) {
uiDialog
.removeClass( this.options.dialogClass )
.addClass( value );
}
if ( key === "disabled" ) {
return;
}
this._super( key, value );
if ( key === "appendTo" ) {
this.uiDialog.appendTo( this._appendTo() );
}
if ( key === "buttons" ) {
this._createButtons();
}
if ( key === "closeText" ) {
this.uiDialogTitlebarClose.button({
label: "" + value
});
}
if ( key === "draggable" ) {
isDraggable = uiDialog.is(":data(ui-draggable)");
if ( isDraggable && !value ) {
uiDialog.draggable("destroy");
}
if ( !isDraggable && value ) {
this._makeDraggable();
}
}
if ( key === "position" ) {
this._position();
}
if ( key === "resizable" ) {
isResizable = uiDialog.is(":data(ui-resizable)");
if ( isResizable && !value ) {
uiDialog.resizable("destroy");
}
if ( isResizable && typeof value === "string" ) {
uiDialog.resizable( "option", "handles", value );
}
if ( !isResizable && value !== false ) {
this._makeResizable();
}
}
if ( key === "title" ) {
this._title( this.uiDialogTitlebar.find(".ui-dialog-title") );
}
},
_size: function() {
var nonContentHeight, minContentHeight, maxContentHeight,
options = this.options;
this.element.show().css({
width: "auto",
minHeight: 0,
maxHeight: "none",
height: 0
});
if ( options.minWidth > options.width ) {
options.width = options.minWidth;
}
nonContentHeight = this.uiDialog.css({
height: "auto",
width: options.width
})
.outerHeight();
minContentHeight = Math.max( 0, options.minHeight - nonContentHeight );
maxContentHeight = typeof options.maxHeight === "number" ?
Math.max( 0, options.maxHeight - nonContentHeight ) :
"none";
if ( options.height === "auto" ) {
this.element.css({
minHeight: minContentHeight,
maxHeight: maxContentHeight,
height: "auto"
});
} else {
this.element.height( Math.max( 0, options.height - nonContentHeight ) );
}
if (this.uiDialog.is(":data(ui-resizable)") ) {
this.uiDialog.resizable( "option", "minHeight", this._minHeight() );
}
},
_blockFrames: function() {
this.iframeBlocks = this.document.find( "iframe" ).map(function() {
var iframe = $( this );
return $( "<div>" )
.css({
position: "absolute",
width: iframe.outerWidth(),
height: iframe.outerHeight()
})
.appendTo( iframe.parent() )
.offset( iframe.offset() )[0];
});
},
_unblockFrames: function() {
if ( this.iframeBlocks ) {
this.iframeBlocks.remove();
delete this.iframeBlocks;
}
},
_allowInteraction: function( event ) {
if ( $( event.target ).closest(".ui-dialog").length ) {
return true;
}
return !!$( event.target ).closest(".ui-datepicker").length;
},
_createOverlay: function() {
if ( !this.options.modal ) {
return;
}
var that = this,
widgetFullName = this.widgetFullName;
if ( !$.ui.dialog.overlayInstances ) {
this._delay(function() {
if ( $.ui.dialog.overlayInstances ) {
this.document.bind( "focusin.dialog", function( event ) {
if ( !that._allowInteraction( event ) ) {
event.preventDefault();
$(".ui-dialog:visible:last .ui-dialog-content")
.data( widgetFullName )._focusTabbable();
}
});
}
});
}
this.overlay = $("<div>")
.addClass("ui-widget-overlay ui-front")
.appendTo( this._appendTo() );
this._on( this.overlay, {
mousedown: "_keepFocus"
});
$.ui.dialog.overlayInstances++;
},
_destroyOverlay: function() {
if ( !this.options.modal ) {
return;
}
if ( this.overlay ) {
$.ui.dialog.overlayInstances--;
if ( !$.ui.dialog.overlayInstances ) {
this.document.unbind( "focusin.dialog" );
}
this.overlay.remove();
this.overlay = null;
}
}
});
$.ui.dialog.overlayInstances = 0;
if ( $.uiBackCompat !== false ) {
$.widget( "ui.dialog", $.ui.dialog, {
_position: function() {
var position = this.options.position,
myAt = [],
offset = [ 0, 0 ],
isVisible;
if ( position ) {
if ( typeof position === "string" || (typeof position === "object" && "0" in position ) ) {
myAt = position.split ? position.split(" ") : [ position[0], position[1] ];
if ( myAt.length === 1 ) {
myAt[1] = myAt[0];
}
$.each( [ "left", "top" ], function( i, offsetPosition ) {
if ( +myAt[ i ] === myAt[ i ] ) {
offset[ i ] = myAt[ i ];
myAt[ i ] = offsetPosition;
}
});
position = {
my: myAt[0] + (offset[0] < 0 ? offset[0] : "+" + offset[0]) + " " +
myAt[1] + (offset[1] < 0 ? offset[1] : "+" + offset[1]),
at: myAt.join(" ")
};
}
position = $.extend( {}, $.ui.dialog.prototype.options.position, position );
} else {
position = $.ui.dialog.prototype.options.position;
}
isVisible = this.uiDialog.is(":visible");
if ( !isVisible ) {
this.uiDialog.show();
}
this.uiDialog.position( position );
if ( !isVisible ) {
this.uiDialog.hide();
}
}
});
}
}( jQuery ) );
(function( $, undefined ) {
var rvertical = /up|down|vertical/,
rpositivemotion = /up|left|vertical|horizontal/;
$.effects.effect.blind = function( o, done ) {
var el = $( this ),
props = [ "position", "top", "bottom", "left", "right", "height", "width" ],
mode = $.effects.setMode( el, o.mode || "hide" ),
direction = o.direction || "up",
vertical = rvertical.test( direction ),
ref = vertical ? "height" : "width",
ref2 = vertical ? "top" : "left",
motion = rpositivemotion.test( direction ),
animation = {},
show = mode === "show",
wrapper, distance, margin;
if ( el.parent().is( ".ui-effects-wrapper" ) ) {
$.effects.save( el.parent(), props );
} else {
$.effects.save( el, props );
}
el.show();
wrapper = $.effects.createWrapper( el ).css({
overflow: "hidden"
});
distance = wrapper[ ref ]();
margin = parseFloat( wrapper.css( ref2 ) ) || 0;
animation[ ref ] = show ? distance : 0;
if ( !motion ) {
el
.css( vertical ? "bottom" : "right", 0 )
.css( vertical ? "top" : "left", "auto" )
.css({ position: "absolute" });
animation[ ref2 ] = show ? margin : distance + margin;
}
if ( show ) {
wrapper.css( ref, 0 );
if ( ! motion ) {
wrapper.css( ref2, margin + distance );
}
}
wrapper.animate( animation, {
duration: o.duration,
easing: o.easing,
queue: false,
complete: function() {
if ( mode === "hide" ) {
el.hide();
}
$.effects.restore( el, props );
$.effects.removeWrapper( el );
done();
}
});
};
})(jQuery);
(function( $, undefined ) {
$.effects.effect.bounce = function( o, done ) {
var el = $( this ),
props = [ "position", "top", "bottom", "left", "right", "height", "width" ],
mode = $.effects.setMode( el, o.mode || "effect" ),
hide = mode === "hide",
show = mode === "show",
direction = o.direction || "up",
distance = o.distance,
times = o.times || 5,
anims = times * 2 + ( show || hide ? 1 : 0 ),
speed = o.duration / anims,
easing = o.easing,
ref = ( direction === "up" || direction === "down" ) ? "top" : "left",
motion = ( direction === "up" || direction === "left" ),
i,
upAnim,
downAnim,
queue = el.queue(),
queuelen = queue.length;
if ( show || hide ) {
props.push( "opacity" );
}
$.effects.save( el, props );
el.show();
$.effects.createWrapper( el );
if ( !distance ) {
distance = el[ ref === "top" ? "outerHeight" : "outerWidth" ]() / 3;
}
if ( show ) {
downAnim = { opacity: 1 };
downAnim[ ref ] = 0;
el.css( "opacity", 0 )
.css( ref, motion ? -distance * 2 : distance * 2 )
.animate( downAnim, speed, easing );
}
if ( hide ) {
distance = distance / Math.pow( 2, times - 1 );
}
downAnim = {};
downAnim[ ref ] = 0;
for ( i = 0; i < times; i++ ) {
upAnim = {};
upAnim[ ref ] = ( motion ? "-=" : "+=" ) + distance;
el.animate( upAnim, speed, easing )
.animate( downAnim, speed, easing );
distance = hide ? distance * 2 : distance / 2;
}
if ( hide ) {
upAnim = { opacity: 0 };
upAnim[ ref ] = ( motion ? "-=" : "+=" ) + distance;
el.animate( upAnim, speed, easing );
}
el.queue(function() {
if ( hide ) {
el.hide();
}
$.effects.restore( el, props );
$.effects.removeWrapper( el );
done();
});
if ( queuelen > 1) {
queue.splice.apply( queue,
[ 1, 0 ].concat( queue.splice( queuelen, anims + 1 ) ) );
}
el.dequeue();
};
})(jQuery);
(function( $, undefined ) {
$.effects.effect.clip = function( o, done ) {
var el = $( this ),
props = [ "position", "top", "bottom", "left", "right", "height", "width" ],
mode = $.effects.setMode( el, o.mode || "hide" ),
show = mode === "show",
direction = o.direction || "vertical",
vert = direction === "vertical",
size = vert ? "height" : "width",
position = vert ? "top" : "left",
animation = {},
wrapper, animate, distance;
$.effects.save( el, props );
el.show();
wrapper = $.effects.createWrapper( el ).css({
overflow: "hidden"
});
animate = ( el[0].tagName === "IMG" ) ? wrapper : el;
distance = animate[ size ]();
if ( show ) {
animate.css( size, 0 );
animate.css( position, distance / 2 );
}
animation[ size ] = show ? distance : 0;
animation[ position ] = show ? 0 : distance / 2;
animate.animate( animation, {
queue: false,
duration: o.duration,
easing: o.easing,
complete: function() {
if ( !show ) {
el.hide();
}
$.effects.restore( el, props );
$.effects.removeWrapper( el );
done();
}
});
};
})(jQuery);
(function( $, undefined ) {
$.effects.effect.drop = function( o, done ) {
var el = $( this ),
props = [ "position", "top", "bottom", "left", "right", "opacity", "height", "width" ],
mode = $.effects.setMode( el, o.mode || "hide" ),
show = mode === "show",
direction = o.direction || "left",
ref = ( direction === "up" || direction === "down" ) ? "top" : "left",
motion = ( direction === "up" || direction === "left" ) ? "pos" : "neg",
animation = {
opacity: show ? 1 : 0
},
distance;
$.effects.save( el, props );
el.show();
$.effects.createWrapper( el );
distance = o.distance || el[ ref === "top" ? "outerHeight": "outerWidth" ]( true ) / 2;
if ( show ) {
el
.css( "opacity", 0 )
.css( ref, motion === "pos" ? -distance : distance );
}
animation[ ref ] = ( show ?
( motion === "pos" ? "+=" : "-=" ) :
( motion === "pos" ? "-=" : "+=" ) ) +
distance;
el.animate( animation, {
queue: false,
duration: o.duration,
easing: o.easing,
complete: function() {
if ( mode === "hide" ) {
el.hide();
}
$.effects.restore( el, props );
$.effects.removeWrapper( el );
done();
}
});
};
})(jQuery);
(function( $, undefined ) {
$.effects.effect.explode = function( o, done ) {
var rows = o.pieces ? Math.round( Math.sqrt( o.pieces ) ) : 3,
cells = rows,
el = $( this ),
mode = $.effects.setMode( el, o.mode || "hide" ),
show = mode === "show",
offset = el.show().css( "visibility", "hidden" ).offset(),
width = Math.ceil( el.outerWidth() / cells ),
height = Math.ceil( el.outerHeight() / rows ),
pieces = [],
i, j, left, top, mx, my;
function childComplete() {
pieces.push( this );
if ( pieces.length === rows * cells ) {
animComplete();
}
}
for( i = 0; i < rows ; i++ ) {
top = offset.top + i * height;
my = i - ( rows - 1 ) / 2 ;
for( j = 0; j < cells ; j++ ) {
left = offset.left + j * width;
mx = j - ( cells - 1 ) / 2 ;
el
.clone()
.appendTo( "body" )
.wrap( "<div></div>" )
.css({
position: "absolute",
visibility: "visible",
left: -j * width,
top: -i * height
})
.parent()
.addClass( "ui-effects-explode" )
.css({
position: "absolute",
overflow: "hidden",
width: width,
height: height,
left: left + ( show ? mx * width : 0 ),
top: top + ( show ? my * height : 0 ),
opacity: show ? 0 : 1
}).animate({
left: left + ( show ? 0 : mx * width ),
top: top + ( show ? 0 : my * height ),
opacity: show ? 1 : 0
}, o.duration || 500, o.easing, childComplete );
}
}
function animComplete() {
el.css({
visibility: "visible"
});
$( pieces ).remove();
if ( !show ) {
el.hide();
}
done();
}
};
})(jQuery);
(function( $, undefined ) {
$.effects.effect.fade = function( o, done ) {
var el = $( this ),
mode = $.effects.setMode( el, o.mode || "toggle" );
el.animate({
opacity: mode
}, {
queue: false,
duration: o.duration,
easing: o.easing,
complete: done
});
};
})( jQuery );
(function( $, undefined ) {
$.effects.effect.fold = function( o, done ) {
var el = $( this ),
props = [ "position", "top", "bottom", "left", "right", "height", "width" ],
mode = $.effects.setMode( el, o.mode || "hide" ),
show = mode === "show",
hide = mode === "hide",
size = o.size || 15,
percent = /([0-9]+)%/.exec( size ),
horizFirst = !!o.horizFirst,
widthFirst = show !== horizFirst,
ref = widthFirst ? [ "width", "height" ] : [ "height", "width" ],
duration = o.duration / 2,
wrapper, distance,
animation1 = {},
animation2 = {};
$.effects.save( el, props );
el.show();
wrapper = $.effects.createWrapper( el ).css({
overflow: "hidden"
});
distance = widthFirst ?
[ wrapper.width(), wrapper.height() ] :
[ wrapper.height(), wrapper.width() ];
if ( percent ) {
size = parseInt( percent[ 1 ], 10 ) / 100 * distance[ hide ? 0 : 1 ];
}
if ( show ) {
wrapper.css( horizFirst ? {
height: 0,
width: size
} : {
height: size,
width: 0
});
}
animation1[ ref[ 0 ] ] = show ? distance[ 0 ] : size;
animation2[ ref[ 1 ] ] = show ? distance[ 1 ] : 0;
wrapper
.animate( animation1, duration, o.easing )
.animate( animation2, duration, o.easing, function() {
if ( hide ) {
el.hide();
}
$.effects.restore( el, props );
$.effects.removeWrapper( el );
done();
});
};
})(jQuery);
(function( $, undefined ) {
$.effects.effect.highlight = function( o, done ) {
var elem = $( this ),
props = [ "backgroundImage", "backgroundColor", "opacity" ],
mode = $.effects.setMode( elem, o.mode || "show" ),
animation = {
backgroundColor: elem.css( "backgroundColor" )
};
if (mode === "hide") {
animation.opacity = 0;
}
$.effects.save( elem, props );
elem
.show()
.css({
backgroundImage: "none",
backgroundColor: o.color || "#ffff99"
})
.animate( animation, {
queue: false,
duration: o.duration,
easing: o.easing,
complete: function() {
if ( mode === "hide" ) {
elem.hide();
}
$.effects.restore( elem, props );
done();
}
});
};
})(jQuery);
(function( $, undefined ) {
$.effects.effect.pulsate = function( o, done ) {
var elem = $( this ),
mode = $.effects.setMode( elem, o.mode || "show" ),
show = mode === "show",
hide = mode === "hide",
showhide = ( show || mode === "hide" ),
anims = ( ( o.times || 5 ) * 2 ) + ( showhide ? 1 : 0 ),
duration = o.duration / anims,
animateTo = 0,
queue = elem.queue(),
queuelen = queue.length,
i;
if ( show || !elem.is(":visible")) {
elem.css( "opacity", 0 ).show();
animateTo = 1;
}
for ( i = 1; i < anims; i++ ) {
elem.animate({
opacity: animateTo
}, duration, o.easing );
animateTo = 1 - animateTo;
}
elem.animate({
opacity: animateTo
}, duration, o.easing);
elem.queue(function() {
if ( hide ) {
elem.hide();
}
done();
});
if ( queuelen > 1 ) {
queue.splice.apply( queue,
[ 1, 0 ].concat( queue.splice( queuelen, anims + 1 ) ) );
}
elem.dequeue();
};
})(jQuery);
(function( $, undefined ) {
$.effects.effect.puff = function( o, done ) {
var elem = $( this ),
mode = $.effects.setMode( elem, o.mode || "hide" ),
hide = mode === "hide",
percent = parseInt( o.percent, 10 ) || 150,
factor = percent / 100,
original = {
height: elem.height(),
width: elem.width(),
outerHeight: elem.outerHeight(),
outerWidth: elem.outerWidth()
};
$.extend( o, {
effect: "scale",
queue: false,
fade: true,
mode: mode,
complete: done,
percent: hide ? percent : 100,
from: hide ?
original :
{
height: original.height * factor,
width: original.width * factor,
outerHeight: original.outerHeight * factor,
outerWidth: original.outerWidth * factor
}
});
elem.effect( o );
};
$.effects.effect.scale = function( o, done ) {
var el = $( this ),
options = $.extend( true, {}, o ),
mode = $.effects.setMode( el, o.mode || "effect" ),
percent = parseInt( o.percent, 10 ) ||
( parseInt( o.percent, 10 ) === 0 ? 0 : ( mode === "hide" ? 0 : 100 ) ),
direction = o.direction || "both",
origin = o.origin,
original = {
height: el.height(),
width: el.width(),
outerHeight: el.outerHeight(),
outerWidth: el.outerWidth()
},
factor = {
y: direction !== "horizontal" ? (percent / 100) : 1,
x: direction !== "vertical" ? (percent / 100) : 1
};
options.effect = "size";
options.queue = false;
options.complete = done;
if ( mode !== "effect" ) {
options.origin = origin || ["middle","center"];
options.restore = true;
}
options.from = o.from || ( mode === "show" ? {
height: 0,
width: 0,
outerHeight: 0,
outerWidth: 0
} : original );
options.to = {
height: original.height * factor.y,
width: original.width * factor.x,
outerHeight: original.outerHeight * factor.y,
outerWidth: original.outerWidth * factor.x
};
if ( options.fade ) {
if ( mode === "show" ) {
options.from.opacity = 0;
options.to.opacity = 1;
}
if ( mode === "hide" ) {
options.from.opacity = 1;
options.to.opacity = 0;
}
}
el.effect( options );
};
$.effects.effect.size = function( o, done ) {
var original, baseline, factor,
el = $( this ),
props0 = [ "position", "top", "bottom", "left", "right", "width", "height", "overflow", "opacity" ],
props1 = [ "position", "top", "bottom", "left", "right", "overflow", "opacity" ],
props2 = [ "width", "height", "overflow" ],
cProps = [ "fontSize" ],
vProps = [ "borderTopWidth", "borderBottomWidth", "paddingTop", "paddingBottom" ],
hProps = [ "borderLeftWidth", "borderRightWidth", "paddingLeft", "paddingRight" ],
mode = $.effects.setMode( el, o.mode || "effect" ),
restore = o.restore || mode !== "effect",
scale = o.scale || "both",
origin = o.origin || [ "middle", "center" ],
position = el.css( "position" ),
props = restore ? props0 : props1,
zero = {
height: 0,
width: 0,
outerHeight: 0,
outerWidth: 0
};
if ( mode === "show" ) {
el.show();
}
original = {
height: el.height(),
width: el.width(),
outerHeight: el.outerHeight(),
outerWidth: el.outerWidth()
};
if ( o.mode === "toggle" && mode === "show" ) {
el.from = o.to || zero;
el.to = o.from || original;
} else {
el.from = o.from || ( mode === "show" ? zero : original );
el.to = o.to || ( mode === "hide" ? zero : original );
}
factor = {
from: {
y: el.from.height / original.height,
x: el.from.width / original.width
},
to: {
y: el.to.height / original.height,
x: el.to.width / original.width
}
};
if ( scale === "box" || scale === "both" ) {
if ( factor.from.y !== factor.to.y ) {
props = props.concat( vProps );
el.from = $.effects.setTransition( el, vProps, factor.from.y, el.from );
el.to = $.effects.setTransition( el, vProps, factor.to.y, el.to );
}
if ( factor.from.x !== factor.to.x ) {
props = props.concat( hProps );
el.from = $.effects.setTransition( el, hProps, factor.from.x, el.from );
el.to = $.effects.setTransition( el, hProps, factor.to.x, el.to );
}
}
if ( scale === "content" || scale === "both" ) {
if ( factor.from.y !== factor.to.y ) {
props = props.concat( cProps ).concat( props2 );
el.from = $.effects.setTransition( el, cProps, factor.from.y, el.from );
el.to = $.effects.setTransition( el, cProps, factor.to.y, el.to );
}
}
$.effects.save( el, props );
el.show();
$.effects.createWrapper( el );
el.css( "overflow", "hidden" ).css( el.from );
if (origin) {
baseline = $.effects.getBaseline( origin, original );
el.from.top = ( original.outerHeight - el.outerHeight() ) * baseline.y;
el.from.left = ( original.outerWidth - el.outerWidth() ) * baseline.x;
el.to.top = ( original.outerHeight - el.to.outerHeight ) * baseline.y;
el.to.left = ( original.outerWidth - el.to.outerWidth ) * baseline.x;
}
el.css( el.from );
if ( scale === "content" || scale === "both" ) {
vProps = vProps.concat([ "marginTop", "marginBottom" ]).concat(cProps);
hProps = hProps.concat([ "marginLeft", "marginRight" ]);
props2 = props0.concat(vProps).concat(hProps);
el.find( "*[width]" ).each( function(){
var child = $( this ),
c_original = {
height: child.height(),
width: child.width(),
outerHeight: child.outerHeight(),
outerWidth: child.outerWidth()
};
if (restore) {
$.effects.save(child, props2);
}
child.from = {
height: c_original.height * factor.from.y,
width: c_original.width * factor.from.x,
outerHeight: c_original.outerHeight * factor.from.y,
outerWidth: c_original.outerWidth * factor.from.x
};
child.to = {
height: c_original.height * factor.to.y,
width: c_original.width * factor.to.x,
outerHeight: c_original.height * factor.to.y,
outerWidth: c_original.width * factor.to.x
};
if ( factor.from.y !== factor.to.y ) {
child.from = $.effects.setTransition( child, vProps, factor.from.y, child.from );
child.to = $.effects.setTransition( child, vProps, factor.to.y, child.to );
}
if ( factor.from.x !== factor.to.x ) {
child.from = $.effects.setTransition( child, hProps, factor.from.x, child.from );
child.to = $.effects.setTransition( child, hProps, factor.to.x, child.to );
}
child.css( child.from );
child.animate( child.to, o.duration, o.easing, function() {
if ( restore ) {
$.effects.restore( child, props2 );
}
});
});
}
el.animate( el.to, {
queue: false,
duration: o.duration,
easing: o.easing,
complete: function() {
if ( el.to.opacity === 0 ) {
el.css( "opacity", el.from.opacity );
}
if( mode === "hide" ) {
el.hide();
}
$.effects.restore( el, props );
if ( !restore ) {
if ( position === "static" ) {
el.css({
position: "relative",
top: el.to.top,
left: el.to.left
});
} else {
$.each([ "top", "left" ], function( idx, pos ) {
el.css( pos, function( _, str ) {
var val = parseInt( str, 10 ),
toRef = idx ? el.to.left : el.to.top;
if ( str === "auto" ) {
return toRef + "px";
}
return val + toRef + "px";
});
});
}
}
$.effects.removeWrapper( el );
done();
}
});
};
})(jQuery);
(function( $, undefined ) {
$.effects.effect.shake = function( o, done ) {
var el = $( this ),
props = [ "position", "top", "bottom", "left", "right", "height", "width" ],
mode = $.effects.setMode( el, o.mode || "effect" ),
direction = o.direction || "left",
distance = o.distance || 20,
times = o.times || 3,
anims = times * 2 + 1,
speed = Math.round(o.duration/anims),
ref = (direction === "up" || direction === "down") ? "top" : "left",
positiveMotion = (direction === "up" || direction === "left"),
animation = {},
animation1 = {},
animation2 = {},
i,
queue = el.queue(),
queuelen = queue.length;
$.effects.save( el, props );
el.show();
$.effects.createWrapper( el );
animation[ ref ] = ( positiveMotion ? "-=" : "+=" ) + distance;
animation1[ ref ] = ( positiveMotion ? "+=" : "-=" ) + distance * 2;
animation2[ ref ] = ( positiveMotion ? "-=" : "+=" ) + distance * 2;
el.animate( animation, speed, o.easing );
for ( i = 1; i < times; i++ ) {
el.animate( animation1, speed, o.easing ).animate( animation2, speed, o.easing );
}
el
.animate( animation1, speed, o.easing )
.animate( animation, speed / 2, o.easing )
.queue(function() {
if ( mode === "hide" ) {
el.hide();
}
$.effects.restore( el, props );
$.effects.removeWrapper( el );
done();
});
if ( queuelen > 1) {
queue.splice.apply( queue,
[ 1, 0 ].concat( queue.splice( queuelen, anims + 1 ) ) );
}
el.dequeue();
};
})(jQuery);
(function( $, undefined ) {
$.effects.effect.slide = function( o, done ) {
var el = $( this ),
props = [ "position", "top", "bottom", "left", "right", "width", "height" ],
mode = $.effects.setMode( el, o.mode || "show" ),
show = mode === "show",
direction = o.direction || "left",
ref = (direction === "up" || direction === "down") ? "top" : "left",
positiveMotion = (direction === "up" || direction === "left"),
distance,
animation = {};
$.effects.save( el, props );
el.show();
distance = o.distance || el[ ref === "top" ? "outerHeight" : "outerWidth" ]( true );
$.effects.createWrapper( el ).css({
overflow: "hidden"
});
if ( show ) {
el.css( ref, positiveMotion ? (isNaN(distance) ? "-" + distance : -distance) : distance );
}
animation[ ref ] = ( show ?
( positiveMotion ? "+=" : "-=") :
( positiveMotion ? "-=" : "+=")) +
distance;
el.animate( animation, {
queue: false,
duration: o.duration,
easing: o.easing,
complete: function() {
if ( mode === "hide" ) {
el.hide();
}
$.effects.restore( el, props );
$.effects.removeWrapper( el );
done();
}
});
};
})(jQuery);
(function( $, undefined ) {
$.effects.effect.transfer = function( o, done ) {
var elem = $( this ),
target = $( o.to ),
targetFixed = target.css( "position" ) === "fixed",
body = $("body"),
fixTop = targetFixed ? body.scrollTop() : 0,
fixLeft = targetFixed ? body.scrollLeft() : 0,
endPosition = target.offset(),
animation = {
top: endPosition.top - fixTop ,
left: endPosition.left - fixLeft ,
height: target.innerHeight(),
width: target.innerWidth()
},
startPosition = elem.offset(),
transfer = $( "<div class='ui-effects-transfer'></div>" )
.appendTo( document.body )
.addClass( o.className )
.css({
top: startPosition.top - fixTop ,
left: startPosition.left - fixLeft ,
height: elem.innerHeight(),
width: elem.innerWidth(),
position: targetFixed ? "fixed" : "absolute"
})
.animate( animation, o.duration, o.easing, function() {
transfer.remove();
done();
});
};
})(jQuery);
(function( $, undefined ) {
$.widget( "ui.menu", {
version: "1.10.3",
defaultElement: "<ul>",
delay: 300,
options: {
icons: {
submenu: "ui-icon-carat-1-e"
},
menus: "ul",
position: {
my: "left top",
at: "right top"
},
role: "menu",
blur: null,
focus: null,
select: null
},
_create: function() {
this.activeMenu = this.element;
this.mouseHandled = false;
this.element
.uniqueId()
.addClass( "ui-menu ui-widget ui-widget-content ui-corner-all" )
.toggleClass( "ui-menu-icons", !!this.element.find( ".ui-icon" ).length )
.attr({
role: this.options.role,
tabIndex: 0
})
.bind( "click" + this.eventNamespace, $.proxy(function( event ) {
if ( this.options.disabled ) {
event.preventDefault();
}
}, this ));
if ( this.options.disabled ) {
this.element
.addClass( "ui-state-disabled" )
.attr( "aria-disabled", "true" );
}
this._on({
"mousedown .ui-menu-item > a": function( event ) {
event.preventDefault();
},
"click .ui-state-disabled > a": function( event ) {
event.preventDefault();
},
"click .ui-menu-item:has(a)": function( event ) {
var target = $( event.target ).closest( ".ui-menu-item" );
if ( !this.mouseHandled && target.not( ".ui-state-disabled" ).length ) {
this.mouseHandled = true;
this.select( event );
if ( target.has( ".ui-menu" ).length ) {
this.expand( event );
} else if ( !this.element.is( ":focus" ) ) {
this.element.trigger( "focus", [ true ] );
if ( this.active && this.active.parents( ".ui-menu" ).length === 1 ) {
clearTimeout( this.timer );
}
}
}
},
"mouseenter .ui-menu-item": function( event ) {
var target = $( event.currentTarget );
target.siblings().children( ".ui-state-active" ).removeClass( "ui-state-active" );
this.focus( event, target );
},
mouseleave: "collapseAll",
"mouseleave .ui-menu": "collapseAll",
focus: function( event, keepActiveItem ) {
var item = this.active || this.element.children( ".ui-menu-item" ).eq( 0 );
if ( !keepActiveItem ) {
this.focus( event, item );
}
},
blur: function( event ) {
this._delay(function() {
if ( !$.contains( this.element[0], this.document[0].activeElement ) ) {
this.collapseAll( event );
}
});
},
keydown: "_keydown"
});
this.refresh();
this._on( this.document, {
click: function( event ) {
if ( !$( event.target ).closest( ".ui-menu" ).length ) {
this.collapseAll( event );
}
this.mouseHandled = false;
}
});
},
_destroy: function() {
this.element
.removeAttr( "aria-activedescendant" )
.find( ".ui-menu" ).addBack()
.removeClass( "ui-menu ui-widget ui-widget-content ui-corner-all ui-menu-icons" )
.removeAttr( "role" )
.removeAttr( "tabIndex" )
.removeAttr( "aria-labelledby" )
.removeAttr( "aria-expanded" )
.removeAttr( "aria-hidden" )
.removeAttr( "aria-disabled" )
.removeUniqueId()
.show();
this.element.find( ".ui-menu-item" )
.removeClass( "ui-menu-item" )
.removeAttr( "role" )
.removeAttr( "aria-disabled" )
.children( "a" )
.removeUniqueId()
.removeClass( "ui-corner-all ui-state-hover" )
.removeAttr( "tabIndex" )
.removeAttr( "role" )
.removeAttr( "aria-haspopup" )
.children().each( function() {
var elem = $( this );
if ( elem.data( "ui-menu-submenu-carat" ) ) {
elem.remove();
}
});
this.element.find( ".ui-menu-divider" ).removeClass( "ui-menu-divider ui-widget-content" );
},
_keydown: function( event ) {
var match, prev, character, skip, regex,
preventDefault = true;
function escape( value ) {
return value.replace( /[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&" );
}
switch ( event.keyCode ) {
case $.ui.keyCode.PAGE_UP:
this.previousPage( event );
break;
case $.ui.keyCode.PAGE_DOWN:
this.nextPage( event );
break;
case $.ui.keyCode.HOME:
this._move( "first", "first", event );
break;
case $.ui.keyCode.END:
this._move( "last", "last", event );
break;
case $.ui.keyCode.UP:
this.previous( event );
break;
case $.ui.keyCode.DOWN:
this.next( event );
break;
case $.ui.keyCode.LEFT:
this.collapse( event );
break;
case $.ui.keyCode.RIGHT:
if ( this.active && !this.active.is( ".ui-state-disabled" ) ) {
this.expand( event );
}
break;
case $.ui.keyCode.ENTER:
case $.ui.keyCode.SPACE:
this._activate( event );
break;
case $.ui.keyCode.ESCAPE:
this.collapse( event );
break;
default:
preventDefault = false;
prev = this.previousFilter || "";
character = String.fromCharCode( event.keyCode );
skip = false;
clearTimeout( this.filterTimer );
if ( character === prev ) {
skip = true;
} else {
character = prev + character;
}
regex = new RegExp( "^" + escape( character ), "i" );
match = this.activeMenu.children( ".ui-menu-item" ).filter(function() {
return regex.test( $( this ).children( "a" ).text() );
});
match = skip && match.index( this.active.next() ) !== -1 ?
this.active.nextAll( ".ui-menu-item" ) :
match;
if ( !match.length ) {
character = String.fromCharCode( event.keyCode );
regex = new RegExp( "^" + escape( character ), "i" );
match = this.activeMenu.children( ".ui-menu-item" ).filter(function() {
return regex.test( $( this ).children( "a" ).text() );
});
}
if ( match.length ) {
this.focus( event, match );
if ( match.length > 1 ) {
this.previousFilter = character;
this.filterTimer = this._delay(function() {
delete this.previousFilter;
}, 1000 );
} else {
delete this.previousFilter;
}
} else {
delete this.previousFilter;
}
}
if ( preventDefault ) {
event.preventDefault();
}
},
_activate: function( event ) {
if ( !this.active.is( ".ui-state-disabled" ) ) {
if ( this.active.children( "a[aria-haspopup='true']" ).length ) {
this.expand( event );
} else {
this.select( event );
}
}
},
refresh: function() {
var menus,
icon = this.options.icons.submenu,
submenus = this.element.find( this.options.menus );
submenus.filter( ":not(.ui-menu)" )
.addClass( "ui-menu ui-widget ui-widget-content ui-corner-all" )
.hide()
.attr({
role: this.options.role,
"aria-hidden": "true",
"aria-expanded": "false"
})
.each(function() {
var menu = $( this ),
item = menu.prev( "a" ),
submenuCarat = $( "<span>" )
.addClass( "ui-menu-icon ui-icon " + icon )
.data( "ui-menu-submenu-carat", true );
item
.attr( "aria-haspopup", "true" )
.prepend( submenuCarat );
menu.attr( "aria-labelledby", item.attr( "id" ) );
});
menus = submenus.add( this.element );
menus.children( ":not(.ui-menu-item):has(a)" )
.addClass( "ui-menu-item" )
.attr( "role", "presentation" )
.children( "a" )
.uniqueId()
.addClass( "ui-corner-all" )
.attr({
tabIndex: -1,
role: this._itemRole()
});
menus.children( ":not(.ui-menu-item)" ).each(function() {
var item = $( this );
if ( !/[^\-\u2014\u2013\s]/.test( item.text() ) ) {
item.addClass( "ui-widget-content ui-menu-divider" );
}
});
menus.children( ".ui-state-disabled" ).attr( "aria-disabled", "true" );
if ( this.active && !$.contains( this.element[ 0 ], this.active[ 0 ] ) ) {
this.blur();
}
},
_itemRole: function() {
return {
menu: "menuitem",
listbox: "option"
}[ this.options.role ];
},
_setOption: function( key, value ) {
if ( key === "icons" ) {
this.element.find( ".ui-menu-icon" )
.removeClass( this.options.icons.submenu )
.addClass( value.submenu );
}
this._super( key, value );
},
focus: function( event, item ) {
var nested, focused;
this.blur( event, event && event.type === "focus" );
this._scrollIntoView( item );
this.active = item.first();
focused = this.active.children( "a" ).addClass( "ui-state-focus" );
if ( this.options.role ) {
this.element.attr( "aria-activedescendant", focused.attr( "id" ) );
}
this.active
.parent()
.closest( ".ui-menu-item" )
.children( "a:first" )
.addClass( "ui-state-active" );
if ( event && event.type === "keydown" ) {
this._close();
} else {
this.timer = this._delay(function() {
this._close();
}, this.delay );
}
nested = item.children( ".ui-menu" );
if ( nested.length && ( /^mouse/.test( event.type ) ) ) {
this._startOpening(nested);
}
this.activeMenu = item.parent();
this._trigger( "focus", event, { item: item } );
},
_scrollIntoView: function( item ) {
var borderTop, paddingTop, offset, scroll, elementHeight, itemHeight;
if ( this._hasScroll() ) {
borderTop = parseFloat( $.css( this.activeMenu[0], "borderTopWidth" ) ) || 0;
paddingTop = parseFloat( $.css( this.activeMenu[0], "paddingTop" ) ) || 0;
offset = item.offset().top - this.activeMenu.offset().top - borderTop - paddingTop;
scroll = this.activeMenu.scrollTop();
elementHeight = this.activeMenu.height();
itemHeight = item.height();
if ( offset < 0 ) {
this.activeMenu.scrollTop( scroll + offset );
} else if ( offset + itemHeight > elementHeight ) {
this.activeMenu.scrollTop( scroll + offset - elementHeight + itemHeight );
}
}
},
blur: function( event, fromFocus ) {
if ( !fromFocus ) {
clearTimeout( this.timer );
}
if ( !this.active ) {
return;
}
this.active.children( "a" ).removeClass( "ui-state-focus" );
this.active = null;
this._trigger( "blur", event, { item: this.active } );
},
_startOpening: function( submenu ) {
clearTimeout( this.timer );
if ( submenu.attr( "aria-hidden" ) !== "true" ) {
return;
}
this.timer = this._delay(function() {
this._close();
this._open( submenu );
}, this.delay );
},
_open: function( submenu ) {
var position = $.extend({
of: this.active
}, this.options.position );
clearTimeout( this.timer );
this.element.find( ".ui-menu" ).not( submenu.parents( ".ui-menu" ) )
.hide()
.attr( "aria-hidden", "true" );
submenu
.show()
.removeAttr( "aria-hidden" )
.attr( "aria-expanded", "true" )
.position( position );
},
collapseAll: function( event, all ) {
clearTimeout( this.timer );
this.timer = this._delay(function() {
var currentMenu = all ? this.element :
$( event && event.target ).closest( this.element.find( ".ui-menu" ) );
if ( !currentMenu.length ) {
currentMenu = this.element;
}
this._close( currentMenu );
this.blur( event );
this.activeMenu = currentMenu;
}, this.delay );
},
_close: function( startMenu ) {
if ( !startMenu ) {
startMenu = this.active ? this.active.parent() : this.element;
}
startMenu
.find( ".ui-menu" )
.hide()
.attr( "aria-hidden", "true" )
.attr( "aria-expanded", "false" )
.end()
.find( "a.ui-state-active" )
.removeClass( "ui-state-active" );
},
collapse: function( event ) {
var newItem = this.active &&
this.active.parent().closest( ".ui-menu-item", this.element );
if ( newItem && newItem.length ) {
this._close();
this.focus( event, newItem );
}
},
expand: function( event ) {
var newItem = this.active &&
this.active
.children( ".ui-menu " )
.children( ".ui-menu-item" )
.first();
if ( newItem && newItem.length ) {
this._open( newItem.parent() );
this._delay(function() {
this.focus( event, newItem );
});
}
},
next: function( event ) {
this._move( "next", "first", event );
},
previous: function( event ) {
this._move( "prev", "last", event );
},
isFirstItem: function() {
return this.active && !this.active.prevAll( ".ui-menu-item" ).length;
},
isLastItem: function() {
return this.active && !this.active.nextAll( ".ui-menu-item" ).length;
},
_move: function( direction, filter, event ) {
var next;
if ( this.active ) {
if ( direction === "first" || direction === "last" ) {
next = this.active
[ direction === "first" ? "prevAll" : "nextAll" ]( ".ui-menu-item" )
.eq( -1 );
} else {
next = this.active
[ direction + "All" ]( ".ui-menu-item" )
.eq( 0 );
}
}
if ( !next || !next.length || !this.active ) {
next = this.activeMenu.children( ".ui-menu-item" )[ filter ]();
}
this.focus( event, next );
},
nextPage: function( event ) {
var item, base, height;
if ( !this.active ) {
this.next( event );
return;
}
if ( this.isLastItem() ) {
return;
}
if ( this._hasScroll() ) {
base = this.active.offset().top;
height = this.element.height();
this.active.nextAll( ".ui-menu-item" ).each(function() {
item = $( this );
return item.offset().top - base - height < 0;
});
this.focus( event, item );
} else {
this.focus( event, this.activeMenu.children( ".ui-menu-item" )
[ !this.active ? "first" : "last" ]() );
}
},
previousPage: function( event ) {
var item, base, height;
if ( !this.active ) {
this.next( event );
return;
}
if ( this.isFirstItem() ) {
return;
}
if ( this._hasScroll() ) {
base = this.active.offset().top;
height = this.element.height();
this.active.prevAll( ".ui-menu-item" ).each(function() {
item = $( this );
return item.offset().top - base + height > 0;
});
this.focus( event, item );
} else {
this.focus( event, this.activeMenu.children( ".ui-menu-item" ).first() );
}
},
_hasScroll: function() {
return this.element.outerHeight() < this.element.prop( "scrollHeight" );
},
select: function( event ) {
this.active = this.active || $( event.target ).closest( ".ui-menu-item" );
var ui = { item: this.active };
if ( !this.active.has( ".ui-menu" ).length ) {
this.collapseAll( event, true );
}
this._trigger( "select", event, ui );
}
});
}( jQuery ));
(function( $, undefined ) {
$.ui = $.ui || {};
var cachedScrollbarWidth,
max = Math.max,
abs = Math.abs,
round = Math.round,
rhorizontal = /left|center|right/,
rvertical = /top|center|bottom/,
roffset = /[\+\-]\d+(\.[\d]+)?%?/,
rposition = /^\w+/,
rpercent = /%$/,
_position = $.fn.position;
function getOffsets( offsets, width, height ) {
return [
parseFloat( offsets[ 0 ] ) * ( rpercent.test( offsets[ 0 ] ) ? width / 100 : 1 ),
parseFloat( offsets[ 1 ] ) * ( rpercent.test( offsets[ 1 ] ) ? height / 100 : 1 )
];
}
function parseCss( element, property ) {
return parseInt( $.css( element, property ), 10 ) || 0;
}
function getDimensions( elem ) {
var raw = elem[0];
if ( raw.nodeType === 9 ) {
return {
width: elem.width(),
height: elem.height(),
offset: { top: 0, left: 0 }
};
}
if ( $.isWindow( raw ) ) {
return {
width: elem.width(),
height: elem.height(),
offset: { top: elem.scrollTop(), left: elem.scrollLeft() }
};
}
if ( raw.preventDefault ) {
return {
width: 0,
height: 0,
offset: { top: raw.pageY, left: raw.pageX }
};
}
return {
width: elem.outerWidth(),
height: elem.outerHeight(),
offset: elem.offset()
};
}
$.position = {
scrollbarWidth: function() {
if ( cachedScrollbarWidth !== undefined ) {
return cachedScrollbarWidth;
}
var w1, w2,
div = $( "<div style='display:block;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>" ),
innerDiv = div.children()[0];
$( "body" ).append( div );
w1 = innerDiv.offsetWidth;
div.css( "overflow", "scroll" );
w2 = innerDiv.offsetWidth;
if ( w1 === w2 ) {
w2 = div[0].clientWidth;
}
div.remove();
return (cachedScrollbarWidth = w1 - w2);
},
getScrollInfo: function( within ) {
var overflowX = within.isWindow ? "" : within.element.css( "overflow-x" ),
overflowY = within.isWindow ? "" : within.element.css( "overflow-y" ),
hasOverflowX = overflowX === "scroll" ||
( overflowX === "auto" && within.width < within.element[0].scrollWidth ),
hasOverflowY = overflowY === "scroll" ||
( overflowY === "auto" && within.height < within.element[0].scrollHeight );
return {
width: hasOverflowY ? $.position.scrollbarWidth() : 0,
height: hasOverflowX ? $.position.scrollbarWidth() : 0
};
},
getWithinInfo: function( element ) {
var withinElement = $( element || window ),
isWindow = $.isWindow( withinElement[0] );
return {
element: withinElement,
isWindow: isWindow,
offset: withinElement.offset() || { left: 0, top: 0 },
scrollLeft: withinElement.scrollLeft(),
scrollTop: withinElement.scrollTop(),
width: isWindow ? withinElement.width() : withinElement.outerWidth(),
height: isWindow ? withinElement.height() : withinElement.outerHeight()
};
}
};
$.fn.position = function( options ) {
if ( !options || !options.of ) {
return _position.apply( this, arguments );
}
options = $.extend( {}, options );
var atOffset, targetWidth, targetHeight, targetOffset, basePosition, dimensions,
target = $( options.of ),
within = $.position.getWithinInfo( options.within ),
scrollInfo = $.position.getScrollInfo( within ),
collision = ( options.collision || "flip" ).split( " " ),
offsets = {};
dimensions = getDimensions( target );
if ( target[0].preventDefault ) {
options.at = "left top";
}
targetWidth = dimensions.width;
targetHeight = dimensions.height;
targetOffset = dimensions.offset;
basePosition = $.extend( {}, targetOffset );
$.each( [ "my", "at" ], function() {
var pos = ( options[ this ] || "" ).split( " " ),
horizontalOffset,
verticalOffset;
if ( pos.length === 1) {
pos = rhorizontal.test( pos[ 0 ] ) ?
pos.concat( [ "center" ] ) :
rvertical.test( pos[ 0 ] ) ?
[ "center" ].concat( pos ) :
[ "center", "center" ];
}
pos[ 0 ] = rhorizontal.test( pos[ 0 ] ) ? pos[ 0 ] : "center";
pos[ 1 ] = rvertical.test( pos[ 1 ] ) ? pos[ 1 ] : "center";
horizontalOffset = roffset.exec( pos[ 0 ] );
verticalOffset = roffset.exec( pos[ 1 ] );
offsets[ this ] = [
horizontalOffset ? horizontalOffset[ 0 ] : 0,
verticalOffset ? verticalOffset[ 0 ] : 0
];
options[ this ] = [
rposition.exec( pos[ 0 ] )[ 0 ],
rposition.exec( pos[ 1 ] )[ 0 ]
];
});
if ( collision.length === 1 ) {
collision[ 1 ] = collision[ 0 ];
}
if ( options.at[ 0 ] === "right" ) {
basePosition.left += targetWidth;
} else if ( options.at[ 0 ] === "center" ) {
basePosition.left += targetWidth / 2;
}
if ( options.at[ 1 ] === "bottom" ) {
basePosition.top += targetHeight;
} else if ( options.at[ 1 ] === "center" ) {
basePosition.top += targetHeight / 2;
}
atOffset = getOffsets( offsets.at, targetWidth, targetHeight );
basePosition.left += atOffset[ 0 ];
basePosition.top += atOffset[ 1 ];
return this.each(function() {
var collisionPosition, using,
elem = $( this ),
elemWidth = elem.outerWidth(),
elemHeight = elem.outerHeight(),
marginLeft = parseCss( this, "marginLeft" ),
marginTop = parseCss( this, "marginTop" ),
collisionWidth = elemWidth + marginLeft + parseCss( this, "marginRight" ) + scrollInfo.width,
collisionHeight = elemHeight + marginTop + parseCss( this, "marginBottom" ) + scrollInfo.height,
position = $.extend( {}, basePosition ),
myOffset = getOffsets( offsets.my, elem.outerWidth(), elem.outerHeight() );
if ( options.my[ 0 ] === "right" ) {
position.left -= elemWidth;
} else if ( options.my[ 0 ] === "center" ) {
position.left -= elemWidth / 2;
}
if ( options.my[ 1 ] === "bottom" ) {
position.top -= elemHeight;
} else if ( options.my[ 1 ] === "center" ) {
position.top -= elemHeight / 2;
}
position.left += myOffset[ 0 ];
position.top += myOffset[ 1 ];
if ( !$.support.offsetFractions ) {
position.left = round( position.left );
position.top = round( position.top );
}
collisionPosition = {
marginLeft: marginLeft,
marginTop: marginTop
};
$.each( [ "left", "top" ], function( i, dir ) {
if ( $.ui.position[ collision[ i ] ] ) {
$.ui.position[ collision[ i ] ][ dir ]( position, {
targetWidth: targetWidth,
targetHeight: targetHeight,
elemWidth: elemWidth,
elemHeight: elemHeight,
collisionPosition: collisionPosition,
collisionWidth: collisionWidth,
collisionHeight: collisionHeight,
offset: [ atOffset[ 0 ] + myOffset[ 0 ], atOffset [ 1 ] + myOffset[ 1 ] ],
my: options.my,
at: options.at,
within: within,
elem : elem
});
}
});
if ( options.using ) {
using = function( props ) {
var left = targetOffset.left - position.left,
right = left + targetWidth - elemWidth,
top = targetOffset.top - position.top,
bottom = top + targetHeight - elemHeight,
feedback = {
target: {
element: target,
left: targetOffset.left,
top: targetOffset.top,
width: targetWidth,
height: targetHeight
},
element: {
element: elem,
left: position.left,
top: position.top,
width: elemWidth,
height: elemHeight
},
horizontal: right < 0 ? "left" : left > 0 ? "right" : "center",
vertical: bottom < 0 ? "top" : top > 0 ? "bottom" : "middle"
};
if ( targetWidth < elemWidth && abs( left + right ) < targetWidth ) {
feedback.horizontal = "center";
}
if ( targetHeight < elemHeight && abs( top + bottom ) < targetHeight ) {
feedback.vertical = "middle";
}
if ( max( abs( left ), abs( right ) ) > max( abs( top ), abs( bottom ) ) ) {
feedback.important = "horizontal";
} else {
feedback.important = "vertical";
}
options.using.call( this, props, feedback );
};
}
elem.offset( $.extend( position, { using: using } ) );
});
};
$.ui.position = {
fit: {
left: function( position, data ) {
var within = data.within,
withinOffset = within.isWindow ? within.scrollLeft : within.offset.left,
outerWidth = within.width,
collisionPosLeft = position.left - data.collisionPosition.marginLeft,
overLeft = withinOffset - collisionPosLeft,
overRight = collisionPosLeft + data.collisionWidth - outerWidth - withinOffset,
newOverRight;
if ( data.collisionWidth > outerWidth ) {
if ( overLeft > 0 && overRight <= 0 ) {
newOverRight = position.left + overLeft + data.collisionWidth - outerWidth - withinOffset;
position.left += overLeft - newOverRight;
} else if ( overRight > 0 && overLeft <= 0 ) {
position.left = withinOffset;
} else {
if ( overLeft > overRight ) {
position.left = withinOffset + outerWidth - data.collisionWidth;
} else {
position.left = withinOffset;
}
}
} else if ( overLeft > 0 ) {
position.left += overLeft;
} else if ( overRight > 0 ) {
position.left -= overRight;
} else {
position.left = max( position.left - collisionPosLeft, position.left );
}
},
top: function( position, data ) {
var within = data.within,
withinOffset = within.isWindow ? within.scrollTop : within.offset.top,
outerHeight = data.within.height,
collisionPosTop = position.top - data.collisionPosition.marginTop,
overTop = withinOffset - collisionPosTop,
overBottom = collisionPosTop + data.collisionHeight - outerHeight - withinOffset,
newOverBottom;
if ( data.collisionHeight > outerHeight ) {
if ( overTop > 0 && overBottom <= 0 ) {
newOverBottom = position.top + overTop + data.collisionHeight - outerHeight - withinOffset;
position.top += overTop - newOverBottom;
} else if ( overBottom > 0 && overTop <= 0 ) {
position.top = withinOffset;
} else {
if ( overTop > overBottom ) {
position.top = withinOffset + outerHeight - data.collisionHeight;
} else {
position.top = withinOffset;
}
}
} else if ( overTop > 0 ) {
position.top += overTop;
} else if ( overBottom > 0 ) {
position.top -= overBottom;
} else {
position.top = max( position.top - collisionPosTop, position.top );
}
}
},
flip: {
left: function( position, data ) {
var within = data.within,
withinOffset = within.offset.left + within.scrollLeft,
outerWidth = within.width,
offsetLeft = within.isWindow ? within.scrollLeft : within.offset.left,
collisionPosLeft = position.left - data.collisionPosition.marginLeft,
overLeft = collisionPosLeft - offsetLeft,
overRight = collisionPosLeft + data.collisionWidth - outerWidth - offsetLeft,
myOffset = data.my[ 0 ] === "left" ?
-data.elemWidth :
data.my[ 0 ] === "right" ?
data.elemWidth :
0,
atOffset = data.at[ 0 ] === "left" ?
data.targetWidth :
data.at[ 0 ] === "right" ?
-data.targetWidth :
0,
offset = -2 * data.offset[ 0 ],
newOverRight,
newOverLeft;
if ( overLeft < 0 ) {
newOverRight = position.left + myOffset + atOffset + offset + data.collisionWidth - outerWidth - withinOffset;
if ( newOverRight < 0 || newOverRight < abs( overLeft ) ) {
position.left += myOffset + atOffset + offset;
}
}
else if ( overRight > 0 ) {
newOverLeft = position.left - data.collisionPosition.marginLeft + myOffset + atOffset + offset - offsetLeft;
if ( newOverLeft > 0 || abs( newOverLeft ) < overRight ) {
position.left += myOffset + atOffset + offset;
}
}
},
top: function( position, data ) {
var within = data.within,
withinOffset = within.offset.top + within.scrollTop,
outerHeight = within.height,
offsetTop = within.isWindow ? within.scrollTop : within.offset.top,
collisionPosTop = position.top - data.collisionPosition.marginTop,
overTop = collisionPosTop - offsetTop,
overBottom = collisionPosTop + data.collisionHeight - outerHeight - offsetTop,
top = data.my[ 1 ] === "top",
myOffset = top ?
-data.elemHeight :
data.my[ 1 ] === "bottom" ?
data.elemHeight :
0,
atOffset = data.at[ 1 ] === "top" ?
data.targetHeight :
data.at[ 1 ] === "bottom" ?
-data.targetHeight :
0,
offset = -2 * data.offset[ 1 ],
newOverTop,
newOverBottom;
if ( overTop < 0 ) {
newOverBottom = position.top + myOffset + atOffset + offset + data.collisionHeight - outerHeight - withinOffset;
if ( ( position.top + myOffset + atOffset + offset) > overTop && ( newOverBottom < 0 || newOverBottom < abs( overTop ) ) ) {
position.top += myOffset + atOffset + offset;
}
}
else if ( overBottom > 0 ) {
newOverTop = position.top -  data.collisionPosition.marginTop + myOffset + atOffset + offset - offsetTop;
if ( ( position.top + myOffset + atOffset + offset) > overBottom && ( newOverTop > 0 || abs( newOverTop ) < overBottom ) ) {
position.top += myOffset + atOffset + offset;
}
}
}
},
flipfit: {
left: function() {
$.ui.position.flip.left.apply( this, arguments );
$.ui.position.fit.left.apply( this, arguments );
},
top: function() {
$.ui.position.flip.top.apply( this, arguments );
$.ui.position.fit.top.apply( this, arguments );
}
}
};
(function () {
var testElement, testElementParent, testElementStyle, offsetLeft, i,
body = document.getElementsByTagName( "body" )[ 0 ],
div = document.createElement( "div" );
testElement = document.createElement( body ? "div" : "body" );
testElementStyle = {
visibility: "hidden",
width: 0,
height: 0,
border: 0,
margin: 0,
background: "none"
};
if ( body ) {
$.extend( testElementStyle, {
position: "absolute",
left: "-1000px",
top: "-1000px"
});
}
for ( i in testElementStyle ) {
testElement.style[ i ] = testElementStyle[ i ];
}
testElement.appendChild( div );
testElementParent = body || document.documentElement;
testElementParent.insertBefore( testElement, testElementParent.firstChild );
div.style.cssText = "position: absolute; left: 10.7432222px;";
offsetLeft = $( div ).offset().left;
$.support.offsetFractions = offsetLeft > 10 && offsetLeft < 11;
testElement.innerHTML = "";
testElementParent.removeChild( testElement );
})();
}( jQuery ) );
(function( $, undefined ) {
$.widget( "ui.progressbar", {
version: "1.10.3",
options: {
max: 100,
value: 0,
change: null,
complete: null
},
min: 0,
_create: function() {
this.oldValue = this.options.value = this._constrainedValue();
this.element
.addClass( "ui-progressbar ui-widget ui-widget-content ui-corner-all" )
.attr({
role: "progressbar",
"aria-valuemin": this.min
});
this.valueDiv = $( "<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>" )
.appendTo( this.element );
this._refreshValue();
},
_destroy: function() {
this.element
.removeClass( "ui-progressbar ui-widget ui-widget-content ui-corner-all" )
.removeAttr( "role" )
.removeAttr( "aria-valuemin" )
.removeAttr( "aria-valuemax" )
.removeAttr( "aria-valuenow" );
this.valueDiv.remove();
},
value: function( newValue ) {
if ( newValue === undefined ) {
return this.options.value;
}
this.options.value = this._constrainedValue( newValue );
this._refreshValue();
},
_constrainedValue: function( newValue ) {
if ( newValue === undefined ) {
newValue = this.options.value;
}
this.indeterminate = newValue === false;
if ( typeof newValue !== "number" ) {
newValue = 0;
}
return this.indeterminate ? false :
Math.min( this.options.max, Math.max( this.min, newValue ) );
},
_setOptions: function( options ) {
var value = options.value;
delete options.value;
this._super( options );
this.options.value = this._constrainedValue( value );
this._refreshValue();
},
_setOption: function( key, value ) {
if ( key === "max" ) {
value = Math.max( this.min, value );
}
this._super( key, value );
},
_percentage: function() {
return this.indeterminate ? 100 : 100 * ( this.options.value - this.min ) / ( this.options.max - this.min );
},
_refreshValue: function() {
var value = this.options.value,
percentage = this._percentage();
this.valueDiv
.toggle( this.indeterminate || value > this.min )
.toggleClass( "ui-corner-right", value === this.options.max )
.width( percentage.toFixed(0) + "%" );
this.element.toggleClass( "ui-progressbar-indeterminate", this.indeterminate );
if ( this.indeterminate ) {
this.element.removeAttr( "aria-valuenow" );
if ( !this.overlayDiv ) {
this.overlayDiv = $( "<div class='ui-progressbar-overlay'></div>" ).appendTo( this.valueDiv );
}
} else {
this.element.attr({
"aria-valuemax": this.options.max,
"aria-valuenow": value
});
if ( this.overlayDiv ) {
this.overlayDiv.remove();
this.overlayDiv = null;
}
}
if ( this.oldValue !== value ) {
this.oldValue = value;
this._trigger( "change" );
}
if ( value === this.options.max ) {
this._trigger( "complete" );
}
}
});
})( jQuery );
(function( $, undefined ) {
var numPages = 5;
$.widget( "ui.slider", $.ui.mouse, {
version: "1.10.3",
widgetEventPrefix: "slide",
options: {
animate: false,
distance: 0,
max: 100,
min: 0,
orientation: "horizontal",
range: false,
step: 1,
value: 0,
values: null,
change: null,
slide: null,
start: null,
stop: null
},
_create: function() {
this._keySliding = false;
this._mouseSliding = false;
this._animateOff = true;
this._handleIndex = null;
this._detectOrientation();
this._mouseInit();
this.element
.addClass( "ui-slider" +
" ui-slider-" + this.orientation +
" ui-widget" +
" ui-widget-content" +
" ui-corner-all");
this._refresh();
this._setOption( "disabled", this.options.disabled );
this._animateOff = false;
},
_refresh: function() {
this._createRange();
this._createHandles();
this._setupEvents();
this._refreshValue();
},
_createHandles: function() {
var i, handleCount,
options = this.options,
existingHandles = this.element.find( ".ui-slider-handle" ).addClass( "ui-state-default ui-corner-all" ),
handle = "<a class='ui-slider-handle ui-state-default ui-corner-all' href='#'></a>",
handles = [];
handleCount = ( options.values && options.values.length ) || 1;
if ( existingHandles.length > handleCount ) {
existingHandles.slice( handleCount ).remove();
existingHandles = existingHandles.slice( 0, handleCount );
}
for ( i = existingHandles.length; i < handleCount; i++ ) {
handles.push( handle );
}
this.handles = existingHandles.add( $( handles.join( "" ) ).appendTo( this.element ) );
this.handle = this.handles.eq( 0 );
this.handles.each(function( i ) {
$( this ).data( "ui-slider-handle-index", i );
});
},
_createRange: function() {
var options = this.options,
classes = "";
if ( options.range ) {
if ( options.range === true ) {
if ( !options.values ) {
options.values = [ this._valueMin(), this._valueMin() ];
} else if ( options.values.length && options.values.length !== 2 ) {
options.values = [ options.values[0], options.values[0] ];
} else if ( $.isArray( options.values ) ) {
options.values = options.values.slice(0);
}
}
if ( !this.range || !this.range.length ) {
this.range = $( "<div></div>" )
.appendTo( this.element );
classes = "ui-slider-range" +
" ui-widget-header ui-corner-all";
} else {
this.range.removeClass( "ui-slider-range-min ui-slider-range-max" )
.css({
"left": "",
"bottom": ""
});
}
this.range.addClass( classes +
( ( options.range === "min" || options.range === "max" ) ? " ui-slider-range-" + options.range : "" ) );
} else {
this.range = $([]);
}
},
_setupEvents: function() {
var elements = this.handles.add( this.range ).filter( "a" );
this._off( elements );
this._on( elements, this._handleEvents );
this._hoverable( elements );
this._focusable( elements );
},
_destroy: function() {
this.handles.remove();
this.range.remove();
this.element
.removeClass( "ui-slider" +
" ui-slider-horizontal" +
" ui-slider-vertical" +
" ui-widget" +
" ui-widget-content" +
" ui-corner-all" );
this._mouseDestroy();
},
_mouseCapture: function( event ) {
var position, normValue, distance, closestHandle, index, allowed, offset, mouseOverHandle,
that = this,
o = this.options;
if ( o.disabled ) {
return false;
}
this.elementSize = {
width: this.element.outerWidth(),
height: this.element.outerHeight()
};
this.elementOffset = this.element.offset();
position = { x: event.pageX, y: event.pageY };
normValue = this._normValueFromMouse( position );
distance = this._valueMax() - this._valueMin() + 1;
this.handles.each(function( i ) {
var thisDistance = Math.abs( normValue - that.values(i) );
if (( distance > thisDistance ) ||
( distance === thisDistance &&
(i === that._lastChangedValue || that.values(i) === o.min ))) {
distance = thisDistance;
closestHandle = $( this );
index = i;
}
});
allowed = this._start( event, index );
if ( allowed === false ) {
return false;
}
this._mouseSliding = true;
this._handleIndex = index;
closestHandle
.addClass( "ui-state-active" )
.focus();
offset = closestHandle.offset();
mouseOverHandle = !$( event.target ).parents().addBack().is( ".ui-slider-handle" );
this._clickOffset = mouseOverHandle ? { left: 0, top: 0 } : {
left: event.pageX - offset.left - ( closestHandle.width() / 2 ),
top: event.pageY - offset.top -
( closestHandle.height() / 2 ) -
( parseInt( closestHandle.css("borderTopWidth"), 10 ) || 0 ) -
( parseInt( closestHandle.css("borderBottomWidth"), 10 ) || 0) +
( parseInt( closestHandle.css("marginTop"), 10 ) || 0)
};
if ( !this.handles.hasClass( "ui-state-hover" ) ) {
this._slide( event, index, normValue );
}
this._animateOff = true;
return true;
},
_mouseStart: function() {
return true;
},
_mouseDrag: function( event ) {
var position = { x: event.pageX, y: event.pageY },
normValue = this._normValueFromMouse( position );
this._slide( event, this._handleIndex, normValue );
return false;
},
_mouseStop: function( event ) {
this.handles.removeClass( "ui-state-active" );
this._mouseSliding = false;
this._stop( event, this._handleIndex );
this._change( event, this._handleIndex );
this._handleIndex = null;
this._clickOffset = null;
this._animateOff = false;
return false;
},
_detectOrientation: function() {
this.orientation = ( this.options.orientation === "vertical" ) ? "vertical" : "horizontal";
},
_normValueFromMouse: function( position ) {
var pixelTotal,
pixelMouse,
percentMouse,
valueTotal,
valueMouse;
if ( this.orientation === "horizontal" ) {
pixelTotal = this.elementSize.width;
pixelMouse = position.x - this.elementOffset.left - ( this._clickOffset ? this._clickOffset.left : 0 );
} else {
pixelTotal = this.elementSize.height;
pixelMouse = position.y - this.elementOffset.top - ( this._clickOffset ? this._clickOffset.top : 0 );
}
percentMouse = ( pixelMouse / pixelTotal );
if ( percentMouse > 1 ) {
percentMouse = 1;
}
if ( percentMouse < 0 ) {
percentMouse = 0;
}
if ( this.orientation === "vertical" ) {
percentMouse = 1 - percentMouse;
}
valueTotal = this._valueMax() - this._valueMin();
valueMouse = this._valueMin() + percentMouse * valueTotal;
return this._trimAlignValue( valueMouse );
},
_start: function( event, index ) {
var uiHash = {
handle: this.handles[ index ],
value: this.value()
};
if ( this.options.values && this.options.values.length ) {
uiHash.value = this.values( index );
uiHash.values = this.values();
}
return this._trigger( "start", event, uiHash );
},
_slide: function( event, index, newVal ) {
var otherVal,
newValues,
allowed;
if ( this.options.values && this.options.values.length ) {
otherVal = this.values( index ? 0 : 1 );
if ( ( this.options.values.length === 2 && this.options.range === true ) &&
( ( index === 0 && newVal > otherVal) || ( index === 1 && newVal < otherVal ) )
) {
newVal = otherVal;
}
if ( newVal !== this.values( index ) ) {
newValues = this.values();
newValues[ index ] = newVal;
allowed = this._trigger( "slide", event, {
handle: this.handles[ index ],
value: newVal,
values: newValues
} );
otherVal = this.values( index ? 0 : 1 );
if ( allowed !== false ) {
this.values( index, newVal, true );
}
}
} else {
if ( newVal !== this.value() ) {
allowed = this._trigger( "slide", event, {
handle: this.handles[ index ],
value: newVal
} );
if ( allowed !== false ) {
this.value( newVal );
}
}
}
},
_stop: function( event, index ) {
var uiHash = {
handle: this.handles[ index ],
value: this.value()
};
if ( this.options.values && this.options.values.length ) {
uiHash.value = this.values( index );
uiHash.values = this.values();
}
this._trigger( "stop", event, uiHash );
},
_change: function( event, index ) {
if ( !this._keySliding && !this._mouseSliding ) {
var uiHash = {
handle: this.handles[ index ],
value: this.value()
};
if ( this.options.values && this.options.values.length ) {
uiHash.value = this.values( index );
uiHash.values = this.values();
}
this._lastChangedValue = index;
this._trigger( "change", event, uiHash );
}
},
value: function( newValue ) {
if ( arguments.length ) {
this.options.value = this._trimAlignValue( newValue );
this._refreshValue();
this._change( null, 0 );
return;
}
return this._value();
},
values: function( index, newValue ) {
var vals,
newValues,
i;
if ( arguments.length > 1 ) {
this.options.values[ index ] = this._trimAlignValue( newValue );
this._refreshValue();
this._change( null, index );
return;
}
if ( arguments.length ) {
if ( $.isArray( arguments[ 0 ] ) ) {
vals = this.options.values;
newValues = arguments[ 0 ];
for ( i = 0; i < vals.length; i += 1 ) {
vals[ i ] = this._trimAlignValue( newValues[ i ] );
this._change( null, i );
}
this._refreshValue();
} else {
if ( this.options.values && this.options.values.length ) {
return this._values( index );
} else {
return this.value();
}
}
} else {
return this._values();
}
},
_setOption: function( key, value ) {
var i,
valsLength = 0;
if ( key === "range" && this.options.range === true ) {
if ( value === "min" ) {
this.options.value = this._values( 0 );
this.options.values = null;
} else if ( value === "max" ) {
this.options.value = this._values( this.options.values.length-1 );
this.options.values = null;
}
}
if ( $.isArray( this.options.values ) ) {
valsLength = this.options.values.length;
}
$.Widget.prototype._setOption.apply( this, arguments );
switch ( key ) {
case "orientation":
this._detectOrientation();
this.element
.removeClass( "ui-slider-horizontal ui-slider-vertical" )
.addClass( "ui-slider-" + this.orientation );
this._refreshValue();
break;
case "value":
this._animateOff = true;
this._refreshValue();
this._change( null, 0 );
this._animateOff = false;
break;
case "values":
this._animateOff = true;
this._refreshValue();
for ( i = 0; i < valsLength; i += 1 ) {
this._change( null, i );
}
this._animateOff = false;
break;
case "min":
case "max":
this._animateOff = true;
this._refreshValue();
this._animateOff = false;
break;
case "range":
this._animateOff = true;
this._refresh();
this._animateOff = false;
break;
}
},
_value: function() {
var val = this.options.value;
val = this._trimAlignValue( val );
return val;
},
_values: function( index ) {
var val,
vals,
i;
if ( arguments.length ) {
val = this.options.values[ index ];
val = this._trimAlignValue( val );
return val;
} else if ( this.options.values && this.options.values.length ) {
vals = this.options.values.slice();
for ( i = 0; i < vals.length; i+= 1) {
vals[ i ] = this._trimAlignValue( vals[ i ] );
}
return vals;
} else {
return [];
}
},
_trimAlignValue: function( val ) {
if ( val <= this._valueMin() ) {
return this._valueMin();
}
if ( val >= this._valueMax() ) {
return this._valueMax();
}
var step = ( this.options.step > 0 ) ? this.options.step : 1,
valModStep = (val - this._valueMin()) % step,
alignValue = val - valModStep;
if ( Math.abs(valModStep) * 2 >= step ) {
alignValue += ( valModStep > 0 ) ? step : ( -step );
}
return parseFloat( alignValue.toFixed(5) );
},
_valueMin: function() {
return this.options.min;
},
_valueMax: function() {
return this.options.max;
},
_refreshValue: function() {
var lastValPercent, valPercent, value, valueMin, valueMax,
oRange = this.options.range,
o = this.options,
that = this,
animate = ( !this._animateOff ) ? o.animate : false,
_set = {};
if ( this.options.values && this.options.values.length ) {
this.handles.each(function( i ) {
valPercent = ( that.values(i) - that._valueMin() ) / ( that._valueMax() - that._valueMin() ) * 100;
_set[ that.orientation === "horizontal" ? "left" : "bottom" ] = valPercent + "%";
$( this ).stop( 1, 1 )[ animate ? "animate" : "css" ]( _set, o.animate );
if ( that.options.range === true ) {
if ( that.orientation === "horizontal" ) {
if ( i === 0 ) {
that.range.stop( 1, 1 )[ animate ? "animate" : "css" ]( { left: valPercent + "%" }, o.animate );
}
if ( i === 1 ) {
that.range[ animate ? "animate" : "css" ]( { width: ( valPercent - lastValPercent ) + "%" }, { queue: false, duration: o.animate } );
}
} else {
if ( i === 0 ) {
that.range.stop( 1, 1 )[ animate ? "animate" : "css" ]( { bottom: ( valPercent ) + "%" }, o.animate );
}
if ( i === 1 ) {
that.range[ animate ? "animate" : "css" ]( { height: ( valPercent - lastValPercent ) + "%" }, { queue: false, duration: o.animate } );
}
}
}
lastValPercent = valPercent;
});
} else {
value = this.value();
valueMin = this._valueMin();
valueMax = this._valueMax();
valPercent = ( valueMax !== valueMin ) ?
( value - valueMin ) / ( valueMax - valueMin ) * 100 :
0;
_set[ this.orientation === "horizontal" ? "left" : "bottom" ] = valPercent + "%";
this.handle.stop( 1, 1 )[ animate ? "animate" : "css" ]( _set, o.animate );
if ( oRange === "min" && this.orientation === "horizontal" ) {
this.range.stop( 1, 1 )[ animate ? "animate" : "css" ]( { width: valPercent + "%" }, o.animate );
}
if ( oRange === "max" && this.orientation === "horizontal" ) {
this.range[ animate ? "animate" : "css" ]( { width: ( 100 - valPercent ) + "%" }, { queue: false, duration: o.animate } );
}
if ( oRange === "min" && this.orientation === "vertical" ) {
this.range.stop( 1, 1 )[ animate ? "animate" : "css" ]( { height: valPercent + "%" }, o.animate );
}
if ( oRange === "max" && this.orientation === "vertical" ) {
this.range[ animate ? "animate" : "css" ]( { height: ( 100 - valPercent ) + "%" }, { queue: false, duration: o.animate } );
}
}
},
_handleEvents: {
keydown: function( event ) {
var allowed, curVal, newVal, step,
index = $( event.target ).data( "ui-slider-handle-index" );
switch ( event.keyCode ) {
case $.ui.keyCode.HOME:
case $.ui.keyCode.END:
case $.ui.keyCode.PAGE_UP:
case $.ui.keyCode.PAGE_DOWN:
case $.ui.keyCode.UP:
case $.ui.keyCode.RIGHT:
case $.ui.keyCode.DOWN:
case $.ui.keyCode.LEFT:
event.preventDefault();
if ( !this._keySliding ) {
this._keySliding = true;
$( event.target ).addClass( "ui-state-active" );
allowed = this._start( event, index );
if ( allowed === false ) {
return;
}
}
break;
}
step = this.options.step;
if ( this.options.values && this.options.values.length ) {
curVal = newVal = this.values( index );
} else {
curVal = newVal = this.value();
}
switch ( event.keyCode ) {
case $.ui.keyCode.HOME:
newVal = this._valueMin();
break;
case $.ui.keyCode.END:
newVal = this._valueMax();
break;
case $.ui.keyCode.PAGE_UP:
newVal = this._trimAlignValue( curVal + ( (this._valueMax() - this._valueMin()) / numPages ) );
break;
case $.ui.keyCode.PAGE_DOWN:
newVal = this._trimAlignValue( curVal - ( (this._valueMax() - this._valueMin()) / numPages ) );
break;
case $.ui.keyCode.UP:
case $.ui.keyCode.RIGHT:
if ( curVal === this._valueMax() ) {
return;
}
newVal = this._trimAlignValue( curVal + step );
break;
case $.ui.keyCode.DOWN:
case $.ui.keyCode.LEFT:
if ( curVal === this._valueMin() ) {
return;
}
newVal = this._trimAlignValue( curVal - step );
break;
}
this._slide( event, index, newVal );
},
click: function( event ) {
event.preventDefault();
},
keyup: function( event ) {
var index = $( event.target ).data( "ui-slider-handle-index" );
if ( this._keySliding ) {
this._keySliding = false;
this._stop( event, index );
this._change( event, index );
$( event.target ).removeClass( "ui-state-active" );
}
}
}
});
}(jQuery));
(function( $ ) {
function modifier( fn ) {
return function() {
var previous = this.element.val();
fn.apply( this, arguments );
this._refresh();
if ( previous !== this.element.val() ) {
this._trigger( "change" );
}
};
}
$.widget( "ui.spinner", {
version: "1.10.3",
defaultElement: "<input>",
widgetEventPrefix: "spin",
options: {
culture: null,
icons: {
down: "ui-icon-triangle-1-s",
up: "ui-icon-triangle-1-n"
},
incremental: true,
max: null,
min: null,
numberFormat: null,
page: 10,
step: 1,
change: null,
spin: null,
start: null,
stop: null
},
_create: function() {
this._setOption( "max", this.options.max );
this._setOption( "min", this.options.min );
this._setOption( "step", this.options.step );
this._value( this.element.val(), true );
this._draw();
this._on( this._events );
this._refresh();
this._on( this.window, {
beforeunload: function() {
this.element.removeAttr( "autocomplete" );
}
});
},
_getCreateOptions: function() {
var options = {},
element = this.element;
$.each( [ "min", "max", "step" ], function( i, option ) {
var value = element.attr( option );
if ( value !== undefined && value.length ) {
options[ option ] = value;
}
});
return options;
},
_events: {
keydown: function( event ) {
if ( this._start( event ) && this._keydown( event ) ) {
event.preventDefault();
}
},
keyup: "_stop",
focus: function() {
this.previous = this.element.val();
},
blur: function( event ) {
if ( this.cancelBlur ) {
delete this.cancelBlur;
return;
}
this._stop();
this._refresh();
if ( this.previous !== this.element.val() ) {
this._trigger( "change", event );
}
},
mousewheel: function( event, delta ) {
if ( !delta ) {
return;
}
if ( !this.spinning && !this._start( event ) ) {
return false;
}
this._spin( (delta > 0 ? 1 : -1) * this.options.step, event );
clearTimeout( this.mousewheelTimer );
this.mousewheelTimer = this._delay(function() {
if ( this.spinning ) {
this._stop( event );
}
}, 100 );
event.preventDefault();
},
"mousedown .ui-spinner-button": function( event ) {
var previous;
previous = this.element[0] === this.document[0].activeElement ?
this.previous : this.element.val();
function checkFocus() {
var isActive = this.element[0] === this.document[0].activeElement;
if ( !isActive ) {
this.element.focus();
this.previous = previous;
this._delay(function() {
this.previous = previous;
});
}
}
event.preventDefault();
checkFocus.call( this );
this.cancelBlur = true;
this._delay(function() {
delete this.cancelBlur;
checkFocus.call( this );
});
if ( this._start( event ) === false ) {
return;
}
this._repeat( null, $( event.currentTarget ).hasClass( "ui-spinner-up" ) ? 1 : -1, event );
},
"mouseup .ui-spinner-button": "_stop",
"mouseenter .ui-spinner-button": function( event ) {
if ( !$( event.currentTarget ).hasClass( "ui-state-active" ) ) {
return;
}
if ( this._start( event ) === false ) {
return false;
}
this._repeat( null, $( event.currentTarget ).hasClass( "ui-spinner-up" ) ? 1 : -1, event );
},
"mouseleave .ui-spinner-button": "_stop"
},
_draw: function() {
var uiSpinner = this.uiSpinner = this.element
.addClass( "ui-spinner-input" )
.attr( "autocomplete", "off" )
.wrap( this._uiSpinnerHtml() )
.parent()
.append( this._buttonHtml() );
this.element.attr( "role", "spinbutton" );
this.buttons = uiSpinner.find( ".ui-spinner-button" )
.attr( "tabIndex", -1 )
.button()
.removeClass( "ui-corner-all" );
if ( this.buttons.height() > Math.ceil( uiSpinner.height() * 0.5 ) &&
uiSpinner.height() > 0 ) {
uiSpinner.height( uiSpinner.height() );
}
if ( this.options.disabled ) {
this.disable();
}
},
_keydown: function( event ) {
var options = this.options,
keyCode = $.ui.keyCode;
switch ( event.keyCode ) {
case keyCode.UP:
this._repeat( null, 1, event );
return true;
case keyCode.DOWN:
this._repeat( null, -1, event );
return true;
case keyCode.PAGE_UP:
this._repeat( null, options.page, event );
return true;
case keyCode.PAGE_DOWN:
this._repeat( null, -options.page, event );
return true;
}
return false;
},
_uiSpinnerHtml: function() {
return "<span class='ui-spinner ui-widget ui-widget-content ui-corner-all'></span>";
},
_buttonHtml: function() {
return "" +
"<a class='ui-spinner-button ui-spinner-up ui-corner-tr'>" +
"<span class='ui-icon " + this.options.icons.up + "'>&#9650;</span>" +
"</a>" +
"<a class='ui-spinner-button ui-spinner-down ui-corner-br'>" +
"<span class='ui-icon " + this.options.icons.down + "'>&#9660;</span>" +
"</a>";
},
_start: function( event ) {
if ( !this.spinning && this._trigger( "start", event ) === false ) {
return false;
}
if ( !this.counter ) {
this.counter = 1;
}
this.spinning = true;
return true;
},
_repeat: function( i, steps, event ) {
i = i || 500;
clearTimeout( this.timer );
this.timer = this._delay(function() {
this._repeat( 40, steps, event );
}, i );
this._spin( steps * this.options.step, event );
},
_spin: function( step, event ) {
var value = this.value() || 0;
if ( !this.counter ) {
this.counter = 1;
}
value = this._adjustValue( value + step * this._increment( this.counter ) );
if ( !this.spinning || this._trigger( "spin", event, { value: value } ) !== false) {
this._value( value );
this.counter++;
}
},
_increment: function( i ) {
var incremental = this.options.incremental;
if ( incremental ) {
return $.isFunction( incremental ) ?
incremental( i ) :
Math.floor( i*i*i/50000 - i*i/500 + 17*i/200 + 1 );
}
return 1;
},
_precision: function() {
var precision = this._precisionOf( this.options.step );
if ( this.options.min !== null ) {
precision = Math.max( precision, this._precisionOf( this.options.min ) );
}
return precision;
},
_precisionOf: function( num ) {
var str = num.toString(),
decimal = str.indexOf( "." );
return decimal === -1 ? 0 : str.length - decimal - 1;
},
_adjustValue: function( value ) {
var base, aboveMin,
options = this.options;
base = options.min !== null ? options.min : 0;
aboveMin = value - base;
aboveMin = Math.round(aboveMin / options.step) * options.step;
value = base + aboveMin;
value = parseFloat( value.toFixed( this._precision() ) );
if ( options.max !== null && value > options.max) {
return options.max;
}
if ( options.min !== null && value < options.min ) {
return options.min;
}
return value;
},
_stop: function( event ) {
if ( !this.spinning ) {
return;
}
clearTimeout( this.timer );
clearTimeout( this.mousewheelTimer );
this.counter = 0;
this.spinning = false;
this._trigger( "stop", event );
},
_setOption: function( key, value ) {
if ( key === "culture" || key === "numberFormat" ) {
var prevValue = this._parse( this.element.val() );
this.options[ key ] = value;
this.element.val( this._format( prevValue ) );
return;
}
if ( key === "max" || key === "min" || key === "step" ) {
if ( typeof value === "string" ) {
value = this._parse( value );
}
}
if ( key === "icons" ) {
this.buttons.first().find( ".ui-icon" )
.removeClass( this.options.icons.up )
.addClass( value.up );
this.buttons.last().find( ".ui-icon" )
.removeClass( this.options.icons.down )
.addClass( value.down );
}
this._super( key, value );
if ( key === "disabled" ) {
if ( value ) {
this.element.prop( "disabled", true );
this.buttons.button( "disable" );
} else {
this.element.prop( "disabled", false );
this.buttons.button( "enable" );
}
}
},
_setOptions: modifier(function( options ) {
this._super( options );
this._value( this.element.val() );
}),
_parse: function( val ) {
if ( typeof val === "string" && val !== "" ) {
val = window.Globalize && this.options.numberFormat ?
Globalize.parseFloat( val, 10, this.options.culture ) : +val;
}
return val === "" || isNaN( val ) ? null : val;
},
_format: function( value ) {
if ( value === "" ) {
return "";
}
return window.Globalize && this.options.numberFormat ?
Globalize.format( value, this.options.numberFormat, this.options.culture ) :
value;
},
_refresh: function() {
this.element.attr({
"aria-valuemin": this.options.min,
"aria-valuemax": this.options.max,
"aria-valuenow": this._parse( this.element.val() )
});
},
_value: function( value, allowAny ) {
var parsed;
if ( value !== "" ) {
parsed = this._parse( value );
if ( parsed !== null ) {
if ( !allowAny ) {
parsed = this._adjustValue( parsed );
}
value = this._format( parsed );
}
}
this.element.val( value );
this._refresh();
},
_destroy: function() {
this.element
.removeClass( "ui-spinner-input" )
.prop( "disabled", false )
.removeAttr( "autocomplete" )
.removeAttr( "role" )
.removeAttr( "aria-valuemin" )
.removeAttr( "aria-valuemax" )
.removeAttr( "aria-valuenow" );
this.uiSpinner.replaceWith( this.element );
},
stepUp: modifier(function( steps ) {
this._stepUp( steps );
}),
_stepUp: function( steps ) {
if ( this._start() ) {
this._spin( (steps || 1) * this.options.step );
this._stop();
}
},
stepDown: modifier(function( steps ) {
this._stepDown( steps );
}),
_stepDown: function( steps ) {
if ( this._start() ) {
this._spin( (steps || 1) * -this.options.step );
this._stop();
}
},
pageUp: modifier(function( pages ) {
this._stepUp( (pages || 1) * this.options.page );
}),
pageDown: modifier(function( pages ) {
this._stepDown( (pages || 1) * this.options.page );
}),
value: function( newVal ) {
if ( !arguments.length ) {
return this._parse( this.element.val() );
}
modifier( this._value ).call( this, newVal );
},
widget: function() {
return this.uiSpinner;
}
});
}( jQuery ) );
(function( $, undefined ) {
var tabId = 0,
rhash = /#.*$/;
function getNextTabId() {
return ++tabId;
}
function isLocal( anchor ) {
return anchor.hash.length > 1 &&
decodeURIComponent( anchor.href.replace( rhash, "" ) ) ===
decodeURIComponent( location.href.replace( rhash, "" ) );
}
$.widget( "ui.tabs", {
version: "1.10.3",
delay: 300,
options: {
active: null,
collapsible: false,
event: "click",
heightStyle: "content",
hide: null,
show: null,
activate: null,
beforeActivate: null,
beforeLoad: null,
load: null
},
_create: function() {
var that = this,
options = this.options;
this.running = false;
this.element
.addClass( "ui-tabs ui-widget ui-widget-content ui-corner-all" )
.toggleClass( "ui-tabs-collapsible", options.collapsible )
.delegate( ".ui-tabs-nav > li", "mousedown" + this.eventNamespace, function( event ) {
if ( $( this ).is( ".ui-state-disabled" ) ) {
event.preventDefault();
}
})
.delegate( ".ui-tabs-anchor", "focus" + this.eventNamespace, function() {
if ( $( this ).closest( "li" ).is( ".ui-state-disabled" ) ) {
this.blur();
}
});
this._processTabs();
options.active = this._initialActive();
if ( $.isArray( options.disabled ) ) {
options.disabled = $.unique( options.disabled.concat(
$.map( this.tabs.filter( ".ui-state-disabled" ), function( li ) {
return that.tabs.index( li );
})
) ).sort();
}
if ( this.options.active !== false && this.anchors.length ) {
this.active = this._findActive( options.active );
} else {
this.active = $();
}
this._refresh();
if ( this.active.length ) {
this.load( options.active );
}
},
_initialActive: function() {
var active = this.options.active,
collapsible = this.options.collapsible,
locationHash = location.hash.substring( 1 );
if ( active === null ) {
if ( locationHash ) {
this.tabs.each(function( i, tab ) {
if ( $( tab ).attr( "aria-controls" ) === locationHash ) {
active = i;
return false;
}
});
}
if ( active === null ) {
active = this.tabs.index( this.tabs.filter( ".ui-tabs-active" ) );
}
if ( active === null || active === -1 ) {
active = this.tabs.length ? 0 : false;
}
}
if ( active !== false ) {
active = this.tabs.index( this.tabs.eq( active ) );
if ( active === -1 ) {
active = collapsible ? false : 0;
}
}
if ( !collapsible && active === false && this.anchors.length ) {
active = 0;
}
return active;
},
_getCreateEventData: function() {
return {
tab: this.active,
panel: !this.active.length ? $() : this._getPanelForTab( this.active )
};
},
_tabKeydown: function( event ) {
var focusedTab = $( this.document[0].activeElement ).closest( "li" ),
selectedIndex = this.tabs.index( focusedTab ),
goingForward = true;
if ( this._handlePageNav( event ) ) {
return;
}
switch ( event.keyCode ) {
case $.ui.keyCode.RIGHT:
case $.ui.keyCode.DOWN:
selectedIndex++;
break;
case $.ui.keyCode.UP:
case $.ui.keyCode.LEFT:
goingForward = false;
selectedIndex--;
break;
case $.ui.keyCode.END:
selectedIndex = this.anchors.length - 1;
break;
case $.ui.keyCode.HOME:
selectedIndex = 0;
break;
case $.ui.keyCode.SPACE:
event.preventDefault();
clearTimeout( this.activating );
this._activate( selectedIndex );
return;
case $.ui.keyCode.ENTER:
event.preventDefault();
clearTimeout( this.activating );
this._activate( selectedIndex === this.options.active ? false : selectedIndex );
return;
default:
return;
}
event.preventDefault();
clearTimeout( this.activating );
selectedIndex = this._focusNextTab( selectedIndex, goingForward );
if ( !event.ctrlKey ) {
focusedTab.attr( "aria-selected", "false" );
this.tabs.eq( selectedIndex ).attr( "aria-selected", "true" );
this.activating = this._delay(function() {
this.option( "active", selectedIndex );
}, this.delay );
}
},
_panelKeydown: function( event ) {
if ( this._handlePageNav( event ) ) {
return;
}
if ( event.ctrlKey && event.keyCode === $.ui.keyCode.UP ) {
event.preventDefault();
this.active.focus();
}
},
_handlePageNav: function( event ) {
if ( event.altKey && event.keyCode === $.ui.keyCode.PAGE_UP ) {
this._activate( this._focusNextTab( this.options.active - 1, false ) );
return true;
}
if ( event.altKey && event.keyCode === $.ui.keyCode.PAGE_DOWN ) {
this._activate( this._focusNextTab( this.options.active + 1, true ) );
return true;
}
},
_findNextTab: function( index, goingForward ) {
var lastTabIndex = this.tabs.length - 1;
function constrain() {
if ( index > lastTabIndex ) {
index = 0;
}
if ( index < 0 ) {
index = lastTabIndex;
}
return index;
}
while ( $.inArray( constrain(), this.options.disabled ) !== -1 ) {
index = goingForward ? index + 1 : index - 1;
}
return index;
},
_focusNextTab: function( index, goingForward ) {
index = this._findNextTab( index, goingForward );
this.tabs.eq( index ).focus();
return index;
},
_setOption: function( key, value ) {
if ( key === "active" ) {
this._activate( value );
return;
}
if ( key === "disabled" ) {
this._setupDisabled( value );
return;
}
this._super( key, value);
if ( key === "collapsible" ) {
this.element.toggleClass( "ui-tabs-collapsible", value );
if ( !value && this.options.active === false ) {
this._activate( 0 );
}
}
if ( key === "event" ) {
this._setupEvents( value );
}
if ( key === "heightStyle" ) {
this._setupHeightStyle( value );
}
},
_tabId: function( tab ) {
return tab.attr( "aria-controls" ) || "ui-tabs-" + getNextTabId();
},
_sanitizeSelector: function( hash ) {
return hash ? hash.replace( /[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g, "\\$&" ) : "";
},
refresh: function() {
var options = this.options,
lis = this.tablist.children( ":has(a[href])" );
options.disabled = $.map( lis.filter( ".ui-state-disabled" ), function( tab ) {
return lis.index( tab );
});
this._processTabs();
if ( options.active === false || !this.anchors.length ) {
options.active = false;
this.active = $();
} else if ( this.active.length && !$.contains( this.tablist[ 0 ], this.active[ 0 ] ) ) {
if ( this.tabs.length === options.disabled.length ) {
options.active = false;
this.active = $();
} else {
this._activate( this._findNextTab( Math.max( 0, options.active - 1 ), false ) );
}
} else {
options.active = this.tabs.index( this.active );
}
this._refresh();
},
_refresh: function() {
this._setupDisabled( this.options.disabled );
this._setupEvents( this.options.event );
this._setupHeightStyle( this.options.heightStyle );
this.tabs.not( this.active ).attr({
"aria-selected": "false",
tabIndex: -1
});
this.panels.not( this._getPanelForTab( this.active ) )
.hide()
.attr({
"aria-expanded": "false",
"aria-hidden": "true"
});
if ( !this.active.length ) {
this.tabs.eq( 0 ).attr( "tabIndex", 0 );
} else {
this.active
.addClass( "ui-tabs-active ui-state-active" )
.attr({
"aria-selected": "true",
tabIndex: 0
});
this._getPanelForTab( this.active )
.show()
.attr({
"aria-expanded": "true",
"aria-hidden": "false"
});
}
},
_processTabs: function() {
var that = this;
this.tablist = this._getList()
.addClass( "ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" )
.attr( "role", "tablist" );
this.tabs = this.tablist.find( "> li:has(a[href])" )
.addClass( "ui-state-default ui-corner-top" )
.attr({
role: "tab",
tabIndex: -1
});
this.anchors = this.tabs.map(function() {
return $( "a", this )[ 0 ];
})
.addClass( "ui-tabs-anchor" )
.attr({
role: "presentation",
tabIndex: -1
});
this.panels = $();
this.anchors.each(function( i, anchor ) {
var selector, panel, panelId,
anchorId = $( anchor ).uniqueId().attr( "id" ),
tab = $( anchor ).closest( "li" ),
originalAriaControls = tab.attr( "aria-controls" );
if ( isLocal( anchor ) ) {
selector = anchor.hash;
panel = that.element.find( that._sanitizeSelector( selector ) );
} else {
panelId = that._tabId( tab );
selector = "#" + panelId;
panel = that.element.find( selector );
if ( !panel.length ) {
panel = that._createPanel( panelId );
panel.insertAfter( that.panels[ i - 1 ] || that.tablist );
}
panel.attr( "aria-live", "polite" );
}
if ( panel.length) {
that.panels = that.panels.add( panel );
}
if ( originalAriaControls ) {
tab.data( "ui-tabs-aria-controls", originalAriaControls );
}
tab.attr({
"aria-controls": selector.substring( 1 ),
"aria-labelledby": anchorId
});
panel.attr( "aria-labelledby", anchorId );
});
this.panels
.addClass( "ui-tabs-panel ui-widget-content ui-corner-bottom" )
.attr( "role", "tabpanel" );
},
_getList: function() {
return this.element.find( "ol,ul" ).eq( 0 );
},
_createPanel: function( id ) {
return $( "<div>" )
.attr( "id", id )
.addClass( "ui-tabs-panel ui-widget-content ui-corner-bottom" )
.data( "ui-tabs-destroy", true );
},
_setupDisabled: function( disabled ) {
if ( $.isArray( disabled ) ) {
if ( !disabled.length ) {
disabled = false;
} else if ( disabled.length === this.anchors.length ) {
disabled = true;
}
}
for ( var i = 0, li; ( li = this.tabs[ i ] ); i++ ) {
if ( disabled === true || $.inArray( i, disabled ) !== -1 ) {
$( li )
.addClass( "ui-state-disabled" )
.attr( "aria-disabled", "true" );
} else {
$( li )
.removeClass( "ui-state-disabled" )
.removeAttr( "aria-disabled" );
}
}
this.options.disabled = disabled;
},
_setupEvents: function( event ) {
var events = {
click: function( event ) {
event.preventDefault();
}
};
if ( event ) {
$.each( event.split(" "), function( index, eventName ) {
events[ eventName ] = "_eventHandler";
});
}
this._off( this.anchors.add( this.tabs ).add( this.panels ) );
this._on( this.anchors, events );
this._on( this.tabs, { keydown: "_tabKeydown" } );
this._on( this.panels, { keydown: "_panelKeydown" } );
this._focusable( this.tabs );
this._hoverable( this.tabs );
},
_setupHeightStyle: function( heightStyle ) {
var maxHeight,
parent = this.element.parent();
if ( heightStyle === "fill" ) {
maxHeight = parent.height();
maxHeight -= this.element.outerHeight() - this.element.height();
this.element.siblings( ":visible" ).each(function() {
var elem = $( this ),
position = elem.css( "position" );
if ( position === "absolute" || position === "fixed" ) {
return;
}
maxHeight -= elem.outerHeight( true );
});
this.element.children().not( this.panels ).each(function() {
maxHeight -= $( this ).outerHeight( true );
});
this.panels.each(function() {
$( this ).height( Math.max( 0, maxHeight -
$( this ).innerHeight() + $( this ).height() ) );
})
.css( "overflow", "auto" );
} else if ( heightStyle === "auto" ) {
maxHeight = 0;
this.panels.each(function() {
maxHeight = Math.max( maxHeight, $( this ).height( "" ).height() );
}).height( maxHeight );
}
},
_eventHandler: function( event ) {
var options = this.options,
active = this.active,
anchor = $( event.currentTarget ),
tab = anchor.closest( "li" ),
clickedIsActive = tab[ 0 ] === active[ 0 ],
collapsing = clickedIsActive && options.collapsible,
toShow = collapsing ? $() : this._getPanelForTab( tab ),
toHide = !active.length ? $() : this._getPanelForTab( active ),
eventData = {
oldTab: active,
oldPanel: toHide,
newTab: collapsing ? $() : tab,
newPanel: toShow
};
event.preventDefault();
if ( tab.hasClass( "ui-state-disabled" ) ||
tab.hasClass( "ui-tabs-loading" ) ||
this.running ||
( clickedIsActive && !options.collapsible ) ||
( this._trigger( "beforeActivate", event, eventData ) === false ) ) {
return;
}
options.active = collapsing ? false : this.tabs.index( tab );
this.active = clickedIsActive ? $() : tab;
if ( this.xhr ) {
this.xhr.abort();
}
if ( !toHide.length && !toShow.length ) {
$.error( "jQuery UI Tabs: Mismatching fragment identifier." );
}
if ( toShow.length ) {
this.load( this.tabs.index( tab ), event );
}
this._toggle( event, eventData );
},
_toggle: function( event, eventData ) {
var that = this,
toShow = eventData.newPanel,
toHide = eventData.oldPanel;
this.running = true;
function complete() {
that.running = false;
that._trigger( "activate", event, eventData );
}
function show() {
eventData.newTab.closest( "li" ).addClass( "ui-tabs-active ui-state-active" );
if ( toShow.length && that.options.show ) {
that._show( toShow, that.options.show, complete );
} else {
toShow.show();
complete();
}
}
if ( toHide.length && this.options.hide ) {
this._hide( toHide, this.options.hide, function() {
eventData.oldTab.closest( "li" ).removeClass( "ui-tabs-active ui-state-active" );
show();
});
} else {
eventData.oldTab.closest( "li" ).removeClass( "ui-tabs-active ui-state-active" );
toHide.hide();
show();
}
toHide.attr({
"aria-expanded": "false",
"aria-hidden": "true"
});
eventData.oldTab.attr( "aria-selected", "false" );
if ( toShow.length && toHide.length ) {
eventData.oldTab.attr( "tabIndex", -1 );
} else if ( toShow.length ) {
this.tabs.filter(function() {
return $( this ).attr( "tabIndex" ) === 0;
})
.attr( "tabIndex", -1 );
}
toShow.attr({
"aria-expanded": "true",
"aria-hidden": "false"
});
eventData.newTab.attr({
"aria-selected": "true",
tabIndex: 0
});
},
_activate: function( index ) {
var anchor,
active = this._findActive( index );
if ( active[ 0 ] === this.active[ 0 ] ) {
return;
}
if ( !active.length ) {
active = this.active;
}
anchor = active.find( ".ui-tabs-anchor" )[ 0 ];
this._eventHandler({
target: anchor,
currentTarget: anchor,
preventDefault: $.noop
});
},
_findActive: function( index ) {
return index === false ? $() : this.tabs.eq( index );
},
_getIndex: function( index ) {
if ( typeof index === "string" ) {
index = this.anchors.index( this.anchors.filter( "[href$='" + index + "']" ) );
}
return index;
},
_destroy: function() {
if ( this.xhr ) {
this.xhr.abort();
}
this.element.removeClass( "ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible" );
this.tablist
.removeClass( "ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" )
.removeAttr( "role" );
this.anchors
.removeClass( "ui-tabs-anchor" )
.removeAttr( "role" )
.removeAttr( "tabIndex" )
.removeUniqueId();
this.tabs.add( this.panels ).each(function() {
if ( $.data( this, "ui-tabs-destroy" ) ) {
$( this ).remove();
} else {
$( this )
.removeClass( "ui-state-default ui-state-active ui-state-disabled " +
"ui-corner-top ui-corner-bottom ui-widget-content ui-tabs-active ui-tabs-panel" )
.removeAttr( "tabIndex" )
.removeAttr( "aria-live" )
.removeAttr( "aria-busy" )
.removeAttr( "aria-selected" )
.removeAttr( "aria-labelledby" )
.removeAttr( "aria-hidden" )
.removeAttr( "aria-expanded" )
.removeAttr( "role" );
}
});
this.tabs.each(function() {
var li = $( this ),
prev = li.data( "ui-tabs-aria-controls" );
if ( prev ) {
li
.attr( "aria-controls", prev )
.removeData( "ui-tabs-aria-controls" );
} else {
li.removeAttr( "aria-controls" );
}
});
this.panels.show();
if ( this.options.heightStyle !== "content" ) {
this.panels.css( "height", "" );
}
},
enable: function( index ) {
var disabled = this.options.disabled;
if ( disabled === false ) {
return;
}
if ( index === undefined ) {
disabled = false;
} else {
index = this._getIndex( index );
if ( $.isArray( disabled ) ) {
disabled = $.map( disabled, function( num ) {
return num !== index ? num : null;
});
} else {
disabled = $.map( this.tabs, function( li, num ) {
return num !== index ? num : null;
});
}
}
this._setupDisabled( disabled );
},
disable: function( index ) {
var disabled = this.options.disabled;
if ( disabled === true ) {
return;
}
if ( index === undefined ) {
disabled = true;
} else {
index = this._getIndex( index );
if ( $.inArray( index, disabled ) !== -1 ) {
return;
}
if ( $.isArray( disabled ) ) {
disabled = $.merge( [ index ], disabled ).sort();
} else {
disabled = [ index ];
}
}
this._setupDisabled( disabled );
},
load: function( index, event ) {
index = this._getIndex( index );
var that = this,
tab = this.tabs.eq( index ),
anchor = tab.find( ".ui-tabs-anchor" ),
panel = this._getPanelForTab( tab ),
eventData = {
tab: tab,
panel: panel
};
if ( isLocal( anchor[ 0 ] ) ) {
return;
}
this.xhr = $.ajax( this._ajaxSettings( anchor, event, eventData ) );
if ( this.xhr && this.xhr.statusText !== "canceled" ) {
tab.addClass( "ui-tabs-loading" );
panel.attr( "aria-busy", "true" );
this.xhr
.success(function( response ) {
setTimeout(function() {
panel.html( response );
that._trigger( "load", event, eventData );
}, 1 );
})
.complete(function( jqXHR, status ) {
setTimeout(function() {
if ( status === "abort" ) {
that.panels.stop( false, true );
}
tab.removeClass( "ui-tabs-loading" );
panel.removeAttr( "aria-busy" );
if ( jqXHR === that.xhr ) {
delete that.xhr;
}
}, 1 );
});
}
},
_ajaxSettings: function( anchor, event, eventData ) {
var that = this;
return {
url: anchor.attr( "href" ),
beforeSend: function( jqXHR, settings ) {
return that._trigger( "beforeLoad", event,
$.extend( { jqXHR : jqXHR, ajaxSettings: settings }, eventData ) );
}
};
},
_getPanelForTab: function( tab ) {
var id = $( tab ).attr( "aria-controls" );
return this.element.find( this._sanitizeSelector( "#" + id ) );
}
});
})( jQuery );
(function( $ ) {
var increments = 0;
function addDescribedBy( elem, id ) {
var describedby = (elem.attr( "aria-describedby" ) || "").split( /\s+/ );
describedby.push( id );
elem
.data( "ui-tooltip-id", id )
.attr( "aria-describedby", $.trim( describedby.join( " " ) ) );
}
function removeDescribedBy( elem ) {
var id = elem.data( "ui-tooltip-id" ),
describedby = (elem.attr( "aria-describedby" ) || "").split( /\s+/ ),
index = $.inArray( id, describedby );
if ( index !== -1 ) {
describedby.splice( index, 1 );
}
elem.removeData( "ui-tooltip-id" );
describedby = $.trim( describedby.join( " " ) );
if ( describedby ) {
elem.attr( "aria-describedby", describedby );
} else {
elem.removeAttr( "aria-describedby" );
}
}
$.widget( "ui.tooltip", {
version: "1.10.3",
options: {
content: function() {
var title = $( this ).attr( "title" ) || "";
return $( "<a>" ).text( title ).html();
},
hide: true,
items: "[title]:not([disabled])",
position: {
my: "left top+15",
at: "left bottom",
collision: "flipfit flip"
},
show: true,
tooltipClass: null,
track: false,
close: null,
open: null
},
_create: function() {
this._on({
mouseover: "open",
focusin: "open"
});
this.tooltips = {};
this.parents = {};
if ( this.options.disabled ) {
this._disable();
}
},
_setOption: function( key, value ) {
var that = this;
if ( key === "disabled" ) {
this[ value ? "_disable" : "_enable" ]();
this.options[ key ] = value;
return;
}
this._super( key, value );
if ( key === "content" ) {
$.each( this.tooltips, function( id, element ) {
that._updateContent( element );
});
}
},
_disable: function() {
var that = this;
$.each( this.tooltips, function( id, element ) {
var event = $.Event( "blur" );
event.target = event.currentTarget = element[0];
that.close( event, true );
});
this.element.find( this.options.items ).addBack().each(function() {
var element = $( this );
if ( element.is( "[title]" ) ) {
element
.data( "ui-tooltip-title", element.attr( "title" ) )
.attr( "title", "" );
}
});
},
_enable: function() {
this.element.find( this.options.items ).addBack().each(function() {
var element = $( this );
if ( element.data( "ui-tooltip-title" ) ) {
element.attr( "title", element.data( "ui-tooltip-title" ) );
}
});
},
open: function( event ) {
var that = this,
target = $( event ? event.target : this.element )
.closest( this.options.items );
if ( !target.length || target.data( "ui-tooltip-id" ) ) {
return;
}
if ( target.attr( "title" ) ) {
target.data( "ui-tooltip-title", target.attr( "title" ) );
}
target.data( "ui-tooltip-open", true );
if ( event && event.type === "mouseover" ) {
target.parents().each(function() {
var parent = $( this ),
blurEvent;
if ( parent.data( "ui-tooltip-open" ) ) {
blurEvent = $.Event( "blur" );
blurEvent.target = blurEvent.currentTarget = this;
that.close( blurEvent, true );
}
if ( parent.attr( "title" ) ) {
parent.uniqueId();
that.parents[ this.id ] = {
element: this,
title: parent.attr( "title" )
};
parent.attr( "title", "" );
}
});
}
this._updateContent( target, event );
},
_updateContent: function( target, event ) {
var content,
contentOption = this.options.content,
that = this,
eventType = event ? event.type : null;
if ( typeof contentOption === "string" ) {
return this._open( event, target, contentOption );
}
content = contentOption.call( target[0], function( response ) {
if ( !target.data( "ui-tooltip-open" ) ) {
return;
}
that._delay(function() {
if ( event ) {
event.type = eventType;
}
this._open( event, target, response );
});
});
if ( content ) {
this._open( event, target, content );
}
},
_open: function( event, target, content ) {
var tooltip, events, delayedShow,
positionOption = $.extend( {}, this.options.position );
if ( !content ) {
return;
}
tooltip = this._find( target );
if ( tooltip.length ) {
tooltip.find( ".ui-tooltip-content" ).html( content );
return;
}
if ( target.is( "[title]" ) ) {
if ( event && event.type === "mouseover" ) {
target.attr( "title", "" );
} else {
target.removeAttr( "title" );
}
}
tooltip = this._tooltip( target );
addDescribedBy( target, tooltip.attr( "id" ) );
tooltip.find( ".ui-tooltip-content" ).html( content );
function position( event ) {
positionOption.of = event;
if ( tooltip.is( ":hidden" ) ) {
return;
}
tooltip.position( positionOption );
}
if ( this.options.track && event && /^mouse/.test( event.type ) ) {
this._on( this.document, {
mousemove: position
});
position( event );
} else {
tooltip.position( $.extend({
of: target
}, this.options.position ) );
}
tooltip.hide();
this._show( tooltip, this.options.show );
if ( this.options.show && this.options.show.delay ) {
delayedShow = this.delayedShow = setInterval(function() {
if ( tooltip.is( ":visible" ) ) {
position( positionOption.of );
clearInterval( delayedShow );
}
}, $.fx.interval );
}
this._trigger( "open", event, { tooltip: tooltip } );
events = {
keyup: function( event ) {
if ( event.keyCode === $.ui.keyCode.ESCAPE ) {
var fakeEvent = $.Event(event);
fakeEvent.currentTarget = target[0];
this.close( fakeEvent, true );
}
},
remove: function() {
this._removeTooltip( tooltip );
}
};
if ( !event || event.type === "mouseover" ) {
events.mouseleave = "close";
}
if ( !event || event.type === "focusin" ) {
events.focusout = "close";
}
this._on( true, target, events );
},
close: function( event ) {
var that = this,
target = $( event ? event.currentTarget : this.element ),
tooltip = this._find( target );
if ( this.closing ) {
return;
}
clearInterval( this.delayedShow );
if ( target.data( "ui-tooltip-title" ) ) {
target.attr( "title", target.data( "ui-tooltip-title" ) );
}
removeDescribedBy( target );
tooltip.stop( true );
this._hide( tooltip, this.options.hide, function() {
that._removeTooltip( $( this ) );
});
target.removeData( "ui-tooltip-open" );
this._off( target, "mouseleave focusout keyup" );
if ( target[0] !== this.element[0] ) {
this._off( target, "remove" );
}
this._off( this.document, "mousemove" );
if ( event && event.type === "mouseleave" ) {
$.each( this.parents, function( id, parent ) {
$( parent.element ).attr( "title", parent.title );
delete that.parents[ id ];
});
}
this.closing = true;
this._trigger( "close", event, { tooltip: tooltip } );
this.closing = false;
},
_tooltip: function( element ) {
var id = "ui-tooltip-" + increments++,
tooltip = $( "<div>" )
.attr({
id: id,
role: "tooltip"
})
.addClass( "ui-tooltip ui-widget ui-corner-all ui-widget-content " +
( this.options.tooltipClass || "" ) );
$( "<div>" )
.addClass( "ui-tooltip-content" )
.appendTo( tooltip );
tooltip.appendTo( this.document[0].body );
this.tooltips[ id ] = element;
return tooltip;
},
_find: function( target ) {
var id = target.data( "ui-tooltip-id" );
return id ? $( "#" + id ) : $();
},
_removeTooltip: function( tooltip ) {
tooltip.remove();
delete this.tooltips[ tooltip.attr( "id" ) ];
},
_destroy: function() {
var that = this;
$.each( this.tooltips, function( id, element ) {
var event = $.Event( "blur" );
event.target = event.currentTarget = element[0];
that.close( event, true );
$( "#" + id ).remove();
if ( element.data( "ui-tooltip-title" ) ) {
element.attr( "title", element.data( "ui-tooltip-title" ) );
element.removeData( "ui-tooltip-title" );
}
});
}
});
}( jQuery ) );
var Drag = {
obj : null,
init : function(o, oRoot, minX, maxX, minY, maxY, bSwapHorzRef, bSwapVertRef, fXMapper, fYMapper)
{
o.onmousedown	= Drag.start;
o.hmode			= bSwapHorzRef ? false : true ;
o.vmode			= bSwapVertRef ? false : true ;
o.root = oRoot && oRoot != null ? oRoot : o ;
if (o.hmode  && isNaN(parseInt(o.root.style.left  ))) o.root.style.left   = "0px";
if (o.vmode  && isNaN(parseInt(o.root.style.top   ))) o.root.style.top    = "0px";
if (!o.hmode && isNaN(parseInt(o.root.style.right ))) o.root.style.right  = "0px";
if (!o.vmode && isNaN(parseInt(o.root.style.bottom))) o.root.style.bottom = "0px";
o.minX	= typeof minX != 'undefined' ? minX : null;
o.minY	= typeof minY != 'undefined' ? minY : null;
o.maxX	= typeof maxX != 'undefined' ? maxX : null;
o.maxY	= typeof maxY != 'undefined' ? maxY : null;
o.xMapper = fXMapper ? fXMapper : null;
o.yMapper = fYMapper ? fYMapper : null;
o.root.onDragStart	= new Function();
o.root.onDragEnd	= new Function();
o.root.onDrag		= new Function();
},
start : function(e)
{
var o = Drag.obj = this;
e = Drag.fixE(e);
var y = parseInt(o.vmode ? o.root.style.top  : o.root.style.bottom);
var x = parseInt(o.hmode ? o.root.style.left : o.root.style.right );
o.root.onDragStart(x, y);
o.lastMouseX	= e.clientX;
o.lastMouseY	= e.clientY;
if (o.hmode) {
if (o.minX != null)	o.minMouseX	= e.clientX - x + o.minX;
if (o.maxX != null)	o.maxMouseX	= o.minMouseX + o.maxX - o.minX;
} else {
if (o.minX != null) o.maxMouseX = -o.minX + e.clientX + x;
if (o.maxX != null) o.minMouseX = -o.maxX + e.clientX + x;
}
if (o.vmode) {
if (o.minY != null)	o.minMouseY	= e.clientY - y + o.minY;
if (o.maxY != null)	o.maxMouseY	= o.minMouseY + o.maxY - o.minY;
} else {
if (o.minY != null) o.maxMouseY = -o.minY + e.clientY + y;
if (o.maxY != null) o.minMouseY = -o.maxY + e.clientY + y;
}
document.onmousemove	= Drag.drag;
document.onmouseup		= Drag.end;
return false;
},
drag : function(e)
{
e = Drag.fixE(e);
var o = Drag.obj;
var ey	= e.clientY;
var ex	= e.clientX;
var y = parseInt(o.vmode ? o.root.style.top  : o.root.style.bottom);
var x = parseInt(o.hmode ? o.root.style.left : o.root.style.right );
var nx, ny;
if (o.minX != null) ex = o.hmode ? Math.max(ex, o.minMouseX) : Math.min(ex, o.maxMouseX);
if (o.maxX != null) ex = o.hmode ? Math.min(ex, o.maxMouseX) : Math.max(ex, o.minMouseX);
if (o.minY != null) ey = o.vmode ? Math.max(ey, o.minMouseY) : Math.min(ey, o.maxMouseY);
if (o.maxY != null) ey = o.vmode ? Math.min(ey, o.maxMouseY) : Math.max(ey, o.minMouseY);
nx = x + ((ex - o.lastMouseX) * (o.hmode ? 1 : -1));
ny = y + ((ey - o.lastMouseY) * (o.vmode ? 1 : -1));
if (o.xMapper)		nx = o.xMapper(y)
else if (o.yMapper)	ny = o.yMapper(x)
Drag.obj.root.style[o.hmode ? "left" : "right"] = nx + "px";
Drag.obj.root.style[o.vmode ? "top" : "bottom"] = ny + "px";
Drag.obj.lastMouseX	= ex;
Drag.obj.lastMouseY	= ey;
Drag.obj.root.onDrag(nx, ny);
return false;
},
end : function()
{
document.onmousemove = null;
document.onmouseup   = null;
Drag.obj.root.onDragEnd(	parseInt(Drag.obj.root.style[Drag.obj.hmode ? "left" : "right"]),
parseInt(Drag.obj.root.style[Drag.obj.vmode ? "top" : "bottom"]));
Drag.obj = null;
},
fixE : function(e)
{
if (typeof e == 'undefined') e = window.event;
if (typeof e.layerX == 'undefined') e.layerX = e.offsetX;
if (typeof e.layerY == 'undefined') e.layerY = e.offsetY;
return e;
}
};
function divOsClass(name) {
this.name = name;
this.waitTip=false;
this.AjaxEdit = new AjaxEdit(name);
this.sajaxIO = this.AjaxEdit.sajaxIO;
this.Cookie = new Cookie();
this.setDebug(0);
this.tagTitleVisibleStyle = "active";
this.tagTitleInVisibleStyle = "inactive";
this.tagContentVisibleStyle = "showThis";
this.tagContentInVisibleStyle = "hideThis";
this.waitWord = "Please waiting...";
this.contentDivPrefix = "C";
this.TagDivPrefix = "T";
this.ResizeFix = "0";
this.tagSeq = 10;
this.popSeq = 10;
this.act="";
this.imagedir = "images";
this.styledir = "style";
this.hashTable = new hashUtil();
this.tagUrl = new hashUtil();
this.divConent = new hashUtil();
this.hashTable.put("home",0);
this.TagName = "C0";
this.AdminTag="_epage_tags";
this.popHandle = new hashUtil();
this.closeTagHtml = "<div onclick='"+this.name+".selectTag(===TAG===)'><div><a href=\"javascript:void(0)\" class=\"close\" title=\"\" onclick='"+this.name+".delTag(===TAG===);event.cancelBubble=true'><img src=\""+this.imagedir+"/clear.gif\" alt=\"close\" /></a><a href=\"javascript:void(0)\"><img src=\"===ICON===\" align=\"absmiddle\" alt=\"\" />&nbsp;===TITLE===</a></div></div>	";
this.Info = new Array();
this.getBrowser();
this.position="";
this.onloadFuncs = new Array();
this.onloadFailFuncs = new Array();
this.onloadTimeOut = 500;
this.onloadCount = 0;
this.onloadPoint = 0;
this.onloadStart = 1;
return this;
}
var tempHideDiv="";
divOsClass.prototype.AlertSuccess= 100;
divOsClass.prototype.AlertFailed = 101;
divOsClass.prototype.AlertWait= 102;
divOsClass.prototype.AlertNote= 103;
divOsClass.prototype.setInfo = function(p_word,p_info) {
p_word = p_word.replace("-","_");
eval("this."+p_word+"='"+p_info+"'");
}
divOsClass.prototype.getInfo = function(p_word) {
p_word = p_word.replace("-","_");
return eval("this."+p_word);
}
divOsClass.prototype.refreshCloseTagHtml = function() {
this.closeTagHtml = "<div onclick='"+this.name+".selectTag(===TAG===)'><div><a href=\"javascript:void(0)\" class=\"close\" title=\"\" onclick='"+this.name+".delTag(===TAG===);event.cancelBubble=true'><img src=\""+this.imagedir+"/clear.gif\" alt=\"close\" /></a><a href=\"javascript:void(0)\"><img src=\"===ICON===\" align=\"absmiddle\" alt=\"\" />&nbsp;===TITLE===</a></div></div>	";
}
divOsClass.prototype.getBrowser = function() {
var navi = window.navigator.userAgent.toUpperCase();
if (navi.indexOf("MSIE")>=1) this.browser = "IE";
else if (navi.indexOf("FIREFOX")>=1) this.browser = "FF";
return this.browser;
}
divOsClass.prototype.setTagDiv = function(tagname) {
this.tagDivName = tagname;
this.tagDiv = document.getElementById(tagname);
}
divOsClass.prototype.setContentDiv = function(main) {
this.contentDivName = main;
this.contentDiv = document.getElementById(main);
}
divOsClass.prototype.setDebug = function(p_debug) {
if(p_debug)
this._Debug = true;
else
this._Debug = false;
}
divOsClass.prototype.setTagCloseHtml = function(p_str) {
this.closeTagHtml = p_str;
}
divOsClass.prototype.virtualOpen = function(p_url,p_name,p_target,p_icon,p_setcookie) {
var tagSeq;
if(p_name=='undefined' || p_name=='') return;
tagSeq = this.addTag(p_name,p_icon);
this.hashTable.put(p_target,tagSeq) ;
this.tagUrl.put(tagSeq,p_url) ;
if(typeof(p_setcookie)!="undefined" && p_setcookie) {
var u=p_url.split("?");
this.Cookie.setCookie(this.AdminTag,this.Cookie.getCookie(this.AdminTag)+";;"+p_target+"=="+p_name+"=="+u[1]+"=="+p_icon);
}
}
divOsClass.prototype.open = function(p_url,p_name,p_target,p_icon) {
var tagSeq;
if(p_target=='_blank' )  {
tagSeq = this.addTag(p_name,p_icon);
}
else {
tagSeq = this.hashTable.get(p_target);
if(!this.hasTag(tagSeq) || tagSeq==null) {
tagSeq = this.addTag(p_name,p_icon);
var u=p_url.split("?");
this.Cookie.setCookie(this.AdminTag,this.Cookie.getCookie(this.AdminTag)+";;"+p_target+"=="+p_name+"=="+u[1]+"=="+p_icon);
}
else {
this.tagUrl.remove(tagSeq);
this.selectTag(tagSeq);
}
}
this.hashTable.put(p_target,tagSeq) ;
var contDiv = this.contentDivPrefix+tagSeq;
this.openUrl(contDiv,p_url);
}
divOsClass.prototype.openUrl = function(p_div,p_url,p_silent) {
if(p_url.indexOf("?")<0) p_url+="?";
else p_url+="&";
p_url+="TagName="+p_div;
this.genDivContentCallBackFunction(p_div);
this.sajaxIO.sajaxSubmit('','',this.name+".setdivContent"+p_div,'_displayProgram',p_url);
if (!p_silent) divOs.openWaitingWindow(divOs.waitWord,"sending");
}
divOsClass.prototype.openSajaxUrl = function(p_div,p_url) {
if(p_url.indexOf("?")<0) p_url+="?";
else p_url+="&";
p_url+="TagName="+p_div;
p_url+="&DivId="+p_div;
if(this.waitTip){
this.AjaxEdit.setUri(p_url);
this.AjaxEdit.sajaxSubmit('','',divOsClass.prototype.DivSajaxCallBack);
}else this.sajaxIO.sajaxSubmit('','',divOsClass.prototype.DivSajaxCallBack,'sajaxSubmit',p_url);
}
divOsClass.prototype.openSajaxUrlInContainer = function(p_obj,p_url) {
if(p_url.indexOf("?")<0) p_url+="?";
else p_url+="&";
p_url+="TagName="+($(p_obj).attr('id') || $(p_obj).attr('name'));
this.sajaxIO.sajaxSubmit('','',divOsClass.prototype.fillSajaxCallBack.bind(p_obj),'sajaxSubmit',p_url);
}
divOsClass.prototype.fillSajaxCallBack= function(z) {
if(divOs._Debug)  alert(z);
Res= sajaxIO.prototype.getMsg(z);
$(this).html(Res.Content);
if(Res.JsFunction) eval(Res.JsFunction);
}
Function.prototype.bind = function(o) {
var method = this;
return function() {
return method.apply(o, arguments);
};
}
divOsClass.prototype.openSubmitForm = function(p_title,p_url,p_form,p_param,p_style,p_event) {
divid="tmp"+this.popSeq;
this.openPopWindow(p_title,p_style,'',divid,p_event) ;
this.submitForm('ppcont'+divid,p_url,p_form,p_param,'sajaxSubmit');
}
divOsClass.prototype.submitForm = function() {
a=divOsClass.prototype.submitForm.arguments;
argDiv = a[0];
argUrl = a[1];
if(a[2]) argForm = a[2];
else argForm = "";
if(a[3]) argParam = a[3];
else argParam = "";
if(a[4]) argFun = a[4];
else argFun = "sajaxSubmit";
if(argUrl.indexOf("?")<0) argUrl+="?";
else argUrl+="&";
argUrl+="TagName="+argDiv;
this.genDivSubmitCallBackFunction(argDiv);
this.sajaxIO.sajaxSubmit(argParam,argForm,this.name+".setDivSubmitContent"+argDiv,argFun,argUrl);
this.Cookie.setCookie(argDiv,argUrl);
}
divOsClass.prototype.DivSajaxCallBack= function(z) {
var divOs_obj = eval("divOs");
if(divOs_obj._Debug)  alert(z);
Res= sajaxIO.prototype.getMsg(z);
if(Res.DivId) $("#"+Res.DivId).html(Res.Content);
if(Res.JsFunction) eval(Res.JsFunction);
divOs_obj.closeWaitingWindow('sending');
}
divOsClass.prototype.getDivUrl = function(p_div) {
var p =  this.Cookie.getCookie(p_div);
return p;
}
divOsClass.prototype.genDivContentCallBackFunction = function(p_div) {
var str = "divOsClass.prototype.setdivContent"+p_div+" = function(z) {\n";
if(this._Debug) str+=" alert(z);\n";
str+= "var s=z.substring(0,8);\n";
str+= "if(s==\"Location\") {\n";
str+= "  var uri=z.substring(9,z.indexOf('+++L+++'));\n";
str+= "  $('body').attr('onbeforeunload','');\n";
str+= "  window.location=uri ;\n";
str+= "  return ;\n";
str+= "}\n";
str+=	"var obj = document.getElementById('"+p_div+"');\n";
str+=	"divOsClass.prototype.setInnerHTML(obj, z);\n"+
"divOs.closeWaitingWindow('sending');}";
if(this._Debug) alert(str);
eval(str);
}
divOsClass.prototype.genDivSubmitCallBackFunction = function(p_div) {
var str = "divOsClass.prototype.setDivSubmitContent"+p_div+" = function(z) {\n";
if(this._Debug) str+=" alert(z);\n";
str +=	 "var ret = sajaxIO.prototype.getMsg(z);\n"+
"divOsClass.prototype.setInnerHTML(document.getElementById('"+p_div+"'),ret.Content);\n"+
"if(ret.JsFunction!='') eval(ret.JsFunction);\n"+
"return ret.Content;\n"+
"}\n";
if(this._Debug) alert(str);
eval(str);
}
divOsClass.prototype.setInnerHTML = function (el, htmlCode) {
if(el==null) return false;
if($.browser.msie){
var ua = navigator.userAgent;
if(ua.indexOf('Trident/4.0') >= 0  || ua.indexOf('Trident/8.0') >= 0 || ua.indexOf('Trident/7.0') >= 0 || ua.indexOf('Trident/6.0') >= 0 || ua.indexOf('Trident/5.0') >= 0){//for ie8 ie11 ie10 ie9
$(el).html(htmlCode);
}else {
var reg1 = new RegExp("<script[^>]*src=[\"\']*([^>\"\']+)[\"\']*[^>]*>[\s|\S]*?<\/script\s*>","ig");
while(1) {
var arr = reg1.exec(htmlCode);
if(reg1.lastIndex==0) break;
jQuery.ajax({
url: RegExp.$1,
async: false,
dataType: "script"
});
}
if(el.tagName=="TEXTAREA") el.setAttribute("value",htmlCode);
else {
fixHtmlCode = '<div style="display:none">for IE</div>' + htmlCode;
fixHtmlCode = fixHtmlCode.replace(/<script([^>]*)>/gi,
'<script$1 defer>');
el.innerHTML = '';
if(htmlCode){
el.innerHTML = fixHtmlCode;
el.removeChild(el.firstChild);
}
}
}
} else {
$(el).html(htmlCode);
}
}
divOsClass.prototype.createDiv = function(container,id,className) {
if(typeof(container)=="string") containerObj = document.getElementById(container);
else containerObj = container;
var newDiv=document.createElement("DIV");
containerObj.appendChild(newDiv);
newDiv.id=id;
newDiv.className=className;
}
divOsClass.prototype.delDiv = function(container,id) {
if(typeof(container)=="string") containerObj = document.getElementById(container);
else containerObj = container;
var child = document.getElementById(id);
if(child==null) return false;
containerObj.removeChild(child);
}
divOsClass.prototype.handleIEhasLayout=function(){
document.body.style.zoom = '1.1';
document.body.style.zoom = '';
}
divOsClass.prototype.checkTagDivReady = function() {
if(typeof(this.tagDiv)!='undefined')  return true;
return false;
}
divOsClass.prototype.addTag = function(p_name,p_icon) {
var tagDivName = this.TagDivPrefix+this.tagSeq;
var newLi=document.createElement("li");
newLi.id= tagDivName;
newLi.className = this.tagTitleVisibleStyle ;
var res = this.closeTagHtml.replace(/===TITLE===/,p_name);
var icon = this.styledir+"/backstyle/back_skin_grey/icon/6.png";
if (typeof p_icon != 'undefined' && trim(p_icon)!='' && p_icon!='undefined') {
icon = p_icon;
}
res = res.replace(/===ICON===/,icon);
var str = " ";
while(res!=str) {
str = res;
res = str.replace(/===TAG===/,this.tagSeq);
}
str = res;
newLi.innerHTML = str;
try{
this.tagDiv.appendChild(newLi);
var contDivName = this.contentDivPrefix+this.tagSeq;
this.createDiv(this.contentDiv,contDivName,this.tagContentVisibleStyle);
this.selectTag(this.tagSeq);
}catch(e) {
if(this._Debug) alert(" addTag Exception \n");
this.tagDiv = document.getElementById(this.tagDivName);
}
return this.tagSeq++;
}
divOsClass.prototype.isEmptyDiv = function(p_div) {
var tdiv = document.getElementById(p_div);
if(tdiv==null) return false;
if(tdiv.innerHTML.trim()) return false;
return true;
}
divOsClass.prototype.hasTag = function(p_seq) {
var tdiv = document.getElementById(this.TagDivPrefix+p_seq);
if(tdiv==null) return false;
return true;
}
divOsClass.prototype.delTag = function(p_seq) {
this.delDiv(this.tagDiv,this.TagDivPrefix+p_seq);
this.delDiv(this.contentDiv,this.contentDivPrefix+p_seq);
var key = this.hashTable.getKey(p_seq);
var newcookie = "";
var tags = this.Cookie.getCookie(this.AdminTag).split(";;");
var tag;
for(var i=0;i<tags.length;i++) {
if(tags[i]=='undefine') continue;
if(tags[i]=='') continue;
tag = tags[i].split("==");
if(tag[0]==key) continue;
newcookie+=tag[0]+"=="+tag[1]+"=="+tag[2]+"=="+tag[3]+";;";
}
this.Cookie.setCookie(this.AdminTag,newcookie);
this.hashTable.remove(key);
seq = this.hashTable.getFirst();
this.selectTag(seq);
try{
resize(this.contentDivPrefix+seq);
}catch(e){}
}
divOsClass.prototype.selectTag = function(p_seq) {
var cDiv;
for(var i=0;i<this.tagSeq;i++) {
cDiv = document.getElementById(this.contentDivPrefix+i);
tDiv = document.getElementById(this.TagDivPrefix+i);
if(cDiv==null) continue;
if(i==p_seq) {
cDiv.className=this.tagContentVisibleStyle;
tDiv.className=this.tagTitleVisibleStyle;
}
else {
cDiv.className=this.tagContentInVisibleStyle;
tDiv.className=this.tagTitleInVisibleStyle;
}
}
this.TagName="C"+p_seq;
resize(this.TagName);
var key = this.hashTable.getKey(p_seq);
var url = this.tagUrl.get(p_seq);
if(key!=null)
this.hashTable.mvToFirst(key);
if(url) {
this.openUrl(this.contentDivPrefix+p_seq,url);
this.tagUrl.remove(p_seq);
}
this.handleIEhasLayout();
}
divOsClass.prototype.getScrollTop = function() {
if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
scrollPos = document.documentElement.scrollTop == 0 ? document.body.scrollTop : document.documentElement.scrollTop;
}
else if (typeof document.body != 'undefined') {
scrollPos = document.body.scrollTop;
}
return scrollPos;
}
divOsClass.prototype.clearQuote = function(text){
if (typeof( text ) == "undefined") return text;
if (typeof( text ) != "string") text = text.toString() ;
text = text.replace(/"/g, "&quot;") ;
text = text.replace(/'/g, "&#39;") ;
return text ;
}
divOsClass.prototype.openPopUrl = function(p_title,p_style,p_url,p_div,p_event) {
var divid = "urlPop"+this.popSeq;
this.openPopWindow(p_title,p_style,"<div id=\""+divid+"\">loading...</div>",p_div);
this.openUrl(divid,p_url);
return false;
}
divOsClass.prototype.openPopSajaxUrl = function(p_title,p_style,p_url,p_div,p_event) {
var divid = "urlPop"+this.popSeq;
this.openPopWindow(p_title,p_style,"<div id=\""+divid+"\">loading...</div>",p_div,p_event);
this.openSajaxUrl(divid,p_url);
return false;
}
divOsClass.prototype.openAlertWindow = function(p_type,p_msg,p_style,p_div,p_button,p_title) {
var divClass, icon,cont2="";
icon ="wait.gif";
if(!p_style) p_style="width:350;height:110;Button:ok;top:180";
if(p_type==divOsClass.prototype.AlertSuccess) icon ="success.png";
if(p_type==divOsClass.prototype.AlertWait) icon = "wait.gif";
if(p_type==divOsClass.prototype.AlertFailed) icon ="failure.png";
var cont;// = document.getElementById("ppcont"+seq);
cont =	 "<div><table width=\"100%\" cellpadding=\"5\"><tr><td width=\"1%\" nowrap=\"nowrap\"><img src=\""+this.imagedir+"/"+icon+"\" width=\"34\" height=\"35\" align=\"absmiddle\" /></td><td align=\"left\" valign=\"top\">"+p_msg+"</td></tr></table></div>\n";
cont += "<div style=\"text-align:center\">\n";
if (p_button && p_button!="NoButton"){
while (p_button.getFirstKey()){
var BtnKey = p_button.getFirstKey();
if(BtnKey=='_Ok')
cont+="<input type='button' name='_Ok' value='  OK  ' onclick=\"javascript:"+this.clearQuote(p_button.get(BtnKey))+";"+this.name+".closePopWindow("+this.popSeq+");\" />\n";
if(BtnKey=='_Cancel')
cont+="<input type='button' name='_Cancel' value='Cancel' onclick=\"javascript:"+this.clearQuote(p_button.get(BtnKey))+";"+this.name+".closePopWindow("+this.popSeq+");\" />\n";
if(BtnKey=='_Js')
cont2="<script language='javascript' defer>"+(p_button.get(BtnKey))+";</script>\n";
if (BtnKey!="_Ok" && BtnKey!="_Cancel" && BtnKey!="_Js"){
var BtnVal = p_button.get(BtnKey).split("=o=");
cont+=" <input type='button' name='"+BtnKey+"' value='"+BtnVal[0]+"' onclick=\"javascript:"+this.clearQuote(BtnVal[1])+";"+this.name+".closePopWindow("+this.popSeq+");\" />\n";
}
p_button.remove(BtnKey);
}
}
else if(p_button!="NoButton") cont+="<input type='button' name='_Close' value=' Close ' onclick=\"javascript:"+this.name+".closePopWindow("+this.popSeq+");\" />\n";
cont += "</div>";
cont += cont2;
if(!p_title) p_title = window.location.host;
var seq = this.openPopWindow(p_title,p_style,cont,p_div);
return seq;
}
divOsClass.prototype.closeWaitingWindow = function(p_id) {
if (!p_id) p_id="waitingId";
try {
var obj = document.getElementById(p_id);
obj.parentNode.removeChild(obj);
}catch(e){}
}
divOsClass.prototype.openWaitingWindow = function(p_cont,p_id) {
if (!p_id) p_id="waitingId";
if (document.getElementById(p_id)) {return false;}
var newDiv=document.createElement("DIV");
newDiv.id = p_id;
document.body.appendChild(newDiv);
str="<style>body,td,th,img,a,* {cursor:normal;}</style><div class=\"alertmsg\"><div class=\"alertmsg-inner2\"><div class=\"alertmsg-inner\"><a href=\"javascript:void(0)\" onclick=\"divOs.closeWaitingWindow('"+p_id+"');\" class=\"close\">Close</a><p><img class=\"loadingimg\" src=\""+this.imagedir+"/loading.gif\" align=\"absmiddle\" width=\"16\" height=\"16\" border=\"0\" />"+p_cont+"</p></div></div></div>";
this.setInnerHTML(newDiv,str);
}
divOsClass.prototype.changePopTitle = function(p_divid,p_title) {
try{
var headDiv = document.getElementById(p_divid+"__overPopTitle");
divOsClass.prototype.setInnerHTML(headDiv,"<h4>"+strUtil.prototype.htmlspecialchars(decodeURIComponent(p_title))+"</h4>");
}catch(e){}
}
divOsClass.prototype.openPopWindow = function(p_title,p_style,p_cont,p_div,event) {
if(p_div!="") {
var checkObj=document.getElementById(p_div);
if(checkObj) return false;
}
var divWidth="100%",divHeight=300,divTop=70,divLeft=0,divStatic=1,divSpeed=0;
var Maximize = false;
var Close = true;
var ret ;
var divNavigate=false;
var divFoot=false;
var Nav = "";
if(typeof p_style!="undefined") {
ret = p_style.split(";");
for(var i=0;i<ret.length;i++) {
var tmp;
if(ret[i].indexOf('=')!=-1) tmp = ret[i].split("=");
if(ret[i].indexOf(':')!=-1) tmp = ret[i].split(":");
if(tmp[0]=="width") divWidth = tmp[1];
else if(tmp[0]=="height") divHeight = tmp[1];
else if(tmp[0]=="top") divTop = tmp[1];
else if(tmp[0]=="left") divLeft = tmp[1];
else if(tmp[0]=="Maximize") {
if(tmp[1]==1) Maximize=true;
else Maximize=false;
}
else if(tmp[0]=="Close") {
if(tmp[1]==1) Close=true;
else Close=false;
}
else if(tmp[0]=="Static") {
if(tmp[1]==1) divStatic=true;
else divStatic=false;
}
else if(tmp[0]=="Nav") {
Nav = tmp[1];
Nav.substr(0,1)
if(Nav.substr(0,1)=="1") divNavigate=1;
else if(Nav.substr(0,1)=="2") divNavigate=2;
else divNavigate=0;
if(Nav.substr(1,1)=="1") divFoot=1;
else divFoot=0;
}
}
}
divTop=0;
AbsDivTop=parseInt(divTop);
divTop=parseInt(parseInt(divTop)+parseInt(divOsClass.prototype.getScrollTop()));//add the mouse scroll distance
var ppcontId = "";
var newDiv=document.createElement("DIV");
document.body.appendChild(newDiv);
if(typeof p_div=="undefined" ||  p_div=="") {
newDiv.id="popDiv"+this.popSeq;
ppcontId = "ppcont"+this.popSeq;
p_div=newDiv.id;
}
else{
ppcontId ="ppcont"+p_div;
newDiv.id=p_div;
}
newDiv.className="pop-float";
if(event){
newDiv.style.width="100px";
}
var str="<script language=\"javascript\">\n"+
"var popMaxWidth =document.body.offsetWidth-80;\n"+
"var popMaxHeight =document.body.offsetHeight-100;\n";
if(event){
str +="var h=document.getElementById(\""+newDiv.id+"\");\n"+
"var o=document.getElementById(\""+newDiv.id+"__overPopTitle\");\n"+
"Drag.init(o,h,0,popMaxWidth,0,popMaxHeight);\n";
}else{
str +="var h=document.getElementById(\""+newDiv.id+"__movePopOut\");\n"+
"var o=document.getElementById(\""+newDiv.id+"__overPopTitle\");\n"+
"Drag.init(o,h,0,popMaxWidth,0,popMaxHeight);\n";
}
if(!event)
str +="__InitPopDiv(o,h);\n";
str +="h.onDragEnd = function (x, y) {RecP(x,y,h);}\n"+
"function RecP(x,y,h){\n"+
"if(divOs.position==\"back\"){\n"+
"if(x){Cookie.prototype.setCookie(\"__movePopOut_back_x\",x);}\n"+
"if(y){Cookie.prototype.setCookie(\"__movePopOut_back_y\",y);}\n"+
"}else{\n"+
"if(x){Cookie.prototype.setCookie(\"__movePopOut_front_x\",x);}\n"+
"if(y){Cookie.prototype.setCookie(\"__movePopOut_front_y\",y);}\n"+
"}\n"+
"}\n"+
"function __InitPopDiv(o,h)\n"+
"{h.style.position=\"absolute\";\n"+
"o.style.cursor=\"move\";\n"+
"if(divOs.position==\"back\"){\n"+
"var a=Cookie.prototype.getCookie(\"__movePopOut_back_x\");\n"+
"var b=Cookie.prototype.getCookie(\"__movePopOut_back_y\");\n"+
"}else{\n"+
"var a=Cookie.prototype.getCookie(\"__movePopOut_front_x\");\n"+
"var b=80;\n"+
"}\n"+
"if(a==null || a==\"\"){\n"+
"var tmpWidth=parseInt(\""+divWidth+"\");\n"+
"if(tmpWidth==\""+divWidth+"\"){\n"+
"a=(popMaxWidth/2)-(tmpWidth/2);\n"+
"}else a=popMaxWidth*(100-tmpWidth)/200;\n"+
"b=30;\n"+
"}\n"+
"if (a!=null&&a!=\"\"){ a=parseInt(a)+\"px\";\n h.style.left=a; }\n"+
"if (b!=null&&b!=\"\"){ b=parseInt(b)+\"px\";\n h.style.top=b; }\n"+
"}\n"+
"</script>\n";
str += "<div id=\""+newDiv.id+"__movePopOut\" class=\"pop-outer\">";
if(event){
str += "<div  class=\"pop-container pop-shadow\">\n"+
"<div id=\"fullDiv"+this.popSeq+"\" class=\"pop-module pop-overlay\">\n"+
"<div class=\"pop-head\">\n";
}
else{
str += "<div  class=\"pop-container pop-shadow\">\n"+
"<div id=\"fullDiv"+this.popSeq+"\" class=\"pop-module pop-overlay\">\n"+
"<div class=\"pop-head\">\n";
}
str+="<div id=\""+newDiv.id+"__overPopTitle\" class=\"pop-head-inner\"><h4>"+strUtil.prototype.htmlspecialchars(decodeURIComponent(p_title))+"</h4></div>\n";
if(Close) {
str+= "<div class=\"pop-close\" onclick=\"javascript:"+this.name+".closePopWindow("+this.popSeq+");\"></div>\n";
}
str+="</div>\n";
var navigateHeight=0;
if(divNavigate==1) {
str+="<div class=\"pop-navigate\" style=\"height:61px\"><div class=\"pop-navigate-inner\"></div></div>\n";
navigateHeight=61;
}
else if(divNavigate==2) {
str+="<div class=\"pop-navigate\" style=\"height:36px\"><div class=\"pop-navigate-inner\"></div></div>\n";
navigateHeight=36;
}
if(divFoot) navigateHeight+=43;
if(typeof(p_cont)=='object') {
str+=	"<div id=\""+ppcontId+"\" class=\"pop-body\"><div class=\"pop-body-inner\">"+p_cont.innerHTML+"\n";
}
else
str+=	"<div id=\""+ppcontId+"\" class=\"pop-body\"><div class=\"pop-body-inner\">"+p_cont+"\n";
str+= "</div></div>\n";
str+= "</div>\n";
str+= "<div id=\"underLay"+this.popSeq+"\" class=\"underlay\"></div>\n";
str+= "</div></div>\n";
this.setInnerHTML(newDiv,str);
var fullDiv = document.getElementById("fullDiv"+this.popSeq);
var ppcontent = document.getElementById(ppcontId);
var underLay = document.getElementById("underLay"+this.popSeq);
if(divTop) {
newDiv.style.top = divTop+"px";
}
if(divLeft) {
newDiv.style.left = divLeft+"px";
}
if(event){
var chkTopSide=false;
var chkLeftSide=false;
var bodywidth = document.body.offsetWidth;
var bodyheight ;
if(document.documentElement)
bodyheight = document.documentElement.clientHeight;
else
bodyheight = document.body.offsetHeight;
var chktop =parseInt(event.clientY) + parseInt(divHeight);
var chkleft=parseInt(event.clientX) + parseInt(divWidth);
if(chktop > bodyheight){
chkTopSide=true;
newtop=parseInt(event.clientY) - parseInt(divHeight);
if(newtop<0) newtop=10;
}
else newtop=event.clientY;
newDiv.style.top = newtop+"px";
if(chkleft > bodywidth){
chkLeftSide=true;
newleft=parseInt(event.clientX)-parseInt(divWidth)-215;
if(newleft<0) newleft=10;
}else newleft=event.clientX-215;
newDiv.style.left = newleft+"px";
divWidthSm =20;
divHeightSm =20;
divSpeed =10;
}
if(divWidth) {
if(divWidth.indexOf("%")!=-1) {
fullDiv.parentNode.parentNode.style.width = divWidth;
if (this.browser=="FF") ppcontent.style.width="100%";
}
else {
fullDiv.parentNode.parentNode.style.width=divWidth+"px";
if (this.browser=="FF") ppcontent.style.width="100%";//divWidth+"px";
}
}
if(divHeight) {
if(String(divHeight).indexOf("%")!=-1) {
var myOffset = 0;
if (this.browser=="FF") myOffset = 0;
newDivHeight=(document.documentElement.clientHeight-myOffset)*divHeight.slice(0,-1)/100;
if(newDivHeight>(divTop+myOffset)) newDivHeight = newDivHeight-AbsDivTop-myOffset;
if(newDivHeight<40) newDivHeight=40;
fullDiv.style.height=newDivHeight+"px";
h = newDivHeight+3;
$(newDiv).children("DIV").css("height",h);
ppcontent.style.height=(newDivHeight-27-navigateHeight)+"px";
underLay.style.height=(newDivHeight+2)+"px";
}
else{
divHeight = parseInt(divHeight);
if(divHeight<40) divHeight=40;
fullDiv.style.height=divHeight+"px";
h = divHeight+3;
$(newDiv).children("DIV").css("height",h);
ppcontent.style.height=(parseInt(divHeight)-27-navigateHeight)+"px";
underLay.style.height =(parseInt(divHeight)+2)+"px";
}
}
if(divWidth && divHeight && divSpeed){
$(newDiv).children("DIV").css("width",divWidthSm+"px");
$(newDiv).children("DIV").css("height",divHeightSm+"px");
newDiv.style.left = event.clientX+"px";
newDiv.style.top = (event.clientY+parseInt(divOsClass.prototype.getScrollTop()))+"px";
widthSpeed = (divWidth-divWidthSm)/10;
heightSpeed = (divHeight-divHeightSm)/10;
if(widthSpeed<10) widthSpeedperH=10;
if(heightSpeed<10) heightSpeed=10;
divOsClass.prototype.ActiveDiv(p_div,chkTopSide,chkLeftSide,divWidth,divHeight,widthSpeed,heightSpeed,divSpeed);
$(p_div).children("DIV").css("overflow","hidden");;
}
if(true) {
}
this.popHandle.put(this.popSeq,newDiv.id) ;
return this.popSeq++;
}
divOsClass.prototype.freePopdivHeight =function(p_div) {
var obj = document.getElementById(p_div);
if(obj.style.height) {
obj.style.height='auto';
obj.style.position='static';
obj.style.padding='0 0 0 0';
obj.style.overflowY='hidden';
obj.parentNode.parentNode.parentNode.style.height="auto";
obj.parentNode.parentNode.parentNode.style.overflow="";
obj.parentNode.parentNode.parentNode.style.overflow="";
obj.parentNode.style.height="auto";
divOs.nextSibling(obj.parentNode).style.height="auto";
}
}
divOsClass.prototype.ActiveDiv =function(p_div,chkTop,chkLeft,Rwidth,Rheight,width,height,speed){
obj = document.getElementById(p_div);
var fixHeight=false;
if($(obj).children("DIV").css("height")=='auto') fixHeight = true;
if(!fixHeight) {
var height =  $(obj).children("DIV").css("height").split('px')[0];
var perH = (Rheight-height)/7;
}
var width =  $(obj).children("DIV").css("width").split('px')[0];
var top =  obj.style.top.split('px')[0];
var left =  obj.style.left.split('px')[0];
if((Rwidth-width)>140)
var perW = (Rwidth-width)/7;
else perW=20;
if (width < Rwidth){
if(!fixHeight && height<Rheight)
height = parseInt(height)+perH;
width = parseInt(width)+perW;
if(chkTop && chkLeft){
top = parseInt(top)-perH;
left = parseInt(left)-perW;
}
else if(chkTop){
top = parseInt(top)-perH;
}
else if(chkLeft){
left = parseInt(left)-perW;
}
if(!fixHeight) {
$(obj).children("DIV").css("height",height+"px");
}
$(obj).children("DIV").css("width",width+"px");
if(width>Rwidth) {
Rheight+=10;
$(obj).children("DIV").css("height",Rheight+"px");
}
if(top<0) top=0;
if(left<0) left=0;
obj.style.top = top+"px";
obj.style.left = left+"px";
clearTimeout(this.act);
this.act = setTimeout('divOsClass.prototype.ActiveDiv(\"'+p_div+'\",'+chkTop+','+chkLeft+','+Rwidth+','+Rheight+','+width+','+height+','+speed+')', speed);
}
return false;
}
divOsClass.prototype.popWindow = divOsClass.prototype.openPopWindow ;
divOsClass.prototype.closePopWindow = function(p_div) {
if(strUtil.prototype.isInteger(p_div)) p_seq = p_div;
else p_seq = this.popHandle.getKey(p_div);
try{
var floatDiv = document.getElementById("floatDiv"+p_seq);
if(floatDiv) {
this.destroyEditor(floatDiv);
floatDiv.parentNode.removeChild(floatDiv);
}
var obj = document.getElementById(this.popHandle.get(p_seq));
if(obj) {
this.destroyEditor(obj);
obj.parentNode.removeChild(obj);
}
}catch(e){}
}
divOsClass.prototype.destroyEditor = function(o) {
if(!o || typeof(CKEDITOR) == 'undefined') return true;
$(o).find('textarea').each(function(){
var id = $(this).attr('id');
var name = $(this).attr('name');
if(trim(id) != '' && CKEDITOR.instances[id]) CKEDITOR.instances[id].destroy();
if(trim(name) != '' && CKEDITOR.instances[name]) CKEDITOR.instances[name].destroy();
});
}
divOsClass.prototype.closeAllPopWindow = function(p_from) {
if(!p_from) p_from=this.popSeq;
var p_to=p_from-10;
if(p_to<0) p_to=0;
for (var i=p_from;i>p_to;i--){
try{
divOs.closePopWindow(i);
}catch(e){}
}
}
divOsClass.prototype.getPopHandle = function(p_seq)  {
return this.popHandle.get(p_seq);
}
divOsClass.prototype.getParentNodeById = function(p_obj,p_id,p_islike){
var str = new String();
if(p_id == "") return p_obj.parentNode;
if(p_obj==null) return null;
if(typeof(p_obj)=="undefined" || (p_obj.tagName!=null && p_obj.tagName.toLowerCase()=="body")) return null;
p_obj = p_obj.parentNode;
if(p_obj==null) return null;
if(p_obj.id=="") return divOsClass.prototype.getParentNodeById(p_obj,p_id,p_islike);
if(p_islike){
str = p_obj.id;
if(typeof(str)!="undefined" && str.indexOf(p_id)>-1){
return p_obj;
}
else
return divOsClass.prototype.getParentNodeById(p_obj,p_id,p_islike);
}
else{
if(p_obj.id==p_id)
return p_obj;
else
return divOsClass.prototype.getParentNodeById(p_obj,p_id,p_islike);
}
}
divOsClass.prototype.getParentForm = function(p_obj){
while(p_obj.tagName.toLowerCase()!="body" && p_obj.tagName.toLowerCase()!="form") {
p_obj = p_obj.parentNode;
}
if(p_obj.tagName.toLowerCase()=="form") return p_obj;
else return null;
}
divOsClass.prototype.previousSibling = function(p_obj){
if(typeof(p_obj.previousSibling.tagName)=='undefined')
return divOsClass.prototype.previousSibling(p_obj.previousSibling);
else return p_obj.previousSibling;
}
divOsClass.prototype.childNode = function(p_obj,p_seq){
var counter = 0;
try{
for(var i=0;i<p_obj.childNodes.length;i++) {
if(typeof(p_obj.childNodes[i].tagName)=='undefined') continue;
else {
if(counter==p_seq) return p_obj.childNodes[i];
counter++;
}
}
}catch(e) {
if(this._Debug) alert(" childNode Exception \n");
return null;
}
}
divOsClass.prototype.nextSibling = function(p_obj){
if(typeof(p_obj.nextSibling.tagName)=='undefined')
return divOsClass.prototype.nextSibling(p_obj.nextSibling);
else return p_obj.nextSibling;
}
divOsClass.prototype.saveDivHTML = function(p_key,p_id){
this.divContent.put(p_key,$("#"+p_id).html()) ;
return true;
}
divOsClass.prototype.restoreDivHTML = function(p_key,p_id){
var h=this.divContent.get(p_key);
if(h==null) return false;
$("#"+p_id).html(h) ;
return true;
}
divOsClass.prototype.addClickEvent = function(p_clickobj,p_hidediv,p_method,p_bubble){
tempHideDiv = p_hidediv;
if (typeof event=='undefined')
p_clickobj.parentNode.addEventListener("click",divOsClass.prototype.tempStop,false);
else
event.cancelBubble = true;
if(p_bubble==undefined)
p_bubble = true;
if (p_method)
Func = eval(p_method);
else Func = divOsClass.prototype.tempHide;
if (document.addEventListener){
if(p_bubble)
document.addEventListener("click", Func, false)
else
document.addEventListener("click", Func, true)
}
else if (document.attachEvent)
document.attachEvent("onclick", Func)
else if (document.getElementById)
window.onclick=Func
}
divOsClass.prototype.triggerClickEvent = function(){
if (document.addEventListener)
$(document.body).click();
else if (document.attachEvent)
$(document.body).click();
else if (document.getElementById)
$(window).click();
}
divOsClass.prototype.tempStop = function (func){
func.cancelBubble = true;
}
divOsClass.prototype.tempHide = function (){
try	{
if (tempHideDiv!=null)
document.getElementById(tempHideDiv).style.display="none";
}catch (e){}
}
divOsClass.prototype.showDetailMsg = function(p_type,p_msg) {
try{
var objDetail = document.getElementById(p_type+"_DetailMsg");
objDetail.style.display="";
objDetail.className = "msg msg_success";
objDetail.innerHTML = p_msg;
setTimeout("divOsClass.prototype.hideDetailMsg('"+p_type+"')",2000);
}
catch(e) {
if(this._Debug) alert(" showDetailMsg Exception \n");
}
}
divOsClass.prototype.hideDetailMsg = function(p_type,p_msg) {
var objDetail = document.getElementById(p_type+"_DetailMsg");
if(objDetail) objDetail.className = "msg msg_success2";
}
divOsClass.prototype.swapImgRestore = function() {
var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
divOsClass.prototype.preloadImages = function() {
var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
var i,j=d.MM_p.length,a=divOsClass.prototype.preloadImages.arguments; for(i=0; i<a.length; i++)
if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
divOsClass.prototype.findObj = function(n, d) {
if(typeof(n)=="object") return n;
var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=divOsClass.prototype.findObj(n,d.layers[i].document);
if(!x && d.getElementById) x=d.getElementById(n); return x;
}
divOsClass.prototype.swapImage = function() {
var i,j=0,x,a=divOsClass.prototype.swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
if ((x=divOsClass.prototype.findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
divOsClass.prototype.getCurrentStyle = function(ele) {
if (ele.currentStyle)
return ele.currentStyle;
else
return document.defaultView.getComputedStyle(ele, null);
}
divOsClass.prototype.getUrlParam = function(paramName,url) {
if(typeof url=="undefined") url=window.location;
var oRegex = new RegExp( '[\?&]' + paramName + '=([^&]+)', 'i' ) ;
var oMatch = oRegex.exec(url) ;
if ( oMatch && oMatch.length > 1 )
return oMatch[1] ;
else
return '' ;
}
divOsClass.prototype.setOnloadFunc = function(p_fn) {
this.onloadFuncs.push(p_fn);
if(!this.onloadStart){
this.onloadStart = 1;
this.onloadCount = 0;
this.onloadTimeOut = 500;
this.runOnload();
}
}
divOsClass.prototype.runOnload = function() {
this.onloadCount++;
if((this.onloadTimeOut>90000 || this.onloadCount > 180) && this.onloadFuncs.length==this.onloadPoint){
this.onloadStart = 0;
return;
}
if(this.onloadFuncs.length==0 || (this.onloadFuncs.length==this.onloadPoint && this.onloadFailFuncs.length==0)){
this.onloadTimeOut = this.onloadTimeOut+1000;
setTimeout(this.name+".runOnload()",this.onloadTimeOut);
return;
}
var tmp_onloadFuncs = this.onloadFailFuncs;
this.onloadFailFuncs = new Array();
for(var j = 0; j < tmp_onloadFuncs.length; j++) {
try { eval(tmp_onloadFuncs[j]);}
catch(e) {
this.onloadFailFuncs.push(tmp_onloadFuncs[j]);
}
}
for(var i = this.onloadPoint; i < this.onloadFuncs.length; i++) {
try { eval(this.onloadFuncs[i]);}
catch(e) {
this.onloadFailFuncs.push(this.onloadFuncs[i]);
}
}
this.onloadPoint=i;
if(this.onloadFailFuncs.length>0)
this.onloadTimeOut = 500;
else
this.onloadTimeOut = this.onloadTimeOut+1000;
setTimeout(this.name+".runOnload()",this.onloadTimeOut);
}
function strUtil(p_str) {
if(typeof(p_str)=='undefined') p_str = "";
this.String = p_str;
return this;
}
strUtil.prototype.length = function() {
a=strUtil.prototype.length.arguments;
if(typeof(a[0])!='undefined') p_in = a[0];
else p_in = this.String;
return p_in.length;
}
strUtil.prototype.isInteger = function() {
a=strUtil.prototype.isInteger.arguments;
if(typeof(a[0])!='undefined') p_in = a[0];
else p_in = this.String;
var p_val = p_in.toString();
for(var i=0;i<p_val.length; i++)  {
var oneChar = p_val.charAt(i);
if(i==0 && oneChar =="-")       continue;
if(oneChar<"0" || oneChar>"9")  return false;
}
return true;
}
strUtil.prototype.isPosInteger = function() {
a=strUtil.prototype.isPosInteger.arguments;
if(typeof(a[0])!='undefined') p_in = a[0];
else p_in = this.String;
var p_val = p_in.toString();
for(var i=0;i<p_val.length; i++)  {
var oneChar = p_val.charAt(i);
if(oneChar<"0" || oneChar>"9")  return false;
}
return true;
}
strUtil.prototype.isEmpty = function () {
a=strUtil.prototype.isEmpty.arguments;
if(typeof(a[0])!='undefined') p_in = a[0];
else p_in = this.String;
p_val = this.trim(p_in);
if(p_val == null || p_val=="")  return true;
if(p_val.length==0) return true;
return false;
}
strUtil.prototype.isEmail = function(){
a=strUtil.prototype.isEmail.arguments;
if(typeof(a[0])!='undefined') p_in = a[0];
else p_in = this.String;
var reg = new RegExp("^[_\\.0-9a-zA-Z-]+@([0-9a-zA-Z-]+\\.)+[a-zA-Z]{2,3}$");
if(p_in.search(reg)!=-1)
return true;
else
return false;
}
strUtil.prototype.isCode = function()  {
a=strUtil.prototype.isCode.arguments;
if(typeof(a[0])!='undefined') p_in = a[0];
else p_in = this.String;
var  reg =new RegExp(/^[a-z\d\_]+$/i);
if(p_in.search(reg)!=-1)
return true;
else
return false;
}
strUtil.prototype.ltrim = function(p_str)  {
a=strUtil.prototype.ltrim.arguments;
if(typeof(a[0])!='undefined') p_str = a[0];
else p_str = this.String;
return p_str.replace(/(^\s*)/g, "");
}
strUtil.prototype.trim = function(p_str)
{
a=strUtil.prototype.trim.arguments;
if(typeof(a[0])!='undefined') p_str = a[0];
else p_str = this.String;
return p_str.replace(/(^\s*)|(\s*$)/g, "");
}
String.prototype.trim = function()
{
return this.replace(/(^[\n\s]*)|([\s\n]*$)/g, "");
}
strUtil.prototype.rtrim = function(p_str)  {
a=strUtil.prototype.rtrim.arguments;
if(typeof(a[0])!='undefined') p_str = a[0];
else p_str = this.String;
return p_str.replace(/(\s*$)/g, "");
}
strUtil.prototype.wipeTag = function(p_str,p_tag)  {
var reg = new RegExp("<"+p_tag+"[^>]*>([\\s|\\S]*?)<\\/"+p_tag+"\\s*>","i");
p_str = p_str.replace(reg,"");
return p_str;
}
strUtil.prototype.wipeScript = function(p_str)  {
if(typeof p_str=="undefined" || p_str==null) return ;
var reg1 = /<script[^>]*>([\s|\S]*?)<\/script\s*>/i;
var reg2 = /<iframe[^>]*>([\s|\S]*?)<\/iframe\s*>/i;
var reg3 = /<frameset[^>]*>([\s|\S]*?)<\/frameset\s*>/i;
var reg4 = /<a\s*href=[\s\S]*javascript[^>]*>([\s|\S]*?)<\/a\s*>/i;
p_str = p_str.replace(reg1,"");
p_str = p_str.replace(reg2,"");
p_str = p_str.replace(reg3,"");
p_str = p_str.replace(reg4,"");
return p_str;
}
strUtil.prototype.striptags = function(p_str)  {
if(typeof p_str=="undefined" || p_str==null) return ;
var reg1 = /<[^>]*>/ig;
var reg2 = /<\/[^>]*>/ig;
var reg3 = /&nbsp;/ig;
p_str = p_str.replace(reg1,"");
p_str = p_str.replace(reg2,"");
p_str = p_str.replace(reg3,"");
return p_str;
}
strUtil.prototype.wipeForm = function(p_str)  {
if(typeof p_str=="undefined" || p_str==null) return ;
var reg1 = /<form[^>]*>/i;
var reg2 = /<\/form[^>]*>/i;
p_str = p_str.replace(reg1,"");
p_str = p_str.replace(reg2,"");
return p_str;
}
strUtil.prototype.addslashes = function (str) {
if(typeof str=="undefined" || str==null) return ;
str=str.replace(/\'/g,'\\\'');
str=str.replace(/\"/g,'\\"');
str=str.replace(/\\/g,'\\\\');
str=str.replace(/\0/g,'\\0');
return str;
}
strUtil.prototype.stripslashes = function (str) {
if(typeof str=="undefined" || str==null) return ;
str=str.replace(/\\'/g,'\'');
str=str.replace(/\\"/g,'"');
str=str.replace(/\\\\/g,'\\');
str=str.replace(/\\0/g,'\0');
return str;
}
strUtil.prototype.nl2br = function (str) {
if(typeof str=="undefined" || str==null) return ;
return str.replace(/(\r\n)|(\n\r)|\r|\n/g,"<BR>");
}
strUtil.prototype.directShowInput = function (str) {
return strUtil.prototype.nl2br(strUtil.prototype.htmlspecialchars(strUtil.prototype.stripslashes(str)));
}
strUtil.prototype.htmlspecialchars = function(str)  {
if(typeof str=="undefined" || str==null) return ;
str = str.replace(/\</g,"&lt;");
str = str.replace(/\>/g,"&gt;");
str = str.replace(/\"/g,"&quot;");
return str;
}
strUtil.prototype.reversespecialchars = function(str)  {
if(typeof str=="undefined" || str==null) return ;
str = str.replace(/&lt;/g,"<");
str = str.replace(/&gt;/g,">");
str = str.replace(/&quot;/g,"\"");
str = str.replace(/&amp;/g,"&");
return str;
}
strUtil.prototype.markIp = function () {
a=strUtil.prototype.markIp.arguments;
ip = a[0];
if(typeof(a[1])!='undefined') part = a[1];
else part = 3;
if(part>4) return ip;
ret = ip.split(".");
str="";
for(i=0;i<ret.length;i++) {
if(i+1<part) str+=ret[i]+".";
else str+="X.";
}
return str.substring(0,str.length-1);
}
function Cookie(path,domain,duration,secure) {
this.defPath = path;
this.defDomain = domain;
this.defDuration = duration;
this.defSecure = secure;
return this;
}
Cookie.prototype.setCookie = function (name, value, duration, path, domain, secure) {
if(!duration && this.defDuration) duration = this.defDuration;
if(!path && this.defPath) path = this.defDuration;
if(!domain && this.defDomain) domain = this.defDomain;
if(!secure && this.defSecure) secure = this.defSecure;
if(duration){
var expires = new Date();
var curTime = new Date().getTime();
expires.setTime(curTime + (1000 * 60 * duration));
}
this.setCookieDT(name, value, expires, path, domain, secure);
}
Cookie.prototype.setGroupCookie = function (cookiename,name, value, duration, path, domain, secure) {
var val = this.getCookie(cookiename);
if(typeof val=="undefined" || val=="") {
return this.setCookie(cookiename,name+":"+value,duration, path, domain, secure);
}
var arr = val.split(";;");
var acookie;
var found=false;
var i;
for(i=0;i<arr.length;i++) {
acookie = arr[i].split(":");
if(acookie[0]==name) {
arr[i] = name+":"+value;
found = true;
}
}
if(!found) {
arr[i] = name+":"+value;
}
var str = arr.join(";;");
return this.setCookie(cookiename,str,duration, path, domain, secure);
}
Cookie.prototype.getGroupCookie = function (cookiename,name) {
var val = this.getCookie(cookiename);
if(typeof val=="undefined" || val=="") return "";
var arr = val.split(";;");
var acookie;
var found=false;
for(var i=0;i<arr.length;i++) {
acookie = arr[i].split(":");
if(acookie[0]==name) {
return acookie[1];
}
}
return "";
}
Cookie.prototype.delGroupCookie = function (cookiename,name,duration, path, domain, secure) {
var val = this.getCookie(cookiename);
if(typeof val=="undefined" || val=="") return "";
var arr = val.split(";;");
var acookie;
var res = new Array();
var j=0;
for(var i=0;i<arr.length;i++) {
acookie = arr[i].split(":");
if(acookie[0]==name) continue;
res[j++] = arr[i];
}
var str = res.join(";;")
return this.setCookie(cookiename,str,duration, path, domain, secure);
}
Cookie.prototype.setCookieDT = function (name, value, expires, path, domain, secure) {
document.cookie =
name+"="+encodeURIComponent(value)+
(expires ? "; expires="+expires.toGMTString() : "")+
(path    ? "; path="   +path   : "")+
(domain  ? "; domain=" +domain : "")+
(secure  ? "; secure" : "");
}
Cookie.prototype.getCookie = function (name) {
cookie = " "+document.cookie;
offset = cookie.indexOf(" "+name+"=");
if (offset == -1) return undefined;
offset += name.length+2;
end     = cookie.indexOf(";", offset)
if (end == -1) end = cookie.length;
return decodeURIComponent(cookie.substring(offset, end));
}
Cookie.prototype.existCookie = function (name) {
var cookieVal = new strUtil(Cookie.prototype.getCookie(name));
cookieVal.trim(' ');
if(cookieVal.length()==0) return false;
return true;
}
Cookie.prototype.delCookie = function (name,path,domain) {
if (this.getCookie(name)) {
var date = new Date("January 01, 2000 00:00:01");
this.setCookieDT(name, "", date, path, domain);
}
}
function dateUtil() {
return this;
}
dateUtil.prototype.monthdays = function (p_year,p_month) {
if(p_month==1 || p_month==3 || p_month==5 || p_month==7 || p_month==8 ||p_month==10 || p_month==12 )
return 31;
if(p_month==4 || p_month==6 || p_month==9 || p_month==11 )
return 30;
if(p_month==2 && ((p_year%4==0 && p_year%100!=0) || p_year%400==0 ))
return 29;
return 28;
}
dateUtil.prototype.nextmonth = function(p_year,p_month) {
p_month=parseInt(p_month);
if(p_month<12)  {p_month +=1; }
else  {
p_year +=1;
p_month =1;
}
return(p_year+"-"+p_month);
}
dateUtil.prototype.nextdate = function(p_year,p_month,p_day)  {
if(p_day<this.monthdays(p_year,p_month)) {p_day +=1; }
else{
if(p_month<12) {
p_month +=1;
p_day = 1;
}
else {
p_year +=1;
p_month =1;
p_day   =1;
}
}
return(p_year+"-"+p_month+"-"+p_day);
}
dateUtil.prototype.validdate = function (p_year,p_month,p_day){
if(!(!isNaN(p_year) && p_year>1000 && p_year<=9999))
return false;
if(!(!isNaN(p_month) && p_month>=1 && p_month<=12))
return false;
if(!(!isNaN(p_day) && p_day>=1 && p_day<=this.monthdays(p_year,p_month)))
return false;
return true;
}
dateUtil.prototype.isDates = function(p_date) {
deli ='';
for(i=0;i<=p_date.length;i++){
c=p_date.substring(i,i+1);
switch (c) {
case '-' : deli = '-'
break;
case '/' : deli = '/'
break;
case ':' : deli = ':'
break;
case '.' : deli = '.'
break;
case ',' : deli = ','
break;
case "'" : deli = "'"
break;
}
if (deli!="") break;
}
if(deli=="") return false;
l_date=p_date.split(deli);
if(l_date.length>3) return false;
try {
if(!this.validdate(l_date[0],l_date[1],l_date[2]))
return false;
}catch(e){return false;}
return true;
}
function dataCheck() {
this.ErrMsg = new Array();
this.ErrMsg[2] = "Please Input Something!";
this.ErrMsg[1] = "Error1!";
return this;
}
dataCheck.prototype.setField = function(p_field) {
this.screenField = p_field;
}
dataCheck.prototype.setName = function(p_name) {
this.screenName = p_name;
}
dataCheck.prototype.setNull = function(p_null) {
this.screenNull = p_null;
}
dataCheck.prototype.setType = function(p_type) {
this.screenType = p_type;
}
dataCheck.prototype.getObj = function(p_form,p_name,p_prefix) {
var obj ;
if(typeof(p_form)=='object') {
obj = eval("p_form."+p_prefix+p_name);
}
else {
obj = eval("document."+p_form+"."+p_prefix+p_name);
}
if(!obj) return false;
return obj;
}
dataCheck.prototype.setMsg = function(p_msg) {
this.ErrMsg = p_msg;
}
dataCheck.prototype.datavalid = function(p_form,p_prefix)  {
var msg = "";
var focusobj ;
var flag = 1;
var f_length = this.screenField.length;
var strUtl = new strUtil('');
for(var i=0;i<f_length;i++)  {
if(typeof(this.screenName[i])=='undefined') continue;
if(this.screenType[i]=="l") {
if(this.screenNull[i]=='1')  continue;
obj = this.getObj(p_form,this.screenField[i],p_prefix);
if(!obj) continue;
if(obj.checked) continue;
var l_len = obj.length;
var chk = false;
for(j=0;j<l_len;j++) {
obj = this.getObj(p_form,this.screenField[i]+"["+j+"]",p_prefix);
if(obj.checked) { chk = true;  break; }
}
if(chk) continue;
msg = msg + this.screenName[i]+" : "+this.ErrMsg[1]+"\n";
if(flag) {
focusobj = obj;
flag = 0;
}
continue;
}
if(this.screenType[i]=="x") {
if(this.screenNull[i]=='1')  continue;
var chk = false;
if(typeof(p_form)=='object') {
if($(p_form).find("input[name='"+p_prefix+this.screenField[i]+"[]']").length==0) continue;
$(p_form).find("input[name='"+p_prefix+this.screenField[i]+"[]']").each(function() {
if($(this).attr("checked")==true || $(this).attr("checked")=='checked'){
chk = true;
return false;
}
});
}else{
if($("form[name="+p_form+"]").find("input[name='"+p_prefix+this.screenField[i]+"[]']").length==0) continue;
$("form[name="+p_form+"]").find("input[name='"+p_prefix+this.screenField[i]+"[]']").each(function() {
if($(this).attr("checked")==true || $(this).attr("checked")=='checked'){
chk = true;
return false;
}
});
}
if(chk) continue;
msg = msg + this.screenName[i]+" : "+this.ErrMsg[1]+"\n";
continue;
}
obj = this.getObj(p_form,this.screenField[i],p_prefix);
if(!obj) continue;
if(!this.screenNull[i] && strUtl.trim(obj.value) == "") {
msg =msg +  this.screenName[i]+ " : "+this.ErrMsg[1]+"\n";
if(flag) { focusobj = obj;  flag = 0; }
}
switch(this.screenType[i]){
case "d":
if(obj.value != "" && !dateUtil.prototype.isDates(obj.value)) {
msg +=  this.screenName[i]+ " : " + this.ErrMsg[3] +" \n";
if(flag) { focusobj = obj;  flag = 0; }
}
break;
case "i":
if(obj.value != "" && !strUtl.isInteger(obj.value)) {
msg +=  this.screenName[i]+ " : "+ this.ErrMsg[2]+" \n";
if(flag) { focusobj = obj;  flag = 0; }
}
break;
case "n":
if(obj.value != "" && isNaN(obj.value)) {
msg += this.screenName[i]+ " : "+ this.ErrMsg[4]+" \n";
if(flag) { focusobj = obj;  flag = 0; }
}
break;
case "f":
if(obj.value != "" && isNaN(obj.value)) {
msg += this.screenName[i]+ " : " + this.ErrMsg[4] +" \n";
if(flag) { focusobj = obj;  flag = 0; }
}
break;
case "l":
if(obj.value != "" && !strUtl.isInteger(obj.value))  {
msg += this.screenName[i]+ " : " + this.ErrMsg[2]+" \n";
if(flag) { focusobj = obj;  flag = 0; }
}
break;
case "e":
if(obj.value != "" && !strUtl.isEmail(obj.value))  {
msg += this.screenName[i]+ " : " + this.ErrMsg[5]+" \n";
if(flag) { focusobj = obj;  flag = 0; }
}
break;
}
}
if(!strUtl.isEmpty(msg))  {
msg = this.ErrMsg[0] + " :\n" + msg ;
alert(msg);
try {
if(!flag)focusobj.focus();
}catch(e){}
return false;
}
return true;
}
function hashUtil() {
this.Storage = new Object();
this.RevStorage = new Object();
this.queueSeq = "";
this.Sep = ";;";
this.Pointer = 0;
this.Length=0;
return this;
}
hashUtil.prototype.put = function(key,value) {
if(this.hasKey(key)) this.remove(key);
this.queueSeq = key+this.Sep+this.queueSeq;
this.Storage[key] = value;
this.RevStorage[value] = key;
this.Length++;
}
hashUtil.prototype.push = function(key,value) {
this.put(key,value);
}
hashUtil.prototype.isEmpty = function() {
if(this.Length>0) return false;
return true;
}
hashUtil.prototype.pop = function() {
var l_key = this.getFirstKey();
var l_val = this.getFirst();
this.remove(l_key);
return l_val;
}
hashUtil.prototype.read = function() {
var ret = this.queueSeq.split(this.Sep);
if(typeof(ret[this.Pointer])=="undefined") return "";
var l_key = ret[this.Pointer++];
var l_val = this.get(l_key);
return l_val;
}
hashUtil.prototype.isEOF = function() {
if(this.Pointer>=this.Length) return true;
return false;
}
hashUtil.prototype.get = function(key) {
if(typeof this.Storage[key] == "undefined") return null;
else return this.Storage[key];
}
hashUtil.prototype.getKey = function(val) {
if(typeof this.RevStorage[val] == "undefined") return null;
return this.RevStorage[val];
}
hashUtil.prototype.mvToFirst = function(key) {
this.queueSeq = this.queueSeq.replace(key+this.Sep,"");
this.queueSeq = key+this.Sep+this.queueSeq;
}
hashUtil.prototype.getFirst = function() {
while(true) {
var key = this.queueSeq.substring(0,this.queueSeq.indexOf(this.Sep));
if(typeof this.Storage[key] == "undefined") {
this.queueSeq = this.queueSeq.substring(this.queueSeq.indexOf(this.Sep));
}
return this.Storage[key];
}
}
hashUtil.prototype.getFirstKey = function() {
while(true) {
var key = this.queueSeq.substring(0,this.queueSeq.indexOf(this.Sep));
if(typeof this.Storage[key] == "undefined") break;
return key;
}
}
hashUtil.prototype.hasKey = function(key) {
if(typeof this.Storage[key] == "undefined") return false;
return true;
}
hashUtil.prototype.hasValue = function(val) {
if(typeof this.RevStorage[val] == "undefined") return false;
return true;
}
hashUtil.prototype.remove = function(key) {
this.queueSeq = this.queueSeq.replace(key+this.Sep,"");
var val = this.Storage[key] ;
delete this.Storage[key];
delete this.RevStorage[val];
this.Length--;
}
hashUtil.prototype.reset = function() {
this.Storage = new Object();
this.RevStorage = new Object();
this.queueSeq = "";
this.Length=0;
this.Pointer = 0;
return this;
}
hashUtil.prototype.resetPointer = function() {
this.Pointer=0;
}
function Scroll(p_width,p_height,p_speed,p_direct){
this.ns = (document.layers)? true:false
this.ie = (document.all)? true:false
this.preTop = 0;
this.preLeft = 0;
this.moveLimit = 0;
this.currentLeft = 0;
this.currentTop = 0;
this.marquee_name = "";
this.template_name = "";
this.marquee_hidden = "";
this.marquee_width = p_width;
this.marquee_height = p_height;
this.marquee_speed = p_speed;
this.marquee_direct = p_direct;
this.setMarObject = setMarObject;
this.setTempObject = setTempObject;
this.setHiddenObject = setHiddenObject;
this.beginScroll = beginScroll;
this.scrollInit = scrollInit;
this.scrollUp = scrollUp;
this.scrollDown = scrollDown;
this.scrollRight = scrollRight;
this.scrollLeft = scrollLeft;
this.getObject = getObject;
return this;
}
function setTempObject(p_obj){
this.template_name = p_obj;
}
function setMarObject(p_obj){
this.marquee_name = p_obj;
}
function setHiddenObject(p_obj){
this.marquee_hidden = p_obj;
}
function getObject(p_obj){
if(typeof(p_obj)=="string") {
if(this.ie) return  eval("document.all."+p_obj);
else return document.getElementById(p_obj);//Joyce firefox method
} else {
if(this.ie) return eval("p_obj");
else return p_obj;
}
}
function beginScroll(){
var marq = this.getObject(this.marquee_name);
var temp = this.getObject(this.template_name);
with(marq){
style.height = this.marquee_height+'px';//Joyce add "px"
if(this.marquee_direct == 'up' || this.marquee_direct == 'down'){
style.overflowX="visible";
style.overflowY="hidden";
}
else{
style.overflowX="hidden";
style.overflowY="visible";
}
var myStopValue = this.marquee_hidden+ "= 1";
var myStartValue = this.marquee_hidden + "=0";
marq.onmouseover = new Function(myStopValue);
marq.onmouseout = new Function(myStartValue);
}
}
function scrollInit(){
var marq = this.getObject(this.marquee_name);
var temp = this.getObject(this.template_name);
var tmpstr;
var Nheight=this.marquee_height/4;
var Nwidth=this.marquee_width/4;
if(this.marquee_direct == "up" || this.marquee_direct == "down")
marq.innerHTML += "<span style='height:"+Nheight+"px;'></span>";
else
marq.innerHTML += "<span style='width:"+Nwidth+"px;'></span>";
tmpstr =  marq.innerHTML;
if(this.marquee_direct == "up" || this.marquee_direct == "down"){
marq.noWrap = false;
temp.noWrap = false;
var marq_height = temp.offsetHeight;
var counter = 0;
while(!marq_height) {
if(counter++>1000) { marq_height=100; break; }
marq_height = temp.offsetHeight;
}
while(marq_height < this.marquee_height){
marq_height += marq_height;
tmpstr+=marq.innerHTML;
}
}else{
marq.noWrap = true;
temp.noWrap = true;
var marq_width = temp.offsetWidth;
var counter = 0;
while(!marq_width) {
if(counter++>1000) { marq_width=100; break; }
marq_width = temp.offsetWidth;
}
while(marq_width < this.marquee_width){
marq_width += marq_width;
tmpstr+=marq.innerHTML;
}
}
if(this.marquee_direct == "up" || this.marquee_direct == "down"){
if(temp.offsetHeight<2*marq.offsetHeight)
marq.innerHTML = tmpstr+tmpstr;
else
marq.innerHTML = tmpstr;
}
else {
if(temp.offsetWidth<2*marq.offsetWidth)
marq.innerHTML = tmpstr+tmpstr;
else
marq.innerHTML = tmpstr;
}
temp.innerHTML = "";
var param_up = "this.scrollUp('"+this.marquee_name+"','"+this.template_name+"',"+this.marquee_hidden+","+this.marquee_height+")";
var param_down = "this.scrollDown('"+this.marquee_name+"','"+this.template_name+"','"+this.marquee_hidden+"',"+this.marquee_height+")";
var param_left = "this.scrollLeft('"+this.marquee_name+"','"+this.template_name+"',"+this.marquee_hidden+","+this.marquee_width+")";
var param_right = "this.scrollRight('"+this.marquee_name+"','"+this.template_name+"','"+this.marquee_hidden+"',"+this.marquee_width+")";
if(this.marquee_direct == "up")
setInterval(param_up,this.marquee_speed);
if(this.marquee_direct == "left")
setInterval(param_left,this.marquee_speed);
if(this.marquee_direct == "right")
setInterval(param_right,this.marquee_speed);
if(this.marquee_direct == "down")
setInterval(param_down,this.marquee_speed);
}
function scrollUp(p_marquee,p_template,p_stop,p_height){
var stop_value = eval(p_stop);
if(stop_value == 1) return;
var marq = this.getObject(p_marquee);
var temp = this.getObject(p_template);
this.preTop = marq.scrollTop;
marq.scrollTop += 1;
if(this.preTop == marq.scrollTop){
marq.scrollTop = temp.offsetHeight- p_height + 1;
marq.scrollTop += 1;
}
}
function scrollRight(p_marquee,p_template,p_stop,p_width){
var stop_value = eval(p_stop);
if(stop_value == 1) return;
var marq = this.getObject(p_marquee);
var temp = this.getObject(p_template);
this.preLeft = marq.scrollLeft;
marq.scrollLeft -= 1;
if(this.preLeft == marq.scrollLeft){
if(!this.moveLimit){
marq.scrollLeft = temp.offsetWidth*2;
this.moveLimit = marq.scrollLeft;
}
marq.scrollLeft = this.moveLimit - temp.offsetWidth + p_width;
marq.scrollLeft -= 1;
}
}
function scrollDown(p_marquee,p_template,p_stop,p_height){
var stop_value = eval(p_stop);
if(stop_value == 1) return;
var marq = this.getObject(p_marquee);
var temp = this.getObject(p_template);
this.preTop = marq.scrollTop;
marq.scrollTop -= 1;
if(this.preTop == marq.scrollTop){
if(!this.moveLimit){
marq.scrollTop = temp.offsetHeight*2;
this.moveLimit = marq.scrollTop;
}
marq.scrollTop = this.moveLimit - temp.offsetHeight + p_height;
marq.scrollTop -= 1;
}
}
function scrollLeft(p_marquee,p_template,p_stop,p_width){
var stop_value = eval(p_stop);
if(stop_value == 1) return;
var marq = this.getObject(p_marquee);
var temp = this.getObject(p_template);
marq.noWrap = true;
this.preLeft = marq.scrollLeft;
marq.scrollLeft = marq.scrollLeft + 1;
if(this.preLeft == marq.scrollLeft){
marq.scrollLeft = temp.offsetWidth - p_width + 1;
marq.scrollLeft += 1;
}
}
function begin_frame(p_id,p_pct, p_pix,p_height,p_speed) {
marq_frame = new Scroll(marqueWidth,p_height,p_speed,'up');
if(p_pct>0)
var marqueWidth = screen.width * p_pct * 0.82 / 100 ;
if(p_pix>0)
var marqueWidth = p_pix;
marq_frame.setMarObject(p_id);
marq_frame.setTempObject(p_id+"_temp");
marq_frame.setHiddenObject(p_id+"_stop");
marq_frame.beginScroll();
marq_frame.scrollInit();
}
function startScroll(marquee_id,p_height,p_speed) {
if(typeof(marquee_id)=="object") {
marquee_id = marquee_id.id;
}
eval(marquee_id+"_stop =0;");
eval(marquee_id+"_Width =0;");
eval("marq_"+marquee_id+" = new Scroll("+marquee_id+"_Width,p_height,p_speed,'up');");
eval("marq_"+marquee_id+".setMarObject('"+marquee_id+"');");
eval("marq_"+marquee_id+".setTempObject('"+marquee_id+"_temp');");
eval("marq_"+marquee_id+".setHiddenObject('"+marquee_id+"_stop');");
eval("marq_"+marquee_id+".beginScroll();");
eval("marq_"+marquee_id+".scrollInit();");
}
function resize(p_TagName,p_fix,p_home) {
if (!p_TagName) p_TagName="C0";
if (!p_fix) p_fix=0;
var WinHeight = document.documentElement.clientHeight - (p_fix);
try{
var editor = eval(p_TagName+"_editor");
extrafix = editor.BGExtraFix;
} catch (e) {
extrafix = 0;
}
try{
var mc1 = document.getElementById("main");
var mc2 = document.getElementById("sidebar");
var mc3 = eval("document.getElementById('"+p_TagName+"_maincontent')");
var mc4 = document.getElementById("listTB");
var statusbar = document.getElementById(p_TagName+"_statusbar");
var statHeight = 0;
if(typeof(statusbar)=="object") {
try{
statHeight = statusbar.clientHeight;
}catch(e) {}
}
mc1.style.height = (WinHeight - 60)+"px";
mc2.style.height = (WinHeight - 62)+"px";
mc3.style.height = (WinHeight - 125-statHeight)+"px";
if(eval("document.getElementById('"+p_TagName+"_mainDiv')")){
var mc3 = eval("document.getElementById('"+p_TagName+"_mainDiv')");
var mc4 = eval("document.getElementById('"+p_TagName+"_showDiv')");
mc3.style.height = (WinHeight - 125 - statHeight-extrafix)+"px";
mc4.style.height = (WinHeight - 125)+"px";
}
if(eval("document.getElementById('"+p_TagName+"_mainPgDiv')")){
var mc3 = eval("document.getElementById('"+p_TagName+"_mainPgDiv')");
var mc4 = eval("document.getElementById('"+p_TagName+"_showDiv')");
mc3.style.height = (WinHeight - 155 - statHeight-extrafix)+"px";
mc4.style.height = (WinHeight - 125)+"px";
}
}catch(e){}//alert(e.message)}
checktab(30,3);
}
function ShowHide() {
for (i=0;i<ShowHide.arguments.length;i++) {
var _item = document.getElementById(ShowHide.arguments[i]);
if (_item.className == (ShowHide.arguments[i]+"_1")) {
_item.className = ShowHide.arguments[i]+"_2";
} else {
_item.className = ShowHide.arguments[i]+"_1";
}
}
}
function chgBG(_item,_bgcolor) {
_item.style.backgroundColor = _bgcolor;
}
function swapStyle(_item,_bdcolor,_bgcolor) {
var oricolor = _item.style.borderColor;
var oribgcolor = _item.style.backgroundColor;
_item.style.borderColor = _bdcolor;
_item.style.backgroundColor = _bgcolor;
_item.onmouseout = function() {
this.style.borderColor = oricolor;
this.style.backgroundColor = oribgcolor;
}
}
function swapImage(_image,newsrc) {
var _img = document.getElementById(_image);
var oriimg = _img.src;
_img.src = newsrc;
_image.onmouseout = function() {
_img.src = oriimg;
}
}
function chgClass(_obj) {
_obj.className = "info_actived";
_obj.onblur = function() {
this.className = "info_normal";
}
}
function chgStyle(_obj,_bdcolor,_bgcolor) {
if (!_bdcolor) _bdcolor = "#008080";
if (!_bgcolor) _bgcolor = "#FFFFF0";
var oribdcolor = _obj.style.borderColor;
var oribgcolor = _obj.style.backgroundColor;
_obj.style.borderColor = _bdcolor;
_obj.style.backgroundColor = _bgcolor;
_obj.onblur = function() {
this.style.borderColor = oribdcolor;
this.style.backgroundColor = oribgcolor;
}
}
function chgImage(_image,newsrc) {
var _img = document.getElementById(_image);
_img.src = newsrc;
}
function swapClassName(_Item,_class) {
var oriclassName = _Item.className;
_Item.className = _class;
_Item.onmouseout = function() {
_Item.className = oriclassName;
}
}
function setClassName(pid,val) {
document.getElementById(pid).className = val;
}
function selectOnce(p_type,p_obj,p_id,p_cnt){
for(var i=1;i<=p_cnt;i++){
var obj = p_obj+i;
var obj_id = p_id+i;
if(p_type==i){
document.getElementById(obj).className = "o_block";
document.getElementById(obj_id).className = "now";
}else{
document.getElementById(obj).className = "o_none";
document.getElementById(obj_id).className = "no";
}
}
}
function findElementId(pid, cid) {
var a = document.getElementById(pid).getElementsByTagName(cid);
var pData = Array(a.length);
for (i=0;i<a.length;i++){
pData[i] = Array(a[i].id);
}
return pData;
}
function findElementText(pid, cid) {
var navi = window.navigator.userAgent.toUpperCase();
var a = document.getElementById(pid).getElementsByTagName(cid);
var pData = Array(a.length);
for (i=0;i<a.length;i++){
if (navi.indexOf("FIREFOX")>=1)
pData[i] = Array(a[i].textContent);
else
pData[i] = Array(a[i].innerText);
}
return pData;
}
var allItem = new Array();
function checktab(_ext,space) {
var _allItem = new Array();
var showItem = new Array();
var hideItem = new Array();
var hideItemName = new Array();
var pData = findElementId("maintbul","li");
var pName =	findElementText("maintbul","li");
var a = pData.length;
var b = document.getElementById("main").clientWidth;
var allwidth = j = k = 0;
for (i=0;i<a;i++ ) {
allwidth = allwidth + space + document.getElementById(pData[i]).clientWidth;
if ((allwidth+_ext) < b) {
showItem[j] = pData[i];
j++;
} else {
hideItem[k] = pData[i];
hideItemName[k] = pName[i];
k++;
}
}
if (hideItem.length>0) {
var _hideItem = "";
for (m=0;m<hideItem.length;m++ ) {
var tagId = hideItem[m].toString();
var tagName = hideItemName[m].toString();
var tagSeq = tagId.slice(1);
_hideItem = _hideItem + "'<span class=\"extTab\"><a href=\"javascript:void(null)\" onclick=\"divOs.selectTag("+tagSeq+");hideExtTab();\">"+tagName+"</a><span>&nbsp;&nbsp;<span style=\"text-align:right;\"><a href=\"javascript:void(null)\" onclick=\"divOs.delTag("+tagSeq+");checktab(30,3);\">X</span>',";
document.getElementById("exttab").style.display = "none";
}
_hideItem=_hideItem.slice(0,-1);
setTimeout("showExt("+_hideItem+")",200);
} else {
hideExt();
}
_allItem[0]=showItem;
_allItem[1]=hideItem;
allItem = _allItem;
}
function showExt() {
var _Ext = document.getElementById("exttab");
var _ExtArrow = document.getElementById("exttabarrow");
var _ExtVal = "";
_ExtArrow.style.display = "block";
_Ext.innerHTML = "";
for (i=0; i<showExt.arguments.length; i++) {
var obj = document.createElement("div");
obj.innerHTML = showExt.arguments[i];
_Ext.appendChild(obj);
}
}
function hideExt() {
document.getElementById("exttab").style.display = "none";
document.getElementById("exttabarrow").style.display = "none";
}
function hideExtTab() {
try{
document.getElementById("exttab").style.display = "none";
}catch(e){}
}
function showTab(p_tabDiv){
if (!p_tabDiv) p_tabDiv = "exttab";
var tabDiv = document.getElementById(p_tabDiv);
if (tabDiv.style.display=='none'){
tabDiv.style.display='block';
}
else{
tabDiv.style.display='none';
}
}
function addInputTips(p_id,p_tips,p_nextClass,p_parentClass){
if(!p_id || !p_tips)	return false;
if(typeof p_id == 'string' && !$('#'+p_id).length) return false;
if(typeof p_id == 'string'){
var obj = $('#'+p_id)
}else if(typeof p_id == 'object'){
var obj = $(p_id).prev();
$(p_id).remove();
}
if('placeholder' in document.createElement('input')){
obj.attr('placeholder',p_tips).attr('autocomplete','off');
return false;
}
var nextClass = p_nextClass ? p_nextClass : 'inputtips';
var parentClass = p_parentClass ? p_parentClass : 'inputtipsouter';
obj.wrap('<span class="'+parentClass+'"></span>');
var span = $('<span>');
span.addClass(nextClass);
obj.after(span);
span.html(p_tips).click(function(){
var p = obj;
p.focus();
if($.trim(p.val()) != '') $(this).hide();
else $(this).show();
});
obj.focus(function(){
dealTips();
});
obj.blur(function(){
dealTips();
});
obj.keydown(function(){
dealTips();
});
obj.keyup(function(){
dealTips();
});
obj.attr('autocomplete','off');
span.css({'margin-top':-(span.height()/2)});
setTimeout(function(){
span.css({'margin-top':-(span.height()/2)});
},1000);
function dealTips(){
if($.trim(obj.val()) == ''){
obj.next('span').show();
}else{
obj.next('span').hide();
}
}
}
if(typeof(sajax_request_type)=='undefined') sajax_request_type = 'POST';
if(typeof(sajax_debug_mode)=='undefined') sajax_debug_mode = false;
function sajax_debug(text) {
if (sajax_debug_mode)	alert("RSD: " + text)
}
function sajax_do_call(func_name, args) {
var i, n;
var uri;
var post_data;
uri = uri_in_sajax;
if (sajax_request_type == "GET") {
if (uri.indexOf("?") == -1)
uri = uri + "?rs=" + escape(func_name);
else
uri = uri + "&rs=" + escape(func_name);
for (i = 0; i < args.length-1; i++)
uri = uri + "&rsargs[]=" + escape(args[i]);
uri = uri + "&rsrnd=" + new Date().getTime();
post_data = null;
} else {
post_data = "rs=" + escape(func_name);
for (i = 0; i < args.length-1; i++)
post_data = post_data + "&rsargs[]=" + escape(args[i]);
}
var process_data="false";
if (sajax_request_type == "POST") {
process_data="true";
}
$.ajax({
type:	sajax_request_type,
url:	uri,
processData:	process_data,
data:	post_data,
beforeSend: function(XMLHttpRequest){
sajax_debug("before send");
},
success: function(data,textStatus){
if(textStatus!="success")	return;
sajax_debug("received " + data);
var status;
var p_data;
var mark;
status = data.charAt(0);
p_data = data.substring(2);
if (status == "-")
alert("Error: " + p_data);
else if(status== "+"){
args[args.length-1](p_data);
}
else if(status=="="){
args[args.length-1](p_data);
}
else {
if(data.replace(/(^[\s]*)|([\s]*$)/g,"")=='') return;
args[args.length-1](data);
}
},
complete: function(XMLHttpRequest, textStatus){
sajax_debug("complete send");
},
error: function(XMLHttpRequest, textStatus, errorThrown){
try{
divOs.closeWaitingWindow('sending');
sajax_debug("ajax error");
}catch(e) {}
}
});
sajax_debug(func_name + " uri = " + uri + "/post = " + post_data);
sajax_debug(func_name + " waiting..");
}
var whitespace = "\n\r\t ";
XMLP = function(strXML) {
strXML = SAXStrings.replace(strXML, null, null, "\r\n", "\n");
strXML = SAXStrings.replace(strXML, null, null, "\r", "\n");
this.m_xml = strXML;
this.m_iP = 0;
this.m_iState = XMLP._STATE_PROLOG;
this.m_stack = new Stack();
this._clearAttributes();
}
XMLP._NONE= 0;
XMLP._ELM_B= 1;
XMLP._ELM_E= 2;
XMLP._ELM_EMP = 3;
XMLP._ATT = 4;
XMLP._TEXT= 5;
XMLP._ENTITY= 6;
XMLP._PI= 7;
XMLP._CDATA= 8;
XMLP._COMMENT = 9;
XMLP._DTD = 10;
XMLP._ERROR= 11;
XMLP._CONT_XML = 0;
XMLP._CONT_ALT = 1;
XMLP._ATT_NAME = 0;
XMLP._ATT_VAL= 1;
XMLP._STATE_PROLOG = 1;
XMLP._STATE_DOCUMENT = 2;
XMLP._STATE_MISC = 3;
XMLP._errs = new Array();
XMLP._errs[XMLP.ERR_CLOSE_PI= 0 ] = "PI: missing closing sequence";
XMLP._errs[XMLP.ERR_CLOSE_DTD= 1 ] = "DTD: missing closing sequence";
XMLP._errs[XMLP.ERR_CLOSE_COMMENT= 2 ] = "Comment: missing closing sequence";
XMLP._errs[XMLP.ERR_CLOSE_CDATA= 3 ] = "CDATA: missing closing sequence";
XMLP._errs[XMLP.ERR_CLOSE_ELM= 4 ] = "Element: missing closing sequence";
XMLP._errs[XMLP.ERR_CLOSE_ENTITY= 5 ] = "Entity: missing closing sequence";
XMLP._errs[XMLP.ERR_PI_TARGET= 6 ] = "PI: target is required";
XMLP._errs[XMLP.ERR_ELM_EMPTY= 7 ] = "Element: cannot be both empty and closing";
XMLP._errs[XMLP.ERR_ELM_NAME= 8 ] = "Element: name must immediatly follow \"<\"";
XMLP._errs[XMLP.ERR_ELM_LT_NAME= 9 ] = "Element: \"<\" not allowed in element names";
XMLP._errs[XMLP.ERR_ATT_VALUES = 10] = "Attribute: values are required and must be in quotes";
XMLP._errs[XMLP.ERR_ATT_LT_NAME= 11] = "Element: \"<\" not allowed in attribute names";
XMLP._errs[XMLP.ERR_ATT_LT_VALUE= 12] = "Attribute: \"<\" not allowed in attribute values";
XMLP._errs[XMLP.ERR_ATT_DUP= 13] = "Attribute: duplicate attributes not allowed";
XMLP._errs[XMLP.ERR_ENTITY_UNKNOWN = 14] = "Entity: unknown entity";
XMLP._errs[XMLP.ERR_INFINITELOOP= 15] = "Infininte loop";
XMLP._errs[XMLP.ERR_DOC_STRUCTURE= 16] = "Document: only comments, processing instructions, or whitespace allowed outside of document element";
XMLP._errs[XMLP.ERR_ELM_NESTING= 17] = "Element: must be nested correctly";
XMLP.prototype._addAttribute = function(name, value) {
this.m_atts[this.m_atts.length] = new Array(name, value);
}
XMLP.prototype._checkStructure = function(iEvent) {
if(XMLP._STATE_PROLOG == this.m_iState) {
if((XMLP._TEXT == iEvent) || (XMLP._ENTITY == iEvent)) {
if(SAXStrings.indexOfNonWhitespace(this.getContent(), this.getContentBegin(), this.getContentEnd()) != -1) {
return this._setErr(XMLP.ERR_DOC_STRUCTURE);
}
}
if((XMLP._ELM_B == iEvent) || (XMLP._ELM_EMP == iEvent)) {
this.m_iState = XMLP._STATE_DOCUMENT;
}
}
if(XMLP._STATE_DOCUMENT == this.m_iState) {
if((XMLP._ELM_B == iEvent) || (XMLP._ELM_EMP == iEvent)) {
this.m_stack.push(this.getName());
}
if((XMLP._ELM_E == iEvent) || (XMLP._ELM_EMP == iEvent)) {
var strTop = this.m_stack.pop();
if((strTop == null) || (strTop != this.getName())) {
return this._setErr(XMLP.ERR_ELM_NESTING);
}
}
if(this.m_stack.count() == 0) {
this.m_iState = XMLP._STATE_MISC;
return iEvent;
}
}
if(XMLP._STATE_MISC == this.m_iState) {
if((XMLP._ELM_B == iEvent) || (XMLP._ELM_E == iEvent) || (XMLP._ELM_EMP == iEvent) || (XMLP.EVT_DTD == iEvent)) {
return this._setErr(XMLP.ERR_DOC_STRUCTURE);
}
if((XMLP._TEXT == iEvent) || (XMLP._ENTITY == iEvent)) {
if(SAXStrings.indexOfNonWhitespace(this.getContent(), this.getContentBegin(), this.getContentEnd()) != -1) {
return this._setErr(XMLP.ERR_DOC_STRUCTURE);
}
}
}
return iEvent;
}
XMLP.prototype._clearAttributes = function() {
this.m_atts = new Array();
}
XMLP.prototype._findAttributeIndex = function(name) {
for(var i = 0; i < this.m_atts.length; i++) {
if(this.m_atts[i][XMLP._ATT_NAME] == name) {
return i;
}
}
return -1;
}
XMLP.prototype.getAttributeCount = function() {
return this.m_atts ? this.m_atts.length : 0;
}
XMLP.prototype.getAttributeName = function(index) {
return ((index < 0) || (index >= this.m_atts.length)) ? null : this.m_atts[index][XMLP._ATT_NAME];
}
XMLP.prototype.getAttributeValue = function(index) {
return ((index < 0) || (index >= this.m_atts.length)) ? null : __unescapeString(this.m_atts[index][XMLP._ATT_VAL]);
}
XMLP.prototype.getAttributeValueByName = function(name) {
return this.getAttributeValue(this._findAttributeIndex(name));
}
XMLP.prototype.getColumnNumber = function() {
return SAXStrings.getColumnNumber(this.m_xml, this.m_iP);
}
XMLP.prototype.getContent = function() {
return (this.m_cSrc == XMLP._CONT_XML) ? this.m_xml : this.m_cAlt;
}
XMLP.prototype.getContentBegin = function() {
return this.m_cB;
}
XMLP.prototype.getContentEnd = function() {
return this.m_cE;
}
XMLP.prototype.getLineNumber = function() {
return SAXStrings.getLineNumber(this.m_xml, this.m_iP);
}
XMLP.prototype.getName = function() {
return this.m_name;
}
XMLP.prototype.next = function() {
return this._checkStructure(this._parse());
}
XMLP.prototype._parse = function() {
if(this.m_iP == this.m_xml.length) {
return XMLP._NONE;
}
if(this.m_iP == this.m_xml.indexOf("<?", this.m_iP)) {
return this._parsePI (this.m_iP + 2);
}
else if(this.m_iP == this.m_xml.indexOf("<!DOCTYPE", this.m_iP)) {
return this._parseDTD (this.m_iP + 9);
}
else if(this.m_iP == this.m_xml.indexOf("<!--", this.m_iP)) {
return this._parseComment(this.m_iP + 4);
}
else if(this.m_iP == this.m_xml.indexOf("<![CDATA[", this.m_iP)) {
return this._parseCDATA (this.m_iP + 9);
}
else if(this.m_iP == this.m_xml.indexOf("<", this.m_iP)) {
return this._parseElement(this.m_iP + 1);
}
else if(this.m_iP == this.m_xml.indexOf("&", this.m_iP)) {
return this._parseEntity (this.m_iP + 1);
}
else{
return this._parseText (this.m_iP);
}
}
XMLP.prototype._parseAttribute = function(iB, iE) {
var iNB, iNE, iEq, iVB, iVE;
var cQuote, strN, strV;
this.m_cAlt = "";
iNB = SAXStrings.indexOfNonWhitespace(this.m_xml, iB, iE);
if((iNB == -1) ||(iNB >= iE)) {
return iNB;
}
iEq = this.m_xml.indexOf("=", iNB);
if((iEq == -1) || (iEq > iE)) {
return this._setErr(XMLP.ERR_ATT_VALUES);
}
iNE = SAXStrings.lastIndexOfNonWhitespace(this.m_xml, iNB, iEq);
iVB = SAXStrings.indexOfNonWhitespace(this.m_xml, iEq + 1, iE);
if((iVB == -1) ||(iVB > iE)) {
return this._setErr(XMLP.ERR_ATT_VALUES);
}
cQuote = this.m_xml.charAt(iVB);
if(SAXStrings.QUOTES.indexOf(cQuote) == -1) {
return this._setErr(XMLP.ERR_ATT_VALUES);
}
iVE = this.m_xml.indexOf(cQuote, iVB + 1);
if((iVE == -1) ||(iVE > iE)) {
return this._setErr(XMLP.ERR_ATT_VALUES);
}
strN = this.m_xml.substring(iNB, iNE + 1);
strV = this.m_xml.substring(iVB + 1, iVE);
if(strN.indexOf("<") != -1) {
return this._setErr(XMLP.ERR_ATT_LT_NAME);
}
if(strV.indexOf("<") != -1) {
return this._setErr(XMLP.ERR_ATT_LT_VALUE);
}
strV = SAXStrings.replace(strV, null, null, "\n", " ");
strV = SAXStrings.replace(strV, null, null, "\t", " ");
iRet = this._replaceEntities(strV);
if(iRet == XMLP._ERROR) {
return iRet;
}
strV = this.m_cAlt;
if(this._findAttributeIndex(strN) == -1) {
this._addAttribute(strN, strV);
}
else {
return this._setErr(XMLP.ERR_ATT_DUP);
}
this.m_iP = iVE + 2;
return XMLP._ATT;
}
XMLP.prototype._parseCDATA = function(iB) {
var iE = this.m_xml.indexOf("]]>", iB);
if (iE == -1) {
return this._setErr(XMLP.ERR_CLOSE_CDATA);
}
this._setContent(XMLP._CONT_XML, iB, iE);
this.m_iP = iE + 3;
return XMLP._CDATA;
}
XMLP.prototype._parseComment = function(iB) {
var iE = this.m_xml.indexOf("-" + "->", iB);
if (iE == -1) {
return this._setErr(XMLP.ERR_CLOSE_COMMENT);
}
this._setContent(XMLP._CONT_XML, iB, iE);
this.m_iP = iE + 3;
return XMLP._COMMENT;
}
XMLP.prototype._parseDTD = function(iB) {
var iE, strClose, iInt, iLast;
iE = this.m_xml.indexOf(">", iB);
if(iE == -1) {
return this._setErr(XMLP.ERR_CLOSE_DTD);
}
iInt = this.m_xml.indexOf("[", iB);
strClose = ((iInt != -1) && (iInt < iE)) ? "]>" : ">";
while(true) {
if(iE == iLast) {
return this._setErr(XMLP.ERR_INFINITELOOP);
}
iLast = iE;
iE = this.m_xml.indexOf(strClose, iB);
if(iE == -1) {
return this._setErr(XMLP.ERR_CLOSE_DTD);
}
if (this.m_xml.substring(iE - 1, iE + 2) != "]]>") {
break;
}
}
this.m_iP = iE + strClose.length;
return XMLP._DTD;
}
XMLP.prototype._parseElement = function(iB) {
var iE, iDE, iNE, iRet;
var iType, strN, iLast;
iDE = iE = this.m_xml.indexOf(">", iB);
if(iE == -1) {
return this._setErr(XMLP.ERR_CLOSE_ELM);
}
if(this.m_xml.charAt(iB) == "/") {
iType = XMLP._ELM_E;
iB++;
} else {
iType = XMLP._ELM_B;
}
if(this.m_xml.charAt(iE - 1) == "/") {
if(iType == XMLP._ELM_E) {
return this._setErr(XMLP.ERR_ELM_EMPTY);
}
iType = XMLP._ELM_EMP;
iDE--;
}
iDE = SAXStrings.lastIndexOfNonWhitespace(this.m_xml, iB, iDE);
if (iE - iB != 1 ) {
if(SAXStrings.indexOfNonWhitespace(this.m_xml, iB, iDE) != iB) {
return this._setErr(XMLP.ERR_ELM_NAME);
}
}
this._clearAttributes();
iNE = SAXStrings.indexOfWhitespace(this.m_xml, iB, iDE);
if(iNE == -1) {
iNE = iDE + 1;
}
else {
this.m_iP = iNE;
while(this.m_iP < iDE) {
if(this.m_iP == iLast) return this._setErr(XMLP.ERR_INFINITELOOP);
iLast = this.m_iP;
iRet = this._parseAttribute(this.m_iP, iDE);
if(iRet == XMLP._ERROR) return iRet;
}
}
strN = this.m_xml.substring(iB, iNE);
if(strN.indexOf("<") != -1) {
return this._setErr(XMLP.ERR_ELM_LT_NAME);
}
this.m_name = strN;
this.m_iP = iE + 1;
return iType;
}
XMLP.prototype._parseEntity = function(iB) {
var iE = this.m_xml.indexOf(";", iB);
if(iE == -1) {
return this._setErr(XMLP.ERR_CLOSE_ENTITY);
}
this.m_iP = iE + 1;
return this._replaceEntity(this.m_xml, iB, iE);
}
XMLP.prototype._parsePI = function(iB) {
var iE, iTB, iTE, iCB, iCE;
iE = this.m_xml.indexOf("?>", iB);
if(iE== -1) {
return this._setErr(XMLP.ERR_CLOSE_PI);
}
iTB = SAXStrings.indexOfNonWhitespace(this.m_xml, iB, iE);
if(iTB == -1) {
return this._setErr(XMLP.ERR_PI_TARGET);
}
iTE = SAXStrings.indexOfWhitespace(this.m_xml, iTB, iE);
if(iTE== -1) {
iTE = iE;
}
iCB = SAXStrings.indexOfNonWhitespace(this.m_xml, iTE, iE);
if(iCB == -1) {
iCB = iE;
}
iCE = SAXStrings.lastIndexOfNonWhitespace(this.m_xml, iCB, iE);
if(iCE== -1) {
iCE = iE - 1;
}
this.m_name = this.m_xml.substring(iTB, iTE);
this._setContent(XMLP._CONT_XML, iCB, iCE + 1);
this.m_iP = iE + 2;
return XMLP._PI;
}
XMLP.prototype._parseText = function(iB) {
var iE, iEE;
iE = this.m_xml.indexOf("<", iB);
if(iE == -1) {
iE = this.m_xml.length;
}
iEE = this.m_xml.indexOf("&", iB);
if((iEE != -1) && (iEE <= iE)) {
iE = iEE;
}
this._setContent(XMLP._CONT_XML, iB, iE);
this.m_iP = iE;
return XMLP._TEXT;
}
XMLP.prototype._replaceEntities = function(strD, iB, iE) {
if(SAXStrings.isEmpty(strD)) return "";
iB = iB || 0;
iE = iE || strD.length;
var iEB, iEE, strRet = "";
iEB = strD.indexOf("&", iB);
iEE = iB;
while((iEB > 0) && (iEB < iE)) {
strRet += strD.substring(iEE, iEB);
iEE = strD.indexOf(";", iEB) + 1;
if((iEE == 0) || (iEE > iE)) {
return this._setErr(XMLP.ERR_CLOSE_ENTITY);
}
iRet = this._replaceEntity(strD, iEB + 1, iEE - 1);
if(iRet == XMLP._ERROR) {
return iRet;
}
strRet += this.m_cAlt;
iEB = strD.indexOf("&", iEE);
}
if(iEE != iE) {
strRet += strD.substring(iEE, iE);
}
this._setContent(XMLP._CONT_ALT, strRet);
return XMLP._ENTITY;
}
XMLP.prototype._replaceEntity = function(strD, iB, iE) {
if(SAXStrings.isEmpty(strD)) return -1;
iB = iB || 0;
iE = iE || strD.length;
switch(strD.substring(iB, iE)) {
case "amp": strEnt = "&"; break;
case "lt": strEnt = "<"; break;
case "gt": strEnt = ">"; break;
case "apos": strEnt = "'"; break;
case "quot": strEnt = "\""; break;
default:
if(strD.charAt(iB) == "#") {
strEnt = String.fromCharCode(parseInt(strD.substring(iB + 1, iE)));
} else {
return this._setErr(XMLP.ERR_ENTITY_UNKNOWN);
}
break;
}
this._setContent(XMLP._CONT_ALT, strEnt);
return XMLP._ENTITY;
}
XMLP.prototype._setContent = function(iSrc) {
var args = arguments;
if(XMLP._CONT_XML == iSrc) {
this.m_cAlt = null;
this.m_cB = args[1];
this.m_cE = args[2];
} else {
this.m_cAlt = args[1];
this.m_cB = 0;
this.m_cE = args[1].length;
}
this.m_cSrc = iSrc;
}
XMLP.prototype._setErr = function(iErr) {
var strErr = XMLP._errs[iErr];
this.m_cAlt = strErr;
this.m_cB = 0;
this.m_cE = strErr.length;
this.m_cSrc = XMLP._CONT_ALT;
return XMLP._ERROR;
}
SAXDriver = function() {
this.m_hndDoc = null;
this.m_hndErr = null;
this.m_hndLex = null;
}
SAXDriver.DOC_B = 1;
SAXDriver.DOC_E = 2;
SAXDriver.ELM_B = 3;
SAXDriver.ELM_E = 4;
SAXDriver.CHARS = 5;
SAXDriver.PI= 6;
SAXDriver.CD_B= 7;
SAXDriver.CD_E= 8;
SAXDriver.CMNT= 9;
SAXDriver.DTD_B = 10;
SAXDriver.DTD_E = 11;
SAXDriver.prototype.parse = function(strD) {
var parser = new XMLP(strD);
if(this.m_hndDoc && this.m_hndDoc.setDocumentLocator) {
this.m_hndDoc.setDocumentLocator(this);
}
this.m_parser = parser;
this.m_bErr = false;
if(!this.m_bErr) {
this._fireEvent(SAXDriver.DOC_B);
}
this._parseLoop();
if(!this.m_bErr) {
this._fireEvent(SAXDriver.DOC_E);
}
this.m_xml = null;
this.m_iP = 0;
}
SAXDriver.prototype.setDocumentHandler = function(hnd) {
this.m_hndDoc = hnd;
}
SAXDriver.prototype.setErrorHandler = function(hnd) {
this.m_hndErr = hnd;
}
SAXDriver.prototype.setLexicalHandler = function(hnd) {
this.m_hndLex = hnd;
}
SAXDriver.prototype.getColumnNumber = function() {
return this.m_parser.getColumnNumber();
}
SAXDriver.prototype.getLineNumber = function() {
return this.m_parser.getLineNumber();
}
SAXDriver.prototype.getMessage = function() {
return this.m_strErrMsg;
}
SAXDriver.prototype.getPublicId = function() {
return null;
}
SAXDriver.prototype.getSystemId = function() {
return null;
}
SAXDriver.prototype.getLength = function() {
return this.m_parser.getAttributeCount();
}
SAXDriver.prototype.getName = function(index) {
return this.m_parser.getAttributeName(index);
}
SAXDriver.prototype.getValue = function(index) {
return this.m_parser.getAttributeValue(index);
}
SAXDriver.prototype.getValueByName = function(name) {
return this.m_parser.getAttributeValueByName(name);
}
SAXDriver.prototype._fireError = function(strMsg) {
this.m_strErrMsg = strMsg;
this.m_bErr = true;
if(this.m_hndErr && this.m_hndErr.fatalError) {
this.m_hndErr.fatalError(this);
}
}
SAXDriver.prototype._fireEvent = function(iEvt) {
var hnd, func, args = arguments, iLen = args.length - 1;
if(this.m_bErr) return;
if(SAXDriver.DOC_B == iEvt) {
func = "startDocument"; hnd = this.m_hndDoc;
}
else if (SAXDriver.DOC_E == iEvt) {
func = "endDocument"; hnd = this.m_hndDoc;
}
else if (SAXDriver.ELM_B == iEvt) {
func = "startElement"; hnd = this.m_hndDoc;
}
else if (SAXDriver.ELM_E == iEvt) {
func = "endElement"; hnd = this.m_hndDoc;
}
else if (SAXDriver.CHARS == iEvt) {
func = "characters"; hnd = this.m_hndDoc;
}
else if (SAXDriver.PI== iEvt) {
func = "processingInstruction"; hnd = this.m_hndDoc;
}
else if (SAXDriver.CD_B== iEvt) {
func = "startCDATA"; hnd = this.m_hndLex;
}
else if (SAXDriver.CD_E== iEvt) {
func = "endCDATA"; hnd = this.m_hndLex;
}
else if (SAXDriver.CMNT== iEvt) {
func = "comment"; hnd = this.m_hndLex;
}
if(hnd && hnd[func]) {
if(0 == iLen) {
hnd[func]();
}
else if (1 == iLen) {
hnd[func](args[1]);
}
else if (2 == iLen) {
hnd[func](args[1], args[2]);
}
else if (3 == iLen) {
hnd[func](args[1], args[2], args[3]);
}
}
}
SAXDriver.prototype._parseLoop = function(parser) {
var iEvent, parser;
parser = this.m_parser;
while(!this.m_bErr) {
iEvent = parser.next();
if(iEvent == XMLP._ELM_B) {
this._fireEvent(SAXDriver.ELM_B, parser.getName(), this);
}
else if(iEvent == XMLP._ELM_E) {
this._fireEvent(SAXDriver.ELM_E, parser.getName());
}
else if(iEvent == XMLP._ELM_EMP) {
this._fireEvent(SAXDriver.ELM_B, parser.getName(), this);
this._fireEvent(SAXDriver.ELM_E, parser.getName());
}
else if(iEvent == XMLP._TEXT) {
this._fireEvent(SAXDriver.CHARS, parser.getContent(), parser.getContentBegin(), parser.getContentEnd() - parser.getContentBegin());
}
else if(iEvent == XMLP._ENTITY) {
this._fireEvent(SAXDriver.CHARS, parser.getContent(), parser.getContentBegin(), parser.getContentEnd() - parser.getContentBegin());
}
else if(iEvent == XMLP._PI) {
this._fireEvent(SAXDriver.PI, parser.getName(), parser.getContent().substring(parser.getContentBegin(), parser.getContentEnd()));
}
else if(iEvent == XMLP._CDATA) {
this._fireEvent(SAXDriver.CD_B);
this._fireEvent(SAXDriver.CHARS, parser.getContent(), parser.getContentBegin(), parser.getContentEnd() - parser.getContentBegin());
this._fireEvent(SAXDriver.CD_E);
}
else if(iEvent == XMLP._COMMENT) {
this._fireEvent(SAXDriver.CMNT, parser.getContent(), parser.getContentBegin(), parser.getContentEnd() - parser.getContentBegin());
}
else if(iEvent == XMLP._DTD) {
}
else if(iEvent == XMLP._ERROR) {
this._fireError(parser.getContent());
}
else if(iEvent == XMLP._NONE) {
return;
}
}
}
SAXStrings = function() {
}
SAXStrings.WHITESPACE = " \t\n\r";
SAXStrings.QUOTES = "\"'";
SAXStrings.getColumnNumber = function(strD, iP) {
if(SAXStrings.isEmpty(strD)) {
return -1;
}
iP = iP || strD.length;
var arrD = strD.substring(0, iP).split("\n");
var strLine = arrD[arrD.length - 1];
arrD.length--;
var iLinePos = arrD.join("\n").length;
return iP - iLinePos;
}
SAXStrings.getLineNumber = function(strD, iP) {
if(SAXStrings.isEmpty(strD)) {
return -1;
}
iP = iP || strD.length;
return strD.substring(0, iP).split("\n").length
}
SAXStrings.indexOfNonWhitespace = function(strD, iB, iE) {
if(SAXStrings.isEmpty(strD)) {
return -1;
}
iB = iB || 0;
iE = iE || strD.length;
for(var i = iB; i < iE; i++){
if(SAXStrings.WHITESPACE.indexOf(strD.charAt(i)) == -1) {
return i;
}
}
return -1;
}
SAXStrings.indexOfWhitespace = function(strD, iB, iE) {
if(SAXStrings.isEmpty(strD)) {
return -1;
}
iB = iB || 0;
iE = iE || strD.length;
for(var i = iB; i < iE; i++) {
if(SAXStrings.WHITESPACE.indexOf(strD.charAt(i)) != -1) {
return i;
}
}
return -1;
}
SAXStrings.isEmpty = function(strD) {
return (strD == null) || (strD.length == 0);
}
SAXStrings.lastIndexOfNonWhitespace = function(strD, iB, iE) {
if(SAXStrings.isEmpty(strD)) {
return -1;
}
iB = iB || 0;
iE = iE || strD.length;
for(var i = iE - 1; i >= iB; i--){
if(SAXStrings.WHITESPACE.indexOf(strD.charAt(i)) == -1){
return i;
}
}
return -1;
}
SAXStrings.replace = function(strD, iB, iE, strF, strR) {
if(SAXStrings.isEmpty(strD)) {
return "";
}
iB = iB || 0;
iE = iE || strD.length;
return strD.substring(iB, iE).split(strF).join(strR);
}
Stack = function() {
this.m_arr = new Array();
}
Stack.prototype.clear = function() {
this.m_arr = new Array();
}
Stack.prototype.count = function() {
return this.m_arr.length;
}
Stack.prototype.destroy = function() {
this.m_arr = null;
}
Stack.prototype.peek = function() {
if(this.m_arr.length == 0) {
return null;
}
return this.m_arr[this.m_arr.length - 1];
}
Stack.prototype.pop = function() {
if(this.m_arr.length == 0) {
return null;
}
var o = this.m_arr[this.m_arr.length - 1];
this.m_arr.length--;
return o;
}
Stack.prototype.push = function(o) {
this.m_arr[this.m_arr.length] = o;
}
function isEmpty(str) {
return (str==null) || (str.length==0);
}
function trim(trimString, leftTrim, rightTrim) {
if (isEmpty(trimString)) {
return "";
}
if (leftTrim == null) {
leftTrim = true;
}
if (rightTrim == null) {
rightTrim = true;
}
var left=0;
var right=0;
var i=0;
var k=0;
if (leftTrim == true) {
while ((i<trimString.length) && (whitespace.indexOf(trimString.charAt(i++))!=-1)) {
left++;
}
}
if (rightTrim == true) {
k=trimString.length-1;
while((k>=left) && (whitespace.indexOf(trimString.charAt(k--))!=-1)) {
right++;
}
}
return trimString.substring(left, trimString.length - right);
}
function __escapeString(str) {
var escAmpRegEx = /&/g;
var escLtRegEx = /</g;
var escGtRegEx = />/g;
var quotRegEx = /"/g;
var aposRegEx = /'/g;
str = str.replace(escAmpRegEx, "&amp;");
str = str.replace(escLtRegEx, "&lt;");
str = str.replace(escGtRegEx, "&gt;");
str = str.replace(quotRegEx, "&quot;");
str = str.replace(aposRegEx, "&apos;");
return str;
}
function __unescapeString(str) {
var escAmpRegEx = /&amp;/g;
var escLtRegEx = /&lt;/g;
var escGtRegEx = /&gt;/g;
var quotRegEx = /&quot;/g;
var aposRegEx = /&apos;/g;
str = str.replace(escAmpRegEx, "&");
str = str.replace(escLtRegEx, "<");
str = str.replace(escGtRegEx, ">");
str = str.replace(quotRegEx, "\"");
str = str.replace(aposRegEx, "'");
return str;
}
function addClass(classCollectionStr, newClass) {
if (classCollectionStr) {
if (classCollectionStr.indexOf("|"+ newClass +"|") < 0) {
classCollectionStr += newClass + "|";
}
}
else {
classCollectionStr = "|"+ newClass + "|";
}
return classCollectionStr;
}
DOMException = function(code) {
this._class = addClass(this._class, "DOMException");
this.code = code;
};
DOMException.INDEX_SIZE_ERR= 1;
DOMException.DOMSTRING_SIZE_ERR= 2;
DOMException.HIERARCHY_REQUEST_ERR= 3;
DOMException.WRONG_DOCUMENT_ERR= 4;
DOMException.INVALID_CHARACTER_ERR= 5;
DOMException.NO_DATA_ALLOWED_ERR= 6;
DOMException.NO_MODIFICATION_ALLOWED_ERR= 7;
DOMException.NOT_FOUND_ERR = 8;
DOMException.NOT_SUPPORTED_ERR= 9;
DOMException.INUSE_ATTRIBUTE_ERR= 10;
DOMException.INVALID_STATE_ERR= 11;
DOMException.SYNTAX_ERR = 12;
DOMException.INVALID_MODIFICATION_ERR= 13;
DOMException.NAMESPACE_ERR = 14;
DOMException.INVALID_ACCESS_ERR= 15;
DOMImplementation = function() {
this._class = addClass(this._class, "DOMImplementation");
this._p = null;
this.preserveWhiteSpace = false;
this.namespaceAware = true;
this.errorChecking= true;
};
DOMImplementation.prototype.escapeString = function DOMNode__escapeString(str) {
return __escapeString(str);
};
DOMImplementation.prototype.unescapeString = function DOMNode__unescapeString(str) {
return __unescapeString(str);
};
DOMImplementation.prototype.hasFeature = function DOMImplementation_hasFeature(feature, version) {
var ret = false;
if (feature.toLowerCase() == "xml") {
ret = (!version || (version == "1.0") || (version == "2.0"));
}
else if (feature.toLowerCase() == "core") {
ret = (!version || (version == "2.0"));
}
return ret;
};
DOMImplementation.prototype.loadXML = function DOMImplementation_loadXML(xmlStr) {
var parser;
try {
parser = new XMLP(xmlStr);
}
catch (e) {
alert("Error Creating the SAX Parser. Did you include xmlsax.js or tinyxmlsax.js in your web page?\nThe SAX parser is needed to populate XML for <SCRIPT>'s W3C DOM Parser with data.");
}
var doc = new DOMDocument(this);
this._parseLoop(doc, parser);
doc._parseComplete = true;
return doc;
};
DOMImplementation.prototype.translateErrCode = function DOMImplementation_translateErrCode(code) {
var msg = "";
switch (code) {
case DOMException.INDEX_SIZE_ERR :
msg = "INDEX_SIZE_ERR: Index out of bounds";
break;
case DOMException.DOMSTRING_SIZE_ERR :
msg = "DOMSTRING_SIZE_ERR: The resulting string is too long to fit in a DOMString";
break;
case DOMException.HIERARCHY_REQUEST_ERR :
msg = "HIERARCHY_REQUEST_ERR: The Node can not be inserted at this location";
break;
case DOMException.WRONG_DOCUMENT_ERR :
msg = "WRONG_DOCUMENT_ERR: The source and the destination Documents are not the same";
break;
case DOMException.INVALID_CHARACTER_ERR :
msg = "INVALID_CHARACTER_ERR: The string contains an invalid character";
break;
case DOMException.NO_DATA_ALLOWED_ERR :
msg = "NO_DATA_ALLOWED_ERR: This Node / NodeList does not support data";
break;
case DOMException.NO_MODIFICATION_ALLOWED_ERR :
msg = "NO_MODIFICATION_ALLOWED_ERR: This object cannot be modified";
break;
case DOMException.NOT_FOUND_ERR :
msg = "NOT_FOUND_ERR: The item cannot be found";
break;
case DOMException.NOT_SUPPORTED_ERR :
msg = "NOT_SUPPORTED_ERR: This implementation does not support function";
break;
case DOMException.INUSE_ATTRIBUTE_ERR :
msg = "INUSE_ATTRIBUTE_ERR: The Attribute has already been assigned to another Element";
break;
case DOMException.INVALID_STATE_ERR :
msg = "INVALID_STATE_ERR: The object is no longer usable";
break;
case DOMException.SYNTAX_ERR :
msg = "SYNTAX_ERR: Syntax error";
break;
case DOMException.INVALID_MODIFICATION_ERR :
msg = "INVALID_MODIFICATION_ERR: Cannot change the type of the object";
break;
case DOMException.NAMESPACE_ERR :
msg = "NAMESPACE_ERR: The namespace declaration is incorrect";
break;
case DOMException.INVALID_ACCESS_ERR :
msg = "INVALID_ACCESS_ERR: The object does not support this function";
break;
default :
msg = "UNKNOWN: Unknown Exception Code ("+ code +")";
}
return msg;
}
DOMImplementation.prototype._parseLoop = function DOMImplementation__parseLoop(doc, p) {
var iEvt, iNode, iAttr, strName;
iNodeParent = doc;
var el_close_count = 0;
var entitiesList = new Array();
var textNodesList = new Array();
if (this.namespaceAware) {
var iNS = doc.createNamespace("");
iNS.setValue("http://www.w3.org/2000/xmlns/");
doc._namespaces.setNamedItem(iNS);
}
while(true) {
iEvt = p.next();
if (iEvt == XMLP._ELM_B) {
var pName = p.getName();
pName = trim(pName, true, true);
if (!this.namespaceAware) {
iNode = doc.createElement(p.getName());
for(var i = 0; i < p.getAttributeCount(); i++) {
strName = p.getAttributeName(i);
iAttr = iNode.getAttributeNode(strName);
if(!iAttr) {
iAttr = doc.createAttribute(strName);
}
iAttr.setValue(p.getAttributeValue(i));
iNode.setAttributeNode(iAttr);
}
}
else {
iNode = doc.createElementNS("", p.getName());
iNode._namespaces = iNodeParent._namespaces._cloneNodes(iNode);
for(var i = 0; i < p.getAttributeCount(); i++) {
strName = p.getAttributeName(i);
if (this._isNamespaceDeclaration(strName)) {
var namespaceDec = this._parseNSName(strName);
if (strName != "xmlns") {
iNS = doc.createNamespace(strName);
}
else {
iNS = doc.createNamespace("");
}
iNS.setValue(p.getAttributeValue(i));
iNode._namespaces.setNamedItem(iNS);
}
else {
iAttr = iNode.getAttributeNode(strName);
if(!iAttr) {
iAttr = doc.createAttributeNS("", strName);
}
iAttr.setValue(p.getAttributeValue(i));
iNode.setAttributeNodeNS(iAttr);
if (this._isIdDeclaration(strName)) {
iNode.id = p.getAttributeValue(i);
}
}
}
if (iNode._namespaces.getNamedItem(iNode.prefix)) {
iNode.namespaceURI = iNode._namespaces.getNamedItem(iNode.prefix).value;
}
for (var i = 0; i < iNode.attributes.length; i++) {
if (iNode.attributes.item(i).prefix != "") {
if (iNode._namespaces.getNamedItem(iNode.attributes.item(i).prefix)) {
iNode.attributes.item(i).namespaceURI = iNode._namespaces.getNamedItem(iNode.attributes.item(i).prefix).value;
}
}
}
}
if (iNodeParent.nodeType == DOMNode.DOCUMENT_NODE) {
iNodeParent.documentElement = iNode;
}
iNodeParent.appendChild(iNode);
iNodeParent = iNode;
}
else if(iEvt == XMLP._ELM_E) {
iNodeParent = iNodeParent.parentNode;
}
else if(iEvt == XMLP._ELM_EMP) {
pName = p.getName();
pName = trim(pName, true, true);
if (!this.namespaceAware) {
iNode = doc.createElement(pName);
for(var i = 0; i < p.getAttributeCount(); i++) {
strName = p.getAttributeName(i);
iAttr = iNode.getAttributeNode(strName);
if(!iAttr) {
iAttr = doc.createAttribute(strName);
}
iAttr.setValue(p.getAttributeValue(i));
iNode.setAttributeNode(iAttr);
}
}
else {
iNode = doc.createElementNS("", p.getName());
iNode._namespaces = iNodeParent._namespaces._cloneNodes(iNode);
for(var i = 0; i < p.getAttributeCount(); i++) {
strName = p.getAttributeName(i);
if (this._isNamespaceDeclaration(strName)) {
var namespaceDec = this._parseNSName(strName);
if (strName != "xmlns") {
iNS = doc.createNamespace(strName);
}
else {
iNS = doc.createNamespace("");
}
iNS.setValue(p.getAttributeValue(i));
iNode._namespaces.setNamedItem(iNS);
}
else {
iAttr = iNode.getAttributeNode(strName);
if(!iAttr) {
iAttr = doc.createAttributeNS("", strName);
}
iAttr.setValue(p.getAttributeValue(i));
iNode.setAttributeNodeNS(iAttr);
if (this._isIdDeclaration(strName)) {
iNode.id = p.getAttributeValue(i);
}
}
}
if (iNode._namespaces.getNamedItem(iNode.prefix)) {
iNode.namespaceURI = iNode._namespaces.getNamedItem(iNode.prefix).value;
}
for (var i = 0; i < iNode.attributes.length; i++) {
if (iNode.attributes.item(i).prefix != "") {
if (iNode._namespaces.getNamedItem(iNode.attributes.item(i).prefix)) {
iNode.attributes.item(i).namespaceURI = iNode._namespaces.getNamedItem(iNode.attributes.item(i).prefix).value;
}
}
}
}
if (iNodeParent.nodeType == DOMNode.DOCUMENT_NODE) {
iNodeParent.documentElement = iNode;
}
iNodeParent.appendChild(iNode);
}
else if(iEvt == XMLP._TEXT || iEvt == XMLP._ENTITY) {
var pContent = p.getContent().substring(p.getContentBegin(), p.getContentEnd());
if (!this.preserveWhiteSpace ) {
if (trim(pContent, true, true) == "") {
pContent = "";
}
}
if (pContent.length > 0) {
var textNode = doc.createTextNode(pContent);
iNodeParent.appendChild(textNode);
if (iEvt == XMLP._ENTITY) {
entitiesList[entitiesList.length] = textNode;
}
else {
textNodesList[textNodesList.length] = textNode;
}
}
}
else if(iEvt == XMLP._PI) {
iNodeParent.appendChild(doc.createProcessingInstruction(p.getName(), p.getContent().substring(p.getContentBegin(), p.getContentEnd())));
}
else if(iEvt == XMLP._CDATA) {
pContent = p.getContent().substring(p.getContentBegin(), p.getContentEnd());
if (!this.preserveWhiteSpace) {
pContent = trim(pContent, true, true);
pContent.replace(/ +/g, ' ');
}
if (pContent.length > 0) {
iNodeParent.appendChild(doc.createCDATASection(pContent));
}
}
else if(iEvt == XMLP._COMMENT) {
var pContent = p.getContent().substring(p.getContentBegin(), p.getContentEnd());
if (!this.preserveWhiteSpace) {
pContent = trim(pContent, true, true);
pContent.replace(/ +/g, ' ');
}
if (pContent.length > 0) {
iNodeParent.appendChild(doc.createComment(pContent));
}
}
else if(iEvt == XMLP._DTD) {
}
else if(iEvt == XMLP._ERROR) {
throw(new DOMException(DOMException.SYNTAX_ERR));
}
else if(iEvt == XMLP._NONE) {
if (iNodeParent == doc) {
break;
}
else {
throw(new DOMException(DOMException.SYNTAX_ERR));
}
}
}
var intCount = entitiesList.length;
for (intLoop = 0; intLoop < intCount; intLoop++) {
var entity = entitiesList[intLoop];
var parentNode = entity.getParentNode();
if (parentNode) {
parentNode.normalize();
if(!this.preserveWhiteSpace) {
var children = parentNode.getChildNodes();
var intCount2 = children.getLength();
for ( intLoop2 = 0; intLoop2 < intCount2; intLoop2++) {
var child = children.item(intLoop2);
if (child.getNodeType() == DOMNode.TEXT_NODE) {
var childData = child.getData();
childData = trim(childData, true, true);
childData.replace(/ +/g, ' ');
child.setData(childData);
}
}
}
}
}
if (!this.preserveWhiteSpace) {
var intCount = textNodesList.length;
for (intLoop = 0; intLoop < intCount; intLoop++) {
var node = textNodesList[intLoop];
if (node.getParentNode() != null) {
var nodeData = node.getData();
nodeData = trim(nodeData, true, true);
nodeData.replace(/ +/g, ' ');
node.setData(nodeData);
}
}
}
};
DOMImplementation.prototype._isNamespaceDeclaration = function DOMImplementation__isNamespaceDeclaration(attributeName) {
return (attributeName.indexOf('xmlns') > -1);
}
DOMImplementation.prototype._isIdDeclaration = function DOMImplementation__isIdDeclaration(attributeName) {
return (attributeName.toLowerCase() == 'id');
}
DOMImplementation.prototype._isValidName = function DOMImplementation__isValidName(name) {
return name.match(re_validName);
}
re_validName = /^[a-zA-Z_:][a-zA-Z0-9\.\-_:]*$/;
DOMImplementation.prototype._isValidString = function DOMImplementation__isValidString(name) {
return (name.search(re_invalidStringChars) < 0);
}
re_invalidStringChars = /\x01|\x02|\x03|\x04|\x05|\x06|\x07|\x08|\x0B|\x0C|\x0E|\x0F|\x10|\x11|\x12|\x13|\x14|\x15|\x16|\x17|\x18|\x19|\x1A|\x1B|\x1C|\x1D|\x1E|\x1F|\x7F/
DOMImplementation.prototype._parseNSName = function DOMImplementation__parseNSName(qualifiedName) {
var resultNSName = new Object();
resultNSName.prefix= qualifiedName;
resultNSName.namespaceName= "";
delimPos = qualifiedName.indexOf(':');
if (delimPos > -1) {
resultNSName.prefix = qualifiedName.substring(0, delimPos);
resultNSName.namespaceName = qualifiedName.substring(delimPos +1, qualifiedName.length);
}
return resultNSName;
}
DOMImplementation.prototype._parseQName = function DOMImplementation__parseQName(qualifiedName) {
var resultQName = new Object();
resultQName.localName = qualifiedName;
resultQName.prefix= "";
delimPos = qualifiedName.indexOf(':');
if (delimPos > -1) {
resultQName.prefix= qualifiedName.substring(0, delimPos);
resultQName.localName = qualifiedName.substring(delimPos +1, qualifiedName.length);
}
return resultQName;
}
DOMNodeList = function(ownerDocument, parentNode) {
this._class = addClass(this._class, "DOMNodeList");
this._nodes = new Array();
this.length = 0;
this.parentNode = parentNode;
this.ownerDocument = ownerDocument;
this._readonly = false;
};
DOMNodeList.prototype.getLength = function DOMNodeList_getLength() {
return this.length;
};
DOMNodeList.prototype.item = function DOMNodeList_item(index) {
var ret = null;
if ((index >= 0) && (index < this._nodes.length)) {
ret = this._nodes[index];
}
return ret;
};
DOMNodeList.prototype._findItemIndex = function DOMNodeList__findItemIndex(id) {
var ret = -1;
if (id > -1) {
for (var i=0; i<this._nodes.length; i++) {
if (this._nodes[i]._id == id) {
ret = i;
break;
}
}
}
return ret;
};
DOMNodeList.prototype._insertBefore = function DOMNodeList__insertBefore(newChild, refChildIndex) {
if ((refChildIndex >= 0) && (refChildIndex < this._nodes.length)) {
var tmpArr = new Array();
tmpArr = this._nodes.slice(0, refChildIndex);
if (newChild.nodeType == DOMNode.DOCUMENT_FRAGMENT_NODE) {
tmpArr = tmpArr.concat(newChild.childNodes._nodes);
}
else {
tmpArr[tmpArr.length] = newChild;
}
this._nodes = tmpArr.concat(this._nodes.slice(refChildIndex));
this.length = this._nodes.length;
}
};
DOMNodeList.prototype._replaceChild = function DOMNodeList__replaceChild(newChild, refChildIndex) {
var ret = null;
if ((refChildIndex >= 0) && (refChildIndex < this._nodes.length)) {
ret = this._nodes[refChildIndex];
if (newChild.nodeType == DOMNode.DOCUMENT_FRAGMENT_NODE) {
var tmpArr = new Array();
tmpArr = this._nodes.slice(0, refChildIndex);
tmpArr = tmpArr.concat(newChild.childNodes._nodes);
this._nodes = tmpArr.concat(this._nodes.slice(refChildIndex + 1));
}
else {
this._nodes[refChildIndex] = newChild;
}
}
return ret;
};
DOMNodeList.prototype._removeChild = function DOMNodeList__removeChild(refChildIndex) {
var ret = null;
if (refChildIndex > -1) {
ret = this._nodes[refChildIndex];
var tmpArr = new Array();
tmpArr = this._nodes.slice(0, refChildIndex);
this._nodes = tmpArr.concat(this._nodes.slice(refChildIndex +1));
this.length = this._nodes.length;
}
return ret;
};
DOMNodeList.prototype._appendChild = function DOMNodeList__appendChild(newChild) {
if (newChild.nodeType == DOMNode.DOCUMENT_FRAGMENT_NODE) {
this._nodes = this._nodes.concat(newChild.childNodes._nodes);
}
else {
this._nodes[this._nodes.length] = newChild;
}
this.length = this._nodes.length;
};
DOMNodeList.prototype._cloneNodes = function DOMNodeList__cloneNodes(deep, parentNode) {
var cloneNodeList = new DOMNodeList(this.ownerDocument, parentNode);
for (var i=0; i < this._nodes.length; i++) {
cloneNodeList._appendChild(this._nodes[i].cloneNode(deep));
}
return cloneNodeList;
};
DOMNodeList.prototype.toString = function DOMNodeList_toString() {
var ret = "";
for (var i=0; i < this.length; i++) {
ret += this._nodes[i].toString();
}
return ret;
};
DOMNamedNodeMap = function(ownerDocument, parentNode) {
this._class = addClass(this._class, "DOMNamedNodeMap");
this.DOMNodeList = DOMNodeList;
this.DOMNodeList(ownerDocument, parentNode);
};
DOMNamedNodeMap.prototype = new DOMNodeList;
DOMNamedNodeMap.prototype.getNamedItem = function DOMNamedNodeMap_getNamedItem(name) {
var ret = null;
var itemIndex = this._findNamedItemIndex(name);
if (itemIndex > -1) {
ret = this._nodes[itemIndex];
}
return ret;
};
DOMNamedNodeMap.prototype.setNamedItem = function DOMNamedNodeMap_setNamedItem(arg) {
if (this.ownerDocument.implementation.errorChecking) {
if (this.ownerDocument != arg.ownerDocument) {
throw(new DOMException(DOMException.WRONG_DOCUMENT_ERR));
}
if (this._readonly || (this.parentNode && this.parentNode._readonly)) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if (arg.ownerElement && (arg.ownerElement != this.parentNode)) {
throw(new DOMException(DOMException.INUSE_ATTRIBUTE_ERR));
}
}
var itemIndex = this._findNamedItemIndex(arg.name);
var ret = null;
if (itemIndex > -1) {
ret = this._nodes[itemIndex];
if (this.ownerDocument.implementation.errorChecking && ret._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
else {
this._nodes[itemIndex] = arg;
}
}
else {
this._nodes[this.length] = arg;
}
this.length = this._nodes.length;
arg.ownerElement = this.parentNode;
return ret;
};
DOMNamedNodeMap.prototype.removeNamedItem = function DOMNamedNodeMap_removeNamedItem(name) {
var ret = null;
if (this.ownerDocument.implementation.errorChecking && (this._readonly || (this.parentNode && this.parentNode._readonly))) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
var itemIndex = this._findNamedItemIndex(name);
if (this.ownerDocument.implementation.errorChecking && (itemIndex < 0)) {
throw(new DOMException(DOMException.NOT_FOUND_ERR));
}
var oldNode = this._nodes[itemIndex];
if (this.ownerDocument.implementation.errorChecking && oldNode._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
return this._removeChild(itemIndex);
};
DOMNamedNodeMap.prototype.getNamedItemNS = function DOMNamedNodeMap_getNamedItemNS(namespaceURI, localName) {
var ret = null;
var itemIndex = this._findNamedItemNSIndex(namespaceURI, localName);
if (itemIndex > -1) {
ret = this._nodes[itemIndex];
}
return ret;
};
DOMNamedNodeMap.prototype.setNamedItemNS = function DOMNamedNodeMap_setNamedItemNS(arg) {
if (this.ownerDocument.implementation.errorChecking) {
if (this._readonly || (this.parentNode && this.parentNode._readonly)) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if (this.ownerDocument != arg.ownerDocument) {
throw(new DOMException(DOMException.WRONG_DOCUMENT_ERR));
}
if (arg.ownerElement && (arg.ownerElement != this.parentNode)) {
throw(new DOMException(DOMException.INUSE_ATTRIBUTE_ERR));
}
}
var itemIndex = this._findNamedItemNSIndex(arg.namespaceURI, arg.localName);
var ret = null;
if (itemIndex > -1) {
ret = this._nodes[itemIndex];
if (this.ownerDocument.implementation.errorChecking && ret._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
else {
this._nodes[itemIndex] = arg;
}
}
else {
this._nodes[this.length] = arg;
}
this.length = this._nodes.length;
arg.ownerElement = this.parentNode;
return ret;
};
DOMNamedNodeMap.prototype.removeNamedItemNS = function DOMNamedNodeMap_removeNamedItemNS(namespaceURI, localName) {
var ret = null;
if (this.ownerDocument.implementation.errorChecking && (this._readonly || (this.parentNode && this.parentNode._readonly))) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
var itemIndex = this._findNamedItemNSIndex(namespaceURI, localName);
if (this.ownerDocument.implementation.errorChecking && (itemIndex < 0)) {
throw(new DOMException(DOMException.NOT_FOUND_ERR));
}
var oldNode = this._nodes[itemIndex];
if (this.ownerDocument.implementation.errorChecking && oldNode._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
return this._removeChild(itemIndex);
};
DOMNamedNodeMap.prototype._findNamedItemIndex = function DOMNamedNodeMap__findNamedItemIndex(name) {
var ret = -1;
for (var i=0; i<this._nodes.length; i++) {
if (this._nodes[i].name == name) {
ret = i;
break;
}
}
return ret;
};
DOMNamedNodeMap.prototype._findNamedItemNSIndex = function DOMNamedNodeMap__findNamedItemNSIndex(namespaceURI, localName) {
var ret = -1;
if (localName) {
for (var i=0; i<this._nodes.length; i++) {
if ((this._nodes[i].namespaceURI == namespaceURI) && (this._nodes[i].localName == localName)) {
ret = i;
break;
}
}
}
return ret;
};
DOMNamedNodeMap.prototype._hasAttribute = function DOMNamedNodeMap__hasAttribute(name) {
var ret = false;
var itemIndex = this._findNamedItemIndex(name);
if (itemIndex > -1) {
ret = true;
}
return ret;
}
DOMNamedNodeMap.prototype._hasAttributeNS = function DOMNamedNodeMap__hasAttributeNS(namespaceURI, localName) {
var ret = false;
var itemIndex = this._findNamedItemNSIndex(namespaceURI, localName);
if (itemIndex > -1) {
ret = true;
}
return ret;
}
DOMNamedNodeMap.prototype._cloneNodes = function DOMNamedNodeMap__cloneNodes(parentNode) {
var cloneNamedNodeMap = new DOMNamedNodeMap(this.ownerDocument, parentNode);
for (var i=0; i < this._nodes.length; i++) {
cloneNamedNodeMap._appendChild(this._nodes[i].cloneNode(false));
}
return cloneNamedNodeMap;
};
DOMNamedNodeMap.prototype.toString = function DOMNamedNodeMap_toString() {
var ret = "";
for (var i=0; i < this.length -1; i++) {
ret += this._nodes[i].toString() +" ";
}
if (this.length > 0) {
ret += this._nodes[this.length -1].toString();
}
return ret;
};
DOMNamespaceNodeMap = function(ownerDocument, parentNode) {
this._class = addClass(this._class, "DOMNamespaceNodeMap");
this.DOMNamedNodeMap = DOMNamedNodeMap;
this.DOMNamedNodeMap(ownerDocument, parentNode);
};
DOMNamespaceNodeMap.prototype = new DOMNamedNodeMap;
DOMNamespaceNodeMap.prototype._findNamedItemIndex = function DOMNamespaceNodeMap__findNamedItemIndex(localName) {
var ret = -1;
for (var i=0; i<this._nodes.length; i++) {
if (this._nodes[i].localName == localName) {
ret = i;
break;
}
}
return ret;
};
DOMNamespaceNodeMap.prototype._cloneNodes = function DOMNamespaceNodeMap__cloneNodes(parentNode) {
var cloneNamespaceNodeMap = new DOMNamespaceNodeMap(this.ownerDocument, parentNode);
for (var i=0; i < this._nodes.length; i++) {
cloneNamespaceNodeMap._appendChild(this._nodes[i].cloneNode(false));
}
return cloneNamespaceNodeMap;
};
DOMNamespaceNodeMap.prototype.toString = function DOMNamespaceNodeMap_toString() {
var ret = "";
for (var ind = 0; ind < this._nodes.length; ind++) {
var ns = null;
try {
var ns = this.parentNode.parentNode._namespaces.getNamedItem(this._nodes[ind].localName);
}
catch (e) {
break;
}
if (!(ns && (""+ ns.nodeValue == ""+ this._nodes[ind].nodeValue))) {
ret += this._nodes[ind].toString() +" ";
}
}
return ret;
};
DOMNode = function(ownerDocument) {
this._class = addClass(this._class, "DOMNode");
if (ownerDocument) {
this._id = ownerDocument._genId();
}
this.namespaceURI = "";
this.prefix= "";
this.localName= "";
this.nodeName = "";
this.nodeValue = "";
this.nodeType = 0;
this.parentNode= null;
this.childNodes= new DOMNodeList(ownerDocument, this);
this.firstChild= null;
this.lastChild= null;
this.previousSibling = null;
this.nextSibling = null;
this.attributes = new DOMNamedNodeMap(ownerDocument, this);
this.ownerDocument= ownerDocument;
this._namespaces = new DOMNamespaceNodeMap(ownerDocument, this);
this._readonly = false;
};
DOMNode.ELEMENT_NODE= 1;
DOMNode.ATTRIBUTE_NODE= 2;
DOMNode.TEXT_NODE= 3;
DOMNode.CDATA_SECTION_NODE= 4;
DOMNode.ENTITY_REFERENCE_NODE= 5;
DOMNode.ENTITY_NODE= 6;
DOMNode.PROCESSING_INSTRUCTION_NODE = 7;
DOMNode.COMMENT_NODE= 8;
DOMNode.DOCUMENT_NODE = 9;
DOMNode.DOCUMENT_TYPE_NODE= 10;
DOMNode.DOCUMENT_FRAGMENT_NODE= 11;
DOMNode.NOTATION_NODE = 12;
DOMNode.NAMESPACE_NODE= 13;
DOMNode.prototype.hasAttributes = function DOMNode_hasAttributes() {
if (this.attributes.length == 0) {
return false;
}
else {
return true;
}
};
DOMNode.prototype.getNodeName = function DOMNode_getNodeName() {
return this.nodeName;
};
DOMNode.prototype.getNodeValue = function DOMNode_getNodeValue() {
return this.nodeValue;
};
DOMNode.prototype.setNodeValue = function DOMNode_setNodeValue(nodeValue) {
if (this.ownerDocument.implementation.errorChecking && this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
this.nodeValue = nodeValue;
};
DOMNode.prototype.getNodeType = function DOMNode_getNodeType() {
return this.nodeType;
};
DOMNode.prototype.getParentNode = function DOMNode_getParentNode() {
return this.parentNode;
};
DOMNode.prototype.getChildNodes = function DOMNode_getChildNodes() {
return this.childNodes;
};
DOMNode.prototype.getFirstChild = function DOMNode_getFirstChild() {
return this.firstChild;
};
DOMNode.prototype.getLastChild = function DOMNode_getLastChild() {
return this.lastChild;
};
DOMNode.prototype.getPreviousSibling = function DOMNode_getPreviousSibling() {
return this.previousSibling;
};
DOMNode.prototype.getNextSibling = function DOMNode_getNextSibling() {
return this.nextSibling;
};
DOMNode.prototype.getAttributes = function DOMNode_getAttributes() {
return this.attributes;
};
DOMNode.prototype.getOwnerDocument = function DOMNode_getOwnerDocument() {
return this.ownerDocument;
};
DOMNode.prototype.getNamespaceURI = function DOMNode_getNamespaceURI() {
return this.namespaceURI;
};
DOMNode.prototype.getPrefix = function DOMNode_getPrefix() {
return this.prefix;
};
DOMNode.prototype.setPrefix = function DOMNode_setPrefix(prefix) {
if (this.ownerDocument.implementation.errorChecking) {
if (this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if (!this.ownerDocument.implementation._isValidName(prefix)) {
throw(new DOMException(DOMException.INVALID_CHARACTER_ERR));
}
if (!this.ownerDocument._isValidNamespace(this.namespaceURI, prefix +":"+ this.localName)) {
throw(new DOMException(DOMException.NAMESPACE_ERR));
}
if ((prefix == "xmlns") && (this.namespaceURI != "http://www.w3.org/2000/xmlns/")) {
throw(new DOMException(DOMException.NAMESPACE_ERR));
}
if ((prefix == "") && (this.localName == "xmlns")) {
throw(new DOMException(DOMException.NAMESPACE_ERR));
}
}
this.prefix = prefix;
if (this.prefix != "") {
this.nodeName = this.prefix +":"+ this.localName;
}
else {
this.nodeName = this.localName;
}
};
DOMNode.prototype.getLocalName = function DOMNode_getLocalName() {
return this.localName;
};
DOMNode.prototype.insertBefore = function DOMNode_insertBefore(newChild, refChild) {
var prevNode;
if (this.ownerDocument.implementation.errorChecking) {
if (this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if (this.ownerDocument != newChild.ownerDocument) {
throw(new DOMException(DOMException.WRONG_DOCUMENT_ERR));
}
if (this._isAncestor(newChild)) {
throw(new DOMException(DOMException.HIERARCHY_REQUEST_ERR));
}
}
if (refChild) {
var itemIndex = this.childNodes._findItemIndex(refChild._id);
if (this.ownerDocument.implementation.errorChecking && (itemIndex < 0)) {
throw(new DOMException(DOMException.NOT_FOUND_ERR));
}
var newChildParent = newChild.parentNode;
if (newChildParent) {
newChildParent.removeChild(newChild);
}
this.childNodes._insertBefore(newChild, this.childNodes._findItemIndex(refChild._id));
prevNode = refChild.previousSibling;
if (newChild.nodeType == DOMNode.DOCUMENT_FRAGMENT_NODE) {
if (newChild.childNodes._nodes.length > 0) {
for (var ind = 0; ind < newChild.childNodes._nodes.length; ind++) {
newChild.childNodes._nodes[ind].parentNode = this;
}
refChild.previousSibling = newChild.childNodes._nodes[newChild.childNodes._nodes.length-1];
}
}
else {
newChild.parentNode = this;
refChild.previousSibling = newChild;
}
}
else {
prevNode = this.lastChild;
this.appendChild(newChild);
}
if (newChild.nodeType == DOMNode.DOCUMENT_FRAGMENT_NODE) {
if (newChild.childNodes._nodes.length > 0) {
if (prevNode) {
prevNode.nextSibling = newChild.childNodes._nodes[0];
}
else {
this.firstChild = newChild.childNodes._nodes[0];
}
newChild.childNodes._nodes[0].previousSibling = prevNode;
newChild.childNodes._nodes[newChild.childNodes._nodes.length-1].nextSibling = refChild;
}
}
else {
if (prevNode) {
prevNode.nextSibling = newChild;
}
else {
this.firstChild = newChild;
}
newChild.previousSibling = prevNode;
newChild.nextSibling = refChild;
}
return newChild;
};
DOMNode.prototype.replaceChild = function DOMNode_replaceChild(newChild, oldChild) {
var ret = null;
if (this.ownerDocument.implementation.errorChecking) {
if (this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if (this.ownerDocument != newChild.ownerDocument) {
throw(new DOMException(DOMException.WRONG_DOCUMENT_ERR));
}
if (this._isAncestor(newChild)) {
throw(new DOMException(DOMException.HIERARCHY_REQUEST_ERR));
}
}
var index = this.childNodes._findItemIndex(oldChild._id);
if (this.ownerDocument.implementation.errorChecking && (index < 0)) {
throw(new DOMException(DOMException.NOT_FOUND_ERR));
}
var newChildParent = newChild.parentNode;
if (newChildParent) {
newChildParent.removeChild(newChild);
}
ret = this.childNodes._replaceChild(newChild, index);
if (newChild.nodeType == DOMNode.DOCUMENT_FRAGMENT_NODE) {
if (newChild.childNodes._nodes.length > 0) {
for (var ind = 0; ind < newChild.childNodes._nodes.length; ind++) {
newChild.childNodes._nodes[ind].parentNode = this;
}
if (oldChild.previousSibling) {
oldChild.previousSibling.nextSibling = newChild.childNodes._nodes[0];
}
else {
this.firstChild = newChild.childNodes._nodes[0];
}
if (oldChild.nextSibling) {
oldChild.nextSibling.previousSibling = newChild;
}
else {
this.lastChild = newChild.childNodes._nodes[newChild.childNodes._nodes.length-1];
}
newChild.childNodes._nodes[0].previousSibling = oldChild.previousSibling;
newChild.childNodes._nodes[newChild.childNodes._nodes.length-1].nextSibling = oldChild.nextSibling;
}
}
else {
newChild.parentNode = this;
if (oldChild.previousSibling) {
oldChild.previousSibling.nextSibling = newChild;
}
else {
this.firstChild = newChild;
}
if (oldChild.nextSibling) {
oldChild.nextSibling.previousSibling = newChild;
}
else {
this.lastChild = newChild;
}
newChild.previousSibling = oldChild.previousSibling;
newChild.nextSibling = oldChild.nextSibling;
}
return ret;
};
DOMNode.prototype.removeChild = function DOMNode_removeChild(oldChild) {
if (this.ownerDocument.implementation.errorChecking && (this._readonly || oldChild._readonly)) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
var itemIndex = this.childNodes._findItemIndex(oldChild._id);
if (this.ownerDocument.implementation.errorChecking && (itemIndex < 0)) {
throw(new DOMException(DOMException.NOT_FOUND_ERR));
}
this.childNodes._removeChild(itemIndex);
oldChild.parentNode = null;
if (oldChild.previousSibling) {
oldChild.previousSibling.nextSibling = oldChild.nextSibling;
}
else {
this.firstChild = oldChild.nextSibling;
}
if (oldChild.nextSibling) {
oldChild.nextSibling.previousSibling = oldChild.previousSibling;
}
else {
this.lastChild = oldChild.previousSibling;
}
oldChild.previousSibling = null;
oldChild.nextSibling = null;
return oldChild;
};
DOMNode.prototype.appendChild = function DOMNode_appendChild(newChild) {
if (this.ownerDocument.implementation.errorChecking) {
if (this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if (this.ownerDocument != newChild.ownerDocument) {
throw(new DOMException(DOMException.WRONG_DOCUMENT_ERR));
}
if (this._isAncestor(newChild)) {
throw(new DOMException(DOMException.HIERARCHY_REQUEST_ERR));
}
}
var newChildParent = newChild.parentNode;
if (newChildParent) {
newChildParent.removeChild(newChild);
}
this.childNodes._appendChild(newChild);
if (newChild.nodeType == DOMNode.DOCUMENT_FRAGMENT_NODE) {
if (newChild.childNodes._nodes.length > 0) {
for (var ind = 0; ind < newChild.childNodes._nodes.length; ind++) {
newChild.childNodes._nodes[ind].parentNode = this;
}
if (this.lastChild) {
this.lastChild.nextSibling = newChild.childNodes._nodes[0];
newChild.childNodes._nodes[0].previousSibling = this.lastChild;
this.lastChild = newChild.childNodes._nodes[newChild.childNodes._nodes.length-1];
}
else {
this.lastChild = newChild.childNodes._nodes[newChild.childNodes._nodes.length-1];
this.firstChild = newChild.childNodes._nodes[0];
}
}
}
else {
newChild.parentNode = this;
if (this.lastChild) {
this.lastChild.nextSibling = newChild;
newChild.previousSibling = this.lastChild;
this.lastChild = newChild;
}
else {
this.lastChild = newChild;
this.firstChild = newChild;
}
}
return newChild;
};
DOMNode.prototype.hasChildNodes = function DOMNode_hasChildNodes() {
return (this.childNodes.length > 0);
};
DOMNode.prototype.cloneNode = function DOMNode_cloneNode(deep) {
try {
return this.ownerDocument.importNode(this, deep);
}
catch (e) {
return null;
}
};
DOMNode.prototype.normalize = function DOMNode_normalize() {
var inode;
var nodesToRemove = new DOMNodeList();
if (this.nodeType == DOMNode.ELEMENT_NODE || this.nodeType == DOMNode.DOCUMENT_NODE) {
var adjacentTextNode = null;
for(var i = 0; i < this.childNodes.length; i++) {
inode = this.childNodes.item(i);
if (inode.nodeType == DOMNode.TEXT_NODE) {
if (inode.length < 1) {
nodesToRemove._appendChild(inode);
}
else {
if (adjacentTextNode) {
adjacentTextNode.appendData(inode.data);
nodesToRemove._appendChild(inode);
}
else {
adjacentTextNode = inode;
}
}
}
else {
adjacentTextNode = null;
inode.normalize();
}
}
for(var i = 0; i < nodesToRemove.length; i++) {
inode = nodesToRemove.item(i);
inode.parentNode.removeChild(inode);
}
}
};
DOMNode.prototype.isSupported = function DOMNode_isSupported(feature, version) {
return this.ownerDocument.implementation.hasFeature(feature, version);
}
DOMNode.prototype.getElementsByTagName = function DOMNode_getElementsByTagName(tagname) {
return this._getElementsByTagNameRecursive(tagname, new DOMNodeList(this.ownerDocument));
};
DOMNode.prototype._getElementsByTagNameRecursive = function DOMNode__getElementsByTagNameRecursive(tagname, nodeList) {
if (this.nodeType == DOMNode.ELEMENT_NODE || this.nodeType == DOMNode.DOCUMENT_NODE) {
if((this.nodeName == tagname) || (tagname == "*")) {
nodeList._appendChild(this);
}
for(var i = 0; i < this.childNodes.length; i++) {
nodeList = this.childNodes.item(i)._getElementsByTagNameRecursive(tagname, nodeList);
}
}
return nodeList;
};
DOMNode.prototype.getXML = function DOMNode_getXML() {
return this.toString();
}
DOMNode.prototype.getElementsByTagNameNS = function DOMNode_getElementsByTagNameNS(namespaceURI, localName) {
return this._getElementsByTagNameNSRecursive(namespaceURI, localName, new DOMNodeList(this.ownerDocument));
};
DOMNode.prototype._getElementsByTagNameNSRecursive = function DOMNode__getElementsByTagNameNSRecursive(namespaceURI, localName, nodeList) {
if (this.nodeType == DOMNode.ELEMENT_NODE || this.nodeType == DOMNode.DOCUMENT_NODE) {
if (((this.namespaceURI == namespaceURI) || (namespaceURI == "*")) && ((this.localName == localName) || (localName == "*"))) {
nodeList._appendChild(this);
}
for(var i = 0; i < this.childNodes.length; i++) {
nodeList = this.childNodes.item(i)._getElementsByTagNameNSRecursive(namespaceURI, localName, nodeList);
}
}
return nodeList;
};
DOMNode.prototype._isAncestor = function DOMNode__isAncestor(node) {
return ((this == node) || ((this.parentNode) && (this.parentNode._isAncestor(node))));
}
DOMNode.prototype.importNode = function DOMNode_importNode(importedNode, deep) {
var importNode;
this.getOwnerDocument()._performingImportNodeOperation = true;
try {
if (importedNode.nodeType == DOMNode.ELEMENT_NODE) {
if (!this.ownerDocument.implementation.namespaceAware) {
importNode = this.ownerDocument.createElement(importedNode.tagName);
for(var i = 0; i < importedNode.attributes.length; i++) {
importNode.setAttribute(importedNode.attributes.item(i).name, importedNode.attributes.item(i).value);
}
}
else {
importNode = this.ownerDocument.createElementNS(importedNode.namespaceURI, importedNode.nodeName);
for(var i = 0; i < importedNode.attributes.length; i++) {
importNode.setAttributeNS(importedNode.attributes.item(i).namespaceURI, importedNode.attributes.item(i).name, importedNode.attributes.item(i).value);
}
for(var i = 0; i < importedNode._namespaces.length; i++) {
importNode._namespaces._nodes[i] = this.ownerDocument.createNamespace(importedNode._namespaces.item(i).localName);
importNode._namespaces._nodes[i].setValue(importedNode._namespaces.item(i).value);
}
}
}
else if (importedNode.nodeType == DOMNode.ATTRIBUTE_NODE) {
if (!this.ownerDocument.implementation.namespaceAware) {
importNode = this.ownerDocument.createAttribute(importedNode.name);
}
else {
importNode = this.ownerDocument.createAttributeNS(importedNode.namespaceURI, importedNode.nodeName);
for(var i = 0; i < importedNode._namespaces.length; i++) {
importNode._namespaces._nodes[i] = this.ownerDocument.createNamespace(importedNode._namespaces.item(i).localName);
importNode._namespaces._nodes[i].setValue(importedNode._namespaces.item(i).value);
}
}
importNode.setValue(importedNode.value);
}
else if (importedNode.nodeType == DOMNode.DOCUMENT_FRAGMENT) {
importNode = this.ownerDocument.createDocumentFragment();
}
else if (importedNode.nodeType == DOMNode.NAMESPACE_NODE) {
importNode = this.ownerDocument.createNamespace(importedNode.nodeName);
importNode.setValue(importedNode.value);
}
else if (importedNode.nodeType == DOMNode.TEXT_NODE) {
importNode = this.ownerDocument.createTextNode(importedNode.data);
}
else if (importedNode.nodeType == DOMNode.CDATA_SECTION_NODE) {
importNode = this.ownerDocument.createCDATASection(importedNode.data);
}
else if (importedNode.nodeType == DOMNode.PROCESSING_INSTRUCTION_NODE) {
importNode = this.ownerDocument.createProcessingInstruction(importedNode.target, importedNode.data);
}
else if (importedNode.nodeType == DOMNode.COMMENT_NODE) {
importNode = this.ownerDocument.createComment(importedNode.data);
}
else {
throw(new DOMException(DOMException.NOT_SUPPORTED_ERR));
}
if (deep) {
for(var i = 0; i < importedNode.childNodes.length; i++) {
importNode.appendChild(this.ownerDocument.importNode(importedNode.childNodes.item(i), true));
}
}
this.getOwnerDocument()._performingImportNodeOperation = false;
return importNode;
}
catch (eAny) {
this.getOwnerDocument()._performingImportNodeOperation = false;
throw eAny;
}
};
DOMNode.prototype.__escapeString = function DOMNode__escapeString(str) {
return __escapeString(str);
};
DOMNode.prototype.__unescapeString = function DOMNode__unescapeString(str) {
return __unescapeString(str);
};
DOMDocument = function(implementation) {
this._class = addClass(this._class, "DOMDocument");
this.DOMNode = DOMNode;
this.DOMNode(this);
this.doctype = null;
this.implementation = implementation;
this.documentElement = null;
this.all= new Array();
this.nodeName= "#document";
this.nodeType = DOMNode.DOCUMENT_NODE;
this._id = 0;
this._lastId = 0;
this._parseComplete = false;
this.ownerDocument = this;
this._performingImportNodeOperation = false;
};
DOMDocument.prototype = new DOMNode;
DOMDocument.prototype.getDoctype = function DOMDocument_getDoctype() {
return this.doctype;
};
DOMDocument.prototype.getImplementation = function DOMDocument_implementation() {
return this.implementation;
};
DOMDocument.prototype.getDocumentElement = function DOMDocument_getDocumentElement() {
return this.documentElement;
};
DOMDocument.prototype.createElement = function DOMDocument_createElement(tagName) {
if (this.ownerDocument.implementation.errorChecking && (!this.ownerDocument.implementation._isValidName(tagName))) {
throw(new DOMException(DOMException.INVALID_CHARACTER_ERR));
}
var node = new DOMElement(this);
node.tagName= tagName;
node.nodeName = tagName;
this.all[this.all.length] = node;
return node;
};
DOMDocument.prototype.createDocumentFragment = function DOMDocument_createDocumentFragment() {
var node = new DOMDocumentFragment(this);
return node;
};
DOMDocument.prototype.createTextNode = function DOMDocument_createTextNode(data) {
var node = new DOMText(this);
node.data= data;
node.nodeValue = data;
node.length= data.length;
return node;
};
DOMDocument.prototype.createComment = function DOMDocument_createComment(data) {
var node = new DOMComment(this);
node.data= data;
node.nodeValue = data;
node.length= data.length;
return node;
};
DOMDocument.prototype.createCDATASection = function DOMDocument_createCDATASection(data) {
var node = new DOMCDATASection(this);
node.data= data;
node.nodeValue = data;
node.length= data.length;
return node;
};
DOMDocument.prototype.createProcessingInstruction = function DOMDocument_createProcessingInstruction(target, data) {
if (this.ownerDocument.implementation.errorChecking && (!this.implementation._isValidName(target))) {
throw(new DOMException(DOMException.INVALID_CHARACTER_ERR));
}
var node = new DOMProcessingInstruction(this);
node.target= target;
node.nodeName= target;
node.data= data;
node.nodeValue = data;
node.length= data.length;
return node;
};
DOMDocument.prototype.createAttribute = function DOMDocument_createAttribute(name) {
if (this.ownerDocument.implementation.errorChecking && (!this.ownerDocument.implementation._isValidName(name))) {
throw(new DOMException(DOMException.INVALID_CHARACTER_ERR));
}
var node = new DOMAttr(this);
node.name = name;
node.nodeName = name;
return node;
};
DOMDocument.prototype.createElementNS = function DOMDocument_createElementNS(namespaceURI, qualifiedName) {
if (this.ownerDocument.implementation.errorChecking) {
if (!this.ownerDocument._isValidNamespace(namespaceURI, qualifiedName)) {
throw(new DOMException(DOMException.NAMESPACE_ERR));
}
if (!this.ownerDocument.implementation._isValidName(qualifiedName)) {
throw(new DOMException(DOMException.INVALID_CHARACTER_ERR));
}
}
var node= new DOMElement(this);
var qname = this.implementation._parseQName(qualifiedName);
node.nodeName = qualifiedName;
node.namespaceURI = namespaceURI;
node.prefix= qname.prefix;
node.localName= qname.localName;
node.tagName= qualifiedName;
this.all[this.all.length] = node;
return node;
};
DOMDocument.prototype.createAttributeNS = function DOMDocument_createAttributeNS(namespaceURI, qualifiedName) {
if (this.ownerDocument.implementation.errorChecking) {
if (!this.ownerDocument._isValidNamespace(namespaceURI, qualifiedName, true)) {
throw(new DOMException(DOMException.NAMESPACE_ERR));
}
if (!this.ownerDocument.implementation._isValidName(qualifiedName)) {
throw(new DOMException(DOMException.INVALID_CHARACTER_ERR));
}
}
var node= new DOMAttr(this);
var qname = this.implementation._parseQName(qualifiedName);
node.nodeName = qualifiedName
node.namespaceURI = namespaceURI
node.prefix= qname.prefix;
node.localName= qname.localName;
node.name= qualifiedName
node.nodeValue= "";
return node;
};
DOMDocument.prototype.createNamespace = function DOMDocument_createNamespace(qualifiedName) {
var node= new DOMNamespace(this);
var qname = this.implementation._parseQName(qualifiedName);
node.nodeName = qualifiedName
node.prefix= qname.prefix;
node.localName= qname.localName;
node.name= qualifiedName
node.nodeValue= "";
return node;
};
DOMDocument.prototype.getElementById = function DOMDocument_getElementById(elementId) {
retNode = null;
for (var i=0; i < this.all.length; i++) {
var node = this.all[i];
if ((node.id == elementId) && (node._isAncestor(node.ownerDocument.documentElement))) {
retNode = node;
break;
}
}
return retNode;
};
DOMDocument.prototype._genId = function DOMDocument__genId() {
this._lastId += 1;
return this._lastId;
};
DOMDocument.prototype._isValidNamespace = function DOMDocument__isValidNamespace(namespaceURI, qualifiedName, isAttribute) {
if (this._performingImportNodeOperation == true) {
return true;
}
var valid = true;
var qName = this.implementation._parseQName(qualifiedName);
if (this._parseComplete == true) {
if (qName.localName.indexOf(":") > -1 ){
valid = false;
}
if ((valid) && (!isAttribute)) {
if (!namespaceURI) {
valid = false;
}
}
if ((valid) && (qName.prefix == "")) {
valid = false;
}
}
if ((valid) && (qName.prefix == "xml") && (namespaceURI != "http://www.w3.org/XML/1998/namespace")) {
valid = false;
}
return valid;
}
DOMDocument.prototype.toString = function DOMDocument_toString() {
return "" + this.childNodes;
}
DOMElement = function(ownerDocument) {
this._class = addClass(this._class, "DOMElement");
this.DOMNode= DOMNode;
this.DOMNode(ownerDocument);
this.tagName = "";
this.id = "";
this.nodeType = DOMNode.ELEMENT_NODE;
};
DOMElement.prototype = new DOMNode;
DOMElement.prototype.getTagName = function DOMElement_getTagName() {
return this.tagName;
};
DOMElement.prototype.getAttribute = function DOMElement_getAttribute(name) {
var ret = "";
var attr = this.attributes.getNamedItem(name);
if (attr) {
ret = attr.value;
}
return ret;
};
DOMElement.prototype.setAttribute = function DOMElement_setAttribute(name, value) {
var attr = this.attributes.getNamedItem(name);
if (!attr) {
attr = this.ownerDocument.createAttribute(name);
}
var value = new String(value);
if (this.ownerDocument.implementation.errorChecking) {
if (attr._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if (!this.ownerDocument.implementation._isValidString(value)) {
throw(new DOMException(DOMException.INVALID_CHARACTER_ERR));
}
}
if (this.ownerDocument.implementation._isIdDeclaration(name)) {
this.id = value;
}
attr.value = value;
attr.nodeValue = value;
if (value.length > 0) {
attr.specified = true;
}
else {
attr.specified = false;
}
this.attributes.setNamedItem(attr);
};
DOMElement.prototype.removeAttribute = function DOMElement_removeAttribute(name) {
return this.attributes.removeNamedItem(name);
};
DOMElement.prototype.getAttributeNode = function DOMElement_getAttributeNode(name) {
return this.attributes.getNamedItem(name);
};
DOMElement.prototype.setAttributeNode = function DOMElement_setAttributeNode(newAttr) {
if (this.ownerDocument.implementation._isIdDeclaration(newAttr.name)) {
this.id = newAttr.value;
}
return this.attributes.setNamedItem(newAttr);
};
DOMElement.prototype.removeAttributeNode = function DOMElement_removeAttributeNode(oldAttr) {
if (this.ownerDocument.implementation.errorChecking && oldAttr._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
var itemIndex = this.attributes._findItemIndex(oldAttr._id);
if (this.ownerDocument.implementation.errorChecking && (itemIndex < 0)) {
throw(new DOMException(DOMException.NOT_FOUND_ERR));
}
return this.attributes._removeChild(itemIndex);
};
DOMElement.prototype.getAttributeNS = function DOMElement_getAttributeNS(namespaceURI, localName) {
var ret = "";
var attr = this.attributes.getNamedItemNS(namespaceURI, localName);
if (attr) {
ret = attr.value;
}
return ret;
};
DOMElement.prototype.setAttributeNS = function DOMElement_setAttributeNS(namespaceURI, qualifiedName, value) {
var attr = this.attributes.getNamedItem(namespaceURI, qualifiedName);
if (!attr) {
attr = this.ownerDocument.createAttributeNS(namespaceURI, qualifiedName);
}
var value = new String(value);
if (this.ownerDocument.implementation.errorChecking) {
if (attr._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if (!this.ownerDocument._isValidNamespace(namespaceURI, qualifiedName)) {
throw(new DOMException(DOMException.NAMESPACE_ERR));
}
if (!this.ownerDocument.implementation._isValidString(value)) {
throw(new DOMException(DOMException.INVALID_CHARACTER_ERR));
}
}
if (this.ownerDocument.implementation._isIdDeclaration(name)) {
this.id = value;
}
attr.value = value;
attr.nodeValue = value;
if (value.length > 0) {
attr.specified = true;
}
else {
attr.specified = false;
}
this.attributes.setNamedItemNS(attr);
};
DOMElement.prototype.removeAttributeNS = function DOMElement_removeAttributeNS(namespaceURI, localName) {
return this.attributes.removeNamedItemNS(namespaceURI, localName);
};
DOMElement.prototype.getAttributeNodeNS = function DOMElement_getAttributeNodeNS(namespaceURI, localName) {
return this.attributes.getNamedItemNS(namespaceURI, localName);
};
DOMElement.prototype.setAttributeNodeNS = function DOMElement_setAttributeNodeNS(newAttr) {
if ((newAttr.prefix == "") && this.ownerDocument.implementation._isIdDeclaration(newAttr.name)) {
this.id = newAttr.value;
}
return this.attributes.setNamedItemNS(newAttr);
};
DOMElement.prototype.hasAttribute = function DOMElement_hasAttribute(name) {
return this.attributes._hasAttribute(name);
}
DOMElement.prototype.hasAttributeNS = function DOMElement_hasAttributeNS(namespaceURI, localName) {
return this.attributes._hasAttributeNS(namespaceURI, localName);
}
DOMElement.prototype.toString = function DOMElement_toString() {
var ret = "";
var ns = this._namespaces.toString();
if (ns.length > 0) ns = " "+ ns;
var attrs = this.attributes.toString();
if (attrs.length > 0) attrs = " "+ attrs;
ret += "<" + this.nodeName + ns + attrs +">";
ret += this.childNodes.toString();;
ret += "</" + this.nodeName+">";
return ret;
}
DOMAttr = function(ownerDocument) {
this._class = addClass(this._class, "DOMAttr");
this.DOMNode = DOMNode;
this.DOMNode(ownerDocument);
this.name= "";
this.specified = false;
this.value = "";
this.nodeType= DOMNode.ATTRIBUTE_NODE;
this.ownerElement = null;
this.childNodes = null;
this.attributes = null;
};
DOMAttr.prototype = new DOMNode;
DOMAttr.prototype.getName = function DOMAttr_getName() {
return this.nodeName;
};
DOMAttr.prototype.getSpecified = function DOMAttr_getSpecified() {
return this.specified;
};
DOMAttr.prototype.getValue = function DOMAttr_getValue() {
return this.nodeValue;
};
DOMAttr.prototype.setValue = function DOMAttr_setValue(value) {
if (this.ownerDocument.implementation.errorChecking && this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
this.setNodeValue(value);
};
DOMAttr.prototype.setNodeValue = function DOMAttr_setNodeValue(value) {
this.nodeValue = new String(value);
this.value = this.nodeValue;
this.specified = (this.value.length > 0);
};
DOMAttr.prototype.toString = function DOMAttr_toString() {
var ret = "";
ret += this.nodeName +"=\""+ this.__escapeString(this.nodeValue) +"\"";
return ret;
}
DOMAttr.prototype.getOwnerElement = function() {
return this.ownerElement;
}
DOMNamespace = function(ownerDocument) {
this._class = addClass(this._class, "DOMNamespace");
this.DOMNode = DOMNode;
this.DOMNode(ownerDocument);
this.name= "";
this.specified = false;
this.value = "";
this.nodeType= DOMNode.NAMESPACE_NODE;
};
DOMNamespace.prototype = new DOMNode;
DOMNamespace.prototype.getValue = function DOMNamespace_getValue() {
return this.nodeValue;
};
DOMNamespace.prototype.setValue = function DOMNamespace_setValue(value) {
this.nodeValue = new String(value);
this.value = this.nodeValue;
};
DOMNamespace.prototype.toString = function DOMNamespace_toString() {
var ret = "";
if (this.nodeName != "") {
ret += this.nodeName +"=\""+ this.__escapeString(this.nodeValue) +"\"";
}
else {
ret += "xmlns=\""+ this.__escapeString(this.nodeValue) +"\"";
}
return ret;
}
DOMCharacterData = function(ownerDocument) {
this._class = addClass(this._class, "DOMCharacterData");
this.DOMNode= DOMNode;
this.DOMNode(ownerDocument);
this.data= "";
this.length = 0;
};
DOMCharacterData.prototype = new DOMNode;
DOMCharacterData.prototype.getData = function DOMCharacterData_getData() {
return this.nodeValue;
};
DOMCharacterData.prototype.setData = function DOMCharacterData_setData(data) {
this.setNodeValue(data);
};
DOMCharacterData.prototype.setNodeValue = function DOMCharacterData_setNodeValue(data) {
if (this.ownerDocument.implementation.errorChecking && this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
this.nodeValue = new String(data);
this.data= this.nodeValue;
this.length = this.nodeValue.length;
};
DOMCharacterData.prototype.getLength = function DOMCharacterData_getLength() {
return this.nodeValue.length;
};
DOMCharacterData.prototype.substringData = function DOMCharacterData_substringData(offset, count) {
var ret = null;
if (this.data) {
if (this.ownerDocument.implementation.errorChecking && ((offset < 0) || (offset > this.data.length) || (count < 0))) {
throw(new DOMException(DOMException.INDEX_SIZE_ERR));
}
if (!count) {
ret = this.data.substring(offset);
}
else {
ret = this.data.substring(offset, offset + count);
}
}
return ret;
};
DOMCharacterData.prototype.appendData= function DOMCharacterData_appendData(arg) {
if (this.ownerDocument.implementation.errorChecking && this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
this.setData(""+ this.data + arg);
};
DOMCharacterData.prototype.insertData= function DOMCharacterData_insertData(offset, arg) {
if (this.ownerDocument.implementation.errorChecking && this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if (this.data) {
if (this.ownerDocument.implementation.errorChecking && ((offset < 0) || (offset > this.data.length))) {
throw(new DOMException(DOMException.INDEX_SIZE_ERR));
}
this.setData(this.data.substring(0, offset).concat(arg, this.data.substring(offset)));
}
else {
if (this.ownerDocument.implementation.errorChecking && (offset != 0)) {
throw(new DOMException(DOMException.INDEX_SIZE_ERR));
}
this.setData(arg);
}
};
DOMCharacterData.prototype.deleteData= function DOMCharacterData_deleteData(offset, count) {
if (this.ownerDocument.implementation.errorChecking && this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if (this.data) {
if (this.ownerDocument.implementation.errorChecking && ((offset < 0) || (offset > this.data.length) || (count < 0))) {
throw(new DOMException(DOMException.INDEX_SIZE_ERR));
}
if(!count || (offset + count) > this.data.length) {
this.setData(this.data.substring(0, offset));
}
else {
this.setData(this.data.substring(0, offset).concat(this.data.substring(offset + count)));
}
}
};
DOMCharacterData.prototype.replaceData= function DOMCharacterData_replaceData(offset, count, arg) {
if (this.ownerDocument.implementation.errorChecking && this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if (this.data) {
if (this.ownerDocument.implementation.errorChecking && ((offset < 0) || (offset > this.data.length) || (count < 0))) {
throw(new DOMException(DOMException.INDEX_SIZE_ERR));
}
this.setData(this.data.substring(0, offset).concat(arg, this.data.substring(offset + count)));
}
else {
this.setData(arg);
}
};
DOMText = function(ownerDocument) {
this._class = addClass(this._class, "DOMText");
this.DOMCharacterData= DOMCharacterData;
this.DOMCharacterData(ownerDocument);
this.nodeName= "#text";
this.nodeType= DOMNode.TEXT_NODE;
};
DOMText.prototype = new DOMCharacterData;
DOMText.prototype.splitText = function DOMText_splitText(offset) {
var data, inode;
if (this.ownerDocument.implementation.errorChecking) {
if (this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if ((offset < 0) || (offset > this.data.length)) {
throw(new DOMException(DOMException.INDEX_SIZE_ERR));
}
}
if (this.parentNode) {
data= this.substringData(offset);
inode = this.ownerDocument.createTextNode(data);
if (this.nextSibling) {
this.parentNode.insertBefore(inode, this.nextSibling);
}
else {
this.parentNode.appendChild(inode);
}
this.deleteData(offset);
}
return inode;
};
DOMText.prototype.toString = function DOMText_toString() {
return this.__escapeString(""+ this.nodeValue);
}
DOMCDATASection = function(ownerDocument) {
this._class = addClass(this._class, "DOMCDATASection");
this.DOMCharacterData= DOMCharacterData;
this.DOMCharacterData(ownerDocument);
this.nodeName= "#cdata-section";
this.nodeType= DOMNode.CDATA_SECTION_NODE;
};
DOMCDATASection.prototype = new DOMCharacterData;
DOMCDATASection.prototype.splitText = function DOMCDATASection_splitText(offset) {
var data, inode;
if (this.ownerDocument.implementation.errorChecking) {
if (this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
if ((offset < 0) || (offset > this.data.length)) {
throw(new DOMException(DOMException.INDEX_SIZE_ERR));
}
}
if(this.parentNode) {
data= this.substringData(offset);
inode = this.ownerDocument.createCDATASection(data);
if (this.nextSibling) {
this.parentNode.insertBefore(inode, this.nextSibling);
}
else {
this.parentNode.appendChild(inode);
}
this.deleteData(offset);
}
return inode;
};
DOMCDATASection.prototype.toString = function DOMCDATASection_toString() {
var ret = "";
ret += "<![CDATA[" + this.nodeValue + "\]\]\>";
return ret;
}
DOMComment = function(ownerDocument) {
this._class = addClass(this._class, "DOMComment");
this.DOMCharacterData= DOMCharacterData;
this.DOMCharacterData(ownerDocument);
this.nodeName= "#comment";
this.nodeType= DOMNode.COMMENT_NODE;
};
DOMComment.prototype = new DOMCharacterData;
DOMComment.prototype.toString = function DOMComment_toString() {
var ret = "";
ret += "<!--" + this.nodeValue + "-->";
return ret;
}
DOMProcessingInstruction = function(ownerDocument) {
this._class = addClass(this._class, "DOMProcessingInstruction");
this.DOMNode= DOMNode;
this.DOMNode(ownerDocument);
this.target = "";
this.data= "";
this.nodeType= DOMNode.PROCESSING_INSTRUCTION_NODE;
};
DOMProcessingInstruction.prototype = new DOMNode;
DOMProcessingInstruction.prototype.getTarget = function DOMProcessingInstruction_getTarget() {
return this.nodeName;
};
DOMProcessingInstruction.prototype.getData = function DOMProcessingInstruction_getData() {
return this.nodeValue;
};
DOMProcessingInstruction.prototype.setData = function DOMProcessingInstruction_setData(data) {
this.setNodeValue(data);
};
DOMProcessingInstruction.prototype.setNodeValue = function DOMProcessingInstruction_setNodeValue(data) {
if (this.ownerDocument.implementation.errorChecking && this._readonly) {
throw(new DOMException(DOMException.NO_MODIFICATION_ALLOWED_ERR));
}
this.nodeValue = new String(data);
this.data = this.nodeValue;
};
DOMProcessingInstruction.prototype.toString = function DOMProcessingInstruction_toString() {
var ret = "";
ret += "<?" + this.nodeName +" "+ this.nodeValue + " ?>";
return ret;
}
DOMDocumentFragment = function(ownerDocument) {
this._class = addClass(this._class, "DOMDocumentFragment");
this.DOMNode = DOMNode;
this.DOMNode(ownerDocument);
this.nodeName= "#document-fragment";
this.nodeType = DOMNode.DOCUMENT_FRAGMENT_NODE;
};
DOMDocumentFragment.prototype = new DOMNode;
DOMDocumentFragment.prototype.toString = function DOMDocumentFragment_toString() {
var xml = "";
var intCount = this.getChildNodes().getLength();
for (intLoop = 0; intLoop < intCount; intLoop++) {
xml += this.getChildNodes().item(intLoop).toString();
}
return xml;
}
DOMDocumentType= function() { alert("DOMDocumentType.constructor(): Not Implemented" ); };
DOMEntity= function() { alert("DOMEntity.constructor(): Not Implemented" ); };
DOMEntityReference = function() { alert("DOMEntityReference.constructor(): Not Implemented"); };
DOMNotation = function() { alert("DOMNotation.constructor(): Not Implemented" ); };
Strings = new Object()
Strings.WHITESPACE = " \t\n\r";
Strings.QUOTES = "\"'";
Strings.isEmpty = function Strings_isEmpty(strD) {
return (strD == null) || (strD.length == 0);
};
Strings.indexOfNonWhitespace = function Strings_indexOfNonWhitespace(strD, iB, iE) {
if(Strings.isEmpty(strD)) return -1;
iB = iB || 0;
iE = iE || strD.length;
for(var i = iB; i < iE; i++)
if(Strings.WHITESPACE.indexOf(strD.charAt(i)) == -1) {
return i;
}
return -1;
};
Strings.lastIndexOfNonWhitespace = function Strings_lastIndexOfNonWhitespace(strD, iB, iE) {
if(Strings.isEmpty(strD)) return -1;
iB = iB || 0;
iE = iE || strD.length;
for(var i = iE - 1; i >= iB; i--)
if(Strings.WHITESPACE.indexOf(strD.charAt(i)) == -1)
return i;
return -1;
};
Strings.indexOfWhitespace = function Strings_indexOfWhitespace(strD, iB, iE) {
if(Strings.isEmpty(strD)) return -1;
iB = iB || 0;
iE = iE || strD.length;
for(var i = iB; i < iE; i++)
if(Strings.WHITESPACE.indexOf(strD.charAt(i)) != -1)
return i;
return -1;
};
Strings.replace = function Strings_replace(strD, iB, iE, strF, strR) {
if(Strings.isEmpty(strD)) return "";
iB = iB || 0;
iE = iE || strD.length;
return strD.substring(iB, iE).split(strF).join(strR);
};
Strings.getLineNumber = function Strings_getLineNumber(strD, iP) {
if(Strings.isEmpty(strD)) return -1;
iP = iP || strD.length;
return strD.substring(0, iP).split("\n").length
};
Strings.getColumnNumber = function Strings_getColumnNumber(strD, iP) {
if(Strings.isEmpty(strD)) return -1;
iP = iP || strD.length;
var arrD = strD.substring(0, iP).split("\n");
var strLine = arrD[arrD.length - 1];
arrD.length--;
var iLinePos = arrD.join("\n").length;
return iP - iLinePos;
};
StringBuffer = function() {this._a=new Array();};
StringBuffer.prototype.append = function StringBuffer_append(d){this._a[this._a.length]=d;};
StringBuffer.prototype.toString = function StringBuffer_toString(){return this._a.join("");};
function sajaxSubmit_cb(z){
var sio = new sajaxIO();
Res= sio.getMsg(z);
sio.executeJsFunction(Res.JsFunction) ;
}
function x__displayProgram() {
sajax_do_call("_displayProgram",x__displayProgram.arguments);
}
function x_sajaxSubmit() {
sajax_do_call("sajaxSubmit",x_sajaxSubmit.arguments);
}
function Response(RetCode,jsFunction,Content,other,tagid,divid) {
this.RetCode = RetCode;
this.JsFunction = trim(jsFunction);
this.Content = Content;
this.Other = other;
this.TagId = tagid;
this.DivId = divid;
return this;
}
function sajaxIO() {
this.break_up_char = "+++L+++";
this._Debug=false;
return this;
}
sajaxIO.prototype.getMsg = function (z){
if(typeof (this.break_up_char)=="undefined") break_up_char = "+++L+++";
else break_up_char = this.break_up_char;
var zz = z.split(break_up_char);
if(this._Debug)
alert(z);
var parser = new DOMImplementation();
var domDoc = parser.loadXML(zz[1]);
var docRoot = domDoc.getDocumentElement();
var tag1 = docRoot.getElementsByTagName("JsFunction").item(0);
var tag2 = docRoot.getElementsByTagName("Content").item(0);
var tag3 = docRoot.getElementsByTagName("RetCode").item(0);
var tag4 = docRoot.getElementsByTagName("Other").item(0);
var obj5 = docRoot.getElementsByTagName("DivId");
var obj6 = docRoot.getElementsByTagName("TagId");
var tag5;
if(obj5!=null)
tag5 = obj5.item(0);
if(obj6!=null)
tag6 = obj6.item(0);
var jsfun = "";
var content = "";
var retcode = "";
var other = "";
var tagid = "";
var divid = "";
if(tag1.getFirstChild()) jsfun = tag1.getFirstChild().getNodeValue();
if(tag2.getFirstChild()) content = tag2.getFirstChild().getNodeValue();
if(tag3.getFirstChild()) retcode = tag3.getFirstChild().getNodeValue();
if(tag4.getFirstChild()) other = tag4.getFirstChild().getNodeValue();
if(obj5!=null)
if(tag5.getFirstChild()) divid = tag5.getFirstChild().getNodeValue();
if(obj6!=null)
if(tag6.getFirstChild()) tagid = tag6.getFirstChild().getNodeValue();
res = new Response(retcode,jsfun,content,other,tagid,divid);
return res;
}
sajaxIO.prototype.getXMLValue = 	function(k,v){
var len = k.length;
if(len != v.length) return "error";
var xmlVal = "<Input>";
for(var i=0;i<len;i++){
xmlVal += "<F><K>"+k[i]+"</K><V>"+v[i]+"</V></F>";
}
xmlVal += "</Input>";
return xmlVal;
}
sajaxIO.prototype.insertXMLValue = function(k,v,p_xml){
var len = k.length;
if(len != v.length) return "error";
var val = p_xml.split("</Input>");
var xmlVal = val[0];
for(var i=0;i<len;i++){
xmlVal += "<F><K>"+k[i]+"</K><V>"+encodeURIComponent(this.validValue(v[i]))+"</V></F>";
}
xmlVal += "</Input>";
return xmlVal;
}
sajaxIO.prototype.validValue = function(p_value){
if(typeof(p_value)=='undefined') return "";
var val = p_value.replace(/&/g,"&amp;");
val = val.replace(/>/g,"&gt;");
val = val.replace(/</g,"&lt;");
val = val.replace(/"/g,"&quot;");
val = val.replace(/'/g,"&apos;");
return val;
}
sajaxIO.prototype.keyValue = function (p_form){
var keys = new Array();
var values = new Array();
var frm;
if(typeof(p_form)=='object') frm = p_form;
else frm = eval("document."+p_form);
var elements = frm.elements;
var len = elements.length;
for(var i=0;i<len;i++){
if(elements[i].type){
switch(elements[i].type){
case "checkbox":
if(elements[i].checked){
keys[i]=elements[i].name;
values[i]=encodeURIComponent(this.validValue(elements[i].value));
}
break;
case "radio":
if(elements[i].checked){
keys[i]=elements[i].name;
values[i]=encodeURIComponent(this.validValue(elements[i].value));
};
break;
default:
keys[i]=elements[i].name;
values[i]=encodeURIComponent(this.validValue(elements[i].value));
break;
}
}
else{
keys[i] = elements[i].name;
values[i] = encodeURIComponent(this.validValue(elements[i].value));
}
}
return this.getXMLValue(keys,values);
}
sajaxIO.prototype.executeJsFunction = function (JsFunction) {
if(JsFunction != ""){
eval(JsFunction+";");
}
}
sajaxIO.prototype.setDebug = function(){
this._Debug=true;
}
sajaxIO.prototype.setUri = function(str){
uri_in_sajax=str;
}
sajaxIO.prototype.sajaxSubmit = function(){
var a=sajaxIO.prototype.sajaxSubmit.arguments;
var p_param = a[0];
var p_form = '';
if(typeof(a[1])!='undefined') p_form = a[1];
callback = sajaxSubmit_cb;
if(typeof(a[2])!='undefined') callback = eval(a[2]);
callsajax = x_sajaxSubmit;
if(typeof(a[3])!='undefined') callsajax = eval("x_"+a[3]);
if(typeof(a[4])!='undefined') uri_in_sajax=a[4];//LUOYING
if(uri_in_sajax.indexOf("?")>0 && uri_in_sajax.length>1000) {
ret = uri_in_sajax.split("?");
uri_in_sajax = ret[0];
p_param=p_param+"&"+ret[1];
}
if(p_form!='')
var vars = this.keyValue(p_form);
else
var vars = "<Input></Input>";
var k = new Array();
var v = new Array();
ret = p_param.split("&");
var len = ret.length;
for(var i=0;i<len;i++) {
param = ret[i].split("=");
k[i] = param[0];
v[i] = param[1];
}
if(this._Debug)
alert(this.insertXMLValue(k,v,vars));
callsajax(this.insertXMLValue(k,v,vars),callback);
}
function Column(p_field,p_name,p_type) {
this.Field = p_field;
this.Name = p_name;
this.Type = p_type;
return this;
}
function AttachUploadField(p_field,p_name,p_type,p_kind){
this.Field = p_field;
this.Name = p_name;
this.Type = p_type;
this.Kind = p_kind;
return this;
}
function AttachFile(p_name,p_tmpname,p_field){
this.RealName = p_name;
this.TmpName = p_tmpname;
this.FieldName = p_field;
return this;
}
function AjaxEdit(p_name) {
this.name = p_name;
this.TagName = p_name;
this.sajaxIO = new sajaxIO();
this.Column = new Array();
this.AttachUploadField = new Array();
this.addAttach = new Array();
this.AttachLength = 0;
this.AttachTmpLength = 0;
this.ColumnLength = 0;
this.DispCheckBox = false;
this.DispUpdate = false;
this.ListForm = this.TagName+'_ListForm';
this.ListDiv = this.TagName+'_ListDiv';
this.OuterDiv = this.TagName+'_OuterDiv';
this.AddForm = this.TagName+'_AddForm';
this.RefreshStat=0;
this.RowValue=new Array(15);
this.RowNewValue=new Array(15);
this.RowText=new Array(15);
this.PicUrl = 'pictures';
this.msgDiv = this.TagName+'_msg';
this.silent = 0;
this.QuickEditSave = "Save";
this.QuickEditCancel = "Cancel";
this.QuickEditButton = "Quick Edit";
this.FullEditButton = "Full Edit";
this.noteMsgClassName="note";
this.successMsgClassName="msg success";
this.failedMsgClassName="msg failure";
this.waitWord="Please wait...";
this.NoChk="Select items Please!";
this.ConfirmDelete="Are you sure to delete!";
this.Browser = divOsClass.prototype.getBrowser();
this.CheckData = true;
this.HiddenFrame = "_hidden_frame";
this.ChangeFlag = new hashUtil();
this.NodeHash = new hashUtil();
this.DataSeq = 0;
this.BGExtraFix=0;
}
AjaxEdit.prototype._DEBUG_Display_z = 1
AjaxEdit.prototype._DEBUG_Display_content = 10;
AjaxEdit.prototype._DEBUG_Display_Retcode = 100;
AjaxEdit.prototype._DEBUG_Display_xxx = 1000;
AjaxEdit.prototype.dispField = new Array();
AjaxEdit.prototype.setHiddenFrame = function(str){
this.HiddenFrame = str;
}
AjaxEdit.prototype.setCheckData = function(flag){
this.CheckData = flag;
}
AjaxEdit.prototype.setUri = function(p_uri){
this.sajaxUri = p_uri;
}
AjaxEdit.prototype.setTmpUri = function(p_uri){
this.backupUri = this.sajaxUri ;
this.sajaxUri = p_uri;
}
AjaxEdit.prototype.restoreUri = function(){
if(this.backupUri)
this.sajaxUri = this.backupUri;
}
AjaxEdit.prototype.setListForm = function(p_form) {
this.ListForm = p_form;
}
AjaxEdit.prototype.setListDiv = function(p_div) {
this.ListDiv = p_div;
}
AjaxEdit.prototype.setAddForm = function(p_form) {
this.AddForm = p_form;
}
AjaxEdit.prototype.setPicUrl = function(p_url) {
this.PicUrl = p_url;
}
AjaxEdit.prototype.setVar = function(p_word,p_info) {
eval("this."+p_word+"='"+p_info+"'");
}
AjaxEdit.prototype.setMsgDiv = function(p_div,p_noteClass,p_succClass,p_failedClass) {
this.msgDiv = p_div;
if(typeof p_noteClass!="undefined")
this.noteMsgClassName=p_noteClass;
if(typeof p_succClass!="undefined")
this.successMsgClassName=p_succClass;
if(typeof p_succClass!="undefined")
this.failedMsgClassName=p_failedClass;
}
AjaxEdit.prototype.setDebug = function(p_debug) {
if (!p_debug) {
AjaxEdit.prototype.DebugNo = 11;
this.sajaxIO.setDebug();
return;
}
if (p_debug=='send') {
this.sajaxIO.setDebug();
return;
}
if (p_debug=='close') {
AjaxEdit.prototype.DebugNo = 0;
return;
}
AjaxEdit.prototype.DebugNo = p_debug;
}
AjaxEdit.prototype.addListColumn = function(p_field,p_name,p_type) {
this.Column[this.ColumnLength++] = new Column(p_field,p_name,p_type);
}
AjaxEdit.prototype.setCheckBoxStat = function(p_field) {
this.DispCheckBox = true;
this.PrimaryKey = p_field;
}
AjaxEdit.prototype.setUpdateField = function(p_opjs) {
this.DispUpdate = true;
if(p_opjs)
this.UpdateOpJs = p_opjs;
else this.UpdateOpJs = '';
}
AjaxEdit.prototype.getValue = function(p_form,p_othervalue) {
var form = p_form;
this.form=p_form;
var value = new Array();
for(i=0;i<this.ColumnLength;i++){
if(this.Column[i].Type !="b"){
}
}
other_arr=p_othervalue.split("&");
for(j=0;j<other_arr.length;j++){
other_string=other_arr[j].split("=");
value[other_string[0]] = other_string[1];
}
return value;
}
AjaxEdit.prototype.addLine = function(p_value,p_line) {
var i;
var primary = p_value[this.PrimaryKey];
var form = this.form;
if(p_line=='1')
var newobj = document.getElementById('Add_line').insertRow(p_line);
else var newobj = document.getElementById('Add_line').insertRow();
newobj.className="addline";
newobj.id = this.name + "-+-" + primary+"_tr";
if(this.DispUpdate) {
this.dispField["UpdateColumn"](newobj,p_value,this.UpdateOpJs);
}
for(i=0;i<this.ColumnLength;i++) {
var field = this.Column[i].Field;
var val = p_value[this.Column[i].Field];
if(AjaxEdit.prototype.dispField[field]) {
AjaxEdit.prototype.dispField[field](p_value);
continue;
}
if(val=="") {
str1="var cell"+i+" =newobj.insertCell(null);\n";
str2="cell"+i+".innerHTML='&nbsp;'\n";
str3="";
}
else if(this.Column[i].Type=='b'){
str1="var cell"+i+" =newobj.insertCell(null);\n";
str2="cell"+i+".innerHTML='&nbsp;'\n";
str3="";
}
else if(this.Column[i].Type=='v'){
str1="var cell"+i+" =newobj.insertCell(null)\n";
str2="cell"+i+".innerHTML=\""+val+"\"\n";
str3="cell"+i+".id='"+primary+"-+-"+field+"-+-td'";
}
else if(this.Column[i].Type=='e'){
str1="var cell"+i+" =newobj.insertCell(null)\n";
str2="cell"+i+".innerHTML='<a href=mailto:"+val+">"+val+"</a>'\n";
str3="cell"+i+".id='"+primary+"-+-"+field+"-+-td'";
}
eval(str1);
eval(str2);
eval(str3);
}
if(this.DispCheckBox) {
this.dispField["CheckBox"](newobj,p_value);
}
newobj.style.display="none";
}
AjaxEdit.prototype.dispField["UpdateColumn"] = function(p_obj,p_value,p_js) {
var nbr = p_value[this.PrimaryKey];
var cell0=p_obj.insertCell(null);
Js=p_js.replace("===key===",nbr);
cell0.innerHTML="<a href=\"javascript:void(0)\" onclick=\"javascript:void("+Js+")\"><img src='"+this.PicUrl+"/edit.gif' border=0></a>";
cell0.align="middle";
}
AjaxEdit.prototype.dispField["CheckBox"] = function(p_obj,p_value) {
var primary = p_value[this.PrimaryKey];
var cell99=p_obj.insertCell(null);
cell99.innerHTML="<input type='checkbox' name='Chk[]' id='"+primary+"_input' value='"+primary+"' onclick='changeStyle(this)'>";
}
AjaxEdit.prototype.showMsg = function(content,p_type) {
if(typeof p_type == "undefined") p_type="note";
var obj = document.getElementById(this.msgDiv);
if(obj==null) return ;
try{
obj.style.display = "block";
obj.innerHTML = content;
if(p_type=='Success')
obj.className=this.successMsgClassName;
else if(p_type=='Failure')
obj.className=this.failedMsgClassName;
else
obj.className=this.noteMsgClassName;
}catch(e) {}
}
AjaxEdit.prototype.hideMsg = function() {
try{
var obj = document.getElementById(this.msgDiv);
if (typeof obj !="undefined" && obj) obj.style.display = "none";
}catch(e){}
}
AjaxEdit.prototype.removeTag = function(p_tag) {
if(typeof p_tag=="object")	obj.parentNode.removeChild(p_tag);
else {
if (document.getElementById(p_tag))  document.getElementById(p_tag).parentNode.removeChild(document.getElementById(p_tag));
}
}
AjaxEdit.prototype.showDiv = function (p_div) {
if(typeof p_div=="object")	p_div.style.display='block';
else {
if(document.getElementById(p_div)) document.getElementById(p_div).style.display='block';
}
}
AjaxEdit.prototype.hideDiv = function (p_div) {
if(typeof p_div=="object")	p_div.style.display='none';
else {
if(document.getElementById(p_div)) document.getElementById(p_div).style.display='none';
}
}
AjaxEdit.prototype.showDiv = function (p_div) {
if(typeof p_div=="object")	p_div.style.display='inline';
else {
if(document.getElementById(p_div)) document.getElementById(p_div).style.display='inline';
}
}
AjaxEdit.prototype.delLine = function(obj){
var arr=obj.split(",");
for(i=0;i<arr.length-1;i++){
if(arr[i])
document.getElementById(arr[i]+'_tr').parentElement.deleteRow(document.getElementById(arr[i]+'_tr').rowIndex-1);
}
if(arr.length==1)
document.getElementById(arr[0]+'_tr').parentElement.deleteRow(document.getElementById(arr[0]+'_tr').rowIndex-1);
}
AjaxEdit.prototype.rightClick = function(p_nbr,a,p_obj){
var menu=document.getElementById("menu");
a = window.event || a;
if(!a.pageX)a.pageX=a.clientX;
if(!a.pageY)a.pageY=a.clientY;
menu.style.left = a.pageX + "px";
menu.style.top  = a.pageY + "px";
menu.style.display = "block";
return false;
return false;
}
AjaxEdit.prototype.selectCheckbox = function(p_nbr){
var chkBox=p_nbr+"_input";
document.getElementById(chkBox).checked="true";
}
AjaxEdit.prototype.rightClickChild = function(str,a,obj){
var menuChild=document.getElementById("menuChild");
menuChild.style.display = "block";
return false;
}
AjaxEdit.prototype.hideMenuChild = function(){
document.getElementById('menuChild').style.display='none';
}
AjaxEdit.prototype.getScrollTop = function() {
if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
scrollPos = document.documentElement.scrollTop;
}
else if (typeof document.body != 'undefined') {
scrollPos = document.body.scrollTop;
}
return scrollPos;
}
AjaxEdit.prototype.preAddLine = function(p_form,p_posi) {
if (this.isNull(p_form)) p_form=this.AddForm;
if (this.isNull(p_posi)) p_posi="";
this.addLine(this.getValue(p_form,p_posi));
}
AjaxEdit.prototype.callBack = function(z) {
var scrollHeight=AjaxEdit.prototype.getScrollTop() + 150;
var scrollWidth=document.body.clientWidth/2-150;
if (AjaxEdit.prototype.DebugNo==11) divOs.popWindow("===DEBUG===","Close=1;width:90%;height:95%;top:30",AjaxEdit.prototype.clearHtml(z));
if (AjaxEdit.prototype.DebugNo==12) divOs.popWindow("===DEBUG===","Close=1;width:90%;height:95%;top:30",z);
try{
Res= sajaxIO.prototype.getMsg(z);
var TagId = Res.TagId;
this.TagName = Res.TagId;
var editor = eval(TagId+"_editor");
arr=Res.Content;
if (AjaxEdit.prototype.DebugNo==21) divOs.popWindow("===DEBUG===","Close=1;width:90%;height:95%;top:30",AjaxEdit.prototype.clearHtml(arr));
if (AjaxEdit.prototype.DebugNo==22) divOs.popWindow("===DEBUG===","Close=1;width:90%;height:95%;top:30",arr);
if (AjaxEdit.prototype.DebugNo==31) divOs.popWindow("===DEBUG===","Close=1",Res.RetCode);
if (editor.silent == 0) divOs.closeWaitingWindow('sending');
if(Res.DivId=="_List"){
divOs.setInnerHTML(document.getElementById(editor.ListDiv),Res.Content);
}
else if(Res.DivId=="_Outer"){
divOs.setInnerHTML(document.getElementById(editor.OuterDiv),Res.Content);
}
else if(Res.DivId=="_PopUp"){
if (!Res.RetCode) Res.RetCode="Pop Up Title";
var infoArr=Res.Other.split('=o=');
var p_style=infoArr[0];
var p_div=infoArr[1];
if (!p_style) p_style="middle";
if (p_style=="large") p_style="width:95%;height:90%;top:20;Close:1";
if (p_style=="middle") p_style="width:420;height:300;top:100;Close:1";
if (p_style=="small") p_style="width:280;height:150;top:150;Close:1";
divOs.popWindow(Res.RetCode,p_style,Res.Content,p_div);
}
else if(Res.DivId=="_SwapDetail"){
var str = "<div class=\"pop-body-inner\">"+Res.Content+"</div>";
$("#ppcont"+this.TagName+"_popDiv").html(str);
}
else if(Res.DivId=="_Msg"){
editor.showMsg(Res.Content,Res.RetCode) ;
}
else if(Res.DivId=="_QuickEdit"){
editor.refreshEditRow(editor.OperateObj,1);
}
else if(Res.DivId.indexOf("(")>-1){
var fun = Res.DivId.replace("()","(Res)");
eval(fun);
}
else {
if(Res.DivId && document.getElementById(Res.DivId)) {
divOs.setInnerHTML(document.getElementById(Res.DivId), Res.Content);
}
}
editor.hideMsg();
if(Res.JsFunction) eval(Res.JsFunction);
}
catch(e) {
divOs.popWindow("ERROR FOUND!","Close=1;width:50%;height:50%;top:30px",z);
try{
divOs.closeWaitingWindow('sending');
}catch(e) {}
}
}
AjaxEdit.prototype.attachUpload = function(p_successJs,p_faildJs,p_form) {
var FieldInfo='';
for(i=0;i<this.AttachLength;i++){
FieldInfo +=this.AttachUploadField[i]["Name"]+"@@"+this.AttachUploadField[i]["Type"]+"@@"+this.AttachUploadField[i]["Kind"]+"&&";
}
this.successJs = p_successJs;
this.faildJs = p_faildJs;
this.UploadForm = p_form;
var obj = eval("document."+this.UploadForm+".AttachUploadFildHidden");
obj.value=FieldInfo;
}
AjaxEdit.prototype.attachUploadFild = function(p_field,p_name,p_type,p_kind){
this.AttachUploadField[this.AttachLength++] = new AttachUploadField(p_field,p_name,p_type,p_kind);
}
AjaxEdit.prototype.UploadSuccess = function(){
var xmlVal=AjaxEdit.prototype.attachXml();
var obj = eval("document."+this.UploadForm+".__AttachList");
obj.value=xmlVal;
if(this.successJs) eval(this.successJs);
else {
eval("document."+this.UploadForm+".submit()");
}
}
AjaxEdit.prototype.UploadFaild = function(p_type,p_field){
if(p_type==1) {
for(i=0;i<this.AttachLength;i++){
if(this.AttachUploadField[i]["Name"]==p_field){
this.FaildField=this.AttachUploadField[i]["Field"];
break;
}
}
document.getElementById('msgbox2').style.display='block';
document.getElementById('msgbox2').innerHTML=msghead +this.FaildField+":"+this.faildJs+ msgtail;
}
if(p_type==2) {
}
}
AjaxEdit.prototype.addAttachFile = function(p_name,p_tmpname,p_field){
this.addAttach[this.AttachTmpLength++] = new AttachFile(p_name,p_tmpname,p_field);
}
AjaxEdit.prototype.attachXml = function(){
var xmlValue = "<?xml version='1.0'?><Input>";
for(var i=0;i<this.AttachTmpLength;i++){
xmlValue += "<F><Name>"+this.addAttach[i]["RealName"]+"</Name><Tmp>"+this.addAttach[i]["TmpName"]+"</Tmp><Field>"+this.addAttach[i]["FieldName"]+"</Field></F>";
}
xmlValue += "</Input>";
return xmlValue;
}
AjaxEdit.prototype.clearForm = function (p_form){
var formObj=eval("document."+p_form);
var cols = formObj.getElementsByTagName("INPUT");
var length = cols.length;
for (j=0;j<length;j++){
if (cols[j].getAttribute("type")=="text") cols[j].value="";
}
}
AjaxEdit.prototype.focusForm = function (p_form,p_focus){
if (!p_focus) p_focus = "firstText";
if (!p_form) return false;
var formObj=eval("document."+p_form);
if (typeof formObj =='undefined') return false;
var cols = formObj.getElementsByTagName("INPUT");
var length = cols.length;
for (j=0;j<length;j++){
if (cols[j].getAttribute("type")=="text") {
if (p_focus=="firstText") {cols[j].focus();return;}
}
}
}
AjaxEdit.prototype.clearHtml = function(text){
if (typeof( text ) != "string") text = text.toString() ;
text = text.replace(/&/g, "&amp;") ;
text = text.replace(/"/g, "&quot;") ;
text = text.replace(/</g, "&lt;") ;
text = text.replace(/>/g, "&gt;") ;
text = text.replace(/'/g, "&#39;") ;
text = text.replace(/\n/g, "<br />") ;
return text ;
}
AjaxEdit.prototype.clearQuote = function(text){
if (typeof( text ) != "string") text = text.toString() ;
text = text.replace(/"/g, "&quot;") ;
text = text.replace(/'/g, "&apos;") ;
return text ;
}
AjaxEdit.prototype.unClearQuote = function(text){
if (typeof( text ) != "string") text = text.toString() ;
text = text.replace(/&quot;/g, "\"") ;
text = text.replace(/&apos;/g, "'") ;
return text ;
}
AjaxEdit.prototype.chgSort = function(p_form,p_sort,p_callBack){
if (AjaxEdit.prototype.isNull(p_form)) p_form=this.ListForm;
if (AjaxEdit.prototype.isNull(p_callBack)) p_callBack=this.name+"_editor.callBack";
var frm = eval("document."+p_form);
if(this.trim(p_sort) == this.trim(frm.Sort.value)) frm.Direct.value = (-1)*frm.Direct.value;
else frm.Sort.value = p_sort;
frm.Gopage.value = 1;
frm.Begin.value = 0;
var refreshOpStat = this.RefreshStat;
if(refreshOpStat) var refreshOp="Op=search";
else var refreshOp="";
this.sajaxSubmit(refreshOp,p_form,p_callBack);
}
AjaxEdit.prototype.sajaxSubmit = function(p_op,p_form,p_callback,p_silent){
if (this.CheckData && p_form) {
if (!this.checkData(p_form)) return false;
}
if(p_op.indexOf("=")>=0) p_op+="&TagName="+this.TagName;
else p_op = "TagName="+this.TagName;
this.sajaxIO.sajaxSubmit(p_op,p_form,p_callback,'sajaxSubmit',this.sajaxUri);
var scrollHeight= 180;
var scrollWidth=document.body.clientWidth/2-100;
this.silent = 0;
if (!p_silent) divOs.openWaitingWindow(divOs.waitWord,"sending");
else this.silent=1;
this.editing = false;
}
AjaxEdit.prototype.isNull = function(p_val){
var isnull = false;
if (p_val==null || p_val=="null" || p_val=="")  isnull = true;
return isnull;
}
AjaxEdit.prototype.editRow = function(obj,p_form,p_callBack){
if (this.editing) return;
if (this.isNull(p_form)) p_form=this.ListForm;
if (this.isNull(p_callBack)) p_callBack=this.name+"_editor.callBack";
var par=obj.parentNode.parentNode;
var cols = par.getElementsByTagName("TD");
var length = cols.length;
for (j=0;j<length-1;j++){
if (this.isNull(cols[j].getAttribute("id"))) continue;
var myid=cols[j].getAttribute("id");
var idarr=myid.split("-+-");
var sendid="TB_"+idarr[1];
if(cols[j].innerHTML=="&nbsp;"){
this.RowValue[j]="&nbsp;";
this.RowText[j]="&nbsp;";
}
else {
this.RowValue[j]=escape(this.clearQuote(this.trim(cols[j].innerHTML)));
if (this.Browser=="IE") {
if (idarr[3] == 'select') this.RowText[j]=escape(this.clearQuote(this.trim(cols[j].childNodes[0].innerText)));
else this.RowText[j]=escape(this.clearQuote(this.trim(cols[j].innerText)));
}
else {
if (idarr[3] == 'select') this.RowText[j]=escape(this.clearQuote(this.trim(cols[j].childNodes[0].textContent)));
else this.RowText[j]=escape(this.clearQuote(this.trim(cols[j].textContent)));
}
}
if (idarr[3] == 'select'){
document.getElementById(this.name+'_selectField_'+idarr[0]).style.display="block";
document.getElementById(this.name+'_originValue_'+idarr[0]).style.display="none";
document.getElementById(this.name+'_select_'+idarr[0]).name=sendid;
}
else {
if (idarr[2] == 'boolean') {
var chked="";
if (unescape(this.trim(this.RowText[j]))==1) chked = " checked=\"checked\" ";
cols[j].innerHTML="<input type=\"checkbox\" class=\"checkbox\" id=\""+idarr[1]+"\" "+chked+" name=\""+sendid+"\"/ value=\"1\">";
}else {
var showCal ="";
var inputWidth ="90%";
if (idarr[2] == 'date') {
showCal = "<input class=\"checkbox\" onclick=\"showCalendar(document."+this.ListForm+"."+sendid+",this);return false\" type=\"image\" alt=\"Calendar\" src=\""+this.PicUrl+"/cal.gif\" align=\"absMiddle\" \/>";
inputWidth = "80%";
}
cols[j].innerHTML="<input type=\"text\" class=\"inputtext\" id=\""+idarr[1]+"\" name=\""+sendid+"\" style=\"width:"+inputWidth+";\" value=\""+unescape(this.trim(this.RowText[j]))+"\">"+showCal;
}
}
}
this.OperationInnerHtml = escape(obj.parentNode.innerHTML);
this.focusForm(this.name+"_ListForm");
if (idarr) obj.parentNode.innerHTML="<a href='javascript:void(null)' onclick=\"if("+this.name+"_editor.checkData('"+p_form+"')){"+this.name+"_editor.saveNewValue(this);"+this.name+"_editor.sajaxSubmit('Op=edit&keyId="+idarr[0]+"','"+p_form+"','"+p_callBack+"');"+this.name+"_editor.editing=false;}\"><img border='0' src='"+this.PicUrl+"/save.gif' alt='"+this.QuickEditSave+"' /></a><a href='javascript:void(null)' onclick=\""+this.name+"_editor.refreshEditRow(this)\"><img border='0' src='"+this.PicUrl+"/close.gif' alt=\""+this.QuickEditCancel+"\" /></a>";
this.editing = true;
}
AjaxEdit.prototype.saveNewValue = function(obj){
var par=obj.parentNode.parentNode;
this.OperateObj = obj;
var cols = par.getElementsByTagName("TD");
var length = cols.length;
for (j=0;j<length-1;j++){
if (this.isNull(cols[j].getAttribute("id"))) continue;
var myid=cols[j].getAttribute("id");
var idarr=myid.split("-+-");
if (idarr[3] == 'select'){
var SelObj = cols[j].getElementsByTagName("SELECT");
var SelText = SelObj[0].options[SelObj[0].selectedIndex].text;
this.RowNewValue[j] = escape(this.clearQuote(SelText));
}
else this.RowNewValue[j] = escape(this.clearQuote(cols[j].childNodes[0].value));
}
}
AjaxEdit.prototype.refreshList = function(str,p_lang){
var refreshOpStat = this.RefreshStat;
if(refreshOpStat && str) var refreshOp="Op=search&refStr="+str;
else if(refreshOpStat && !str) var refreshOp="Op=search";
else var refreshOp="";
try {
var formName = this.name+"_searchTmp";
var obj = eval("document."+formName);
p_form = this.name+"_searchForm";
if(obj && obj.parentNode.style.display !="none") p_form =this.name+"_searchTmp";
if(typeof p_lang!='undefined' && p_lang.trim()!="") {
var frm =  eval("document."+p_form)
frm.PageLang.value=p_lang;
}
this.sajaxSubmit(refreshOp,p_form,this.callBack);
}
catch(e) {
refreshOp = refreshOp+"&PageLang="+p_lang;
this.sajaxSubmit(refreshOp,'',this.callBack);
}
this.Lang_List = p_lang;
}
AjaxEdit.prototype.refreshTag = function (p_param,p_lang) {
if(typeof p_param=="undefined") p_param="";
var lang =this.getCurLang("tag");
if(typeof p_lang=="undefined") p_lang =this.getCurLang("tag");
if(typeof p_lang!='undefined') {
p_param+="&PageLang="+p_lang+"&SwapLang="+p_lang;
this.Lang_tag = p_lang;
}
this.sajaxSubmit(p_param,'',this.callBack);
}
AjaxEdit.prototype.checkData = function(p_form,p_prefix){
if (!p_prefix) p_prefix = "TB_";
var FormData ;
try {
FormData = eval(this.name+"_FormData");
}catch(e){return true;}
var checked = FormData.datavalid(p_form,p_prefix);
if (checked == false) return false;
return true;
}
AjaxEdit.prototype.refreshEditRow = function(obj,p_newValue){
this.editing = false;
var par=obj.parentNode.parentNode;
if (p_newValue) par.className="row_operate";
var cols = par.getElementsByTagName("TD");
var length = cols.length;
for (j=0;j<length-1;j++){
if (this.isNull(cols[j].getAttribute("id"))) continue;
var myid=cols[j].getAttribute("id");
var idarr=myid.split("-+-");
if (p_newValue) {
if (idarr[3]=="select") {
cols[j].innerHTML=this.unClearQuote(unescape(this.RowValue[j].replace(this.RowText[j]+"%3C\/span%3E",this.RowNewValue[j]+"%3C\/span%3E")));
}
else cols[j].innerHTML=this.unClearQuote(unescape(this.RowValue[j].replace(eval("/"+this.RowText[j]+"/g"),this.RowNewValue[j])));
}
else cols[j].innerHTML=this.unClearQuote(unescape(this.RowValue[j]));
}
obj.parentNode.innerHTML=unescape(this.OperationInnerHtml);
}
AjaxEdit.prototype.view = function(p_page){
eval("document."+this.ListForm+".Gopage.value="+p_page);
this.sajaxSubmit('',this.ListForm,this.callBack);
}
AjaxEdit.prototype.search = function(p_form){
if (!p_form) p_form = this.name+"_searchForm";
this.RefreshStat =1;
this.sajaxSubmit('Op=search',p_form,this.callBack);
}
AjaxEdit.prototype.saveInnerDivFF= function(p_key,p_id){
var frame = window.frames[this.HiddenFrame].document;
var obj = $(frame.body).find("#"+p_key).get(0);
if(typeof obj!='undefined') {
frame.body.removeChild(obj);
}
var contDiv=divOs.childNode($("#"+p_id).get(0),0);
contDiv.id=p_key;
var ret = frame.body.appendChild(contDiv);
return true;
}
AjaxEdit.prototype.saveInnerDivWebkit= function(p_key,p_id){
var frame = window.frames[this.HiddenFrame].document;
var obj = $(frame.body).find("#"+p_key).get(0);
if(typeof obj!='undefined') {
$(obj).remove();
}
var contDiv=divOs.childNode($("#"+p_id).get(0),0);
contDiv.id=p_key;
var ret = frame.adoptNode(contDiv,true);
frame.body.appendChild(ret);
return true;
}
AjaxEdit.prototype.restoreInnerDivFF = function(p_key,p_id){
var frame = window.frames[this.HiddenFrame].document;
var obj = $(frame.body).find("#"+p_key).get(0);
if(typeof obj!='undefined') {
var contDiv=$("#"+p_id).get(0);
for(var i=0;i<contDiv.childNodes.length;i++){
contDiv.removeChild(contDiv.childNodes[i]);
}
contDiv.appendChild(obj);
return true;
}
else return false;
}
AjaxEdit.prototype.restoreInnerDivWebkit = function(p_key,p_id){
var frame = window.frames[this.HiddenFrame].document;
var obj = $(frame.body).find("#"+p_key).get(0);
if(typeof obj!='undefined') {
var contDiv=$("#"+p_id).get(0);
$(contDiv).empty();
var ret = document.adoptNode(obj,true);
contDiv.appendChild(ret);
return true;
}
else return false;
}
AjaxEdit.prototype.saveInnerDiv= function(p_key,p_id){
if($.browser.mozilla) return this.saveInnerDivFF(p_key,p_id);
else if($.browser.webkit) return this.saveInnerDivWebkit(p_key,p_id);
var contDiv=divOs.childNode($("#"+p_id).get(0),0);
try{
var sa = contDiv.getElementsByTagName("select");
if(sa.length) {
var va=new Array();
for(var i=sa.length-1;i>=0;i--) {
va.push(sa[i].value);
}
}
try{
this.NodeHash.put(p_key,$(contDiv).clone(true));
}catch(e){
this.NodeHash.put(p_key,$(contDiv).clone(true));
}
if(sa.length) {
var obj =  this.NodeHash.get(p_key);
$(obj).find("select").each(function() {
$(this).val(va.pop());
});
}
}catch(e) {}
return true;
}
AjaxEdit.prototype.restoreInnerDiv = function(p_key,p_id){
if($.browser.mozilla) return this.restoreInnerDivFF(p_key,p_id);
else if($.browser.webkit) return this.restoreInnerDivWebkit(p_key,p_id);
var obj = this.NodeHash.get(p_key);
if(this.NodeHash.hasKey(p_key)) {
obj = obj.get(0);
var contDiv=$("#"+p_id).get(0);
for(var i=0;i<contDiv.childNodes.length;i++){
contDiv.removeChild(contDiv.childNodes[i]);
}
contDiv.appendChild(obj)
this.NodeHash.remove(p_key);
return true;
}
else return false;
}
AjaxEdit.prototype.clearTmpDiv= function(){
this.NodeHash.reset();
if($.browser.mozilla) {
var frame = window.frames[this.HiddenFrame].document.body;
$(frame).children('div[id^="'+this.TagName+'"]').remove();
return true;
}else if($.browser.webkit){
var frame = window.frames[this.HiddenFrame].document.body;
$(frame).children('div[id^="'+this.TagName+'"]').remove();
return true;
}
}
AjaxEdit.prototype.showDetail = function(p_seq,p_noPop,p_param,p_lang){
if (!p_seq) return false;
if (typeof p_noPop=="undefined" || p_noPop=="undefined") p_noPop="";
if (typeof p_param=="undefined" || p_param=="undefined") p_param="";
if (typeof p_lang=="undefined" || p_lang=="undefined") p_lang="";
this.DataSeq = p_seq;
var url = "";
if(p_lang)  url+= "&PageLang="+p_lang;
if(p_noPop) url+= "&NoPop=1";
this.sajaxSubmit('Op=detail'+url+p_param+'&seq='+p_seq,'',this.callBack);
this.clearChangeFlag();
}
AjaxEdit.prototype.deleteFCKDiv = function(p_divid){
var fcks = $("#"+p_divid+" div").filter(function() {
if(this.id.substring(this.id.length-7)=="_Editor") {
return true;
}
else return false;
});
for(var i=0;i<fcks.length;i++) {
var flag=false;
var fckdiv = fcks.get(i);
if(!fckdiv.childNodes.length) continue;
var subdiv = fckdiv.childNodes[0];
for(var j=0;j<subdiv.childNodes.length;j++) {
if(subdiv.childNodes[j].tagName=="IFRAME")  {
flag=true;
}
}
fckdiv.removeChild(subdiv)
}
}
AjaxEdit.prototype.swapDetailLang = function(p_seq,p_fromlang,p_tolang,p_param,p_op){
if (typeof p_param=="undefined") p_param="";
if (typeof p_msg=="undefined") p_msg="";
if (typeof p_op=="undefined" || p_op=="") p_op="detail";
this.DataSeq = p_seq;
this.deleteFCKDiv("ppcont"+this.TagName+"_popDiv");
this.saveInnerDiv(this.TagName+"_"+p_seq+"_"+p_fromlang,"ppcont"+this.TagName+"_popDiv");
ret = this.restoreInnerDiv(this.TagName+"_"+p_seq+"_"+p_tolang,"ppcont"+this.TagName+"_popDiv");
if(!ret) {
this.sajaxSubmit('Op='+p_op+'&SwapLang='+p_tolang+'&'+p_param+'&seq='+p_seq,'',this.callBack);
}
this.Lang_Detail = p_tolang;
}
AjaxEdit.prototype.swapLeftLang = function(p_fromlang,p_tolang){
this.saveInnerDiv(this.TagName+"_"+p_fromlang,this.TagName+"_ListDiv");
ret = this.restoreInnerDiv(this.TagName+"_"+p_tolang,this.TagName+"_ListDiv");
if(!ret) {
this.sajaxSubmit('SwapLang='+p_tolang,'',this.callBack);
}
this.Lang_left = p_tolang;
}
AjaxEdit.prototype.getCurLang = function(p_pos,p_default){
var s = eval('this.Lang_'+p_pos);
if(typeof s == "undefined") s = p_default;
return s;
}
AjaxEdit.prototype.closeDetail = function(p_seq,p_lang,p_msg,p_param){
if(typeof p_param=="undefined") p_param="";
this.setChangeFlag(p_lang,0);
var lang ,val
while(1){
lang = this.ChangeFlag.getFirstKey();
val = this.ChangeFlag.pop();
if(lang=="" || typeof lang=="undefined") {
lang="";
break;
}
if(val==1) break;
}
if(typeof p_msg=="undefined") p_msg="";
if(lang && val) {
this.ChangeFlag.put(lang,val);
if(!p_seq) p_seq = this.DataSeq;
this.swapDetailLang(p_seq,p_lang,lang,p_param);
var msg ="";
if(p_msg)
msg = divOs.getInfo("lang_"+p_lang)+" : "+ p_msg+"<br>";;
msg+=divOs.getInfo("lang_"+lang)+" : "+ divOs.getInfo("tip_notsaved");
divOs.showDetailMsg(this.TagName,msg);
}
else {
if(p_msg) this.showMsg(p_msg,'Success');
try {
if(typeof $("#"+this.TagName+"_popDiv").find(".pop-close").get(0)=="undefined")
divOs.closeAllPopWindow();
else  {
$("#"+this.TagName+"_popDiv").find(".pop-close").trigger("click");
}
}
catch(e) {
divOs.closeAllPopWindow();
}
this.clearChangeFlag();
}
}
AjaxEdit.prototype.setChangeFlag = function(p_lang,p_flag){
if(!p_lang) return ;
if(typeof p_flag=="undefined") p_flag=1;
this.ChangeFlag.put(p_lang,p_flag);
}
AjaxEdit.prototype.clearChangeFlag = function() {
this.ChangeFlag = new hashUtil();
this.clearTmpDiv();
}
AjaxEdit.prototype._update = function(p_form){
if (!p_form) p_form = this.ListForm;
if (this.checkData(p_form)){
this.sajaxSubmit('Op=update',p_form,this.callBack);
}
}
AjaxEdit.prototype.moveTo = function(p_key,p_div,p_param){
if(typeof(p_div)=="undefined") p_div="";
if (!p_key) return false;
if (!chkSel(this.ListForm,'Chk[]')) {
alert(this.NoChk);
return false;
}
var param = p_param ? '&'+p_param : '';
this.sajaxSubmit('Op=moveTo&moveDiv='+p_div+'&moveKey='+p_key+param,this.ListForm,this.callBack);
}
AjaxEdit.prototype._delete = function(p_id) {
if (p_id) {
if (confirm(this.ConfirmDelete)) this.sajaxSubmit('Op=delete&Chk='+p_id,'',this.callBack);
return;
}
if (!chkSel(this.ListForm,'Chk[]')) {
alert(this.NoChk);
return false;
}
if (confirm(this.ConfirmDelete)) this.sajaxSubmit('Op=delete',this.ListForm,this.callBack);
}
AjaxEdit.prototype._truncate = function(p_id) {
if (p_id) {
if (confirm(this.ConfirmDelete)) this.sajaxSubmit('Op=truncate&Chk='+p_id,'',this.callBack);
return;
}
if (!chkSel(this.ListForm,'Chk[]')) {
alert(this.NoChk);
return false;
}
if (confirm(this.ConfirmDelete)) this.sajaxSubmit('Op=truncate',this.ListForm,this.callBack);
}
AjaxEdit.prototype.deleteOne = function(p_id,p_extparam,p_lang) {
if(typeof p_lang!="undefined" && p_lang!="") var lang="&PageLang="+p_lang;
else lang="";
if (this.trim(p_id)!="") {
if(p_extparam) p_extparam="&"+p_extparam;
else p_extparam="";
if (confirm(this.ConfirmDelete)) this.sajaxSubmit('Op=deleteOne&Chk='+p_id+p_extparam+lang,'',this.callBack);
}
}
AjaxEdit.prototype.truncateOne = function(p_id,p_extparam,p_lang) {
curlang =this.getCurLang("List");
if(typeof p_lang!="undefined" && p_lang!="") var lang="&PageLang="+p_lang;
else 	if(typeof curlang!="undefined" && curlang!="") var lang="&PageLang="+curlang;
else lang="";
if (p_id) {
if(p_extparam) p_extparam="&"+p_extparam;
else p_extparam="";
if (confirm(this.ConfirmDelete)) this.sajaxSubmit('Op=truncateOne&Chk='+p_id+p_extparam+lang,'',this.callBack);
}
}
AjaxEdit.prototype.showAdd = function(p_title,p_style,p_div) {
if (!p_title) p_title="Quick Add";
if (!p_style) p_style="middle";
if (!p_div) p_div=this.name+"_popDiv";
if (p_style=="large") p_style="width:95%;height:90%;top:20;Close:1";
if (p_style=="middle") p_style="width:420;height:300;top:100;Close:1";
if (p_style=="small") p_style="width:280;height:150;top:150;Close:1";
try {
var Obj_addDiv = eval(this.name+"_addDiv");
}
catch(e){
alert(e.message);
return false;
}
divOs.popWindow(p_title,p_style,Obj_addDiv,p_div);
this.focusForm(this.name+"_AddForm","firstText");
}
AjaxEdit.prototype.saveAdd = function(p_noclose,p_prefix) {
if (!p_prefix) p_prefix = "TB_";
var FormData = eval(this.name+"_FormData");
var checked = FormData.datavalid(this.name+"_AddForm",p_prefix);
if (checked == false) return false;
this.sajaxSubmit("Op=add",this.name+"_AddForm",this.callBack);
}
AjaxEdit.prototype.saveFull = function(p_id,p_form,p_noclose,p_prefix) {
if (!p_prefix) p_prefix = "TB_";
var FormData = eval(this.name+"_FormData");
if (!p_form) p_form = this.name+"_FullForm";
var checked = FormData.datavalid(p_form,p_prefix);
if (checked == false) return false;
this.sajaxSubmit("FullEdit=1&Op=edit&keyId="+p_id,p_form,this.callBack);
}
AjaxEdit.prototype.createDivNode = AjaxEdit.prototype.popWindow;
AjaxEdit.prototype.trim = function(p_str) {
p_str= p_str.replace(/(^\s*)|(\s*$)/g, "");
p_str= p_str.replace(/(^&nbsp;*)|(&nbsp;*$)/g, "");
return p_str;
}
AjaxEdit.prototype.chkSel = function(p_chk){
if (!chkSel(this.ListForm,p_chk)) {
alert(this.NoChk);
return false;
}
return true;
}
var currentForm ;
function frm_hideFormCount(p_seq) {
$("form[name='_Form_"+p_seq+"']").children("#formcount").hide();
}
function frm_hideTemporary(p_seq) {
$("form[name='_Form_"+p_seq+"'] div[id='formbackbtn']").hide();
}
function frm_setFormCount(p_seq,p_num) {
$("form[name='_Form_"+p_seq+"']").children("#formcount").children("#formcount_num").html(p_num);
}
function frm_detail(Res) {
if(Res.RetCode==0){
alert(Res.Content);
if(Res.Other!="")
window.location = Res.Other;
return;
}
var authCodeObj = $("form[name='"+Res.TagId+"'] div[id='formdisplay'] > table[class='form-table hasBD'] :text[id='form-code']");
var authCodeStr = authCodeObj.parent().parent().parent().parent().parent().parent().html();
if(divOs.browser=="IE") var authCodeStr = authCodeObj.parent().parent().parent().parent().parent().parent().parent().html();
var code = new RegExp("(<table?)[^>]*>(.|\n)*<div","ig");
var re = Res.Other;
var mm = code.exec(re);
Res.Other = mm[0].substr(0,mm[0].length-11);
$("form[name='"+Res.TagId+"'] div[id='formdisplay'] > table[class='form-table hasBD']").remove();
$("form[name='"+Res.TagId+"'] div[id='formdisplay'] div:first").before(Res.Other);
var tableStr = $("form[name='"+Res.TagId+"'] div[id='formdisplay'] div:first").prev().html();
$("form[name='"+Res.TagId+"'] div[id='formdisplay'] div:first").prev().html(tableStr + authCodeStr);
var imgsrc = $("form[name='"+Res.TagId+"'] div[id='formpreview']").prev().attr('src');
$("form[name='"+Res.TagId+"'] div[id='formpreview']").prev().attr('src', imgsrc);
}
function frm_chkLogin(p_seq) {
if(!divOs.Cookie.getCookie('cm_id')){
$("form[name='_Form_"+p_seq+"'] :button[id='_Form_"+p_seq+"_Temporary']").hide();
}
else {
$("form[name='_Form_"+p_seq+"'] :button[id='_Form_"+p_seq+"_Temporary']").show();
}
}
function frm_chkForm(p_form,p_prefix) {
var codeMsg = ""
var dtCheck = new dataCheck();
var value = $(eval(p_form.authcode)).val();
if(strUtil.prototype.isEmpty(value)) {
codeMsg = $(eval(p_form.AuthCodeMsg)).val();
alert(codeMsg);
return false;
}
dtCheck.setField(eval("new Array("+p_form.FieldList.value+")"));
dtCheck.setName(eval("new Array("+p_form.FieldName.value+")"));
dtCheck.setNull(eval("new Array("+p_form.FieldNull.value+")"));
dtCheck.setType(eval("new Array("+p_form.FieldType.value+")"));
dtCheck.setMsg(eval("new Array("+p_form.FieldMsg.value+")"));
return dtCheck.datavalid(p_form,p_prefix);
}
function frm_formPreview(p_form,p_prefix) {
var par = p_form;
var dispDiv ;
var reviewTable ,reviewDiv;
for(i=0;i<par.childNodes.length;i++) {
if(par.childNodes[i].id=='formdisplay') {
dispDiv = par.childNodes[i];
}
if(par.childNodes[i].id=='formpreview') {
reviewDiv = par.childNodes[i];
}
}
for(i=0;i<reviewDiv.childNodes.length;i++) {
if(reviewDiv.childNodes[i].tagName=='TABLE') {
for(j=0;j<reviewDiv.childNodes[i].childNodes.length;j++) {
if(reviewDiv.childNodes[i].childNodes[j].tagName=='TBODY') {
reviewTable = reviewDiv.childNodes[i].childNodes[j]; break;
}
}
break;
}
}
frmElements = new Object();
var elm ;
var name;
var val = "";
var sepField = new Array();
var sepField_max = new Array();
var sepCounter=0;
for(i=0;i<p_form.elements.length;i++){
elm = p_form.elements[i];
name = elm.name;
if(name.indexOf("\[\]")>0) name = name.substr(0,name.indexOf("\[\]"));
if(elm.type=='checkbox' || elm.type=='radio') {
if(elm.checked) frmElements[name] = ((typeof(frmElements[name])=='undefined')?'':frmElements[name]+"\n")+elm.value;
}
else if(elm.type=='select-one') {
if(elm.selectedIndex > -1 && elm.options[elm.selectedIndex].text)
frmElements[name] = elm.options[elm.selectedIndex].text;
else
frmElements[name] = elm.value;
}
else {
frmElements[name] = elm.value;
}
if(name.indexOf("SepMax")>0) {
sepField[sepCounter] = name.substr(10);
sepField_max[sepCounter++] = elm.value;
}
}
for(i=0;i<sepField.length;i++) {
var val = "";
seq = sepField[i];
max = sepField_max[i];
var Symbol = eval('p_form.FrmSepSymbol_'+seq+'.value');
for(j=1;j<max;j++) {
val+=Symbol+eval('p_form.FrmSep_'+seq+'_'+j+'.value');
}
name = p_prefix+seq;
frmElements[name] = ((typeof(frmElements[name])=='undefined')?'':frmElements[name])+val;
}
for(i=0;i<reviewTable.childNodes.length;i++) {
var trNode = reviewTable.childNodes[i];
if(trNode.tagName!='TR') continue;
for(j=0;j<trNode.cells.length;j++) {
var tdNode = trNode.cells[j];
if(tdNode.id) {
name = p_prefix+tdNode.id;
if(typeof(frmElements[name])=="undefined") frmElements[name] = "";
tdNode.innerHTML = "<strong>"+strUtil.prototype.directShowInput(frmElements[name])+"&nbsp;</strong>";
}
}
}
dispDiv.style.display="none";
reviewDiv.style.display="block";
}
function frm_uploaded(type,res,id,param) {
var pam = param.split(',');
var frm = eval("document."+pam[0]);
if(type==1){
frm.FileUploadName.value=res;
eval(frm.name+"_editor").setUri(pam[1]);
eval(frm.name+"_editor").sajaxSubmit('FormName='+frm.name,frm.name,'frm_callBack')
return false;
}
}
function frm_submitForm(p_form,p_url) {
var upField = p_form.UploadField.value.split(",");
var upobj;
for(i=0;i<upField.length-1;i++) {
upobj = eval('p_form.Frm_'+upField[i]);
if(upobj.value) {
$(p_form._ParamString).val(p_form.name+','+p_url);
p_form.submit();
return;
}
}
eval(p_form.name+"_editor").setUri(p_url);
eval(p_form.name+"_editor").sajaxSubmit('FormName='+p_form.name,p_form.name,'frm_callBack')
}
function frm_callBack(z) {
var Res= sajaxIO.prototype.getMsg(z);
var frm = eval("document."+Res.Other);
if(Res.RetCode==1){
$(frm).children("#formmsg").show();
$(frm).children("#formmsg").html(Res.Content);
$(frm).children("#formdisplay").hide();
$(frm).children("#formpreview").hide();
$(frm).children("#formbackbtn").show();
$(frm).children("#formcount").hide();
}
else{
divOs.openAlertWindow(divOs.AlertFailed,Res.Content);
}
if(eval(frm.name+"_editor").silent == 0) divOs.closeWaitingWindow('sending');
if (Res.JsFunction != "") eval(Res.JsFunction);
}
function frm_backForm(p_form) {
var par = p_form;
$(par).children("#formdisplay").show();
$(par).children("#formpreview").hide();
$(par).children("#formmsg").hide();
$(par).children("#formbackbtn").hide();
$(par).children("#formcount").show();
}
function frm_cancelSubmit(p_form) {
var par = p_form;
var dispTable ;
var reviewTable ;
for(i=0;i<par.childNodes.length;i++) {
if(par.childNodes[i].id=='formdisplay') {
dispTable = par.childNodes[i];
}
if(par.childNodes[i].id=='formpreview') {
reviewTable = par.childNodes[i];
}
}
dispTable.style.display="block";
reviewTable.style.display="none";
}
function frm_checkFormPriv(p_fname,p_seq) {
var privType;
var privSetting;
var privClass 	 = $(eval("document."+p_fname+".FormPrivClass")).val();
var jsFunc = 'frm_clickAfterLogin(\''+p_fname+'\')';
if($.trim(privClass)!=""){
var classList 	 = privClass.split("@@@");
privType = classList[0];
if(privType>0){
if(typeof(divOs.Cookie.getCookie('cm_name'))=='undefined'){
loginFirst(window.event,'cm_cust','/bin',classList[3],jsFunc);
return false;
}
var cmClass = divOs.Cookie.getCookie("cm_class");
if(privType==2){
privSetting = classList[1];
if($.trim(cmClass)=="" || privSetting.indexOf(','+cmClass+',') == -1){
alert(classList[2]);
return false;
}
}
}
}
var privGroup 	 = $(eval("document."+p_fname+".FormPrivGroup")).val();
if($.trim(privGroup)!=""){
var groupList 	 = privGroup.split("@@@");
privType = groupList[0];
if(privType>0){
if(typeof(divOs.Cookie.getCookie('cm_name'))=='undefined'){
loginFirst(window.event,'cm_cust','/bin',groupList[3],jsFunc);
return false;
}
var cmGroup = divOs.Cookie.getCookie("cm_group");
if(privType==2){
privSetting = groupList[1];
if($.trim(cmGroup)=="" || privSetting.indexOf(','+cmGroup+',') == -1){
alert(groupList[2]);
return false;
}
}
}
}
return true;
}
function frm_initCascade(p_fname,p_topseq) {
if(trim(p_topseq) == "") return;
try{
var topList = p_topseq.split(",");
for(var i=0;i<topList.length;i++) {
frm_dealCascade(p_fname,topList[i]);
}
}
catch(e){}
}
function frm_dealCascade(p_fname,p_seq) {
var optionstr;
var obj_sub;
var sub_seq;
var sub_val;
var top_sel;
try{
sub_seq     = $(eval("document."+p_fname+".form_sub_"+parseInt(p_seq))).val();
top_sel   	= $(eval("document."+p_fname+".Frm_"+p_seq)).val();
top_sel     = strUtil.prototype.htmlspecialchars(top_sel);
while(parseInt(sub_seq)) {
optionstr="";
sub_val    = $(eval("document."+p_fname+".form_value_"+sub_seq)).val();
obj_sub = eval("document."+p_fname+".Frm_"+sub_seq);
sub_select    = $(eval("document."+p_fname+".form_selected_"+sub_seq)).val();
if(obj_sub==null) return;
$(obj_sub).empty();
if(sub_val) {
val_arr  = sub_val.split("@*@*@*");
var checked = false;
for(var j=0;j<val_arr.length;j++) {
l_arr    = val_arr[j].split("~@~@~@");
if(l_arr.length<3) continue;
if(top_sel != strUtil.prototype.htmlspecialchars(l_arr[3]) && $.trim(l_arr[0])!="") continue;
if(l_arr[0]==sub_select) {
checked = true;
optionstr += '<option value="'+strUtil.prototype.htmlspecialchars(l_arr[0])+'" selected>'+strUtil.prototype.htmlspecialchars(l_arr[1])+'</option>';
}
else
optionstr += '<option value="'+strUtil.prototype.htmlspecialchars(l_arr[0])+'">'+strUtil.prototype.htmlspecialchars(l_arr[1])+'</option>';
}
if($.trim(sub_select) && !checked)
optionstr += '<option value="'+strUtil.prototype.htmlspecialchars(sub_select)+'" selected>'+strUtil.prototype.htmlspecialchars(sub_select)+'</option>';
if($.trim(optionstr)!="")
$(optionstr).appendTo(obj_sub);
}
sub_seq = $(eval("document."+p_fname+".form_sub_"+parseInt(sub_seq))).val();
top_sel   = $(obj_sub).val();
}
}catch(e){}
}
function frd_getMemInfo(p_form,p_seq,p_url) {
if(typeof(divOs.Cookie.getCookie('cm_name'))=='undefined') return;
var cm_fields = new Array();
var val,i;
var value 	= $(eval("document."+p_form+".Frm_ConMemField_"+p_seq)).val();
if($.trim(value)=="") return;
var val_arr = value.split("@*@*@*");
for(i=0;i<val_arr.length-1;i++) {
val = val_arr[i].split("~@~@~@");
if(val[1] == "file" || val[1] == "septext") continue;
if($.trim(val[2])!="")
cm_fields.push($.trim(val[2]));
}
if(cm_fields.length==0) return;
var param 	= "formName="+p_form+"&conmemfield=";
param += cm_fields.join(",");
eval(p_form+"_editor").setUri(p_url);
eval(p_form+"_editor").sajaxSubmit(param,'','frm_conmemfield_callBack')
}
function frm_conmemfield_callBack(z) {
var Res = sajaxIO.prototype.getMsg(z);
if($.trim(Res.Other) == "" || $.trim(Res.RetCode) == "") {
return;
}
var formName   = Res.RetCode;
if(eval(formName+"_editor").silent == 0) divOs.closeWaitingWindow('sending');
var mem_name 	= new Array();
var mem_type 	= new Array();
var mem_field	= new Array();
var fr_arr  	= formName.split("_");
var fr_nbr  	= fr_arr[fr_arr.length-1];
var value   	= $(eval("document."+formName+".Frm_ConMemField_"+fr_nbr)).val();
var val_arr 	= value.split("@*@*@*");
var val	= new Array();
var i,j,ii,jj,m;
for(i=0;i<val_arr.length-1;i++) {
val = val_arr[i].split("~@~@~@");
if(val[1] == "file" || val[1] == "septext") continue;
mem_name[i]  = val[0];
mem_type[i]  = val[1];
mem_field[i] = val[2];
}
var parser = new DOMImplementation();
var domDoc = parser.loadXML(Res.Other);
var docRoot = domDoc.getDocumentElement();
var tag1 = docRoot.getElementsByTagName("MemData").item(0);
var childNodes = tag1.getChildNodes();
var Nodes = new hashUtil();
var item_childs;
var key,value,key_val,valList;
for(i=0,j=childNodes.getLength();i<j;i++) {
item_childs = childNodes.item(i).getChildNodes();
for(ii=0,jj=item_childs.getLength();ii<jj;ii++) {
if(item_childs.item(ii).getNodeName() == "key")
key = item_childs.item(ii).getFirstChild().getNodeValue();
else if(item_childs.item(ii).getNodeName() == "value"){
if(item_childs.item(ii).getFirstChild())
value = item_childs.item(ii).getFirstChild().getNodeValue();
else
value = "";
}
}
Nodes.push(key,value);
}
for(i=0,j=mem_field.length;i<j;i++) {
key_val	= Nodes.get(mem_field[i]);
if(key_val==null) continue;
if(mem_type[i] == "text" || mem_type[i] == "textarea") {
$(eval("document."+formName+"."+mem_name[i])).val(key_val);
}
else if(mem_type[i] == "radio") {
$("form[name="+formName+"]").find("input[name='"+mem_name[i]+"']").each(function() {
if($.trim($(this).attr("value"))==$.trim(key_val)){
$(this).attr("checked",true);
}
else $(this).attr("checked",false);
});
}
else if(mem_type[i] == "checkbox") {
valList = key_val.split("\n");
valList = "@@@"+valList.join("@@@")+"@@@";
$("form[name="+formName+"]").find("input[name='"+mem_name[i]+"[]']").each(function() {
if(valList.indexOf("@@@"+$.trim($(this).attr("value")+"@@@"))!=-1)
$(this).attr("checked",true);
else
$(this).attr("checked",false);
});
}
else if(mem_type[i] == "option") {
$(eval("document."+formName+"."+mem_name[i])).children().each(function() {
if(key_val == $(this).val()) {
$(this).parent().val($(this).val());
}
});
}
else if(mem_type[i] == "cascade") {
$(eval("document."+formName+"."+mem_name[i])).children().each(function() {
if(key_val == $(this).val()) {
$(this).parent().val($(this).val());
$(eval("document."+formName+"."+mem_name[i])).trigger("change");
}
});
}
}
}
function frm_clickAfterLogin(p_fname) {
divOs.closeAllPopWindow();
}
function dealHln(p_ishome,p_op,p_topobj) {
var itemId,item;
if(p_ishome) {
setHlnStat(_HomeHln,"block",p_topobj);
setHlnStat(_InternalHln,"none",p_topobj);
}
if(!p_ishome) {
setHlnStat(_HomeHln,"none",p_topobj);
setHlnStat(_InternalHln,"block",p_topobj);
}
if(p_op=="logout") {
setHlnStat(_LoginHln,"none",p_topobj);
setHlnStat(_LogoutHln,"block",p_topobj);
}
if(p_op=="login") {
setHlnStat(_LoginHln,"block",p_topobj);
setHlnStat(_LogoutHln,"none",p_topobj);
}
}
function setHlnStat(p_hash,p_style,p_topobj){
var itemId,item;
while(!p_hash.isEOF()){
itemId = p_hash.read()
item = $(p_topobj).find("#"+itemId);
if(p_style == 'block') item.show();
else item.hide();
}
p_hash.resetPointer();
}
function setRecentCookie(name,val,separator,path,duration,cnt){
var str = divOs.Cookie.getCookie(name);
if(str!=undefined){
var val_arr = new Array();
var val_tmp = new Array();
val_arr = str.split(separator);
val_tmp[0] = val;
for(var i=0,j=1;i<val_arr.length;i++){
if(cnt && j==cnt) continue;
if(val_arr[i]==val) continue;
val_tmp[j] = val_arr[i];
j++;
}
str = val_tmp.join(separator);
divOs.Cookie.setCookie(name,str,duration,path);
}
else{
divOs.Cookie.setCookie(name,val,duration,path);
}
}
function dealRefresh(imgId,codeId,img,code) {
document.getElementById(imgId).src=img;
document.getElementById(codeId).value=code;
}
function refreshAuthCode(p_editor,p_program,p_imgid,p_codeid,p_obj) {
if(p_editor){
var oldUri = p_editor.sajaxUri
p_editor.setUri(p_program);
p_editor.sajaxSubmit('Op=refresh&TagId='+p_editor.TagName+'&imgid='+p_imgid+'&codeid='+p_codeid,'','AjaxEdit.prototype.callBack ')
p_editor.setUri(oldUri);
}else{
var url = $.trim(p_program) ? $.trim(p_program) : window.location.protocol+'//'+window.location.host+'/bin/showauthimg.php';
$.post(url,'Op=refresh&codeType=new',function(data){
if(data.stat == 'success'){
if(typeof p_obj == 'object'){
var closePar  = $(p_obj).closest('.captcha_img');
if(closePar.length){
closePar.find('#'+p_imgid).attr('src',data.img);
closePar.find('#'+p_codeid).val(data.code);
}else{
$('#'+p_imgid).attr('src',data.img);
$('#'+p_codeid).val(data.code);
}
}else{
$('#'+p_imgid).attr('src',data.img);
$('#'+p_codeid).val(data.code);
}
}
},"json");
}
}
function showCmField(p_field,p_default) {
var val = new strUtil(divOs.Cookie.getCookie(p_field));
if(trim(val.String)!="") return val.String;
else return p_default;
}
function checkLogin(p_cookiename) {
if(divOs.Cookie.existCookie(p_cookiename)) return true;
return false;
}
function loginFirst(p_event,p_cookiename,p_front,p_title,p_js) {
var navi = window.navigator.userAgent.toUpperCase();
if(!divOs.Cookie.existCookie(p_cookiename)) {
if(typeof(ssoLoginUrl)!="undefined" && trim(ssoLoginUrl)) { window.location.href = ssoLoginUrl; return false;}
var base64enc = new Base64();
var url = p_front+'/showmodule.php?Mo=34&Type=poplogin&Nbr=0&Special=1&Js='+base64enc.base64encode(p_js);
divOs.openPopSajaxUrl(p_title,"Close=1;Static=0;width=330;height=250;top:160;",url,'PopLogin',p_event);
return false;
}
else return true;
}
function loginFirst_cb(z) {
Res= sajaxIO.prototype.getMsg(z);
if(_chklogin_editor.silent == 0) divOs.closeWaitingWindow('sending');
if(Res.RetCode=='Login') {
eval(unescape(_chklogin_editor.Js)+";");
}else if(Res.RetCode=='Logout') {
var url=_chklogin_editor.Front+'/showmodule.php?Mo=34&Type=poplogin&Nbr=0&Special=1&Js='+_chklogin_editor.Js;
divOs.openPopSajaxUrl(_chklogin_editor.Title,"Close=1;Static=0;width=330;height=250;top:160;",url,'PopLogin');
}
}
function privModuleLoginSuccess() {
divOs.closeAllPopWindow();
}
function logoutSuccess() {
window.location.href=window.location.href;
}
function loginSuccess() {
dealHln('','login') ;
onActionTrigger(1);
}
function reload(p_div,p_moname,p_moid,p_type,p_nbr,p_front,p_loading,p_blankimg,p_param,p_special) {
var el = document.getElementById(p_div);
var dynamicLoad =  "<div class=\"module-loading\"><div class=\"md_top\"><div class=\"mt_03\"><div class=\"mt_02\"><div class=\"mt_01\"><h3>"+p_moname+"</h3></div></div></div></div><div class=\"md_middle\"><div class=\"mm_03\"><div class=\"mm_02\"><div class=\"mm_01\">"+p_loading+"</div></div></div></div><div class=\"md_bottom\"><div class=\"mb_03\"><div class=\"mb_02\"><div class=\"mb_01\"></div></div></div></div></div></div>\n";
var special="";
if(p_special=="1") {
var special="&Special=1";
}
if(p_param){
var param = '&Param='+p_param;
}
dynamicLoad+=  "<img src=\""+p_blankimg+"\" border=\"0\" onload=\"divOs.openSajaxUrl('"+p_div+"','"+p_front+"/showmodule.php?Mo="+p_moid+"&Type="+p_type+"&OO=1&Nbr="+p_nbr+param+special+"');\"/>\n";
divOs.setInnerHTML(el,dynamicLoad);
}
function fixMenuPosition(par,id,cnt,offset,flag) {
var p=par;
var scrollTop ;
scrollTop = document.body.scrollTop + document.documentElement.scrollTop;
var clientHeight = document.documentElement.clientHeight;
var obj = document.getElementById(id);
if(obj.style.display=="none") obj.style.display="block";
offsetTop = 0;
while(par !== null) {
offsetTop += par.offsetTop;
par = par.offsetParent;
}
if(typeof offset=="undefined") offset=10;
offset = 5;
var ch = obj.offsetHeight;
var diff = ( offsetTop+ch +offset)  - (scrollTop+clientHeight);
if(diff>0) {
obj.style.top= "-"+diff+"px";
}
else  {
obj.style.top= "-1px";
}
}
function chkVote(p_form,p_cnt) {
if(typeof p_cnt=='undefined' ) p_cnt=0;
var elements = p_form.elements;
var len = elements.length;
var elements = p_form.elements;
var voteName= "";
var votedName= "";
var preName = "";
var preVote ="";
var vName ="";
var votedCnt = 0;
for(var i=0;i<len;i++){
vName = elements[i].name;
if(elements[i].type){
switch(elements[i].type){
case "checkbox":
if(vName!=preName) { preName = vName;  voteName +=","+vName; }
if(elements[i].checked){
if(preVote!=vName) votedName +=","+vName;
preVote = vName;
votedCnt++;
}
break;
case "radio":
if(vName!=preName) { preName = vName;  voteName +=","+vName; }
if(elements[i].checked){
votedName +=","+vName;
preVote = vName;
};
break;
}
}
}
if(voteName!=votedName) return -1;
else if(p_cnt>0 && votedCnt>p_cnt) return -2;
else return 1;
}
function addBookmark(url,title) {
if (window.sidebar) {
window.sidebar.addPanel(title, url,"");
} else if( document.all ) {
window.external.AddFavorite( url, title);
} else if( window.opera && window.print ) {
return true;
}
}
function resizeTrigger() {
var func = window.onresize;
if(typeof(func)!="function") return;
func();
}
function onActionTrigger(p_type) {
for(var i=0;i<triggerAction[p_type].length;i++) {
try{
eval(triggerAction[p_type][i]);
}catch(e){}
}
}
function initAllmenu(p_class,p_again){
if(typeof p_again=='undefined') p_again=0;
var menus = $("."+p_class);
for(var i=0;i<menus.length;i++) {
initmenu(menus.get(i),p_again);
}
}
function initmenu(p_menu,p_again){
var ultags=p_menu.getElementsByTagName("ul")
var litags=p_menu.getElementsByTagName("li")
if(!ultags.length && !litags.length && !p_again) {
setTimeout("initAllmenu('"+p_menu.className+"',1)",1000);
}
for (var t=ultags.length-1; t>-1; t--){
ultags[t].style.visibility="hidden"
ultags[t].style.display="block"
}
for (var t=0; t<ultags.length; t++){
ultags[t].parentNode.getElementsByTagName("div")[0].className+=" subfolderstyle"
if (ultags[t].parentNode.parentNode.id==p_menu.id) {
ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px"
}
else {//else if this is a sub level submenu (ul)
ultags[t].style.left=ultags[t-1].getElementsByTagName("div")[0].offsetWidth+"px"
}
}
for (var t=ultags.length-1; t>-1; t--){
ultags[t].style.visibility="visible"
ultags[t].style.display="none"
}
}
function runLink(opt) {
if(opt.getAttribute("runjs")) {
new Function(opt.getAttribute("value"))();
}
else {
if(trim(opt.getAttribute("value"))=='') return false;
else if(opt.getAttribute("target")=="_blank") {
window.open(opt.getAttribute("value"));
} else {
location.href = opt.getAttribute("value");
}
}
}
function getMediaObj(p_id) {
if (window.document[p_id]) {
return window.document[p_id];
}
if(divOs.browser=="IE"){
return document.getElementById(p_id);
}
else {
if(document.embeds && document.embeds[p_id]) {
return document.embeds[p_id];
}
}
}
function setMediaParam(p_codeid,p_id,p_src,p_action) {
var mediaObj =  getMediaObj(p_id);
var p_code = $('#'+p_codeid).val();
mediaObj.SetVariable("Voc",p_src);
mediaObj.SetVariable("Dec",p_action);
mediaObj.SetVariable("Code",p_code);
mediaObj.SetVariable("go",1);
}
triggerAction = new Array();
triggerAction[0] = new Array();
triggerAction[1] = new Array();
function CharMode(iN){
if (iN>=48 && iN <=57) return 1;
if (iN>=65 && iN <=90) return 2;
if (iN>=97 && iN <=122)  return 4;
else return 8;
}
function bitTotal(num){
modes=0;
for (i=0;i<4;i++){
if (num & 1) modes++;
num>>>=1;
}
return modes;
}
function checkStrong(sPW){
if (sPW.length<=4)  return 1;
Modes=0;
for (i=0;i<sPW.length;i++){
Modes|=CharMode(sPW.charCodeAt(i));
}
return bitTotal(Modes);
}
function Base64() {
this.base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
this.base64DecodeChars = new Array(
-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63,
52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -1, -1, -1, -1, -1, -1,
-1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14,
15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1,
-1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40,
41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1);
return this;
}
Base64.prototype.base64encode=function(str) {
var out, i, len;
var c1, c2, c3;
len = str.length;
i = 0;
out = "";
while(i < len) {
c1 = str.charCodeAt(i++) & 0xff;
if(i == len) {
out += this.base64EncodeChars.charAt(c1 >> 2);
out += this.base64EncodeChars.charAt((c1 & 0x3) << 4);
out += "==";
break;
}
c2 = str.charCodeAt(i++);
if(i == len) {
out += this.base64EncodeChars.charAt(c1 >> 2);
out += this.base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4));
out += this.base64EncodeChars.charAt((c2 & 0xF) << 2);
out += "=";
break;
}
c3 = str.charCodeAt(i++);
out += this.base64EncodeChars.charAt(c1 >> 2);
out += this.base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4));
out += this.base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >>6));
out += this.base64EncodeChars.charAt(c3 & 0x3F);
}
return out;
}
Base64.prototype.base64decode = function (str) {
var c1, c2, c3, c4;
var i, len, out;
len = str.length;
i = 0;
out = "";
while(i < len) {
do {
c1 = this.base64DecodeChars[str.charCodeAt(i++) & 0xff];
} while(i < len && c1 == -1);
if(c1 == -1)
break;
do {
c2 = this.base64DecodeChars[str.charCodeAt(i++) & 0xff];
} while(i < len && c2 == -1);
if(c2 == -1)
break;
out += String.fromCharCode((c1 << 2) | ((c2 & 0x30) >> 4));
do {
c3 = str.charCodeAt(i++) & 0xff;
if(c3 == 61)
return out;
c3 = this.base64DecodeChars[c3];
} while(i < len && c3 == -1);
if(c3 == -1)
break;
out += String.fromCharCode(((c2 & 0XF) << 4) | ((c3 & 0x3C) >> 2));
do {
c4 = str.charCodeAt(i++) & 0xff;
if(c4 == 61)
return out;
c4 = this.base64DecodeChars[c4];
} while(i < len && c4 == -1);
if(c4 == -1)
break;
out += String.fromCharCode(((c3 & 0x03) << 6) | c4);
}
return out;
}
function changeChkStyle(obj){
try{
if(obj.checked){
while(obj.tagName != "TR")	obj = obj.parentNode;
temp=obj.className.split(" ");
obj.className = temp[0]+" row_checked";
}
else{
while(obj.tagName != "TR")	obj = obj.parentNode;
temp=obj.className.split(" ");
obj.className = temp[0];
}
}catch(e){}
}
function changeAll(p_obj,p_form,p_name) {
if(p_obj.checked)
chkAll(p_form,p_name);
else
clsAll(p_form,p_name);
}
function chkAll(p_form,p_name) {
var frm = eval("document."+p_form);
for(i=0;i<frm.elements.length;i++) {
if(frm.elements[i].name==p_name) {
frm.elements[i].checked = true;
changeChkStyle(frm.elements[i]);
}
}
}
function clsAll(p_form,p_name) {
var frm = eval("document."+p_form);
for(i=0;i<frm.elements.length;i++) {
if(frm.elements[i].name==p_name) {
frm.elements[i].checked = false;
changeChkStyle(frm.elements[i]);
}
}
}
function changeAll_1(p_check,p_form,p_name) {
if(p_check)
chkAll_1(p_form,p_name);
else
clsAll_1(p_form,p_name);
}
function chkAll_1(p_form,p_name) {
var frm = eval("document."+p_form);
for(i=0;i<frm.elements.length;i++) {
if(frm.elements[i].name==p_name) {
frm.elements[i].checked = true;
}
}
}
function clsAll_1(p_form,p_name) {
var frm = eval("document."+p_form);
for(i=0;i<frm.elements.length;i++) {
if(frm.elements[i].name==p_name) {
frm.elements[i].checked = false;
}
}
}
function chkSel(p_form,p_name) {
var frm = eval("document."+p_form);
var chk = false;
for(var i=0;i<frm.elements.length;i++)  {
obj = frm.elements[i];
if(obj.name==p_name) {
if(obj.checked) {
chk = true;
break;
}
}
}
return chk;
}
function mouseOut(obj,p_form,p_id){
try{
var checkbox = eval("document."+p_form+"."+p_id);
if(checkbox.checked) return false;
} catch(e) {}
obj.className = "TrUnChecked";
return false;
}
function tr_mouseOut(obj,p_id){
try{
var checkbox = document.getElementById(p_id);
if(checkbox.checked || obj.className=="row_operate" || obj.className=="row_invalid") return false;
} catch(e) {}
obj.className = "row_normal";
return false;
}
function tr_mouseOver(obj,p_id){
try{
var checkbox = document.getElementById(p_id);
if(checkbox.checked || obj.className=="row_operate" || obj.className=="row_invalid") return false;
} catch(e) {}
obj.className = "row_hover";
return false;
}
var temp_color = "";
function onMouseOverAction(p_obj){
temp_color = p_obj.style.backgroundColor;
p_obj.style.backgroundColor = "#ffffcc";
}
function onMouseOutAction(p_obj){
p_obj.style.backgroundColor = temp_color;
}


}
/*
     FILE ARCHIVED ON 17:06:51 Mar 18, 2021 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 09:31:58 Sep 16, 2025.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
playback timings (ms):
  captures_list: 0.844
  exclusion.robots: 0.029
  exclusion.robots.policy: 0.012
  esindex: 0.016
  cdx.remote: 40.123
  LoadShardBlock: 481.845 (3)
  PetaboxLoader3.resolve: 357.315 (4)
  PetaboxLoader3.datanode: 264.372 (4)
  load_resource: 194.026
*/
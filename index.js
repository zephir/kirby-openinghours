(function(){"use strict";const o=window.Vue,V=o.computed;o.customRef,o.defineAsyncComponent,o.defineComponent,o.effectScope,o.getCurrentInstance,o.getCurrentScope,o.h,o.inject,o.isProxy,o.isReactive,o.isReadonly,o.isRef,o.isShallow,o.markRaw;const E=o.nextTick;o.onActivated,o.onBeforeMount,o.onBeforeUnmount,o.onBeforeUpdate,o.onDeactivated,o.onErrorCaptured,o.onMounted,o.onRenderTracked,o.onRenderTriggered,o.onScopeDispose,o.onServerPrefetch,o.onUnmounted,o.onUpdated,o.provide,o.proxyRefs,o.reactive,o.readonly;const z=o.ref;o.shallowReactive,o.shallowReadonly,o.shallowRef,o.toRaw,o.toRef,o.toRefs,o.triggerRef,o.unref,o.useAttrs,o.useCssModule,o.useCssVars,o.useListeners,o.useSlots;const N=o.watch;o.watchEffect,o.watchPostEffect,o.watchSyncEffect;var te=typeof globalThis<"u"?globalThis:typeof window<"u"?window:typeof global<"u"?global:typeof self<"u"?self:{};function ne(g){return g&&g.__esModule&&Object.prototype.hasOwnProperty.call(g,"default")?g.default:g}var J={exports:{}};(function(g,e){(function(t,l){g.exports=l()})(te,function(){var t=1e3,l=6e4,v=36e5,d="millisecond",s="second",f="minute",c="hour",u="day",y="week",_="month",K="quarter",x="year",q="date",Q="Invalid Date",Ae=/^(\d{4})[-/]?(\d{1,2})?[-/]?(\d{0,2})[Tt\s]*(\d{1,2})?:?(\d{1,2})?:?(\d{1,2})?[.:]?(\d+)?$/,Ye=/\[([^\]]+)]|Y{1,4}|M{1,4}|D{1,2}|d{1,4}|H{1,2}|h{1,2}|a|A|m{1,2}|s{1,2}|Z{1,2}|SSS/g,qe={name:"en",weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_"),ordinal:function(p){var a=["th","st","nd","rd"],n=p%100;return"["+p+(a[(n-20)%10]||a[n]||a[0])+"]"}},U=function(p,a,n){var i=String(p);return!i||i.length>=a?p:""+Array(a+1-i.length).join(n)+p},He={s:U,z:function(p){var a=-p.utcOffset(),n=Math.abs(a),i=Math.floor(n/60),r=n%60;return(a<=0?"+":"-")+U(i,2,"0")+":"+U(r,2,"0")},m:function p(a,n){if(a.date()<n.date())return-p(n,a);var i=12*(n.year()-a.year())+(n.month()-a.month()),r=a.clone().add(i,_),h=n-r<0,m=a.clone().add(i+(h?-1:1),_);return+(-(i+(n-r)/(h?r-m:m-r))||0)},a:function(p){return p<0?Math.ceil(p)||0:Math.floor(p)},p:function(p){return{M:_,y:x,w:y,d:u,D:q,h:c,m:f,s,ms:d,Q:K}[p]||String(p||"").toLowerCase().replace(/s$/,"")},u:function(p){return p===void 0}},B="en",j={};j[B]=qe;var X="$isDayjsObject",Z=function(p){return p instanceof L||!(!p||!p[X])},P=function p(a,n,i){var r;if(!a)return B;if(typeof a=="string"){var h=a.toLowerCase();j[h]&&(r=h),n&&(j[h]=n,r=h);var m=a.split("-");if(!r&&m.length>1)return p(m[0])}else{var b=a.name;j[b]=a,r=b}return!i&&r&&(B=r),r||!i&&B},k=function(p,a){if(Z(p))return p.clone();var n=typeof a=="object"?a:{};return n.date=p,n.args=arguments,new L(n)},$=He;$.l=P,$.i=Z,$.w=function(p,a){return k(p,{locale:a.$L,utc:a.$u,x:a.$x,$offset:a.$offset})};var L=function(){function p(n){this.$L=P(n.locale,null,!0),this.parse(n),this.$x=this.$x||n.x||{},this[X]=!0}var a=p.prototype;return a.parse=function(n){this.$d=function(i){var r=i.date,h=i.utc;if(r===null)return new Date(NaN);if($.u(r))return new Date;if(r instanceof Date)return new Date(r);if(typeof r=="string"&&!/Z$/i.test(r)){var m=r.match(Ae);if(m){var b=m[2]-1||0,w=(m[7]||"0").substring(0,3);return h?new Date(Date.UTC(m[1],b,m[3]||1,m[4]||0,m[5]||0,m[6]||0,w)):new Date(m[1],b,m[3]||1,m[4]||0,m[5]||0,m[6]||0,w)}}return new Date(r)}(n),this.init()},a.init=function(){var n=this.$d;this.$y=n.getFullYear(),this.$M=n.getMonth(),this.$D=n.getDate(),this.$W=n.getDay(),this.$H=n.getHours(),this.$m=n.getMinutes(),this.$s=n.getSeconds(),this.$ms=n.getMilliseconds()},a.$utils=function(){return $},a.isValid=function(){return this.$d.toString()!==Q},a.isSame=function(n,i){var r=k(n);return this.startOf(i)<=r&&r<=this.endOf(i)},a.isAfter=function(n,i){return k(n)<this.startOf(i)},a.isBefore=function(n,i){return this.endOf(i)<k(n)},a.$g=function(n,i,r){return $.u(n)?this[i]:this.set(r,n)},a.unix=function(){return Math.floor(this.valueOf()/1e3)},a.valueOf=function(){return this.$d.getTime()},a.startOf=function(n,i){var r=this,h=!!$.u(i)||i,m=$.p(n),b=function(A,S){var R=$.w(r.$u?Date.UTC(r.$y,S,A):new Date(r.$y,S,A),r);return h?R:R.endOf(u)},w=function(A,S){return $.w(r.toDate()[A].apply(r.toDate("s"),(h?[0,0,0,0]:[23,59,59,999]).slice(S)),r)},D=this.$W,M=this.$M,O=this.$D,H="set"+(this.$u?"UTC":"");switch(m){case x:return h?b(1,0):b(31,11);case _:return h?b(1,M):b(0,M+1);case y:var T=this.$locale().weekStart||0,W=(D<T?D+7:D)-T;return b(h?O-W:O+(6-W),M);case u:case q:return w(H+"Hours",0);case c:return w(H+"Minutes",1);case f:return w(H+"Seconds",2);case s:return w(H+"Milliseconds",3);default:return this.clone()}},a.endOf=function(n){return this.startOf(n,!1)},a.$set=function(n,i){var r,h=$.p(n),m="set"+(this.$u?"UTC":""),b=(r={},r[u]=m+"Date",r[q]=m+"Date",r[_]=m+"Month",r[x]=m+"FullYear",r[c]=m+"Hours",r[f]=m+"Minutes",r[s]=m+"Seconds",r[d]=m+"Milliseconds",r)[h],w=h===u?this.$D+(i-this.$W):i;if(h===_||h===x){var D=this.clone().set(q,1);D.$d[b](w),D.init(),this.$d=D.set(q,Math.min(this.$D,D.daysInMonth())).$d}else b&&this.$d[b](w);return this.init(),this},a.set=function(n,i){return this.clone().$set(n,i)},a.get=function(n){return this[$.p(n)]()},a.add=function(n,i){var r,h=this;n=Number(n);var m=$.p(i),b=function(M){var O=k(h);return $.w(O.date(O.date()+Math.round(M*n)),h)};if(m===_)return this.set(_,this.$M+n);if(m===x)return this.set(x,this.$y+n);if(m===u)return b(1);if(m===y)return b(7);var w=(r={},r[f]=l,r[c]=v,r[s]=t,r)[m]||1,D=this.$d.getTime()+n*w;return $.w(D,this)},a.subtract=function(n,i){return this.add(-1*n,i)},a.format=function(n){var i=this,r=this.$locale();if(!this.isValid())return r.invalidDate||Q;var h=n||"YYYY-MM-DDTHH:mm:ssZ",m=$.z(this),b=this.$H,w=this.$m,D=this.$M,M=r.weekdays,O=r.months,H=r.meridiem,T=function(S,R,F,I){return S&&(S[R]||S(i,h))||F[R].slice(0,I)},W=function(S){return $.s(b%12||12,S,"0")},A=H||function(S,R,F){var I=S<12?"AM":"PM";return F?I.toLowerCase():I};return h.replace(Ye,function(S,R){return R||function(F){switch(F){case"YY":return String(i.$y).slice(-2);case"YYYY":return $.s(i.$y,4,"0");case"M":return D+1;case"MM":return $.s(D+1,2,"0");case"MMM":return T(r.monthsShort,D,O,3);case"MMMM":return T(O,D);case"D":return i.$D;case"DD":return $.s(i.$D,2,"0");case"d":return String(i.$W);case"dd":return T(r.weekdaysMin,i.$W,M,2);case"ddd":return T(r.weekdaysShort,i.$W,M,3);case"dddd":return M[i.$W];case"H":return String(b);case"HH":return $.s(b,2,"0");case"h":return W(1);case"hh":return W(2);case"a":return A(b,w,!0);case"A":return A(b,w,!1);case"m":return String(w);case"mm":return $.s(w,2,"0");case"s":return String(i.$s);case"ss":return $.s(i.$s,2,"0");case"SSS":return $.s(i.$ms,3,"0");case"Z":return m}return null}(S)||m.replace(":","")})},a.utcOffset=function(){return 15*-Math.round(this.$d.getTimezoneOffset()/15)},a.diff=function(n,i,r){var h,m=this,b=$.p(i),w=k(n),D=(w.utcOffset()-this.utcOffset())*l,M=this-w,O=function(){return $.m(m,w)};switch(b){case x:h=O()/12;break;case _:h=O();break;case K:h=O()/3;break;case y:h=(M-D)/6048e5;break;case u:h=(M-D)/864e5;break;case c:h=M/v;break;case f:h=M/l;break;case s:h=M/t;break;default:h=M}return r?h:$.a(h)},a.daysInMonth=function(){return this.endOf(_).$D},a.$locale=function(){return j[this.$L]},a.locale=function(n,i){if(!n)return this.$L;var r=this.clone(),h=P(n,i,!0);return h&&(r.$L=h),r},a.clone=function(){return $.w(this.$d,this)},a.toDate=function(){return new Date(this.valueOf())},a.toJSON=function(){return this.isValid()?this.toISOString():null},a.toISOString=function(){return this.$d.toISOString()},a.toString=function(){return this.$d.toUTCString()},p}(),ee=L.prototype;return k.prototype=ee,[["$ms",d],["$s",s],["$m",f],["$H",c],["$W",u],["$M",_],["$y",x],["$D",q]].forEach(function(p){ee[p[1]]=function(a){return this.$g(a,p[0],p[1])}}),k.extend=function(p,a){return p.$i||(p(a,L,k),p.$i=!0),k},k.locale=P,k.isDayjs=Z,k.unix=function(p){return k(1e3*p)},k.en=j[B],k.Ls=j,k.p={},k})})(J);var re=J.exports;const C=ne(re);function Y(g,e,t,l,v,d,s,f){var c=typeof g=="function"?g.options:g;return e&&(c.render=e,c.staticRenderFns=t,c._compiled=!0),d&&(c._scopeId="data-v-"+d),{exports:g,options:c}}const ae={__name:"DateRange",props:{label:{type:String,required:!0},value:{type:Object},required:Boolean,disabled:Boolean},emits:["input"],setup(g,{emit:e}){const t=g,l=({start:d,end:s},f)=>{let c=C(d),u=C(s);return f==="start"&&u.isBefore(c)?u=c:f==="end"&&c.isAfter(u)&&(c=u),c=c.hour(0).minute(0).second(0),u=u.hour(23).minute(59).second(59),{start:c.format(),end:u.format()}},v=(d,s)=>{let f;s?f={...t.value,[s]:d}:f=d,f.start&&!f.end&&(f.end=f.start),f=l(f,s),e("input",f)};return E(()=>{var d,s;(d=t.value)!=null&&d.start&&((s=t.value)!=null&&s.end)&&v(t.value)}),{__sfc:!0,props:t,emit:e,validate:l,emitChange:v}}};var se=function(){var v,d;var e=this,t=e._self._c,l=e._self._setupProxy;return t("k-field",e._b({staticClass:"k-daterange-field",attrs:{label:e.label,required:e.required,disabled:e.disabled}},"k-field",l.props,!1),[t("k-grid",{attrs:{variant:"fields"}},[t("k-column",{attrs:{width:"6/12"}},[t("k-date-field",{attrs:{label:"Von",value:(v=e.value)==null?void 0:v.start,type:"date",name:"from",time:!1,default:"now",required:e.required},on:{input:s=>l.emitChange(s,"start")}})],1),t("k-column",{attrs:{width:"6/12"}},[t("k-date-field",{attrs:{label:"Bis",value:(d=e.value)==null?void 0:d.end,type:"date",name:"end",time:!1,default:"now",required:e.required},on:{input:s=>l.emitChange(s,"end")}})],1)],1)],1)},ie=[],ue=Y(ae,se,ie,!1,null,null);const G=ue.exports,oe={__name:"Weekdays",props:{label:{type:String,required:!0},value:Object,isDefault:Boolean,required:Boolean,disabled:Boolean,daterange:Object},emits:["input"],setup(g,{emit:e}){const t=g,l=z([{id:"mo",name:"Montag",isActive:!1},{id:"tu",name:"Dienstag",isActive:!1},{id:"we",name:"Mittwoch",isActive:!1},{id:"th",name:"Donnerstag",isActive:!1},{id:"fr",name:"Freitag",isActive:!1},{id:"sa",name:"Samstag",isActive:!1},{id:"su",name:"Sonntag",isActive:!1}]),v=z(null),d=z(null),s=()=>{if(t.isDefault){l.value.forEach(_=>{_.isActive=!0});return}if(!v.value||!d.value)return;let u=v.value,y=[];for(;(u.isBefore(d.value)||u.isSame(d.value))&&(y.push(u.format("dd").toLowerCase()),u=u.add(1,"day"),!(y.length>=7)););y=[...new Set(y)],l.value.forEach(_=>{_.isActive=y.includes(_.id.toString())})},f=(u,y)=>{const _={...t.value,[u]:y};e("input",_)},c=u=>{u&&(v.value=C(u.start),d.value=C(u.end)),s()};return N(()=>t.daterange,u=>{c(u)},{deep:!0}),N(()=>t.isDefault,u=>{s()}),c(t.daterange),{__sfc:!0,props:t,emit:e,weekdays:l,startDate:v,endDate:d,evaluateWeekdays:s,emitChange:f,onDaterangeChange:c}}};var le=function(){var e=this,t=e._self._c,l=e._self._setupProxy;return t("div",e._l(l.weekdays,function(v){return t("div",{key:v.id},[v.isActive?t("div",[t("k-object-field",{attrs:{label:v.name,fields:{closed:{label:"Geschlossen",name:"closed",type:"toggle",default:!1,saveable:!0,text:["nein","ja"]},timeblock1:{label:"Zeitraum 1",name:"timeblock1",type:"times",saveable:!0,when:{closed:!1}},timeblock2:{label:"Zeitraum 2",name:"timeblock2",type:"times",saveable:!0,when:{closed:!1}}},value:e.value[v.id]?e.value[v.id]:null},on:{input:d=>l.emitChange(v.id,d)}}),t("div",{staticStyle:{height:"20px"}})],1):e._e()])}),0)},ce=[],de=Y(oe,le,ce,!1,null,null);const fe=de.exports,ve={__name:"OpeningHours",props:{value:{type:Object,required:!0}},emits:["input"],setup(g,{emit:e}){const t=g;return{__sfc:!0,props:t,emit:e,emitChange:(v,d)=>{e("input",{...t.value,[v]:d})},DateRange:G,Weekdays:fe}}};var pe=function(){var e=this,t=e._self._c,l=e._self._setupProxy;return t("div",{staticClass:"k-openinghours-field"},[t("k-toggle-field",{attrs:{label:"Standard Öffnungszeiten",value:e.value.default},on:{input:v=>l.emitChange("default",v)}}),e.value.default?e._e():t("k-text-field",{attrs:{label:"Bezeichnung",value:e.value.label},on:{input:v=>l.emitChange("label",v)}}),e.value.default?e._e():t(l.DateRange,{attrs:{label:"Zeitraum",value:e.value.daterange},on:{input:v=>l.emitChange("daterange",v)}}),t(l.Weekdays,{attrs:{label:"Wochentage",value:e.value.weekdays,daterange:e.value.daterange,isDefault:e.value.default},on:{input:v=>l.emitChange("weekdays",v)}})],1)},he=[],me=Y(ve,pe,he,!1,null,"68ca78a5");const _e=me.exports,ge={__name:"TimeRange",props:{label:{type:String,required:!0},value:{type:Object},required:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1}},emits:["input"],setup(g,{emit:e}){const t=g,l=({start:d,end:s},f)=>{if(!d||!s)return{start:d,end:s};const c=d.split(":"),u=s.split(":");let y=C("01.01.2000"),_=C("01.01.2000");return y=y.hour(c[0]),y=y.minute(c[1]),_=_.hour(u[0]),_=_.minute(u[1]),f==="start"&&_.isBefore(y)?_=y:f==="end"&&y.isAfter(_)&&(y=_),{start:y.format("HH:mm:ss"),end:_.format("HH:mm:ss")}},v=(d,s)=>{let f;s?f={...t.value,[s]:d}:f=d,f.start&&!f.end&&(f.end=f.start),f=l(f,s),e("input",f)};return E(()=>{var d,s;(d=t.value)!=null&&d.start&&((s=t.value)!=null&&s.end)&&v(t.value)}),{__sfc:!0,props:t,emit:e,validateRange:l,emitChange:v}}};var $e=function(){var v,d;var e=this,t=e._self._c,l=e._self._setupProxy;return t("k-field",e._b({staticClass:"k-timerange-field",attrs:{label:e.label,required:e.required,disabled:e.disabled}},"k-field",l.props,!1),[t("k-grid",{attrs:{variant:"fields"}},[t("k-column",{attrs:{width:"6/12"}},[t("k-time-field",{attrs:{label:"Von",value:(v=e.value)==null?void 0:v.start,type:"date",name:"from",time:!1,default:"now",required:e.required},on:{input:s=>l.emitChange(s,"start")}})],1),t("k-column",{attrs:{width:"6/12"}},[t("k-time-field",{attrs:{label:"Bis",value:(d=e.value)==null?void 0:d.end,type:"date",name:"end",time:!1,default:"now",required:e.required},on:{input:s=>l.emitChange(s,"end")}})],1)],1)],1)},be=[],ye=Y(ge,$e,be,!1,null,null);const we=ye.exports,ke={__name:"OpeningHoursPreview",props:{value:Object,column:Object,field:Object},setup(g){const e=g,t={mo:"Montag",tu:"Dienstag",we:"Mittwoch",th:"Donnerstag",fr:"Freitag",sa:"Samstag",su:"Sonntag"},l=V(()=>{if(e.value.default)return Object.keys(t);let s=[];const f=C(e.value.daterange.start),c=C(e.value.daterange.end);let u=f;for(;(u.isBefore(c)||u.isSame(c))&&(s.push(u.format("dd").toLowerCase()),u=u.add(1,"day"),!(s.length>=7)););return[...new Set(s)]}),v=V(()=>{const s=[];for(const[y,_]of Object.entries(e.value.weekdays))_&&l.value.includes(y)&&s.push({day:t[y],time:_.closed?"Geschlossen":d(_)});if(e.value.default)return{weekdays:s};const f=e.value.daterange.start?C(e.value.daterange.start):!1,c=e.value.daterange.end?C(e.value.daterange.end):!1,u=f&&c?`${f.format("DD.MM.YYYY")} - ${c.format("DD.MM.YYYY")}`:!1;return{label:e.value.label,daterange:u,weekdays:s}}),d=s=>{const f=[];if(s.timeblock1){const c=s.timeblock1.start,u=s.timeblock1.end;c&&u?f.push(`${c==null?void 0:c.substr(0,c.lastIndexOf(":"))} - ${u.substr(0,u.lastIndexOf(":"))}`):(c||u)&&f.push("Zeitraum 1: Falsche Eingabe")}if(s.timeblock2){const c=s.timeblock2.start,u=s.timeblock2.end;c&&u?f.push(`${c==null?void 0:c.substr(0,c.lastIndexOf(":"))} - ${u.substr(0,u.lastIndexOf(":"))}`):(c||u)&&f.push("Zeitraum 2: Falsche Eingabe")}return f.join(", ")};return{__sfc:!0,props:e,weekdayLabels:t,activeWeekdays:l,preview:v,getTimeString:d}}};var De=function(){var v,d;var e=this,t=e._self._c,l=e._self._setupProxy;return t("div",{staticClass:"k-openinghours-field-preview"},[e.value.default?t("div",[t("strong",[e._v("Standard Öffnungszeiten")])]):e._e(),l.preview.label?t("div",[t("strong",[e._v(e._s(l.preview.label))])]):e._e(),l.preview.daterange?t("div",[l.preview.daterange?t("strong",[e._v(e._s(l.preview.daterange))]):e._e()]):e._e(),t("div",[(d=(v=l.preview)==null?void 0:v.weekdays)!=null&&d.length?t("table",e._l(l.preview.weekdays,function(s){return t("tr",{key:s.day},[t("td",[e._v(e._s(s.day))]),t("td",[e._v(e._s(s.time))])])}),0):t("div",[e._v(" Keine Öffnungszeiten konfiguriert ")])])])},Me=[],Se=Y(ke,De,Me,!1,null,"b2428e8f");const Oe=Se.exports,Ce={__name:"TimeRangePreview",props:{value:Object,column:Object,field:Object},setup(g){const e=g,t=V(()=>{if(!e.value.start||!e.value.end)return"-";const l=e.value.start.split(":"),v=e.value.end.split(":");return`${l[0]}:${l[1]} - ${v[0]}:${v[1]}`});return{__sfc:!0,props:e,preview:t}}};var xe=function(){var e=this,t=e._self._c,l=e._self._setupProxy;return t("div",{staticClass:"k-openinghours-field-preview"},[e._v(" "+e._s(l.preview)+" ")])},Re=[],je=Y(Ce,xe,Re,!1,null,"a5af1238");const Te=je.exports;panel.plugin("zephir/openinghours",{fields:{daterange:G,times:we,openinghours:_e},components:{"k-openinghours-field-preview":Oe,"k-times-field-preview":Te}})})();

!function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:r})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=189)}({189:function(t,e,n){t.exports=n(190)},190:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=n(2),o=n.n(r);window.createLeagueArchives=function(t,e,n,r,i){var a,s,c=(a=o.a.mark(function t(e,n,r){var i,a;return o.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,fetch(e,{headers:{"Content-Type":"application/json",Accept:"application/json, text-plain, */*","X-Requested-With":"XMLHttpRequest","X-CSRF-TOKEN":r},method:"post",credentials:"same-origin",body:JSON.stringify({id:n})});case 2:return i=t.sent,t.next=5,i.json();case 5:return a=t.sent,t.abrupt("return",a);case 7:case"end":return t.stop()}},t,this)}),s=function(){var t=a.apply(this,arguments);return new Promise(function(e,n){return function r(o,i){try{var a=t[o](i),s=a.value}catch(t){return void n(t)}if(!a.done)return Promise.resolve(s).then(function(t){r("next",t)},function(t){r("throw",t)});e(s)}("next")})},function(t,e,n){return s.apply(this,arguments)}),l=document.querySelectorAll("ul.tabs li"),u=document.querySelector('meta[name="csrf-token"]').getAttribute("content");if(null!==e){t&&t>5&&$(function(){$("#table-"+e).paginathing({perPage:5,insertAfter:"#pag-"+e,prevText:"&lt;",nextText:"&gt;",firstText:"&laquo;",lastText:"&raquo;"})});for(var p=0;p<l.length;p++)l[p].addEventListener("click",function(t){var e=t.target.getAttribute("data-tab"),r=document.getElementById(e),o=e.substring(4);document.querySelector("li.tabs__link-current").classList.remove("tabs__link-current"),document.querySelector("div.tabs__content-current").classList.remove("tabs__content-current"),t.target.classList.add("tabs__link-current"),r.classList.add("tabs__content-current"),r.classList.contains("not-loaded")&&(f(o,u,r,n),r.classList.remove("not-loaded"))},!1)}function f(t,e,n,r){h(n),c(r,t,e).then(function(e){d(e,n),e.length>5&&$(function(){$("#table-"+t).paginathing({perPage:5,insertAfter:"#pag-"+t,prevText:"&lt;",nextText:"&gt;",firstText:"&laquo;",lastText:"&raquo;"})}),v(n)})}var h=function(t){t.insertAdjacentHTML("afterbegin",'\n            <div class="loader"></div>\n        ')},v=function(t){var e=t.querySelector(".loader");e&&e.parentElement.removeChild(e)},d=function(t,e){var n=t[0].start_season.substring(0,10).split("-"),r='\n            <div class="archives__content archives__content-league archives__paginate" id="paginate-'+n[0]+'">\n                <div class="archives__tables archives__tables-league" id="table-'+n[0]+'"> \n        ';t.forEach(function(t){r+=g(t,e)}),r+="\n                </div>\n            </div>\n        ",e.insertAdjacentHTML("afterbegin",r);var o='\n            <div id="tab-'+n[0]+'" class="tabs__content tabs__not-loaded tab-content not-loaded">\n            </div>\n        ';e.insertAdjacentHTML("afterbegin",o)},g=function(t,e){var n=t.start_season.substring(0,10).split("-"),o=new Date(n[0],parseInt(n[1])-1,n[2]).toLocaleString("fr-FR",{weekday:"long",year:"numeric",month:"long",day:"numeric"});o=o.charAt(0).toUpperCase()+o.slice(1);var i='\n            <div class="archives__row archives__row-league">\n                <div class="event__single-information">\n                    <h2 class="heading-2--event-title">'+t.day_of_week+'</h2>\n                    <p class="event__single-paragraphe">'+t.name+'</p>\n                    <p class="event__single-paragraphe">'+(t.is_accredited?"Homologué":"Non homologué")+'</p>\n                    <p class="event__single-paragraphe">'+t.place+'</p>\n                </div>\n                <div class="event__single-members event__league-name event__single-members-league">\n                    <p class="event__single-paragraphe">'+t.team_name+"</p>\n                </div>\n        ";return i+='\n            <div class="event__single-members event__single-members-league event__members-league">\n        ',void 0!==t.members&&t.members.length>0&&t.members.forEach(function(t){i+=_(t)}),i+="\n            </div>\n        ",void 0!==t.result?i+='\n                <div class="event__single-image">\n                    <a class="event__single-link" href="'+t.result+'" target="_blank">\n                        <img class="event__single-logo" src="'+r+'/tournament/Lexer.jpg" alt="Image du lien">\n                    </a>\n                </div>\n            ':i+='\n                <div class="event__single-image event__single-image--disable">\n                    <div class="event__cell--disable">\n                        <img class="event__single-logo" src="'+r+'/tournament/Lexer.jpg" alt="Lien lexer du résultat">\n                    </div>\n                </div>\n            ',i+="\n            </div>\n        "},_=function(t){var e=i,n=null;void 0!==t.birth_date&&t.birth_date&&(n=moment(t.birth_date).fromNow(!0))>=100&&(n=null);var o="";return o+='\n        <div class="event__noteam-line">\n            <div class="event__tooltip tooltip-occasion '+("Licencié"==t.is_licensee?"event__tooltip-licensee":"event__tooltip-adherent")+'">\n                <p class="event__noteam-paragraph '+(1!=t.club_id?"otherClub":"")+'">'+t.last_name+" "+t.first_name+'</p>\n                <div class="event__tooltip-event tooltiptext-occasion '+("Licencié"==t.is_licensee?"event__tooltip-event-licensee":"event__tooltip-event-adherent")+'">\n                    <img class="event__tooltipimg full-size-img" src="'+(t.picture.length>0?e+"/"+t.picture[0].path:r+"/blank-profile.png")+'" alt="Photo de '+t.last_name+" - "+t.first_name+'">\n                    <div class="event__tooltipcontent tooltipcontent">\n                        <p class="event__tooltiptext">'+t.last_name+" "+t.first_name+" "+(n?" - "+n+"ans":"")+' </p>\n                        <p class="event__tooltiptext">'+t.club.name+"</p>\n        ","Licencié"===t.is_licensee?o+='\n                        <p class="event__tooltiptext">Licence : '+(t.id_licensee?t.id_licensee:"")+'</p>\n                        <p class="event__tooltiptext">'+t.category.title+'</p>\n                        <p class="event__tooltiptext">Moyenne : '+(t.score&&t.score.average?t.score.average:"Pas d'enregistrement")+'</p>\n                        <p class="event__tooltiptext">Handicap : '+t.handicap+'</p>\n                        <p class="event__tooltiptext">Bonus vétéran : '+t.bonus+"</p>\n            ":o+='\n                        <p class="event__tooltiptext">'+t.is_licensee+"</p>\n            ",o+="\n                    </div>\n                </div>\n            </div>\n        </div>\n        "}}},2:function(t,e,n){t.exports=n(3)},3:function(t,e,n){var r=function(){return this}()||Function("return this")(),o=r.regeneratorRuntime&&Object.getOwnPropertyNames(r).indexOf("regeneratorRuntime")>=0,i=o&&r.regeneratorRuntime;if(r.regeneratorRuntime=void 0,t.exports=n(4),o)r.regeneratorRuntime=i;else try{delete r.regeneratorRuntime}catch(t){r.regeneratorRuntime=void 0}},4:function(t,e){!function(e){"use strict";var n,r=Object.prototype,o=r.hasOwnProperty,i="function"==typeof Symbol?Symbol:{},a=i.iterator||"@@iterator",s=i.asyncIterator||"@@asyncIterator",c=i.toStringTag||"@@toStringTag",l="object"==typeof t,u=e.regeneratorRuntime;if(u)l&&(t.exports=u);else{(u=e.regeneratorRuntime=l?t.exports:{}).wrap=b;var p="suspendedStart",f="suspendedYield",h="executing",v="completed",d={},g={};g[a]=function(){return this};var _=Object.getPrototypeOf,m=_&&_(_(A([])));m&&m!==r&&o.call(m,a)&&(g=m);var y=E.prototype=w.prototype=Object.create(g);L.prototype=y.constructor=E,E.constructor=L,E[c]=L.displayName="GeneratorFunction",u.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===L||"GeneratorFunction"===(e.displayName||e.name))},u.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,E):(t.__proto__=E,c in t||(t[c]="GeneratorFunction")),t.prototype=Object.create(y),t},u.awrap=function(t){return{__await:t}},j(O.prototype),O.prototype[s]=function(){return this},u.AsyncIterator=O,u.async=function(t,e,n,r){var o=new O(b(t,e,n,r));return u.isGeneratorFunction(e)?o:o.next().then(function(t){return t.done?t.value:o.next()})},j(y),y[c]="Generator",y[a]=function(){return this},y.toString=function(){return"[object Generator]"},u.keys=function(t){var e=[];for(var n in t)e.push(n);return e.reverse(),function n(){for(;e.length;){var r=e.pop();if(r in t)return n.value=r,n.done=!1,n}return n.done=!0,n}},u.values=A,S.prototype={constructor:S,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=n,this.done=!1,this.delegate=null,this.method="next",this.arg=n,this.tryEntries.forEach(P),!t)for(var e in this)"t"===e.charAt(0)&&o.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=n)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function r(r,o){return s.type="throw",s.arg=t,e.next=r,o&&(e.method="next",e.arg=n),!!o}for(var i=this.tryEntries.length-1;i>=0;--i){var a=this.tryEntries[i],s=a.completion;if("root"===a.tryLoc)return r("end");if(a.tryLoc<=this.prev){var c=o.call(a,"catchLoc"),l=o.call(a,"finallyLoc");if(c&&l){if(this.prev<a.catchLoc)return r(a.catchLoc,!0);if(this.prev<a.finallyLoc)return r(a.finallyLoc)}else if(c){if(this.prev<a.catchLoc)return r(a.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return r(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var r=this.tryEntries[n];if(r.tryLoc<=this.prev&&o.call(r,"finallyLoc")&&this.prev<r.finallyLoc){var i=r;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,d):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),d},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.finallyLoc===t)return this.complete(n.completion,n.afterLoc),P(n),d}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.tryLoc===t){var r=n.completion;if("throw"===r.type){var o=r.arg;P(n)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:A(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=n),d}}}function b(t,e,n,r){var o=e&&e.prototype instanceof w?e:w,i=Object.create(o.prototype),a=new S(r||[]);return i._invoke=function(t,e,n){var r=p;return function(o,i){if(r===h)throw new Error("Generator is already running");if(r===v){if("throw"===o)throw i;return N()}for(n.method=o,n.arg=i;;){var a=n.delegate;if(a){var s=k(a,n);if(s){if(s===d)continue;return s}}if("next"===n.method)n.sent=n._sent=n.arg;else if("throw"===n.method){if(r===p)throw r=v,n.arg;n.dispatchException(n.arg)}else"return"===n.method&&n.abrupt("return",n.arg);r=h;var c=x(t,e,n);if("normal"===c.type){if(r=n.done?v:f,c.arg===d)continue;return{value:c.arg,done:n.done}}"throw"===c.type&&(r=v,n.method="throw",n.arg=c.arg)}}}(t,n,a),i}function x(t,e,n){try{return{type:"normal",arg:t.call(e,n)}}catch(t){return{type:"throw",arg:t}}}function w(){}function L(){}function E(){}function j(t){["next","throw","return"].forEach(function(e){t[e]=function(t){return this._invoke(e,t)}})}function O(t){var e;this._invoke=function(n,r){function i(){return new Promise(function(e,i){!function e(n,r,i,a){var s=x(t[n],t,r);if("throw"!==s.type){var c=s.arg,l=c.value;return l&&"object"==typeof l&&o.call(l,"__await")?Promise.resolve(l.__await).then(function(t){e("next",t,i,a)},function(t){e("throw",t,i,a)}):Promise.resolve(l).then(function(t){c.value=t,i(c)},a)}a(s.arg)}(n,r,e,i)})}return e=e?e.then(i,i):i()}}function k(t,e){var r=t.iterator[e.method];if(r===n){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=n,k(t,e),"throw"===e.method))return d;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return d}var o=x(r,t.iterator,e.arg);if("throw"===o.type)return e.method="throw",e.arg=o.arg,e.delegate=null,d;var i=o.arg;return i?i.done?(e[t.resultName]=i.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=n),e.delegate=null,d):i:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,d)}function T(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function P(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function S(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(T,this),this.reset(!0)}function A(t){if(t){var e=t[a];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var r=-1,i=function e(){for(;++r<t.length;)if(o.call(t,r))return e.value=t[r],e.done=!1,e;return e.value=n,e.done=!0,e};return i.next=i}}return{next:N}}function N(){return{value:n,done:!0}}}(function(){return this}()||Function("return this")())}});
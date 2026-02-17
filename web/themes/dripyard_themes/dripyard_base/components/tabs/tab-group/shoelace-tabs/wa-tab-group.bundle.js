/*! For license information please see wa-tab-group.bundle.js.LICENSE.txt */

(()=>{"use strict";const t=globalThis,e=t.ShadowRoot&&(void 0===t.ShadyCSS||t.ShadyCSS.nativeShadow)&&"adoptedStyleSheets"in Document.prototype&&"replace"in CSSStyleSheet.prototype,s=Symbol(),o=new WeakMap;class i{constructor(t,e,o){if(this._$cssResult$=!0,o!==s)throw Error("CSSResult is not constructable. Use `unsafeCSS` or `css` instead.");this.cssText=t,this.t=e}get styleSheet(){let t=this.o;const s=this.t;if(e&&void 0===t){const e=void 0!==s&&1===s.length;e&&(t=o.get(s)),void 0===t&&((this.o=t=new CSSStyleSheet).replaceSync(this.cssText),e&&o.set(s,t))}return t}toString(){return this.cssText}}const r=(t,...e)=>{const o=1===t.length?t[0]:e.reduce(((e,s,o)=>e+(t=>{if(!0===t._$cssResult$)return t.cssText;if("number"==typeof t)return t;throw Error("Value passed to 'css' function must be a 'css' function result: "+t+". Use 'unsafeCSS' to pass non-literal values, but take care to ensure page security.")})(s)+t[o+1]),t[0]);return new i(o,t,s)},n=(s,o)=>{if(e)s.adoptedStyleSheets=o.map((t=>t instanceof CSSStyleSheet?t:t.styleSheet));else for(const e of o){const o=document.createElement("style"),i=t.litNonce;void 0!==i&&o.setAttribute("nonce",i),o.textContent=e.cssText,s.appendChild(o)}},a=e?t=>t:t=>t instanceof CSSStyleSheet?(t=>{let e="";for(const s of t.cssRules)e+=s.cssText;return(t=>new i("string"==typeof t?t:t+"",void 0,s))(e)})(t):t,{is:l,defineProperty:c,getOwnPropertyDescriptor:h,getOwnPropertyNames:d,getOwnPropertySymbols:p,getPrototypeOf:u}=Object,b=globalThis,v=b.trustedTypes,g=v?v.emptyScript:"",f=b.reactiveElementPolyfillSupport,m=(t,e)=>t,y={toAttribute(t,e){switch(e){case Boolean:t=t?g:null;break;case Object:case Array:t=null==t?t:JSON.stringify(t)}return t},fromAttribute(t,e){let s=t;switch(e){case Boolean:s=null!==t;break;case Number:s=null===t?null:Number(t);break;case Object:case Array:try{s=JSON.parse(t)}catch(t){s=null}}return s}},_=(t,e)=>!l(t,e),w={attribute:!0,type:String,converter:y,reflect:!1,hasChanged:_};Symbol.metadata??=Symbol("metadata"),b.litPropertyMetadata??=new WeakMap;class $ extends HTMLElement{static addInitializer(t){this._$Ei(),(this.l??=[]).push(t)}static get observedAttributes(){return this.finalize(),this._$Eh&&[...this._$Eh.keys()]}static createProperty(t,e=w){if(e.state&&(e.attribute=!1),this._$Ei(),this.elementProperties.set(t,e),!e.noAccessor){const s=Symbol(),o=this.getPropertyDescriptor(t,s,e);void 0!==o&&c(this.prototype,t,o)}}static getPropertyDescriptor(t,e,s){const{get:o,set:i}=h(this.prototype,t)??{get(){return this[e]},set(t){this[e]=t}};return{get(){return o?.call(this)},set(e){const r=o?.call(this);i.call(this,e),this.requestUpdate(t,r,s)},configurable:!0,enumerable:!0}}static getPropertyOptions(t){return this.elementProperties.get(t)??w}static _$Ei(){if(this.hasOwnProperty(m("elementProperties")))return;const t=u(this);t.finalize(),void 0!==t.l&&(this.l=[...t.l]),this.elementProperties=new Map(t.elementProperties)}static finalize(){if(this.hasOwnProperty(m("finalized")))return;if(this.finalized=!0,this._$Ei(),this.hasOwnProperty(m("properties"))){const t=this.properties,e=[...d(t),...p(t)];for(const s of e)this.createProperty(s,t[s])}const t=this[Symbol.metadata];if(null!==t){const e=litPropertyMetadata.get(t);if(void 0!==e)for(const[t,s]of e)this.elementProperties.set(t,s)}this._$Eh=new Map;for(const[t,e]of this.elementProperties){const s=this._$Eu(t,e);void 0!==s&&this._$Eh.set(s,t)}this.elementStyles=this.finalizeStyles(this.styles)}static finalizeStyles(t){const e=[];if(Array.isArray(t)){const s=new Set(t.flat(1/0).reverse());for(const t of s)e.unshift(a(t))}else void 0!==t&&e.push(a(t));return e}static _$Eu(t,e){const s=e.attribute;return!1===s?void 0:"string"==typeof s?s:"string"==typeof t?t.toLowerCase():void 0}constructor(){super(),this._$Ep=void 0,this.isUpdatePending=!1,this.hasUpdated=!1,this._$Em=null,this._$Ev()}_$Ev(){this._$ES=new Promise((t=>this.enableUpdating=t)),this._$AL=new Map,this._$E_(),this.requestUpdate(),this.constructor.l?.forEach((t=>t(this)))}addController(t){(this._$EO??=new Set).add(t),void 0!==this.renderRoot&&this.isConnected&&t.hostConnected?.()}removeController(t){this._$EO?.delete(t)}_$E_(){const t=new Map,e=this.constructor.elementProperties;for(const s of e.keys())this.hasOwnProperty(s)&&(t.set(s,this[s]),delete this[s]);t.size>0&&(this._$Ep=t)}createRenderRoot(){const t=this.shadowRoot??this.attachShadow(this.constructor.shadowRootOptions);return n(t,this.constructor.elementStyles),t}connectedCallback(){this.renderRoot??=this.createRenderRoot(),this.enableUpdating(!0),this._$EO?.forEach((t=>t.hostConnected?.()))}enableUpdating(t){}disconnectedCallback(){this._$EO?.forEach((t=>t.hostDisconnected?.()))}attributeChangedCallback(t,e,s){this._$AK(t,s)}_$EC(t,e){const s=this.constructor.elementProperties.get(t),o=this.constructor._$Eu(t,s);if(void 0!==o&&!0===s.reflect){const i=(void 0!==s.converter?.toAttribute?s.converter:y).toAttribute(e,s.type);this._$Em=t,null==i?this.removeAttribute(o):this.setAttribute(o,i),this._$Em=null}}_$AK(t,e){const s=this.constructor,o=s._$Eh.get(t);if(void 0!==o&&this._$Em!==o){const t=s.getPropertyOptions(o),i="function"==typeof t.converter?{fromAttribute:t.converter}:void 0!==t.converter?.fromAttribute?t.converter:y;this._$Em=o,this[o]=i.fromAttribute(e,t.type),this._$Em=null}}requestUpdate(t,e,s){if(void 0!==t){if(s??=this.constructor.getPropertyOptions(t),!(s.hasChanged??_)(this[t],e))return;this.P(t,e,s)}!1===this.isUpdatePending&&(this._$ES=this._$ET())}P(t,e,s){this._$AL.has(t)||this._$AL.set(t,e),!0===s.reflect&&this._$Em!==t&&(this._$Ej??=new Set).add(t)}async _$ET(){this.isUpdatePending=!0;try{await this._$ES}catch(t){Promise.reject(t)}const t=this.scheduleUpdate();return null!=t&&await t,!this.isUpdatePending}scheduleUpdate(){return this.performUpdate()}performUpdate(){if(!this.isUpdatePending)return;if(!this.hasUpdated){if(this.renderRoot??=this.createRenderRoot(),this._$Ep){for(const[t,e]of this._$Ep)this[t]=e;this._$Ep=void 0}const t=this.constructor.elementProperties;if(t.size>0)for(const[e,s]of t)!0!==s.wrapped||this._$AL.has(e)||void 0===this[e]||this.P(e,this[e],s)}let t=!1;const e=this._$AL;try{t=this.shouldUpdate(e),t?(this.willUpdate(e),this._$EO?.forEach((t=>t.hostUpdate?.())),this.update(e)):this._$EU()}catch(e){throw t=!1,this._$EU(),e}t&&this._$AE(e)}willUpdate(t){}_$AE(t){this._$EO?.forEach((t=>t.hostUpdated?.())),this.hasUpdated||(this.hasUpdated=!0,this.firstUpdated(t)),this.updated(t)}_$EU(){this._$AL=new Map,this.isUpdatePending=!1}get updateComplete(){return this.getUpdateComplete()}getUpdateComplete(){return this._$ES}shouldUpdate(t){return!0}update(t){this._$Ej&&=this._$Ej.forEach((t=>this._$EC(t,this[t]))),this._$EU()}updated(t){}firstUpdated(t){}}$.elementStyles=[],$.shadowRootOptions={mode:"open"},$[m("elementProperties")]=new Map,$[m("finalized")]=new Map,f?.({ReactiveElement:$}),(b.reactiveElementVersions??=[]).push("2.0.4");const A=globalThis,C=A.trustedTypes,S=C?C.createPolicy("lit-html",{createHTML:t=>t}):void 0,x="$lit$",E=`lit$${Math.random().toFixed(9).slice(2)}$`,k="?"+E,T=`<${k}>`,z=document,O=()=>z.createComment(""),P=t=>null===t||"object"!=typeof t&&"function"!=typeof t,L=Array.isArray,M=t=>L(t)||"function"==typeof t?.[Symbol.iterator],U="[ \t\n\f\r]",H=/<(?:(!--|\/[^a-zA-Z])|(\/?[a-zA-Z][^>\s]*)|(\/?$))/g,B=/-->/g,N=/>/g,R=RegExp(`>|${U}(?:([^\\s"'>=/]+)(${U}*=${U}*(?:[^ \t\n\f\r"'\`<>=]|("|')|))|$)`,"g"),I=/'/g,j=/"/g,D=/^(?:script|style|textarea|title)$/i,F=t=>(e,...s)=>({_$litType$:t,strings:e,values:s}),W=F(1),V=F(2),q=F(3),Z=Symbol.for("lit-noChange"),K=Symbol.for("lit-nothing"),G=new WeakMap,J=z.createTreeWalker(z,129);function Q(t,e){if(!L(t)||!t.hasOwnProperty("raw"))throw Error("invalid template strings array");return void 0!==S?S.createHTML(e):e}const X=(t,e)=>{const s=t.length-1,o=[];let i,r=2===e?"<svg>":3===e?"<math>":"",n=H;for(let e=0;e<s;e++){const s=t[e];let a,l,c=-1,h=0;for(;h<s.length&&(n.lastIndex=h,l=n.exec(s),null!==l);)h=n.lastIndex,n===H?"!--"===l[1]?n=B:void 0!==l[1]?n=N:void 0!==l[2]?(D.test(l[2])&&(i=RegExp("</"+l[2],"g")),n=R):void 0!==l[3]&&(n=R):n===R?">"===l[0]?(n=i??H,c=-1):void 0===l[1]?c=-2:(c=n.lastIndex-l[2].length,a=l[1],n=void 0===l[3]?R:'"'===l[3]?j:I):n===j||n===I?n=R:n===B||n===N?n=H:(n=R,i=void 0);const d=n===R&&t[e+1].startsWith("/>")?" ":"";r+=n===H?s+T:c>=0?(o.push(a),s.slice(0,c)+x+s.slice(c)+E+d):s+E+(-2===c?e:d)}return[Q(t,r+(t[s]||"<?>")+(2===e?"</svg>":3===e?"</math>":"")),o]};class Y{constructor({strings:t,_$litType$:e},s){let o;this.parts=[];let i=0,r=0;const n=t.length-1,a=this.parts,[l,c]=X(t,e);if(this.el=Y.createElement(l,s),J.currentNode=this.el.content,2===e||3===e){const t=this.el.content.firstChild;t.replaceWith(...t.childNodes)}for(;null!==(o=J.nextNode())&&a.length<n;){if(1===o.nodeType){if(o.hasAttributes())for(const t of o.getAttributeNames())if(t.endsWith(x)){const e=c[r++],s=o.getAttribute(t).split(E),n=/([.?@])?(.*)/.exec(e);a.push({type:1,index:i,name:n[2],strings:s,ctor:"."===n[1]?it:"?"===n[1]?rt:"@"===n[1]?nt:ot}),o.removeAttribute(t)}else t.startsWith(E)&&(a.push({type:6,index:i}),o.removeAttribute(t));if(D.test(o.tagName)){const t=o.textContent.split(E),e=t.length-1;if(e>0){o.textContent=C?C.emptyScript:"";for(let s=0;s<e;s++)o.append(t[s],O()),J.nextNode(),a.push({type:2,index:++i});o.append(t[e],O())}}}else if(8===o.nodeType)if(o.data===k)a.push({type:2,index:i});else{let t=-1;for(;-1!==(t=o.data.indexOf(E,t+1));)a.push({type:7,index:i}),t+=E.length-1}i++}}static createElement(t,e){const s=z.createElement("template");return s.innerHTML=t,s}}function tt(t,e,s=t,o){if(e===Z)return e;let i=void 0!==o?s._$Co?.[o]:s._$Cl;const r=P(e)?void 0:e._$litDirective$;return i?.constructor!==r&&(i?._$AO?.(!1),void 0===r?i=void 0:(i=new r(t),i._$AT(t,s,o)),void 0!==o?(s._$Co??=[])[o]=i:s._$Cl=i),void 0!==i&&(e=tt(t,i._$AS(t,e.values),i,o)),e}class et{constructor(t,e){this._$AV=[],this._$AN=void 0,this._$AD=t,this._$AM=e}get parentNode(){return this._$AM.parentNode}get _$AU(){return this._$AM._$AU}u(t){const{el:{content:e},parts:s}=this._$AD,o=(t?.creationScope??z).importNode(e,!0);J.currentNode=o;let i=J.nextNode(),r=0,n=0,a=s[0];for(;void 0!==a;){if(r===a.index){let e;2===a.type?e=new st(i,i.nextSibling,this,t):1===a.type?e=new a.ctor(i,a.name,a.strings,this,t):6===a.type&&(e=new at(i,this,t)),this._$AV.push(e),a=s[++n]}r!==a?.index&&(i=J.nextNode(),r++)}return J.currentNode=z,o}p(t){let e=0;for(const s of this._$AV)void 0!==s&&(void 0!==s.strings?(s._$AI(t,s,e),e+=s.strings.length-2):s._$AI(t[e])),e++}}class st{get _$AU(){return this._$AM?._$AU??this._$Cv}constructor(t,e,s,o){this.type=2,this._$AH=K,this._$AN=void 0,this._$AA=t,this._$AB=e,this._$AM=s,this.options=o,this._$Cv=o?.isConnected??!0}get parentNode(){let t=this._$AA.parentNode;const e=this._$AM;return void 0!==e&&11===t?.nodeType&&(t=e.parentNode),t}get startNode(){return this._$AA}get endNode(){return this._$AB}_$AI(t,e=this){t=tt(this,t,e),P(t)?t===K||null==t||""===t?(this._$AH!==K&&this._$AR(),this._$AH=K):t!==this._$AH&&t!==Z&&this._(t):void 0!==t._$litType$?this.$(t):void 0!==t.nodeType?this.T(t):M(t)?this.k(t):this._(t)}O(t){return this._$AA.parentNode.insertBefore(t,this._$AB)}T(t){this._$AH!==t&&(this._$AR(),this._$AH=this.O(t))}_(t){this._$AH!==K&&P(this._$AH)?this._$AA.nextSibling.data=t:this.T(z.createTextNode(t)),this._$AH=t}$(t){const{values:e,_$litType$:s}=t,o="number"==typeof s?this._$AC(t):(void 0===s.el&&(s.el=Y.createElement(Q(s.h,s.h[0]),this.options)),s);if(this._$AH?._$AD===o)this._$AH.p(e);else{const t=new et(o,this),s=t.u(this.options);t.p(e),this.T(s),this._$AH=t}}_$AC(t){let e=G.get(t.strings);return void 0===e&&G.set(t.strings,e=new Y(t)),e}k(t){L(this._$AH)||(this._$AH=[],this._$AR());const e=this._$AH;let s,o=0;for(const i of t)o===e.length?e.push(s=new st(this.O(O()),this.O(O()),this,this.options)):s=e[o],s._$AI(i),o++;o<e.length&&(this._$AR(s&&s._$AB.nextSibling,o),e.length=o)}_$AR(t=this._$AA.nextSibling,e){for(this._$AP?.(!1,!0,e);t&&t!==this._$AB;){const e=t.nextSibling;t.remove(),t=e}}setConnected(t){void 0===this._$AM&&(this._$Cv=t,this._$AP?.(t))}}class ot{get tagName(){return this.element.tagName}get _$AU(){return this._$AM._$AU}constructor(t,e,s,o,i){this.type=1,this._$AH=K,this._$AN=void 0,this.element=t,this.name=e,this._$AM=o,this.options=i,s.length>2||""!==s[0]||""!==s[1]?(this._$AH=Array(s.length-1).fill(new String),this.strings=s):this._$AH=K}_$AI(t,e=this,s,o){const i=this.strings;let r=!1;if(void 0===i)t=tt(this,t,e,0),r=!P(t)||t!==this._$AH&&t!==Z,r&&(this._$AH=t);else{const o=t;let n,a;for(t=i[0],n=0;n<i.length-1;n++)a=tt(this,o[s+n],e,n),a===Z&&(a=this._$AH[n]),r||=!P(a)||a!==this._$AH[n],a===K?t=K:t!==K&&(t+=(a??"")+i[n+1]),this._$AH[n]=a}r&&!o&&this.j(t)}j(t){t===K?this.element.removeAttribute(this.name):this.element.setAttribute(this.name,t??"")}}class it extends ot{constructor(){super(...arguments),this.type=3}j(t){this.element[this.name]=t===K?void 0:t}}class rt extends ot{constructor(){super(...arguments),this.type=4}j(t){this.element.toggleAttribute(this.name,!!t&&t!==K)}}class nt extends ot{constructor(t,e,s,o,i){super(t,e,s,o,i),this.type=5}_$AI(t,e=this){if((t=tt(this,t,e,0)??K)===Z)return;const s=this._$AH,o=t===K&&s!==K||t.capture!==s.capture||t.once!==s.once||t.passive!==s.passive,i=t!==K&&(s===K||o);o&&this.element.removeEventListener(this.name,this,s),i&&this.element.addEventListener(this.name,this,t),this._$AH=t}handleEvent(t){"function"==typeof this._$AH?this._$AH.call(this.options?.host??this.element,t):this._$AH.handleEvent(t)}}class at{constructor(t,e,s){this.element=t,this.type=6,this._$AN=void 0,this._$AM=e,this.options=s}get _$AU(){return this._$AM._$AU}_$AI(t){tt(this,t)}}const lt={M:x,P:E,A:k,C:1,L:X,R:et,D:M,V:tt,I:st,H:ot,N:rt,U:nt,B:it,F:at},ct=A.litHtmlPolyfillSupport;ct?.(Y,st),(A.litHtmlVersions??=[]).push("3.2.1");class ht extends ${constructor(){super(...arguments),this.renderOptions={host:this},this._$Do=void 0}createRenderRoot(){const t=super.createRenderRoot();return this.renderOptions.renderBefore??=t.firstChild,t}update(t){const e=this.render();this.hasUpdated||(this.renderOptions.isConnected=this.isConnected),super.update(t),this._$Do=((t,e,s)=>{const o=s?.renderBefore??e;let i=o._$litPart$;if(void 0===i){const t=s?.renderBefore??null;o._$litPart$=i=new st(e.insertBefore(O(),t),t,void 0,s??{})}return i._$AI(t),i})(e,this.renderRoot,this.renderOptions)}connectedCallback(){super.connectedCallback(),this._$Do?.setConnected(!0)}disconnectedCallback(){super.disconnectedCallback(),this._$Do?.setConnected(!1)}render(){return Z}}ht._$litElement$=!0,ht.finalized=!0,globalThis.litElementHydrateSupport?.({LitElement:ht});const dt=globalThis.litElementPolyfillSupport;dt?.({LitElement:ht}),(globalThis.litElementVersions??=[]).push("4.1.1");var pt=r`
  :host {
    display: inline-block;
  }

  .tab {
    display: inline-flex;
    align-items: center;
    font-family: var(--sl-font-sans);
    font-size: var(--sl-font-size-small);
    font-weight: var(--sl-font-weight-semibold);
    border-radius: var(--sl-border-radius-medium);
    color: var(--sl-color-neutral-600);
    padding: var(--sl-spacing-medium) var(--sl-spacing-large);
    white-space: nowrap;
    user-select: none;
    -webkit-user-select: none;
    cursor: pointer;
    transition:
      var(--transition-speed) box-shadow,
      var(--transition-speed) color;
  }

  .tab:hover:not(.tab--disabled) {
    color: var(--sl-color-primary-600);
  }

  :host(:focus) {
    outline: transparent;
  }

  :host(:focus-visible) {
    color: var(--sl-color-primary-600);
    outline: var(--sl-focus-ring);
    outline-offset: calc(-1 * var(--sl-focus-ring-width) - var(--sl-focus-ring-offset));
  }

  .tab.tab--active:not(.tab--disabled) {
    color: var(--sl-color-primary-600);
  }

  .tab.tab--closable {
    padding-inline-end: var(--sl-spacing-small);
  }

  .tab.tab--disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  .tab__close-button {
    font-size: var(--sl-font-size-small);
    margin-inline-start: var(--sl-spacing-small);
  }

  .tab__close-button::part(base) {
    padding: var(--sl-spacing-3x-small);
  }

  @media (forced-colors: active) {
    .tab.tab--active:not(.tab--disabled) {
      outline: solid 1px transparent;
      outline-offset: -3px;
    }
  }
`,ut=r`
  :host {
    display: inline-block;
    color: var(--sl-color-neutral-600);
  }

  .icon-button {
    flex: 0 0 auto;
    display: flex;
    align-items: center;
    background: none;
    border: none;
    border-radius: var(--sl-border-radius-medium);
    font-size: inherit;
    color: inherit;
    padding: var(--sl-spacing-x-small);
    cursor: pointer;
    transition: var(--sl-transition-x-fast) color;
    -webkit-appearance: none;
  }

  .icon-button:hover:not(.icon-button--disabled),
  .icon-button:focus-visible:not(.icon-button--disabled) {
    color: var(--sl-color-primary-600);
  }

  .icon-button:active:not(.icon-button--disabled) {
    color: var(--sl-color-primary-700);
  }

  .icon-button:focus {
    outline: none;
  }

  .icon-button--disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  .icon-button:focus-visible {
    outline: var(--sl-focus-ring);
    outline-offset: var(--sl-focus-ring-offset);
  }

  .icon-button__icon {
    pointer-events: none;
  }
`,bt="";function vt(t){bt=t}var gt={name:"default",resolver:t=>function(t=""){if(!bt){const t=[...document.getElementsByTagName("script")],e=t.find((t=>t.hasAttribute("data-shoelace")));if(e)vt(e.getAttribute("data-shoelace"));else{const e=t.find((t=>/shoelace(\.min)?\.js($|\?)/.test(t.src)||/shoelace-autoloader(\.min)?\.js($|\?)/.test(t.src)));let s="";e&&(s=e.getAttribute("src")),vt(s.split("/").slice(0,-1).join("/"))}}return bt.replace(/\/$/,"")+(t?`/${t.replace(/^\//,"")}`:"")}(`assets/icons/${t}.svg`)},ft={caret:'\n    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n      <polyline points="6 9 12 15 18 9"></polyline>\n    </svg>\n  ',check:'\n    <svg part="checked-icon" class="checkbox__icon" viewBox="0 0 16 16">\n      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round">\n        <g stroke="currentColor">\n          <g transform="translate(3.428571, 3.428571)">\n            <path d="M0,5.71428571 L3.42857143,9.14285714"></path>\n            <path d="M9.14285714,0 L3.42857143,9.14285714"></path>\n          </g>\n        </g>\n      </g>\n    </svg>\n  ',"chevron-down":'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">\n      <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>\n    </svg>\n  ',"chevron-left":'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">\n      <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>\n    </svg>\n  ',"chevron-right":'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">\n      <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>\n    </svg>\n  ',copy:'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">\n      <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6ZM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1H2Z"/>\n    </svg>\n  ',eye:'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">\n      <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>\n      <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>\n    </svg>\n  ',"eye-slash":'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">\n      <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>\n      <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>\n      <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>\n    </svg>\n  ',eyedropper:'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eyedropper" viewBox="0 0 16 16">\n      <path d="M13.354.646a1.207 1.207 0 0 0-1.708 0L8.5 3.793l-.646-.647a.5.5 0 1 0-.708.708L8.293 5l-7.147 7.146A.5.5 0 0 0 1 12.5v1.793l-.854.853a.5.5 0 1 0 .708.707L1.707 15H3.5a.5.5 0 0 0 .354-.146L11 7.707l1.146 1.147a.5.5 0 0 0 .708-.708l-.647-.646 3.147-3.146a1.207 1.207 0 0 0 0-1.708l-2-2zM2 12.707l7-7L10.293 7l-7 7H2v-1.293z"></path>\n    </svg>\n  ',"grip-vertical":'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grip-vertical" viewBox="0 0 16 16">\n      <path d="M7 2a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>\n    </svg>\n  ',indeterminate:'\n    <svg part="indeterminate-icon" class="checkbox__icon" viewBox="0 0 16 16">\n      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round">\n        <g stroke="currentColor" stroke-width="2">\n          <g transform="translate(2.285714, 6.857143)">\n            <path d="M10.2857143,1.14285714 L1.14285714,1.14285714"></path>\n          </g>\n        </g>\n      </g>\n    </svg>\n  ',"person-fill":'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">\n      <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>\n    </svg>\n  ',"play-fill":'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">\n      <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"></path>\n    </svg>\n  ',"pause-fill":'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pause-fill" viewBox="0 0 16 16">\n      <path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5zm5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5z"></path>\n    </svg>\n  ',radio:'\n    <svg part="checked-icon" class="radio__icon" viewBox="0 0 16 16">\n      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n        <g fill="currentColor">\n          <circle cx="8" cy="8" r="3.42857143"></circle>\n        </g>\n      </g>\n    </svg>\n  ',"star-fill":'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">\n      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>\n    </svg>\n  ',"x-lg":'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">\n      <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>\n    </svg>\n  ',"x-circle-fill":'\n    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">\n      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>\n    </svg>\n  '},mt=[gt,{name:"system",resolver:t=>t in ft?`data:image/svg+xml,${encodeURIComponent(ft[t])}`:""}],yt=[];function _t(t){return mt.find((e=>e.name===t))}var wt=r`
  :host {
    display: inline-block;
    width: 1em;
    height: 1em;
    box-sizing: content-box !important;
  }

  svg {
    display: block;
    height: 100%;
    width: 100%;
  }
`,$t=Object.defineProperty,At=(Object.defineProperties,Object.getOwnPropertyDescriptor),Ct=(Object.getOwnPropertyDescriptors,Object.getOwnPropertySymbols),St=Object.prototype.hasOwnProperty,xt=Object.prototype.propertyIsEnumerable,Et=t=>{throw TypeError(t)},kt=(t,e,s)=>e in t?$t(t,e,{enumerable:!0,configurable:!0,writable:!0,value:s}):t[e]=s,Tt=(t,e)=>{for(var s in e||(e={}))St.call(e,s)&&kt(t,s,e[s]);if(Ct)for(var s of Ct(e))xt.call(e,s)&&kt(t,s,e[s]);return t},zt=(t,e,s,o)=>{for(var i,r=o>1?void 0:o?At(e,s):e,n=t.length-1;n>=0;n--)(i=t[n])&&(r=(o?i(e,s,r):i(r))||r);return o&&r&&$t(e,s,r),r},Ot=(t,e,s)=>e.has(t)||Et("Cannot "+s);function Pt(t,e){const s=Tt({waitUntilFirstUpdate:!1},e);return(e,o)=>{const{update:i}=e,r=Array.isArray(t)?t:[t];e.update=function(t){r.forEach((e=>{const i=e;if(t.has(i)){const e=t.get(i),r=this[i];e!==r&&(s.waitUntilFirstUpdate&&!this.hasUpdated||this[o](e,r))}})),i.call(this,t)}}}var Lt=r`
  :host {
    box-sizing: border-box;
  }

  :host *,
  :host *::before,
  :host *::after {
    box-sizing: inherit;
  }

  [hidden] {
    display: none !important;
  }
`;const Mt={attribute:!0,type:String,converter:y,reflect:!1,hasChanged:_},Ut=(t=Mt,e,s)=>{const{kind:o,metadata:i}=s;let r=globalThis.litPropertyMetadata.get(i);if(void 0===r&&globalThis.litPropertyMetadata.set(i,r=new Map),r.set(s.name,t),"accessor"===o){const{name:o}=s;return{set(s){const i=e.get.call(this);e.set.call(this,s),this.requestUpdate(o,i,t)},init(e){return void 0!==e&&this.P(o,void 0,t),e}}}if("setter"===o){const{name:o}=s;return function(s){const i=this[o];e.call(this,s),this.requestUpdate(o,i,t)}}throw Error("Unsupported decorator location: "+o)};function Ht(t){return(e,s)=>"object"==typeof s?Ut(t,e,s):((t,e,s)=>{const o=e.hasOwnProperty(s);return e.constructor.createProperty(s,o?{...t,wrapped:!0}:t),o?Object.getOwnPropertyDescriptor(e,s):void 0})(t,e,s)}function Bt(t){return Ht({...t,state:!0,attribute:!1})}const Nt=(t,e,s)=>(s.configurable=!0,s.enumerable=!0,Reflect.decorate&&"object"!=typeof e&&Object.defineProperty(t,e,s),s);function Rt(t,e){return(s,o,i)=>{const r=e=>e.renderRoot?.querySelector(t)??null;if(e){const{get:t,set:e}="object"==typeof o?s:i??(()=>{const t=Symbol();return{get(){return this[t]},set(e){this[t]=e}}})();return Nt(s,o,{get(){let s=t.call(this);return void 0===s&&(s=r(this),(null!==s||this.hasUpdated)&&e.call(this,s)),s}})}return Nt(s,o,{get(){return r(this)}})}}var It,jt=class extends ht{constructor(){var t,e;super(),t=this,(e=It).has(t)?Et("Cannot add the same private member more than once"):e instanceof WeakSet?e.add(t):e.set(t,false),this.initialReflectedProperties=new Map,Object.entries(this.constructor.dependencies).forEach((([t,e])=>{this.constructor.define(t,e)}))}emit(t,e){const s=new CustomEvent(t,Tt({bubbles:!0,cancelable:!1,composed:!0,detail:{}},e));return this.dispatchEvent(s),s}static define(t,e=this,s={}){const o=customElements.get(t);if(!o){try{customElements.define(t,e,s)}catch(o){customElements.define(t,class extends e{},s)}return}let i=" (unknown version)",r=i;"version"in e&&e.version&&(i=" v"+e.version),"version"in o&&o.version&&(r=" v"+o.version),i&&r&&i===r||console.warn(`Attempted to register <${t}>${i}, but <${t}>${r} has already been registered.`)}attributeChangedCallback(t,e,s){var o;Ot(this,o=It,"read from private field"),o.get(this)||(this.constructor.elementProperties.forEach(((t,e)=>{t.reflect&&null!=this[e]&&this.initialReflectedProperties.set(e,this[e])})),((t,e,s)=>{Ot(t,e,"write to private field"),e.set(t,s)})(this,It,!0)),super.attributeChangedCallback(t,e,s)}willUpdate(t){super.willUpdate(t),this.initialReflectedProperties.forEach(((e,s)=>{t.has(s)&&null==this[s]&&(this[s]=e)}))}};It=new WeakMap,jt.version="2.20.0",jt.dependencies={},zt([Ht()],jt.prototype,"dir",2),zt([Ht()],jt.prototype,"lang",2);const{I:Dt}=lt;var Ft,Wt=Symbol(),Vt=Symbol(),qt=new Map,Zt=class extends jt{constructor(){super(...arguments),this.initialRender=!1,this.svg=null,this.label="",this.library="default"}async resolveIcon(t,e){var s;let o;if(null==e?void 0:e.spriteSheet)return this.svg=W`<svg part="svg">
        <use part="use" href="${t}"></use>
      </svg>`,this.svg;try{if(o=await fetch(t,{mode:"cors"}),!o.ok)return 410===o.status?Wt:Vt}catch(t){return Vt}try{const t=document.createElement("div");t.innerHTML=await o.text();const e=t.firstElementChild;if("svg"!==(null==(s=null==e?void 0:e.tagName)?void 0:s.toLowerCase()))return Wt;Ft||(Ft=new DOMParser);const i=Ft.parseFromString(e.outerHTML,"text/html").body.querySelector("svg");return i?(i.part.add("svg"),document.adoptNode(i)):Wt}catch(t){return Wt}}connectedCallback(){super.connectedCallback(),yt.push(this)}firstUpdated(){this.initialRender=!0,this.setIcon()}disconnectedCallback(){var t;super.disconnectedCallback(),t=this,yt=yt.filter((e=>e!==t))}getIconSource(){const t=_t(this.library);return this.name&&t?{url:t.resolver(this.name),fromLibrary:!0}:{url:this.src,fromLibrary:!1}}handleLabelChange(){"string"==typeof this.label&&this.label.length>0?(this.setAttribute("role","img"),this.setAttribute("aria-label",this.label),this.removeAttribute("aria-hidden")):(this.removeAttribute("role"),this.removeAttribute("aria-label"),this.setAttribute("aria-hidden","true"))}async setIcon(){var t;const{url:e,fromLibrary:s}=this.getIconSource(),o=s?_t(this.library):void 0;if(!e)return void(this.svg=null);let i=qt.get(e);if(i||(i=this.resolveIcon(e,o),qt.set(e,i)),!this.initialRender)return;const r=await i;if(r===Vt&&qt.delete(e),e===this.getIconSource().url)if((t=>void 0!==t?._$litType$)(r)){if(this.svg=r,o){await this.updateComplete;const t=this.shadowRoot.querySelector("[part='svg']");"function"==typeof o.mutator&&t&&o.mutator(t)}}else switch(r){case Vt:case Wt:this.svg=null,this.emit("sl-error");break;default:this.svg=r.cloneNode(!0),null==(t=null==o?void 0:o.mutator)||t.call(o,this.svg),this.emit("sl-load")}}render(){return this.svg}};Zt.styles=[Lt,wt],zt([Bt()],Zt.prototype,"svg",2),zt([Ht({reflect:!0})],Zt.prototype,"name",2),zt([Ht()],Zt.prototype,"src",2),zt([Ht()],Zt.prototype,"label",2),zt([Ht({reflect:!0})],Zt.prototype,"library",2),zt([Pt("label")],Zt.prototype,"handleLabelChange",1),zt([Pt(["name","src","library"])],Zt.prototype,"setIcon",1);class Kt{constructor(t){}get _$AU(){return this._$AM._$AU}_$AT(t,e,s){this._$Ct=t,this._$AM=e,this._$Ci=s}_$AS(t,e){return this.update(t,e)}update(t,e){return this.render(...e)}}const Gt=(t=>(...e)=>({_$litDirective$:t,values:e}))(class extends Kt{constructor(t){if(super(t),1!==t.type||"class"!==t.name||t.strings?.length>2)throw Error("`classMap()` can only be used in the `class` attribute and must be the only part in the attribute.")}render(t){return" "+Object.keys(t).filter((e=>t[e])).join(" ")+" "}update(t,[e]){if(void 0===this.st){this.st=new Set,void 0!==t.strings&&(this.nt=new Set(t.strings.join(" ").split(/\s/).filter((t=>""!==t))));for(const t in e)e[t]&&!this.nt?.has(t)&&this.st.add(t);return this.render(e)}const s=t.element.classList;for(const t of this.st)t in e||(s.remove(t),this.st.delete(t));for(const t in e){const o=!!e[t];o===this.st.has(t)||this.nt?.has(t)||(o?(s.add(t),this.st.add(t)):(s.remove(t),this.st.delete(t)))}return Z}}),Jt=Symbol.for(""),Qt=t=>{if(t?.r===Jt)return t?._$litStatic$},Xt=(t,...e)=>({_$litStatic$:e.reduce(((e,s,o)=>e+(t=>{if(void 0!==t._$litStatic$)return t._$litStatic$;throw Error(`Value passed to 'literal' function must be a 'literal' result: ${t}. Use 'unsafeStatic' to pass non-literal values, but\n            take care to ensure page security.`)})(s)+t[o+1]),t[0]),r:Jt}),Yt=new Map,te=t=>(e,...s)=>{const o=s.length;let i,r;const n=[],a=[];let l,c=0,h=!1;for(;c<o;){for(l=e[c];c<o&&void 0!==(r=s[c],i=Qt(r));)l+=i+e[++c],h=!0;c!==o&&a.push(r),n.push(l),c++}if(c===o&&n.push(e[o]),h){const t=n.join("$$lit$$");void 0===(e=Yt.get(t))&&(n.raw=n,Yt.set(t,e=n)),s=a}return t(e,...s)},ee=te(W),se=(te(V),te(q),t=>t??K);var oe=class extends jt{constructor(){super(...arguments),this.hasFocus=!1,this.label="",this.disabled=!1}handleBlur(){this.hasFocus=!1,this.emit("sl-blur")}handleFocus(){this.hasFocus=!0,this.emit("sl-focus")}handleClick(t){this.disabled&&(t.preventDefault(),t.stopPropagation())}click(){this.button.click()}focus(t){this.button.focus(t)}blur(){this.button.blur()}render(){const t=!!this.href,e=t?Xt`a`:Xt`button`;return ee`
      <${e}
        part="base"
        class=${Gt({"icon-button":!0,"icon-button--disabled":!t&&this.disabled,"icon-button--focused":this.hasFocus})}
        ?disabled=${se(t?void 0:this.disabled)}
        type=${se(t?void 0:"button")}
        href=${se(t?this.href:void 0)}
        target=${se(t?this.target:void 0)}
        download=${se(t?this.download:void 0)}
        rel=${se(t&&this.target?"noreferrer noopener":void 0)}
        role=${se(t?void 0:"button")}
        aria-disabled=${this.disabled?"true":"false"}
        aria-label="${this.label}"
        tabindex=${this.disabled?"-1":"0"}
        @blur=${this.handleBlur}
        @focus=${this.handleFocus}
        @click=${this.handleClick}
      >
        <sl-icon
          class="icon-button__icon"
          name=${se(this.name)}
          library=${se(this.library)}
          src=${se(this.src)}
          aria-hidden="true"
        ></sl-icon>
      </${e}>
    `}};oe.styles=[Lt,ut],oe.dependencies={"sl-icon":Zt},zt([Rt(".icon-button")],oe.prototype,"button",2),zt([Bt()],oe.prototype,"hasFocus",2),zt([Ht()],oe.prototype,"name",2),zt([Ht()],oe.prototype,"library",2),zt([Ht()],oe.prototype,"src",2),zt([Ht()],oe.prototype,"href",2),zt([Ht()],oe.prototype,"target",2),zt([Ht()],oe.prototype,"download",2),zt([Ht()],oe.prototype,"label",2),zt([Ht({type:Boolean,reflect:!0})],oe.prototype,"disabled",2);const ie=new Set,re=new Map;let ne,ae="ltr",le="en";const ce="undefined"!=typeof MutationObserver&&"undefined"!=typeof document&&void 0!==document.documentElement;if(ce){const t=new MutationObserver(de);ae=document.documentElement.dir||"ltr",le=document.documentElement.lang||navigator.language,t.observe(document.documentElement,{attributes:!0,attributeFilter:["dir","lang"]})}function he(...t){t.map((t=>{const e=t.$code.toLowerCase();re.has(e)?re.set(e,Object.assign(Object.assign({},re.get(e)),t)):re.set(e,t),ne||(ne=t)})),de()}function de(){ce&&(ae=document.documentElement.dir||"ltr",le=document.documentElement.lang||navigator.language),[...ie.keys()].map((t=>{"function"==typeof t.requestUpdate&&t.requestUpdate()}))}class pe{constructor(t){this.host=t,this.host.addController(this)}hostConnected(){ie.add(this.host)}hostDisconnected(){ie.delete(this.host)}dir(){return`${this.host.dir||ae}`.toLowerCase()}lang(){return`${this.host.lang||le}`.toLowerCase()}getTranslationData(t){var e,s;const o=new Intl.Locale(t.replace(/_/g,"-")),i=null==o?void 0:o.language.toLowerCase(),r=null!==(s=null===(e=null==o?void 0:o.region)||void 0===e?void 0:e.toLowerCase())&&void 0!==s?s:"";return{locale:o,language:i,region:r,primary:re.get(`${i}-${r}`),secondary:re.get(i)}}exists(t,e){var s;const{primary:o,secondary:i}=this.getTranslationData(null!==(s=e.lang)&&void 0!==s?s:this.lang());return e=Object.assign({includeFallback:!1},e),!!(o&&o[t]||i&&i[t]||e.includeFallback&&ne&&ne[t])}term(t,...e){const{primary:s,secondary:o}=this.getTranslationData(this.lang());let i;if(s&&s[t])i=s[t];else if(o&&o[t])i=o[t];else{if(!ne||!ne[t])return console.error(`No translation found for: ${String(t)}`),String(t);i=ne[t]}return"function"==typeof i?i(...e):i}date(t,e){return t=new Date(t),new Intl.DateTimeFormat(this.lang(),e).format(t)}number(t,e){return t=Number(t),isNaN(t)?"":new Intl.NumberFormat(this.lang(),e).format(t)}relativeTime(t,e,s){return new Intl.RelativeTimeFormat(this.lang(),s).format(t,e)}}var ue={$code:"en",$name:"English",$dir:"ltr",carousel:"Carousel",clearEntry:"Clear entry",close:"Close",copied:"Copied",copy:"Copy",currentValue:"Current value",error:"Error",goToSlide:(t,e)=>`Go to slide ${t} of ${e}`,hidePassword:"Hide password",loading:"Loading",nextSlide:"Next slide",numOptionsSelected:t=>0===t?"No options selected":1===t?"1 option selected":`${t} options selected`,previousSlide:"Previous slide",progress:"Progress",remove:"Remove",resize:"Resize",scrollToEnd:"Scroll to end",scrollToStart:"Scroll to start",selectAColorFromTheScreen:"Select a color from the screen",showPassword:"Show password",slideNum:t=>`Slide ${t}`,toggleColorFormat:"Toggle color format"};he(ue);var be=ue,ve=class extends pe{};he(be);var ge=0,fe=class extends jt{constructor(){super(...arguments),this.localize=new ve(this),this.attrId=++ge,this.componentId=`sl-tab-${this.attrId}`,this.panel="",this.active=!1,this.closable=!1,this.disabled=!1,this.tabIndex=0}connectedCallback(){super.connectedCallback(),this.setAttribute("role","tab")}handleCloseClick(t){t.stopPropagation(),this.emit("sl-close")}handleActiveChange(){this.setAttribute("aria-selected",this.active?"true":"false")}handleDisabledChange(){this.setAttribute("aria-disabled",this.disabled?"true":"false"),this.disabled&&!this.active?this.tabIndex=-1:this.tabIndex=0}render(){return this.id=this.id.length>0?this.id:this.componentId,W`
      <div
        part="base"
        class=${Gt({tab:!0,"tab--active":this.active,"tab--closable":this.closable,"tab--disabled":this.disabled})}
      >
        <slot></slot>
        ${this.closable?W`
              <sl-icon-button
                part="close-button"
                exportparts="base:close-button__base"
                name="x-lg"
                library="system"
                label=${this.localize.term("close")}
                class="tab__close-button"
                @click=${this.handleCloseClick}
                tabindex="-1"
              ></sl-icon-button>
            `:""}
      </div>
    `}};fe.styles=[Lt,pt],fe.dependencies={"sl-icon-button":oe},zt([Rt(".tab")],fe.prototype,"tab",2),zt([Ht({reflect:!0})],fe.prototype,"panel",2),zt([Ht({type:Boolean,reflect:!0})],fe.prototype,"active",2),zt([Ht({type:Boolean,reflect:!0})],fe.prototype,"closable",2),zt([Ht({type:Boolean,reflect:!0})],fe.prototype,"disabled",2),zt([Ht({type:Number,reflect:!0})],fe.prototype,"tabIndex",2),zt([Pt("active")],fe.prototype,"handleActiveChange",1),zt([Pt("disabled")],fe.prototype,"handleDisabledChange",1),fe.define("sl-tab");var me=r`
  :host {
    --padding: 0;
    visibility: hidden;
  }

  :host([active]) {
    visibility: visible;
  }

  .tab-panel {
    display: block;
    padding: var(--padding);
  }
`,ye=0,_e=class extends jt{constructor(){super(...arguments),this.attrId=++ye,this.componentId=`sl-tab-panel-${this.attrId}`,this.name="",this.active=!1}connectedCallback(){super.connectedCallback(),this.id=this.id.length>0?this.id:this.componentId,this.setAttribute("role","tabpanel")}handleActiveChange(){this.setAttribute("aria-hidden",this.active?"false":"true")}render(){return W`
      <slot
        part="base"
        class=${Gt({"tab-panel":!0,"tab-panel--active":this.active})}
      ></slot>
    `}};_e.styles=[Lt,me],zt([Ht({reflect:!0})],_e.prototype,"name",2),zt([Ht({type:Boolean,reflect:!0})],_e.prototype,"active",2),zt([Pt("active")],_e.prototype,"handleActiveChange",1),_e.define("sl-tab-panel");var we=r`
  :host {
    --indicator-color: var(--sl-color-primary-600);
    --track-color: var(--sl-color-neutral-200);
    --track-width: 2px;

    display: block;
  }

  .tab-group {
    display: flex;
    border-radius: 0;
  }

  .tab-group__tabs {
    display: flex;
    position: relative;
  }

  .tab-group__indicator {
    position: absolute;
    transition:
      var(--sl-transition-fast) translate ease,
      var(--sl-transition-fast) width ease;
  }

  .tab-group--has-scroll-controls .tab-group__nav-container {
    position: relative;
    padding: 0 var(--sl-spacing-x-large);
  }

  .tab-group--has-scroll-controls .tab-group__scroll-button--start--hidden,
  .tab-group--has-scroll-controls .tab-group__scroll-button--end--hidden {
    visibility: hidden;
  }

  .tab-group__body {
    display: block;
    overflow: auto;
  }

  .tab-group__scroll-button {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 0;
    bottom: 0;
    width: var(--sl-spacing-x-large);
  }

  .tab-group__scroll-button--start {
    left: 0;
  }

  .tab-group__scroll-button--end {
    right: 0;
  }

  .tab-group--rtl .tab-group__scroll-button--start {
    left: auto;
    right: 0;
  }

  .tab-group--rtl .tab-group__scroll-button--end {
    left: 0;
    right: auto;
  }

  /*
   * Top
   */

  .tab-group--top {
    flex-direction: column;
  }

  .tab-group--top .tab-group__nav-container {
    order: 1;
  }

  .tab-group--top .tab-group__nav {
    display: flex;
    overflow-x: auto;

    /* Hide scrollbar in Firefox */
    scrollbar-width: none;
  }

  /* Hide scrollbar in Chrome/Safari */
  .tab-group--top .tab-group__nav::-webkit-scrollbar {
    width: 0;
    height: 0;
  }

  .tab-group--top .tab-group__tabs {
    flex: 1 1 auto;
    position: relative;
    flex-direction: row;
    border-bottom: solid var(--track-width) var(--track-color);
  }

  .tab-group--top .tab-group__indicator {
    bottom: calc(-1 * var(--track-width));
    border-bottom: solid var(--track-width) var(--indicator-color);
  }

  .tab-group--top .tab-group__body {
    order: 2;
  }

  .tab-group--top ::slotted(sl-tab-panel) {
    --padding: var(--sl-spacing-medium) 0;
  }

  /*
   * Bottom
   */

  .tab-group--bottom {
    flex-direction: column;
  }

  .tab-group--bottom .tab-group__nav-container {
    order: 2;
  }

  .tab-group--bottom .tab-group__nav {
    display: flex;
    overflow-x: auto;

    /* Hide scrollbar in Firefox */
    scrollbar-width: none;
  }

  /* Hide scrollbar in Chrome/Safari */
  .tab-group--bottom .tab-group__nav::-webkit-scrollbar {
    width: 0;
    height: 0;
  }

  .tab-group--bottom .tab-group__tabs {
    flex: 1 1 auto;
    position: relative;
    flex-direction: row;
    border-top: solid var(--track-width) var(--track-color);
  }

  .tab-group--bottom .tab-group__indicator {
    top: calc(-1 * var(--track-width));
    border-top: solid var(--track-width) var(--indicator-color);
  }

  .tab-group--bottom .tab-group__body {
    order: 1;
  }

  .tab-group--bottom ::slotted(sl-tab-panel) {
    --padding: var(--sl-spacing-medium) 0;
  }

  /*
   * Start
   */

  .tab-group--start {
    flex-direction: row;
  }

  .tab-group--start .tab-group__nav-container {
    order: 1;
  }

  .tab-group--start .tab-group__tabs {
    flex: 0 0 auto;
    flex-direction: column;
    border-inline-end: solid var(--track-width) var(--track-color);
  }

  .tab-group--start .tab-group__indicator {
    right: calc(-1 * var(--track-width));
    border-right: solid var(--track-width) var(--indicator-color);
  }

  .tab-group--start.tab-group--rtl .tab-group__indicator {
    right: auto;
    left: calc(-1 * var(--track-width));
  }

  .tab-group--start .tab-group__body {
    flex: 1 1 auto;
    order: 2;
  }

  .tab-group--start ::slotted(sl-tab-panel) {
    --padding: 0 var(--sl-spacing-medium);
  }

  /*
   * End
   */

  .tab-group--end {
    flex-direction: row;
  }

  .tab-group--end .tab-group__nav-container {
    order: 2;
  }

  .tab-group--end .tab-group__tabs {
    flex: 0 0 auto;
    flex-direction: column;
    border-left: solid var(--track-width) var(--track-color);
  }

  .tab-group--end .tab-group__indicator {
    left: calc(-1 * var(--track-width));
    border-inline-start: solid var(--track-width) var(--indicator-color);
  }

  .tab-group--end.tab-group--rtl .tab-group__indicator {
    right: calc(-1 * var(--track-width));
    left: auto;
  }

  .tab-group--end .tab-group__body {
    flex: 1 1 auto;
    order: 1;
  }

  .tab-group--end ::slotted(sl-tab-panel) {
    --padding: 0 var(--sl-spacing-medium);
  }
`,$e=r`
  :host {
    display: contents;
  }
`,Ae=class extends jt{constructor(){super(...arguments),this.observedElements=[],this.disabled=!1}connectedCallback(){super.connectedCallback(),this.resizeObserver=new ResizeObserver((t=>{this.emit("sl-resize",{detail:{entries:t}})})),this.disabled||this.startObserver()}disconnectedCallback(){super.disconnectedCallback(),this.stopObserver()}handleSlotChange(){this.disabled||this.startObserver()}startObserver(){const t=this.shadowRoot.querySelector("slot");if(null!==t){const e=t.assignedElements({flatten:!0});this.observedElements.forEach((t=>this.resizeObserver.unobserve(t))),this.observedElements=[],e.forEach((t=>{this.resizeObserver.observe(t),this.observedElements.push(t)}))}}stopObserver(){this.resizeObserver.disconnect()}handleDisabledChange(){this.disabled?this.stopObserver():this.startObserver()}render(){return W` <slot @slotchange=${this.handleSlotChange}></slot> `}};function Ce(t,e,s="vertical",o="smooth"){const i=function(t,e){return{top:Math.round(t.getBoundingClientRect().top-e.getBoundingClientRect().top),left:Math.round(t.getBoundingClientRect().left-e.getBoundingClientRect().left)}}(t,e),r=i.top+e.scrollTop,n=i.left+e.scrollLeft,a=e.scrollLeft,l=e.scrollLeft+e.offsetWidth,c=e.scrollTop,h=e.scrollTop+e.offsetHeight;"horizontal"!==s&&"both"!==s||(n<a?e.scrollTo({left:n,behavior:o}):n+t.clientWidth>l&&e.scrollTo({left:n-e.offsetWidth+t.clientWidth,behavior:o})),"vertical"!==s&&"both"!==s||(r<c?e.scrollTo({top:r,behavior:o}):r+t.clientHeight>h&&e.scrollTo({top:r-e.offsetHeight+t.clientHeight,behavior:o}))}Ae.styles=[Lt,$e],zt([Ht({type:Boolean,reflect:!0})],Ae.prototype,"disabled",2),zt([Pt("disabled",{waitUntilFirstUpdate:!0})],Ae.prototype,"handleDisabledChange",1);var Se=class extends jt{constructor(){super(...arguments),this.tabs=[],this.focusableTabs=[],this.panels=[],this.localize=new ve(this),this.hasScrollControls=!1,this.shouldHideScrollStartButton=!1,this.shouldHideScrollEndButton=!1,this.placement="top",this.activation="auto",this.noScrollControls=!1,this.fixedScrollControls=!1,this.scrollOffset=1}connectedCallback(){const t=Promise.all([customElements.whenDefined("sl-tab"),customElements.whenDefined("sl-tab-panel")]);super.connectedCallback(),this.resizeObserver=new ResizeObserver((()=>{this.repositionIndicator(),this.updateScrollControls()})),this.mutationObserver=new MutationObserver((t=>{if(t.some((t=>!["aria-labelledby","aria-controls"].includes(t.attributeName)))&&setTimeout((()=>this.setAriaLabels())),t.some((t=>"disabled"===t.attributeName)))this.syncTabsAndPanels();else if(t.some((t=>"active"===t.attributeName))){const e=t.filter((t=>"active"===t.attributeName&&"sl-tab"===t.target.tagName.toLowerCase())).map((t=>t.target)),s=e.find((t=>t.active));s&&this.setActiveTab(s)}})),this.updateComplete.then((()=>{this.syncTabsAndPanels(),this.mutationObserver.observe(this,{attributes:!0,childList:!0,subtree:!0}),this.resizeObserver.observe(this.nav),t.then((()=>{new IntersectionObserver(((t,e)=>{var s;t[0].intersectionRatio>0&&(this.setAriaLabels(),this.setActiveTab(null!=(s=this.getActiveTab())?s:this.tabs[0],{emitEvents:!1}),e.unobserve(t[0].target))})).observe(this.tabGroup)}))}))}disconnectedCallback(){var t,e;super.disconnectedCallback(),null==(t=this.mutationObserver)||t.disconnect(),this.nav&&(null==(e=this.resizeObserver)||e.unobserve(this.nav))}getAllTabs(){return this.shadowRoot.querySelector('slot[name="nav"]').assignedElements()}getAllPanels(){return[...this.body.assignedElements()].filter((t=>"sl-tab-panel"===t.tagName.toLowerCase()))}getActiveTab(){return this.tabs.find((t=>t.active))}handleClick(t){const e=t.target.closest("sl-tab");(null==e?void 0:e.closest("sl-tab-group"))===this&&null!==e&&this.setActiveTab(e,{scrollBehavior:"smooth"})}handleKeyDown(t){const e=t.target.closest("sl-tab");if((null==e?void 0:e.closest("sl-tab-group"))===this&&(["Enter"," "].includes(t.key)&&null!==e&&(this.setActiveTab(e,{scrollBehavior:"smooth"}),t.preventDefault()),["ArrowLeft","ArrowRight","ArrowUp","ArrowDown","Home","End"].includes(t.key))){const e=this.tabs.find((t=>t.matches(":focus"))),s="rtl"===this.localize.dir();let o=null;if("sl-tab"===(null==e?void 0:e.tagName.toLowerCase())){if("Home"===t.key)o=this.focusableTabs[0];else if("End"===t.key)o=this.focusableTabs[this.focusableTabs.length-1];else if(["top","bottom"].includes(this.placement)&&t.key===(s?"ArrowRight":"ArrowLeft")||["start","end"].includes(this.placement)&&"ArrowUp"===t.key){const t=this.tabs.findIndex((t=>t===e));o=this.findNextFocusableTab(t,"backward")}else if(["top","bottom"].includes(this.placement)&&t.key===(s?"ArrowLeft":"ArrowRight")||["start","end"].includes(this.placement)&&"ArrowDown"===t.key){const t=this.tabs.findIndex((t=>t===e));o=this.findNextFocusableTab(t,"forward")}if(!o)return;o.tabIndex=0,o.focus({preventScroll:!0}),"auto"===this.activation?this.setActiveTab(o,{scrollBehavior:"smooth"}):this.tabs.forEach((t=>{t.tabIndex=t===o?0:-1})),["top","bottom"].includes(this.placement)&&Ce(o,this.nav,"horizontal"),t.preventDefault()}}}handleScrollToStart(){this.nav.scroll({left:"rtl"===this.localize.dir()?this.nav.scrollLeft+this.nav.clientWidth:this.nav.scrollLeft-this.nav.clientWidth,behavior:"smooth"})}handleScrollToEnd(){this.nav.scroll({left:"rtl"===this.localize.dir()?this.nav.scrollLeft-this.nav.clientWidth:this.nav.scrollLeft+this.nav.clientWidth,behavior:"smooth"})}setActiveTab(t,e){if(e=Tt({emitEvents:!0,scrollBehavior:"auto"},e),t!==this.activeTab&&!t.disabled){const s=this.activeTab;this.activeTab=t,this.tabs.forEach((t=>{t.active=t===this.activeTab,t.tabIndex=t===this.activeTab?0:-1})),this.panels.forEach((t=>{var e;return t.active=t.name===(null==(e=this.activeTab)?void 0:e.panel)})),this.syncIndicator(),["top","bottom"].includes(this.placement)&&Ce(this.activeTab,this.nav,"horizontal",e.scrollBehavior),e.emitEvents&&(s&&this.emit("sl-tab-hide",{detail:{name:s.panel}}),this.emit("sl-tab-show",{detail:{name:this.activeTab.panel}}))}}setAriaLabels(){this.tabs.forEach((t=>{const e=this.panels.find((e=>e.name===t.panel));e&&(t.setAttribute("aria-controls",e.getAttribute("id")),e.setAttribute("aria-labelledby",t.getAttribute("id")))}))}repositionIndicator(){const t=this.getActiveTab();if(!t)return;const e=t.clientWidth,s=t.clientHeight,o="rtl"===this.localize.dir(),i=this.getAllTabs(),r=i.slice(0,i.indexOf(t)).reduce(((t,e)=>({left:t.left+e.clientWidth,top:t.top+e.clientHeight})),{left:0,top:0});switch(this.placement){case"top":case"bottom":this.indicator.style.width=`${e}px`,this.indicator.style.height="auto",this.indicator.style.translate=o?-1*r.left+"px":`${r.left}px`;break;case"start":case"end":this.indicator.style.width="auto",this.indicator.style.height=`${s}px`,this.indicator.style.translate=`0 ${r.top}px`}}syncTabsAndPanels(){this.tabs=this.getAllTabs(),this.focusableTabs=this.tabs.filter((t=>!t.disabled)),this.panels=this.getAllPanels(),this.syncIndicator(),this.updateComplete.then((()=>this.updateScrollControls()))}findNextFocusableTab(t,e){let s=null;const o="forward"===e?1:-1;let i=t+o;for(;t<this.tabs.length;){if(s=this.tabs[i]||null,null===s){s="forward"===e?this.focusableTabs[0]:this.focusableTabs[this.focusableTabs.length-1];break}if(!s.disabled)break;i+=o}return s}updateScrollButtons(){this.hasScrollControls&&!this.fixedScrollControls&&(this.shouldHideScrollStartButton=this.scrollFromStart()<=this.scrollOffset,this.shouldHideScrollEndButton=this.isScrolledToEnd())}isScrolledToEnd(){return this.scrollFromStart()+this.nav.clientWidth>=this.nav.scrollWidth-this.scrollOffset}scrollFromStart(){return"rtl"===this.localize.dir()?-this.nav.scrollLeft:this.nav.scrollLeft}updateScrollControls(){this.noScrollControls?this.hasScrollControls=!1:this.hasScrollControls=["top","bottom"].includes(this.placement)&&this.nav.scrollWidth>this.nav.clientWidth+1,this.updateScrollButtons()}syncIndicator(){this.getActiveTab()?(this.indicator.style.display="block",this.repositionIndicator()):this.indicator.style.display="none"}show(t){const e=this.tabs.find((e=>e.panel===t));e&&this.setActiveTab(e,{scrollBehavior:"smooth"})}render(){const t="rtl"===this.localize.dir();return W`
      <div
        part="base"
        class=${Gt({"tab-group":!0,"tab-group--top":"top"===this.placement,"tab-group--bottom":"bottom"===this.placement,"tab-group--start":"start"===this.placement,"tab-group--end":"end"===this.placement,"tab-group--rtl":"rtl"===this.localize.dir(),"tab-group--has-scroll-controls":this.hasScrollControls})}
        @click=${this.handleClick}
        @keydown=${this.handleKeyDown}
      >
        <div class="tab-group__nav-container" part="nav">
          ${this.hasScrollControls?W`
                <sl-icon-button
                  part="scroll-button scroll-button--start"
                  exportparts="base:scroll-button__base"
                  class=${Gt({"tab-group__scroll-button":!0,"tab-group__scroll-button--start":!0,"tab-group__scroll-button--start--hidden":this.shouldHideScrollStartButton})}
                  name=${t?"chevron-right":"chevron-left"}
                  library="system"
                  tabindex="-1"
                  aria-hidden="true"
                  label=${this.localize.term("scrollToStart")}
                  @click=${this.handleScrollToStart}
                ></sl-icon-button>
              `:""}

          <div class="tab-group__nav" @scrollend=${this.updateScrollButtons}>
            <div part="tabs" class="tab-group__tabs" role="tablist">
              <div part="active-tab-indicator" class="tab-group__indicator"></div>
              <sl-resize-observer @sl-resize=${this.syncIndicator}>
                <slot name="nav" @slotchange=${this.syncTabsAndPanels}></slot>
              </sl-resize-observer>
            </div>
          </div>

          ${this.hasScrollControls?W`
                <sl-icon-button
                  part="scroll-button scroll-button--end"
                  exportparts="base:scroll-button__base"
                  class=${Gt({"tab-group__scroll-button":!0,"tab-group__scroll-button--end":!0,"tab-group__scroll-button--end--hidden":this.shouldHideScrollEndButton})}
                  name=${t?"chevron-left":"chevron-right"}
                  library="system"
                  tabindex="-1"
                  aria-hidden="true"
                  label=${this.localize.term("scrollToEnd")}
                  @click=${this.handleScrollToEnd}
                ></sl-icon-button>
              `:""}
        </div>

        <slot part="body" class="tab-group__body" @slotchange=${this.syncTabsAndPanels}></slot>
      </div>
    `}};Se.styles=[Lt,we],Se.dependencies={"sl-icon-button":oe,"sl-resize-observer":Ae},zt([Rt(".tab-group")],Se.prototype,"tabGroup",2),zt([Rt(".tab-group__body")],Se.prototype,"body",2),zt([Rt(".tab-group__nav")],Se.prototype,"nav",2),zt([Rt(".tab-group__indicator")],Se.prototype,"indicator",2),zt([Bt()],Se.prototype,"hasScrollControls",2),zt([Bt()],Se.prototype,"shouldHideScrollStartButton",2),zt([Bt()],Se.prototype,"shouldHideScrollEndButton",2),zt([Ht()],Se.prototype,"placement",2),zt([Ht()],Se.prototype,"activation",2),zt([Ht({attribute:"no-scroll-controls",type:Boolean})],Se.prototype,"noScrollControls",2),zt([Ht({attribute:"fixed-scroll-controls",type:Boolean})],Se.prototype,"fixedScrollControls",2),zt([function(t){return(e,s)=>{const o="function"==typeof e?e:e[s];Object.assign(o,t)}}({passive:!0})],Se.prototype,"updateScrollButtons",1),zt([Pt("noScrollControls",{waitUntilFirstUpdate:!0})],Se.prototype,"updateScrollControls",1),zt([Pt("placement",{waitUntilFirstUpdate:!0})],Se.prototype,"syncIndicator",1),Se.define("sl-tab-group");var xe=(t,e)=>{let s=0;return function(...o){window.clearTimeout(s),s=window.setTimeout((()=>{t.call(this,...o)}),e)}},Ee=(t,e,s)=>{const o=t[e];t[e]=function(...t){o.call(this,...t),s.call(this,o,...t)}};(()=>{if("undefined"!=typeof window&&!("onscrollend"in window)){const t=new Set,e=new WeakMap,s=e=>{for(const s of e.changedTouches)t.add(s.identifier)},o=e=>{for(const s of e.changedTouches)t.delete(s.identifier)};document.addEventListener("touchstart",s,!0),document.addEventListener("touchend",o,!0),document.addEventListener("touchcancel",o,!0),Ee(EventTarget.prototype,"addEventListener",(function(s,o){if("scrollend"!==o)return;const i=xe((()=>{t.size?i():this.dispatchEvent(new Event("scrollend"))}),100);s.call(this,"scroll",i,{passive:!0}),e.set(this,i)})),Ee(EventTarget.prototype,"removeEventListener",(function(t,s){if("scrollend"!==s)return;const o=e.get(this);o&&t.call(this,"scroll",o,{passive:!0})}))}})()})();

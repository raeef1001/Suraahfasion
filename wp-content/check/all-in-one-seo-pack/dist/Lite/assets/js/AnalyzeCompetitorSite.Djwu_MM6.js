import{p as x,a as I,u as w,q as R,o as b,e as L}from"./links.BdfvOpfI.js";import"./default-i18n.Bd0Z306Z.js";import{u as C,S as A}from"./SeoSiteScore.QlpTBwxb.js";import{x as l,o as c,c as u,C as m,m as h,l as z,q as v,v as D,a as i,t as a,G as N,D as g,d,F as B,K as M}from"./vue.esm-bundler.CWQFYt9y.js";import{_ as k}from"./_plugin-vue_export-helper.BN1snXvA.js";import{q as P}from"./helpers.pkmhnyB1.js";import{C as V,a as W}from"./Score.PoeSF_ac.js";import{p as q}from"./popup.6pJEdp0g.js";import{C as F}from"./Blur.DNVDismY.js";import{C as T}from"./Card.CacAhFkZ.js";import{C as j}from"./SeoSiteAnalysisResults.j1GCPBIs.js";import{C as G}from"./Index.D86wwOWh.js";import{S as H}from"./Refresh.Cok1AepX.js";import{S as J}from"./index.BQgiQQKQ.js";import"./params.B3T1WKlC.js";import"./Tooltip.Jp05nfCy.js";import"./Caret.iRBf3wcH.js";import"./Slide.CRIn0kdn.js";import"./Tags.DgMRWz4X.js";import"./postSlug.CqYKoIBF.js";import"./metabox.DNXnRDS_.js";import"./cleanForSlug.BsZSjrxM.js";import"./toString.C-weURPh.js";import"./_baseTrim.BYZhh0MR.js";import"./_stringToArray.DnK4tKcY.js";import"./get.Wi73TNIO.js";import"./_baseSet.D9YlRyL4.js";import"./GoogleSearchPreview.2pz5PAto.js";import"./constants.DpuIWwJ9.js";import"./Information.CESrgQJV.js";import"./Gear.aQH8e4fl.js";const K={setup(){const{strings:e}=C();return{connectStore:x(),optionsStore:I(),rootStore:w(),strings:e}},components:{CoreBlur:F,CoreCard:T},mixins:[A],data(){return{score:0}},methods:{openPopup(e){q(e,this.connectWithAioseo,600,630,!0,["token"],this.completedCallback,()=>{})},completedCallback(e){return this.connectStore.saveConnectToken(e.token)}}},Y={key:0,class:"aioseo-seo-site-score-cta"};function Q(e,o,s,r,t,n){const _=l("core-card");return c(),u("div",null,[m(_,{slug:"analyzeNewCompetitor","hide-header":"","no-slide":"",toggles:!1},{default:h(()=>[(c(),z(D(r.optionsStore.internalOptions.internal.siteAnalysis.connectToken?"div":"core-blur"),null,{default:h(()=>[v(e.$slots,"default")]),_:3})),r.optionsStore.internalOptions.internal.siteAnalysis.connectToken?d("",!0):(c(),u("div",Y,[i("a",{href:"#",onClick:o[0]||(o[0]=N(S=>n.openPopup(r.rootStore.aioseo.urls.connect),["prevent"]))},a(e.connectWithAioseo),1),g(" "+a(r.strings.toAnalyzeCompetitorSite),1)]))]),_:3}),r.optionsStore.internalOptions.internal.siteAnalysis.connectToken?v(e.$slots,"competitor-results",{key:0}):d("",!0)])}const X=k(K,[["render",Q]]),Z={setup(){const{strings:e}=C();return{analyzerStore:R(),composableStrings:e}},components:{CoreSiteScore:G,SvgRefresh:H},mixins:[A],props:{score:Number,loading:Boolean,site:{type:String,required:!0},summary:{type:Object,default(){return{}}},mobileSnapshot:String},data(){return{isAnalyzing:!1,strings:b(this.composableStrings,{criticalIssues:this.$t.__("Important Issues",this.$td),warnings:this.$t.__("Warnings",this.$td),recommendedImprovements:this.$t.__("Recommended Improvements",this.$td),goodResults:this.$t.__("Good Results",this.$td),completeSiteAuditChecklist:this.$t.__("Complete Site Audit Checklist",this.$td),refreshResults:this.$t.__("Refresh Results",this.$td),mobileSnapshot:this.$t.__("Mobile Snapshot",this.$td)})}},methods:{refresh(){this.isAnalyzing=!0,this.analyzerStore.runSiteAnalyzer({url:this.site,refresh:!0}).then(()=>this.isAnalyzing=!1)}}},ee={class:"aioseo-site-score-competitor"},te={class:"aioseo-seo-site-score-score"},se={class:"aioseo-seo-site-score-recommendations"},oe={class:"critical"},re={class:"round red"},ie={class:"recommended"},ne={class:"round blue"},ae={class:"good"},le={class:"round green"},ce={key:0,class:"mobile-snapshot"},me=["src"];function he(e,o,s,r,t,n){const _=l("core-site-score"),S=l("svg-refresh"),f=l("base-button");return c(),u("div",ee,[i("div",te,[m(_,{loading:t.isAnalyzing||s.loading,score:s.score,description:e.description},null,8,["loading","score","description"])]),i("div",se,[i("div",oe,[i("span",re,a(s.summary.critical||0),1),g(" "+a(t.strings.criticalIssues),1)]),i("div",ie,[i("span",ne,a(s.summary.recommended||0),1),g(" "+a(t.strings.recommendedImprovements),1)]),i("div",ae,[i("span",le,a(s.summary.good||0),1),g(" "+a(t.strings.goodResults),1)])]),m(f,{class:"refresh-results",type:"gray",size:"small",onClick:n.refresh,loading:t.isAnalyzing},{default:h(()=>[m(S),g(" "+a(t.strings.refreshResults),1)]),_:1},8,["onClick","loading"]),s.mobileSnapshot?(c(),u("div",ce,[i("div",null,a(t.strings.mobileSnapshot),1),i("img",{alt:"Mobile Snapshot",src:s.mobileSnapshot},null,8,me)])):d("",!0)])}const ue=k(Z,[["render",he]]),pe={setup(){const{strings:e}=C();return{analyzerStore:R(),settingsStore:L(),composableStrings:e}},components:{CoreAnalyze:V,CoreAnalyzeScore:W,CoreAnalyzeCompetitorSiteHeader:X,CoreCard:T,CoreSeoSiteAnalysisResults:j,CoreSiteScoreCompetitor:ue,SvgTrash:J},mixins:[A],data(){return{score:0,competitorUrl:null,isAnalyzing:!1,inputError:!1,competitorResults:{},analyzeTime:8,strings:b(this.composableStrings,{enterCompetitorUrl:this.$t.__("Enter Competitor URL",this.$td),performInDepthAnalysis:this.$t.__("Perform in-depth SEO Analysis of your competitor's website.",this.$td),analyze:this.$t.__("Analyze",this.$td),pleaseEnterValidUrl:this.$t.__("Please enter a valid URL.",this.$td)})}},watch:{"analyzerStore.analyzeError"(e){e&&(this.isAnalyzing=!1)}},computed:{getError(){switch(this.analyzerStore.analyzeError){case"invalid-url":return this.$t.__("The URL provided is invalid.",this.$td);case"missing-content":return this.$t.sprintf("%1$s %2$s",this.$t.__("We were unable to parse the content for this site.",this.$td),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"seoAnalyzerIssues",!0));case"invalid-token":return this.$t.sprintf(this.$t.__("Your site is not connected. Please connect to %1$s, then try again.",this.$td),"AIOSEO")}return this.analyzerStore.analyzeError}},methods:{parseResults(e){return JSON.parse(e)},getSummary(e){return{recommended:this.analyzerStore.recommendedCount(e),critical:this.analyzerStore.criticalCount(e),good:this.analyzerStore.goodCount(e)}},startAnalyzing(e){if(this.inputError=!1,this.competitorUrl=e,!this.competitorUrl.startsWith("http://")&&!this.competitorUrl.startsWith("https")&&(this.competitorUrl="https://"+this.competitorUrl),!P(this.competitorUrl)){this.inputError=!0;return}this.analyzerStore.analyzing=!0,this.analyzerStore.analyzeError=!1,this.analyzerStore.runSiteAnalyzer({url:this.competitorUrl}),this.isAnalyzing=!0,setTimeout(this.checkStatus,this.analyzeTime*1e3),this.closeAllCards()},checkStatus(){if(this.isAnalyzing=!1,this.analyzerStore.analyzing){this.$nextTick(()=>{this.isAnalyzing=!0,2>this.analyzeTime&&(this.analyzeTime=8),this.analyzeTime=this.analyzeTime/2,setTimeout(this.checkStatus,this.analyzeTime*1e3)});return}this.competitorUrl=null,this.competitorResults=this.analyzerStore.getCompetitorSiteAnalysisResults,this.toggleFirstCard(),this.$nextTick(()=>{const e=Object.keys(this.competitorResults),o=document.querySelector(".aioseo-header"),s=o.offsetHeight+o.offsetTop+30;this.$scrollTo("#aioseo-competitor-results"+this.hashCode(e[0]),{offset:-s})})},startDeleteSite(e){this.closeAllCards(),delete this.competitorResults[e],this.analyzerStore.deleteCompetitorSite(e).then(()=>{this.competitorResults=this.analyzerStore.getCompetitorSiteAnalysisResults})},closeAllCards(){Object.keys(this.competitorResults).forEach(o=>{this.settingsStore.closeCard("analyzeCompetitorSite"+o)})},toggleFirstCard(){const e=Object.keys(this.competitorResults);this.settingsStore.toggleCard({slug:"analyzeCompetitorSite"+e[0]})},hashCode(e){if(!e)return;let o=0,s,r;for(s=0;s<e.length;s++)r=e.charCodeAt(s),o=(o<<5)-o+r,o|=0;return o}},mounted(){this.analyzerStore.analyzeError=!1,this.competitorResults=this.analyzerStore.getCompetitorSiteAnalysisResults,this.toggleFirstCard()}},de={class:"aioseo-analyze-competitor-site"},_e={key:0,class:"aioseo-description aioseo-error"},ye=["innerHTML"],ge={class:"competitor-results-main"},Se={class:"competitor-results-body"};function fe(e,o,s,r,t,n){const _=l("core-analyze"),S=l("core-analyze-score"),f=l("svg-trash"),E=l("core-site-score-competitor"),$=l("core-seo-site-analysis-results"),U=l("core-card"),O=l("core-analyze-competitor-site-header");return c(),u("div",de,[m(O,null,{"competitor-results":h(()=>[(c(!0),u(B,null,M(t.competitorResults,(y,p)=>(c(),z(U,{key:p,id:"aioseo-competitor-results"+n.hashCode(p),slug:"analyzeCompetitorSite"+p,"save-toggle-status":!1},{header:h(()=>[m(S,{score:n.parseResults(y).score},null,8,["score"]),i("span",null,a(p),1),t.isAnalyzing?d("",!0):(c(),z(f,{key:0,onClick:ze=>n.startDeleteSite(p)},null,8,["onClick"]))]),default:h(()=>[i("div",ge,[m(E,{site:p,score:n.parseResults(y).score,loading:r.analyzerStore.analyzing,summary:n.getSummary(n.parseResults(y).results),"mobile-snapshot":n.parseResults(y).results.advanced.mobileSnapshot},null,8,["site","score","loading","summary","mobile-snapshot"]),i("div",Se,[m($,{section:"all-items","all-results":n.parseResults(y).results,"show-google-preview":""},null,8,["all-results"])])])]),_:2},1032,["id","slug"]))),128))]),default:h(()=>[m(_,{header:t.strings.enterCompetitorUrl,description:t.strings.performInDepthAnalysis,inputError:t.inputError,isAnalyzing:t.isAnalyzing,analyzeTime:t.analyzeTime,placeholder:"https://competitorwebsite.com",onStartAnalyzing:n.startAnalyzing},{errors:h(()=>[t.inputError?(c(),u("div",_e,a(t.strings.pleaseEnterValidUrl),1)):d("",!0),r.analyzerStore.analyzer==="competitor-site"&&r.analyzerStore.analyzeError?(c(),u("div",{key:1,class:"analyze-errors aioseo-description aioseo-error",innerHTML:r.analyzerStore.analyzeError},null,8,ye)):d("",!0)]),_:1},8,["header","description","inputError","isAnalyzing","analyzeTime","onStartAnalyzing"])]),_:1})])}const Xe=k(pe,[["render",fe]]);export{Xe as default};

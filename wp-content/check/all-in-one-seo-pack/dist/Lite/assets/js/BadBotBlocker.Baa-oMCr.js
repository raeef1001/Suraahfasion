import{a as b,u as _}from"./links.BdfvOpfI.js";import{B}from"./Textarea.BgYpy-yd.js";import{C as g}from"./Caret.iRBf3wcH.js";import{C as f}from"./Card.CacAhFkZ.js";import{C as S}from"./SettingsRow.DQldd-1Z.js";import{x as i,c as h,C as r,m as l,o as c,l as d,d as p}from"./vue.esm-bundler.CWQFYt9y.js";import{_ as V}from"./_plugin-vue_export-helper.BN1snXvA.js";import"./default-i18n.Bd0Z306Z.js";import"./helpers.pkmhnyB1.js";import"./Tooltip.Jp05nfCy.js";import"./index.BQgiQQKQ.js";import"./Slide.CRIn0kdn.js";import"./Row.CzuhYwfs.js";const x={setup(){return{optionsStore:b(),rootStore:_()}},components:{BaseTextarea:B,CoreAlert:g,CoreCard:f,CoreSettingsRow:S},data(){return{strings:{badBotBlocker:this.$t.__("Bad Bot Blocker",this.$td),blockBadBotsHttp:this.$t.__("Block Bad Bots using HTTP",this.$td),blockReferralSpamHttp:this.$t.__("Block Referral Spam using HTTP",this.$td),trackBlockedBots:this.$t.__("Track Blocked Bots",this.$td),useCustomBlocklists:this.$t.__("Use Custom Blocklists",this.$td),userAgentBlocklist:this.$t.__("User Agent Blocklist",this.$td),refererBlockList:this.$t.__("Referer Blocklist",this.$td),blockedBotsLog:this.$t.__("Blocked Bots Log",this.$td),logLocation:this.$t.sprintf(this.$t.__("The log for the blocked bots is located here: %1$s",this.$td),'<br><a href="'+this.rootStore.aioseo.urls.blockedBotsLogUrl+'" target="_blank">'+this.rootStore.aioseo.urls.blockedBotsLogUrl+"</a>")}}}},C={class:"aioseo-tools-bad-bot-blocker"};function y(H,t,L,o,s,R){const a=i("base-toggle"),n=i("core-settings-row"),m=i("base-textarea"),k=i("core-alert"),u=i("core-card");return c(),h("div",C,[r(u,{slug:"badBotBlocker","header-text":s.strings.badBotBlocker},{default:l(()=>[r(n,{name:s.strings.blockBadBotsHttp},{content:l(()=>[r(a,{modelValue:o.optionsStore.options.deprecated.tools.blocker.blockBots,"onUpdate:modelValue":t[0]||(t[0]=e=>o.optionsStore.options.deprecated.tools.blocker.blockBots=e)},null,8,["modelValue"])]),_:1},8,["name"]),r(n,{name:s.strings.blockReferralSpamHttp},{content:l(()=>[r(a,{modelValue:o.optionsStore.options.deprecated.tools.blocker.blockReferer,"onUpdate:modelValue":t[1]||(t[1]=e=>o.optionsStore.options.deprecated.tools.blocker.blockReferer=e)},null,8,["modelValue"])]),_:1},8,["name"]),o.optionsStore.options.deprecated.tools.blocker.blockBots||o.optionsStore.options.deprecated.tools.blocker.blockReferer?(c(),d(n,{key:0,name:s.strings.useCustomBlocklists},{content:l(()=>[r(a,{modelValue:o.optionsStore.options.deprecated.tools.blocker.custom.enable,"onUpdate:modelValue":t[2]||(t[2]=e=>o.optionsStore.options.deprecated.tools.blocker.custom.enable=e)},null,8,["modelValue"])]),_:1},8,["name"])):p("",!0),o.optionsStore.options.deprecated.tools.blocker.blockBots&&o.optionsStore.options.deprecated.tools.blocker.custom.enable?(c(),d(n,{key:1,name:s.strings.userAgentBlocklist},{content:l(()=>[r(m,{minHeight:200,maxHeight:200,modelValue:o.optionsStore.options.deprecated.tools.blocker.custom.bots,"onUpdate:modelValue":t[3]||(t[3]=e=>o.optionsStore.options.deprecated.tools.blocker.custom.bots=e)},null,8,["modelValue"])]),_:1},8,["name"])):p("",!0),o.optionsStore.options.deprecated.tools.blocker.blockReferer&&o.optionsStore.options.deprecated.tools.blocker.custom.enable?(c(),d(n,{key:2,name:s.strings.refererBlockList},{content:l(()=>[r(m,{minHeight:200,maxHeight:200,modelValue:o.optionsStore.options.deprecated.tools.blocker.custom.referer,"onUpdate:modelValue":t[4]||(t[4]=e=>o.optionsStore.options.deprecated.tools.blocker.custom.referer=e)},null,8,["modelValue"])]),_:1},8,["name"])):p("",!0),o.optionsStore.options.deprecated.tools.blocker.blockBots||o.optionsStore.options.deprecated.tools.blocker.blockReferer?(c(),d(n,{key:3,name:s.strings.trackBlockedBots},{content:l(()=>[r(a,{modelValue:o.optionsStore.options.deprecated.tools.blocker.track,"onUpdate:modelValue":t[5]||(t[5]=e=>o.optionsStore.options.deprecated.tools.blocker.track=e)},null,8,["modelValue"]),r(k,{type:"blue",innerHTML:s.strings.logLocation},null,8,["innerHTML"])]),_:1},8,["name"])):p("",!0)]),_:1},8,["header-text"])])}const D=V(x,[["render",y]]);export{D as default};

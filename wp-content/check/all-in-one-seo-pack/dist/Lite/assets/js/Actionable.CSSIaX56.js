import{o as n,c as y,a as o,x as C,l,m as u,u as a,d as i,t as r,D as m,G as f}from"./vue.esm-bundler.CWQFYt9y.js";import{C as g}from"./Caret.iRBf3wcH.js";import{S as p}from"./CheckSolid.ChbVSAiM.js";import{_ as b}from"./_plugin-vue_export-helper.BN1snXvA.js";const k={},x={viewBox:"0 0 30 30",fill:"currentColor",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-circle-exclamation-solid"},w=o("path",{d:"M 15.0005 2.84 C 8.1005 2.84 2.5005 8.44 2.5005 15.34 C 2.5005 22.24 8.1005 27.84 15.0005 27.84 C 21.9005 27.84 27.5005 22.24 27.5005 15.34 C 27.5005 8.44 21.9005 2.84 15.0005 2.84 Z M 16.2505 21.59 H 13.7505 V 19.09 H 16.2505 V 21.6 Z M 16.2505 16.59 H 13.7505 V 9.09 H 16.2505 V 16.59 Z"},null,-1),S=[w];function _(t,s){return n(),y("svg",x,S)}const h=b(k,[["render",_]]),v={class:"aioseo-alert-actionable__content"},$=o("span",null,"→",-1),H={__name:"Actionable",props:{title:String,text:String,button:String,buttonType:String,type:String,size:String,showClose:Boolean},emits:["click","close-alert"],setup(t){return(s,e)=>{const d=C("base-button");return n(),l(a(g),{class:"aioseo-alert-actionable",type:t.type,size:t.size,showClose:t.showClose,onCloseAlert:e[2]||(e[2]=c=>s.$emit("close-alert"))},{default:u(()=>[t.type==="yellow"?(n(),l(a(h),{key:0})):i("",!0),t.type==="green"?(n(),l(a(p),{key:1})):i("",!0),o("div",v,[o("strong",null,r(t.title),1),o("p",null,[m(r(t.text)+" ",1),t.buttonType==="link"&&t.button?(n(),y("a",{key:0,href:"#",onClick:e[0]||(e[0]=f(c=>s.$emit("click"),["prevent"]))},[m(r(t.button)+" ",1),$])):i("",!0)]),t.buttonType!=="link"&&t.button?(n(),l(d,{key:0,size:"medium",type:"blue",tag:"button",onClick:e[1]||(e[1]=f(c=>s.$emit("click"),["stop"]))},{default:u(()=>[o("span",null,r(t.button),1)]),_:1})):i("",!0)])]),_:1},8,["type","size","showClose"])}}};export{H as _};

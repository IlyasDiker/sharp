import{d as p,C as m,c as _,w as a,o as d,a as s,b as o,t as l,u as e,_ as r,e as c,h,i as g,j as f,L as $,k as b,l as v,m as V,n as x,r as y}from"./sharp-DDNPuC1w.js";import{_ as T,a as k,b as w}from"./FormItem.vue_vue_type_script_setup_true_lang-DaBtyhPx.js";import{_ as C}from"./Title.vue_vue_type_script_setup_true_lang-MxfiLW2l.js";import"./CardDescription.vue_vue_type_script_setup_true_lang-BVFKuiG8.js";const L=["innerHTML"],H=p({__name:"Login2Fa",props:{helpText:{}},setup(N){const t=m({code:""});return(i,n)=>(d(),_(T,null,{default:a(()=>[s(C,null,{default:a(()=>[o(l(e(r)("sharp::pages/auth/login.title")),1)]),_:1}),e(t).hasErrors?(d(),_(e(c),{key:0,class:"mb-4",variant:"destructive"},{default:a(()=>[s(e(h),null,{default:a(()=>[o(l(Object.values(e(t).errors)[0]),1)]),_:1})]),_:1})):g("",!0),f("form",{onSubmit:n[1]||(n[1]=x(u=>e(t).post(e(y)("code16.sharp.login.2fa.post")),["prevent"]))},[s(w,null,$({title:a(()=>[o(l(e(r)("sharp::pages/auth/login.title")),1)]),footer:a(()=>[s(e(b),{type:"submit",class:"w-full"},{default:a(()=>[o(l(e(r)("sharp::pages/auth/login.button")),1)]),_:1})]),default:a(()=>[s(e(k),null,{default:a(()=>[s(e(v),{for:"code"},{default:a(()=>[o(l(e(r)("sharp::pages/auth/login.code_field")),1)]),_:1}),s(e(V),{type:"text",id:"code",modelValue:e(t).code,"onUpdate:modelValue":n[0]||(n[0]=u=>e(t).code=u)},null,8,["modelValue"])]),_:1})]),_:2},[i.helpText?{name:"description",fn:a(()=>[f("div",{class:"space-y-2",innerHTML:i.helpText},null,8,L)]),key:"0"}:void 0]),1024)],32)]),_:1}))}});export{H as default};

import{d as N,r as s,aO as V,ak as y,at as $,aP as A,c as k,w as o,aB as D,o as a,u as e,J as U,i as B,a as d,b as n,t as i,j,k as C,X as z,A as m,_ as l,F as u,aM as E}from"./sharp-DRS6fWHa.js";import{_ as M}from"./Title.vue_vue_type_script_setup_true_lang-COGK2pqh.js";import{_ as O}from"./PageBreadcrumb.vue_vue_type_script_setup_true_lang-M09RaouY.js";const P={class:"flex gap-4"},J=N({__name:"Form",props:{form:{},breadcrumb:{},errors:{}},setup(K){const f=K,{entityKey:I,instanceId:g}=s().params,r=new V(f.form,I,g),b=y(!1),p=y(!1),v=y("");$(()=>r.errors,()=>{Object.keys(r.errors).length===0&&(p.value=!1)},{deep:!0});function w(){const{parentUri:t,entityKey:_,instanceId:h}=s().params,c=()=>{b.value=!0},F=()=>{b.value=!1},S=()=>{r.errors=f.errors,p.value=!0,v.value=f.errors.error};s().current("code16.sharp.form.create")?E.post(s("code16.sharp.form.store",{parentUri:t,entityKey:_}),r.serializedData,{onStart:c,onFinish:F,onError:S}):s().current("code16.sharp.form.edit")&&E.post(s("code16.sharp.form.update",{parentUri:t,entityKey:_,instanceId:h}),r.serializedData,{onStart:c,onFinish:F,onError:S})}return(t,_)=>{const h=A("SharpForm");return a(),k(D,null,{breadcrumb:o(()=>[e(U)("sharp.display_breadcrumb")?(a(),k(O,{key:0,breadcrumb:t.breadcrumb},null,8,["breadcrumb"])):B("",!0)]),default:o(()=>[d(M,{breadcrumb:t.breadcrumb},null,8,["breadcrumb"]),d(h,{form:e(r),"show-error-alert":p.value,"error-alert-message":v.value,onSubmit:w},{title:o(()=>[n(i(t.breadcrumb.items.at(-1).documentTitleLabel),1)]),footer:o(()=>[j("div",P,[d(e(C),{variant:"outline","as-child":""},{default:o(()=>{var c;return[d(e(z),{href:(c=t.breadcrumb.items.at(-2))==null?void 0:c.url},{default:o(()=>[e(r).canEdit?(a(),m(u,{key:0},[n(i(e(l)("sharp::action_bar.form.cancel_button")),1)],64)):(a(),m(u,{key:1},[n(i(e(l)("sharp::action_bar.form.back_button")),1)],64))]),_:1},8,["href"])]}),_:1}),e(r).canEdit?(a(),k(e(C),{key:0,style:{"min-width":"6.5em"},disabled:e(r).isUploading||b.value,onClick:w},{default:o(()=>[e(r).isUploading?(a(),m(u,{key:0},[n(i(e(l)("sharp::action_bar.form.submit_button.pending.upload")),1)],64)):e(g)||e(r).config.isSingle?(a(),m(u,{key:1},[n(i(e(l)("sharp::action_bar.form.submit_button.update")),1)],64)):(a(),m(u,{key:2},[n(i(e(l)("sharp::action_bar.form.submit_button.create")),1)],64))]),_:1},8,["disabled"])):B("",!0)])]),_:1},8,["form","show-error-alert","error-alert-message"])]),_:1})}}});export{J as default};

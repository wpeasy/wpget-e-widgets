import{c as r}from"./index.75e44163.js";const t={left:"start",center:"center",right:"end",between:"between",around:"around",evenly:"evenly",stretch:"stretch"},a=Object.keys(t),l={align:{type:String,validator:e=>a.includes(e)}};function c(e){return r(()=>{const n=e.align===void 0?e.vertical===!0?"stretch":"left":e.align;return`${e.vertical===!0?"items":"justify"}-${t[n]}`})}export{l as a,c as u};

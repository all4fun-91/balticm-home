const BACKEND = "https://balticm-home-preview.all4fun91.workers.dev";

function readBody(req) {
  return new Promise((resolve, reject) => {
    const chunks = [];
    req.on("data", chunk => chunks.push(Buffer.isBuffer(chunk) ? chunk : Buffer.from(chunk)));
    req.on("end", () => resolve(chunks.length ? Buffer.concat(chunks) : undefined));
    req.on("error", reject);
  });
}

function rewriteCookie(value, host) {
  if (!host || host === "balticm.eu" || host.endsWith(".balticm.eu")) return value;
  return value.replace(/;\s*Domain=\.balticm\.eu/gi, "");
}

function injectShell(html) {
  const css = `<style id="balticm-shell-v2">
:root{color-scheme:dark}
html,body{background:#02050b!important;color:#edf6ff!important}
body{font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif!important}
.home-topbar{background:rgba(2,7,15,.9)!important;border-bottom:1px solid rgba(70,180,255,.16)!important;backdrop-filter:blur(18px)!important;box-shadow:0 10px 35px rgba(0,0,0,.2)!important}
.home-nav a{transition:color .2s,background .2s,border-color .2s!important}
.home-nav a:hover{color:#fff!important;background:rgba(55,176,255,.08)!important}
.home-nav a.active{color:#fff!important}
.home-card,.card,.panel,.profile-card,.message-card,.notification-card{border-color:rgba(75,175,255,.18)!important;box-shadow:0 16px 45px rgba(0,0,0,.22)!important}
button,.btn,input,textarea,select{font:inherit}
input,textarea,select{background:rgba(3,11,21,.9)!important;color:#edf6ff!important;border-color:rgba(82,150,205,.25)!important}
button,.btn{transition:transform .18s,filter .18s,border-color .18s!important}
button:hover,.btn:hover{transform:translateY(-1px)!important}
main{scroll-margin-top:90px}
@media(max-width:760px){.home-topbar{padding-left:12px!important;padding-right:12px!important}.home-nav{gap:2px!important}.home-nav a{padding:8px 7px!important;font-size:9px!important}}
</style>`;
  if(html.includes('id="balticm-shell-v2"')) return html.replace(/<style id="balticm-shell-v2">[\s\S]*?<\/style>/,css);
  return html.includes('</head>')?html.replace('</head>',css+'</head>'):html;
}

function polishProfile(html){
  const patch=`<style id="balticm-profile-v2">
body{background:radial-gradient(circle at 50% -10%,rgba(43,126,255,.13),transparent 38%),#02050b!important}
.bm-profile-back,.bm-profile-logout{position:fixed!important;top:20px!important;z-index:99999!important;height:40px!important;display:inline-flex!important;align-items:center!important;border-radius:10px!important;font:800 10px/1 Inter,system-ui,sans-serif!important;letter-spacing:.08em!important;text-decoration:none!important;box-sizing:border-box!important}
.bm-profile-back{left:20px!important;padding:0 14px!important;background:rgba(4,12,23,.94)!important;border:1px solid rgba(87,176,255,.42)!important;color:#e9f4ff!important}
.bm-profile-logout{right:20px!important;padding:0 14px!important;background:rgba(25,7,13,.94)!important;border:1px solid rgba(255,89,108,.38)!important;color:#fff!important}
.bm-profile-back:hover{border-color:rgba(87,200,255,.8)!important;transform:translateY(-1px)!important}
.bm-profile-logout:hover{border-color:rgba(255,106,124,.85)!important;transform:translateY(-1px)!important}
@media(max-width:600px){.bm-profile-back,.bm-profile-logout{top:10px!important;height:36px!important;padding:0 10px!important;font-size:8px!important}.bm-profile-back{left:10px!important}.bm-profile-logout{right:10px!important}}
</style>`;
  if(html.includes('id="balticm-profile-v2"')) return html;
  return html.includes('</head>')?html.replace('</head>',patch+'</head>'):html+patch;
}

function rewriteDynamicLinks(html){
  return html.replace(/href=["'](?:https?:\/\/balticm\.eu)?\/(forum|profile|messages|notifications|friends|online|statistics|about|servers|search|login|logout)([^"']*)["']/gi,(m,path,rest)=>`href="/${path}${rest}"`);
}

export default async function handler(req,res){
  try{
    const incoming=new URL(req.url||"/",`https://${req.headers.host||"balticm-home.vercel.app"}`);
    const target=new URL(incoming.pathname+incoming.search,BACKEND);
    const headers=new Headers();
    for(const [key,value] of Object.entries(req.headers||{})){
      if(["host","content-length","connection"].includes(key.toLowerCase()))continue;
      if(Array.isArray(value))headers.set(key,value.join(", "));else if(value!=null)headers.set(key,value);
    }
    headers.set("x-forwarded-host",incoming.host);headers.set("x-forwarded-proto",incoming.protocol.replace(":",""));
    const body=["GET","HEAD"].includes(req.method||"GET")?undefined:await readBody(req);
    const upstream=await fetch(target,{method:req.method||"GET",headers,body,redirect:"manual"});
    res.statusCode=upstream.status;
    const cookies=typeof upstream.headers.getSetCookie==="function"?upstream.headers.getSetCookie():[];
    upstream.headers.forEach((value,key)=>{const lower=key.toLowerCase();if(["content-encoding","set-cookie","content-length"].includes(lower))return;res.setHeader(key,value)});
    if(cookies.length)res.setHeader("Set-Cookie",cookies.map(c=>rewriteCookie(c,incoming.hostname)));
    const location=upstream.headers.get("location");
    if(location){try{const rewritten=new URL(location,BACKEND);if(rewritten.host===new URL(BACKEND).host){rewritten.host=incoming.host;rewritten.protocol=incoming.protocol;res.setHeader("Location",rewritten.toString())}else res.setHeader("Location",location)}catch{res.setHeader("Location",location)}}
    let buffer=Buffer.from(await upstream.arrayBuffer());
    const type=upstream.headers.get("content-type")||"";
    if(type.includes("text/html")){
      let html=buffer.toString("utf8");
      html=rewriteDynamicLinks(html);
      if(incoming.pathname==="/"){
        const patch=`<style id="balticm-home-spacing-v2">.hero{min-height:438px!important}.hero-inner{transform:translateY(-24px)!important}.hero h1{margin-top:7px!important;margin-bottom:6px!important}.eyebrow{margin-bottom:0!important}.lead{margin-top:0!important}.stats{margin-top:-110px!important}@media(max-width:600px){.hero{min-height:423px!important}.hero-inner{transform:translateY(-8px)!important}.hero h1{margin-top:6px!important;margin-bottom:6px!important}.stats{margin-top:-55px!important}}</style>`;
        html=html.includes('id="balticm-home-spacing-v2"')?html.replace(/<style id="balticm-home-spacing-v2">[\s\S]*?<\/style>/,patch):html.replace('</head>',patch+'</head>');
      }
      html=injectShell(html);
      if(incoming.pathname==="/profile")html=polishProfile(html);
      if(["/profile","/forum","/messages","/notifications","/friends","/online","/statistics","/login"].includes(incoming.pathname))res.setHeader("Cache-Control","private, no-store, max-age=0, must-revalidate");
      buffer=Buffer.from(html,"utf8");
    }
    res.end(buffer);
  }catch(error){console.error("BalticM proxy error",error);res.statusCode=502;res.setHeader("Content-Type","text/plain; charset=utf-8");res.end("BalticM backend temporarily unavailable")}
}

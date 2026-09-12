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

const shellCss = `<style id="balticm-shell-v2">
:root{color-scheme:dark}html,body{background:#02050b!important;color:#edf6ff!important}body{font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif!important}a{color:inherit}.home-topbar{background:rgba(2,7,15,.9)!important;border-bottom:1px solid rgba(70,180,255,.16)!important;backdrop-filter:blur(18px)!important;box-shadow:0 10px 35px rgba(0,0,0,.2)!important}.home-nav a{transition:color .2s,background .2s,border-color .2s!important}.home-nav a:hover{color:#fff!important;background:rgba(55,176,255,.08)!important}.home-nav a.active{color:#fff!important}.home-card,.card,.panel,.profile-card,.message-card,.notification-card{border-color:rgba(75,175,255,.18)!important;box-shadow:0 16px 45px rgba(0,0,0,.22)!important}button,.btn,input,textarea,select{font:inherit}input,textarea,select{background:rgba(3,11,21,.9)!important;color:#edf6ff!important;border-color:rgba(82,150,205,.25)!important}button,.btn{transition:transform .18s,filter .18s,border-color .18s!important}button:hover,.btn:hover{transform:translateY(-1px)!important}main{scroll-margin-top:90px}.bm-page{width:min(1180px,calc(100% - 28px));margin:0 auto;padding:100px 0 45px}.bm-panel{border:1px solid rgba(75,175,255,.18);border-radius:16px;background:linear-gradient(145deg,rgba(8,17,29,.97),rgba(3,8,15,.99));box-shadow:0 20px 55px rgba(0,0,0,.3),inset 0 1px 0 rgba(255,255,255,.035);overflow:hidden}.bm-head{padding:28px 30px;border-bottom:1px solid rgba(75,175,255,.12);background:radial-gradient(500px 180px at 85% 0,rgba(43,136,255,.12),transparent 70%)}.bm-kicker{color:#46d8ff;font-size:9px;font-weight:900;letter-spacing:.24em}.bm-head h1{margin:8px 0 8px;font-size:38px;letter-spacing:-.04em}.bm-head p{margin:0;color:#8ea2bb;font-size:12px;line-height:1.6;max-width:760px}.bm-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;padding:18px}.bm-card{padding:20px;border:1px solid rgba(74,145,207,.18);border-radius:13px;background:linear-gradient(145deg,rgba(8,18,31,.96),rgba(3,8,15,.98))}.bm-card h2{margin:0 0 8px;font-size:17px}.bm-card p{margin:0;color:#8fa3bb;font-size:11px;line-height:1.6}.bm-meta{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px}.bm-pill{padding:7px 9px;border:1px solid rgba(75,175,255,.2);border-radius:8px;color:#a8dfff;background:rgba(25,113,180,.08);font-size:8px;font-weight:900;letter-spacing:.08em}.bm-link{display:inline-flex;margin-top:15px;padding:10px 13px;border-radius:9px;border:1px solid rgba(77,181,255,.34);background:linear-gradient(135deg,rgba(39,136,255,.14),rgba(106,69,255,.12));text-decoration:none;font-size:9px;font-weight:900;letter-spacing:.08em}.bm-list{display:grid;gap:9px}.bm-list a{display:flex;justify-content:space-between;align-items:center;gap:15px;padding:13px 14px;border:1px solid rgba(75,145,207,.16);border-radius:10px;text-decoration:none;background:rgba(255,255,255,.018)}.bm-list a:hover{border-color:rgba(77,181,255,.45);background:rgba(55,150,255,.05)}.bm-list b{font-size:11px}.bm-list span{color:#647c98;font-size:9px}.bm-footer{margin-top:20px;padding:22px 0;color:#566b84;font-size:9px;text-align:center;border-top:1px solid rgba(75,175,255,.1)}@media(max-width:700px){.bm-page{width:calc(100% - 16px);padding-top:82px}.bm-grid{grid-template-columns:1fr;padding:12px}.bm-head{padding:23px 20px}.bm-head h1{font-size:30px}}
</style>`;

function homeHeader(active="") {
  const nav = [["Home","/"],["Forum","/forum"],["Servers","/servers"],["Online","/online"],["Statistics","/statistics"],["About","/about"]]
    .map(([name,href])=>`<a class="${active===name.toLowerCase()?"active":""}" href="${href}">${name}</a>`).join("");
  return `<header class="home-topbar" aria-label="BalticM navigation"><a class="home-brand" href="/" aria-label="BalticM Home"><span class="home-mark">BM</span><span><b>BALTICM</b><small>PLAY TOGETHER</small></span></a><nav class="home-nav">${nav}</nav><div class="home-actions"><a class="home-icon home-messages" href="/messages" title="Messages" aria-label="Messages"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h4l4 3 4-3h4a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Z"/><path d="M7 9h10M7 13h6"/></svg></a><a class="home-icon" href="/search" title="Search" aria-label="Search"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="6"/><path d="m16 16 5 5"/></svg></a><a class="home-icon home-notify" href="/notifications" title="Notifications" aria-label="Notifications"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"/></svg><i aria-hidden="true"></i></a><a class="home-login" href="/login">LOGIN</a></div></header>`;
}

function homeFooter() {
  return `<footer style="position:relative;margin-top:0;padding:28px 0 18px;border-top:1px solid rgba(72,160,255,.18);background:linear-gradient(180deg,rgba(3,9,17,.96),#01040a 72%);box-shadow:0 -18px 55px rgba(42,78,170,.08)"><div style="width:min(1180px,calc(100% - 28px));margin:auto;display:flex;align-items:center;justify-content:space-between;gap:22px;flex-wrap:wrap"><div><b style="font-size:16px;letter-spacing:.06em">BALTICM</b><div style="font-size:8px;letter-spacing:.28em;color:#5e7696;margin-top:7px">PLAY TOGETHER</div></div><nav style="display:flex;gap:5px;flex-wrap:wrap;justify-content:center"><a href="/ban-appeal" style="padding:7px 9px;color:#8196b0;text-decoration:none;font-size:9px">Ban Appeal</a><a href="/support" style="padding:7px 9px;color:#8196b0;text-decoration:none;font-size:9px">Support</a><a href="/rules" style="padding:7px 9px;color:#8196b0;text-decoration:none;font-size:9px">Rules</a><a href="/about" style="padding:7px 9px;color:#8196b0;text-decoration:none;font-size:9px">About</a></nav><div style="display:flex;gap:7px"><a href="https://discord.com/invite/y2EGmd5Er5" target="_blank" rel="noopener" aria-label="Discord" style="width:38px;height:38px;border:1px solid rgba(82,112,148,.42);border-radius:10px;display:grid;place-items:center;text-decoration:none">◈</a><a href="https://www.youtube.com/@MiersBerzins" target="_blank" rel="noopener" aria-label="YouTube" style="width:38px;height:38px;border:1px solid rgba(82,112,148,.42);border-radius:10px;display:grid;place-items:center;text-decoration:none">▶</a><a href="https://www.twitch.tv/miersberzins" target="_blank" rel="noopener" aria-label="Twitch" style="width:38px;height:38px;border:1px solid rgba(82,112,148,.42);border-radius:10px;display:grid;place-items:center;text-decoration:none">◉</a></div></div><div style="width:min(1180px,calc(100% - 28px));margin:14px auto 0;padding-top:11px;border-top:1px solid rgba(93,115,145,.11);color:#4e6683;font-size:8px">© 2026 BalticM. All rights reserved.</div></footer>`;
}

function standalonePage(kind) {
  const data = {
    forum: {title:"Forum", kicker:"BALTICM COMMUNITY", desc:"Talk about BalticM, servers, updates and gaming. The forum shell is ready; account actions are kept inside the BalticM login flow.", cards:[
      ["Community", "General BalticM discussion, ideas and community chat.", "GENERAL"],
      ["Baltic Mayhem", "Rust server updates, wipe news, events and gameplay discussion.", "RUST"],
      ["Announcements", "Official BalticM news, platform updates and important notices.", "NEWS"],
      ["Support", "Need help with an account, server or community feature? Start here.", "HELP"]
    ]},
    about: {title:"About BalticM", kicker:"BALTICM • PLAY TOGETHER", desc:"BalticM is a gaming community built around players, creators and community servers — one home for everything we build.", cards:[
      ["Community", "A place to play together, meet people and follow what is happening across BalticM.", "COMMUNITY"],
      ["Baltic Mayhem", "Our EU PvP Rust experience with events, progression and community-focused systems.", "RUST"],
      ["Baltic Servers", "A wider server network for discovering and supporting community game servers.", "SERVERS"],
      ["Built for the community", "We keep improving the platform around real community needs instead of adding noise.", "MISSION"]
    ]}
  }[kind];
  return `<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>${data.title} • BalticM</title>${shellCss}</head><body>${homeHeader(kind)}<main class="bm-page"><section class="bm-panel"><div class="bm-head"><div class="bm-kicker">${data.kicker}</div><h1>${data.title}</h1><p>${data.desc}</p></div><div class="bm-grid">${data.cards.map(([title,text,pill])=>`<article class="bm-card"><h2>${title}</h2><p>${text}</p><div class="bm-meta"><span class="bm-pill">${pill}</span><span class="bm-pill">PLAY TOGETHER</span></div><a class="bm-link" href="${title==="Support"?"/login":title==="Baltic Mayhem"?"https://rust.balticm.eu/":"/login"}">${title==="Support"?"GET HELP":"EXPLORE"} →</a></article>`).join("")}</div></section><div class="bm-footer">BalticM community platform • ${data.title}</div></main>${homeFooter()}</body></html>`;
}

function standaloneUtility(kind) {
  const isOnline = kind === "online";
  return `<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>${isOnline?"Online":"Statistics"} • BalticM</title>${shellCss}</head><body>${homeHeader(kind)}<main class="bm-page"><section class="bm-panel"><div class="bm-head"><div class="bm-kicker">BALTICM ${isOnline?"ONLINE":"STATISTICS"}</div><h1>${isOnline?"Online":"Statistics"}</h1><p>${isOnline?"A clean place for BalticM presence and community activity. Live account presence will appear here as the accounts system is connected.":"A central view for BalticM account activity and profile statistics. Visitor tracking will appear here when the accounts system is connected."}</p></div><div class="bm-grid"><article class="bm-card"><h2>${isOnline?"ONLINE NOW":"PROFILE VIEWS"}</h2><p>${isOnline?"Presence tracking is not yet connected, so no live count is shown instead of displaying a fake number.":"Profile visitor tracking is not yet connected, so the page deliberately shows a clear status rather than invented statistics."}</p><div class="bm-meta"><span class="bm-pill">COMING WITH ACCOUNTS</span><span class="bm-pill">NO FAKE DATA</span></div></article><article class="bm-card"><h2>WHAT'S NEXT</h2><p>${isOnline?"Connect BalticM accounts and presence events to show real online users, status and last activity.":"Connect the account activity feed to show real profile views and useful trends."}</p><a class="bm-link" href="/login">OPEN ACCOUNT LOGIN →</a></article></div></section></main>${homeFooter()}</body></html>`;
}

function injectShell(html){
  if(html.includes('id="balticm-shell-v2"')) return html.replace(/<style id="balticm-shell-v2">[\s\S]*?<\/style>/,shellCss);
  return html.includes('</head>')?html.replace('</head>',shellCss+'</head>'):html;
}

function polishProfile(html){
  const patch=`<style id="balticm-profile-v2">body{background:radial-gradient(circle at 50% -10%,rgba(43,126,255,.13),transparent 38%),#02050b!important}.bm-profile-back{position:fixed!important;left:20px!important;top:20px!important;z-index:99999!important;height:40px!important;display:inline-flex!important;align-items:center!important;padding:0 14px!important;border-radius:10px!important;font:800 10px/1 Inter,system-ui,sans-serif!important;letter-spacing:.08em!important;text-decoration:none!important;box-sizing:border-box!important;background:rgba(4,12,23,.94)!important;border:1px solid rgba(87,176,255,.42)!important;color:#e9f4ff!important}.bm-profile-back:hover{border-color:rgba(87,200,255,.8)!important;transform:translateY(-1px)!important}@media(max-width:600px){.bm-profile-back{left:10px!important;top:10px!important;height:36px!important;padding:0 10px!important;font-size:8px!important}}</style>`;
  if(html.includes('id="balticm-profile-v2"')) return html;
  const button='<a class="bm-profile-back" href="/">← BACK TO BALTICM</a>';
  html=html.includes('class="bm-profile-back"')?html:html.replace('<body>','<body>'+button);
  return html.includes('</head>')?html.replace('</head>',patch+'</head>'):html+patch;
}

function rewriteDynamicLinks(html){
  return html.replace(/href=["'](?:https?:\/\/balticm\.eu)?\/(forum|profile|messages|notifications|friends|online|statistics|about|servers|search|login|logout)([^"']*)["']/gi,(m,path,rest)=>`href="/${path}${rest}"`);
}

export default async function handler(req,res){
  try{
    const incoming=new URL(req.url||"/",`https://${req.headers.host||"balticm-home.vercel.app"}`);
    if(req.method === "GET" && incoming.pathname === "/forum"){res.statusCode=200;res.setHeader("Content-Type","text/html; charset=utf-8");res.setHeader("Cache-Control","private, no-store, max-age=0, must-revalidate");return res.end(standalonePage("forum"));}
    if(req.method === "GET" && incoming.pathname === "/about"){res.statusCode=200;res.setHeader("Content-Type","text/html; charset=utf-8");res.setHeader("Cache-Control","public, max-age=60");return res.end(standalonePage("about"));}
    if(req.method === "GET" && (incoming.pathname === "/online" || incoming.pathname === "/statistics")){res.statusCode=200;res.setHeader("Content-Type","text/html; charset=utf-8");res.setHeader("Cache-Control","private, no-store, max-age=0, must-revalidate");return res.end(standaloneUtility(incoming.pathname.slice(1)));}

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
      if(["/profile","/messages","/notifications","/friends","/online","/statistics","/login"].includes(incoming.pathname))res.setHeader("Cache-Control","private, no-store, max-age=0, must-revalidate");
      buffer=Buffer.from(html,"utf8");
    }
    res.end(buffer);
  }catch(error){console.error("BalticM proxy error",error);res.statusCode=502;res.setHeader("Content-Type","text/plain; charset=utf-8");res.end("BalticM backend temporarily unavailable");}
}

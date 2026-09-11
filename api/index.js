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

function tightenHomepage(html) {
  const patch = `<style id="balticm-home-hero-spacing">
.hero{min-height:438px!important}
.hero-inner{transform:translateY(-24px)!important}
.hero h1{margin-top:7px!important;margin-bottom:6px!important}
.eyebrow{margin-bottom:0!important}
.lead{margin-top:0!important}
.stats{margin-top:-110px!important}
@media(max-width:600px){.hero{min-height:423px!important}.hero-inner{transform:translateY(-8px)!important}.hero h1{margin-top:6px!important;margin-bottom:6px!important}.stats{margin-top:-55px!important}}
</style>`;
  if (html.includes('id="balticm-home-hero-spacing"')) return html.replace(/<style id="balticm-home-hero-spacing">[\s\S]*?<\/style>/, patch);
  return html.includes("</head>") ? html.replace("</head>", patch + "</head>") : html;
}

function injectProfileAvatar(html) {
  const patch = `<script id="balticm-profile-avatar-sync">
(async()=>{try{
  const target=document.querySelector('.home-avatar');
  if(!target)return;
  const r=await fetch('/profile?avatar_sync=1',{credentials:'include',cache:'no-store'});
  if(!r.ok)return;
  const text=await r.text();
  const doc=new DOMParser().parseFromString(text,'text/html');
  let src='';
  const img=doc.querySelector('.avatar img')||doc.querySelector('.hero-avatar img')||doc.querySelector('.avatar img[src]');
  if(img?.getAttribute('src'))src=img.getAttribute('src');
  if(!src){
    const box=doc.querySelector('.avatar')||doc.querySelector('.hero-avatar');
    if(box){
      const raw=box.getAttribute('style')||'';
      const m=raw.match(/url\\([\\"']?([^\\)\\"']+)[\\"']?\\)/i);
      if(m)src=m[1];
      if(!src)src=box.getAttribute('data-avatar')||box.getAttribute('data-avatar-url')||box.getAttribute('data-src')||'';
    }
  }
  if(!src){
    const candidate=doc.querySelector('img[src*="steamcommunity.com"],img[src*="steamstatic.com"],img[src*="discordapp.com"],img[src*="discordapp.net"],img[src*="cdn.discordapp.com"]');
    if(candidate?.src)src=candidate.src;
  }
  if(!src)return;
  target.innerHTML='';
  const a=document.createElement('img');
  a.src=src;
  a.alt='';
  a.referrerPolicy='no-referrer';
  a.style.width='100%';
  a.style.height='100%';
  a.style.objectFit='cover';
  a.style.borderRadius='7px';
  target.appendChild(a);
}catch{}})();
</script>`;
  if (html.includes('id="balticm-profile-avatar-sync"')) return html.replace(/<script id="balticm-profile-avatar-sync">[\s\S]*?<\/script>/, patch);
  return html.includes("</body>") ? html.replace("</body>", patch + "</body>") : html + patch;
}

function polishProfile(html) {
  const patch = `<style id="balticm-profile-nav-polish">
.bm-profile-back{position:fixed!important;left:24px!important;top:24px!important;z-index:99999!important;height:42px!important;display:inline-flex!important;align-items:center!important;gap:8px!important;padding:0 15px!important;border:1px solid rgba(87,176,255,.42)!important;border-radius:10px!important;background:rgba(4,12,23,.92)!important;color:#e9f4ff!important;text-decoration:none!important;font:800 10px/1 Inter,system-ui,sans-serif!important;letter-spacing:.08em!important;box-shadow:0 8px 28px rgba(0,0,0,.3),inset 0 1px 0 rgba(255,255,255,.06)!important;backdrop-filter:blur(12px)!important}
.bm-profile-logout{position:fixed!important;right:24px!important;top:24px!important;z-index:99999!important;height:42px!important;display:inline-flex!important;align-items:center!important;justify-content:center!important;padding:0 15px!important;border:1px solid rgba(255,89,108,.38)!important;border-radius:10px!important;background:rgba(25,7,13,.92)!important;color:#fff!important;text-decoration:none!important;font:800 10px/1 Inter,system-ui,sans-serif!important;letter-spacing:.08em!important;box-shadow:0 8px 28px rgba(0,0,0,.3),inset 0 1px 0 rgba(255,255,255,.06)!important;backdrop-filter:blur(12px)!important}
.bm-profile-back:hover{border-color:rgba(87,200,255,.8)!important;transform:translateY(-1px)}
.bm-profile-logout:hover{border-color:rgba(255,106,124,.85)!important;background:rgba(45,9,18,.95)!important;transform:translateY(-1px)}
@media(max-width:600px){.bm-profile-back,.bm-profile-logout{top:12px!important;height:38px!important;padding:0 11px!important;font-size:9px!important}.bm-profile-back{left:12px!important}.bm-profile-logout{right:12px!important}}
</style>
<script id="balticm-profile-nav-polish-script">
(()=>{
  const text=n=>(n?.textContent||'').replace(/\\s+/g,' ').trim().toUpperCase();
  document.querySelectorAll('a,button').forEach(el=>{const t=text(el);if(t==='BACK HOME'||t==='HOME'&&/profile/i.test(location.pathname))el.style.display='none'});
  const old=document.querySelector('.bm-profile-back'); if(old)old.remove();
  const oldOut=document.querySelector('.bm-profile-logout'); if(oldOut)oldOut.remove();
  const back=document.createElement('a');back.className='bm-profile-back';back.href='/';back.textContent='← BACK TO BALTICM';document.body.appendChild(back);
  const out=document.createElement('a');out.className='bm-profile-logout';out.href='/logout';out.textContent='LOGOUT';document.body.appendChild(out);
})();
</script>`;
  if (html.includes('id="balticm-profile-nav-polish"')) return html;
  return html.includes("</head>") ? html.replace("</head>", patch + "</head>") : html + patch;
}

export default async function handler(req, res) {
  try {
    const incoming = new URL(req.url || "/", `https://${req.headers.host || "balticm-home.vercel.app"}`);
    const target = new URL(incoming.pathname + incoming.search, BACKEND);
    const headers = new Headers();

    for (const [key, value] of Object.entries(req.headers || {})) {
      if (["host", "content-length", "connection"].includes(key.toLowerCase())) continue;
      if (Array.isArray(value)) headers.set(key, value.join(", "));
      else if (value != null) headers.set(key, value);
    }

    headers.set("x-forwarded-host", incoming.host);
    headers.set("x-forwarded-proto", incoming.protocol.replace(":", ""));

    const body = ["GET", "HEAD"].includes(req.method || "GET") ? undefined : await readBody(req);
    const upstream = await fetch(target, {
      method: req.method || "GET",
      headers,
      body,
      redirect: "manual"
    });

    res.statusCode = upstream.status;

    const setCookies = typeof upstream.headers.getSetCookie === "function"
      ? upstream.headers.getSetCookie()
      : [];

    upstream.headers.forEach((value, key) => {
      const lower = key.toLowerCase();
      if (lower === "content-encoding" || lower === "set-cookie" || lower === "content-length") return;
      res.setHeader(key, value);
    });

    if (setCookies.length) {
      res.setHeader("Set-Cookie", setCookies.map(cookie => rewriteCookie(cookie, incoming.hostname)));
    }

    const location = upstream.headers.get("location");
    if (location) {
      try {
        const rewritten = new URL(location, BACKEND);
        if (rewritten.host === new URL(BACKEND).host) {
          rewritten.host = incoming.host;
          rewritten.protocol = incoming.protocol;
          res.setHeader("Location", rewritten.toString());
        } else {
          res.setHeader("Location", location);
        }
      } catch {
        res.setHeader("Location", location);
      }
    }

    let buffer = Buffer.from(await upstream.arrayBuffer());
    const contentType = upstream.headers.get("content-type") || "";
    if (contentType.includes("text/html")) {
      let html = buffer.toString("utf8");
      if (incoming.pathname === "/") {
        html = tightenHomepage(html);
        html = injectProfileAvatar(html);
      }
      if (incoming.pathname === "/profile") html = polishProfile(html);
      buffer = Buffer.from(html, "utf8");
      if (["/profile","/forum","/messages","/notifications","/friends","/online","/statistics","/login"].includes(incoming.pathname)) {
        res.setHeader("Cache-Control", "private, no-store, max-age=0, must-revalidate");
      }
    }
    res.end(buffer);
  } catch (error) {
    console.error("BalticM backend proxy error", error);
    res.statusCode = 502;
    res.setHeader("Content-Type", "text/plain; charset=utf-8");
    res.end("BalticM backend temporarily unavailable");
  }
}
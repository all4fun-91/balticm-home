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

    // Preserve every Set-Cookie header and make the login session usable on
    // the temporary Vercel hostname as well as the final balticm.eu domain.
    const setCookies = typeof upstream.headers.getSetCookie === "function"
      ? upstream.headers.getSetCookie()
      : [];

    upstream.headers.forEach((value, key) => {
      const lower = key.toLowerCase();
      if (lower === "content-encoding" || lower === "set-cookie") return;
      res.setHeader(key, value);
    });

    if (setCookies.length) {
      res.setHeader("Set-Cookie", setCookies.map(cookie => rewriteCookie(cookie, incoming.hostname)));
    }

    // Keep OAuth redirects on the public host instead of exposing the
    // Cloudflare worker origin behind the Vercel proxy.
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

    const buffer = Buffer.from(await upstream.arrayBuffer());
    res.end(buffer);
  } catch (error) {
    console.error("BalticM backend proxy error", error);
    res.statusCode = 502;
    res.setHeader("Content-Type", "text/plain; charset=utf-8");
    res.end("BalticM backend temporarily unavailable");
  }
}

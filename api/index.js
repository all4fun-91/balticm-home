const BACKEND = "https://balticm-home-preview.all4fun91.workers.dev";

function readBody(req) {
  return new Promise((resolve, reject) => {
    const chunks = [];
    req.on("data", chunk => chunks.push(Buffer.isBuffer(chunk) ? chunk : Buffer.from(chunk)));
    req.on("end", () => resolve(chunks.length ? Buffer.concat(chunks) : undefined));
    req.on("error", reject);
  });
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
    const upstream = await fetch(target, { method: req.method || "GET", headers, body, redirect: "manual" });
    res.statusCode = upstream.status;
    upstream.headers.forEach((value, key) => {
      if (key.toLowerCase() === "content-encoding") return;
      res.setHeader(key, value);
    });
    const location = upstream.headers.get("location");
    if (location && location.includes("balticm-home-preview.all4fun91.workers.dev")) {
      const rewritten = new URL(location);
      rewritten.host = incoming.host;
      rewritten.protocol = incoming.protocol;
      res.setHeader("Location", rewritten.toString());
    }
    res.end(Buffer.from(await upstream.arrayBuffer()));
  } catch (error) {
    console.error("BalticM backend proxy error", error);
    res.statusCode = 502;
    res.setHeader("Content-Type", "text/plain; charset=utf-8");
    res.end("BalticM backend temporarily unavailable");
  }
}

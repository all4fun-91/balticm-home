import { renderHomeFinal } from "../src/home-final.js";

export default function handler(req, res) {
  const url = new URL(req.url || "/", `https://${req.headers.host || "balticm-home.vercel.app"}`);
  if (url.pathname !== "/") {
    res.statusCode = 404;
    res.setHeader("Content-Type", "text/plain; charset=utf-8");
    return res.end("Not found");
  }
  res.statusCode = 200;
  res.setHeader("Content-Type", "text/html; charset=utf-8");
  res.setHeader("Cache-Control", "no-store");
  res.end(renderHomeFinal());
}

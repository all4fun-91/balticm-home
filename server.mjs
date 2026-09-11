import http from "node:http";
import handler from "./api/index.js";

const port = Number(process.env.PORT || 3000);
const host = process.env.HOST || "0.0.0.0";

const server = http.createServer((req, res) => {
  handler(req, res).catch((error) => {
    console.error("BalticM server error:", error);
    if (!res.headersSent) res.statusCode = 500;
    res.end("BalticM server error");
  });
});

server.listen(port, host, () => {
  console.log(`BalticM listening on http://${host}:${port}`);
});

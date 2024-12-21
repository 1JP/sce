const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"admin.dashboard":{"uri":"admin\/home","methods":["GET","HEAD"]},"api.":{"uri":"api\/user","methods":["GET","HEAD"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };

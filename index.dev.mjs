try {
  await import("http://127.0.0.1:5177/src/index.js");
} catch (err) {
  console.error(
    "[kirbyup] Couldn't connect to the development server. Run `yarn run serve` to start Vite or build the plugin with `yarn run build` so Kirby uses the production version."
  );
  throw err;
}

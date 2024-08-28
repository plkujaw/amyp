# Theme Initialisation and Development

1. Make sure that the theme is cloned into `/wp-content/themes/` folder and it's name changed to 'project-name-theme'.
2. In `package.json` change `"name"` to 'project-name'.
3. In `package.json` add your local setup port number to 
`"config": {
   "localPort": "your-port-number"
   },`.
4. Run `npm install`.
5. Run `npm run build` to create initial dist files.
6. Run `npm run dev` / `gulp watch` to start watch task (without browserSync).
7. Run `npm run dev-sync` / `gulp sync` to start watch task with browserSync.
    - If you're using Local for your local setup and want to use browserSync, in `gulpfile.js` line 68 remove `${package.name}` from the proxy path.
8. **IMPORTANT**: always before pushing changes to git, run `npm build`.

**IMPORTANT** Do not touch files in the `dist` folder, always work only on the files in `src`!

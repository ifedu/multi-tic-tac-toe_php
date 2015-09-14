module.exports = ($) => {
    'use strict'

    const copy = (src, dest) =>
        () =>
            $.gulp.src(src)
            .pipe($.gulp.dest(dest))

    $.gulp.task('copy-assets', copy(`${$.dev.assets}/**/*`, $.deploy.assets))

    $.gulp.task('copy-files', copy([
        `${$.dev.dir}/**/*.php`,
        `${$.dev.dir}/**/.htaccess`
    ], $.deploy.dir))

    $.gulp.task('copy-vendor', copy([`${$.dev.vendor}/**/*`], $.deploy.vendor))

    $.gulp.task('copy', (cb) => $.runSequence(['copy-assets', 'copy-files', 'copy-vendor'], cb))

    $.gulp.task('copy-template', copy(`${$.deploy.js}/templates.js`, $.deploy.tmpJs))
}
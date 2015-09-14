module.exports = ($) => {
    'use strict'

    $.gulp.task('scripts', () =>
        $.gulp
        .src([
            `${$.dev.dir}/**/*.js`,
            `!${$.dev.dir}/**/_*.js`,
            `!${$.dev.dir}/**/_**/**/*.js`
        ])
        .pipe($.changed($.deploy.dir))
        .pipe($.babel())
        .pipe($.gulp.dest($.deploy.dir))
        .pipe($.wrap(
            `(function () {\n
                <%= contents %>\n
            })();`
        ))
        .pipe($.gulp.dest($.deploy.dir))
        .pipe($.ngAnnotate())
        .pipe($.gulp.dest($.deploy.dir))
    )
}
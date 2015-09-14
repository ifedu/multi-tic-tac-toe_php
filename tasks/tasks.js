module.exports = ($) => {
    'use strict'
    $.gulp.task('compiledBase', (cb) => $.runSequence('scripts', ['styles', 'jade', 'copy'], 'templateCache', 'watch', cb))
    $.gulp.task('compiledMin', (cb) => $.runSequence('scripts', ['styles-dist', 'jade-dist', 'copy'], 'copyDeploy', 'templateCache-dist', 'distTask', cb))

    $.gulp.task('analize', (cb) => $.runSequence('compiledBase', 'analysis', cb))
    $.gulp.task('dist', (cb) => $.runSequence('clean', 'compiledMin', 'webserver-dist', cb))
    $.gulp.task('run', (cb) => $.runSequence('clean', 'compiledBase', cb))
    $.gulp.task('test', (cb) => $.runSequence('clean', 'compiledBase', 'scripts-js-test', 'karma', cb))
}
/**
 * Nano Progga Grunt Directives
 *
 * @package     nano progga
 * @version     4.0.0
 */

module.exports = function(grunt) {

    'use strict';

    // @Grunt: Get our configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        /**
         * Validate files with JSHint
         * @url: https://github.com/gruntjs/grunt-contrib-jshint
         */
        jshint: {
            all: [
                'Gruntfile.js',
                'assets/js/nano-progga.js',
                'assets/js/nano-progga-admin.js',
                'assets/js/customizer.js'
            ]
        },

        /**
         * Concatenate & Minify Javascript files
         * @url: https://github.com/gruntjs/grunt-contrib-uglify
         */
        uglify: {
            public: {
                options: {
                    sourceMap: false,
                    preserveComments: /^!/ // Preserve comments that start with a bang.
                },
                files: {
                    'assets/js/nano-progga.min.js': [ 'assets/js/nano-progga.js' ],
                    'assets/js/nano-progga-admin.min.js': [ 'assets/js/nano-progga-admin.js' ]
                },
            }
        },

        /**
         * Compile SCSS files into CSS
         * @url: https://github.com/sindresorhus/grunt-sass/
         */
        sass: {
            dist: {
                options: {
                    sourceMap: false
                },
                files: {
                    'style.css': 'assets/sass/nano-progga.scss',
                    'assets/css/nano-progga-admin.css': 'assets/sass/nano-progga-admin.scss'
                }
            }
        },

        /**
         * Add vendor prefixes
         * @url: https://github.com/nDmitry/grunt-autoprefixer
         */
        autoprefixer: {
            options: {
                cascade: false
            },
            npCSS: {
                src: 'style.css'
            },
            adminCSS: {
                src: 'themes/css/nano-progga-admin.css'
            }
        },

        /**
         * Minify Stylehseets for production
         * @url: https://github.com/gruntjs/grunt-contrib-cssmin
         */
        cssmin: {
            minify: {
                files: {
                    'style.css': 'assets/css/nano-progga.css',
                    'assets/css/nano-progga-admin.css': 'assets/css/nano-progga-admin.css'
                },
                options: {
                    report: 'min',
                    keepSpecialComments: 0
                }
            }
        },


        /**
         Updates the translation catalog
         @author https://www.npmjs.com/package/grunt-wp-i18n
         */
        makepot: {
            target: {
                options: {
                    domainPath: '/i18n/languages/',
                    exclude: ['assets/.*', 'node_modules/.*', 'vendor/.*', 'tests/.*'],
                    mainFile: 'index.php',
                    potComments: 'Copyright (c) 2017 nanodesigns',
                    potFilename: 'nano-progga.pot',
                    potHeaders: {
                        poedit: true,
                        'x-poedit-keywordslist': true,
                        'report-msgid-bugs-to': 'https://github.com/nanodesigns/nano-progga/issues',
                        'last-translator': 'nanodesigns (http://nanodesignsbd.com/)',
                        'language-team': 'nanodesigns <info@nanodesignsbd.com>',
                        'language': 'en_US'
                    },
                    processPot: null,
                    type: 'wp-theme',
                    updateTimestamp: true
                }
            }
        },


        /**
         * Check textdomain errors
         * @author https://github.com/stephenharris/grunt-checktextdomain
         */
        checktextdomain: {
            options:{
                text_domain: 'nano-progga',
                keywords: [
                    '__:1,2d',
                    '_e:1,2d',
                    '_x:1,2c,3d',
                    'esc_html__:1,2d',
                    'esc_html_e:1,2d',
                    'esc_html_x:1,2c,3d',
                    'esc_attr__:1,2d',
                    'esc_attr_e:1,2d',
                    'esc_attr_x:1,2c,3d',
                    '_ex:1,2c,3d',
                    '_n:1,2,4d',
                    '_nx:1,2,4c,5d',
                    '_n_noop:1,2,3d',
                    '_nx_noop:1,2,3c,4d'
                ]
            },
            files: {
                src:  [
                    '**/*.php',         // Include all files
                    '!node_modules/**', // Exclude node_modules/
                    '!vendor/**',       // Exclude vendor/
                    '!tests/**'         // Exclude tests/
                ],
                expand: true
            }
        },


        /**
         * Watch for changes and do it
         * @url: https://github.com/gruntjs/grunt-contrib-watch
         */
        watch: {
            options: {
                livereload: {
                    port: 9000
                }
            },
            js: {
                files: ['assets/js/nano-progga.js', 'assets/js/nano-progga-admin.js', 'assets/js/customizer.js'],
                tasks: ['uglify']
            },
            css: {
                files: ['assets/sass/*.scss'],
                tasks: ['sass', 'autoprefixer', 'cssmin']
            }
        }

    });


    // @Grunt: we're using the following plugins
    require('load-grunt-tasks')(grunt);


    // @Grunt: do the following when we will type 'grunt'
    grunt.registerTask('default', ['jshint', 'uglify', 'sass', 'autoprefixer', 'cssmin']);

};
